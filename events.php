<?php

// Copyright (c) 2010 by Paul M. Foster <paulf@quillandmouse.com>
// Licensed under PostgreSQL License (see LICENSE file)

// THIS FILE IS A TRUNCATED VERSION OF THE EVENTS CLASS, MIXED WITH ROUTINES FROM CALENDAR CLASS.

// This code originally used the "remind" program (http://roaringpenguin.com/products/remind)
// to drive the calendar and events. This was possible because all the code was run locally
// on LAN servers we controlled. However, running a Linux program on a public server may
// be impossible for others. So a new back end had to be coded. This is the result of coding
// a new back end.

// PROGRAMMERS:
//
// When using this code without the rest of the PSS framework, you must ensure that you have
// access to the PSS date class. It's understood that the date class will autoload; there is
// no provision here for including the date class file.
//
// This PHP code is primarily designed to drive an onscreen calendar. There is a second
// version of this backend written in Python which is designed to drive daily reminders
// emailed to someone.


/*
 * File lines look like this:
 *
 * [from date]:[to date]:[repetition specification]:[warn days]:message text
 *
 * Delimiter between each part of the spec is a colon (:).
 * Message text may contain colons as well.
 * from date and to date are optional and in the form CCYYMMDD.
 * repetition specification is optional and detailed below.
 * warn days are optional, but if included, they specify how many days ahead to send reminders.
 * message text is what will appear in the calendar or reminders
 *
 * Repetition specifications:
 *
 * Repetition specifications are composed of letters and numbers. Letters may be either
 * capital or lowercase.
 *
 * The first letter is the period of repetition, as shown below:
 *
 * Periods:
 * D = daily
 * W = weekly
 * M = monthly
 * Q = quarterly
 * Y = yearly
 *
 * This is followed by one or more repetition type specifications, as follows:
 * 
 * Types of repetition:
 * D = [01-31] (specific day of the month)
 * K = [0-6,W,E,*] (day of the week, weekdays only, weekends only, or all)
 * S = [1-6,L,*] (1st to 5th, last, or all)
 * M = [1-12,*] (1st to 12th month, or all)
 * N = [1-3,*] (1st to 3rd month of quarter, or all)
 * Q = [1-4,*] (1st to 4th quarter, or all)
 *
 * In general, users will use the web interface to create events, so I won't detail how
 * to write the specs. But if you're curious, use the web interface to create a variety
 * of repeating and non-repeating events, and then use the events.dat file to examine
 * how the specifications look.
 *
 */

// $events array is an indexed array of arrays containing:
// raw => the raw line from the events file(s)
// rspec => the repeat specification from the event line, if any
// from_date => the beginning date for the event, if any
// to_date => the ending date for the event, if any
// repeat => boolean, repeats or doesn't
// warn_days => number of days to warn the user prior to the event
// period => repetition period (D = daily, W = weekly, M = monthly, Q = quarterly, Y = yearly)
// text => the text to appear in calendar or reminders
// dm => day-of-the-month repetition (1-31)
// dw => day-of-the-week repetition (0-6,W,E,*)
// om => occurrence-in-month repetition (1-6,L,*)
// my => month-of-year repetition (1-12,*)
// mq => month-of-quarter repetition (1-3,*)
// qy => quarter-of-year repetition (1-4,*)
// date => actual date the event should fire
// year => year of the event, derived from date
// month => month of the event, derived from date
// dom => day of the month of the event, derived from date
// jday => julian day of the event
// linenum => line number on which the event appeared in its events file
// filename => filename from which the event came
// id => combination of filename, colon, and linenum (unique for each event)
//
// A typical event (Mother's Day, 2010) within May 2010 might look like this:
// $this->events[20] = array(
// 	'raw' => "::YK0S2M5:5:Mother's Day",
//	'rspec' => 'YK0S2M5',
//	'from_date' => null,
//	'to_date' => null,
//	'repeat' => true,
//	'warn_days' => 5,
//	'period' => 'Y',
//	'text' => "Mother's Day",
//	'dm' => null,
//	'dw' => 0,
//	'om' => 2,
//	'my' => 5,
//	'mq' => null,
//	'qy' => null,
//	'date' => (date object, 2010-05-09),
//	'year' => 2010,
//	'month' => 5,
//	'dom' => 9,
//	'linenum' => 45,
//	'filename' => 'events.dat',
//	'id' => 'events.dat:45');
//

