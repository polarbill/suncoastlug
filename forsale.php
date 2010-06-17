<?php
require_once('template.php');
page_header('For Sale');
echo <<<END
<div id="content3">
(If you have goods or services you'd like to offer to Linux users in the Tampa Bay area,
go <a href="./offers.php">here</a>. SLUG will evaluate your offer, and if
approved, it should appear here within 24 hours.)
<p>
Many local companies offer Linux or computer related services. Rather than
pollute the SLUG list with these offers, we've created this page to showcase
goods and services vendors want to offer to SLUG members. Of course, SLUG can't
vouch for these companies, individuals and services. You use/purchase them at
your own risk.
<p>
END;
include('forsale.txt');
print "</div>\n";
page_footer();
?>