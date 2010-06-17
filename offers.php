<?php
require_once('template.php');

function process_content()
{
	// vet content (20021221)
	$email = strtolower($_POST['email']);
	$email = preg_replace("%[^a-z0-9\.\@\-\_\+]%", "", $email);
	$item = preg_replace("%[^a-zA-Z0-9 \!-/]%", "", $_POST['item']);
	$item = preg_replace("%[\$]%", "S", $item);
	$descrip = preg_replace("%[^a-zA-Z0-9 \!-/]%", "", $_POST['descrip']);
	$descrip = preg_replace("%[\$]%", "S", $descrip);
	$price = preg_replace("%[^0-9\.]%", "", $_POST['price']);
	$expires = preg_replace("%[^0-9\-/]%", "", $_POST['expires']);
	$expires = preg_replace("%[/]%", "-", $expires);
	$code = preg_replace("%[^a-zA-Z0-9 \!-/]%", "", $_POST['code']);
	$code = preg_replace("%[\$]%", "S", $code);
	$contact = preg_replace("%[^a-zA-Z0-9 \!-/\.\@\_\+]%", "", $_POST['contact']);
	$contact = preg_replace("%[\$]%", "S", $contact);

	$posted = date("m/d/y");
	$formdata = "===== Start of offer =====";
	$formdata .= "\nEmail:          $email";
	$formdata .= "\nItem:           $item";
	$formdata .= "\n\nDescription:    $descrip";
	$formdata .= "\n\nPrice:          $price";
	$formdata .= "\nExpires:        $expires";
	$formdata .= "\nOfferCode:      $code";
	$formdata .= "\n\nContact:       $contact";
	$formdata .= "\n\nPosted:        $posted";
	$formdata .= "\n===== End of offer =====";

	mail( "forsale@suncoastlug.org", "Commercial Offering", $formdata, "Reply-To: $email\nX-Mailer: PHP/" . phpversion() );
}

function ack_user()
{
echo <<<ENDACK
<FONT SIZE=+2>
<CENTER>
<H1>
Thanks For Your Commercial Offering!
</H1>
</CENTER>
</FONT>
Within 24 hours, your job posting should go up on the
<a href="http://www.suncoastlug.org/forsale.html">For Sale</a> page. Your offer
will expire on the date you've provided, or <bold>one month</bold>, if you did
not provide an expiration date. If you have comments or questions,
see the link below.
<IMG SRC="./sluglogo.gif" ALT="Suncoast Linux Users Group" HEIGHT=167 WIDTH=450>
ENDACK;
}

page_header('For Sale Form');
print "<div id=\"content3\">\n";

if ($_POST['stage'] == 'offers' and $_POST['seccode'] == $_POST['check']) {
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
Commercial Offering
</H1>
</CENTER>
<P>
This is where you, as a company or individual, get to advertise your goods
and services to the Linux community of the Tampa Bay area. For now, the cost
is free. SLUG makes these commercial offerings available as a service to
its members.
<P>
Please fill out the form below to have your for sale posting listed on the SLUG
<a href="http://www.suncoastlug.org/forsale.html">For&nbsp;Sale</a> page. Your request
for posting will be reviewed, and if accepted, will appear on the For Sale page
within 24 hours. Please note: <I>your for sale posting will expire on the date
you provide, or within <bold>one month</bold> if you fail to provide an expiration.</i>.
<p>
Also note that while we cannot directly recommend you or your services to
SLUG members, we reserve the right to remove your listing here, should we
receive complaints about you or your services. This is for the protection of
SLUG and its members.
<p>
<HR>
<P>
<FORM ACTION="./offers.php" METHOD=POST>
<b>
Your email address
</b>
<br>
<input type="text" name="email" size=30>
<p>
<B>Goods or service
</B>
<BR>
<INPUT TYPE="text" NAME="item" SIZE=50>
<P>
<B>
Details
</B>
<BR>
<textarea name="descrip" rows=10 cols=65 wrap=virtual></textarea>
<P>
<b>
Price
</b>
<br>
<input type="text" name="price" size=20>
<p>
<b>
Expiration Date (mm-dd-yy)
</b>
<br>
<input type="text" name="expires" size=10>
<p>
<b>
Special Offer Code (if any)
</b>
<br>
<input type="text" name="code" size=20>
<p>
<b>
How to contact you
</b>
<br>
<textarea name="contact" rows=5 cols=65 wrap=virtual></textarea>
<p>
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
<input type="hidden" name="stage" value="offers">
</FORM>
<P>
END;
}

print "</div>\n";
page_footer();
?>