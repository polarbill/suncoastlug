<?php
require_once('template.php');
page_header('Linux FAQ');
echo <<<END
<div id="content3">
This feature of the SLUG website is just getting started. We're not going to
answer all the question you have (there's a whole internet out there; go
look!) However, we can answer some of the more common questions, or direct
you to where they are best answered:
<P>
<UL>
<LI>
<A HREF="./distros.html">
What's the best Linux distribution?
</A>
<LI>
<A HREF="#dos">
What are the differences between Linux and DOS commands?
</A>
<LI>
<A HREF="#reboot">
My Linux system says I didn't mount my filesystem cleanly. What do I do?
<BR>
What does this <EM>maximum mount count</EM> mean?
</A>
<LI>
<A HREF="#floppy">
I can't make mount/copy files to my floppy unless I'm root. How do I get around
this?
</A>
<LI>
<A HREF="#links">
What are <STRONG>links</STRONG>? And what's the difference between
a <STRONG>hard link</STRONG> and a <STRONG>soft link</STRONG>?
</A>
<LI>
<A HREF="#ppp">
How do I set up PPP? None of the other programs I tried worked.
</A>
<LI>
<A HREF="#rr1">
How to I set up with RoadRunner?
</A>
<LI>
<A HREF="#rr2">
Can I set up a network where RoadRunner runs on one machine, but
the other machines can access the internet through RoadRunner as well?
</A>
<LI>
<A HREF="#console1">
How do I get from the console to an X-Window session?
<BR>
How do I get from an X-Window session to a console?
</A>
<LI>
<A HREF="#console2">
Can I get more consoles? How?
</A>
<LI>
<A HREF="#autofs">
What is autofs/automount, and how do I make it work?
</A>
<LI>
<A HREF="#keyswap">
How do I swap Caps Lock and Control on my keyboard?
</A>
<LI>
<A HREF="#smbprint">
How do I print to a Windows printer from my Linux box?
</A>
<LI>
<A HREF="#init">
How do init scripts work and what are they?
</A>
<LI>
<A HREF="./permissions.php">
I don't understand <I>permissions</I>. Can you help?
</A>
<LI>
<a href="#procmail">
When I hit "Reply" to an email list I'm on, it replies to the person who
wrote the email, not the list. How do I fix this?<br>
On some email lists, I can't tell from the subject line that the mail is
coming from a list. Is there any way to handle this?
</a>
<LI>
<a href="#dupemails">
I keep getting all these duplicate emails. While I'm getting the problem
fixed, is there a way to turn them off?
</a>
<li>
<a href="#idetape">
How do I get my IDE/ATAPI tape drive working?
</a>
<li>
<a href="#time">
How do I set the time on my computer?
</a>
<li>
<a href="#irqs">
What's the deal with IRQ/DMA/IO Addresses?
</a>
<LI>
<A HREF="#nice">
What's the difference between the nice value and the priority value in the
top program? When I change the nice value to X to reduce the impact of a process
on system performance, the priority goes up to X as well. Should I change the
priority to a lesser value or should it do it on its own when I increase the
nice value?
</A>
<LI>
<A HREF="#superblock">
What's a "super block"? How do you fix it with fsck? Can you?
</a>
<LI>
<A HREF="#blanking">
How do I turn off screen blanking at the console?
</a>
<LI>
<A HREF="#iptables">
Where's that dang IPTABLES script by Derek I keep hearing about?
</a>
</UL>
<P>
Do you have other questions you'd like to see answered?
<A HREF="mailto:faq@suncoastlug.org">Let us know</A>. We can't guarantee
we'll answer them, but you'll never know unless you ask!
<!-- START OF ANSWERS -->
<HR>
<A NAME="autofs"></A>
<h4>Question</h4>
What is autofs/automount, and how do I make it work?
<P>
<h4>Answer</h4>
<p>
Normally in Linux, things like floppy disks, CD-ROMs and such have to be
manually "mounted". This means that you associate a directory on your hard
drive with that device, and you can then read and/or write to the device.
(Note I did not say that you <EM>copy</EM> the contents to the directory;
this isn't necessary, and it's not what you do.)
<P>
With automount/autofs, Linux does the mounting work for you. For instance,
if properly configured, you can just pop a floppy in and read it, like in
DOS or Windows.
<P>
The first step in using autofs is picking a directory to mount to. You could
make a directory off of the root directory, called <STRONG>auto</STRONG> if you
like. But more common practice is to find the <STRONG>/mnt</STRONG> directory and
make a directory off of that. If you're mounting a floppy, it could be
something like <STRONG>/mnt/floppy</STRONG>.
<P>
Here's a table of devices for a typical system:
<P>
<TABLE BORDER="1" COLS="4">
<TR COLSPAN="4">
<TH>Media</TH>
<TH>Device</TH>
<TH>Filesystem</TH>
<TH>Mount Point</TH>
</TR>
<TR COLSPAN="4">
<TD>Hard Drive</TD>
<TD>/dev/hda1</TD>
<TD>FAT32</TD>
<TD>/mnt/win</TD>
</TR>
<TR COLSPAN="4">
<TD>CD-ROM</TD>
<TD>/dev/cdrom</TD>
<TD>iso9660</TD>
<TD>/mnt/cdrom</TD>
</TR>
<TR COLSPAN="4">
<TD>Floppy</TD>
<TD>/dev/fd0</TD>
<TD>EXT2</TD>
<TD>/mnt/floppy</TD>
</TR>
<TR COLSPAN="4">
<TD>Floppy</TD>
<TD>/dev/fd0</TD>
<TD>FAT</TD>
<TD>/mnt/dos</TD>
</TR>
</TABLE>
<P>
Notice how, for the single floppy drive, I have created two theoretical
mount points. This is because I want to mount it differently based on
whether it's a native floppy or a DOS floppy.
<P>
Okay, now comes the configuration files.  The first is
<STRONG>/etc/auto.master</STRONG> which
describes which empty directory I am using, a pointer to the configuration
file for that directory, and any options.  In my case the only option is a
timeout of 5 seconds:
</p>
<PRE>
	/mnt /etc/auto.mnt --timeout 5
</PRE>
<P>
Here's how the timeout works: When I <STRONG>cd</STRONG> into /mnt/cdrom the system
will check to see if something is mounted there.  If not, autofs will take over
and attempt a mount. If it failes, <STRONG>cd</STRONG> fails.  If it is successful,
<STRONG>cd</STRONG>
is successful and the CD-ROM is mounted. Now, as long as I am in
<STRONG>/mnt/cdrom</STRONG> somewhere the device is being used. Once I am
done I can <STRONG>cd</STRONG>
back out and autofs will wait 5 seconds to see if anything else needs to
access the mount point before unmounting it.
<P>
With that said, here's the last configuration file,
<STRONG>/etc/auto.mnt</STRONG>:
<P>
<PRE>
	cdrom     -fstype=iso9660,rw    :/dev/cdrom
	floppy    -fstype=ext2,rw       :/dev/fd0
	dos       -fstype=msdos,rw      :/dev/fd0
	win       -fstype=vfat,rw       :/def/hda1
</PRE>
<P>
You can now enable autofs at boot time and things will be running great. As
quickly as I've said that, though, you'll end up running into trouble.
It's inescapable. Remember, you don't have to have support compiled in
for all these filesystem types, but you should have them as loadable
modules. Do, however, compile in all those <STRONG>codepage</STRONG>
things in the filesystems area of the kernel config.  You need two of
them to be able to work with iso9660 and vfat, but I've forgotten which ones.
;)
<P>
If all of that <EM>still</EM> fails, go and edit your
<STRONG>/etc/syslog.conf</STRONG> and add a line:
<P>
<PRE>
	*.debug                      /var/log/debug
</PRE>
<P>
which autofs uses-- among other programs-- to output its debugging
information. You can attempt to use autofs a few times, look in that
file, and see what's going on. (Remember to delete this entry once you
are done, though.) As root, just
<PRE>
	killall -HUP syslogd
</PRE>
for the changes to take affect.
<P>
Well, that's about it. My primer on autofs based on my experiences. Hope
this helps. :)
<P>
<STRONG>Paul Braman</STRONG>
<HR>
<A NAME="console1"></A>
<h4>Question</h4>
<P>
How do I get from the console to an X-Window session?
<BR>
How do I get from an X-Window session to a console?
<h4>Answer</h4>
<P>
Assuming you have X-Window running....
<P>
When switching between text-mode consoles (VC or "virtual console"), you
merely need to use the ALT modifier (ALT-F1 through ALT-F7).
<P>
While running an X server, you use the CTRL-ALT modifer to get
<EM>out</EM> of X and back to a text-mode VC (CTRL-ALT-F1 through
CTRL-ALT-F6). Also, CTRL-ALT-BACKSPACE will kill X altogether,
and CTRL-ALT-KEYPAD+ and CTRL-ALT-KEYPAD- will switch between
available resolutions.
<P>
<STRONG>Ian C. Blenke</STRONG>
<HR>
<A NAME="console2"></A>
<h4>Question</h4>
Can I get more consoles? How?
<h4>Answer</h4>
<P>
As XFree86 allocates your "last available <A HREF="./definitions.html#console">
VC</A>", and VCs 1 through
6 are in use by most distributions, VC 7 is typically allocated
by X when it starts (thus F7). If you start multiple X servers,
each one will take a progressive VC (F8, F9, etc.)
<P>
Here are a few quick tricks that I've used for quite some time:
<P>
<STRONG>Trick #1:</STRONG>
<P>
One trick I find useful is to open up a master syslog on VC 12,
and use ALT-F12 to get to it. I've been using it so long, it's
the first thing I do to a Linux install when I'm finished. To
do this, merely do this:
<P>
<PRE>
	echo '*.*	/dev/tty12' >> /etc/syslog.conf
