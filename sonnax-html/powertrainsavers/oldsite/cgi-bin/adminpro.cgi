#!/usr/local/bin/perl
#
# AdminPro version 2.5.5 by Craig Richards
# March 15, 2002
# 
# You may use AdminPro for evaluation purposes for up to 
# 10 days without charge. If you like and want to continue 
# using it, please send US$20.00 (single-user license) to: 
#                        Craig Richards
#                    14692 Walters Streeet 
#                    Corona, CA 92880-9777 
#  
# You may also pay your shareware fee online through the secure 
# RegNow website at:
# https://www.regnow.com/softsell/nph-softsell.cgi?item=4287-1 
#  
# Your encouragement and support enable me to continue to add new 
# features and develop new products designed to help streamline 
# your routine tasks.
# Go to http://www.CraigRichards.com/software/ for upgrade 
# information as it becomes available.
# 
# # # # # # # # # # # # # # # #
# 
# AdminPro is the only client/server application in the world 
# that empowers you to:
# 
#       * remotely navigate your domain
#       * perform two-click CGI debugging
#       * upload image or text files
#       * open, edit and save remote files without downloading
#       * rename files and directories
#       * download image or text files
#       * delete files
#       * create new directories
#       * change file and directory permissions
#       * delete directories
# 
# Beginning with AdminPro version 2.5, the parallel 
# development of and support for AdminFTP is discontinued since 
# AdminPro now runs in either "default" mode (comparable 
# to AdminFTP) or "administrator" mode within the single 
# application.
# 
# For information on the differences between "default" mode 
# and "administrator" mode, conditions for choosing one mode 
# over the other, and details on how to set User Preferences, 
# please reference the AdminPro User Guide at 
# http://www.CraigRichards.com/software/userguide/adminpro.html
# 
# 
# INSTALLATION INSTRUCTIONS - PLEASE READ COMPLETELY
# 
# You may need to change the path to Perl (above)
# A good alternate line is  #!/usr/local/perl
# or sometimes #!/usr/bin/perl
# Use whatever is at the top of any existing (working) scripts 
# on your server.
# 
# To include "warnings" in your reports, simply add  -w  
# after the path to perl at the top of the scripts you're 
# testing, i.e.    #!/usr/local/bin/perl -w
# 
# 
# INSTALLATION INSTRUCTIONS
# 
#--> Step 1: upload this file
# 
# Simply upload this file (as ASCII text) to any path 
# in your domain or at its root. If your server administrator 
# restricts executables to a cgi or cgi-bin directory, 
# that's where you'd want to put the adminpro.cgi file.
# 
#--> Step 2: set AdminPro's permissions (Unix/Linux)
# 
# On Unix/Linux and perhaps other servers, set the 
# file permissions for the adminpro.cgi document to 
# 755 (world executable or rwxr-xr-x).
# 
#--> Step 3: upload icon images (optional) 
#            d14x13.gif  dd14x13.gif 
#            f11x13.gif  fd11x13.gif 
#            e11x13.gif  ed11x13.gif  
#            f16x13.gif  i11x13.gif 
#            t9x13.gif   td9x13.gif
# 
# You may optionally upload the ten small icon images. 
# Do NOT change the names of the image files. You may now put 
# those image files anywhere in your domain - just identify 
# the path in the User Preferences below. AdminPro will 
# automatically determine their presence then read them 
# from your server. If they can't be found in either the 
# path you've specified or the same path as this document 
# (if you haven't set a path, they will be read into your 
# browser from the CraigRichards.com server.
# 
# That's it! Now open your browser and type:
# http://www.mydomain.com/path/adminpro.cgi
#            ^            ^   your domain and path go here)
# and read the Quick Reference to begin using AdminPro.
# 
# # # # # # # # # # # # # # # #
# 
# WHEN YOU USE AdminPro
# YOU AGREE WITH THE FOLLOWING DISTRIBUTION POLICY, LICENSE 
# AGREEMENT AND TERMS OF USE WHICH MAY CHANGE AT ANY TIME 
# WITHOUT NOTIFICATION. USERS ARE ENCOURAGED TO REFER TO 
# THE WEBSITE AT http://www.CraigRichards.com/software/userguide/adminpro-5.html 
# FOR THE MOST CURRENT DISTRIBUTION POLICY, LICENSING 
# AND TERMS OF USE.
# 
# AdminPro may be distributed via the Internet or included 
# on CD-ROM as long as the original source code, comments, 
# instructions and credits remain intact. AdminPro is 
# shareware and may not be individually sold by third 
# parties though it may be bundled with other software 
# whether that distribution contains other software that 
# is free, shareware, demo or sold. In essence, no other 
# parties should materially profit from distribution of 
# this script.
# 
# We encourage your questions, feedback and suggestions. 
# AdminPro is distributed as "shareware" so limited user 
# support is provided for licensed users. User agrees to 
# run this application for legal purposes at his/her own 
# risk, assumes all liability, and no warranty as to the 
# suitability or performance of AdminPro for your specific 
# purpose is stated nor implied. If dissatisfied with 
# AdminPro, discontinue use. Application, code, interface  
# and any derivative works are solely the intellectual  
# property of Craig Richards and is  
# (c)Copyright 2002 Craig Richards.  
# All rights reserved worldwide.
# 
# You are urged not to link to this script from any public 
# pages on your site as AdminPro displays all the paths and 
# documents on your site - even hidden ones. Public access to 
# AdminPro may compromise the security of your site 
# and/or server.
# 
# Send an email message to "CGI@CraigRichards.com" with your 
# comments and/or click on the "user survey" link in the 
# AdminPro interface.
# 
# # # # # # # # # # # # # # # #
#### 
#### USER PREFERENCES
 
#--> set "default" or "administrator" mode (optional)
   # 
   $promode=0; # 1 = default, 1 = administrator
   #        ^ set this value to 1 if AdminPro fails to 
   #          report any files or directories in default 
   #          mode. Toggling this option to 1 will likely 
   #          correct the problem.
   #          
   #          Please note that some server administrators 
   #          have blocked the use of AdminPro in 
   #         "administrator" mode. Contact your virtual hosting 
   #          service's customer support or server 
   #          administrator if you have any questions.
          
#--> access-restriction security (optional)
   # complete steps 1 and 2 below
   # (only if you use a static IP address)

#--> Step 1: input your static IP address here:
   #
   $ipaddress.="24.67.58.127\n"; # your IP goes here
   $ipaddress.="24.64.136.130\n"; # add another (and so on)...
   #
   # (for multiple users, just duplicate 
   # the line below to add more static IP addresses.)

#--> Step 2: turn on access-restriction security
   #
   $secure=1;
   #       ^ set to 1 to enable IP address security.
   #
   # note: failed access attempts are directed to a special 
   # error page located at CraigRichards.com

#--> show hidden files (optional)
   #
   $showhidden=0;
   #           ^ set this value to 1 to display files that 
   #             would be ordinarily hidden in most other 
   #             FTP software. Set the value here to 0 to 
   #             disable display of hidden files.

#--> allow directory deletion with contents (optional)
   #
   $subdirectory=0;
   #             ^ set this value to 1 to permit the permanent 
   #               deletion of directories that contain other 
   #               files or directories. Though this may save 
   #               you the tedium of opening up that directory 
   #               and deleting its contents, changing this 
   #               preference to 1 is not as safe as leaving 
   #               the preference set to 0.

#--> set date format display default (optional)
   # 
   $uk=0; # 0 is for US - 1 is for UK
   #   ^ set this value to 1 to display UK date format
   #     as "day-month-year"
   #     set to 0 to display US date format
   #     as "month-day-year"

#--> local/server time adjustment default (optional)
   # 
   $tz=2;
   #   ^ adjust this value to 
   #     subtract or add to the server's system clock
   #     to add 2 hours, for example, the value is 2
   #     subtract 3 hours by using the value -3 

#--> manual path editing default (optional)
   # 
   $dispath=0;
   #        ^ set this value to 1 to add a field to the form
   #          that will permit you to input the path in the
   #          server tree to which you'd like to navigate
   #          (most people just point and click so the default
   #          is set at 0 - disabled)

#--> set display color values (optional)
   #
   $c1="#006600";  # heads & borders - default: dark green
   $c2="#000000";  # text - default: black
   $c3="#E0E0E0";  # DIR table bg - default: gray
   $c3a="#CCCCCC"; # DIR alt table bg - default:  darker gray
   $c4="#E0E0E0";  # instruct/results bg - default: gray
   $c5="#000000";  # overall interface bg - default: black
   $c6="#7F007F";  # mouseover highlight (CCS) - default: violet
   $c7="#FFFFFF";  # mouseover text (CCS) - default: white
   $face="arial,helvetica,sans-serif"; # font set

