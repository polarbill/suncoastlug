<?php
require_once('template.php');
page_header('Open Source');
echo <<<END
<div id="content3">
<H2><A NAME="section-1.1">Copyrights</A></H2>
<P>
<EM>Copyright</EM> is the right of a person to copy a work. This could be a book,
a magazine article, a song or whatever. Usually, the author of a work owns
the copyright to a work. He's the only one who can legally copy it. He may
sell or give away the rights to copy his work under certain conditions.
For instance, he may sell "First North American Serial Rights" to a
magazine for his novel. This means that the magazine has the right to be
the first to "serialize" his novel in their magazine, in North America.
<P>
An author of a work can grant a license to someone else that allows them
to copy his work. But a license isn't a copyright. The person with the
license only has the rights that the copyright holder grants in the
license.
<H2><A NAME="section-1.2">The Beginnings of Open Source</A></H2>
<P>
Back in the beginning of software writing, programmers didn't really care
who copied or modified their source code. In fact, they were gratified
that others were interested enough to want to do <EM>anything</EM> with it. And
they were enthusiastic when others modified their code to make it better.
<P>
When the Unix operating system was originally written at Bell Labs, the
people who worked on it felt much the same way. This is often the way it
is in places where pure research takes place. But at some point, AT&amp;T,
which owned Bell Labs, decided to make Unix proprietary and stop all the
copying and modification.
<P>
By this time, various versions of Unix had gotten out to universities and
such, and they didn't much care for AT&amp;T's policies. One such university
was the University of California at Berkeley. When AT&amp;T took Unix
proprietary, they decided to take their "pre-proprietary" code and
modify it to come up with their own Unix version, eventually called
"Berkeley Standard Distribution" or "BSD".
<P>
Eventually, Unix flavors appeared on most major hardware platforms, and
each version was proprietary, owned by the company that created it, and
suited to run only on their proprietary hardware.
<H2><A NAME="section-1.3">The GNU Project and Free Software Foundation</A></H2>
<P>
In the 1980's, Richard Stallman, a former fixture at MIT, became
frustrated with the proprietary nature of Unix and software in general. He
wanted to come up with a version of Unix that wasn't proprietary. So he
started the GNU Project. GNU stands for "GNU's Not Unix", a typical piece
recursive hacker humor. The idea behind the GNU Project was to create an
operating system (building on the work, but not the code of Unix) which
was free, instead of being proprietary.
<P>
Because he couldn't find a free compiler to work with, Stallman first
wrote a compiler. Then he wrote an editor, now known as Emacs. Eventually,
he and others went on to write "free" versions of most of the utilities
commonly used in the Unix world. And eventually, the "Free Software
Foundation" was formed to support the GNU Project. As time went on, more
and more pieces of Unix-like software were created by the GNU Project. The
one thing missing was the kernel, the one piece that was necessary to have
a complete operating system.
<P>
Stallman also consulted with lawyers to come up with a licensing scheme
that would force GNU Project software and programs built on it to be free
and remain free. By "free", Stallman meant that you could run the program
when, where and how you saw fit; that you could modify the program, which
meant you had to have access to the source code; and that you had the
freedom to distribute copies of the original program and modified versions
of it as you saw fit. It's important to understand that Stallman
<b><i>didn't</i></b>
mean "free" as in no money. His license was called the GNU Public License.
It's also known as <EM>copyleft</EM>, a play on "copyright" and another example
of hacker humor.
<H2><A NAME="section-1.4">Linux</A></H2>
<P>
In 1991, Linus Torvalds, a university student from Finland, decided to
build his own operating system (called Linux), eventually based on Unix.
Because he did not use any Unix source code, he could do anything he
wanted with it. It looked and worked like Unix, but it wasn't the
proprietary Unixes that came before. (In effect, Linus "reverse
engineered" Unix. Remember that when you hear about legislation which
seeks to stop the practice of reverse engineering, like the current UCITA
legislation.) What Linus was writing (with the help of many others) was
the <EM>kernel</EM>, the one thing the GNU Project was missing.
<P>
The code Linus and others wrote was copyrighted by them, but Linus wanted
to make it possible for others to copy, improve and redistribute the code.
Linus needed a license that allowed that. He discovered the GNU Public
License (GPL) and decided that would be the correct license for the Linux
kernel.
<P>
Today, a basic Linux distribution is composed of the Linux kernel and
software from the GNU Project, as well as a considerable amount of
software from other sources. Richard Stallman insists that what we know
of as Linux today actually be called "GNU/Linux". But Stallman is most
often seen as a radical, and few actually agree with him on this.
<H2><A NAME="section-1.5">Open Source</A></H2>
<P>
The Linux kernel and the GNU Project software that goes with it were
originally called "free software", because that's what Stallman called
them. In a way it's an accurate name. The problem is that the word "free"
has multiple meanings in English, one of which is "something which is
given or received with no monetary compensation." This meaning is the
meaning most people assign to free. But if you've ever bought a Linux
distribution, you know that it isn't "free" in this sense. Perhaps more
important, things which are "free" in this sense are often seen as
having no real worth, or "worthless". This isn't a good thing for Linux or
other programs that are licensed this way.
<P>
In the late 1990's, worldwide attention began to be focused on Linux and
software that ran under it. The "free software" label was becoming a
problem because its meaning was confusing. As a result, a group of people
in the Linux community came up with the term <EM>Open</EM> <EM>Source</EM> to describe
Linux and software like it. This avoided the problems with the word
"free", but annoyed people like Stallman, who insisted that the word
"free" be interpreted in terms of <EM>freedom</EM>, not money. But Open Source
was a good marketing term, and it stuck, especially in the press.
<H2><A NAME="section-1.6">What Open Source Means</A></H2>
<P>
Along with the term <EM>Open</EM> <EM>Source</EM>, a definition was created for what
could be called "Open Source". Remember that "free software" and "Open
Source" have nothing to do with copyrights. Authors still own the
copyrights to their programs. These terms have to do with the <EM>license</EM>
under which software can be copied and modified. Actually, the Open Source
definition describes what a software license must be like to be considered
"Open Source". It can be paraphrased as follows (see the exact definition
for the "legalese"):
<OL>
  <LI> You can give away or sell the software by itself or as part of a larger
