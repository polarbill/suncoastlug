<?php
function page_header($title)
{
echo <<<EOT
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>

<!-- change this to the title you want to appear in browser title bar -->

<title>$title</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

   <META HTTP-EQUIV="Reply-to" CONTENT="webmaster@suncoastlug.org">
   <META NAME="Keywords" CONTENT="linux, suncoast, user group, lug">
   <META NAME="Copyright" CONTENT="1997-2007 Suncoast Linux Users Group">
   <META NAME="GENERATOR" CONTENT="Linux, Kate, PHP">
   <META NAME="Author" CONTENT="Paul M. Foster">
   <META NAME="Description" CONTENT="SLUG Home Page">

<meta name="description" content="Homepage of Suncoast Linux Users Group (SLUG)" />
<link rel="stylesheet" href="slug.css" type="text/css" />
</head>

<body>

<!-- the title that appears in the page header -->

<div id="wrap">

<div id="header">
<div id="logo">
<img src="slug.gif" alt="The Official SLUG Logo" />
</div>

<div id="title">
$title
</div>
</div>

<div id="sidebar">

<ul id="navlist">
<li><a href="./index.php">Home</a></li>
<li><a href="./history.php">History</a></li>
<li><a href="./join.php">Join&nbsp;Us</a></li>
<li><a href="./treasury.php">Treasury</a></li>
<li><a href="./meetings.php">Meetings</a></li>
<li><a href="./lists.php">Lists</a></li>
<li><a href="./officers.php">Officers</a></li>
<li><a href="./bylaws.php">Bylaws</a></li>
<li><a href="./faq.php">FAQ</a></li>
<li><a href="./links.php">Links</a></li>
<li><a href="./definitions.php">Definitions</a></li>
<li><a href="./opensource.php">Open&nbsp;Source</a></li>
<li><a href="./books.php">Books</a></li>
<li><a href="./sponsors.php">Sponsors</a></li>
<li><a href="./email.php">Email</a></li>
<li><a href="./proscons.php">Pros&nbsp;&amp;&nbsp;Cons</a></li>
<li><a href="./jobs.php">Jobs</a></li>
<li><a href="./forsale.php">For&nbsp;Sale</a></li>
<li><a href="./helpers.php">Helpers</a></li>
</ul>

<ul id="navlist">
<li><a href="http://www.linux.org" target="_blank">Linux.org</a></li>
<li><a href="http://www.linux.com">Linux.com</a></li>
<li><a href="http://www.lwn.net">Linux&nbsp;World&nbsp;News</a></li>
<li><a href="http://www.slashdot.org">Slashdot</a></li>
<li><a href="http://www.freshmeat.net">Freshmeat</a></li>
<li><a href="http://www.kernel.org">Kernel.org</a></li>
</ul>

<ul id="navlist">
<li><a href="http://www.linuxjournal.com">Linux&nbsp;Journal</a></li>
<li><a href="http://www.linux-mag.com">Linux&nbsp;Magazine</a></li>
<li><a href="http://www.linuxgazette.net">Linux&nbsp;Gazette</a></li>
<li><a href="http://www.linux.com">Linux.com</a></li>
<li><a href="http://www.linxuformat.co.uk">Linux&nbsp;Format</a></li>
</ul>

<ul id="navlist">
<li><a href="http://www.cheapbytes.com">CheapBytes</a></li>
<li><a href="http://www.linuxcentral.com">Linux&nbsp;Central</a></li>
<li><a href="http://www.linuxcd.org">Linux&nbsp;CD</a></li>
<li><a href="http://www.osdisc.com">OS&nbsp;Disc</a></li>
</ul>

<ul id="navlist">
<li><a href="http://www.debian.org">Debian</a></li>
<li><a href="http://www.mandriva.com">Mandriva</a></li>
<li><a href="http://www.redhat.com">Red Hat</a></li>
<li><a href="http://www.slackware.org">Slackware</a></li>
<li><a href="http://www.novell.com/linux">SUSE&nbsp;Linux</a></li>
<li><a href="http://www.turbolinux.com">Turbo&nbsp;Linux</a></li>
<li><a href="http://www.knopper.net/knoppix/index-en.html">Knoppix</a></li>
<li><a href="http://www.mepis.org">Mepis</a></li>
<li><a href="http://www.ubuntu.com">Ubuntu</a></li>
<li><a href="http://www.distrowatch.com">DistroWatch</a></li>
</ul>

<!--end sidebar-->
</div>

<div id="container">

<!-- title was here -->
<!-- here is your page content -->
EOT;
}