// $months array is indexed array of day-of-week arrays as follows:
// For example (April and May of 2010):
//
// $this->months[4] = array(
// 		0 => array(4, 11, 18, 25),
//		1 => array(5, 12, 19, 26),
//		2 => array(6, 13, 20, 27),
//		3 => array(7, 14, 21, 28),
//		4 => array(1, 8, 15, 22, 29),
//		5 => array(2, 9, 16, 23, 30),
//		6 => array(3, 10, 17, 24));
// $this->months[5] = array(
// 		0 => array(2, 9, 16, 23, 30),
//		1 => array(3, 10, 17, 24, 31),
//		2 => array(4, 11, 18, 25),
//		3 => array(5, 12, 19, 26),
//		4 => array(6, 13, 20, 27),
//		5 => array(7, 14, 21, 28),
//		6 => array(1, 8, 15, 22, 29));

class events {

	var $events;
	var $start, $end;
	var $months;
	var $calendar;
	var $total_days;

	// temporary
	var $filename, $linenum;

	function events()
	{
		$this->months = array();
		$this->calendar = array();
		$this->events = array();
		$this->total_days = 0;
		$this->filename = 'events.dat';
	}

	// Creates an array of dates for the month of the passed date.
	// See repeat_dow_wom for an example of how this array is structured.
	function populate_month($dt)
	{
		$dim = $dt->get_days_in_month();
		$moy = $dt->get_month();
		$first = $dt->copy();
		$first->set('Y-m-d', $first->get_year() . '-' . $first->get_month() . '-1');
		$dow = $first->get_dow();

		for ($i = 1; $i <= $dim; $i++) {
			$this->months[$moy][$dow][] = $i;
			$dow = ++$dow % 7;
		}

	}

	// Tests if the $iter date matches the $evt array's day-of-the-week and occurrence-in-month criteria.
	// Returns true if they do, false otherwise.
	function dwom_okay($iter, $evt)
	{
		$dw = $iter->get_dow();
		$dim = $iter->get_days_in_month();
		$my = $iter->get_month();
		$dm = $iter->get_dom();

		// Don't even test if this date doesn't meet minimum requirements.
		if ((is_int($evt['dw']) and $evt['dw'] === $dw) or ($evt['dw'] === 'W' and ($dw >= 1 and $dw <= 5)) or ($evt['dw'] === 'E' and ($dw == 0 or $dw == 6)) or ($evt['dw'] === '*')) {

			if (empty($this->months[$my]))
				$this->populate_month($iter);

			// Only test dates for this month and this day of the week
			$test_dates = $this->months[$my][$dw];

			// Find out which week this date falls in. Return on failure.
			// If successful, $which_week is one less than actual week of month
			$which_week = array_search($dm, $test_dates);
			if ($which_week === false) {
				return false;
			}				

			if (is_int($evt['om'])) {
				if ($evt['om'] == $which_week + 1) {
					return true;
				}
			}
			elseif ($evt['om'] == 'L') {
				if (count($test_dates) == $which_week + 1) {
					return true;
				}
			}
			elseif ($evt['om'] == '*') {
				return true;
			}
		} // if
		return false;
	}

