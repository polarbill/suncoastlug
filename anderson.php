<?php
require_once('template.php');
page_header('Stuart Anderson Talk');
echo <<<END
<div id="content3">
The following is a talk given by Stuart Anderson to SLUG on 24 July 1999 at
the Dunedin meeting. Stuart works for Metro Link, but is also part of
Linux Standard Base (LSB), a group who is trying to create standards for
Linux distributions. This talk was primarily about LSB. Paul Braman taped and
transcribed Stuart's talk.
<HR>
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
Lot of people for early on a Saturday.
<P>
Let me start off by asking a couple questions because we'll probably end up
with y'all asking me several questions-- so I get my turn in first. Do
y'all generally prefer to download the source for something and build it
and run it, or just grab an RPM or DEB package and install it and just use
it?  Which ones for building it? [very few hands raised] Okay, I guess
the rest of you are also in the "I'd rather just install it and run it"?
[majority of hands raised] Have you ever grabbed an RPM and installed it
and it just didn't work? [half of the hands raised] Okay. That, in a
nutshell, is what we are trying to fix with the LSB. That, and there's
actually a couple of other things.
<P>
Linux is going through a lot of the same experiences Unix has gone through
in the past especially like SVR4 went though about 10 years ago. There was,
in the beginning, one original source of it but then several people have
gotten it and they've added it and changed it a little bit in their ways
and you've got several things with the same name but they're not quite the
same thing. Just because it runs on one doesn't mean it runs on the other.
<P>
The System V people came up with a program for dealing with this. They
called it the Application Binary Interface, or ABI, program and they used
that to define binary interfaces so if a program conforms to this it will
run across any of the other, then, flavors of SVR4. The LSB is just trying
to do the same thing but for Linux. There are a lot of things that are
a little bit different because Linux is not commercial vendors who can
afford to work on things and the motivations are all different, but it's
still bascially the same problem. And as far as ISV goes it's still the
same problem. They say, "Oh gosh, there's a bunch of different Linuxes; I'd
have to port my application and test it on all of them." Which is the same
problem that's been around for a long time. What we'd like to be able to
do is go to an ISV and say, "Do it once, this way, and we guarantee that it
works everywhere." Then suddenly it becomes a more focussed, larger, single
market instead of a bunch of similar, not-quite-the-same markets, and
that's what ISVs are looking for.
<P>
The fragmentation caused by the main distributions is happening a little
bit; I mean there's the whole glibc thing. There's libc5. There's glibc
 2.0, 2.1, 2.1.1, 2.1.2 and they're all slightly different in subtle ways.
