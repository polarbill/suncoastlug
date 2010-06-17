<?php
require_once('template.php');
page_header('Website Problems/Comments');

print "<div id=\"content3\">\n";

if ( $_POST['stage'] == 'snags' and $_POST['seccode'] == $_POST['check'] ) {
	// vet content (20021221)
	$name = preg_replace("%[^a-zA-Z\.\,]%", "", $_POST['name']);
	$email = strtolower($_POST['email']);
	$email = preg_replace("%[^a-z0-9\@\.\-\_\+]%", "", $email);
	// referrer is self-generating
	$comment = preg_replace("%[^a-zA-Z0-9,\. \!@:;_\-/]%", "", $_POST['comment']);
	$formdata = "Name: $name\nEmail: $email\nURL: $_POST[referrer]\n";
	$formdata .= "\nProblem or Comment: $comment\n";
	mail( "webmaster@suncoastlug.org", "Problems and Comments", $formdata, "Reply-To: $name <$email>\nX-Mailer: PHP/" . phpversion() );
	print "<TH VALIGN=TOP><CENTER><H1>Thanks for your comment!</H1></CENTER></TH>\n";
}
else {
	if ($_POST['seccode'] != $_POST['check']) {
		print "<font color=\"red\"><h2>SECURITY CODE DOESN'T MATCH.</h2></font>\n";
	}
	print "Have you found a typo or other problem on this site? Or do you just want to comment on something?\n";
	print "This is the place, just fill in the form and submit it.\n";
	print "It knows that you just came here from:<P>$HTTP_REFERER<P>\n";
	print "So you need not bother to say what page it is, unless different from this.<P>\n";
	print "Please note: Although it is unlikely\n";
	print "that you will experience any problems responding to this form, certain\n";
	print "non-standard browsers will not respond properly. If you experience any\n";
	print "difficulties, (or if you are not using a forms-capable browser) you can\n";
	print "email <A HREF=\"mailto:webmaster@suncoastlug.org\">webmaster@suncoastlug.org</A>\n";
	print "with the problem or comment, please mention which page it is in reference to.\n";
	print "<P><HR><P>\n";
	print "<FORM ACTION=./snags.php METHOD=POST>\n";
	print "<INPUT TYPE=HIDDEN NAME=\"referrer\" VALUE=\"$HTTP_REFERER\">\n";
	print "<B>Name</B> (required)<BR>\n";
	print "<INPUT TYPE=\"TEXT\" NAME=\"name\" SIZE=\"50\" MAXLENGTH=\"50\" VALUE=\"$_POST[name]\">\n";
	print "<P><B>Email address</B> (required)<BR>\n";
	print "<INPUT TYPE=\"TEXT\" NAME=\"email\" SIZE=\"50\" MAXLENGTH=\"50\" VALUE=\"$_POST[email]\"><P><P><B>\n";
	print "Problem or Comment</B><BR>\n";
	print "<TEXTAREA NAME=\"comment\" ROWS=\"8\" COLS=\"65\" WRAP=\"VIRTUAL\">$_POST[comment]</TEXTAREA><P><P>\n";
	$rpass = randpass();
	print "<P>Enter security code: <font color=\"RED\">$rpass</font>&nbsp;";
	print "<INPUT TYPE=\"TEXT\" NAME=\"seccode\" SIZE=\"5\"><p>\n";
	print "<INPUT TYPE=\"HIDDEN\" NAME=\"check\" VALUE=\"$rpass\">\n";
	print "<TABLE WIDTH=\"100%\">\n";
	print "<TR><TH ALIGN=CENTER><INPUT TYPE=\"SUBMIT\" VALUE=\"Submit it\"></TH>\n";
	print "<TH ALIGN=CENTER><INPUT TYPE=\"RESET\" VALUE=\"Start over\"></TH></TR>\n";
	print "</TABLE>\n";
	print "<INPUT type=\"hidden\" name=\"stage\" value=\"snags\">\n";
	print "</FORM>\n";
	print "<P>\n";
}

print "</div>\n";
page_footer();
?>