	// Given the $evt (event) array (one event), generate the dates 
	// which would satisfy this event within the boundaries of the
	// alpha and omega dates.
	// $alpha and $omega must be date objects.
	// Returns the array of date objects.
	function generate_dates($evt, $alpha, $omega)
	{
		// result array
		$d = array();

		for ($i = 0; $i < $this->total_days; $i++) {

			// skip checks if we're not within our date boundaries
			if ($alpha->later_than($this->calendar[$i]))
				continue;
			if ($omega->earlier_than($this->calendar[$i]))
				break;

			// periods: D,W,M,Q,Y	

			$my = $this->calendar[$i]->get_month();
			$dw = $this->calendar[$i]->get_dow();
			$dm = $this->calendar[$i]->get_dom();
			$mq = $this->calendar[$i]->get_month_of_quarter();
			$qy = $this->calendar[$i]->get_quarter();

			// satisfies month of year?
			if (isset($evt['my'])) {
				$my_okay = false;
				if (is_int($evt['my'])) {
					if ($my == $evt['my'])
						$my_okay = true;
				}
				elseif ($evt['my'] == '*')
					$my_okay = true;
			}
			else
				$my_okay = true;

			switch ($evt['period']) {
			case 'D':
				$d[] = $this->calendar[$i]->copy();
				break;
			case 'W':
				if (is_integer($evt['dw'])) {
					if ($dw == $evt['dw']) 
						$d[] = $this->calendar[$i]->copy();
				}
				elseif ($evt['dw'] == 'W') {
					if ($dw >= 1 and $dw <= 5) 
						$d[] = $this->calendar[$i]->copy();
				}
				elseif ($evt['dw'] == 'E') {
					if ($dw == 0 or $dw == 6) 
						$d[] = $this->calendar[$i]->copy();
				}
				elseif ($this->dow == '*') 
					$d[] = $this->calendar[$i]->copy();
				break;
			case 'M':
				if (!empty($evt['dm'])) {
					if ($dm == $evt['dm']) 
						$d[] = $this->calendar[$i]->copy();
				}
				else {
					if ($this->dwom_okay($this->calendar[$i], $evt)) 
						$d[] = $this->calendar[$i]->copy();
				}
				break;	
			case 'Q':
				// satisfies month of quarter?
				$mq_okay = false;
				if (is_int($evt['mq'])) {
					if ($mq == $evt['mq'])
						$mq_okay = true;
				}
				elseif ($evt['mq'] == '*')
					$mq_okay = true;	

				// satisfies quarter of year?
				$qy_okay = false;
				if (is_int($evt['qy'])) {
					if ($qy == $evt['qy'])
						$qy_okay = true;
				}
				elseif ($evt['qy'] == '*')
					$qy_okay = true;

				if (!empty($evt['dm'])) {
					if ($dm == $evt['dm'] and $mq_okay and $qy_okay) 
						$d[] = $this->calendar[$i]->copy();
				}
				else {
					if ($mq_okay and $qy_okay)
						if ($this->dwom_okay($this->calendar[$i], $evt)) 
							$d[] = $this->calendar[$i]->copy();
				}
				break;
			case 'Y':
				if (!empty($evt['dm'])) {
					if ($my_okay and $dm == $evt['dm']) 
						$d[] = $this->calendar[$i]->copy();
				}
				else {
					if ($my_okay) {
						if ($this->dwom_okay($this->calendar[$i], $evt)) 
							$d[] = $this->calendar[$i]->copy();
					}
				}
				break;

			} // switch

		} // for

		return $d;

	}

	// Breaks out and partially populates an event array, based on one line read.
	// Called by read_file().
	// Returns the event array.
	// This event array does not contain any target date fields.
	function decode_event_line($line)
	{
		$ret = array();
		$ret['raw'] = $line;
		$dt = new date;

		$arr = explode(':', $line);

		// get the message text
		if (count($arr) > 5) {
			// they put a colon in the message
			$ret['text'] = implode(':', array_slice($arr, 4));
		}
		else
			$ret['text'] = $arr[4];

		// get the "from" date
		if (!empty($arr[0])) {
			$dt->set('Ymd', $arr[0]);
			$ret['from_date'] = $dt->copy();
		}
		else
			$ret['from_date'] = null;

		// get the "to" date
		if (!empty($arr[1])) {
			$dt->set('Ymd', $arr[1]);
			$ret['to_date'] = $dt->copy();
		}
		else
			$ret['to_date'] = null;

		// get repeat spec
		if (!empty($arr[2])) {
			$ret['repeat'] = true;
			$ret['rspec'] = $arr[2];
		}
		else
			$ret['repeat'] = false;

		// get warning days
		if (!empty($arr[3])) 
			$ret['warn_days'] = (int) $arr[3];
		else
			$ret['warn_days'] = '';

		// decode repeat spec
		if ($ret['repeat']) {
			$ret['period'] = strtoupper($ret['rspec'][0]);
			$rest = substr($ret['rspec'], 1);

			$n = strlen($rest);
			$i = 0;
			while ($i < $n) {
				if (stristr('DKSMNQ', $rest[$i]) !== false) {
					$state = strtoupper($rest[$i]);
				}
				elseif ($state == 'D') {
					$ret['dm'] .= $rest[$i];
				}
				elseif ($state == 'K') {
					$ret['dw'] .= $rest[$i];
				}
				elseif ($state == 'S') {
					$ret['om'] .= $rest[$i];
				}
				elseif ($state == 'M') {
					$ret['my'] .= $rest[$i];
				}
				elseif ($state == 'N') {
					$ret['mq'] .= $rest[$i];
				}
				elseif ($state == 'Q') {
					$ret['qy'] .= $rest[$i];
				}
				else {
					$ret['text'] = 'MALFORMED REPEAT SPEC ' . $ret['text'];
				}
				$i++;
			}

			if (!empty($ret['dm']))
				$ret['dm'] = (int) $ret['dm'];

			if (!empty($ret['dw']) or $ret['dw'] == '0') {
				if (is_numeric($ret['dw']))
					$ret['dw'] = (int) $ret['dw'];
			}
			if (!empty($ret['om'])) {
				if (is_numeric($ret['om'])) 
					$ret['om'] = (int) $ret['om'];
			}
			if (!empty($ret['my'])) {
				if (is_numeric($ret['my']))
					$ret['my'] = (int) $ret['my'];
			}
			if (!empty($ret['mq'])) {
				if (is_numeric($ret['mq']))
					$ret['mq'] = (int) $ret['mq'];
			}
			if (!empty($ret['qy'])) {
				if (is_numeric($ret['qy']))
					$ret['qy'] = (int) $ret['qy'];
			}
		}
		return $ret;
	}


