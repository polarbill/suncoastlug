<?php
require_once('template.php');
page_header('Join&nbsp;Us');

function process_form()
{
	// preprocess content (20021221)
	$realname = preg_replace("%[^a-zA-Z\.\ ]%", "", $_POST['realname']);
	$email = preg_replace("%[^a-zA-Z\.\-\_\@0-9\+]%", "", $_POST['email']);
	$url = preg_replace("%[^a-zA-Z0-9\.\-\_/\:]%", "", $_POST['url']);
	// platform is a fixed choice
	// distribution is a fixed choice
	// kernel is a fixed choice
	// hear is a fixed choice
	// attend is a fixed choice
	// announce is a fixed choice
	// list is a fixed choice
	$do = preg_replace("%[^a-zA-Z0-9 \!-/\?]%", "", $_POST['do']);
	$do = preg_replace("%[\$]%", "S", $do);
	$other = preg_replace("%[^a-zA-Z0-9 \!-/\?]%", "", $_POST['other']);
	$other = preg_replace("%[\$]%", "S", $other);
	$formdata = "Name:         $realname";
	$formdata .= "\nEmail:        $email";
	$formdata .= "\nURL:          $url";
	$formdata .= "\nPlatform:     $_POST[platform]";
	$formdata .= "\nDistribution: $_POST[distribution]";
	$formdata .= "\nKernel:       $_POST[kernel]";
	$formdata .= "\nReferred:     $_POST[hear]";
	$formdata .= "\nAttend:       $_POST[attend]";
	$formdata .= "\nAnnounce:     $_POST[announce]";
	$formdata .= "\nList:         $_POST[list]";

	$formdata .= "\nWant/Need:\n\n$do\n";
	$formdata .= "\nOther:\n\n$other\n";
	mail( "newmembers@suncoastlug.org", "New Member Survey", $formdata, "Reply-To: $realname <$email>\nX-Mailer: PHP/" . phpversion() );
$letter = "Welcome to the Suncoast Linux Users Group!\n\n";
$letter .= "Thanks for filling out the new member survey. There are some \"privileges\"\n";
$letter .= "of SLUG membership you might want to take advantage of:\n\n";
$letter .= "Our web site is at www.suncoastlug.org\n\n";
$letter .= "There you'll find the latest news and information about SLUG. You'll  also\n";
$letter .= "find links to other Linux sites, lists of books to read, and even a short\n";
$letter .= "FAQ section.\n\n";
$letter .= "There are also SLUG mailing lists, which will keep you informed about\n";
$letter .= "the group, and give you a place to ask questions between meetings. Newbies\n";
$letter .= "are welcome! You can subscribe to them via the web site, on the lists page:\n";
$letter .= "www.suncoastlug.org/lists.php.\n\n";
$letter .= "Please note: No one is automatically subscribed to either of these lists.\n";
$letter .= "If you filled out the New Member Survey and requested to be notified of\n";
$letter .= "meetings, a request will be made to the list server to add your name as\n";
$letter .= "a subscriber.\n\n";
$letter .= "We have several monthly meetings at various places and times. See\n\n";
$letter .= "http://www.suncoastlug.org/meetings.php\n\n";
$letter .= "for full information. Feel free to bring your machine to meetings, if you'd\n";
$letter .= "like help with something. But remember to back everything up first!\n\n";
$letter .= "There are no dues for being a SLUG member, and you're not obligated to\n";
$letter .= "attend meetings. However, you are advised to subscribe to the mailing\n";
$letter .= "lists. They are not very high traffic, and they'll will keep you in touch\n";
$letter .= "with the group.\n\n";
$letter .= "If you have any questions or suggestions feel free to e-mail me at\n";
$letter .= "president@suncoastlug.org or link from any of our web pages.\n\n";
$letter .= "Again, thanks!\n\n";
$letter .= "Paul M. Foster\nSLUG President\n\n";
	mail( $email, "Welcome to SLUG!", $letter,
	"Reply-To: newmembers@suncoastlug.org\nX-Mailer: PHP/" . phpversion() );
}

