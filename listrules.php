<?php
require_once('template.php');
page_header('SLUG List Rules');

echo <<<END
<div id="content3">

<center><h3><a name="rules">The Rules</a></h3></center>
<p>
(Note: reply headers for SLUG lists are <i>munged</i>. This means that, among
other things, they insert the names of the lists on the subject lines before
your subject. Likewise, we add a "Reply-To" back to the list on all
emails. The wisdom of these issues is much-debated, and we have chosen
to do it this way for what we believe are very good reasons. Please don't argue
the point with us.)
<p>
<center><h3><a name="challenge">A Note About Challenge-Response Systems</a></h3></center>
A recent development on the internet is <i>challenge-response email systems</i>.
These are systems to prevent spam, where your email system gets an email from
someone you don't know, and your email system sends out an email asking them to
verify who they are. When they respond (if they do), the original mail, and any future
emails from this person, comes through to you.
Such systems are worthwhile for reducing traffic by spammers. Unfortunately, they
can play havoc with list email.
<p>
Let's say Joe sends an email to the SLUG list. Sam is a member of the SLUG list,
and so Sam should get this email. But Sam has a challenge-response system
attached to his email system. So when the email comes through from Joe, Sam's email
system sends a challenge to Joe. And there's the problem: every sender on the
SLUG list will get a single challenge from Sam's email system the first time
they send an email to the list after Sam's subscribed. You can imagine how
aggravating this could be for list members.
<p>
If you're using a challenge-response email system, there should be a way around
this: tell your email system that SLUG list email is in your <i>whitelist</i>.
This should prevent challenge emails from going out to list members when they
post to the list.
<p>
Our policy is that if you use a challenge-response system and fail to add the
SLUG list to your whitelists, and consequently list members get challenge
emails from you, we will unceremoniously unsubscribe you. And chances are,
once unsubscribed, you will not know it's happened or why, since in order to
tell you, we'd have to accept your challenge emails. Which we won't.
To you, the list will simply go dark.
<p>
<CENTER><h3>Netiquette</h3></CENTER>
Netiquette is the internet's version of manners. As on the rest of the internet,
netiquette applies here as well. Netiquette links are as
follows:
<UL>
<LI>
<A HREF="http://www.albion.com/netiquette/corerules.html">http://www.albion.com/netiquette/corerules.html</A></LI>
<LI>
<A HREF="http://www.primenet.com/~vez/neti.html">http://www.primenet.com/~vez/neti.html</A></LI>
<LI>
<A HREF="http://www.albion.com/netiquette/index.html">http://www.albion.com/netiquette/index.html</A></LI>
</UL>
<p>
The following is the mailing list charter, mailed monthly to the SLUG list.
<pre>
To: slug@nks.net
From: paulf@quillandmouse.com
Subject: Mailing List Policies
MAILING LIST POLICIES
=====================
Revised 2006-02-01 R3.0
-----------------------------------------------------
CONTENT WE ACCEPT (IN ORDER OF DECREASING BANDWIDTH):
-----------------------------------------------------
1) Technical (Linux or computer-related) questions and answers.
This is the primary reason for this list-- to provide mutual assistance to
SLUG members with technical questions.
2) Announcements of upcoming SLUG events and summaries of recent events.
Self-explanatory, though the SLUG Announce list is really the preferred
forum for announcements.
3) Official communications from SLUG officers to members of SLUG.
Self-explanatory.
4) Linux advocacy.
Self-explanatory, but remember that bandwidth on the list should primarily
be for #1 above.
5) Linux or computer related humor or news.
Humor is acceptable, so long as it is tasteful and does not chew up too
much bandwidth. Racial, religious, male- or female-chauvinist humor is not
acceptable.
6) Commercial offerings.
Allowed on a very restricted basis, as follows:
a) You may advertise your goods and services in your tagline or signature.
b) You may advertise stuff you're _giving_ away.
c) You may discuss or recommend commercial offerings by someone other than
you, your company, or some company you're connected to in some way.
Otherwise, see #6 below.
--------------------------------------------
CONTENT WE *DON'T* ACCEPT AND/OR DISCOURAGE:
--------------------------------------------
1) Flames.
Just don't. Take it off the list. Don't say something to someone in email
that you wouldn't say to their face, and don't use this list to insult
them. See the SLUG Politics list.
2) Slurs.
These may or not be part of flames. Slurs of racial, religious, or sexual
nature are unacceptable, even if you aren't flaming someone on the list.
Likewise, while we generally are not fond of certain software companies,
it really serves no purpose to refer to them by epithets. If you believe
that they deserve your contempt, express your opinion and use the actual
name of the company. See the SLUG Politics list.
3) Pornography or advertisements for it.
It's a family list, okay?
4) Politics/Religion
While we don't want to restrain anyone's right to free speech, this isn't
really the correct forum for political or religious discussion. See the
SLUG Politics list.
5) HTML email.
It is established internet policy that HTML email is unacceptable. This is
doubly true here, where our list is run by Majordomo, which "bounces" all
HTML email off the list.
6) Commercial Offerings.
If you want to advertise your wares to SLUG members, you'll need to do
it on the SLUG For Sale page, at http://www.suncoastlug.org/forsale.php.
That webpage was created for the express purpose of allowing you to offer
your goods and services to other SLUG members.
7) Job Offerings.
If you want to advertise job offerings to SLUG members, you'll need to do
it on the SLUG Jobs page, at http://www.suncoastlug.org/jobs.php. That
webpage was created for the express purpose of allowing you to promote
jobs available and targetted at SLUG members.
--------------
ADMINISTRIVIA:
--------------
Traditionally, internet list servers and admins are sensitive about useless
waste of bandwidth. You can do your part by "trimming" text in replies
that isn't pertinent to the point you wish to make. This includes
extraneous sig lines not pertinent to your communication.
This list is not "moderated". Email sent to the list is not filtered by a
person before it appears on the list. It simply goes directly to the list,
which the list admin monitors. Keep this in mind when you post something--
there's no one to stop you from saying something stupid to hundreds of
people.
However, since membership on this list is a privilege, it can be revoked
by the list administrator. The list admin may decide that your posts don't
follow these guidelines, and he or she is allowed a certain flexibility in
this. If he decides action must be taken, he may do any of the following
(in order of severity):
1) Notify you by private email of the infraction.
2) If this doesn't work, email the list regarding your conduct as a public
warning to you and others of like mind.
3) Un_subscribe you from the list.
4) Publicly announce your un_subscribing from the list.
If you believe you have been treated unfairly by the list admin, you may
appeal to the SLUG president. He will get both sides of the story and make
a decision on the matter, which is final.
</pre>
<p>
</div>
END;
page_footer();
?>