	// Sets the events array for a single event line.
	function generate_events($str)
	{
		$e = $this->decode_event_line($str);

		if (!$e['repeat']) {
			if (($this->start->earlier_than($e['from_date']) or $this->start->same_as($e['from_date'])) and ($this->end->later_than($e['from_date']) or $this->end->same_as($e['from_date']))) {
				$e['year'] = $e['from_date']->get_year();
				$e['month'] = $e['from_date']->get_month();
				$e['dom'] = $e['from_date']->get_dom();
				$e['jday'] = $e['from_date']->get_jday();
				$e['filename'] = $this->filename;
				$e['linenum'] = $this->linenum;
				$e['id'] = $this->filename . ':' . $this->linenum;	
				return array($e);
			}
		}
		else { // repeating event

			// set early boundary on repetitions 
			if (!empty($e['from_date'])) {
				if ($this->start->earlier_than($e['from_date']) or $this->start->same_as($e['from_date']))
					$alpha = $e['from_date']->copy();
				else
					$alpha = $this->start->copy();
			}
			else {
				$alpha = $this->start->copy();	
			}

			// set later boundary on repetition
			if (!empty($e['to_date'])) {
				if ($this->end->later_than($e['from_date']) or $this->end->same_as($e['from_date']))
					$omega = $e['to_date']->copy();
				else
					$omega = $this->end->copy();
			}
			else {
				$omega = $this->end->copy();	
			}

			$dates = $this->generate_dates($e, $alpha, $omega);

			$ndates = count($dates);
			if ($ndates == 0)
				return array();
			else {
				$ret = array();
				for ($j = 0; $j < $ndates; $j++) {
					$e['year'] = $dates[$j]->get_year();
					$e['month'] = $dates[$j]->get_month();
					$e['dom'] = $dates[$j]->get_dom();
					$e['jday'] = $dates[$j]->get_jday();
					$e['filename'] = $this->filename;
					$e['linenum'] = $this->linenum;
					$e['id'] = $this->filename . ':' . $this->linenum;	

					$ret[] = $e;
				}
			}

		} // else

		return $ret;

	}

	// Read an events file and populate the $events array from it.
	// Called by read_files().
	// Only those events which satisfy the date criteria are included.
	function read_file($filename)
	{
		if (file_exists($filename)) {
			// read strings
			$this->filename = $filename;
			$evstrings = file($filename);

			// cycle through strings
			$this->linenum = 1;
			foreach ($evstrings as $str) {
				$str = rtrim($str);
				if (!empty($str)) {
					$x = $this->generate_events($str);
					if (!empty($x)) {
						$this->events = array_merge($this->events, $x);
					}
				}
				$this->linenum++;
			} 
			return true;
		}
		else 
			return false;
	}

