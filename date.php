<?php
// Copyright 2009 by Paul M. Foster <paulf@quillandmouse.com>
// License: GPLv2
// Version: 4.0

// DEPENDENCIES: PHPv4+

/**
 * Date class
 *
 * This date class handles a variety of things that PHP date classes don't.
 * It avoids regexps as much as possible for speed reasons, and uses
 * strpos() extensively for the same reason. Date format operators are:
 *
 * Y = 4 digit year
 * y = 2 digit year
 * m = 2 digit month
 * d = 2 digit day of month
 * j = julian day
 * q = Quicken(R) date
 * 
 * This class won't prevent users from doing stupid things. A blank date
 * will register internally as 2000-0-0 (ISO format), and be output as ''
 * (blank string).
 *
 * This class does *not* throw exceptions because I don't like them, nyah nyah.
 */

class Date {
	var $jday;
	var $dom;
	var $month;
	var $year;
	var $dow;
    var $dbfmt = 'Y-m-d';
    var $dispfmt = 'm/d/y';
	

	/************************************************************
	 * INTERNAL FUNCTIONS
	 ***********************************************************/

	// internal function, sets jday
	// calculations from http://www.astro.uu.nl/~strous/AA/en/reken/juliaansedag.html
	function cymd2jul($year, $month, $day)
	{
		if ($month < 3) {
			$m = $month + 12;
			$y = $year - 1;
		}
		else {
			$m = $month;
			$y = $year;
		}
		$c = 2 - floor($y / 100) + floor($y / 400);
		$j = floor(1461 * ($y + 4716) / 4) + floor(153 * ($m + 1) / 5) + $day + $c - 1524.5;
		return $j;
	}

	// internal function, returns array of y, m, d
	// calculations from http://www.astro.uu.nl/~strous/AA/en/reken/juliaansedag.html
	function jul2cymd($jday)
	{
		$p = floor($jday + 0.5);
		$s1 = $p + 68569;
		$n = floor(4 * $s1 / 146097);
		$s2 = $s1 - floor((146097 * $n + 3) / 4);
		$i = floor(4000 * ($s2 + 1) / 1461001);
		$s3 = $s2 - floor(1461 * $i / 4) + 31;
		$q = floor(80 * $s3 / 2447);
		$e = $s3 - floor(2447 * $q / 80);
		$s4 = floor($q / 11);
		$m = $q + 2 - 12 * $s4;
		$y = 100 * ($n - 49) + $i + $s4;
		$d = $e + $jday - $p + 0.5;
		return array((int) $y, (int) $m, (int) $d); 
	}

	/*
	MITRE Corp pseudocode for leap year calculations:
	if (year mod 4 != 0)
		{use 28 for days in February}
	else if  (year mod 400 == 0)
		{use 29 for days in February}
	else if (year mod 100 == 0)
		{use 28 for days in February}
	else
		{use 29 for days in February}
	*/
	function is_leap_year($y)
	{
		if (($y % 4 == 0) and (($y % 100 != 0) or ($y % 400 == 0)))
			return true;
		else
			return false;
	}

	function jul2dow($j)
	{
		$n = (int) ($j + 0.5) + 1;
		return $n % 7;
	}
		
	function fromints($yr, $mo, $da) 
	{
        if ($yr < 100) {
			// POSIX X/Open standard "window"
            if ($yr >= 69 and $yr <= 99)
                $yr = 1900 + $yr;
            else
                $yr = 2000 + $yr;
        }

		$this->year = $yr;
		$this->month = $mo;
		$this->dom = $da;
		$this->jday = $this->cymd2jul($yr, $mo, $da);
		$this->dow = $this->jul2dow($this->jday);
	}

	function fromjul($julian)
	{
		$this->jday = $julian;
		$arr = $this->jul2cymd($this->jday);
		$this->year = $arr[0];
		$this->month = $arr[1];
		$this->dom = $arr[2];
		$this->dow = $this->jul2dow($this->jday);
	}

	function fromqif($date) {

		$date = str_replace('\'', '/', $date);
		$date = str_replace(' ', '', $date);

		if (!strpos($date, '/'))
			$parts = explode('-', $date);
		else
			$parts = explode('/', $date);

		$mo = $parts[0];
		$da = $parts[1];

		if (count($parts) == 2) {
			$today = localtime(time());
			$yr = 1900 + $today[5];
		}
		else
			$yr = $parts[2];

		if (strlen($yr) == 2)
			$yr = '20' . $yr;

		$mo = trim($mo);
		$da = trim($da);

		$this->year = (int)$yr;
		$this->month = (int)$mo;
		$this->dom = (int)$da;
		$this->fromints((int)$yr, (int)$mo, (int)$da);
	}

