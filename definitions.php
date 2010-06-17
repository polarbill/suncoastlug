<?php
require_once('template.php');
page_header('Linux Definitions');
echo <<<END
<div id="content3">
Here is a list of definitions I've created. Since technology in the computer
field changes so fast, many of these may not be found in the computer
dictionary you bought from the bookstore. On the other hand, you'll find
this list woefully incomplete. Still, I add definitions as needed. If you
would like to see a word added, <A HREF="mailto:webmaster@suncoastlug.org">
email me</A>.
<P>
If you're interested in jargon and computer terms, particularly hacker
slang, see Eric Raymond's <A HREF="http://catb.org/esr/jargon/">
jargon file</A>.
<HR>
<DL>
<P>
<A NAME="console"></A>
<DT>Console
<DD>This is one of the "text-mode" screens you get with Linux. It is similar
to the DOS prompt, and there are typically seven consoles available under
Linux. This means that you can start doing something on one console, switch
to another console to do something else, switch back, etc.
<P>
<A NAME="copyleft"></A>
<DT>Copyleft
<DD>See <A HREF="#gpl">GPL</A>. This is a hacker's pun on the word
<EM>copyright</EM>.
<P>
<A NAME="cron"></A>
<DT>Cron
<DD>Cron is a program (a <A HREF="#daemon"><STRONG>daemon</STRONG></A>) that
runs in the background on a Linux system, and
periodically does tasks you assign to it. Cron "wakes up" every second or so
and checks to see if there are any jobs for it to do, and does them. What
jobs it does are defined by a <STRONG>crontab</STRONG> files. See
<STRONG>man cron</STRONG>, <STRONG>man 1 crontab</STRONG> and <STRONG>man 5
crontab</STRONG> for more complete information.
<P>
<A NAME="daemon"></A>
<DT>Daemon
<DD>A daemon is any program that runs automatically in the background
without you having to be involved. Daemons can be created to clean up
temporary files, rebuild manual pages, etc.
<P>
<A NAME="emacs"></A>
<DT>Emacs
<DD>An editor programmed by <A HREF="#rms">Richard Stallman</A> which, unlike
<A HREF="#vi">vi</A>, is a "modeless" editor. Emacs is incredibly complex
compared to many other editors, yet is far more powerful than most other
editors. Since emacs is based on a version of the lisp programming language,
it is almost infinitely extensible. Thus emacs can be used as a scheduler,
email program, game playing environment, or any of a number of other things.
Emacs is quite a large program, especially with all the lisp files that come
with it. Vi, by contrast is quite small.
<P>
<A NAME="free_software"></A>
<DT>Free software
<DD>This term is confusing and can mean two things:
<OL>
<LI>free, as in costing nothing, and
<LI>free, as in free for your unencumbered use and distribution.
</OL>
As most people seem to understand the term "free" to be monetarily free, and
as this term has often been applied to Linux, it caused confusion. Linux may
or may not be commercially free, depending on how you obtained it. Thus, a
better term was created, <A HREF="#open_source">"Open Source"</A>. This
made clear the type of "free"
meant when applying the term to Linux.
<P>
<A NAME="fsf"></A>
<DT>Free Software Foundation (FSF)
<DD>An effort by Richard Stallman (often referred to as "rms") to promote
free software. In this sense, Stallman means both monetarily free, and also
free of the licensing encumberances of commercial software. The FSF is
responsible for the <A HREF="#gnu">GNU Project</A>, the <A HREF="#gpl">GNU
Public License</A>, and much of the software that comes with Linux
distributions.
<P>
<A NAME="gnu"></A>
<DT>GNU
<DD>This stands for "GNU's Not Unix". This is a project by the Free Software
Foundation to produce a "free" Unix-like environment, in contrast to the
commercial (and expensive) Unixes. Most of the basic
utilities that come with Linux distributions are GNU utilities-- programs
originally appearing under
commercial Unixes, but recoded under the <A HREF="#gpl">GPL</A>. This fact
has led Richard Stallman to insist that Linux be called "GNU/Linux", since
only the kernel of Linux is truly "Linux".
<P>
<A NAME="gpl"></A>
<DT>GNU public license (GPL)
<DD>This is a license for software whose provisions chiefly include the
following:
<OL>
<LI>You must have access to the source code of the program;
<LI>You have to right to modify the source code as you like;
<LI>You are free to give away or sell the program;
<LI>You may not prevent anyone else from distributing either the original
code or your modifications.
</OL>
<P>
<A NAME="gui"></A>
<DT>GUI
<DD>GUI is an acronym for "graphical user interface". This is like Microsoft
Windows, with icons, buttons, dialog boxes, etc. Compare
<A HREF="#console">console</A>.
<P>
<A NAME="hacker"></A>
<DT>Hacker
<DD>Contrary to the popular press, a hacker is not a person who breaks into
other people's computer systems. That is a <STRONG>cracker</STRONG>. A
hacker could be said to be a consummate programmer, someone who has earned
the respect of his fellows by programming well or coming up with an elegant
way of programming a computer to do a certain job. For programmers, being a
hacker is a great honor, and it can only be bestowed upon you by another
hacker. <STRONG>Crackers</STRONG> are also often <STRONG>hackers</STRONG>,
but their intent and nefarious activities put them into a different category.
<P>
<A NAME="init"></A>
<DT>Init
<DD>Init is the first program that the kernel runs. It cycles through a
series of scripts to start various processes running on your machine. Every
process on the machine is given a unique process number, and the process
number of <STRONG>init</STRONG> is 1.
<P>
<A NAME="kernel"></A>
<DT>Kernel
<DD>The <STRONG>kernel</STRONG> is the central program of any operating
system. This is the program that talks directly to the hardware of the
computer. Other programs make requests of the kernel to get something done
on the computer. For instance, in order to put a character on the computer
screen, a program must ask the kernel to put a certain character in a
certain place on the display screen. (There are exceptions to this, but in
general, all communication to the computer hardware goes through the
<STRONG>kernel</STRONG>.
<P>
<A NAME="open_source"></A>
<DT>Open Source
<DD>Simply put, this is software which includes source code for your use or
modification. Open Source is often released under the <A HREF="#gpl">GNU
Public License</A>, but may be released under similar licenses.
<P>
<A NAME="oss"></A>
<DT>Open Source Software (OSS)
<DD>Software that is licensed under an <A HREF="#open_source">open source</A>
license.
<P>
<A NAME="rms"></A>
<DT>Stallman, Richard (rms)
<DD>The originator of the <A HREF="#fsf">Free Software Foundation</A> and
programmer of various Unix programs, including Emacs. Stallman's views on
software (price and licensing) are quite radical, and he uses any public
forum to expound on those views.
<P>
<A NAME="linus"></A>
<DT>Torvalds, Linus</DT>
<DD>Linus Torvalds is the person who originated and still maintains the
Linux <A HREF="#kernel">kernel</A>. He started this when he was a university
student in Finland.
<P>
<DT>VC
<DD>See <A HREF="#console">console</A>
<P>
<A NAME="vi"></A>
<DT>Vi
<DD>Vi is a very simple, yet powerful, editor. Unlike
<A HREF="#emacs">emacs</A>, which is a "modeless" editor, vi uses "modes". That
is, at any point in an editing session, you may be in <EM>insert</EM> mode,
<EM>command</EM> mode, etc. While in a certain mode, there are many things
you cannot do. You may have to exit the mode you are in, and re-enter a
different mode to do those things. While not as powerful as emacs, vi is
probably the most universally available editor on all Unix/Linux platforms.
Part of the reason for this is its small size.
<P>
<DT>Virtual Console
<DD>See <A HREF="#console">console</A>
<P>
<A NAME="xwindow"></A>
<DT>X-Window
<DD>This is the <A HREF="#gui">graphical user interface</A> for Linux. This
is a generic name for this. In fact, the X-Window system consists of two
parts: the X-Window server and one or more X-Window clients. The server is
like the operating system for the clients; they can only get anything done
by asking the server to do it. The clients can be anything from spreadsheets
to games.
<P>
<DT>XFree86
<DD>This is main <A HREF="#open_source">open source</A> X-Window server
for Linux. There are other X-Window servers, but this is the primary one
that ships with Linux distributions.
</DL>
</div>
END;
page_footer();
?>