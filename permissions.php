<?php
require_once('template.php');
page_header('Linux Permissions');
echo <<<END
<div id="content3">
<H3>The SLUG Presentation Series</H3>
<P>
<b>Permissions</b> allow the owner of the file/directory to specify who
has access to the file or directory and how they can use it. It should be
noted that directories are treated like files on Linux systems, so they
have permissions just like regular files. There are three basic types of
permissions.
</P>
<P>
<B>
Read
</B>
<p>
Read permission allows the user to view the contents of a file (for
example, with an editor). On directories, read access allows you to list
the directory contents.
<P>
<b>
Write
</b>
<p>
Write permission allows the user to modify the contents of a file, but not
delete or rename it. For directories, write permission allows the user to
create new files and delete or rename existing files in a directory.
<p>
<b>Execute</B>
<p>
Execute permission allows the user to run a file as a program. The file
should either be a shell script or a compiled executable program. (If you
execute something that isn't really executable, unexpected errors will
result.) For directories, execute permission is much more involved.
<p>
For directories, execute permission means that if you or your group (see below
regarding ownership) has
execute permissions, you can list the directory's contents, read the
directory's files (assuming you have read permissions for the files you want
to read), and change your working directory to this directory. If a user
or group doesn't have execute permissions to a directory, they can't read
or list anything in it, regardless of the permissions on individual files.
Oddly, if you have read but not execute permission on a directory, and you
try to list files in the directory, you'll get an error message that lists
the contents of the directory.
<p>
<b>
Ownership
</b>
<p>
Each user on a Linux system has a unique number associated with him or her
that is his or her "userid". That's in addition to their user name on the
system. User IDs often start at 500 for regular users. In addition, each
user may have more than one <b>group</b> he belongs to. Groups are
represented by numbers as well, often also starting at 500. Although a
user may be associated with more than one group, files and directories can
only have one group they are associated with.
<p>
<b>
Examples
</b>
Here's the output of the <b>ls -l</b> command in a sample directory:
<pre>
-rw-r--r--   1 paulf    users       17989 Jun 21  1999 COPYING
lrwxrwxrwx   1 paulf    users          17 May  4 23:33 Changelog ->
content/Changelog
-rw-rw-r--   1 paulf    users         528 Jun 21  1999 Makefile
-rw-rw-r--   1 paulf    users         972 Jun 21  1999 README
drwxrwxr-x   2 paulf    users        4096 Aug  4  1999 bin
drwxrwxr-x   3 paulf    users        4096 Aug  4  1999 content
drwxrwxr-x   5 paulf    users        4096 Jul 16  1999 examples
-rwxr-xr-x   1 paulf    users       21231 Aug  4  1999 genpage
-rw-rw-r--   1 paulf    users         424 Jul 31  1999 genpage.conf
drwxrwxr-x   2 paulf    users        4096 Jul 16  1999 include
drwxrwxr-x   2 paulf    users        4096 Jul 31  1999 layout
drwxr-xr-x   2 paulf    users        4096 Jul 16  1999 news.themes
drwxr-xr-x   3 paulf    users        4096 Feb 16 01:16 www
</pre>
<p>
First, let's look at the far left hand column. You see an array of letters
that indicate what kind of thing is being talked about and the permissions
assigned to it. That <i>permission string</i> is divided into four groups. The
first group is just one letter. In our case, it is either a dash (<b>-</b>), a
<b>d</b>
or an <b>l</b>. The dash means that this file is just a regular file. A <b>d</b> means
that this "file" is really a <i>directory</i>. An <b>l</b> is a special case of a
file. It's a <i>link</i>. In Linux, you can make a <i>link</i> that points to
another file or directory. In our case, it's a link called Changelog in
the current directory, but the real file is called by the same name in the
content subdirectory. (Note the <b>-&gt;</b> that shows where the <i>link</i>
points to.
<p>
The other three groups are three letters each, and are all very
similar. The first group of three letters is the permissions for the owner
of the group. Let's look at the <b>genpage</b> file above. The genpage
file is a regular file, as shown by that first dash (<b>-</b>) on the left. The
second set of three characters are <b>rwx</b>. Remember that there are three
types of permissions: <b>read</b>, <b>write</b> and <b>execute</b>. And that's what the
<b>rwx</b> string there indicates. This file has read, write and execute
permissions for the owner of the file.
<p>
Let's look at the second set of three characters. These apply to the group
that the owner belongs to. These are <b>r-x</b> for the genpage file. Notice
that the second <b>w</b> character has been replaced by a dash (<b>-</b>). This file
has read and execute permissions, but not write permissions for the group
the user belongs to. So other members of the user's group can read the
file, execute it, but they can't modify, delete or rename it.
<p>
The last set of three permission characters apply to everyone else besides
the user and his group. They would apply, for instance to some other user
on the system who isn't part of the user's group. For the genpage file,
these are the same as they were for the group, <b>r-x</b>. But these apply to
others. So anyone else on the system can read this file and can execute
it, but they can't modify, delete or rename it.
<pre>
-rwxr-xr-x   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
Now, let's look at the rest of the line. The next thing you see is a
number. This is the number of <i>links</i> to a file. Remember links? You can
have many links that point to a single file, if you like, but in our case,
there is only one link, the file itself.
<p>
Next you see the user name for the owner of the file. Next is the group
that the file belongs to. Incidentally, this may or may not be a group the
user himself belongs to.
<p>
Next you see a number, which is the size in bytes of this file.
<p>
Next you see a date, in our case the 4th day of August, 1999. This is the
date and time of the file's last modification.
<p>
Last, you see the name of the file.
<p>
Now let's look at a directory.
<pre>
drwxrwxr-x   5 paulf    users        4096 Jul 16  1999 examples
</pre>
<p>
This is obviously similar to the <b>genpage</b> file, in that it's owned by the
same person and the same group. The size is smaller. For directories,
<i>file size</i> usually relates to the number of files contained in that
directory. In our case it doesn't mean that there are 4096 files in the
directory, just that Linux has set aside this much space to hold the
actual directory entry. But there's no direct correlation between the
number of files in a directory and the size of the directory entry in
bytes.
<p>
Let's look at the permission string. This is a directory, as we can see
from that first <b>d</b>. The second set of three characters relate to the
owner's permissions, and are <b>rwx</b>, as before. But this is a directory.
The read permission means the owner can read what's in the directory. The
write permission means the owner can create and delete files in that
directory. The execute permission means the same as the read permission in
this case: the owner can list the contents of the directory.
<p>
Now, the second set of three permission characters are the same as the
first set. That means that members of the group for this directory have
the same rights as the owner of the directory. They can list the
directory's contents, read, write, create and delete files in this
directory.
<p>
The last set of three characters is <b>r-x</b>. Again, the write permission has
been dropped for everybody besides the owner and his group. Anyone else
can take a look at what's in the directory (read and execute permissions),
but they can't write files in this directory. So they can't make up their
own files and put them in this directory, or tamper with the files that
are already in there.
<p>
<b>
Numeric Permissions
</b>
<p>
Up until now, we've dealt with permissions in terms of the letters <b>r</b>, <b>w</b>
and <b>x</b>. This is the way you see them with the <b>ls -l</b> command. But there are
other commands that can use an alternate way of showing permissions, and
it's important to be able to understand this alternate way. This new way
shows permissions by <i>numbers</i>.
<p>
For those of you who are math impaired, here is a table that shows how
permission strings map to numbers. For those who are mathematically inclined,
a more technical explanation appears below.
<p>
<pre>
no permissions             ---   0
execute only               --x   1
write only                 -w-   2
write and execute          -wx   3
read only                  r--   4
read and execute           r-x   5
read and write             rw-   6
read, write and execute    rwx   7
</pre>
<p>
These numbers apply to each type of permission in the <i>permission string</i>.
So for a permission string of
<pre>
rwxrw-r-x
</pre>
the number would be (from the table): <b>765</b>. The first set of permissions
(the owner's) is <b>rwx</b>, which translates to <b>7</b> from the table. The
next (the group's) is <b>rw-</b>, which is <b>6</b> in the table. The third
(everyone else's) is <b>r-x</b>, which is <b>5</b> in the table. String them
together and you get <b>765</b>.
<p>
<table border="1" cellpadding="5">
<th>
Technical - Numeric Permissions
</th>
<tr>
<td>
Numeric permissions are based on the fact that permissions are stored as
numbers in the directory entries for files. Each individual permission
(<b>r w</b> or <b>x</b>) can take on one of two values-- the permission is
either there or it isn't. These can be translated into <b>1</b> (the permission
is granted) or <b>0</b> (it isn't). Each type of permission (<b>owner</b>,
<b>group</b> or <b>other</b>) has a permission string associated with it
(<b>rwx</b> for example), and we can express each of these permissions as a
binary (<b>1</b> or <b>0</b>) value.
<p>
Following this logic, an owner's permission of <b>rwx</b> would have all three
permissions "on", and could be represented by <b>111</b>. Likewise, a group
permission string of <b>r-x</b> could be represented by <b>101</b>. While these
look like a simple string of 1's and 0's, they are actually binary numbers.
Recall from studying other bases in mathematics that the rightmost digit in any
base number represents the number of ones of the number. That's the "one's"
digit in any base. The next digit will represent the base itself. So, for
instance, the number 21 is 2 * 10 (the base) and 1 * 1. The third number will
be the square of the base, the fourth will be the cube of the base, and so
on. So the base 10 number 5280 (the number of feet in a mile) is really
5000 (or 5 times 10 to the third power or "cubed"), plus 200 (or 2 times 10
to the second power or "squared"), plus 80 (or 8 times ten to the first power,
or simply ten), plus 0 or no ones. Binary numbers (base 2 follow a similar
pattern. The first digit is ones, the second is twos, the third is fours (two
squared), the fourth is eights (two cubed), etc. In this context, the binary
number 111 would be (1 * 4) + (1 * 2) + (1 * 1) = 7. The number 101 would
likewise be (1 * 4) + (0 * 2) + (1 * 1) = 5.
<p>
Representing permissions as binary numbers is cumbersome, especially since
we're dealing with three sets of permissions (owner, group and others). A
permission string of <b>rwxr-xr--</b> would come out as 111101100. However,
since each of the individual types of permissions can range from 0 (000 in
binary) to 7 (111 in binary), it's simpler to represent permissions as
octal numbers (0 to 7). Here is the permission string above, and how it
maps out in binary and octal:
<pre>
rwxr-xr--
111101100
 7  5  4
</pre>
And here is another one:
<pre>
r-xrwx--x
101111001
 5  7  1
</pre>
As you can see, representing permissions a octal numbers is much simpler
than binary. There are cases where it is more convenient to use numeric
permissions rather than permission strings, so even if you can't remember
off the top of your head how they map out, you at least know how to derive
the appropriate numbers from a permission string.
</td>
</tr>
</table>
<p>
<b>
The <i>chmod</i> command
</b>
<p>
Here's where all this permission stuff becomes useful. Let's say you want
to change the permissions of a file or a directory for some reason. Let's
say you created a shell script, and now you want to make it executable (it
won't run unless you do). Let's say your shell script looks like this when
you run the <b>ls -l</b> command (<b>ls -l genpage</b>):
<pre>
-rw-rw-r--   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
We can use the <b>chmod</b> command to give it execute permission this way:
<p>
<pre>
chmod +x genpage
</pre>
<pre>
-rwxrwxr-x   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
Now you can see that we made it executable for everyone. The <b>+x</b> in the
chmod command means "add executable permission all around".
<p>
Now let's say we don't want anyone reading this file, not even
ourselves. We can do this:
<p>
<pre>
chmod -r genpage
</pre>
<pre>
--wx-wx--x   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
Now you can see we've removed the read permission for everyone. Kinda
goofy, since now the owner can't even read it.
<p>
So far, we've changed permissions "globally" for our file. That is, we've
changed read and execute permissions for everyone. But let's say that we
just want to make the file readable by the owner and no one else.
<p>
<pre>
chmod u+r genpage
</pre>
<pre>
-rwx-wx--x   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
Ah, now I can read my own file again. The <b>u+r</b> means "add read permission
for the user who owns the file". But let's say it's not really that
secret, and we'd like other members of my group to read it as well (but no
one else).
<pre>
chmod g+r genpage
</pre>
<pre>
-rwxrwx--x   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
Now I can read it and my group can read it. The <b>g+r</b> means "add read
permission for other members of the group."
<p>
There are all kinds of combinations that follow the same pattern. As we've
seen, <b>u</b> represents the user who owns the file, and <b>g</b> is the
group. There are two other letters that operate similarly. The first is
<b>o</b> which stands for "others". These are those other people not lucky
enough to be in your group. The last letter is <b>a</b> for "all". That
includes the user who owns the file (<b>u</b>), the group (<b>g</b>) and others
(<b>o</b>). Notice that when we first changed permissions on this file, we just
said
<pre>
chmod +x genpage
</pre>
<p>
That changed the execute permission for everyone. As you might have
guessed, that's the same as saying
<pre>
chmod a+x genpage
</pre>
<p>
If you leave off <b>a</b> <b>u</b> <b>g</b> <b>o</b> or <b>a</b>, chmod assumes that you mean <b>a</b>, which
is why the first command changed the executable permission for all users.
<p>
Of course, you can eliminate permissions the same way you add them:
<pre>
chmod o-x genpage
</pre>
<p>
would eliminate executable permissions for other users (but not you or
your group). The result would be:
<pre>
-rwxrwx---   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
In addition to the <b>-</b> and <b>+</b> characters, you can use the <b>=</b> character to set
the permissions the way you want (as opposed to adding or subtracting
permissions.
<pre>
chmod u=r genpage
</pre>
<p>
This would make read permission the only one the owner has for this file:
<pre>
-r--rwx---   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
You can also do more than one thing at once with the chmod command:
<pre>
chmod u=w,o+x genpage
</pre>
<p>
This would make the owner only able to write the file (not read it) and
add execute permission for all the non-group users:
<pre>
--w-rwx--x   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
Obviously, this can get kind of cumbersome if you want to set a lot of
permissions very specifically on a file or set of files. The answer is to
set the permissions <i>numerically</i>. Let's take our original file:
<pre>
-rw-rw-r--   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
What are the numeric permissions on this file as it stands right
now? Recall from the table that <b>rw-</b> is <b>6</b> and <b>r--</b> is <b>4</b>. So the permissions
on this file would be <b>664</b>.
<p>
What if we want to give executable permissions to everyone? In that case,
the permission string would look like this:
<pre>
rwxrwxr-x
</pre>
<p>
Looking at the table, <b>rwx</b> is <b>7</b> and <b>r-x</b> is <b>5</b>. So numerically, the
permissions on this file would be <b>775</b>. If we wanted to make chmod change
the permissions numerically, we would say:
<pre>
chmod 775 genpage
</pre>
<p>
Note that with numeric permissions, it isn't possible to <i>add</i> and
<i>delete</i> permissions. With numeric permissions, you have to specify
exactly what the permissions would be for the owner, group and others all
at the same time.
<p>
You may not use numeric permissions much, but old hands at Unix and Linux
use them because they allow you to specify exactly what the file
permissions should be without a lot of gobbledegook in the chmod
command. After a while you just know that <b>r-x</b> equals <b>5</b> and <b>rwx</b> is <b>7</b>,
etc. But one of the biggest reasons for knowing numeric permissions is
that they are stored this way in the Linux file system. Linux doesn't
store an <b>x</b> and an <b>r</b>, etc. Linux stores these permissions in just a few
bytes in the directory entry for a file, and does so with numbers just
like these (though in this case they're stored as binary numbers).
<p>
This is not a definitive treatise on the <i>chmod</i> command. There are many
other things you can do with it. These are covered in the <i>chmod(1)</i> man
page.
<p>
<b>
Ownership
</b>
<p>
One last point. You can change permissions with the chmod command, but not
file ownership. For that, you use the chown command. Let's take our
original file:
<pre>
-rw-rw-r--   1 paulf    users       21231 Aug  4  1999 genpage
</pre>
<p>
One important thing to note. Unless you are the owner of a file or root,
you can't change the owner of a file to someone else. That is, if you're
Sam and the file belongs to Joe, you can't just randomly go changing
ownership on the file. You have to be root or the file's owner to do
things like this, and in the following examples, I'll assume the person
issuing the command <i>is</i> root.
<pre>
chown nancyf:users genpage
</pre>
<p>
Now we've changed the owner to <b>nancyf</b> and kept the group the same:
<pre>
-rw-rw-r--   1 nancyf   users       21231 Aug  4  1999 genpage
</pre>
<p>
Notice the colon (<b>:</b>) in the command above. This can be a period (<b>.</b>) as
well. The choice it up to you. The first item (<b>nancyf</b>) is the user, and
the second one (<b>users</b>) is the group.
<p>
There are lots of ways to use the <i>chown</i> command.
<pre>
chown nancyf genpage
</pre>
<p>
would change the owner to <b>nancyf</b> and leave the group untouched.
<pre>
chown nancyf: genpage
</pre>
<p>
would change the owner to <b>nancyf</b> and make the group the login group for
nancyf, regardless of what the group was before.
<pre>
chown :users genpage
</pre>
<p>
would change the group, but not the owner of the file. (This is similar in
function to the <i>chgrp</i> command.)
<p>
Again, there are more things that can be done with the chown command. For
more information, see the <b>chown(1)</b> man page.
<p>
<b>Paul M. Foster</b>
</div>
END;
page_footer();
?>