	function copy()
	{
		$dt = new date;
		$dt->jday = $this->jday;
		$dt->year = $this->year;
		$dt->month = $this->month;
		$dt->dom = $this->dom;
		$dt->dow = $this->dow;
		return $dt;
	}

	/************************************************************
	 * CONSTRUCTORS
	 ***********************************************************/

    function now()
    {
		$now = getdate(time());
		$this->year = $now['year'];
		$this->month = $now['mon'];
		$this->dom = $now['mday'];
		$this->jday = $this->cymd2jul($now['year'], $now['mon'], $now['mday']);
		$this->dow = $this->jul2dow($this->jday);
    }

	function date() 
	{
        $this->now();
	}

	/************************************************************
	 * DATE SETTING ROUTINES
	 ***********************************************************/

    // No parameters: set date to now.
    // One parameter: set date to now.
    // Two parameters: format, date string.
    // Four parameters: format, y|m|d, y|m|d, y|m|d
    // Any other parameter count: set date to now.
    // FIXME: four parms is silly. make user do y, m, d
    //          swap position of parms
    //          fix datetests.php
    function set()
    {
        $nargs = func_num_args();

        if ($nargs == 0 or $nargs == 1) {
            // set default date
            $this->now();
        }
        else {
            $fmt = func_get_arg(0);
        }

        if ($nargs == 2) {
            $arg1 = func_get_arg(1);
            if ($fmt == 'q') {
                $this->fromqif($arg1);
            }
            elseif ($fmt == 'j') {
                $this->fromjul($arg1);
            }
            else {
                // what if there are multiple templates?
                if (strpos($fmt, '|') !== false) {
                    $tmpls = explode('|', $fmt);

                    // test date in turn against each template; which one fits?
                    for ($i = 0; $i < count($tmpls); $i++) {
                        if (strpos($tmpls[$i], '/') !== false) {
                            if (strpos($arg1, '/') !== false) {
                                $fmt = $tmpls[$i];
                                break;
                            }
                        }
                        elseif (strpos($tmpls[$i], '-') !== false) {
                            if (strpos($arg1, '-') !== false) {
                                $fmt = $tmpls[$i]; 
                                break;
                            }
                        }
                        else {
                            $fmt = $tmpls[$i];
                        }
                    }
                }

                $delim = '';
                if (strpos($fmt, '/') !== false) {
                    $delim = '/';
                }
                elseif (strpos($fmt, '-') !== false) {
                    $delim = '-';
                }
                elseif (strpos($fmt, '.') !== false) {
                    $delim = '.';
                }

                if (!empty($delim)) {
                    $darr = explode($delim, $arg1);

                    $fmt2 = $fmt;
                    $fmt2 = preg_replace("%[^ymd]%", '', strtolower($fmt2));

                    $posn = array();
                    $posn[strpos($fmt2, 'y')] = 'y';
                    $posn[strpos($fmt2, 'm')] = 'm';
                    $posn[strpos($fmt2, 'd')] = 'd';

                    for ($i = 0; $i < 3; $i++) {
                        ${$posn[$i]} = $darr[$i];
                    }

                    $this->year = (int) $y;
                    $this->month = (int) $m;
                    $this->dom = (int) $d;

                    $this->fromints($this->year, $this->month, $this->dom);
                }
                else {
                    // no delimiters
                    $ypos = strpos($fmt, 'Y');
                    if ($ypos === false) {
                        // 2 digit year

                        $fmt2 = $fmt;
                        $fmt2 = preg_replace("%[^ymd]%", '', strtolower($fmt2));

                        switch ($fmt2) {
                            case 'ymd':
                                $yofs = 0;
                                $mofs = 2;
                                $dofs = 4;
                                break;
                            case 'ydm':
                                $yofs = 0;
                                $mofs = 4;
                                $dofs = 2;
                                break;
                            case 'myd':
                                $yofs = 2;
                                $mofs = 0;
                                $dofs = 4;
                                break;
                            case 'dym':
                                $yofs = 2;
                                $mofs = 4;
                                $dofs = 0;
                                break;
                            case 'mdy':
                                $yofs = 4;
                                $mofs = 0;
                                $dofs = 2;
                                break;
                            case 'dmy':
                                $yofs = 4;
                                $mofs = 2;
                                $dofs = 0;
                                break;
                        }

                        $y = substr($arg1, $yofs, 2);
                        $m = substr($arg1, $mofs, 2);
                        $d = substr($arg1, $dofs, 2);

                        $this->year = (int) $y;
                        $this->month = (int) $m;
                        $this->dom = (int) $d;

                        $this->fromints($this->year, $this->month, $this->dom);
                    }
                    else {
                        // 4 digit year

                        $fmt2 = $fmt;
                        $fmt2 = preg_replace("%[^ymd]%", '', strtolower($fmt2));

                        switch ($fmt2) {
                            case 'ymd':
                                $yofs = 0;
                                $mofs = 4;
                                $dofs = 6;
                                break;
                            case 'ydm':
                                $yofs = 0;
                                $mofs = 6;
                                $dofs = 4;
                                break;
                            case 'myd':
                                $yofs = 2;
                                $mofs = 0;
                                $dofs = 6;
                                break;
                            case 'dym':
                                $yofs = 2;
                                $mofs = 6;
                                $dofs = 0;
                                break;
                            case 'mdy':
                                $yofs = 4;
                                $mofs = 0;
                                $dofs = 2;
                                break;
                            case 'dmy':
                                $yofs = 4;
                                $mofs = 2;
                                $dofs = 0;
                                break;
                        }

                        $y = substr($arg1, $yofs, 4);
                        $m = substr($arg1, $mofs, 2);
                        $d = substr($arg1, $dofs, 2);

                        $this->year = (int) $y;
                        $this->month = (int) $m;
                        $this->dom = (int) $d;

                        $this->fromints($this->year, $this->month, $this->dom);

                    }
                }
            }
        }
        elseif ($nargs == 4) {
            // remove extraneous chars and lowercase result
            $fmt = preg_replace("%[^ymd]%", '', strtolower($fmt));
            $posn = array();
            $posn[strpos($fmt, 'y')] = 'y';
            $posn[strpos($fmt, 'm')] = 'm';
            $posn[strpos($fmt, 'd')] = 'd';

            for ($i = 1; $i < 4; $i++) {
                ${$posn[$i - 1]} = func_get_arg($i);
            }

            $this->fromints($y, $m, $d);
        }
        else {
            $this->now();
        }
    }