	// Read events file(s) and populate the $events array
	// Calls read_file(), possibly repeatedly
	// Input parameter may be a filename string or indexed array of filename strings.
	// If none specified, 'events.dat' file will be read, if available.
	function read_events_files($files)
	{
		if (is_array($files)) {
			foreach ($files as $file) {
				$this->read_file($file);
			}
		}
		elseif (!empty($files)) {
			$this->read_file($files);
		}
		else {
			// default name for events file
			$this->read_file('events.dat');
		}
	}

	// Returns all eligible events.
	// $from and $to must be date objects
	function get_events($files, $from, $to = null)
	{
		$this->start = $from->copy();
		if (!is_null($to))
			$this->end = $to->copy();
		else
			$this->end = $from->copy();

		// Set up calendar of date objects ahead of time
		$this->total_days = $this->end->get_jday() - $this->start->get_jday() + 1;

		$iter = $this->start->copy();
		for ($i = 0; $i < $this->total_days; $i++) {
			$this->calendar[] = $iter->copy();
			$iter = $iter->adddays(1);
		}

		$this->read_events_files($files);

		// Could sort events here.

		return $this->events;
	}

	// Used to retrieve a single event, based on file and line number.
	function get_event($filename, $lineno)
	{
		if (empty($filename)) {
			trigger_error('File not available. Filename not supplied.', E_USER_WARNING);
			return false;
		}

		if (file_exists($filename)) {
			$hand = fopen($filename, 'r');
			if ($hand !== false) {
				$lno = 1;
				while (!feof($hand)) {
					$str = fgets($hand);
					if ($lno == $lineno)
						break;
					$lno++;
				}
				fclose($hand);
				if ($str === false)
					return false;
				else {
					$event = $this->decode_event_line($str, false);
					return $event;
				}
			}
			else {
				trigger_error('Unable to open events file.', E_USER_WARNING);
				return false;
			}
		}
		else {
			trigger_error("Events file ($filename) doesn't exist.", E_USER_WARNING);
			return false;
		}
	}

	// Evaluates and creates a text repeat specification.
	// Expects an associative array of values.
	// Return the text version of the repeat spec if successful.
	// Return false on failure.
	// Returns blank if fed a blank array (so don't do it).
	function rspec_okay($rs)
	{
		$rspec_error = false;
		$rspec = $rs['period'];
		switch ($rspec) {
		case 'd':
		case 'D':
			// done
			break;
		case 'w':
		case 'W':
			if (!empty($rs['dw']))
				$rspec .= 'K' . $rs['dw'];
			else
				$rspec_error = true;
			break;
		case 'm':
		case 'M':
			if (!empty($rs['dm'])) 
				$rspec .= 'D' . $rs['dm'];
			elseif (!blank($rs['dw']) and !empty($rs['om'])) 
				$rspec .= 'K' . $rs['dw'] . 'S' . $rs['om'];
			else
				$rspec_error = true;
			break;
		case 'q':
		case 'Q':
			if (!empty($rs['dm']) and !empty($rs['mq']) and !empty($rs['qy']))
				$rspec .= 'D' . $rs['dm'] . 'N' . $rs['mq'] . 'Q' . $rs['qy'];
			elseif (!blank($rs['dw']) and !empty($rs['om']) and !empty($rs['mq']) and !empty($rs['qy']))
				$rspec .= 'K' . $rs['dw'] . 'S' . $rs['om'] . 'N' . $rs['mq'] . 'Q' . $rs['qy'];
			else
				$rspec_error = true;
			break;
		case 'y':
		case 'Y':
			if (!empty($rs['dm']) and !empty($rs['my']))
				$rspec .= 'D' . $rs['dm'] . 'M' . $rs['my'];
			elseif (!blank($rs['dw']) and !empty($rs['om']) and !empty($rs['my']))
				$rspec .= 'K' . $rs['dw'] . 'S' . $rs['om'] . 'M' . $rs['my'];
			else
				$rspec_error = true;
			break;
		}	

		if ($rspec_error)
			return false;
		else
			return $rspec;
	}

	// For debugging only
	function dump()
	{
		print "<pre>\n";
		$nevts = count($this->events);
		for ($i = 0; $i < $nevts; $i++) {
			print_r($this->events[$i]);
		}
		print "</pre>\n";
	}