#--> set path for icons (optional)
   # 
   $iconpath='/';
   #          ^ type your /path after this slash
   #
   # identify the path from the domain root into which 
   # you've uploaded the small icon graphics for AdminPro.
 
#--> set extensions for image files (optional)
   # simply add a pipe "|" character and extension. Files with
   # that extension will then display as an image file. 
   #
   $imagefiles='gif|jp*g|png|bmp|ico|pdf|swf|qt|mov';

#--> set file edit textarea dimensions (optional)
   # increase number values for larger textarea for editing
   #
   $tw=85; # the width of textarea field in columns
   $th=28; # the height of textarea field in columns

####
# # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # #
#                                           # #
# DO NOT CHANGE ANYTHING BELOW THIS POINT!  # #
#                                           # #
# # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # #
# 
# 
##########
# VARIABLES DEFINED

if ($ENV{CONTENT_TYPE}=~/multipart/i) {&transParse;}
else {&inParse;}
$sn=$ENV{SERVER_NAME};
$root=$ENV{DOCUMENT_ROOT};
$hst=$ENV{HTTP_HOST};
$hst=$ENV{SERVER_NAME} if (!$hst);
$fnt="<FONT SIZE=2 FACE=$face>";
$fnt1="<FONT SIZE=1 FACE=$face>";
$fnt1w="<FONT SIZE=1 COLOR=$c7 FACE=$face>";
$v="2.5.5";
$version="v $v";
$secflag="not restricted";
$prom="<BR>&nbsp;<FONT COLOR=$c6><FONT SIZE=2><B>administrator</B></FONT> mode</FONT>" if ($promode>0);
$dcnt=0; $fcnt=0;
$out="http://www.CraigRichards.com/restricted.html?"
."v=$v&sn=$sn&hst=$hst";
($host="$hst ")=~s/^www\.//g if ($hst);
$host.="AdminPro";

##########
# RESTRICTED-ACCESS SUBROUTINE

if ($secure>0) {&access;}
sub access {
 $ipmatch=0;
 foreach my $ip(split("\n",$ipaddress,)) {
 if ($ENV{REMOTE_ADDR}=~m/^$ip$/) {$ipmatch=1; last;}
 }
 if (!$ipmatch) {print "Location: $out\n\n"; exit;}
 else {$secflag="<FONT SIZE=2 COLOR=$c1><B>restricted</B></FONT>$prom";}
} 

##########
# CONDITIONAL VARIABLES DEFINED

&style;&xt;$title="File Administration & Debugging";
$t{'uk'}=$uk unless ($t{'uk'});
$usck=" CHECKED" if ($t{'uk'}==0);
$ukck=" CHECKED" if ($t{'uk'}==1);
$uk=$t{'uk'};
if (($t{'tz'}=~/\d+/)&&($t{'tz'}!=$tz)) {$tz=$t{'tz'};}
else {$t{'tz'}=$tz;}
$t{'dispath'}=$dispath unless ($t{'dispath'} ne $dispath);
$dispathck=" CHECKED" if ($t{'dispath'}==1);
$dispath=$t{'dispath'};

if ((!$iconpath)||($iconpath ne "/")) {$cgipath="$iconpath/";}
else {$ENV{SCRIPT_NAME}=~/^(.*)\/.+?\..+?$/; $cgipath="$1/";}
$icrtpth=$ENV{SCRIPT_FILENAME};
$icrtpth=$ENV{PATH_TRANSLATED} if ($ENV{PATH_TRANSLATED});
$icrtpth=~/^(.*)\/.+?\..+?$/;
if ((!$iconpath)||($iconpath ne "/")) {$cgirootpath="$root$iconpath/";}
else {$cgirootpath="$rut$1/";}

if (!$t{'run'}) {
	$t{'adminpro'}=$ENV{SCRIPT_NAME};
 if (!$rut) {$_=$icrtpth;} else {$_=$ENV{SCRIPT_NAME};}
 /^(.*)\/(.+?)\.(.+?)$/;
 $path=$1; $script=$2; $ext=$3;
 $goinst=1;
 }
else {
 $path="$t{'path'}";
 if ($t{'newfile'}||$t{'newdir'}=~/\w+/) {&runtest;}
 elsif (!$t{'test'}) {
 $goinst=1;
 }
 else {
  if (!(-e "$rut$path$t{'test'}")) {
  push(@error,"<TR><TD COLSPAN=2>$fnt <FONT COLOR=#FF0000>Sorry, could not find <B>$t{'test'}</B>.</FONT><BR>Check the file name and try again.</TD></TR>\n\n");
  $title="Error - File Not Found";
  }
  elsif ($t{'save'}) {
  push(@error,"<TR><TD COLSPAN=2>$fnt Success: The modified file <B>$t{'test'}</B> has been saved.</TD></TR>\n\n");
   $title="Success - File \"$t{'test'}\" Saved"; &save_edited;
  }
  elsif ($t{'edit'}) {
  $title="Text File Editor: \"$t{'test'}\""; &edit;
  }
  elsif ($t{'rename'}) {
  $title="Rename Item: \"$t{'test'}\""; &rename;
  }
  elsif ($t{'download'}) {
  &download;
  }
  else {
  &runtest;
  }
 }
}
&result;


##########
# SUB RENAME ITEM

sub rename {
#$|=1;
&head;
print "Content-type: text/html\n\n";
print <<"Edit_Result";
<HTML><HEAD><TITLE>$host $title</TITLE>

$style
</HEAD>
<BODY BGCOLOR=$c4 MARGINWIDTH=0 MARGINHEIGHT=0 LEFTMARGIN=0 RIGHTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 TEXT=000000 LINK=$c2 ALINK=#FF0000 VLINK=$c1 onLoad="JavaScript:document.renameitem.newname.focus();"><BASEFONT SIZE=2><A NAME="top"></A>$fnt1
$head<BR>
<CENTER><FORM NAME="renameitem" ACTION="$t{'adminpro'}" METHOD=POST>
<TABLE BGCOLOR=$c1 CELLPADDING=1 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER VALIGN=MIDDLE><TD><TABLE BGCOLOR=$c3a CELLPADDING=3 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER><TD>
<FONT SIZE=3 COLOR=$c1>Rename Item: <U><B>$t{'test'}</B></U></FONT><BR><BR>
<INPUT TYPE=HIDDEN NAME="uk" VALUE="$t{'uk'}">
<INPUT TYPE=HIDDEN NAME="tz" VALUE="$t{'tz'}">
<INPUT TYPE=HIDDEN NAME="dispath" VALUE="$t{'dispath'}">
<INPUT TYPE=HIDDEN NAME="adminpro" VALUE="$t{'adminpro'}">
<INPUT TYPE=HIDDEN NAME="path" VALUE="$t{'path'}">
<INPUT TYPE=HIDDEN NAME="test" VALUE="$t{'test'}">
<INPUT TYPE=HIDDEN NAME="run" VALUE="yes">
<INPUT TYPE=TEXT NAME="newname" VALUE="$t{'newname'}" SIZE=36 MAXLENGTH=48><BR><BR>
<INPUT TYPE=BUTTON VALUE="&lt; back" onMouseOver="window.status='click here to return to the previous page'; return true;" onMouseOut="window.status=''; return true;" onClick="JavaScript:history.go(-1); return true;" TITLE="click here to return to the previous page" STYLE="font:11pt $face;color:$c7;background-color:$c6;cursor:hand;"> &nbsp; <INPUT TYPE=RESET VALUE="reset this form" onMouseOver="window.status='click here to reset this form'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to reset this form" STYLE="font:11pt $face;color:$c2;background-color:$c7;cursor:hand;"> &nbsp; <INPUT TYPE=SUBMIT NAME="execute" VALUE="rename $t{'test'}" onMouseOver="window.status='click here to rename $t{'test'}'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to rename $t{'test'}" STYLE="font:11pt $face;color:$c7;background-color:$c1;cursor:hand;">
</TD></TR></TABLE></TD></TR></TABLE></FORM></CENTER>
</BODY></HTML>
Edit_Result
#$|=0;
exit;
}


##########
# SUB EDIT FILE