    // DEPRECATED 2009-01-22
	function fromform($date)
	{
        $this->set('m/d/y|m-d-y|mdy', $date);
	}

    // DEPRECATED 2009-01-22
	function fromamerican($date) 
	{
        $this->set('m/d/y|m-d-y|mdy', $date);
	}

    // DEPRECATED 2009-01-22
	function fromdb($indate)
	{
        $this->set('Y-m-d', $indate);
	}

    // DEPRECATED 2009-01-22
	function fromiso($indate)
	{
        $this->set('Y-m-d', $indate);
	}

	/************************************************************
	 * DATE MANIPULATION ROUTINES
     * NOTE: These routines create and return a new date object.
	 ***********************************************************/

	function adddays($numdays)
	{
		$dt = $this->copy();
		$dt->fromjul($dt->jday + $numdays);
		return $dt;
	}

	function addmonths($nummonths)
	{
		$y = $this->year;
		$m = $this->month;
		$d = $this->dom;

		$m += $nummonths;
		if ($m <= 0) {
			while ($m <= 0) {
				$m += 12;
				$y--;
			}
		}
		else {
			while ($m > 12) {
				$y++;
				$m -= 12;
			}
		}

		if ($m == 2 and $d > 28) {
			if ($this->is_leap_year($y))
				$ndays = 29;
			else 
				$ndays = 28;

			if ($ndays == 29) {
				if ($d != 29) {
					$m++;
					$d -= 29;
				}
			}
			else {
				$m++;
				$d -= 28;
			}
		}
		elseif ($d == 31) {
			if ($m == 4 or $m == 6 or $m == 9 or $m == 11) {
				$d = 1;
				$m++;
				if ($m > 12) {
					$y++;
					$m = 1;
				}
			}
		}
		$dt = $this->copy();
		$dt->fromints($y, $m, $d);
		return $dt;
	}

