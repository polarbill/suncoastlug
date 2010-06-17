<?php
require_once('template.php');

function process_content()
{
	$to = 'jobs@suncoastlug.org';
	// $to = 'paulf@sherman.mars.lan';

	$jobname = preg_replace("%[^a-zA-Z0-9 \!-/]%", "", $_POST['jobname']);
	$jobname = preg_replace("%[\$]%", "", $jobname);
	$descrip = preg_replace("%[^a-zA-Z0-9 \!-/]%", "", $_POST['descrip']);
	$descrip = preg_replace("%[\$]%", "", $descrip);
	$contact = preg_replace("%[^a-zA-Z0-9 \.\!-/]%", "", $_POST['contact']);
	$contact = preg_replace("%[\$]%", "", $contact);
	$phone = preg_replace("%[^0-9\.\-\ Xx]%", "", $_POST['phone']);
	$email = preg_replace("%[^a-zA-Z0-9\.\-\_\@\+]%", "", $_POST['email']);
	$longdesc = preg_replace("%[^a-zA-Z0-9:,@&\n \.\?\!-/]%", "", $_POST['longdesc']);
	$requires = preg_replace("%[^a-zA-Z0-9:,@&\n \.\?\!-/]%", "", $_POST['requires']);
	$requires = preg_replace("%[\$]%", "", $requires);

	$formdata = "===== Start of job posting =====";
	$formdata .= "\nJob:            $jobname";
	$formdata .= "\nDescription:    $descrip";
	$formdata .= "\nContact:        $contact";
	$formdata .= "\nPhone:          $phone";
	$formdata .= "\nEmail:          $email";
	$formdata .= "\n\nLong Descrip:   $longdesc";
	$formdata .= "\n\nRequirements:   $requires";
	$formdata .= "\n===== End of job posting =====";

	mail( $to, "Job Posting", $formdata, "Reply-To: $realname <$email>\nX-Mailer: PHP/" . phpversion() );
}

function ack_user()
{
echo <<<ENDACK
<CENTER>
<H1>
Thanks For Your Job Offer!
</H1>
</CENTER>
Within 24 hours, your job posting should go up on the
<a href="http://www.suncoastlug.org/jobs.php">Jobs</a> page. Your job offer
will expire in <bold>one week</bold>. If you have comments or questions,
see the link below.
<IMG SRC="./sluglogo.gif" ALT="Suncoast Linux Users Group" HEIGHT=167 WIDTH=450>
ENDACK;
}

page_header('Job Posting Form');
print "<div id=\"content3\">\n";

if ($_POST['stage'] == 'jobpost' and $_POST['seccode'] == $_POST['check']) {
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
Job Postings
</H1>
</CENTER>
<P>
This is where you, as an employer or agent for employers, get to advertise
your jobs openings to the Linux community of the Tampa Bay area. For now, the
cost is free. SLUG makes these job announcements available as a service to
its members.
<P>
Please fill out the form below to have your job posting listed on the SLUG
<a href="http://www.suncoastlug.org/jobs.html">Jobs</a> page. Your request
for posting will be reviewed, and if accepted, will appear on the Jobs page
within 24 hours. Please note: <I>your job posting will expire in <bold>one
week</bold></i>.
<p>
<HR>
<P>
<FORM ACTION="./jobpost.php" METHOD=POST>
<B>Title or Name of Position
</B>
<BR>
<INPUT TYPE="text" NAME="jobname" SIZE=50>
<P>
<B>
Short Description
</B>
<BR>
<input type="text" name="descrip" size=50>
<P>
<B>
Long Description
</B>
<BR>
<TEXTAREA NAME="longdesc" ROWS=8 COLS=65 WRAP=VIRTUAL></TEXTAREA>
<BR>
<B>
Requirements
</B>
<BR>
<TEXTAREA NAME="requires" ROWS=8 COLS=65 WRAP=VIRTUAL></TEXTAREA>
<P>
<B>
Contact Person
</B>
<BR>
<input type="text" name="contact" size=50>
<P>
<B>
Phone Number
</B>
<BR>
<input type="text" name="phone" size=50>
<P>
<B>
Email Address
</B>
<BR>
<input type="text" name="email" size=50>
<P>
<P><b>Enter security code: <font color="RED">$rpass</font></b>&nbsp;
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
<input type="hidden" name="stage" value="jobpost">
</FORM>
<P>
END;
}

print "</div>\n";
page_footer();
?>