if ($_POST['stage'] == 'newmember' and $_POST['seccode'] == $_POST['check'] ) {
	process_form();
	print "<H3>Thanks for submitting your survey!</h3>\n";
}
else {

print "<div id=\"content1\">\n";

	if ($_POST['seccode'] != $_POST['check']) {
		print "<font color=\"red\"><h2>SECURITY CODE DOESN'T MATCH.</h2></font>\n";
	}

echo <<<END
<CENTER>
<H3>
What is SLUG?</H3></CENTER>
The Suncoast Linux Users Group (SLUG) is a group of Linux users in
the Greater Tampa Bay area who have a common interest in Linux, and everything
related to supporting Linux and Linux users.
<BR>
<CENTER>
<H3>
Why join SLUG?</H3></CENTER>
There are many reasons to join the Suncoast Linux Users Group!
<UL>
<LI>
It doesn't cost anything (so far).</LI>
<LI>
You help the effort to make Linux a major contender against those "Goliath"
operating systems.</LI>
<LI>
You get to participate in any special offers that SLUG can arrange for
its members.</LI>
<LI>
You get the help and support of other members.</LI>
<LI>
You might even learn something!</LI>
</UL>
</div>
<div id="content2">
<CENTER><H3>How do I join SLUG?</H3></CENTER>
We ask only one thing: just fill out our <A HREF="#newmember">New Member
Survey</A>. We ask you a few questions, like your name and email address,
what the group can do for you, and we send you a confirmation. We add your
name to our list (which is only used internally for announcements of group
events and such). And, though participation is how you'll get the most
out of any group membership, you're not obligated to come to meetings or
subscribe to the SLUG mailing list. It's up to you!
<BR>
<CENTER><H3>Can I volunteer?</H3></CENTER>
Heck yes! We can always use volunteers to help out with one thing or another.
Just fill out the <A HREF="./volunteer.php">Volunteer Form</A>,
and we'll keep it on file until we need your help.
<BR>
</div>
<div id="content3">
<hr>
<a name="newmember"></a>
<H3>
Join Us!
</H3>
<P>
Please note: Although it is unlikely
that you will experience any problems responding to this form, certain
non-standard browsers will not respond properly. If you experience any
difficulties, (or if you are not using a forms-capable browser) you can
email <A HREF="mailto:newmembers@suncoastlug.org">newmembers@suncoastlug.org</A>
with the basic info.
<P>
In order to join SLUG, we need some basic information about you - like
your name and e-mail address so we know who's on our membership list and
where to send SLUG announcements. The only fields that are mandatory are
<B>Name</B> and <B>email address</B>. In order to make SLUG more responsive
to the needs of its members, we ask that you complete the rest of the form.
<P>
We do not have any dues - everything is Dutch-treat. We do, from time to
time, give away t-shirts and bumper stickers at meetings, if Linux vendors
are kind enough to supply them to us.
<P>
<HR>
<P>
<FORM ACTION="./join.php" METHOD=POST>
<B>Name</B> (required)
<BR>
<INPUT TYPE="text" NAME="realname" SIZE=50>
<P>
<B>
Email address
</B> (required)
<BR>
<input type="text" name="email" size=50>
<P>
<B>Home page URL</B>
<BR>
<input type="text" name="url" size=50>
<BR>
<B>
What's the main computer platform you are using for Linux?
</B>
<BR>
<SELECT NAME="platform">
<OPTION>Intel x86 (IBM-PC)
<OPTION>Laptop
<OPTION>Mac
<OPTION>PowerPC
<OPTION>Alpha
<OPTION>SPARC
<OPTION>S390
<OPTION>Other
</SELECT>
<P>
<B>
Which Linux distribution do you prefer most?
</B>
<P>
<SELECT NAME="distribution">
<OPTION>Debian
<OPTION>Red Hat/Fedora
<OPTION>Ubuntu/Xubuntu/Kubuntu
<OPTION>TurboLinux
<OPTION>Mandrake/Mandriva
<OPTION>Slackware
<OPTION>SUSE Linux
<OPTION>Yellow Dog
<OPTION>Gentoo
<OPTION>Xandros
<OPTION>Lindows
<OPTION>Other
<OPTION>Distribution? I roll my own!
</SELECT>
<P>
<B>
Which version of the Linux kernel do you mainly run?
</B>
<P>
<SELECT NAME="kernel">
<OPTION VALUE="2.6">2.6.X
<OPTION VALUE="2.5">2.5.X
<OPTION VALUE="2.4">2.4.X
<OPTION VALUE="2.3">2.3.X
<OPTION VALUE="2.2">2.2.X
<OPTION VALUE="2.1">2.1.X
<OPTION VALUE="2.0">2.0.X
<OPTION VALUE="1.X">1.X.X
<OPTION VALUE="0.X">0.X.X
<OPTION VALUE="Unknown">Don't know
</SELECT>
<P>
<B>
How did you hear about SLUG?
</B>
<P>
<SELECT NAME="hear">
<OPTION>Friend/Associate
<OPTION>Search Engine
<OPTION>Another site
<OPTION>Newspaper/Magazine
<OPTION>SLUG Member
<OPTION>Other
</SELECT>
<P>
<B>
Do you want to attend SLUG meetings?
<BR>
And if so, what is the best day and time?
</B>
<BR>
<SELECT NAME="attend">
<OPTION VALUE="Tampa">Second Tuesday evening in Tampa
<OPTION VALUE="StPete">Last Monday evening in St Petersburg
<OPTION VALUE="None">Can't attend :-(
</SELECT>
<P>
<STRONG>
Would you like to be <font color="RED"><EM>subscribed</EM></font>
to the SLUG Meeting
Announcements List,
so you can hear about meetings in advance?<BR>
(Only meetings and group event announcements go on this list.)<BR>
</STRONG>
<BR>
<SELECT NAME="announce">
<OPTION VALUE="No">No
<OPTION VALUE="Yes">Yes
</SELECT>
<P>
(Note: It may take up to 24 hours to complete your subscription request.)
<P>
<STRONG>
Would you like to be <font color="RED"><em>subscribed</em></font>
to the main SLUG email list? This list is for technical questions and Linux
news. Note: this is a <font color="RED"><em>high traffic</em></font> list.</br>
</strong>
<br>
<select name="list">
<option value="No">No
<option value="Yes">Yes
</select>
<P>
(Note: It may take up to 24 hours to complete your subscription request.)
<P>
<B>
What do you want SLUG to do for you?
<BR>
What are you willing to do for SLUG?
</B>
<BR>
<TEXTAREA NAME="do" ROWS=8 COLS=65 WRAP=VIRTUAL></TEXTAREA>
<P>
<B>
Any other comments?
</B>
<BR>
<TEXTAREA NAME="other" ROWS=8 COLS=65 WRAP=VIRTUAL></TEXTAREA>
<P>
END;
	$rpass = randpass();
	print "<P>Enter security code: <font color=\"RED\">$rpass</font>&nbsp;";
	print "<INPUT TYPE=\"TEXT\" NAME=\"seccode\" SIZE=\"5\"><p>\n";
	print "<INPUT TYPE=\"HIDDEN\" NAME=\"check\" VALUE=\"$rpass\">\n";

echo <<<END
<TABLE WIDTH="100%">
	<TR>
		<TH ALIGN=CENTER>
			<INPUT TYPE="submit" VALUE="Join SLUG">
			<INPUT TYPE="reset" VALUE="Start over">
		</TH>
	</TR>
</TABLE>
<input type="hidden" name="stage" value="newmember">
</FORM>
<P>
<CENTER>
<H4>
This form is modified from an original created by Kendall
Grant Clark, one-time president of the <A HREF="http://www.ntlug.org">North
Texas Linux Users Group</A>, Dallas, Texas. Used with permission.
</H4>
</CENTER>

</div>
END;
}
page_footer();
?>