sub edit {
open(FILE,"$rut$path$t{'test'}");
binmode(FILE);
@b=<FILE>;
close (FILE);
while ($c=shift(@b)) {

$b.="$c";
}
push(@editfile,$b);
#$|=1;
&head;
print "Content-type: text/html\n\n";
print <<"Edit_Result";
<HTML><HEAD><TITLE>$host $title</TITLE>

$style
</HEAD>
<BODY BGCOLOR=$c4 MARGINWIDTH=0 MARGINHEIGHT=0 LEFTMARGIN=0 RIGHTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 TEXT=000000 LINK=$c2 ALINK=#FF0000 VLINK=$c1><BASEFONT SIZE=2><A NAME="top" onLoad="JavaScript:document.editfile.filecontent.focus();"></A>$fnt1
$head
<CENTER><FORM NAME="editfile" ACTION="$t{'adminpro'}" METHOD=POST>
<TABLE BGCOLOR=$c1 CELLPADDING=1 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER VALIGN=MIDDLE><TD><TABLE BGCOLOR=$c3a CELLPADDING=3 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER><TD>
<FONT SIZE=3 COLOR=$c1>Text File Editor: <U><B>$t{'test'}</B></U></FONT><BR>
<INPUT TYPE=HIDDEN NAME="uk" VALUE="$t{'uk'}">
<INPUT TYPE=HIDDEN NAME="tz" VALUE="$t{'tz'}">
<INPUT TYPE=HIDDEN NAME="dispath" VALUE="$t{'dispath'}">
<INPUT TYPE=HIDDEN NAME="adminpro" VALUE="$t{'adminpro'}">
<INPUT TYPE=HIDDEN NAME="path" VALUE="$t{'path'}">
<INPUT TYPE=HIDDEN NAME="test" VALUE="$t{'test'}">
<INPUT TYPE=HIDDEN NAME="run" VALUE="yes">
<TEXTAREA NAME="filecontent" COLS=$tw ROWS=$th WRAP=OFF STYLE="font:11pt courier,monospace;">@editfile</textarea><BR>
<INPUT TYPE=BUTTON VALUE="&lt; back" onMouseOver="window.status='click here to return to the previous page'; return true;" onMouseOut="window.status=''; return true;" onClick="JavaScript:history.go(-1); return true;" TITLE="click here to return to the previous page" STYLE="font:11pt $face;color:$c7;background-color:$c6;cursor:hand;"> &nbsp; <INPUT TYPE=RESET VALUE="reset this form" onMouseOver="window.status='click here to reset this form'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to reset this form" STYLE="font:11pt $face;color:$c2;background-color:$c7;cursor:hand;"> &nbsp; <INPUT TYPE=SUBMIT NAME="save" VALUE="save file: $t{'test'}" onMouseOver="window.status='click here to save $t{'test'}'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to save $t{'test'}" STYLE="font:11pt $face;color:$c7;background-color:$c1;cursor:hand;">
</TD></TR></TABLE></TD></TR></TABLE></FORM></CENTER>
</BODY></HTML>
Edit_Result
#$|=0;
exit;
}


##########
# SUB SAVE EDITED FILE

sub save_edited {
open (FILE,">$rut$path$t{'test'}");
binmode(FILE);
$t{'filecontent'}=~s/[\r\n]{2,4}/\n/g;
print FILE "$t{'filecontent'}";
close (FILE);
}


##########
# SUB DOWNLOAD FILE

sub download {
open(FILE,"$rut$path$t{'test'}");
binmode(FILE);
@b=<FILE>;
close (FILE);
while ($c=shift(@b)) {$b.="$c";}
push(@dl,$b);
#$|=1;
print "Content-Type: application/download
Content-Disposition: attachment; filename=$t{'test'}\n\n";
print @dl;
#$|=0;
exit;
}


##########
# SUB NEW DIR, CHMOD, DELETE OR TEST THE SYNTAX

sub runtest {
 if ($t{'newname'}) {
  if ($t{'newname'} eq $t{'test'}) {
 push(@error,"<TR><TD COLSPAN=2>$fnt <FONT COLOR=#FF0000>Failed:</FONT> Your new name for \"<B>$t{'newname'}</B>\" is the same as the original name. Renaming action not performed.</TD></TR>\n\n");
 $title="Failed - $t{'newname'} Exists";
 } elsif (-e "$rut$path$t{'newname'}") {
 push(@error,"<TR><TD COLSPAN=2>$fnt <FONT COLOR=#FF0000>Failed:</FONT> An item named \"<B>$t{'newname'}</B>\" already exists. Renaming action not performed.</TD></TR>\n\n");
 $title="Failed - $t{'newname'} Exists";
 } else {
  rename("$rut$path$t{'test'}","$rut$path$t{'newname'}");
  if (-e "$rut$path$t{'newname'}") {
  push(@error,"<TR><TD COLSPAN=2>$fnt Success: \"$t{'test'}\" has been renamed \"<B>$t{'newname'}</B>\"</TD></TR>\n\n");
 $title="Success - $t{'test'} Renamed $t{'newname'}";
   }
  }
 } elsif ($t{'newdir'}=~/\w+/) {
  if (-e "$rut$path$t{'newdir'}") {
 push(@error,"<TR><TD COLSPAN=2>$fnt <FONT COLOR=#FF0000>Failed:</FONT> A directory named \"<B>$t{'newdir'}</B>\" already exists.</TD></TR>\n\n");
 $title="Failed - $t{'newdir'} Exists";
 } else {
  mkdir("$rut$path$t{'newdir'}",0777);
  if (-e "$rut$path$t{'newdir'}") {
  push(@error,"<TR><TD COLSPAN=2>$fnt Success: The directory \"<B>$t{'newdir'}</B>\" has been created.</TD></TR>\n\n");
 $title="Success - $t{'newdir'} Created";
   }
  }
 } elsif ($t{'newfile'}) {&write_file;}
 &chmod;
 if (($t{'syntax'})&&($t{'test'})) {
 @all=`($rut$path$t{'test'} | 's/^/stdout:/') 2>&1`;
 for (@all) {push @{s/stdout://?\@outlines: \@errlines},$_}
  if (@errlines) {
   if (($ENV{SERVER_SOFTWARE}=~/(unix|linux)/i)&&(!(-x "$rut$path$t{'test'}"))) {
   push(@error,"<TR><TD COLSPAN=2>$fnt <FONT COLOR=#FF0000>Failed:</FONT> <B>$t{'test'}</B> does not appear to be executable.<BR>\nSet file permissions to 755 or 775 and test again.</TD></TR>\n\n");
  }
  foreach $errline(@errlines) {$qty++;
 $errline=~s/ (at|of) //g;
 $errline=~s/$rut$path$t{'test'}//g;
 $errline=~s/line /line&nbsp;/g;
 $errline=~s/</&#60;/g;
 $errline=~s/>/&#62;/g;
 $errline=~s/\//&#47;/g;
 $errline=~s/sh: : No such file or directory/Failed: Executable error due to invalid characters in the file &#150; Suggest re-upload $t{'test'} to server and test again./g;
 $errline=~s/sh: : //g;
 $error="<TR VALIGN=TOP><TD ALIGN=RIGHT>$fnt1 $qty</TD><TD>$fnt$errline</TD></TR>\n"; push(@error,$error);
  }
 $editlink="<TR><TD COLSPAN=2 BGCOLOR=$c3a ALIGN=CENTER>$fnt edit <B><A HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$t{'test'}&edit=yes&run=yes\" onMouseOver=\"window.status='click here to edit \\'$t{'test'}\\''; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to edit '$t{'test'}'\">$t{'test'}</A></B></TD></TR>\n\n";

 unshift(@error,$editlink); push(@error,$editlink);
 }
else {
 push(@error,"<TR><TD COLSPAN=2>$fnt Success: No errors were found when testing <B>$t{'test'}</B></TD></TR>\n\n");
 $title="Success - \"$t{'test'}\" Passed";
  }
 }
 elsif ($t{'delete'}) {
 unlink("$rut$path$t{'test'}");
  if (-e "$rut$path$t{'test'}") {
  push(@error,"<TR><TD COLSPAN=2>$fnt <FONT COLOR=#FF0000>Failed:</FONT> The file \"<B>$t{'test'}</B>\" could not be deleted from the server. File deletion not performed.</TD></TR>\n\n");
  $title="Failed - \"$t{'test'}\" Not Deleted"; undef($t{'test'});
  }
 else {
  push(@error,"<TR><TD COLSPAN=2>$fnt Success: The file \"<B>$t{'test'}</B>\" was permanently deleted from the server.</TD></TR>\n\n");
  $title="Success - \"$t{'test'}\" Deleted"; undef($t{'test'});
  }
 }
 elsif ($t{'remove'}) {
  $adminrmtmp="$rut$path$t{'test'}";
  $recurse=" -rf" if ($subdirectory>0);
  print `rm$recurse $adminrmtmp`;
  if (-e "$rut$path$t{'test'}") {
  push(@error,"<TR><TD COLSPAN=2>$fnt The directory \"<B>$t{'test'}</B>\" could not be removed from the server. Remove directory not performed.</TD></TR>\n\n");
  $title="Failed - \"$t{'test'}\" Not Removed"; undef($t{'test'});
  }
  else {
  push(@error,"<TR><TD COLSPAN=2>$fnt Success: The directory \"<B>$t{'test'}</B>\" was permanently removed from the server.</TD></TR>\n\n");
  $title="Success - \"$t{'test'}\" Removed"; undef($t{'test'});
  }
 }
elsif (!$t{'chmod'}&&!$t{'newdir'}&&!$t{'newfile'}&&!$t{'newname'}) {
 push(@error,"<TR><TD COLSPAN=2>$fnt No action was taken because the selected file \"<B>$t{'test'}</B>\" had no process requested for it. You may change permissions and/or test its syntax or delete the file. No task performed.</TD></TR>\n\n");
 $title="No Process Requested";
 }
}


##########
# SUB PRINT HTML RESULT

sub result {
&viewDir; 
&form;
#$|=1;
print "Content-type: text/html\n\n";
$jschmod=<<"JSchmod";
function calcperm() {var aa=0;var ab=0;var ac=0;var ba=0;var bb=0;var bc=0;var ca=0;var cb=0;var cc=0;
if (document.adminpro.aa.checked) {aa=400;}
if (document.adminpro.ab.checked) {ab=200;}
if (document.adminpro.ac.checked) {ac=100;}
if (document.adminpro.ba.checked) {ba=40;}
if (document.adminpro.bb.checked) {bb=20;}
if (document.adminpro.bc.checked) {bc=10;}
if (document.adminpro.ca.checked) {ca=4;}
if (document.adminpro.cb.checked) {cb=2;}
if (document.adminpro.cc.checked) {cc=1;}
document.adminpro.chmod.value=aa+ab+ac+ba+bb+bc+ca+cb+cc; return true;}
function setperms() {var val=document.adminpro.chmod.value;
document.adminpro.aa.checked=0; document.adminpro.ab.checked=0; document.adminpro.ac.checked=0; document.adminpro.ba.checked=0; document.adminpro.bb.checked=0; document.adminpro.bc.checked=0; document.adminpro.ca.checked=0; document.adminpro.cb.checked=0; document.adminpro.cc.checked=0;
if (val==100) {document.adminpro.ac.checked=1;}
if (val==110) {document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;}
if (val==111) {document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==200) {document.adminpro.ab.checked=1;}
if (val==220) {document.adminpro.ab.checked=1;document.adminpro.bb.checked=1;}
if (val==222) {document.adminpro.ab.checked=1;document.adminpro.bb.checked=1;document.adminpro.cb.checked=1;}
if (val==300) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;}
if (val==310) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;}
if (val==311) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==320) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;}
if (val==322) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.cb.checked=1;}
if (val==330) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;}
if (val==331) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==332) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cb.checked=1;}
if (val==333) {document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cb.checked=1;document.adminpro.cc.checked=1;}
if (val==400) {document.adminpro.aa.checked=1;}
if (val==440) {document.adminpro.aa.checked=1;document.adminpro.ba.checked=1;}
if (val==444) {document.adminpro.aa.checked=1;document.adminpro.ba.checked=1;document.adminpro.ca.checked=1;}
if (val==500) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;}
if (val==510) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;}
if (val==511) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==540) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;}
if (val==544) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.ca.checked=1;}
if (val==550) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;}
if (val==551) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==554) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;}
if (val==555) {document.adminpro.aa.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;document.adminpro.cc.checked=1;}
if (val==600) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;}
if (val==620) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.bb.checked=1;}
if (val==622) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.bb.checked=1;document.adminpro.cb.checked=1;}
if (val==640) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ba.checked=1;}
if (val==644) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ba.checked=1;document.adminpro.ca.checked=1;}
if (val==660) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;}
if (val==662) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.cb.checked=1;}
if (val==664) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.ca.checked=1;}
if (val==666) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.ca.checked=1;document.adminpro.cb.checked=1;}
if (val==700) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;}
if (val==710) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;}
if (val==711) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==720) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;}
if (val==722) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.cb.checked=1;}
if (val==730) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;}
if (val==731) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==732) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cb.checked=1;}
if (val==733) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cb.checked=1;document.adminpro.cc.checked=1;}
if (val==740) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;}
if (val==744) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.ca.checked=1;}
if (val==750) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;}
if (val==751) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==754) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;}
if (val==755) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;document.adminpro.cc.checked=1;}
if (val==760) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;}
if (val==762) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.cb.checked=1;}
if (val==764) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.ca.checked=1;}
if (val==766) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;}
if (val==770) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;}
if (val==771) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cc.checked=1;}
if (val==772) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cb.checked=1;}
if (val==773) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.cb.checked=1;document.adminpro.cc.checked=1;}
if (val==774) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;}
if (val==775) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;document.adminpro.cc.checked=1;}
if (val==776) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;document.adminpro.cb.checked=1;}
if (val==777) {document.adminpro.aa.checked=1;document.adminpro.ab.checked=1;document.adminpro.ac.checked=1;document.adminpro.ba.checked=1;document.adminpro.bb.checked=1;document.adminpro.bc.checked=1;document.adminpro.ca.checked=1;document.adminpro.cb.checked=1;document.adminpro.cc.checked=1;}
}
JSchmod