	function addyears($numyears)
	{
		$y = $this->year;
		$m = $this->month;
		$d = $this->dom;

		$y += $numyears;

		if ($m == 2 and $d > 28) {
			if ($this->is_leap_year($y)) {
				$m++;
				$d -= 29;
			}
			else {
				$m++;
				$d -= 28;
			}
		}
		elseif ($d == 31) {
			if ($m == 4 or $m == 6 or $m == 9 or $m == 11) {
				$d = 1;
				$m++;
				if ($m > 12) {
					$y++;
					$m = 1;
				}
			}
		}

		$dt = $this->copy();
		$dt->fromints($y, $m, $d);
		return $dt;
	}

    // default end of week is day 5, or Friday

	function begwk($eow = 5)
	{
		$d = $this->dow;
		$bow = $eow + 1 - $d;
		if ($bow < 1)
			$bow += 7;
		$bow -= 7;
		$dt = $this->adddays($bow);
		return $dt;
	}

	function endwk($eow = 5)
	{
		$d = $this->dow;
		$bow = $eow + 1 - $d;
		if ($bow < 1)
			$bow += 7;
		$bow -= 1;
		$dt = $this->adddays($bow);
		return $dt;
	}

    // The following routines are primarly used for payroll tax form calculations

	function day_before_quarter($qtr)
	{
		switch ($qtr) {
		case 1:
			$y = $this->year - 1;
			$m = 12;
			$d = 31;
			break;
		case 2:
			$y = $this->year;
			$m = 3;
			$d = 31;
			break;
		case 3:
			$y = $this->year;
			$m = 6;
			$d = 30;
			break;
		case 4:
			$y = $this->year;
			$m = 9;
			$d = 30;
			break;
		}
		$dt = $this->copy();
		$dt->fromints($y, $m, $d);
		return $dt;
	}

	function day_after_quarter($qtr)
	{
		switch ($qtr) {
		case 1:
			$y = $this->year;
			$m = 4;
			$d = 1;
			break;
		case 2:
			$y = $this->year;
			$m = 7;
			$d = 1;
			break;
		case 3:
			$y = $this->year;
			$m = 10;
			$d = 1;
			break;
		case 4:
			$y = $this->year + 1;
			$m = 1;
			$d = 1;
			break;
		}
		$dt = $this->copy();
		$dt->fromints($y, $m, $d);
		return $dt;
	}

	function day_before_month()
	{
		$y = $this->year;
		$m = $this->month;
		$dt = $this->copy();
		$dt->fromints($y, $m, 1);
		$dt->adddays(-1);
		return $dt;

		/*
		if ($m == 1) {
			$y -= 1;
			$m = 12;
			$d = 31;
		}
		elseif ($m == 3) {
			$m = 2;
			if ($this->is_leap_year($y))
				$d = 29;
			else
				$d = 28;
		}
		else {
			$m -= 1;
			$d = $this->mdays[$m - 1];
			// $d = $this->get_days_in_month($m - 1);
		}
		$dt = $this->copy();
		$dt->fromints($y, $m, $d);
		return $dt;
		*/
	}

	function day_after_month()
	{
		$y = $this->year;
		$m = $this->month;
		$d = $this->get_days_in_month();
		$dt = $this->copy();
		$dt->fromints($y, $m, $d);
		$dt->adddays(1);
		return $dt;

		/*
		if ($m == 12) {
			$y += 1;
			$m = 1;
		}
		else {
			$m += 1;
		}
		$d = 1;
		$dt = $this->copy();
		$dt->fromints($y, $m, $d);
		return $dt;
		 */
	}

	function day_before_year()
	{
		$dt = $this->copy();
		$dt->fromints($this->year - 1, 12, 31);
		return $dt;
	}

	function day_after_year()
	{
		$dt = $this->copy();
		$dt->fromints($this->year + 1, 1, 1);
		return $dt;
	}

	/************************************************************
	 * OUTPUT ROUTINES
	 ***********************************************************/

    function get($fmt)
    {
        // error condition date:
        // (a blank input date will set year = 2000, month = 0, dom = 0)
        if ($this->month == 0 or $this->dom == 0)
            return '';

        if (strpos($fmt, 'j') !== false)
            return $this->get_jday();

        $mstr = sprintf('%02d', $this->month);
        $dstr = sprintf('%02d', $this->dom);

        $newdate = $fmt;
        $newdate = str_replace('m', $mstr, $newdate);
        $newdate = str_replace('d', $dstr, $newdate);

        if (strpos($fmt, 'Y') !== false) {
            $newdate = str_replace('Y', $this->year, $newdate);
        }
        elseif (strpos($fmt, 'y') !== false) {
            $ystr = sprintf('%02d', $this->year % 100);
            $newdate = str_replace('y', $ystr, $newdate);
        }
        return $newdate;
    }