	// Open the events file.
	// Read the event strings into an array.
	// Create an array of event objects.
	// Using the event objects,
	// create an array of events (not event objects)
	// usable for the calendar.
	function populate_events($year, $month, $dom = null) 
	{
		$dt = new date;
		if (is_null($dom)) {
			$dt->set('Y-m-d', "$year-$month-1");
			$from = $dt->copy();
			$dim = $dt->get_days_in_month();
			$dt->set('Y-m-d', "$year-$month-$dim");
			$to = $dt->copy();
		}
		else {
			$dt->set('Y-m-d', "$year-$month-$dom");
			$from = $dt->copy();
			$to = $dt->copy();
		}

		$this->events = $this->get_events($this->filename, $from, $to);
	}


    // Generates the string which represents all the events for a day.
    function format_days_events($year, $month, $dom)
    {
        $str = '';
        $first = true;
		$ndates = count($this->events);
        for ($i = 0; $i < $ndates; $i++) {
            if ($this->events[$i]['year'] == $year and $this->events[$i]['month'] == $month and $this->events[$i]['dom'] == $dom) {
                if ($first) {
                    $first = false;
                }
                else {
                    $str .= '<hr/>';
                }
				$str .= "<a href=\"meetings.php#tampa\">";
                $str .= $this->events[$i]['text'];
                $str .= "</a>\n";
            }
        }
        return $str;
    }

    // Generates the HTML for the calendar.
	// Expects date object as parameter
    function generate_calendar($date)
    {
		$short_months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
		$month_names = array('January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December');
		$day_names = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

		$year = $date->get_year();
		$month = $date->get_month();
		$dom = $date->get_dom();
		$dim = $date->get_days_in_month();

        $firstday = "$year-$month-01";
        $lastday = "$year-$month-$dim";
		$today = "$year-$month-$dom";

        $this->populate_events($year, $month);

        // Navigation outside this month
        $lastyear = $year - 1;
        $nextyear = $year + 1;
        $calnav = array();
        $calnav[0] = "<a href=\"calendar.php?date=" . $lastyear . "-$month-$dom\">" . $lastyear . "</a>";
        for ($i = 1; $i < 13; $i++) {
            $calnav[$i] = "<a href=\"calendar.php?date=$year-$i-$dom\">" . $short_months[$i - 1] . "</a>";
        }
        $calnav[13] = "<a href=\"calendar.php?date=" . $nextyear . "-$month-$dom\">" . $nextyear . "</a>";

        $str .= "<table rules=\"all\" border=\"1\" cellpadding=\"5\">\n";
        // $str .= "<thead>\n";

        // Print the actual navs
        $str .= "<tr>\n";
        for ($i = 0; $i < 14; $i++) {
            $str .= "<td align=\"center\">" . $calnav[$i] . "</td>\n";
        }
        $str .= "</tr>\n";

        // Print month banner
        $str .= "<tr>\n";
        $str .= "<td colspan=\"14\" style=\"font-weight: bold; text-align: center; font-size: large\">" . $month_names[$month - 1] . ' ' . $year . "</td>\n";
        $str .= "</tr>\n";

        // Print days of week
        $str .= "<tr>\n";
		for ($i = 0; $i < 7; $i++) {
			$str .= "<td align=\"center\" style=\"font-weight: bold\" colspan=\"2\">$day_names[$i]</td>\n";
		}
        $str .= "</tr>\n";

        // $str .= "</thead>\n";

        $count = 1;
		$dt = new date;
        while ($count <= $dim) {
            $str .= "<tr>\n";
            for ($i = 0; $i < 7; $i++) {
				$dt->set('Y-m-d', "$year-$month-$count");
				if ($dt->get_dow() == $i && $count <= $dim) {
                    if ($count == $dom) {
                        $str .= "<td valign=\"top\" bgcolor=\"#ffffcc\" colspan=\"2\">\n";
                    }
                    else { 
                        $str .= "<td valign=\"top\" colspan=\"2\">\n";
                    }
                    $str .= "$count<br/>\n";
                    $test = $this->format_days_events($year, $month, $count);
                    if (!empty($test))
                        $str .= $test;
                    $str .= "</td>\n";
                    $count ++;
                }
                else {
                    $str .= "<td colspan=\"2\"></td>\n";
                }
            }
            $str .= "</tr>\n";
        }

        $str .= "</table>\n";

        return $str;
    }
 
};


