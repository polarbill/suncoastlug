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

<p>
<center>
<b>Note: Dates and times subject to change!</b><br>
<b>Click below to see a particular month.</b>
</center>
<p>

<?php
echo "<center>$calstring</center>";
page_footer();

