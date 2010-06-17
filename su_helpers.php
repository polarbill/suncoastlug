<?php
require_once('template.php');

function process_content()
{
	// vet content (20021221)
	$name = preg_replace("%[^a-zA-Z \,\.]%", "", $name);
	$email = strtolower($email);
	$email = preg_replace("%[^a-z0-9\@\.\-\_\+]%", "", $email);
	$phone = preg_replace("%[^0-9\.\-]%", "", $phone);
	$area = preg_replace("%[^a-zA-Z0-9 \!-/]%", "", $area);
	$formdata = "===== Start of helper posting =====";
	$formdata .= "\nName:            $name";
	$formdata .= "\nEmail:           $email";
	$formdata .= "\nPhone Number:    $phone";
	$formdata .= "\nArea Served:     $area";
	$formdata .= "\n===== End of helper posting =====";

	mail( "helpers@suncoastlug.org", "Helper Sign-Up", $formdata, "Reply-To: $name <$email>\nX-Mailer: PHP/" . phpversion() );
}

function ack_user()
{
echo <<<ENDACK
<CENTER>
<H1>
Thanks For Your Offer of Assistance!
</H1>
</CENTER>
Within 24 hours, your listing should go up on the
<a href="http://www.suncoastlug.org/helpers.html">Helpers</a> page.
If you have comments or questions, see the link below.
<IMG SRC="./sluglogo.gif" ALT="Suncoast Linux Users Group" HEIGHT=167 WIDTH=450>
ENDACK;
}

page_header('Helper Sign-Up Form');
print "<div id=\"content3\">\n";

if ($_POST['stage'] == 'su_helpers' and $_POST['seccode'] == $_POST['check']) {
	process_content();
	ack_user();
}
else {
	$rpass = randpass();

	if ($_POST['seccode'] != $_POST['check']) {
		print "<font color=\"red\"><h2>SECURITY CODE DOESN'T MATCH.</h2></font>\n";
	}

echo <<<END
<CENTER>
<H1>
Volunteer to Help
</H1>
</CENTER>
<P>
This is where you sign up to assist individuals (and possibly very
small companies) to install, configure and understand Linux. What rates
you charge are up to you, but it is expected that you should get paid
for your time and effort. If you wish to do this for free, you're welcome
to do so.
<p>
Naturally, SLUG doesn't vouch for your qualifications. However, you can
do us a favor by conducting yourself professionally and courteously. In
doing so, you help SLUG and Linux in general, by making a good impression.
Likewise, if some dispute arises with someone who has solicited your help,
please handle it directly with the customer. Try to prevent it from becoming
a problem for SLUG, as we don't have the facilities to resolve this type
of dispute. SLUG reserves the undisputed right to remove you from this
list if the people you consult complain to us or threaten SLUG, or if we
get complaints that your work is substandard.
<p>
Please fill out the form below to have your name added to the "Helpers"
list on the SLUG <a href="http://www.suncoastlug.org/helpers.html">Helpers</a>
page. Your request for posting will be reviewed, and if accepted, will
appear on the Jobs page within 24 hours.
<p>
Also note: Please don't use the space provided to tout your expertise or
qualifications. All the people on the list are equal as far as SLUG is
concerned, and we don't want anyone having an unfair advantage from the
start.
<p>
<HR>
<P>
<FORM ACTION="./su_helpers.php" METHOD=POST>
<B>Name
</B>
<BR>
<INPUT TYPE="text" NAME="name" SIZE=50>
<P>
<B>
Email Address
</B>
<BR>
<input type="text" name="email" size=50>
<P>
<B>
Phone Number
</B>
<BR>
<input type="text" name="phone" size=50>
<p>
<B>
Geographical Areas Served
</b>
<br>
<TEXTAREA NAME="area" ROWS=8 COLS=65 WRAP=VIRTUAL></TEXTAREA>
<BR>
<P>
<b>Enter security code: <font color="RED">$rpass</font></b>&nbsp;
<INPUT TYPE="TEXT" NAME="seccode" SIZE="5"><p>
<INPUT TYPE="HIDDEN" NAME="check" VALUE="$rpass">
<TABLE WIDTH="100%">
	<TR>
		<TH ALIGN=CENTER>
			<INPUT TYPE="submit" VALUE="Post">
			<INPUT TYPE="reset" VALUE="Start over">
		</TH>
	</TR>
</TABLE>
<input type="hidden" name="stage" value="su_helpers">
</FORM>
<P>
END;
}

print "</div>\n";
page_footer();
?>