I'm hoping we're getting to a point where it quits changing quite as much.
But what the LSB is going to have to do is just kind of nail things down
for the common stuff in glibc and say, "Okay, it's going to be this way and
it can't change any more. If you want to innovate you gotta find other
ways of doing it."
<P>
The LSB has a lot of non-technical issue that we have to deal with. We've
got a lot of goals. We can't make so many rules that it inhibits
distributions in any way. We don't want to stifle innovation. That's one
of the big things that Linux is really good at. Give somebody the source
and they'll do really strange things with it and it will be really cool.
We don't want to stop that. At the same time we do think there's some
subsets that most applications use that aren't really innovating much more.
That's like the POSIX subset, the things covered by the Single Unix
Specification, those are pretty much the same across all flavors of Linux,
Unix, BSD, everything. So that's what we're trying to sort of draw a
circle around and say, "Okay, this part is stable and you can count on
this and people implementing it better not mess with it. Go find somewhere
else to play." Distributions have concerns about remaining backwards
compatible with themselves, so that's another thing that we've got to work
around as well.
<P>
In the early discussions about a year ago in the LSB we were trying to
decide, well how do you go about doing this? We sort of came up with three
possible ways. One of them was to create a single distribution that all
the other distributions built on. Another was to just standardize
absolutely everything so there's no room left to change everything. The
third one was to just standardize the core functionality. Again kinda
something roughly approximating the Single Unix Specification. Obviously
some of the distributions that have put a lot of energy into developing
their distributions weren't real pleased with the first approach. Most of
the rest of the Linux community wasn't real pleased with the second
approach. So the third one is kinda what we're doing. We want to specify
as little as possible and be useful.
<P>
One benefit of specifying as little as possible is that it means it's a
small enough chunk we can bite off and do. Trying to do everything in
Linux... it will never get done. There's not enough people that could work
on it to be able to do that. As it is, just doing sort of the base
libraries, throwing in X11, we're already up to, like, four or five
thousand functions and stuff... interfaces we're trying to say, "Here's the
formal discription of, and here's where it lives, and it should always
behave the way you expect it to." By sticking to a core subset here, that
gives the distributions the freedom to innovate and stuff. Every
distribution believes their installation program is the best, and they're
each right in their own opinion.  That's one thing we're not going to
touch. Let them have that, let them innovate, if eventually they all end
up doing it the same way because they finally settle on a best way, then we
can agree to standardize that, when in reality it will be after-the-fact,
when in reality they've already done it themselves anyway.
<P>
The base system that the LSB is going to specify-- you know when you go get
the next generation of Red Hat or SuSE or any of the distributions-- it will
be in there. It may or may not be something you can really point at and
say, "This is it," but it will be in there.  Then you start buying
applications, Star Office, some of our software [MetroLink], things like
that, will be using that subset of what's in there.  There will probably be
some splash and marketing about oh, this is now LSB-compliant stuff, and
that's good, but it's not like a whole new thing that's got to be added on.
It's just kind of taking what's there and modifying a little bit and making
it where that part won't change any.
<P>
One question we get a lot is, "Is the LSB for ISVs or for the
distributions?" The answer is: both. It takes both working together to
be able to make Linux successful with a lot of applications to be
available. For the end user it's one specification but you can kind of
read it from either side: it's either, "I must provide this as this is
described", or from the ISV side, "I can write my program that uses this
and know that it will work."
<P>
As we mentioned there's three areas that we're working on and we're
trying to work on all three of them at the same time because it's real
important that all three are really in sync. One of them is the written
specification. This is a document that you can point to, and this is what
describes a Linux Standard Base system. One of them is a test suite. A
specification is good, but a test suite proves that it works. That's going
to be really important because we can measure distributions and say, "yes,
you're compliant," or, "no, this doesn't work." And the other one is a
sample implementation. This would be a common set of packages that a
distribution could use as a basis for them to build on, but they don't have
to as long as what they do use passes the test suite. That was a real
sticky issue in the beginning. In the past, the ABI program used the
concept of a reference implementation. They just said, "This one exists.
If there's ever any questions, whatever this one does is the winner," and
that really didn't go over very well with the distributions. All
distributions are created equal, none of them are more equal than the
others. Providing a sample implementation avoids that problem but it still
says, "Here's something that we've tested that we know works; therefore [it] can
grow."
<P>
As an ISV, there are [a] few rules that you'll need to follow when writing
programs if you want to be LSB-compliant, so that it runs everywhere. One
of them is, when your application installs, be very careful about installing
shared libraries or other things that would normally be part of the system.
In other words, don't install your own version of glibc because that's what
works with your program, because then nothing else on the system will work.
We've laid out an area like under /opt-something-or-another where, if you
have a large program with shared libraries, you need to put them under
there and look for them under there and everybody has their own space under
/opt so that you avoid the Windows syndrome of installing something and
blat, there goes your comm dialog-32 or whatever.
<P>
One thing you have to do is you actually have to contain yourself to not
use more than what's in the LSB. If you do you're going to use something
that may or may not be present or may or may not behave the same on someone
else's system that's using it. It's a balance for us. We want to do as
little as possible so we can get it done, but we want to do enough to be
useful for applications. We'll settle on a point there. There's a few
options: if you need some library that the LSB doesn't specify you can
always link it into your program statically so that is becomes a part of
the program and is not depending on it being on the system. There's a
little bit of flexibility there.
<P>
Don't call the kernel directly. The interface to the system in the LSB is
the shared library calls, not the kernel calls. That way when Linus changes
the kernel we can fix the C library to deal with that and hide the change
from the application. They're still calling the C library which we've
already said isn't changing. How it happens on the other side, we don't
care about, as long as it acts the same.
<P>
A kind of blasphemous test I use myself when I'm looking at these things
is, could I go to Unixware or FreeBSD or something and implement an LSB
environment there that the application would work in? I doubt that anyone
would actually do that, but it gives me a good way of measuring: is this a
good thing or a bad thing, to prevent me from doing something way out on
the extreme like that.
<P>
The LSB written specification, I guess let me start with our web site, is
<A HREF="http://www.linuxbase.org">www.linuxbase.org</A>. If you go there, everything we do or know is under that
web site. The specification is actually under /spec from there. I keep
daily updates. Whenever I do something, it will show up within a day or so
on there. You can see the specification. There's a structure, and you [have]
still many, many empty sections, by far, but it's growing, slowly but
surely. There's several things that we've sort of agreed on that I haven't
gotten around to writing up in a formal manner yet. Hopefully in the next
few weeks I can get some more of that in and it will start to look like
something useful.
<P>
There are a lot of things that were pretty easy to agree upon. Standard
library names-- we're going to change the syntax a little bit. Instead of [it]
being libc.so.6 or 6.whatever, the LSB version is going to be libc.lsb.1.
You'll have like libpthreads.lsb.1, probably libX11.lsb.1. We're going to
use that naming scheme so you can see what the libraries are. Now the
distributions are free to make them symlinks to libc.6 if they want to or
they can carry on a whole, separate implementation. It doesn't matter as
long as the libc.lsb.1 passes the test suite. As long as it does the right
thing it doesn't matter how it's implemented. For convenience sake, it
will probably look and feel a whole lot like glibc, but it wouldn't prevent
libc5 from being used as an implementation.
<P>
Object file format is ELF. ELF is pretty well understood, used on a lot
of systems today. The BSDs have switched to it; I know a lot of people
have switched to ELF. It's pretty common now.
<P>
The API that we're referencing is sort of the POSIX, Single Unix
Specification, something about like that. There will be some extra things
we add, you know, threads. There will be some things in there that we will
definitely say are exclusions. The streams interfaces, the TLI or XTI, the
interface that's an alternate to sockets, is not included in the LSB.
<P>
The advantage of referencing these other specifications, you know, that's
stuff we don't have to write. If we can say that the system call open()
behaves as the Open Group's Single Unix Specification says it behaves, then
we're done with that and we can move on.  Otherwise we've got to take the
glibc man page and think about it, say what's missing. There's a lot more
work if we have to write the thing ourselves. Not to mention is adds about
1000 pages to the document. Again, our goal is to do as little as possible
as quick as possible, but still be useful.
<P>
Like I said, X11-- basic X11-- is in, you know, Xlib, maybe the toolkit. We
are not specifying desktops like GNOME or KDE or even Motif. All those
live on top of things that are going to be in the LSB. Again, if one day
in the future it all merges or whatever, and there's a single desktop that
everbody agress on, maybe at that time we can add it. But we're staying
out of that right now.  That's no more [un]popular [thing] than telling people,
"You have to build your distribution this way."
<P>
The Filesystem Hierarchy Standard that Dan Quinlan has been working on for
a long time is definitely in. That's been available for a long time and
there's some updates that have been going on concurrently with this. It's
now up to 2.1, or almost 2.1. That's just basically, "These files will be
in these places and you can count on it."
<P>
Conveniently, Dan Quinlan, who is the author of the FHS, is also the head
guy in the LSB. That helps to coordinate things a little bit there.
<P>
Actually, when we're trying to come up with things to pull into the
specification we have some preferences.  We prefer to use an existing
specification and just point to it. That's the easiest thing to do. Next,
we are willing to document existing practice. If we look around and say,
"Well, you know, all the distributions do it this way," we'll document it
and now it's a specification for it. What we prefer not to do, but are
having to do in one or two instances, is develop something new to solve a
problem. Generally, what that really turns out to be is, we discuss it
some, kind of agree on how we think this problem should be solved, a couple
people will go off, implement it, and well, now there's [an] implementation we
can reference. That moves it up one in the preference thing. The last
thing we want to do is to specify it by referencing it by an actual
implementation. We don't want to say the C library is glibc 2.0 because
then you're nailed to that one version and the only way to guarantee you're
compatible with that version is to never change. Again, that goes against
the "allowing innovation" thing. We sort of fudge sometimes and say that it
will be kind of like glibc, but we're not specific and the specification is
really behavioral-based. So, subtle differences.
<P>
One of the things we really want to do is to be able to test everything in
the specification. So sometimes when we are considering, well, if this is
in or out, we ask the question, "Can we test it?" If not, that kind of
leans towards pushing it out. It's not an absolute "can't do", because at
the moment we don't have tests for a lot of the stuff we know we absolutely
can't do without. A lot of compromise going on, probably like any group
that's trying to do something large.
<P>
The test suites, we are using the TET framework, which X-Open, now the Open
Group, has developed for all their big, expensive tests they charge lots of
money for. It's a good framework, especially when you've got lots of
thousands of interfaces, you've got to just go do this, do this, do this,
very repetitive. So it's good for that. We want to be careful that we
only test what's in the written specification and not accidentally include
other things in the test. When we have the test and we can run it against
the sample implementation then everything is going to kind of start
clicking at that point.
<P>
The test suites are basically going to be open source as much as possible.
One thing in the license that will be different is, because it is a test
suite, there has to be more control over it than other software.  It's okay
for anybody to get it, build it, use it, whatever. But you can't change it
and still claim you passed the same test. If you have to change the test,
it's not the same test. So that's going to be a little different, but it's
still basically going to be open source as much as possible.  Fortunately
the Open Group has made open source the core piece of their test suite, the
POSIX subset, so that gives us a jumpstart. All we got to do is use that
and okay, now we've got some of it covered and let's just grow it to cover
the rest.
<P>
In the test there's really-- we're going to be testing in both directions.
I've talked about the implementation test that you run against the OS to
see if it passes everything. There's also a test in the other direction
called an application checker that will scan your application and look for
shared libraries you're not supposed to use, functions you're not supposed
to use, things like that, that developers should use just like they use
make and the compiler, their editor. You know, run this kinda towards the
end of your development process or periodically through it to make sure
your application is conformant from that side.
<P>
One thing to point out is the different between a source standard and a
binary standard. The Single Unix Specification I keep referencing is a
source standard. It tells you how to write your code, you know, what the
function is, what the arguments to it is. A binary standard is a little
different. It's like, here's a shared library, these are the entry points
to the shared library, your executable must be in this file format. The
LSB is definitely a binary standard. Usually there's kind of a link
between the two, there's a mapping. This library has an entry point called
open(), you can then say, "and it behaves like the source specification of
open() does." So there's a difference between source and binary, and we're
definitely binary.
<P>
One area that we haven't really hit yet, that's part of the LSB, and I'm
sure it will be interesting when we get there, is when we get to the point
of, "okay, we've got a specification, we've got some tests, let's go run over
to Red Hat." And, well, Red Hat doesn't pass these three or four things.
Then it becomes the dancing around part of who's wrong. Is it the
implementation, is it the test, or is it the specification? We hope we get
the specification right, the test right, but it's going to be everybody
sitting down and looking at a problem and agreeing where the problem is and
that's where it gets fixed. Red Hat has issues of, "Well, you know, we
can't break compatibility." But hopefully they can find a way of solving
that themselves. Again, by having separate library names for the LSB, that
provides ways for them to fix the behavior one way for one and leave it the
old way for the old way. But that will be where the non-technical things
start to get really interesting.
<P>
One of the goals that we've set for ourselves, for the LSB, and don't take
this as a real strong commitment because the LSB not a commercial company
with paid employees that can guarantee schedules and stuff, but we've set
an internal goal to try to have a 0.5 of the LSB available in time for the
Atlanta Linux Showcase.  That will be enough of it in place that you can
look at it and hopefully say, "Oh, I see what they're trying to do here."
Yeah, we know there's some things that will not be ready in time to be
included in there, but hopefully what is included in there won't be
changing much. That's the thing we want everybody to read and give to ISVs
and get real feedback: "Well, that's great, but I still need this," or,
"You can't hold me to those limits," or whatever. It will be useful, but
not complete. That's what I'm doing between now and October.
<P>
I guess, basically, I've covered most everything here that I had made sure
I wanted to cover. I guess one thing that is mistunderstood a lot, a lot
of people ask me about, is "Gee, are all the distributions really
participating, and are they getting along in the LSB?" About a year ago
when things hit a snag and Red Hat and somebody else announced the, what
was it, the Linux Common Standard I think, the LCS, everybody said, "Oh the
LSB is already falling apart and it's only been a few months." That's not
the way things are. I guess what people didn't see was, we had a lot of
discussions and worked out some problems. Bruce Perens stepped down about
then, because as it turns out, what the group wanted to do wasn't exactly
the way he thought it would should be done, and he decided someone else
should be pushing it that was more in line with what everybody else wanted.
And, you know, Red Hat, SuSE, Caldera, Debian have all been participating,
trading resources. You know, and I mentioned people go off and work on
something sometimes, they're the ones that are making that happen. They're
having some of their people go off and do the work. So, the misconceptions
that there's all this turmoil just doesn't exist. All the distributions
have their goals and stuff, but they're all supporting it. Some of them
maybe a little more cautiously than others, because it's hard to endorse a
standard you haven't seen yet, but everybody's well bought into the idea
and expects to have a good thing that they will all endorse at the end.  So
they're following along and we all get along nice and well.
<P>
I think that's everything I wanted to make sure I said. Ummm, open it up
to questions now.
<P>
<STRONG>Question</STRONG>
<P>
There was a question, way, way back about RPM and I assume you guys aren't
trying to, at this point, say RPM's the standard or it's not, or have you
decided that it's not part of the standard, that the package manager isn't
part of the standard.  I noticed it's on the lists a lot.
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
One of the issues is what's the package format your application should be in.
It sort of started out by pencilling RPM but several people had some valid
concerns or shortcomings about RPM. Of course the Debian folks thought
that their DEB format was pretty slick, and they're all right. I believe
that a couple people have gone off to work on a new packaging format that's
some, not exactly a combination of Red Hat and Debian, but that's the
easiest way to say what it is. I haven't seen a lot of the details myself
but I believe there will be [a] new LSB format. Debian and RPM will probably
be changed to be able install those package. The specification will
specify the format of the package, not the tool that you use to install it.
Your distribution will tell you what the name of the tool is. You just
have to be able to read this file in a certain format. RPM is not the
answer but it will probably have a lot of similarities to it.
<P>
<STRONG>Question</STRONG>
<P>
It's kind of a related question, library-wise.  You said that you are
trying to incorporate as many other standards, by reference, as possible:
things like POSIX and that sort of thing.  And you also said that you are
pretty much requiring people to use only Section 3 calls. No kernel, no
actual system library calls. The first half of the question is: what
happens if Linus disagrees with some standard on something? I gather
things like that have happened, and I gather that's why you want to
insulate people from Section 2 calls, because that's where he has control,
and the library stuff is being maintained people that have that spec to
follow. And the other side of the question is, is there stuff you can't do
from glib? Are there things that have to be done with a system call, and
if so, if somebody runs across one of those, what do they do?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
Okay, the first part of your question, yes by making interface shared
libraries, if Linus does choose to go off and change all of the parameters
to a function or something, we can use that to deal with that, to map the
old way to the new way. If the behavior of a real common call, open(),
read(), something like that changes, that would be harder to emulate in a
shared library that implements it. Another important point is that one of
the things that we're trying to do initially is figure out how Linux is
different from the Single Unix Specification and documenting that. It's
okay to be different as long as we can say, "It's like this but here's an
exception." Basically we're gonna go with what's out there, behavior-wise,
since we identify what the differences really are. The second part of the
question was... well, think about the clone() system call, which is Linux's
way of creating threads. We're going to specify the pthreads interface
which actually sits on top of that. Even the system calls are actually
implemented as stubs in the shared library. So those are available. And
actually open(), read(), things like that are Section 2, they're system
calls, but they are stubs into the shared library. So they can take them
and hook behavior changes as necessary in the .LSB.1 version of the
library, so it's not exclusively Section 3.
<P>
<STRONG>Question</STRONG>
<P>
I know that, a little while ago, there was a test suite for the filesystem
standard, I'm not sure if it was beta or not. Is there any other test
suites available right now or any we can expect that might be coming up?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
The test suite that you're referring to, the FHS test suite, was developed
by Andrew Josie, who actually works for the Open Group.  I think his job
there is in charge of all the test suites they do commercially.  That was
interesting because he followed their procedures for developing test
suites, which is a very good procedure, and applied it to some of the stuff
we're working on. I hope we can imitate that for all the additional work
we've got. It's a very formal, but very useful procedure. I believe
that's a beta version, but I don't see a lot of changes occurring. That's
kind of part of the procedure to release it at this stage, get feedback,
release at this stage, and eventually release it one last time and call it
done. We have our hands on the POSIX test suite from the Open Group,
that's where we're going to be starting first. Dale Scheetz is in charge
of the test third of things. He's a Debian person. Actually lives up the
road at Jacksonville. Hopefully what we'll end up with is, we'll get that
test suite built and run it and get a good handle on it and then make some
RPMs available or something that people can download and play with. It's
not a real interesting test suite. You have to configure your box a
certain way. You type "ttt -e" and you check back the next day. It
gives you a report: "you passed 6728 of 7028 tests." Okay, you've got to go
and figure out what happened to the rest. It will be available; if you're
curious, try it out. It's not as much fun as playing games.
<P>
<STRONG>Question</STRONG>
<P>
How many distributions do you have to contend with? I count five leading
ones and it's not clear, some of the other ones, but they seem to be highly
specialized.
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
A lot of the other ones are actually derivatives of the main four or five
systems. Red Hat, Debian, SuSE, Caldera, Slackware... Slackware has chosen
not to be participating much in the LSB. It's their choice. I believe
that they're actually still libc5-based and probably felt that was a
problem for them. TurboLinux or Pacific HiTech, they're the kind of big
ones. I think most of the rest of them take those distributions and do
something different with them. Like I think Mandrake is a Red Hat
derivative. There's one, like a Pentium-optimized rebuild of one of them.
So as long as we're getting those core ones working together, then when they
make changes it will show up elsewhere. That's actually true with most of
what we do, if we have to make changes to glibc or a few areas, it will go
back to the original author of the technology and then Slackware's going to
pick up half of it anyway just because next time they update some pieces
they'll get that.
<P>
<STRONG>Question</STRONG>
<P>
I know that recently on the kernel mailing list, Linus has expressed his
disdain for the ioctl() system call, but it's still useful for doing some
basic operations. And I'm wondering how the LSB is handling that sort of
specialized system call that may or may not be part of the future of Linux.
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
That's easy, don't use it. ioctl()'s are inherently non-portable. That's
probably a little less of a problem in Linux then SVR4, where there was a
lot more variation in them. Most of the useful things you can do with
ioctl() there is a higher level for. Basically, termio interface, the
tcgetattr(), tcsetattr(), does a whole bunch of ioctl() stuff, but it gives
you a higher level interface. If there are some areas we know that we've
got to say, "Well, we've really got to do this for my GUI CD player to
work," probably a couple of controls in the SCSI driver, we have to give up
and write it up in the specification. Here's the structure, it looks like
this, here's the values that are used in it-- be very thorough about it.
But generally we try to avoid ioctl().
<P>
<STRONG>Question</STRONG>
<P>
For those of us that are very eager to contribute to the Linux community in
general, is there anything that we can do to help the LSB?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
Sure, I mean there's parts of the specification that need to be written,
there's test suites that need to be written. The guy that's doing the
sample implementation is going to need help too. It's a little tricky for
us because we need help, but we've got to be careful that we don't get so
many people that we're spending all the time explaining how to do it to a
bunch of people instead of actually getting work done. It's probably just
a simple management exercise that you'll find in any software development
shop or whatever. Yeah, if you want to step up and work on something we've
got things you can do. A little bit of experience would be helpful.
<P>
<STRONG>Question</STRONG>
<P>
Is there any room for public comment?  In other words, I realize you have
representatives from the various distributions and they all sort of get
their heads together and they talk to the home office and that sort of
thing. But regular guys like me, if I want to say, "Gee, I think we should
have this...."
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
Absolutely, there are several mailing lists available. You can look up at
the web site and see how to sign up for them. They are open, public
mailing lists. They are open, come say anything you want to, if there's
anything you want; go get in the discussion. Try to keep the discussion a
little bit focussed, just so that it doesn't go off so far that it becomes
useless. So far it hasn't been a problem. You can go there, "I've got
this need for these fixes," or, "I think I've got an idea on how to fix this
problem." Yeah, we're definitely listening to the community as a whole
because if we don't there's a good chance that it just won't be accepted.
<P>
<STRONG>Question</STRONG>
<P>
A lot of what you've talked about so far are basically system-level things.
One of the POSIX specifications is Shells and Utilities. Does the LSB sort
of venture into that area as well?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
We cover shells and utilities. The utilities that are generally covered by
the standard are things that might be needed by an application. The editor
is not one of them. <EM>ls</EM>, <EM>copy</EM>, even like <EM>adduser</EM>, <EM>grep</EM> probably... yeah,
there's a list of those that will be included. Hopefully it will be like
the "POSIX version" of these, or something like that. Most applications
don't use an editor so we're going to side-step that one too.
<P>
<STRONG>Question</STRONG>
<P>
Are you specifying things like Sendmail? I mean, not necessarily Sendmail
<EM>per se</EM>, but do you get as far into the implementation as the mail transport
agent?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
The short answer is no. If we did we I think we would probably say there's
a tool called /bin/mail and then you would open a pipe to it and feed it
the message. I guess the other way would be that you could use any network
protocol you wish because you have access to sockets. It isn't that hard,
it would be a straightforward thing to do.
<P>
<STRONG>Question</STRONG>
<P>
And that answer kind of goes in the direction of a question I was going to
ask, which is, higher level interfaces: as an application designer-- God
knows I've tripped over this at like a fourth-generation level-- but the 3GL
people who are doing, like, your Word Perfect and your Star Offices-- they
need interfaces to things that are more system/distribution level and
kernel level, things like, "How do I print a file?" or, even more
importantly, "How do I enable a printer? How do I disable a printer?"
That sort of thing that is normally shell-level commands. And it seems to
me that that is even more of an open hole than... I mean glibc is a fairly
standardized interface... but System V <EM>lp</EM> versus Berkley <EM>lpr</EM>, what switches
are available, and that sort of thing is something that's important for
things, like you say, for sending mail or sending print jobs, controlling
printers, maybe turning services on and off. Red Hat has the nice little
menu thing for enable sendmail, disable gpm, that sort of thing--but "turn
it on right now" is not a standard thing. Even Red Hat, I had to write a
script myself to go off in the init.d directory, find the right script, and
hand it the arguments, because there's no interactive way to do that.
There's no standard way to do any of that stuff. Is that under your aegis?
Are you going there? Are you that brave?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
We're going there just a little bit. I think <EM>lp</EM> is one of the commands
that's being specified. I'd have to look on the web site to see, because I
haven't read that section yet. I think we're just saying, go with /bin/lp
as sort of the System V looking thing with these arguments. Yeah, it's
commonly available. Fortunately someone else is working on the command
area of this. But, yeah, we'll give a command that you can feed stuff to
it and it will end up on the printer, but I don't know that you'll be able
to enable or disable the printer. So the basics are there, but that next
step, we're probably not going to get there right now. It's feedback that
we need, "Gee, that would be really useful to have." Better yet, write a
proposal. One thing that I would like to see is some standard API for
accessing mail. The C client libraries that imap comes with out of the
University of Washington, I think, provides interfaces, can go read mail
files in several formats and it can go talk POP, it can go talk IMAP.  I
think something very close to that would be real useful, but it takes
somebody sitting down and saying, "Okay, I will document this. I will do
it in a very formal manner. I will write the code or take that code and
beat on it a little bit and make sure it works and generalize it." Because
that's part of some other package, basically. There's lots of room for
things like that to be added. But, it's not there now so that falls way
down on our list of things, how we like to do it.
<P>
<STRONG>Question</STRONG>
<P>
Is there presently a release of the LSB and if not, is there one expected?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
Like I said, we're shooting for sort of 0.5 release in October at the ALS,
hopefully we'll stand up and talk in even more detail about it there. I
don't have a real firm date for like a full, 1.0 release. Maybe end of the
year, first of next year. We've been working on this for a while and a lot
of things are starting to come together. A lot of proposals have been
hashed out. If we pull that in and finish up this, that, and the other
thing and 12 other things, it'll be done. I believe that some of what
we're going now is affecting the next round of releases for the
distributions which should be out sort of the first of next year. So,
whether those will end up being fully LSB-compliant or a lot closer, I'm
not sure yet. But there's going to be a few things you can point in those
releases that are the result of things that have been hashed out in the
past few months in the LSB. I don't know if there will be a big bang in
some, or if it'll just be kind of everybody getting a little bit closer.
"Well our 7.1 release is not there yet, but it's getting close."
<P>
<STRONG>Question</STRONG>
<P>
You kind of invoked the ghost of Fred Brooks just a few minutes ago
when you were talking about not wanting so many people involved that you
had to spend so much time teaching that what to do.  And one of the other
things in his <EM>Mythical Man Month</EM> book was when you have more than
one standard, which one wins? You guys effectively have three: you have
descriptive standard on paper and two prescriptive standards-- a reference
implementation and a test suite. If all three of those don't happen to
agree at any given point, which one wins?  Has that decision been made?
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
First off, it's a <EM>sample</EM> implementation, not a reference implementation.
The written specification is the word, unless it can be proved that that
was a really big screw up to have written it that way. The written
specification is the definitive guide. One of the things that the IETF,
the Internet Engineering Task Force, one of the way they approve
standards is, you have to have two independant implementations of it.
Again, that's kind of a model, we're not going to have two sample
implementations. But it's kinda like, "Can I write this in sufficient
detail that two people can go off and implement it?" is one of the things I
measure by. We can arrange things so that distributions have some freedom
in how they implement it? You know, gosh, they'll probably all do it the
same way and it will probably be using whatever the current version of
glibc is, but I'm going to avoid saying you have to use glibc version this,
that, or whatever.
<P>
<STRONG>Question</STRONG>
<P>
Init, init scripts and all that sort of jazz seem to be a little bit, at
least to me, kind of all over the map; and is there any, I don't know, toe
that you guys are going to put in the...
<P>
<STRONG>Stuart Anderson</STRONG>
<P>
Is there an answer? The answer is yes! Yeah, init scripts is one of those
areas where everyone's done it a little bit different. We actually pulled
them all together and looked at them side by side and said, "Well, you
know, this is really about 85% the same." They're not as bad as everyone
thought. Init scripts is one of the things that will be nailed down in LSB
 1.0. Like I say, most people were pretty common, Debian had some really
good documentation on what, you know, the five or six commands that an init
script takes. So, everybody's kind of agreed, "Yeah, that's good. It's
general, it will work for everybody." So it's going to look a little
bit like that. We haven't exactly decided on where the path to them is
going to be. Is it /etc/init.d or /etc/rc.d/init.d and we may avoid that
by saying, "Here's a command you call. You pass it your init script, tell
it what runlevel it should be at, and it will put it in the right place."
Generally, abstracting things like that is the way we want to do it.
There's still some things, within a runlevel there's certain sets of
numbers to order things, and we've got a little more work to do on those.
But yeah, init scripts are something that we have, mostly, taken care of so
far. I think you can go to the web site, go on the spec area, and get a
link to the current draft of the proposal. There's links to the current
drafts of several things that haven't been pulled into the main document.
Like I said, there's a <EM>de jour</EM> version of the document as a whole there as
well.
</div>
END;
page_footer();
?>