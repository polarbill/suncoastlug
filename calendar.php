<?php

require_once('template.php');
include('date.php');
$today = new date;
if (!empty($_GET['date'])) {
	$today->set('Y-m-d', $_GET['date']);
}

include('events.php');
$e = new events();

$calstring = $e->generate_calendar($today);
page_header('Calendar');

?>

<iframe src="http://www.google.com/calendar/hosted/unix-people.org/embed?src=unix-people.org_0iqmvliod352fgssirjgsk66po%40group.calendar.google.com&ctz=America/New_York" style="border: 0" width="800" height="600" frameborder="0" scrolling="no"></iframe>

<?php
page_footer();