    // DEPRECATED 2009-01-22
	function outccyymmdd()
	{
        return $this->get('Y-m-d');
	}

    // DEPRECATED 2009-01-22
	function outiso()
	{
        return $this->get('Y-m-d');
	}

    // DEPRECATED 2009-01-22
	function outmmdd()
	{
        return $this->get('m/d');
	}

    // DEPRECATED 2009-01-22
	function outmmddyy()
	{
        return $this->get('m-d-y');
	}


	/************************************************************
	 * INTROSPECTION METHODS
	 ***********************************************************/

    // If passed date is later than this date, return -1
    // If passed date is the same as this date, return 0
    // If passed date is earlier than this date, return 1
    function compare($dt)
    {
        if ($this->jday < $dt->jday)
            return -1;
        if ($this->jday == $dt->jday)
            return 0;
        if ($this->jday > $dt->jday)
            return 1;
    }

	// if this date is later than the passed date, return true, else false
	function later_than($dt)
	{
		return ($this->compare($dt) == 1) ? true : false;
	}

	// if this date is earlier than the passed date, return true, else false
	function earlier_than($dt)
	{
		return ($this->compare($dt) == -1) ? true : false;
	}

	// if passed date is same as this date, return true, else false
	function same_as($dt)
	{
		return ($this->compare($dt) == 0) ? true : false;
	}

	function isleap()
	{
		return $this->is_leap_year($this->year);
	}

	function get_year()
	{
		return $this->year;
	}

	function get_month()
	{
		return $this->month;
	}

	function get_dom()
	{
		return $this->dom;
	}

	function get_quarter()
	{
		if ($this->month >= 1 and $this->month <= 3)
			return 1;
		if ($this->month >= 4 and $this->month <= 6)
			return 2;
		if ($this->month >= 7 and $this->month <= 9)
			return 3;
		if ($this->month >= 10 and $this->month <= 12)
			return 4;
	}

	function get_month_of_quarter()
	{
		switch ($this->month) {
		case 10:
		case 7:
		case 4:
		case 1:
			return 1;
			break;
		case 11:
		case 8:
		case 5:
		case 2:
			return 2;
			break;
		case 12:
		case 9:
		case 6:
		case 3:
			return 3;
			break;
		}
	}


	// Sunday = 0
	function get_dow()
	{
		return $this->dow;
	}

	function get_jday()
	{
		return $this->jday;
	}

	function dump()
	{
		print "Jday = " . $this->jday . "<br>\n";
		print "Year = " . $this->year . "<br>\n";
		print "Month = " . $this->month . "<br>\n";
		print "DOM = " . $this->dom . "<br>\n";
		print "DOW = " . $this->dow . "<br>\n";
	}

	function get_days_in_month()
	{
		$mdays = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if ($this->month == 2) {
			if ($this->isleap())
				return 29;
			else
				return 28;
		}
		else
			return $mdays[$this->month - 1];
	}



	/************************************************************
	 * SET/GET ROUTINES
	 ***********************************************************/

    function set_get($infmt, $outfmt, $dt)
    {
        $ndt = $this->copy();
        $ndt->set($infmt, $dt);
        return $ndt->get($outfmt);
    }

    // DEPRECATED 2009-01-22
	function db2form($indate)
	{
        $ndt = new date;
        return $ndt->set_get('Y-m-d', 'm/d/y', $indate);
	}
	
    // DEPRECATED 2009-01-22
	function iso2mmddyy($indate)
	{
        $ndt = new date;
        return $ndt->set_get('Y-m-d', 'm/d/y', $indate);
	}

    // DEPRECATED 2009-01-22
	function form2db($indate)
	{
        $ndt = new date;
        return $ndt->set_get('m/d/y|m-d-y|mdy', 'Y-m-d', $indate);
	}

    // DEPRECATED 2009-01-22
	function mmddyy2iso($indate)
	{
        $ndt = new date;
        return $ndt->set_get('m/d/y|m-d-y|mdy', 'Y-m-d', $indate);
	}

};

