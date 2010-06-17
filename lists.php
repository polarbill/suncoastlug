<?php
require_once('template.php');
page_header('SLUG Lists');

echo <<<END
<div id="content3">

The SLUG mailing lists have been created as a service to, and in support
of, members of the Suncoast Linux Users Group. <FONT COLOR="#FF0000">
Note: no one is automatically subscribed to these lists, unless you
specifically request this on your New Member Survey!</FONT>
<!-- list enumeration -->
<p>
The following lists are available to the SLUG membership at large:
<ul>
<li><a href="#slug-announce">SLUG Announce</a><br>for group announcements.
<li><a href="#slug">SLUG List</a><br>for normal technical assistance and Linux/computer-related topics.
<li><a href="#slug-politics">SLUG Politics</a><br>for topics too hot for the SLUG list.
<li><a href="#slug-digest">SLUG Digest</a><br>for a digest of the SLUG list.
<li><a href="#slug-posters">SLUG Posters</a><br>for posting messages at work.
</ul>
<p>
The <i>rules</i> for the lists are <a href="listrules.php">here</a>.
<p>
Instructions for posting, subscribing and unsubscribing are <a href="#instructions">here</a>.
<p>
To find out if you're already subscribed or unsubscribed, go <a href="#subunsub">here</a>.
<p>
To search the message archives for the SLUG and other lists, go <a href="http://slug.archives.nks.net/List/">here</a>.
(Sorry, this only goes from 10 April 2001 to the present.)
<p>
For problems you can't solve after reading over this page, go <a href="#problems">here</a>.

<!-- slug-announce -->

<h3><a name="slug-announce">The SLUG Announce List</a></h3>
<P>
This list is for meeting and group event announcements only. <b>You may
not post to this list.</b> When you sign up
as a member of SLUG, you are given the option to subscribe to this list.
<B>This may be the only way you hear about meetings.</B>
<p>
To <b>subscribe</b> or <b>unsubscribe</b>, follow the
<a href="#instructions">instructions</a>.
<p>

<!-- slug list -->

<P>
<h3><a name="slug">The SLUG Mailing List</a></h3>
This is the main list for SLUG members.
The primary purpose of this list is primarily to provide mutual assistance
to SLUG members with technical questions. See the <a
href="listrules.php">rules</a> for more information about what is and isn't
allowed.
<p>
To <b>subscribe</b>, <b>unsubscribe</b> or <b>post</b>, see
the <a href="#instructions">instructions</a>.
<p>

<!-- slug politics -->

<h3><a name="slug-politics">The SLUG Politics List</a></h3>
<P>
This list is for topics too volatile or off topic for the main SLUG list.
There are no rules on this list, and no topic is forbidden. Even
netiquette rules don't apply. If you post
something too hot for the main SLUG list, you may be asked to move the
discussion to this list.
<p>
To <b>subscribe</b>, <b>unsubscribe</b> or <b>post</b>, follow the
<a href="#instructions">instructions</a>.
<p>

<!-- slug digest -->

<h3><a name="slug-digest">The SLUG Digest List</a></h3>
<p>
This is a digest of the SLUG List, generated every day or so (depending
on traffic). If you don't want to wade through individual messages on
the SLUG list, but would like to see continuing discussion, this list
is for you.
<p>
Note: The SLUG Digest list does not allow posting. And owing to the
problems attendant when people try to reply to posts from digests, we
request that you don't snip parts of the SLUG Digest and reply to them
on the SLUG List.
<p>
To <b>subscribe</b> or <b>unsubscribe</b>, follow the
<a href="#instructions">instructions</a>.
<p>

<!-- slug-posters -->

<h3><a name="slug-posters">SLUG Posters</a></h3>
<p>
This list is for second (or third) addresses from which you'd like to post
mail, aside from your main address. This list does not <i>receive</i>
mail-- that's for your main SLUG List address. But it does allow you to
<i>post</i> from an additional address (say, at work).
<p>
To <b>subscribe</b> or <b>unsubscribe</b> or <b>post</b> follow the
<a href="#instructions">instructions</a>.
<p>

<a name="instructions"></a>

<!-- unsub instructions -->

<h3><a name="subscribe">How To Subscribe</a></h3>
Send an email to:<BR>
<P>
<A HREF="mailto:majordomo@nks.net">majordomo@nks.net</A><BR>
<P>
In the <STRONG>body</STRONG> of the email, give the following command:<BR>
<P>
subscribe &lt;name-of-list&gt; &lt;your.email.address&gt;<BR>
<P>
where &lt;name-of-list&gt; can be <b>slug</b>, <b>slug-politics</b>,
<b>slug-announce</b>, <b>slug-digest</b> or <b>slug-posters</b>.
<p>
Or execute this command:<br>
<pre>
echo subscribe &lt;name-of-list&gt; &lt; \
your.email.address&gt; | mail majordomo@nks.net
</pre>
<p>

<!-- unsubscribe instructions -->

<a name="unsub"><h3>How To Unsubscribe</h3></a>
Send an email to:<BR>
<P>
<A HREF="mailto:majordomo@nks.net">majordomo@nks.net</A><BR>
<P>
In the <STRONG>body</STRONG> of the email, give the following command:<BR>
<P>
unsubscribe &lt;name-of-list&gt; &lt;your.email.address&gt;<BR>
<P>
Or execute this command:<br>
<pre>
echo unsubscribe &lt;name-of-list&gt; &lt; \
your.email.address&gt; | mail majordomo@nks.net
</pre>
<p>
<font color="RED"><strong>Note: You must subscribe or unsubscribe from the address in
question, not some other address. Otherwise, you'll need to contact the
<a href="mailto:listadmin@suncoastlug.org">list administrator</a> for assistance.
</strong></font>
<p>

<!-- posting instructions -->

<a name="posting"><h3>How To Post Something</h3></a>
<p>
Send an email to <b>&lt;name-of-list&gt;@nks.net</b>.
<p>

<!-- subscribing/unsubscribing -->

<a name="subunsub"><h3>Am I already subscribed/unsubscribed?</h3></a>
To find out if you're already subscribed, or have been unsubscribed for some
reason, send a message to: <b>majordomo@nks.net</b>. In the <b>body</b> of
the message, say:<br>
<pre>
which &lt;your.email.address&gt;<br>
</pre>
Majordomo will respond back with a rundown of the lists to which you're
subscribed.
<p>

<!-- problems -->

<a name="problems"><h3>Problems or Comments</h3></a>
If you have problems or comments about the list, you may email the list
maintainer at <A HREF="mailto:listadmin@suncoastlug.org">listadmin@suncoastlug.org</A>.

</div>

END;
page_footer();
?>