function page_footer()
{
echo <<<EOT

<!-- end page content -->

<!-- end container -->
</div>

<div id="footer">  <br />
<a href="./snags.php">Problems or comments?</a><br>
Version 6.0 Last Updated 17 June 2010<br>
Copyright &copy; 1997-2010 by Suncoast Linux Users Group (SLUG)<br>
Linux is a trademark of Linus Torvalds<br>
<!-- Open Source is a registered certification mark of the <a href="http://www.opensource.org">Open Source Initiative, Inc.</a><br> -->
Site hosted by <a href="http://www.nks.net">Networked Knowledge Systems, Inc.</a><br>
CSS by <a href="http://www.dream-logic.com">dreamLogic</a><br>
</div>

<!-- end wrap-->
</div>

</body>
</html>
EOT;
}

function strempty($str)
{
	if (strlen(trim($str)) == 0)
		return true;
	else
		return false;
}

function bold($content)
{
	return "<b>$content</b>";
}

function red($content)
{
	return "<font color=\"red\">$content</font>\n";
}

function row_start()
{
	print "<tr>\n";
}

function row_end()
{
	print "</tr>\n";
}

function table_start($border = false, $rules = false)
{
	print "<table cellpadding=\"5\" cellspacing=\"5\"";
	if ($border)
		print " border=\"1\"";
	if ($rules)
		print " rules=\"all\"";
	print ">\n";
}

function table_end()
{
	print "</table>\n";
}

function form_start($action, $method)
{
	print "<form action=\"$action\" method=\"$method\">\n";
}

function form_end()
{
	print "</form>\n";
}

function cell($span, $content)
{
	if ($span == 1)
		print "<td>$content</td>\n";
	else
		print "<td colspan=\"$span\">$content</td>\n";
}

function rev_cell($span, $text)
{
	if ($span == 1)
		print "<td style=\"background-color: black; color: white;\">\n";
	else
		print "<td colspan=\"$span\" style=\"background-color: black; color: white;\">\n";

	print "<b>$text</b>";
	print "</td>\n";

}


function blank_cells($number)
{
	for ($i = 0; $i < $number; $i++)
		cell(1, '&nbsp;');
}

function rcell($span, $content)
{
	if ($span == 1)
		print "<td align=\"right\">$content</td>\n";
	else
		print "<td align=\"right\" colspan=\"$span\">$content</td>\n";
}

function lcell($span, $content)
{
	if ($span == 1)
		print "<td align=\"left\">$content</td>\n";
	else
		print "<td align=\"left\" colspan=\"$span\">$content</td>\n";
}

function ccell($span, $content)
{
	if ($span == 1)
		print "<td align=\"center\">$content</td>\n";
	else
		print "<td align=\"center\" colspan=\"$span\">$content</td>\n";
}


function table_head($content)
{
	print "<th>$content</th>\n";
}

// from Ralph Harmon at Olesen Logistics
function randpass()
{
	$max_chars = 5;
	$rand_pass = "";
	for ($i = 0; $i < $max_chars; $i++) {
		mt_srand((double) microtime() * 1000000);
		$rand_pass = $rand_pass . chr(mt_rand(50,57));
	}
	return($rand_pass);
}

?>