distribution, and you don't have to pay for the privilege.
  <LI> You have to include source code, or allow some easy way to get it.
  <LI> You can modify the software, and you're allowed to distribute them on
the same terms as the original license. (Notice you're not forced to, but
allowed to.)
  <LI> If the license doesn't allow you to directly modify the source code,
it must allow you to use "patch" files instead.
  <LI> No matter who you are, what you believe or what you do, the license
applies to you. For example, if you work for an abortion clinic or a
"right to life" group, the license can't restrict your use, modification
or distribution of the software either way.
  <LI> No one you give or sell the program to has to sign any additional
license to have the same rights you do.
  <LI> Even if the software is part of a distribution of software, the license
applies only to that piece of software.
  <LI> Conversely, the license can't specify licensing terms for other
software that may be included in a distribution.
</OL>
<H2><A NAME="section-1.7">The GNU Public License (GPL)</A></H2>
<P>
The most common Open Source license is the GPL, which is what most of the
software on Linux distributions is based on. The GPL fits the definition
of and Open Source license, but adds some twists:
<OL>
  <LI> You must include a notice that there is no warranty on the software.
  <LI> If you change the software, you must say you did so and when.
  <LI> You can't take modifications "private". Modifications must be
distributed under the GPL.
  <LI> You can't make a GPL program part of a "proprietary" program.
  <LI> If you sell or give away the program, the recipient can do the same.
