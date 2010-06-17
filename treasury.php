<?php
require_once('template.php');
page_header('SLUG Treasury Page');

echo <<<END
<div id="content3">
<p>
Here's where you find out what your donations buy. Below is a detailed
breakdown of the monies the group has received and what's been done with
them. If you'd like to donate money to SLUG, we have a bank account. You
may make the check out to <STRONG>SLUG</STRONG> or <STRONG>Suncoast Linux
Users Group</STRONG>. If you can't attend meetings and but would like to
donate to the group, you may write a check (as above) and send it to:
<P>
<STRONG>
SLUG<BR>
c/o Quill & Mouse Studios, Inc.<BR>
1901 N. Highland Ave.<BR>
Clearwater, FL 33755<BR>
</STRONG>
<P>
Note: although no one <EM>personally</EM> benefits from your donations
(meaning we are non-profit), we are <EM>not</EM> organized as a corporation
or non-profit corporation under Florida law. Bear that in mind when making
donations.
<P>
<HR>
<P>
<hr>
END;
include('treasury.txt');
print "</div>\n";
page_footer();
?>
