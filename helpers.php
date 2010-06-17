<?php
require_once('template.php');
page_header('SLUG Helpers');
echo <<<END
<div id="content3">
<p>
Since SLUG gets requests from time to time for assistance in installing,
configuring or understanding Linux, we now offer a directory of people
willing to come to you and help. All of these people are individuals, and
they charge varying rates for their assistance (it is possible that some
will offer phone assistance, and possibly even work for free, depending
on the circumstances).
<p>
(If you would like to sign up to offer Linux assistance to people, go
<a href="./su_helpers.php">here</a>.)
<hr>
<center><h2>Disclaimer</h2></center>
The Suncoast Linux Users Group (SLUG) cannot vouch for the expertise or
social skills of the people you contact from this list. None of the proceeds
from their work are paid to SLUG. We simply offer this as a list of people
who have volunteered to assist new users with Linux. If you have a dispute
over money or the quality of the work done with these individuals, you
are encouraged to take it up directly with them; SLUG cannot help you.
We are a small Linux users group, and have no provision for policing this
type of activity.
<p>
Linux Helpers in this list are presented in <b>no particular order</b>.
<hr>
END;
include('helpers.txt');
echo <<<END
</div>
END;
page_footer();
?>