</OL>
<H2><A NAME="section-1.8">Library GNU Public License (LGPL)</A></H2>
<P>
The LGPL is derived from the GPL, but applies to software libraries. It
allows libraries under its license to be incorporated into proprietary
products. You can turn an LGPL'd program into a GPL'd one, but then
neither that program nor anything derived from it can be converted back to
<STRONG>LGPL.</STRONG>
<H2><A NAME="section-1.9">Other Open Source Licenses</A></H2>
<P>
Various other Open Source Licenses exist, most of which are less rigorous
than the GPL.
<P>
<EM>The</EM> <EM>Artistic</EM> <EM>License</EM> doesn't allow sale of the program, but allows
you to add a program to this program and sell the bundle. It also requires
that modified software be free, but allows you to add link another program
to the original software and take the whole thing "private". Because of
its sizable loopholes, the Artistic License is seldom used anymore.
<P>
<EM>The</EM> <EM>BSD</EM> <EM>License</EM> is also less restrictive than the GPL, and most
notably allows modifications to be taken "private". In fact, you can sell
binary versions of the program without source, and under a different
license. The Open Source definition does not require that modifications
have the same license as the original code.
<P>
There are quite a few other variants. You're encouraged to go to
<A HREF="http://www.opensource.org">http://www.opensource.org</A> to check out the actual definition and copies of
many Open Source licenses.
<H2><A NAME="section-1.10">What Does Open Source Mean To Joe L. User?</A></H2>
<P>
Open Source software actually means a lot of things to the average user,
whether he or she knows it or not.
<P>
It means that you can sell or give the software away to anyone you like.
<P>
It typically means you don't pay a lot for the software. Anyone else with
the same software can <EM>give</EM> you a copy of it, for that matter.
<P>
It means that if something's wrong with the software, you can report it
and have it fixed, usually much faster and with less complication than
with "commercial" software.
<P>
It means no one can take control of the software, "embrace and extend"
it to make it incompatible, and then force you to use their version.
<P>
It means that usually hundreds of people have seen, pored over, and fixed
bugs in the code, making it more stable than much "commercial" code.
<H2><A NAME="section-1.11">What Does Open Source Mean To J. Random Hacker?</A></H2>
<P>
J. Random Hacker gets all the benefits of Joe User, and then some:
<P>
If you don't like the way the program works, or you want to make it work
differently, you're welcome to change it.
<P>
You can sell or give away your changed program.
<H2><A NAME="section-1.12">How Does Commercial Software Compare?</A></H2>
<P>
Much commercial software is high quality. Some of it is even better than
Open Source software. However...
<P>
If it doesn't work the way you want, you can't change it. You can suggest
changes that may or not get rolled into the next version.
<P>
You'll probably have to wait months or years for the next version.
<P>
You can't give the software to your friends. In some cases, you can't even
make backup copies. And you can't resell it.
<P>
If there's a bug in the software, you can report it and hope it gets fixed
in the next version, similar to normal modifications.
<P>
You have no control over the company who made the software. They can do
what they want, including sell out to another company that drops the
software.
<H2><A NAME="section-1.13">Commercial Versus Open Source Software</A></H2>
<P>
All this isn't to say that "commercial" software is all bad and Open
Source software is all good. Sometimes there is no better alternative than
commercial software. And some companies do a good job of listening to
their customers and fixing bugs and adding capabilities (though probably
not as fast as you'd like). And in the end, many companies operate on the
business model that what they are selling is software, and the profit
comes from the software. Open Source software can't work in that kind of a
business model.
<P>
Open Source software has a lot of benefits, as detailed above. Since a lot
of people aren't getting paid a lot of money to write it, sometimes
program quality lags behind commercial software. And very few people turn
a profit selling it. Most people who write it do so because they want to,
not because they're getting paid to. In order to make Open Source software
work as a business, you have to sell support or something besides the
software itself.
<P>
But in the end, it comes down to Stallman's idea of "free", as in
"freedom". Open Source software gives you freedom that commercial software
simply can't.
<P>
<h2><a name="section-1.15">Controversy</a></h2>
<p>
Richard Stallman and the <a href="http://www.fsf.org">Free Software Foundation</a>
take issue with the use of the term "Open Source". Open Source is a term coined
up by Eric S. Raymond and others a few years ago in an attempt to overcome the
confusing use of the word "free" in the term "free software". It was felt at the
time that the use of the term "free software" was confusing for businesses, and
didn't play well as a marketing term. Thus the coining of the term "Open Source".
However, Stallman believes the term "Open Source" doesn't fully encompass the
freedoms and philosophy and politics of "free software". Moreover, Stallman has
a decidedly political and moral view of proprietary and free software, which
the "Open Source" camp do not share. It's doubtful that this controversy will
ever be resolved by all those involved.
<p>

<H2><A NAME="section-1.14">Notes And Acknowledgements</A></H2>
<P>
It's important to note that this is a <EM>summary</EM> of Open Source and Open
Source licenses. I have not presented either the Open Source definition or
licenses in detail, and I'm not a lawyer. For the exact text of the
definition and licenses, go to <A HREF="http://www.opensource.org">http://www.opensource.org</A>.
<p>
In addition, <a href="http://www.ora.com">O'Reilly</a> puts out a book called
<em>Open Sources: Voices from the Open Source Revolution</em> which contains
a wealth of information on Open Source, how it came to be, what it is, etc.
<P>
<EM>Paul M. Foster<BR>
Version 1.1</EM>
</div>
END;
page_footer();
?>