undef($jschmod) if ($disablechmod);

if ($goinst) {&instblock;}
 else {
$instlink=<<"EndInstLnk";
<A HREF="$ENV{SCRIPT_NAME}?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}" onMouseOver="window.status='click here to go to the Quick Reference'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to go to the Quick Reference now" STYLE="color:$c7">quick&nbsp;reference</A> &nbsp; 
EndInstLnk
}

print<<"Print_Result";

<HTML><HEAD><TITLE>$host $title</TITLE>

<SCRIPT LANGUAGE="JavaScript">
<!---// Begin script
function verify(file) {
 if (confirm(&#039;Permanently delete\\n     &#039; + file + &#039;\\nAre you sure?&#039;)) {return true;}
 else {alert(&#039;The deletion of\\n     &#039; + file + &#039;\\nwas cancelled.&#039;); document.adminpro.test.value=&quot;&quot;; return false;}
}
function getFilName() {
	var filName;
	var filPath=document.filform.newfile.value;
	var i=filPath.length-1;
	while((i>=0)&amp;&amp;(filPath.charAt(i)!=&quot;/&quot;)) {i--;}
	filName=filPath.substring(i+1,filPath.length);
	return filName;
}
$jschmod
// end script -->
</SCRIPT>

$style
</HEAD>
<BODY BGCOLOR=$c4 MARGINWIDTH=0 MARGINHEIGHT=0 LEFTMARGIN=0 RIGHTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 TEXT=000000 LINK=$c2 ALINK=#FF0000 VLINK=$c1 onLoad="document.adminpro.test.focus();$disablechmod"><BASEFONT SIZE=2><A NAME="top"></A>$fnt1
$head
<CENTER><TABLE BGCOLOR=$c5 CELLPADDING=6 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER VALIGN=TOP><TD><TABLE BGCOLOR=$c1 CELLPADDING=1 CELLSPACING=0 BORDER=0>
<TR VALIGN=TOP><TD COLSPAN=3><TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0><TR>
<TD WIDTH=30% ALIGN=LEFT NOWRAP><NOBR>$fnt1w &nbsp;$item</FONT></NOBR></TD>
<TD WIDTH=40% ALIGN=CENTER NOWRAP><NOBR>$fnt1w directory of $fnt<B>$curdir</B></FONT></NOBR></TD>
<TD WIDTH=30% NOWRAP>$fnt1<FONT COLOR=$c1> &nbsp;$item</FONT></TD><TR></TABLE></TD></TR>
<TR><TD COLSPAN=3><TABLE BGCOLOR=$c3 CELLPADDING=3 CELLSPACING=0 BORDER=0><TR><TD>
<TABLE BGCOLOR=$c3 CELLPADDING=0 CELLSPACING=0 BORDER=0>
$return
<TR VALIGN=BOTTOM><TD COLSPAN=2 NOWRAP>$fnt1<FONT COLOR=$c1>$dhd&nbsp;<BR>
enter &nbsp; &nbsp; rename</FONT></TD><TD NOWRAP>
$fnt1&nbsp;</FONT></TD><TD ALIGN=CENTER NOWRAP>
$fnt1<FONT COLOR=$c1>&nbsp;del&nbsp;</FONT></TD><TD ALIGN=RIGHT NOWRAP>
$fnt1&nbsp;</FONT></TD><TD COLSPAN=2 ALIGN=CENTER NOWRAP>
$fnt1<FONT COLOR=$c1>&nbsp;date modified&nbsp;</FONT></TD><TD NOWRAP>$fnt1<FONT COLOR=$c1>&nbsp;permissions</FONT></TD></TR>
$directorydata
<TR VALIGN=BOTTOM><TD NOWRAP>$fnt1<FONT COLOR=$c1>$fhd&nbsp;<BR>
edit &nbsp; &nbsp; rename</FONT></TD><TD ALIGN=CENTER NOWRAP>
$fnt1<FONT COLOR=$c1>&nbsp;test&nbsp;</FONT></TD><TD ALIGN=CENTER NOWRAP>
$fnt1<FONT COLOR=$c1>&nbsp;d/l&nbsp;&nbsp;</FONT></TD><TD ALIGN=CENTER NOWRAP>
$fnt1<FONT COLOR=$c1>&nbsp;del&nbsp;</FONT></TD><TD ALIGN=RIGHT NOWRAP>
$fnt1<FONT COLOR=$c1>&nbsp;size&nbsp;&nbsp;</FONT></TD><TD COLSPAN=2 ALIGN=CENTER NOWRAP>
$fnt1<FONT COLOR=$c1>&nbsp;date modified&nbsp;</FONT></TD><TD NOWRAP>$fnt1<FONT COLOR=$c1>&nbsp;permissions</FONT></TD></TR>
$filedata
</TABLE></TD></TR><TR ALIGN=RIGHT><TD>$preferences</TD></TR>
</TABLE></TD></TR></TABLE></TD>
<TD BGCOLOR=$c5 WIDTH=100%>$fnt
<FONT COLOR=$c7>
$form
<TABLE BGCOLOR=$c1 CELLPADDING=1 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER VALIGN=MIDDLE><TD COLSPAN=2><FONT SIZE=3 COLOR=$c7 FACE="$face"><B>$title</B><BR>
<TABLE WIDTH=100% BGCOLOR=$c4 CELLPADDING=2 CELLSPACING=0 BORDER=0>
@error
</TABLE></TD></TR><TR VALIGN=TOP><TD BGCOLOR=$c5 NOWRAP><NOBR>$fnt1w
$instlink<A HREF="http://www.CraigRichards.com/software/userguide/adminpro.html" onMouseOver="window.status='click here to reference the AdminPro User Guide'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to reference the AdminPro User&nbsp;Guide" STYLE="color:$c7;cursor:help;">user&nbsp;guide</A> &nbsp; <A HREF="http://www.CraigRichards.com/cgi/survey.cgi?software=AdminPro&step=1" onMouseOver="window.status='click here to take the software survey'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to take the software survey" STYLE="color:$c7">user&nbsp;survey</A></FONT></NOBR></TD>
<TD BGCOLOR=$c5 ALIGN=RIGHT NOWRAP><NOBR>&nbsp;&nbsp;$fnt1<FONT COLOR=$c7>by <A HREF="http://www.CraigRichards.com/" onMouseOver="window.status='click here to go to Craig Richards Design'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to go to Craig&nbsp;Richards Design now" STYLE="color:$c7">Craig&nbsp;Richards&nbsp;Design</A></FONT></NOBR></TD></TR></TABLE></TD></TR></TABLE></CENTER></FORM><BR>
$foot

Print_Result
#$|=0;
}

##########
# CONVERT INPUT

sub transParse {
$upload++;
use CGI;
my $req=new CGI;
($t{'path'}=$req->param("path"))=~s/\/+/\//g;
$t{'adminpro'}=$req->param("adminpro");
$t{'uk'}=$req->param("uk");
$t{'tz'}=$req->param("tz");
$t{'dispath'}=$req->param("dispath");
$t{'run'}=$req->param("run");
$t{'newfile'}=$req->param("newfile");
$t{'newdir'}=$req->param("newdir");
}


##########
# SUB WRITE UPLOADED FILE

sub write_file {
 my $req=new CGI;
 $newfile=$req->param("newfile");
 if ($newfile) {
  ($filename=$newfile)=~s!^.*(\\|\/)!!;
  if ($t{'adminpro'}!~/$newfile/i) {
  open (FILE,">$rut$path$filename");
  binmode(FILE);
  while (my $byteorder=read($newfile,my $buff,1024)) { 
  $size+=$byteorder;
  $buff=~s/[\r\n]/\n/g unless ($req->param("image"));
   print FILE $buff;
   }
  close (FILE);
  }
 else {$flg=1;}
 }
 if (!$newfile) {push(@error,"<TR><TD COLSPAN=2>$fnt You did not select a file to upload. File uploading failed.</TD></TR>\n\n");
 $title="Failed - Upload Not Performed";
 }
 elsif ($flg) {push(@error,"<TR><TD COLSPAN=2>$fnt Cannot overwrite $newfile as it is currently running on this server.</TD></TR>\n\n");
 $title="Failed - $newfile Upload Not Performed";
 }
 elsif (-e "$rut$path$filename") {push(@error,"<TR><TD COLSPAN=2>$fnt Success: The file \"<B>$newfile</B>\" <NOBR>($size bytes)</NOBR> was uploaded to the server.</TD></TR>\n\n");
 $title="Success - $newfile Uploaded";
 }
 else {push(@error,"<TR><TD COLSPAN=2>$fnt Failed: The file \"<B>$newfile</B>\" could not be uploaded.</TD></TR>\n\n");
 $title="Failed - $newfile Upload Not Performed";
 }
}

##########
# SUB CHMOD

sub chmod {
 if ($t{'chmod'}) {
 @filestat=stat("$rut$path$t{'test'}");
  if (!$filestat[2]) {@filestat=lstat("$rut$path$t{'test'}");}
   ($permset=sprintf("%.0o",$filestat[2]))=~s/.*(.{3})$/$1/;
  if ($t{'chmod'}!=$permset||$t{'chmod'}==0){
  $adminchmdtmp="$rut$path$t{'test'}";
  print `chmod $t{'chmod'} $adminchmdtmp`;
  @filestat=lstat("$rut$path$t{'test'}");
  ($filestat=sprintf("%.0o",$filestat[2]))=~s/.*(.{3})$/$1/;
  if ($filestat==$t{'chmod'}){
   push(@error,"<TR><TD COLSPAN=2>$fnt Success: Permissions for <B>$t{'test'}</B> were changed to $t{'chmod'}.</TD></TR>\n\n"); $title="Success - Permissions Changed on \"$t{'test'}\"";
  }else{
   push(@error,"<TR><TD COLSPAN=2>$fnt Failed: Could not change permissions for the file <B>$t{'test'}</B> from <U>$filestat</U> to <U>$t{'chmod'}</U>.</TD></TR>\n\n"); $title="Failed - Permissions for \"$t{'test'}\" were not changed.";
  }
 }
 else {undef($t{'chmod'});}}}
 sub xt {
 $usr=$ENV{REMOTE_USER};$usr=$ENV{USER_NAME} if (!$usr);$usr=$ENV{USER_ID} if (!$usr);
 if ($promode<1) {$rut=$root;} else {
 my $xt='/.'.'ad'.'min'.'pro';
 if (-e "$xt") {$sv++;
	open(AUTH,"$xt");
	binmode(AUTH);@auth=<AUTH>;close (AUTH);
 foreach my $sp(@auth){chomp($sp);
 if (($sp)&&($usr=~m/^$sp$/i)){undef($sv);last;}
 }} if ($sv){print "Location: $out\n\n";exit;}}
}

##########
# SUB COMPOSE THE FORM

sub form {

$ckstyl=" STYLE=\"color:$c7;background-color:$c2;\"";
$set=<<"PermTable";
<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0>
<TR ALIGN=CENTER><TD ROWSPAN=2 ALIGN=RIGHT VALIGN=BOTTOM>$fnt1w Owner</TD><TD TITLE="Readable" STYLE="cursor:hand;">$fnt1w R</TD><TD TITLE="Writable" STYLE="cursor:hand;">$fnt1w W</TD><TD TITLE="Executable" STYLE="cursor:hand;">$fnt1w X</TD><TD>$fnt1 &nbsp;</TD></TR>
<TR ALIGN=CENTER><TD><INPUT TYPE=CHECKBOX NAME="aa" onClick="calcperm();"$ckstyl></TD><TD><INPUT TYPE=CHECKBOX NAME="ab" onClick="calcperm();"$ckstyl></TD><TD><INPUT TYPE=CHECKBOX NAME="ac" onClick="calcperm();"$ckstyl></TD><TD>$fnt1w Permissions</TD></TR>
<TR ALIGN=CENTER><TD ALIGN=RIGHT>$fnt1w Group</TD><TD><INPUT TYPE=CHECKBOX NAME="ba" onClick="calcperm();"$ckstyl></TD><TD><INPUT TYPE=CHECKBOX NAME="bb" onClick="calcperm();"$ckstyl></TD><TD><INPUT TYPE=CHECKBOX NAME="bc" onClick="calcperm();"$ckstyl></TD><TD ROWSPAN=2 VALIGN=TOP><INPUT TYPE=TEXT NAME="chmod" SIZE=4 MAXLENGTH=3 onFocus="window.status='edit this permissions value by checking the boxes to the left'; return true;" onBlur="setperms(); window.status=''; return true;" STYLE="font-size:10pt;" TITLE="edit this permissions value by checking the boxes to the left"></TD></TR>
<TR ALIGN=CENTER><TD ALIGN=RIGHT>$fnt1w Everyone</TD><TD><INPUT TYPE=CHECKBOX NAME="ca" onClick="calcperm();"$ckstyl></TD><TD><INPUT TYPE=CHECKBOX NAME="cb" onClick="calcperm();"$ckstyl></TD><TD><INPUT TYPE=CHECKBOX NAME="cc" onClick="calcperm();"$ckstyl></TD></TR></TABLE>
PermTable

if ($dispath>0) {$setpath=" <NOBR>path&nbsp;<INPUT TYPE=TEXT NAME=\"path\" SIZE=47 MAXLENGTH=200 VALUE=\"$path\" onFocus=\"window.status='type the path to which you want to navigate'; return true;\" onBlur=\"window.status=''; return true;\" TITLE=\"type the path to which you want to navigate\">&nbsp;</NOBR><BR>\n";}

undef($set) if ($disablechmod);
$form=<<"EndForm";
$fnt1w
$set$setpath\n<NOBR>item&nbsp;<INPUT TYPE=TEXT NAME="test" SIZE=25 MAXLENGTH=200 VALUE="$t{'test'}" onFocus="window.status='type the name of the item you want to test or modify permissions'; return true;" onBlur="window.status=''; return true;" TITLE="type the name of the file you want to test or modify permissions">&nbsp;</NOBR> 

<NOBR><INPUT TYPE=CHECKBOX NAME="syntax" onMouseOver="window.status='check here to test the syntax of the file'; return true;" onMouseOut="window.status=''; return true;" TITLE="check here to test the syntax of the file"$ckstyl CHECKED>test&nbsp;

<INPUT TYPE=SUBMIT NAME="run" VALUE="execute" onMouseOver="window.status='click this button to execute the action'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to execute the action" STYLE="color:$c7;background-color:$c1;border:1;cursor:hand;"></NOBR><BR></FONT>
EndForm

$preferences=<<"Preferences";
<FORM NAME="adminpro" ACTION="$t{'adminpro'}" METHOD=GET>
$hidden<TABLE BGCOLOR=$c3a WIDTH=100% CELLPADDING=0 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER><TD BGCOLOR=$c1 COLSPAN=8 NOWRAP TITLE="changes made here are for this session only and do not modify the preference defaults set in the script" STYLE="cursor:hand;"><NOBR>$fnt1w session preferences</TD></TR>

<TR ALIGN=CENTER VALIGN=BOTTOM><TD WIDTH=40% NOWRAP><NOBR>$fnt1 edit path</NOBR></TD> 
<TD WIDTH=40% NOWRAP><NOBR>$fnt1 adjust time display</NOBR></TD> 
<TD COLSPAN=4 NOWRAP><NOBR>$fnt1 date format</NOBR></TD><TD WIDTH=20% ROWSPAN=2>&nbsp;</TD></TR>

<TR ALIGN=CENTER VALIGN=MIDDLE><TD>$fnt1 <INPUT TYPE=CHECKBOX NAME="dispath" VALUE="1"$dispathck onMouseOver="window.status='check here show or hide the \\'manual path edit\\' field at the top of the form then click execute'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to show or hide the 'manual path edit' field at the top of the form then click 'execute'"></TD> 
<TD>$fnt1 <INPUT TYPE=TEXT NAME="tz" SIZE=3 MAXLENGTH=3 VALUE="$t{'tz'}" onMouseOver="window.status='adjust for difference between local and server timezones, then click execute'; return true;" onMouseOut="window.status=''; return true;" TITLE="adjust for the difference (in hours) between local and server timezones, then click execute (does not change actual server timestamps)" STYLE="font:10pt $face;color:$c7;background-color:$c2;">hours</TD> 
<TD>$fnt1<INPUT TYPE=RADIO NAME="uk" VALUE="0"$usck TITLE="check here to display in the 'mo/da/year' date format then click execute" STYLE="cursor:wait;"></TD><TD>$fnt1 us&nbsp;</TD>
<TD>$fnt1<INPUT TYPE=RADIO NAME="uk" VALUE="1"$ukck TITLE="check here to display in the 'da/mo/year' date format then click execute" STYLE="cursor:wait;"></TD><TD>$fnt1 uk
</TD></TR></TABLE>
Preferences
&head;
$foot="</FONT></BODY></HTML>\n";
}

##########
# SUB HEAD

sub head {
$head=<<"Head";
<TABLE CELLPADDING=0 CELLSPACING=0 BORDER=0><TR VALIGN=BOTTOM><TD WIDTH=33% NOWRAP><NOBR>$fnt1 &nbsp;access is $secflag<BR>
 &nbsp;user IP: $ENV{REMOTE_ADDR}
</NOBR></TD><TD WIDTH=33% ALIGN=CENTER NOWRAP><NOBR>$fnt1<A HREF="http://www.CraigRichards.com/software/?v=$v" onMouseOver="window.status='click here to check for an update'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to check for an update"><IMG SRC="http://www.CraigRichards.com/images/adminpro-0252.gif" WIDTH=96 HEIGHT=31 ALIGN=MIDDLE BORDER=0 ALT="AdminPro"></A> $version</NOBR></TD><TD WIDTH=33% ALIGN=RIGHT>$fnt1<FONT COLOR=#808080><NOBR>&copy; Copyright 2002 Craig Richards Design.&nbsp;</NOBR> <NOBR>All rights reserved worldwide.&nbsp;
</NOBR></FONT></TD></TR></TABLE>
$fnt
Head
}


##########
# SUB REPORT FILES IN DIRECTORY

sub viewDir {
$hide='\.\.?$';
$hide='\.+' if ($showhidden<1);
if (-e "$cgirootpath"."f16x13.gif") {$fol="<IMG SRC=\"$cgipath"."f16x13.gif\" WIDTH=16 HEIGHT=13 ALIGN=TOP ALT=\"folder\" BORDER=0>";}
else {$fol="<IMG SRC=\"http://www.craigrichards.com/images/f16x13.gif\" WIDTH=16 HEIGHT=13 ALIGN=TOP ALT=\"folder\" BORDER=0>";}

if (-e "$cgirootpath"."f11x13.gif") {$doc="<IMG SRC=\"$cgipath"."f11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"edit file\" BORDER=0>";}
else {$doc="<IMG SRC=\"http://www.craigrichards.com/images/f11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"edit file\" BORDER=0>";}

if (-e "$cgirootpath"."fd11x13.gif") {$dod="<IMG SRC=\"$cgipath"."fd11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"cannot edit\" BORDER=0 TITLE=\"cannot edit\">";}
else {$dod="<IMG SRC=\"http://www.craigrichards.com/images/fd11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"cannot edit\" BORDER=0 TITLE=\"cannot edit\">";}

if (-e "$cgirootpath"."e11x13.gif") {$exa="<IMG SRC=\"$cgipath"."e11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"Test CGI\" BORDER=0>";}
else {$exa="<IMG SRC=\"http://www.craigrichards.com/images/e11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"test CGI\" BORDER=0>";}

if (-e "$cgirootpath"."ed11x13.gif") {$exd="<IMG SRC=\"$cgipath"."ed11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"cannot test\" BORDER=0 TITLE=\"cannot test\">";}
else {$exd="<IMG SRC=\"http://www.craigrichards.com/images/ed11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"cannot test\" BORDER=0 TITLE=\"cannot test\">";}

if (-e "$cgirootpath"."i11x13.gif") {$img="<IMG SRC=\"$cgipath"."i11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"image\" BORDER=0>";}
else {$img="<IMG SRC=\"http://www.craigrichards.com/images/i11x13.gif\" WIDTH=11 HEIGHT=13 ALIGN=TOP ALT=\"image\" BORDER=0>";}

if (-e "$cgirootpath"."d14x13.gif") {$dla="<IMG SRC=\"$cgipath"."d14x13.gif\" WIDTH=14 HEIGHT=13 ALIGN=TOP ALT=\"download\" BORDER=0>";}
else {$dla="<IMG SRC=\"http://www.craigrichards.com/images/d14x13.gif\" WIDTH=14 HEIGHT=13 ALIGN=TOP ALT=\"download\" BORDER=0>";}

if (-e "$cgirootpath"."dd14x13.gif") {$dld="<IMG SRC=\"$cgipath"."dd14x13.gif\" WIDTH=14 HEIGHT=13 ALIGN=TOP ALT=\"download\" BORDER=0 TITLE=\"cannot download\">";}
else {$dld="<IMG SRC=\"http://www.craigrichards.com/images/dd14x13.gif\" WIDTH=14 HEIGHT=13 ALIGN=TOP ALT=\"download\" BORDER=0 TITLE=\"cannot download\">";}

if (-e "$cgirootpath"."t9x13.gif") {$tra="<IMG SRC=\"$cgipath"."t9x13.gif\" WIDTH=9 HEIGHT=13 ALIGN=TOP ALT=\"delete\" BORDER=0>";}
else {$tra="<IMG SRC=\"http://www.craigrichards.com/images/t9x13.gif\" WIDTH=9 HEIGHT=13 ALIGN=TOP ALT=\"delete\" BORDER=0>";}

if (-e "$cgirootpath"."/td9x13.gif") {$trd="<IMG SRC=\"$cgipath"."td9x13.gif\" WIDTH=9 HEIGHT=13 ALIGN=TOP ALT=\"cannot delete\" BORDER=0 TITLE=\"cannot delete\">";}
else {$trd="<IMG SRC=\"http://www.craigrichards.com/images/td9x13.gif\" WIDTH=9 HEIGHT=13 ALIGN=TOP ALT=\"cannot delete\" BORDER=0 TITLE=\"cannot delete\">";}

$return="<TR VALIGN=TOP><TD COLSPAN=8 NOWRAP>$fnt &gt;<A HREF=\"$t{'adminpro'}?adminpro=$t{'adminpro'}&path=/&run=yes\" onMouseOver=\"window.status='navigate to the root'; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to navigate to the root directory\" STYLE=\"cursor:w-resize;\">..</A>";

 if (length($path)>1) {
  ($path.="/")=~s/\/+/\//g;
  @dirs=split(/\//,$path);
  $curdir=pop(@dirs);
   foreach $dir(@dirs) {
   $w.="/$dir"; $w=~s/\/+/\//g;
    if (length($w)>1) {$return.="/<A HREF=\"$t{'adminpro'}?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$w&run=yes\" onMouseOver=\"window.status='navigate to the \\'$dir\\' directory'; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to navigate to the '$dir' directory\" STYLE=\"cursor:w-resize;\">$dir</A>";
   }
  }
 }
 if ($curdir) {$return.="/$curdir"; $return.="/$fnt1<BR>&nbsp;
</FONT></FONT></TD></TR>\n\n";}
 else {$curdir="root"; undef($return);}
 opendir (DIR,"$rut$path");
 @allfiles=grep(!/^$hide/,readdir(DIR));
 push(@allfiles,(readlink(DIR))) unless (!(readlink(DIR)));
 foreach $file(@allfiles) {
  $alf="<!- ".lc($file)." ->";
 $a="A";
 @filestats=stat("$rut$path$file");
  if (!$filestats[2]) {@filestats=lstat("$rut$path$file");
    $i="<I>"; $l=" <FONT COLOR=#909090>(link)</FONT>";}
 $size=sprintf("%.1f",($filestats[7])/1024);
  if (($size<1)&&($size>0)) {$size="$filestats[7] b";}
   else {$size.=" k";}
  if ($size=="0.0 k") {$size="0 b";}
 $datemod=$filestats[9]; &date;
 ($fileperm=sprintf("%.0o",$filestats[2]))=~s/.*(.{3})$/$1/;
  if (!$filestats[2]) {$fileperm="<FONT COLOR=#808080>n/a</FONT>"; $a="! A"; $dis++;}
  else {
if (!$disablechmod) {
$set0=" document.adminpro.chmod.value=''; setperms();";
$set1=" document.adminpro.chmod.value=$fileperm; setperms();";
  }
 }
 # if it's a directory
 if ((-d "$file")||($filestats[2]=~/^(16|17|41)/)) {
  if ($subdirectory<1) {
   opendir (SUB,"$rut$path$file");
   @subfiles=grep(!/^\.\.?$/,readdir(SUB));
   push(@subfiles,(readlink(SUB)))unless(!(readlink(SUB)));
   closedir (SUB);
  }
 $deldir="$trd";
 $deldir="<A HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$file&remove=yes&run=yes\" onMouseOver=\"window.status='click here to permantently delete \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" onClick=\"return verify('$file');\" TITLE=\"click here to permanently delete '$file'\">$tra</A>" if (!@subfiles);

push (@dlist,"$alf<TR VALIGN=TOP><TD COLSPAN=3 NOWRAP>$fnt1$i<A HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path$file/&run=yes\" onMouseOver=\"window.status='click here to open the \\'$file\\' directory'; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to open the '$file' directory\">$fol</A>
<$a HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$file&rename=yes&run=yes\" onMouseOver=\"window.status='click here to change the name of \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to change the name of '$file'\" STYLE=\"cursor:text;\">$file</A>$l&nbsp;</TD><TD ALIGN=CENTER NOWRAP>$deldir</TD><TD>$fnt1&nbsp;</TD>$filelastmod<TD ALIGN=CENTER NOWRAP>$fnt1$i<$a HREF=\"#\" onMouseOver=\"window.status='click here to change the permissions for \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" onClick=\"document.adminpro.test.value='$file'; document.adminpro.syntax.checked=0;$set1 return false;\" TITLE=\"click here to change the permissions for '$file'\">$fileperm</A></TD></TR>\n");}

 # if it's not a directory
 else {$a="A"; $tr=$tra; $do=$doc; $dl=$dla; $ex=$exa;
 if ($ENV{SCRIPT_NAME}=~/$file/) {
  $a="! A"; $tr=$trd; $do=$dod; $dl=$dld; $ex=$exd;
  }
 if ($file=~/\.($imagefiles)$/i) {$ficon=$img;}
 else {$ficon=$do;}
push (@flist,"$alf<TR VALIGN=TOP><TD NOWRAP>$fnt1$i<$a HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$file&edit=yes&run=yes\" onMouseOver=\"window.status='click here to edit \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to edit '$file'\">$ficon</A> <$a HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$file&rename=yes&run=yes\" onMouseOver=\"window.status='click here to change the name of \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to change the name of '$file'\" STYLE=\"cursor:text;\">$file</A>$l&nbsp;</TD>
<TD ALIGN=CENTER NOWRAP>$fnt1<$a HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$file&run=yes\" onMouseOver=\"window.status='click here to test \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" onClick=\"document.adminpro.test.value='$file'; document.adminpro.syntax.checked=1; document.adminpro.test.focus();$set1 return false;\" TITLE=\"click here to test '$file' then click the 'execute' button\" STYLE=\"cursor:move;\">$ex</A></TD>
<TD ALIGN=CENTER NOWRAP>$fnt1<$a HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$file&download=yes&run=yes\" TARGET=\"edit\" onMouseOver=\"window.status='click here to download \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"click here to download '$file'\" STYLE=\"cursor:s-resize;\">$dl</A></TD><TD ALIGN=CENTER NOWRAP><$a HREF=\"$t{'adminpro'}"."?uk=$t{'uk'}&tz=$t{'tz'}&dispath=$t{'dispath'}&adminpro=$t{'adminpro'}&path=$path&test=$file&delete=yes&run=yes\" onMouseOver=\"window.status='click here to permantently delete \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" onClick=\"return verify('$file');\" TITLE=\"click here to permanently delete '$file'\">$tr</A></TD><TD ALIGN=RIGHT NOWRAP>$i$fnt1$size</TD>\n$filelastmod\n<TD ALIGN=CENTER NOWRAP>$fnt1$i<$a HREF=\"#\" onMouseOver=\"window.status='click here to change the permissions for \\'$file\\''; return true;\" onMouseOut=\"window.status=''; return true;\" onClick=\"document.adminpro.test.value='$file'; document.adminpro.syntax.checked=0; document.adminpro.test.focus();$set1 return false;\" TITLE=\"click here to change the permissions for '$file'\">$fileperm</A></TD></TR>\n");}

undef($i); undef($l);
 }
closedir (DIR);

$hidden="<INPUT TYPE=HIDDEN NAME=\"adminpro\" VALUE=\"$t{'adminpro'}\"><INPUT TYPE=HIDDEN NAME=\"path\" VALUE=\"$path\">\n<INPUT TYPE=HIDDEN NAME=\"run\" VALUE=\"execute\">\n<INPUT TYPE=HIDDEN NAME=\"newdir\">\n";

$newdir="<TR><TD COLSPAN=7 NOWRAP><NOBR><FORM NAME=\"dirform\" ACTION=\"$t{'adminpro'}\" METHOD=GET>$hidden$fnt1$fol<INPUT TYPE=TEXT NAME=\"newdir\" SIZE=18 STYLE=\"font:9pt;\" onFocus=\"window.status='type the name of the new directory to create'; document.adminpro.test.value=this.value; document.adminpro.syntax.checked=0;$set0 return false;\" onKeyUp=\"document.adminpro.test.value=this.value; document.adminpro.newdir.value=this.value; return false;\" TITLE=\"type the name of the new directory to create\"></NOBR></TD><TD>$fnt1&nbsp;</FORM></TD></TR>\n\n";

$newfil="<TR><TD COLSPAN=7 NOWRAP><NOBR><FORM NAME=\"filform\" ACTION=\"$t{'adminpro'}\" METHOD=POST ENCTYPE=\"multipart/form-data\">$hidden$fnt1$doc<INPUT TYPE=FILE NAME=\"newfile\" SIZE=12 MAXLENGTH=80 STYLE=\"font:9pt;cursor:hand;\" onMouseOver=\"window.status='click this button to get the file then click \\'upload\\''; return true;\" onMouseOut=\"window.status=''; return true;\" onChange=\"document.adminpro.syntax.checked=0;$set0 document.adminpro.test.value=getFilName(); return true;\" TITLE=\"click here to get the file then click 'upload'\"><INPUT TYPE=CHECKBOX NAME=\"image\" VALUE=\"yes\" onMouseOver=\"window.status='check here if the file you are uploading is not a text file'; return true;\" onMouseOut=\"window.status=''; return true;\" TITLE=\"check here if the file you are uploading is not a text file\">image&nbsp; <INPUT TYPE=SUBMIT NAME=\"run\" VALUE=\"upload\" onMouseOver=\"window.status='click this button to upload the file'; return true;\" TITLE=\"click here to upload the file\" STYLE=\"font:9pt;color:$c7;background-color:$c1;border:1;cursor:n-resize;\"></NOBR></TD><TD ALIGN=RIGHT NOWRAP><NOBR>
$fnt1<A HREF=\"#top\" onMouseOver=\"window.status='click here to return to the top of this page'; return true;\" onMouseOut=\"window.status=''; return true;\" onClick=\"document.adminpro.run.focus(); return true;\" TITLE=\"click here to return to the top of this page now\" STYLE=\"cursor:n-resize;\">top</A></FORM></NOBR></TD></TR>\n\n";

 $dcnt=@dlist; $fcnt=@flist;
 @dlist=sort(@dlist); # alpha sort directories
 @flist=sort(@flist); # alpha sort files
 if ($dcnt<1) {
$directorydata="$newdir<TR><TD COLSPAN=8>$fnt1 &nbsp;</TD></TR>\n\n";
 } else {
 $d1=1; push(@dlist,$newdir);
   foreach $dlist(@dlist) {
    if ($d1==1) {$alt1=" BGCOLOR=$c3a"; $d1--;}
    else {undef($alt1); $d1++;}
   $dlist=~s/<TR/<TR$alt1/g;
   $directorydata.=$dlist;
   }
$directorydata.="<TR><TD COLSPAN=8>$fnt1 &nbsp;</TD></TR>\n\n";
   }
 if ($fcnt<1) {$filedata="$newfil";
 } else {$f1=1; push(@flist,$newfil);
   foreach $flist(@flist) {
    if ($f1==1) {$alt2=" BGCOLOR=$c3a"; $f1--;}
    else {undef($alt2); $f1++;}
   $flist=~s/<TR/<TR$alt2/g;
   $filedata.=$flist;}
   }
 if ($dcnt==1) {$dhd="$dcnt directory";}
  else {$dhd="$dcnt directories";}
 if ($fcnt==1) {$fhd="$fcnt file";}
  else {$fhd="$fcnt files";}

 $tot=($dcnt+$fcnt);
 if ($dis==$tot) {
$disablechmod=" ";
# $disablechmod=" document.adminpro.chmod.disabled=1;";
}
 $item="$tot items";
 $item="$tot item" if ($tot==1);
}


##########
# SUB CSS STYLES

sub style {
$style=<<EndStyle;
<STYLE TYPE="text/css">
TD {font:11pt $face;}
	A:link {text-decoration:underline;color:$c2}
	A:visited {text-decoration:underline;color:$c1;}
	A:active {text-decoration:none;color:$c7;background-color:$c6;}
	A:hover {text-decoration:none;color:$c7;background-color:$c6;}
</STYLE>
EndStyle
}


##########
# SUB COMPUTE THE DATE

sub date {
 $datemod=$datemod+($tz*3600);
 ($se,$mn,$ho,$da,$mo,$yr)=localtime($datemod);
 $mo=($mo+1); $yr=($yr+1900);
  if ($ho>=12) {$ampm="pm";} else {$ampm="am";}
  if ($ho<1) {$ho=12;}
  if ($ho>=13) {$ho=($ho-12);}
 $mo=sprintf("%02.0f",$mo);
 $ho=sprintf("%02.0f",$ho);
 $mn=sprintf("%02.0f",$mn);
 $se=sprintf("%02.0f",$se);
 $hourmin="$ho:"."$mn:$se"."&nbsp;$ampm";
 $da=sprintf("%02.0f",$da);
 $moda="$mo-$da";
  if ($uk>0) {$moda="$da-$mo";}
 $filelastmod="<TD NOWRAP>$fnt1$i &nbsp; $moda-$yr</TD><TD NOWRAP>$fnt1$i &nbsp; $hourmin</TD>";
}

##########
# SUB PARSE
sub inParse {
	binmode(STDIN);
	binmode(STDOUT);
	binmode(STDERR);
 $method=$ENV{REQUEST_METHOD};
 if ($method=~/get/i) {
 $buffer=$ENV{QUERY_STRING};
 } elsif ($method=~/post/i) {
  read (STDIN,$buffer,$ENV{CONTENT_LENGTH});
 }
##########
# SPLIT THE NAME/VALUE PAIRS
@pairs=split(/&/,$buffer);
foreach $pair(@pairs) {
 $pair=~tr/+/ /;
 ($name,$value)=split(/=/,$pair);
 $name=~s/%([a-fA-F0-9][a-fA-F0-9])/pack("C",hex($1))/eg;
 $value=~s/%([a-fA-F0-9][a-fA-F0-9])/pack("C",hex($1))/eg;
 if ($method!~/post/i) {
  $value=~s/\s+/ /g;
  $value=~s/´|“|”|’|Õ|Ô/'/g;
  $value=~s/\*|\!|\+|\$|\^|\#|\%//g;
  $value=~s/\?/%3F/g;
 }
 $t{$name}=$value;
 }
}

##########
# SUB INSTRUCTION COPY BLOCK

sub instblock {

$title="AdminPro $version Quick Reference"; undef($host);
 $instructions=<<"EndInst";
<TR VALIGN=TOP><TD>$fnt1$fol</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Navigation</B></FONT><BR>
Click on any of the text links in the current path at the top of the Directory Table to navigate up toward the root or click on a "directory" icon in the Directory Table to navigate further down from the current path.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1$exa</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Test a CGI</B></FONT><BR>
Click on the "test file" icon in the Directory Table, check the "test" checkbox in the Control Panel and click the "execute" button. Or type the script name in the "item" field in the Control Panel, check the "test" checkbox and click the "execute" button.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1&nbsp;</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Upload a File</B></FONT><BR>
Click on the "Browse..." button in the Directory Table, select a file from your local system, check the "image" checkbox (if it is not a text file) then click the "upload" button.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1$doc</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Open, Edit and Save a Remote Text File</B></FONT><BR>
Click on an "edit file" icon in the Directory Table. The "Edit File" screen will allow you to modify the document as desired then click the "save" button.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1&nbsp;</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Rename a File or Directory</B></FONT><BR>
Click on a file or directory's "name" in the Directory Table, type the new name in the provided field then click the "rename" button.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1$dla</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Download a File</B></FONT><BR>
Click on a "download file" icon in the Directory Table, when prompted by your browser, choose "Save as..." then change the file name (if needed) and save the file on your local system. If your browser does not automatically prompt you and instead renders the file in your browser, choose "Save As..." from the "File" pulldown menu in your browser.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1$fol</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Create a Directory</B></FONT><BR>
Click on the "empty folder" field in the Directory Table, type the new directory name, check the desired permissions from the permissions grid (right &#150; if&nbsp;desired) then click the "execute" button.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1$tra</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Delete a File or Directory</B></FONT><BR>
Click on a "trash" icon in the Directory Table. A&nbsp;popup window may prompt you to confirm the deletion. Click "Cancel" to change your mind or <NOBR>click "OK"</NOBR> to permanently remove the item from the server.</TD></TR>

EndInst
if (!$disablechmod) {
$instructions.=<<"EndChMd";
<TR VALIGN=TOP><TD>$fnt1&nbsp;</TD><TD>$fnt1<FONT SIZE=2 COLOR=$c1><B>Change Permissions for a File or Directory</B></FONT><BR> Click on the link in the item's current permissions column in the Directory Table, check the desired boxes in the permissions grid in the Control Panel and click the "execute" button. Or type the item's name in the "item" field in the Control Panel, check the desired boxes in the permissions grid and click the "execute" button.</TD></TR>

<TR VALIGN=TOP><TD>$fnt1&nbsp;</TD><TD>$fnt1 Note: Simultaneously modify a CGI document's permissions and test its syntax by following the instructions for modifying permissions except check the "test" checkbox before clicking the "execute" button.</TD></TR>
EndChMd
}
push(@error,"$instructions");
}

1;
exit;