</PRE>
<P>
Or, add "*.*" followed by whitespace (tabs and spaces), followed
by "/dev/tty12" to /etc/syslog.conf
<P>
If you start/stop syslog (or even, egads, reboot), you should
have a VC #12 that keeps up with all of your latest syslog events.
<P>
<PRE>
	/etc/rc.d/init.d/syslog stop
	/etc/rc.d/init.d/syslog start
</PRE>
<P>
or, for newer distributions with the improved SYSV init scripts:
<P>
<PRE>
	/etc/rc.d/init.d/syslog restart
</PRE>
<P>
Also, on older distributions, VCs /dev's past tty8 are typically
"missing". To create the /dev device files, do the following:
<P>
<PRE>
	cd /dev
	./MAKEDEV tty12
</PRE>
<P>
If you wish, you can repeat this for any number of tty's. Take
a look at the source to /dev/MAKEDEV - it's a wonderfully simple
shell script.
<P>
<STRONG>Trick #2:</STRONG>
<P>
After you've created all of these extra VCs, wouldn't it be nice
to actually <EM>use</EM> them? If you a CLI purist like me, occasionally
the overhead of X really grinds on your nerves. Just because
most distributions only offer VC logins from tty1 through tty6
doesn't mean you can't add a few more.
<P>
The key to adding more VCs is /etc/inittab. This is the config
file for /sbin/init (pid #1!), so be <STRONG>very</STRONG> careful when editing
this file, or you might accidentally render your machine either
unusable or even <STRONG>unbootable</STRONG>. Caveat emptor!
You have been warned!
<P>
Seriously, however, it really is quite safe and easy if you are
careful. Typically, you will find the following VC handlers in
/etc/inittab:
<P>
<PRE>
	1:2345:respawn:/sbin/mingetty tty1
	2:2345:respawn:/sbin/mingetty tty2
	3:2345:respawn:/sbin/mingetty tty3
	4:2345:respawn:/sbin/mingetty tty4
	5:2345:respawn:/sbin/mingetty tty5
	6:2345:respawn:/sbin/mingetty tty6
</PRE>
<P>
To extend available consoles to tty7 (F7) through tty10 (F10),
merely add the following lines to your inittab:
<P>
<PRE>
	7:2345:respawn:/sbin/mingetty tty7
	8:2345:respawn:/sbin/mingetty tty8
	9:2345:respawn:/sbin/mingetty tty9
	10:2345:respawn:/sbin/mingetty tty10
</PRE>
<P>
Make sure that /dev/tty7 through /dev/tty10 exist (using the
MAKEDEV fix above if they are missing), and you're almost
there! If you signal to init to reread /etc/inittab (or,
ack, even reboot), the changes will take effect and the
logins will appear on those VCs:
<P>
<PRE>
	/sbin/init q
</PRE>
<P>
This forces init to check /etc/inittab and make appropriate
changes. WHATEVER YOU DO, DO NOT KILL PROCESS #1 DIRECTLY. :)
<P>
<STRONG>Tip:</STRONG> If you still decide to use X, you can still switch back,
just remember your last assigned VC in /etc/inittab - and
switch back to the NEXT VC. For example, if you have gettys
running on tty1 through tty10, tty11 will be your X session
and can be reached by using ALT-F11.
<P>
<STRONG>Trick #3:</STRONG>
<P>
The VCs don't end at F12. In fact, there are 63 available
virtual consoles (no longer a compile time parameter like
the older kernels used :) You can use F13 through F24 and
still directly access them by using the right-ALT key
modifier (RIGHTALT) instead of the left-ALT key along with
one of the function keys! What would be F13 is now
RIGHTALT-F1, and so on.
<P>
For example, add the following line to your inittab:
<P>
<PRE>
	13:2345:respawn:/sbin/mingetty tty13
</PRE>
<P>
To switch to that VC, use RIGHTALT-F1. Neat stuff, that.
<P>
But the wonder doesn't stop there. You can cycle through
VCs by using the arrow keys as well. Give ALT-LEFTARROW
and ALT-RIGHTARROW a try at a textmode VC and you will
walk back and forth along the available VC sessions.
<P>
Looking through the FAQs, it looks like they have all of
this covered in the Keyboard-and-Console-HOWTO (check
/usr/doc/HOWTO/Keyboard-and-Console-HOWTO). They give
examples of how to implement truely dynamic gettys that
preclude the use of inittab to statically spawn sessions
that you may never use.
<P>
I hope that the above examples help some of the beginners
give a few new things a try.
<P>
<STRONG>Ian C. Blenke</STRONG>
<HR>
<A NAME="keyswap"></A>
<h4>Question</h4>
How do I swap the Caps Lock and Control keys?
<P>
<h4>Answer</h4>
<P>
<i>Note: this only works in the console, <b>not</b> in X Windows.</i>
First, understand that when <a href="./definitions.html#init"><strong>init</strong></a>
runs, it defines and loads the keyboard layout by looking in setup files or its own
init scripts. Since init scripts vary from distribution to distribution, you'll have to
do some detective work to find out how it works on your system.
<p>
Log in or su as root. (Otherwise you won't have access to the directories and files
you need.)
<p>
For Red Hat systems, the keyboard layout files are in the
/usr/lib/kbd/keymaps/i386/qwerty directory (assuming you're on a PC and using a
standard keyboard). These are tarballs, which you will have to unzip, edit and
rezip. To find which keymap is being used, look at the /etc/sysconfig/keyboard file.
In it, you will see a line that looks like:
<pre>
KEYTABLE="us"
</pre>
<p>
This tells you there is a file in /usr/lib/kbd/keymaps/i386/qwerty called
<i>us.kmap.gz</i>. This is the file you have to edit. Do the following
<pre>
cd /usr/lib/kbd/keymaps/i386/qwerty
gunzip us.kmap.gz
vi us.kmap
</pre>
<p>
(Use whatever editor you like.) Find the line that says something about keycode 29. It
probably says "Control" in it. Change this to "CapsLock". Now find the line that says
something about keycode 58. This probably says "CapsLock". Change that to "Control".
Save the file.
<p>
Recompress the file:
<pre>
gzip us.kmap
</pre>
<p>
At this point, you can reboot and the change will take effect. However, if you don't
want to go that far, you can run the following command in every console where you want
the change to take effect:
<pre>
loadkeys us
</pre>
<p>
For SuSE 6.1 systems, the keymap files are in the same place, but editing that keymap
may not do the trick. If it doesn't, look for a file named
/usr/src/linux/drivers/char/defkeymap.map and edit that file as well.
<h4>Paul M. Foster</h4>
<HR>
<A NAME="ppp"></A>
<h4>Question</h4>
How do I set up PPP on my computer? The other program I tried didn't work.
<P>
<h4>Answer</h4>
There are a myriad of programs out there to make ppp work on your system.
The answer below is just one way.
<P>
PPP requires several things to work properly. Two of them are the programs
<STRONG>pppd</STRONG> and <STRONG>chat</STRONG>. You
can find out if you have these by running
<PRE>
which pppd
which chat
</PRE>
<p>
If you get a response on both items, then the programs exist on your
system. Most likely, they will be in the <STRONG>/usr/sbin</STRONG>
directory.
<P>
First, you must create a script to get you online, which we'll call
<STRONG>pon</STRONG>. The script may be anywhere in your path, but best
location is probably <STRONG>/usr/local/bin</STRONG>. This will be the
program you run to get you one the internet. The script should
look something like this:
<hr>
<PRE>
#!/bin/sh
# This is a shell script to call Concentric (my isp).
# It requires some other files to work properly:
# /etc/ppp/peers/concentric
# /etc/ppp/options-concentric
# /etc/ppp/chat-concentric
# set up ppp connection in the background
/usr/sbin/pppd call concentric &
# tell the user when ppp is set up
echo Checking PPP connection...
while ! [ -e /var/run/ppp0.pid ]
do
sleep 1s
done
echo PPP connection is now set up!
</PRE>
<hr>
<p>
Next you need an <EM>peer</EM> file. This one will be called <STRONG>
/etc/ppp/peers/concentric</STRONG>.
<hr>
<PRE>
/dev/modem
57600
crtscts
lock
name "myloginname"
noipdefault
defaultroute
debug
noauth
connect '/usr/sbin/chat -v -f /etc/ppp/chat-concentric'
file /etc/ppp/options-concentric
</PRE>
<hr>
<p>
Of course, you can see that you will have to edit this file to put
<EM>your</EM> login name where "myloginname" is. If you want to enable
<EM>dial on demand</EM>, you can insert the word <EM>demand</EM> anywhere
above, and ppp will not start immediately when you call <EM>poff</EM>;
instead, it will wait until you ping or try to surf before it actually
starts.
<P>
Next you need a <STRONG>/etc/ppp/chat-concentric</STRONG> file. (Again, you
can change the filename, so long as you make the change in the <STRONG>pon
</STRONG> script as well.)
<hr>
<PRE>
TIMEOUT 60
ABORT "NO CARRIER"
ABORT BUSY
ABORT "NO DIALTONE"
ABORT ERROR
"" +++ATZ
OK ATDT5551212
CONNECT ""
</PRE>
<hr>
You'll have to edit the phone number to match the dialup number of your ISP
in the above file.
<P>
Next, you need a <STRONG>/etc/ppp/options-concentric</STRONG> file:
<HR>
<PRE>
/dev/modem
57600
crtscts
lock
name "myloginname"
noipdefault
defaultroute
debug
</PRE>
<HR>
And you'll have to edit <EM>myloginname</EM> as before.
<P>
And you'll need a file called <STRONG>/etc/ppp/pap-secrets</STRONG>.
This assumes that your ISP uses PAP authentication.
<HR>
<PRE>
myloginname	*	mypassword
</PRE>
<HR>
You will need to edit the login name and password in this file.
<P>
Lastly, you need a file called <STRONG>poff</STRONG>. You run this program
when you're done surfing or getting your email, and you want to log off. The
script looks like this:
<HR>
<PRE>
#!/bin/sh
#
# terminate a ppp connection
#
if [ "$1" = "" ]; then
   DEVICE=ppp0
else
   DEVICE=$1
fi
if [ -r /var/run/\$DEVICE.pid ]; then
   kill -INT `cat /var/run/\$DEVICE.pid`
   if [ ! "$?" = "0" ]; then
      rm -f /var/run/\$DEVICE.pid
      echo "ERROR: Removed stale pid file"
      exit 1
   fi
   echo "PPP link to \$DEVICE terminated."
   exit 0
fi
#
# The ppp process is not running for ppp0
#
echo "ERROR: PPP link is not active on \$DEVICE"
exit 1
</PRE>
<HR>
That's about as simple as I can make it.
<P>
<STRONG>Paul M. Foster</STRONG>
<HR>
<A NAME="rr1"></A>
<h4>
Question
</h4>
<P>
How do I set up RoadRunner?
<h4>Answer</h4>
<P>
There are various ways to do this. The following seems to be the most
trouble-free. (Your machine will have to be running
<STRONG>ipchains</STRONG> or <STRONG>ipfwadm</STRONG>, depending on your
distribution, and a dhcp client, such as <STRONG>dhcpcd</STRONG>.
<p>
<STRONG>Step 1</STRONG>
<P>
Find your <STRONG>/etc/resolv.conf</STRONG> file, make sure you have the
following line in it (assuming 24.92.0.68 is your nameserver; contact
RoadRunner to find the exact address):
<PRE>
  search tampabay.rr.com
  nameserver 24.92.0.68
</PRE>
<P>
<STRONG>Step 2</STRONG>
<P>
The following is a script you can run at boot time. Note that you will need
to edit this script before using it.
<PRE>
# change eth1 to be whatever your ethernet
# interface is...
# if you only have one ethernet card in the machine,
# it will probably be eth0
dhcpcd eth1
sleep 20
/sbin/ipfwadm -F -p deny
# the 192.168.1.0 is a mask for the local network
# change it to your local net quad
# and put a zero in the last section
/sbin/ipfwadm -F -a m -S 192.168.1.0/24 -D 0.0.0.0/0
</PRE>
If you have ipchains instead of ipfwadm, use the following instead of the
ipfwadm commands above. Likewise, be sure to edit them for your particular
local internet addresses.
<PRE>
ipchains -F forward
ipchains -P forward DENY
ipchains -A forward -s 192.168.0.0/16 -j MASQ
</PRE>
<P>
<STRONG>Ed Centanni</STRONG>
<HR>
<A NAME="rr2"></A>
<h4>
Question
</h4>
<P>
Can I set up a network where RoadRunner runs on one machine, but
the other machines can access the internet through RoadRunner as well?
<h4>Answer</h4>
<P>
<OL>
<LI>Build yourself a machine with two NICs.
<LI>Install Linux.
<UL>
<LI>Configure one interface (eth0) with an internal "private" static IP
(use something like 10.0.0.1, 172.16.0.1, 192.168.0.1, etc).
<LI>Configure the other interface (eth1) to use DHCP.
</UL>
<LI>Make sure you have ipfwadm or ipchains installed from your distribution.
<UL>
<LI>ipfwadm for 2.0.x kernels
<LI>ipchains for 2.2.x kernels
</UL>
<LI>Build a kernel with IP Masquerading support (if your kernel doesn't
already support it).
<LI>Turn on your system's IP Forwarding at boot time.
<UL>
<LI>Redhat servers: /etc/sysconfig/network - FORWARD_IPV4="yes"
<LI>others add: echo 1 > /proc/sys/net/ipv4/ip_forward
</UL>
<LI>Turn on masquerading.
<UL>
<LI>ipchains (you only need one of the three MASQ lines below)
<UL>
<LI>ipchains -F forward
<LI>ipchains -P forward DENY
<LI>ipchains -A forward -s 10.0.0.0/8 -j MASQ
<LI>ipchains -A forward -s 172.16.0.0/12 -j MASQ
<LI>ipchains -A forward -s 192.168.0.0/16 -j MASQ
</UL>
<LI>ipfwadm (you only need one of the three masquerade lines below)
<UL>
<LI>ipfwadm -F -p deny
<LI>ipfwadm -F -a masquerade -S 10.0.0.0/8 -D 0/0
<LI>ipfwadm -F -a masquerade -S 172.16.0.0/12 -D 0/0
<LI>ipfwadm -F -a masquerade -S 192.168.0.0/16 -D 0/0
</UL>
<LI>Configure your other PCs with IP addresses.
<UL>
<LI>On same subnet as the private (eth0) interface on your Linux server.
<LI>Pointing their default gateways at the Linux server.
</UL>
</UL>
</OL>
<h4>Troubleshooting</h4>
<UL>
<LI>If you can ping things on the 'net by IP but can't resolve:
<UL>
<LI>
<STRONG>Your DNS is broken</STRONG>. Work on /etc/resolv.conf and
/etc/nsswitch.conf.
<LI>
If your DNS is broken, <STRONG>your DHCP client is probably broken as
well</STRONG>
</UL>
<LI>If you can't ping things on the internet by IP address
<UL>
<LI><STRONG>Make sure your DHCP client is working right</STRONG>.
</UL>
<LI>RedHat 5.x uses DHCPD
<UL>
<LI>If you have a 2.2 kernel, you need DHCPD 1.3+
<LI>RedHat 6.0 uses PUMP.
<LI>Be sure to "update" your dist to the latest version of pump.
</UL>
<LI>If you run a named (bind) server on your Linux server, you can point your
other clients at it.
<LI>If you don't, merely point your client PCs at the roadrunner DNS server
(seems typically to be 24.92.0.58, but you can use any DNS server on the
internet).
</UL>
<h4>Ian C. Blenke</h4>
<HR>
<A NAME="smbprint"></A>
<h4>Question</h4>
How do I print to a Windows printer from my Linux box?
<h4>Answer</h4>
In your <STRONG>/etc/printcap</STRONG> file, you'll need to ensure you have
the following lines:
<PRE>
remote|remote-smbprinter:\
  :lp=/dev/null:sh:\
  :sd=/var/spool/lpd/stcolor-letter-ascii-mono-360:\
  :if=/usr/local/samba/smbprint2:
</PRE>
<P>
The line that starts with <STRONG>:sd</STRONG> above is the spool directory
for your particular printer. You will need to find that directory and
substitute that for what is above.
<P>
You'll also notice the <STRONG>:if</STRONG> line above. This specifies an
input filter file for your printer. Here you specify the file <STRONG>
smbprint2</STRONG>. Below is that file (note: you may need to edit it):
<P>
<HR>
<PRE>
#!/bin/sh -x
# This script is an input filter for printcap printing
# on a unix machine. It uses the smbclient program to
# print the file to the specified smb-based server and
# service. For example you could have a printcap entry
# like this
#
# smb:lp=/dev/null:\
#     sd=/usr/spool/smb:\
#     sh:if=/usr/local/samba/smbprint
#
# which would create a unix printer called "smb" that
# will print via this script. You will need to create
# the spool directory /usr/spool/smb with
# appropriate permissions and ownerships for your system.
# Set these to the server and service you wish to print
# to. In this example I have a WfWg PC called "lapland"
# that has a printer exported called "printer" with no
# password.
#
# Script further altered by hamiltom@ecnz.co.nz
# (Michael Hamilton) so that the server, service, and
# password can be read from a
# /usr/var/spool/lpd/PRINTNAME/.config file.
#
# In order for this to work the /etc/printcap entry
# must include an
# accounting file (af=...):
#
#   cdcolour:\
#	:cm=CD IBM Colorjet on 6th:\
#	:sd=/var/spool/lpd/cdcolour:\
#	:af=/var/spool/lpd/cdcolour/acct:\
#	:if=/usr/local/etc/smbprint:\
#	:mx=0:\
#	:lp=/dev/null:
#
# The /usr/var/spool/lpd/PRINTNAME/.config file
# should contain:
#   server=PC_SERVER
#   service=PR_SHARENAME
#   password="password"
#
# E.g.
#   server=PAULS_PC
#   service=CJET_371
#   password=""
#
# Debugging log file, change to /dev/null if you like.
#
logfile=/tmp/smb-print.log
# logfile=/dev/null
#
# The last parameter to the filter is the accounting
#   file name.
#   Extract the directory name from the file name.
#   Concat this with /.config to get the config file.
#
eval acct_file=\\\${\$#}
spool_dir=`dirname \$acct_file`
config_file=\$spool_dir/.config
# Should read the following variables set in the
# config file:
#   server
#   service
#   password
eval `cat $config_file`
#
# Some debugging help, change the >> to > if you
# want to save space.
#
echo "server \$server, service \$service" >> \$logfile
#	smbprint \$@
(
# NOTE You may wish to add the line `echo translate'
# if you want automatic CR/LF translation when
# printing.
#   echo translate
	echo 'print -'
	cat
) | /usr/bin/smbclient "\\\\\$server\\\$service" \
\$password -U \$server -N -P >> \$logfile
</PRE>
<P>
<STRONG>
Ed Centanni
</STRONG>
<HR>
<A NAME="dos"></A>
<h4>Question</h4>
What are the differences between Linux and DOS commands?
<h4>Answer</h4>
If you're familiar with DOS, it shouldn't take too long to become familiar
with Linux. Many of the commands are the same or similar. Here's a table of
commands that are correspond to each other in DOS and Linux:
<P>
<DIV ALIGN="CENTER">
<TABLE BORDER="1" CELLPADDING="5" CELLSPACING="5">
<TR>
<TH>DOS Version</TH>
<TH>Linux Version</TH>
<TH>Meaning</TH>
</TR>
<TR>
<TD>
;
</TD>
<TD>
<EM>
:
</EM>
</TD>
<TD>
separate directories in path
</TD>
</TR>
<TR>
<TD>
/
</TD>
<TD>
<EM>
-
</EM>
</TD>
<TD>
indicates command line parameters
</TD>
</TR>
<TR>
<TD>
\
</TD>
<TD>
<EM>
/
</EM>
</TD>
<TD>
separates subdirectories in file names
</TD>
</TR>
<TR>
<TD>
|
</TD>
<TD>
|
</TD>
<TD>
send output of one command to input of another ("pipe")
</TD>
</TR>
<TR>
<TD>
%PATH%
</TD>
<TD>
<EM>\$PATH</EM>
</TD>
<TD>
your path statement
</TD>
</TR>
<TR>
<TD>
attrib
</TD>
<TD>
<EM>chmod</EM>
</TD>
<TD>
change attributes (ownership) of a file
</TD>
</TR>
<TR>
<TD>
cd
</TD>
<TD>
cd
</TD>
<TD>
change directories
</TD>
</TR>
<TR>
<TD>
chdir
</TD>
<TD>
chdir
</TD>
<TD>
change directories
</TD>
</TR>
<TR>
<TD>
cls
</TD>
<TD>
<EM>clear</EM>
</TD>
<TD>
clear the screen
</TD>
</TR>
<TR>
<TD>
copy
</TD>
<TD>
<EM>cp</EM>
</TD>
<TD>
copy file(s)
</TD>
</TR>
<TR>
<TD>
date
</TD>
<TD>
date
</TD>
<TD>
change or show the date
</TD>
</TR>
<TR>
<TD>
del
</TD>
<TD>
<EM>rm</EM>
</TD>
<TD>
delete/remove a file
</TD>
</TR>
<TR>
<TD>
dir
</TD>
<TD>
<EM>ls</EM>
</TD>
<TD>
list the files in a directory
</TD>
</TR>
<TR>
<TD>
fc
</TD>
<TD>
<EM>diff</EM>
</TD>
<TD>
compare two files
</TD>
</TR>
<TR>
<TD>
find
</TD>
<TD>
find
</TD>
<TD>
find a file
</TD>
</TR>
<TR>
<TD>
md
</TD>
<TD>
<EM>mkdir</EM>
</TD>
<TD>
make a new directory
</TD>
</TR>
<TR>
<TD>
mkdir
</TD>
<TD>
mkdir
</TD>
<TD>
make a new directory
</TD>
</TR>
<TR>
<TD>
more
</TD>
<TD>
more
</TD>
<TD>
show a screenful at a time
</TD>
</TR>
<TR>
<TD>
rd
</TD>
<TD>
<EM>rmdir</EM>
</TD>
<TD>
remove a directory
</TD>
</TR>
<TR>
<TD>
rem
</TD>
<TD>
<EM>#</EM>
</TD>
<TD>
remark in a batch file (script)
</TD>
</TR>
<TR>
<TD>
ren
</TD>
<TD>
<EM>mv</EM>
</TD>
<TD>
rename a file
</TD>
</TR>
<TR>
<TD>
rmdir
</TD>
<TD>
rmdir
</TD>
<TD>
remove a directory
</TD>
</TR>
<TR>
<TD>
sort
</TD>
<TD>
sort
</TD>
<TD>
sort a file
</TD>
</TR>
<TR>
<TD>
set
</TD>
<TD>
set
</TD>
<TD>
show/change/create environment variables
</TD>
</TR>
<TR>
<TD>
type
</TD>
<TD>
<EM>cat</EM>
</TD>
<TD>
type a file to the screen
</TD>
</TR>
</TABLE>
</DIV>
<P>
Obviously, a great many commands are similar. It should be noted, however,
that the parameters for these commands and precisely how they behave may be
slightly different in Linux than DOS. To find out more about any command,
simply type <STRONG>man &lt;command&gt;</STRONG>.
<P>
<STRONG>
Paul M. Foster
</STRONG>
<HR>
<A NAME="floppy"></A>
<h4>Question</h4>
<p>
I can't mount/copy files to my floppy unless I'm root. How do I get around
this?
<h4>Answer</h4>
<p>
Take a look at your <STRONG>/etc/fstab</STRONG> file. Fstab stands for
<EM>file system table</EM> and tells you what file systems are mountable or
mounted on your system. This will include things like your various hard
drive partitions, floppy drive, CD-ROM drive, Zip drive, etc. A typical
entry for a floppy drive might look like this:
<PRE>
/dev/fd0  /mnt/floppy  auto  noauto,user  0  0
</PRE>
<p>
You can do <STRONG>man 5 fstab</STRONG> to find out more about this file.
Briefly, each of the items on this line is a <EM>field</EM>. The first field
is the device itself (<EM>/dev/fd0</EM>). The second is the point where the
system wants to mount it (<EM>/mnt/floppy</EM>). The third field is the type
of filesystem. Your Linux hard drive is probably an <EM>EXT2</EM>
filesystem, while your CD-ROM is probably <EM>iso9660</EM>. You see
<EM>auto</EM> for this field above, which means that it will be determined
by the system before mounting. You could change this to <EM>msdos</EM> if
you always use MSDOS floppies in your floppy drive.
<P>
The next field (<EM>noauto,user</EM>) is the options that will be used by
the <STRONG>mount</STRONG> command to mount this filesystem. In this case,
the first option is <EM>noauto</EM>. That means that if you want to mount
this filesystem, you will have to tell the system to specifically mount it.
You can't have it automatically mounted.
<P>
The next part of the mount options field is <EM>user</EM>. You probably
don't see this in your <STRONG>/etc/fstab</STRONG> file. Adding this keyword
to the file here tells mount that the average user can mount this
filesystem. <EM>This is what you need to be able to mount your floppy as a
regular user (as opposed to root).</EM>
<P>
The other fields in this line are not important here. You can issue a
<STRONG>man 5 fstab</STRONG> to learn more about them.
<P>
If you have this <EM>user</EM> keyword in your mount options in the fstab
entry for your floppy, then you can issue the command
<PRE>
mount /mnt/floppy
</PRE>
and your floppy will mount in that directory. If you want to mount the
floppy in some other directory, then the entry in the <STRONG>/etc/fstab
</STRONG> file makes no difference, and you'll have to be root to mount the
floppy.
<P>
If you (as a regular user) want to be able to write to the floppy, you can
add another parameter to the mount parameters in
<STRONG>/etc/fstab</STRONG>. That parameter would be <EM>umask=0</EM>. So
the revised line might look like this:
<PRE>
/dev/fd0  /mnt/floppy  auto  noauto,user,umask=0  0  0
</PRE>
<STRONG>Paul M. Foster</STRONG>
<HR>
<A NAME="links"></A>
<h4>Question</h4>
<p>
What are <STRONG>links</STRONG>? And what's the difference between
a <STRONG>hard link</STRONG> and a <STRONG>soft link</STRONG>?
<h4>Answer</h4>
<p>
Files are stored on a Linux disk in various places, and each has something
called an <STRONG>inode number</STRONG> associated with it. It's like an
address for that file. But Linux files don't actually have to have names at
all. As long as you know a file's address (<STRONG>inode number</STRONG>)
you can manipulate the file. As a matter of fact, because of this, if a
program opens a file, you can generally rename the file while it's open, and
the program will still be able to find it, because it uses the <STRONG>inode
number</STRONG> of the file instead of the name.
<P>
A <STRONG>link</STRONG> is essentially a <EM>name</EM> associated with the
file. In Linux, a file can have more than one name. Each name could be
called a <STRONG>link</STRONG>.
<P>
A <STRONG>hard link</STRONG> is a file name that's attached to the file. The
curious part about a <STRONG>hard link</STRONG> is that if you delete it,
the file may still exist.
<P>
Remember before, I said a file may have many names under Linux. So let's say
be have a file called <EM>config</EM>. Now, we can make several other
<STRONG>hard links</STRONG> to the file, so that now we have not only
<EM>config</EM>, but <EM>configuration</EM>, <EM>myconfig</EM>,
<EM>theconfig</EM> and <EM>allconfig</EM>. All these names (or <STRONG>hard
links</STRONG>) point to the same file. The thing that distiguishes
<STRONG>hard links</STRONG> is that you would have to delete them all before
your file would actually be gone.
<P>
<STRONG>Soft links</STRONG> are similar to hard links, except that when you
delete them, the file still remains. <STRONG>Soft links</STRONG> are also
known as <EM>symbolic links</EM> or <EM>symlinks</EM>.
<P>
You may ask yourself why anyone would want to have such a scheme with files
that have multiple names. There are various reasons, but one of the main
ones is this: Let's say that your word processor wants a certain
configuration file in a certain directory. But let's say that the people who
built your Linux distribution don't want to put that file there. No problem.
The distribution makers can put it wherever they want, so long as there is a
<STRONG>symlink</STRONG> to it in the spot where the word processor wants
it. <STRONG>Symlinks</STRONG> are kind of like bread crumbs that show the
way to your files, and Linux will follow them down until it finds the file
you asked for.
<P>
<STRONG>Paul M. Foster</STRONG>
<HR>
<A NAME="reboot"></A>
<h4>Question</h4>
<p>
My Linux system says I didn't mount my filesystem cleanly. What do I do?
<BR>
What does this <EM>maximum mount count</EM> mean?
<h4>Answer</h4>
<p>
Linux is very sensitive to the condition of the files on its hard drives
(<EM>filesystems</EM>). So it performs periodic checks on the filesystems to
maintain their integrity. In order to do this, Linux keeps track of two
things:
<UL>
<LI>Whether the user shut down the machine properly.
<LI>How many times the machine has been shut down since the filesystems were
last checked.
</UL>
<p>
You've probably heard of <EM>caching</EM> before. This is where the most
frequently used parts of the hard drive are stored in memory (which makes
access time faster). This system works well, except that occasionally the
system, for the sake of safety, must write what's in memory back to the hard
drive. This is called <EM>flushing the cache</EM>. Linux will periodically
do this. If given a chance, it will do this before you turn your machine
off. If it doesn't get this chance, then all those changes you made to your
spreadsheet don't get back onto the hard drive, for instance. And the next
time you try to edit the spreadsheet, you'll have to do a lot of work over.
<P>
In addition to tracking the cache and flushing it periodically, when Linux
starts up, it sets a flag on your hard drive that tells it whether Linux was
properly shut down or not. If you shut down Linux properly, then it will
reset this flag before it terminates, and all should be well. If you don't
allow Linux to shut down properly, this flag never gets reset. The result is
that the next time you start Linux, it knows you didn't halt Linux the right
way, and it will perform lengthy checks on the filesystem to ensure it is
still okay. This is sort of like a DOS <EM>chkdsk</EM> or a Windows
<EM>scandisk</EM>.
<P>
Lastly, Linux keeps track of the length of time since a filesystem check was
done, and how many times the system had been rebooted since the last
filesystem check. If it's been too long since the last check, or the system
has been rebooted more than a certain number of times, then the next time
you reboot, Linux will also perform this filesystem check. In this case, you
did nothing wrong. It's just that Linux wants to make sure everything is
still alright.
<P>
Now, how do you shut your system off properly so Linux doesn't get too
excited? First let me tell you how <EM>not</EM> to do it.
<STRONG>Don't</STRONG> just turn your system off. This is guaranteed to
cause the kind of problems mentioned above. There are actually quite a few
<EM>correct</EM> ways to shut your system down. If you want to shut your
computer down completely (not a reboot), then you can issue the following
command:
<PRE>
shutdown -h now
</PRE>
<p>
On the other hand, if you just want to reboot your system, you can issue
this command:
<PRE>
shutdown -r now
</PRE>
<p>
That's all there is to it.
<P>
<STRONG>
Paul M. Foster
</STRONG>
<P>
<HR>
<A NAME="init"></A>
<h4>Question</h4>
<p>
How do init scripts work and what are they?
<h4>Answer</h4>
<p>
There are two prototypical approaches to startup scripts -- the BSD
way and the System V way.
<P>
The BSD way has /etc/rc.local for starting up a bunch of daemons;
originally it was supposed to be basically empty when the system was
installed, and each site would add to it as needed. Eventually
vendors started shipping their systems with rc.local full of stuff
like sendmail and X. The BSD way was adopted by the Slackware Linux
distribution (except I think they might put rc.local in /etc/rc.d/),
and it is preferred (major understatement) by a lot of people who like
its simplicity when adding new daemons.  In my opinion those people
don't understand the advantages of the other way....
<P>
The System V way, adopted in some form by most of the mainstream Linux
distributions (except Slackware), starts with the concept of multiple
runlevels, with different daemons running in different runlevels;
e.g. runlevel 1 might be non-networked, runlevel 2 might be networked,
and runlevel 3 might be networked and serving other machines.
Runlevel 0 is shutdown, runlevel 6 is reboot, and runlevel "S" is
single-user.  When switching runlevels, the system must start or stop
daemons as appropriate to the new runlevel; when moving from runlevel
3 to 2, you might want to stop the NFS daemons, and when moving in the
opposite direction you want to start them.
<P>
The System V scheme involves directories init.d and rc[0-6S].d where
"[0-6S]" is the letter S or any digit from 0 to 6. Traditionally
these directories are in the /etc/ directory, but some Linux
distributions put them under /etc/rc.d/, and some Unices put them
under /sbin/. The init.d directory (NOT to be confused with inetd) is
full of the actual scripts that are used to start and stop the daemons
or subsystems. The scripts are called with either "start" or "stop"
as arguments, to start or stop the daemon or subsystem associated with
that script. Sometimes a script will also allow "restart" or even
"status".
<P>
The rc[0-6S].d directories (rc0.d, rc1.d, rc2.d, rc3.d, and so on) are
the ones actually used on bootup. They are full of links to the
scripts in init.d. Each "active" link begins with either an S or a K
(for start or kill), then a two-digit number (for ordering), then the
name of the init.d script it's linked to (or a close variant of it).
When going into a runlevel, first the K scripts are run with the
"stop" argument, then the S scripts are run with the "start"
argument. The best way to disable something in  aparticular runlevel
is to rename its link in that runlevel so that it doesn't start with a
capital S. (The various Linux runlevel editors I've seen don't do
that, so I don't use them.)
<P>
The downside of this scheme is complexity when adding a daemon or
subsystem. You need to put a new script in init.d that understands
both "start" (the easy one) and "stop" (the hard one). Often you can
just adapt one of the existing scripts. Then you need to make the
right links in the right rc[0-6S].d directories so that it is started
and stopped at the appropriate times. For example:
<PRE>
  cd /etc/rc.d/rc3.d
  ln -s ../init.d/sshd S75sshd
  cd ../rc0.d
  ln -s ../init.d/sshd K25sshd
</PRE>
<p>
You also need to look at the existing order to see what numbers would
be most appropriate to use; you don't want sshd starting before
networking is set up, but you probably want it before you start
serving disks to other machines.
<P>
The major advantage of this scheme is that you only need to figure out
how to stop something once (when you write the script), maybe less (if
someone else wrote the script). After that, if you need to stop the
sshd daemon, you just do "/etc/rc.d/init.d/sshd stop" or
"/etc/init.d/sshd stop" (depending on where your distribution puts
everything). To start it again, you do the same with "start" instead
of "stop". This is incredibly useful, especially with more
complicated subsystems like databases, or daemons with associated
kernel modules. This scheme also makes life easier when dealing with
daemons that must be restarted after changing their config files --
sendmail and inetd are biggies. Unfortunately inetd is often put in
the same script as other network setup, making the script less useful.
<P>
<STRONG>Rob Funk</STRONG>
<P>
Member, Central Ohio Linux Users Group<BR>
<hr>
<a name="procmail"></a>
<h4>Question</h4>
<p>
When I hit "Reply" to an email list I'm on, it replies to the person who
wrote the email, not the list. How do I fix this?<br>
On some email lists, I can't tell from the subject line that the mail is
coming from a list. Is there any way to handle this?
<h4>Answer</h4>
<p>
The answer is a program called <i>procmail</i> which should be installed on
your system and comes with all Linux distributions. Procmail is a program
that diverts and pre-processes your mail for you. With procmail, you can
automatically modify messages, forward email to someone else, or refile
email in special folders.
<p>
Assuming procmail is installed and running on your system, you simply have to
configure it to process your mail the way you want. There is one file in
your home directory to edit: .procmailrc
<p> Some preparatory remarks....
<p>
Emails consist of three basic things. First, there is the
<i>envelope</i>. This is just like the envelope on a letter you mail at
the post office. This is what actually tells mail transfer agents
(MTAs) like <i>sendmail</i> where the email goes. And it is mostly out
of your control, once your mail subsystem is configured and running.
Second, there is a <b>header</b>, which usually consists of lines like
"To: somebody@isp.com" and "From: somebody-else@another-isp.com". These
are administrative pieces of information that tell you and your email
programs things about the email and assist in routing it properly.
After the header information, there is a blank line. This is what
separates the header from the body of the email (i.e. your message
text). Then after the blank line is the <b>body</b> of your email.
<p>
.procmailrc files contain "recipes", which tell procmail what kinds of
mail you're looking for, and what to do with it when it sees them. A
.procmailrc file may contain any number of recipes. When asked to
handle incoming mail, procmail takes each message in turn and tests it
against each of the recipes in the file in turn. If it finds a recipe
that fits the email it's given, it will do some action, depending on
what you tell it to do with that kind of email. Typically, if it finds
a matching recipe, it will do the action and then move on to the next
email, though there are ways around this. If no recipe matches the
email, then it is simply delivered back to the main spool file for you
to look at in your email client.
<p>
Also note that the .procmailrc file can contain comments. These are
indicated by a hash mark (#) at the beginning of the line.
<P>
Here are some variables you should place in the beginning of your
.procmailrc. The first is where your email is ultimately going to end up (the
directory where you store your mail folders):
<pre>
MAILDIR=\$HOME/Mail
</pre>
<p>
This is where your email originally comes in to:
<pre>
DEFAULT=/var/spool/mail/\$LOGNAME
</pre>
<p>
If you want to log what procmail is doing, you should include the
following variables. But beware, this log is very extensive.
<pre>
LOGFILE=\$HOME/procmail.log
VERBOSE=yes
</pre>
<p>
Procmail uses what are called "recipes". Basically, you tell procmail
to "grep" your email, looking for certain patterns, and then you tell
procmail what to do with the mail if it matches the pattern you set.
<p>
A typical procmail "recipe" would look like this:
<pre>
:0:
* ^To: slug@nks\.net
slugmail
</pre>
The first line uses ":0" to indicate that this is the start of a
recipe. The trailing colon (:) indicates we want procmail to use a
local lockfile while processing this recipe. The reason for this is to ensure we have
exclusive rights to modify the "slugmail" file, in case some other process may be
trying to access the file at the same time.
<p>
The second line is the "grep" line that tells procmail what to look
for. Grep lines start with a star/asterisk (*). The caret (^) indicates
to procmail that the pattern starts at the beginning of a line. In this
case, we're looking for a line that starts with "To: ". The "To" in
this case is "slug@nks.net". Note that before the last dot/period, we
put a backslash (\). Since this is a grep expression, the dot normally
equates to any character. But that's not what we want. We want the
actual dot. So we have to "escape" it by putting the backslash in front
of it. That way, procmail's grep looks for a literal dot.
<p>
The last line of the recipe is a mail folder called "slugmail". It's a
mail folder because it isn't preceded by anything, just the name. When
procmail processes this, it will actuall expand it to:
\$MAILDIR/slugmail. So this will be an email folder in your private mail
subdirectory.
<p>
In summary, this recipe takes any mail that has a "To" of slug@nks.net,
and files it in a folder called "slugmail" in your private email
subdirectory.
<p>
Before we go further, I should mention something that will be important
later on. Procmail has two kinds of recipes: delivering and non-delivering.
Delivering recipes either write the email to a file, forward the email to
another address, or pipe the email through another program. Non-delivering
recipes are ones that feed the email back through procmail (as in filters)
, start a
nesting block (start with a { and end with a }; see below), or use the
"c" flag to carbon copy an email.
<hr>
<p>
Now, here's another recipe. In this one, the postgresql list email
doesn't have a consistent "Reply-To", so when you hit "Reply" it often
goes back to the person who sent the email, not back to the list. This
is a quirk of the way some lists are set up. (This is not a bad thing necessarily,
and there are heated arguments over this point.) We want to insert a
"Reply-To" in the email so that replies go back to the list, not the
sender.
<pre>
:0 w
* ^Sender: pgsql-general-owner@postgresql\.org
| formail -i "Reply-To: pgsql-general@postgresql.org" >> \$DEFAULT
</pre>
In this recipe, notice first that in the first line, there is no colon,
meaning no lockfile is needed. This is because we're piping our mail
through the formail program, so there's no need to issue a lockfile.
There is also a flag, "w", indicates that we want
procmail to wait until formail is finished before continuing. The
reason for this is that if procmail feeds a large email through
procmail and then continues, procmail may be in the middle of dumping
the next email into your files at the same time that formail is doing
the same thing. The results could be unpleasant, as both processes
access the spool file at the same time.
<p>
The grep line looks for a header line that starts with "Sender: " and
is addressed to the postgresql list.
<p>
The "action" line does several things. First, the bar (|) at the
beginning tells procmail that we're going to feed this email through
another program, in this case the formail program. Formail is a program
that's part of the procmail suite of programs. It is capable of
rewriting parts of your mail. In this case, we give formail the -i
parameter along with the "Reply-To" we want. Formail will insert this
"Reply-To" header line into the email and then pass it on. Using the -i flag means
that formail will <i>add</i> this reply-to. If we wanted to <i>replace</i> any
reply-to's already in the file, we would use the -I flag. The
"greater-than" symbols (>>) and \$DEFAULT variable tell formail to send
the result of its output back to the main spool file.
<hr>
<P>
Here's a similar recipe, except that we're looking for a different
header line. In this case, the one line that's common to all mail
coming from this list is an "X-BeenThere" line. When dealing with
lists, how the headers are set up can vary considerably. That's why,
if you're going to filter list email, you've got to check and see
exactly what header lines are common to the emails before you start
filtering things.
<pre>
:0 w
* ^X-BeenThere: openacct@linuxports\.com
| formail -i "Reply-To: openacct@linuxports.com" >> \$DEFAULT
</pre>
<hr>
<p>
Here's a slightly different recipe. In this one, we have two grep
lines. The first is like the others; we're looking for a "Delivered-To"
line. The second is a "Subject:" line, but in this case, it has an odd
"\/.*" construction after it. In this case, we're not really grepping
for the subject line, though if the email doesn't have a subject line,
this recipe will fail (and procmail will look for the next thing that
might match). The "big caret" (\/) tells procmail to save everything
beyond it into a variable called "MATCH". In our case, "everything
beyond it" is any number of characters (the grep expression .*). So
here, we want to save everything beyond "Subject:" on the subject line
to the MATCH variable.
<P>
The action line is where we use the MATCH variable. In this case, we
are piping the mail through formail, as before, but this time, we give
it an "-I" parameter. This means that we want to replace the header
line with one of our own creation. Here, we're going to replace the
original "Subject:" with "Subject: ", the string [LYX] and the contents
of the MATCH variable (which is the actual subject of the email). So
what we're really doing is inserting the string [LYX] before the actual
subject text on the subject line. And of course, as before we're
sending it back to the main spoolfile.
<p>
The reason to have a recipe like this is because in some cases, list
traffic contains nothing in the subject line to indicate it came from
this or that list. It could be from anywhere. In some cases, list
processing software will put some indicator on the subject line to
indicate that the email came from this list. This is called "subject
munging", and many people disagree with this practice. The advantage to
subject munging is that you can see at a glance what email comes from
what list. If your list host doesn't munge the subject for you, then
this recipe will act as a substitute. It will munge the subject to
include the email's origin.
<pre>
:0 w
* ^Delivered-To: mailing list lyx-users@lists\.lyx\.org
* ^Subject:\/.*
| formail -I "Subject: [LYX]\$MATCH" >> \$DEFAULT
</pre>
<hr>
<p>
Here is a "compound" recipe, meaning that it does more than one thing
with the incoming email.
<P>
In this case, we're looking for "New Member Surveys". The open brace
({) says that we're going to do more than one thing with this email.
Inside the braces, there are two more recipes, this time with no grep
lines. You can omit a grep line with any recipe, in which case it will
act on <b>all</b> email sent to it. Here, we have already grepped the
header, so we don't need to do that again with the "sub-recipes".
<p>
The first sub-recipe just copies the email to a file in our personal
mail directory called "newmembers". That's what the "c" flag makes
procmail do. We're using the colon (:) here, because we need a local lockfile
in order to safely deliver to a local mail folder. Note that this is a
<i>non-delivery</i> recipe, meaning that the
email continues on through procmail until it gets to a <i>delivery</i> recipe.
The second sub-recipe pipes the email through a program
called "newmember.pl", which does a variety of other things which
aren't important here. After all that, we see the close brace (}),
which signifies the end of the recipe. Since procmail piped the email through
this newmember program, and since it can't keep track of what happens after that,
it assumes that the email has been "delivered". Thus this last recipe is a
<i>delivery</i> recipe.
<pre>
:0 w
* ^Subject: New Member Survey
{
	:0 c:
	newmembers

	:0
	| \$HOME/bin/newmember.pl
}
</pre>
<hr>
<p>
This recipe looks for email traffic from a certain address, and
forwards that email on to another address, and you never see the email.
The bang (!) in the action line does this. That address does not have
to be on your network. The email is passed off to your local mail
transport agent (maybe sendmail), which then determines what to do with
it. Note that we do not have the "w" flag here, because procmail doesn't need to
wait for anything.
<pre>
:0
* ^To: staff@quillandmouse\.com
! nancyf@quillandmouse.com
</pre>
<hr>
<p>
Last is a slightly more complicated one. We're looking for email from
the procmail list, and we're saving off the text of the "Subject" line.
We're going to munge the subject by adding "[PROCMAIL]" to the subject
line, and we're going to add a "Reply-To" header line. We do this with
one formail command by giving it two separate sets of parameters. In
the first one, we use an "I" parameter, which says to rewrite that
header field and discard the original one. The second set uses the "i"
parameter, which doesn't tell procmail to discard any original
"Reply-To" fields, but simply to add a new one.
<pre>
:0 w
* ^Sender: procmail-admin@lists\.rwth-aachen\.de
* ^Subject:\/.*
| formail -I "Subject: [PROCMAIL]\$MATCH" \
-i "Reply-To: procmail@informatik.rwth-aachen.de ">> \$DEFAULT
</pre>
<p>
<strong>Paul M. Foster</strong>
<hr>
<a name="dupemails"></a>
<h4>Question</h4>
<p>
I keep getting all these duplicate emails. While I'm getting the problem
fixed, is there a way to turn them off?
<h4>Answer</h4>
<p>
According to <b>man procmailex</b>, you may use the following recipe at
the beginning of your <b>~/.procmailrc</b> file to kill duplicates:
<p>
<pre>
:0 Wh: msgid.lock
| formail -D 8192 msgid.cache
</pre>
<p>
This creates an 8K cache of message IDs, and checks them each time
procmail is run (every message). It kills duplicate messages. If you are
paranoid and want to take a
look at all the dupes just to make sure, change the above to two recipes,
like this:
<p>
<pre>
:0 Whc: msgid.lock
| formail -D 8192 msgid.cache
:0 a:
duplicates
</pre>
<p>
<strong>Paul M. Foster</strong>
<hr>
<a name="idetape"></a>
<h4>Question</h4>
<p>
How do I get my IDE/ATAPI tape drive working?
<h4>Answer</h4>
<p>
Ide ATAPI tape drives work with Linux using scsi-emulation -- forget
about using the ide-tape module.  Most kernels out of the box do not
have scsi-emulation set up since it conflicts with other tape drive
support.  You have to configure and compile a kernel with a particular
group of seemingly un-related things turned on and others turned off.
It does work and work well *IF* you get it right.
<p>
Thanks to a posting by Timothy Moore (timothymoore@bigfoot.com) that was
discovered and brought to my attention by Bob Snibbe and whose web link
got permanently lost in my vast underground caverns, I present to you my
abbreviated version of Tim's ATAPI tape drive howto:
<ol>
<li>
Kernel configuration:  Under BLOCK DEVICES select SCSI emulation
support( if you manually edit .config or check it after configuration it
will be called CONFIG_BLK_DEV_IDESCSI).  Under SCSI support (yes I know
it's NOT a SCSI device! The kernel will see it as one though) select
SCSI tape support (CONFIG_SCSI, CONFIG_CHR_DEV_ST) and <i>deselect</i>
IDE/ATAPI tape support(CONFIG_BLK_DEV_IDETAPE).
<li>
2.  rebuild kernel, install, lilo etc....
<li>
3.  If successful you'll see at boot up something like:
<pre>
kernel: hdb:  YADA YADA ATAPI Tape drive
...
kernel: SCSI host adapter emulation for IDE ATAPI devices
...
kernel: Detected scsi tape st0 at scsi1, channel 0, id0 lun 0.
</pre>
You'll use /dev/st0? and /dev/nst0? .  Most people link /dev/tape to the
device (ln -s /dev/st0 /dev/tape)
<li>
To test, put a tape in and type
<pre>
mt -f /dev/tape status
</pre>
or use the tar command save and read back a small file.
<li>
To save a file:
<pre>
tar cvf /dev/st0 myfile
</pre>
<li>
To read it back:
<pre>
tar tvf /dev/st0
</pre>
</ol>
<p>
<strong>
Ed Centanni
</strong>
<hr>
<a name="time"></a>
<h4>Question</h4>
<p>
How do I set the time on my computer?
<p>
<h4>Answer</h4>
<p>
There are two kinds of time to deal with. First is the <i>system</i> time,
second is the <i>CMOS</i> time. The system time is the time that Linux keeps
in its memory as it's running. The CMOS time is the time kept by your CMOS
(backed up by its battery, and running even when your computer is powered off).
You can set the system time, but the next time your computer powers off, the
system time will revert to whatever your CMOS says. So in order to make
everything work together, you need to set both the system time and the CMOS
time.
<p>
One additional factor is important-- what you use as a reference for time.
The best way to do this is to find an <b>ntp</b> (Network Time Protocol) server
on the internet. There are many many of them. You can search for "ntp server"
on Google, or go to <a href="http://www.eecis.udel.edu/~mills/ntp/servers.htm">
www.eecis.udel.edu/~mills/ntp/servers.htm</a> for a write-up. Choose a server
in your time zone from the list.
<p>
Let's assume your time server is <b>tock.usno.navy.mil</b>. Having chosen
your time server, issue the following at the command line:
<pre>
ntpdate tock.usno.navy.mil
</pre>
<p>
This will set your system clock to the time signal broadcast by this ntp server.
Next, you want to ensure your CMOS clock matches your system time. Do this like
this:
<pre>
hwclock --systohc
</pre>
<p>
Remember, this is a one-time solution. You could set up a cron job to do this
periodically, but there is a better way if you're going to do this
frequently. That way is to use an <b>ntp daemon</b>. To make this work, you
need to set up a config file called /etc/ntp.conf. In it, you would put
something like this:
<pre>
server tock.usno.navy.mil
driftfile /etc/ntp.drift
</pre>
<p>
Once you've done this, run the <b>ntpd</b> or <b>xntpd</b> command on your
system. This will set up the daemon to periodically check and set the time
on your system.
<p>
To check your system date, you can issue the <b>date</b> command. To see your
CMOS time, issue <b>hwclock --show</b>
<p>
There is much more to know about this. See <b>man rdate</b>, <b>man ntpd</b>,
<b>man ntpdate</b> and/or <b>man xntpd</b>.
<p>
<strong>
Paul M. Foster
</strong>
<hr>
<a name="irqs"></a>
<h4>Question</h4>
<p>
What's the deal with IRQ/DMA/IO Addresses?
<h4>Answer</h4>
<p>
IRQs and I/O Addresses, etc. First, get little booklet called
"Pocket PCRef". This has everything you ever wanted to know about PC
hardware. Standard pinouts for things, ASCII charts, IRQ lists, lists of
old DOS commands, specs for every hard drive known to Man, phone numbers
for manufacturers, etc. Cost is about $20, I believe, and it fits in a
shirt pocket (smaller than a paperback novel).
<p>
Now, IRQs. The AT-class PC has two interrupt controllers, chained to
each other. Each controls 8 interrupts for a total of 16. (Yes, it's
woefully inadequate, which is why we have USB and such now.) A list is
below:
<p>
<pre>
IRQ	Function
0	timer interrupt
1	keyboard interrupt
2	chained to second interrupt controller
        (can be used, but beware)
3	interrupt for second serial port
        (COM2 under DOS, /dev/ttyS1 under Linux)
4	interrupt for first serial port
        (COM1 under DOS, /dev/ttyS0 under Linux)
5	interrupt for second parallel port
        (usually isn't one, so free)
6	floppy disk controller interrupt
7	interrupt for first parallel port
        (LPT1 in DOS)
8	real time clock interrupt
9	chained to first interrupt controller
10	free
11	free
12	free
13	math coprocessor interrupt
        (dunno if used on Pentium class)
14	hard drive controller (IDE)
15	hard drive controller (IDE)
</pre>
<p>
The "free" interrupts above (and IRQ 5) are only "free" if something
else isn't using them. Sound cards use interrupts, video controllers use
interrupts, NIC cards use interrupts, etc. PnP is designed to circumvent
some of this, but IMHO, it sucks badly. With NICs, I _always_ buy NICs
that have a setup program that allows me to _set_ the IRQ the way I
want, usually IRQ 5.
<p>
I/O addresses are another story, and there are one or more for each
interrupt used. These are particular areas of memory used to transfer
bytes directly back and forth from hardware devices, without a lot of CPU
overhead. These are more variable than IRQs, but typically for the more
used IRQs, the addresses are:
<p>
<pre>
IRQ	I/O Address
3	0x2f8-0x2ff
4	0x3f8-0x3ff
5	0x278-0x27f
7	0x378-0x37f
</pre>
Likewise DMA channels, though there are far fewer of them and not all
devices use them. In general, the floppy disk controller typically uses
DMA channel 2.
<p>
<strong>
Paul M. Foster
</strong>
<hr>
<A NAME="nice"></A>
<h4>Question</h4>
<p>
What's the difference between the nice value and the priority value in the
top program? When I change the nice value to X to reduce the impact of a process
on system performance, the priority goes up to X as well. Should I change the
priority to a lesser value or should it do it on its own when I increase the
nice value?
<p>
<h4>Answer</h4>
<p>
This is a function of the scheduler.
<p>
The process priority is dynamic and constantly changing.
The nice value of a process is generally static, although you can
"renice" a running process as often as you wish.
<p>
The lower the priority of a process, the more likely it is to be run.
<p>
The nice value is added to the priority of a process to adjust its
importance. A positive nice value will make a process less important. A
negative nice value will make a process more important.
<p>
The nice value is just a basis for the priority. The scheduler changes
the priority of a process while it is running. If a process is resource
intensive, its priority will drop in the scheduler (the priority number
will grow as it is penalized for using resources) to allow other
processes with lower priority to run.
<p>
Think of the nice value as a "priority baseline". As a process gets more
time to run, its priority number will grow to the point where it exceeds
the priority of other jobs on the system with lower priorities. Once the
lower priority processes have had their chance.
<p>
Process priority is based on a number of factors aside from simple
aging, however. CPU use, memory use, IO wait time, and dozens of other
factors go in to recomputing the constantly changing priorities of
processes on your system. This is what the scheduler does. Changing the
behavior of the scheduler can change the entire "feel" of your computer
(making it more/less interactive, or running long-running compute jobs
more/less efficiently).
<p>
Giving a positive nice value will penalize a process so that it will
always schedule last after everything else has a chance to run.
<p>
Giving a negative nice value will give a process preference over other
running processes on the system. The more negative the nice value, the
less likely other jobs will be given a chance to run.
<P>
To answer your question though, yes the system should update the
priority to start at the niceness value you set. In fact, it should
generally never drop below the nice value - at least with the current
scheduler, AFAIK.
<P>
<strong>
- Ian C. Blenke
</strong>
<hr>
<p>
<a name="superblock"></a>
<h4>Question</h4>
<p>
What's a "super block"? How do you fix it with fsck? Can you?
<p>
<h4>Answer</h4>
<p>
The Superblock contains the size, shape, version, and state of the
filesystem. Things like block size, first inode, blocks per group, free
blocks, free inodes, mount count, maximum mount count, last time
mounted, last time written to, and flags that show the state of the
filesystem (ie, clean unmount) are stored on the superblock.
<p>
When you create an ext2 filesystem many "alternate superblocks" are
stored as backups in case the primary superblock is lost, overwritten,
corrupt, or otherwise unusable. Usually, only the main Superblock in
block group 0 is read when you mount an ext2 filesystem.
<p>
For example, everyone can try this one without hurting anything to see
these superblocks being written:
<p>
<pre>
	$ dd if=/dev/zero of=foo.img bs=1M count=500
	$ mke2fs foo.img
	mke2fs 1.18, 11-Nov-1999 for EXT2 FS 0.5b, 95/08/09
	foo.img is not a block special device.
	Proceed anyway? (y,n) y
	Filesystem label=
	OS type: Linux
	Block size=1024 (log=0)
	Fragment size=1024 (log=0)
	128016 inodes, 512000 blocks
	25600 blocks (5.00%) reserved for the super user
	First data block=1
	63 block groups
	8192 blocks per group, 8192 fragments per group
	2032 inodes per group
	Superblock backups stored on blocks:
	8193, 24577, 40961, 57345, 73729, 204801, 221185, 401409
	Writing inode tables: done
	Writing superblocks and filesystem accounting information: done
</pre>
<p>
Those comma separated numbers are the alternate superblocks.
<p>
To repair a Unix filesystem, you use "fsck" (FileSystem ChecK). Each
type of filesystem (ext2, reiserfs, xfs, etc) have their own independant
runtimes that check that specific type of filesystem (fsck itself is not
all-knowing). As fsck calls these executables after it identifies what
type of filesystem it is (either via /etc/fstab, by the "-t" command
line option, or by checking the magic identifier stored in the
filesystem), there is a naming convention: "fsck.{filesystem type}", ie:
"fsck.ext2", "fsck.xfs", etc. You will find these in /sbin/fsck*
<p>
If the primary superblock is lost, fsck.ext2 (aka e2fsck) should be able
to read one of the backup superblocks to restore the filesystem.
<p>
To try this, do:
<p>
<pre>
	# losetup /dev/loop0 foo.img
	# dd if=/dev/zero of=/dev/loop0 size=1024 count=2
	# mount -t ext2 /dev/loop0 /mnt
	mount: wrong fs type, bad option, bad superblock on
	/dev/loop0,or too many mounted file systems
</pre>
<p>
oops! :) This is the error you are seeing. Now we will fix it:
<pre>
	# fsck.ext2 -f -y /dev/loop0
	Parallelizing fsck version 1.18 (11-Nov-1999)
	e2fsck 1.18, 11-Nov-1999 for EXT2 FS 0.5b, 95/08/09
	Couldn't find ext2 superblock, trying backup blocks...
	Pass 1: Checking inodes, blocks, and sizes
	Pass 2: Checking directory structure
	Pass 3: Checking directory connectivity
	Pass 4: Checking reference counts
	Pass 5: Checking group summary information
	/dev/loop0: ***** FILE SYSTEM WAS MODIFIED *****
	/dev/loop0: 11/128016 files (0.0% non-contiguous),
	16169/512000 blocks
</pre>
<p>
Note the "Couldn't find ext2 superblock, trying backup blocks".
<p>
If fsck.ext2 can't automagically find the backup blocks, you can
implicitly tell it to use an alternate backup block:
<p>
<pre>
	# fsck -b 8193 -f -y /dev/loop0
</pre>
<p>
You can find "ESL" (Ext2 Superblock Locator) on the 'net as well, should
you not know what alternative superblock backups were used by your
filesystem (it looks for the ext2 superblock magic on every block on a
selected partition).
<p>
(fsck.ext2 needs a block device to check, thus the need for losetup
of /dev/loop0.. you can't "fsck foo.img", which is rather irritating.
I'd much rather use "mount -o loop foo.img /mnt")
<P>
<strong>
Ian C. Blenke
</strong>
<hr>
<p>
<a name="blanking"></a>
<h4>Question</h4>
<p>
How do I turn off screen blanking at the console?
<p>
<h4>Answer</h4>
<p>
Some people are annoyed by the fact that Linux blanks the console after
a certain time by default. You can fix this by issuing this command:
<pre>
setterm -blank 0
</pre>
You can, of course, change the 0 on the end to something else. It is the
interval, in minutes (up to 60) after which the console will blank.
<p>
<strong>
Paul M. Foster
</strong>
<p>
<a name="iptables"></a>
<h4>Question</h4>
<p>
Where's that dang IPTABLES script by Derek I keep hearing about?
<p>
<h4>Answer</h4>
<p>
Here the famous iptables script created by Derek Glidden. Substitute the
appropriate values with your own in the top of the files. I've made some
documentation changes for clarity.
<pre>
#!/bin/sh
# Change these to suit your installation
INTERNAL_NET="192.168.1.0/24"
INTERNAL_IFACE="eth1"
EXTERNAL_IFACE="eth0"
## Disable routing while we update tables
echo 0 > /proc/sys/net/ipv4/ip_forward
## Insert connection-tracking modules
## (not needed if built into kernel).
modprobe ip_conntrack
modprobe ip_conntrack_ftp
modprobe ip_nat_ftp
## Flush all existing rules
iptables -F
iptables -X
iptables -t nat -F
iptables -t nat -X
## Set up IP Masquerading for internal network
iptables -t nat -A POSTROUTING -o \$EXTERNAL_IFACE -s \
\$INTERNAL_NET -j MASQUERADE
## Set up FORWARD rules for internal network
## Allow related connections, new connections from
## the inside network, drop everything else
iptables -A FORWARD -m state --state RELATED,ESTABLISHED \
      -j ACCEPT
iptables -A FORWARD -i \$INTERNAL_IFACE -m state \
     --state NEW -j LOG --log-level info \
     --log-prefix "NEW FORWARD: "
iptables -A FORWARD -i \$INTERNAL_IFACE -s \$INTERNAL_NET \
     -j ACCEPT
iptables -A FORWARD -j LOG --log-level info \
     --log-prefix "DROP FORWARD: "
iptables -A FORWARD -j DROP
## Set up INPUT rules to allow traffic directly to the box
## Only allow SSH from the outside world
## Allow anything from the internal network
iptables -A INPUT -m state --state ESTABLISHED,RELATED \
      -j ACCEPT
iptables -A INPUT -i \$EXTERNAL_IFACE -p tcp --dport 22 \
-m state --state NEW -j LOG \
      --log-level info --log-prefix "NEW SSH INPUT: "
iptables -A INPUT -i \$EXTERNAL_IFACE -p tcp \
      --dport 22 -j ACCEPT
iptables -A INPUT -i \$INTERNAL_IFACE -s \$INTERNAL_NET \
      -j LOG --log-level info --log-prefix "NEW INPUT: "
iptables -A INPUT -i \$INTERNAL_IFACE -s \$INTERNAL_NET \
      -j ACCEPT
iptables -A INPUT -j LOG --log-level info \
      --log-prefix "DROP INPUT: "
iptables -A INPUT -j DROP
## Log new "OUPUT" connections to keep an eye
## on what our firewall is up to
iptables -A OUTPUT -m state --state ESTABLISHED,RELATED \
      -j ACCEPT
iptables -A OUTPUT -m state --state NEW -j LOG \
     --log-level info --log-prefix "NEW OUTPUT: "
iptables -A OUTPUT -m state --state NEW -j ACCEPT
## Re-enable routing now we're done changing things
echo 1 > /proc/sys/net/ipv4/ip_forward
</pre>
<p>
<strong>
Paul M. Foster (script is Derek's)
</strong>
</div>
END;
page_footer();
?>