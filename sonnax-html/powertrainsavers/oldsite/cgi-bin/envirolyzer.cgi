#!/usr/bin/perl

use CGI::Carp qw(fatalsToBrowser);

#
# Envirolyzer version 1.1 by Craig Richards
# August 08, 2000
# check for updates at
# http://www.CraigRichards.com/software/
# 
# 
# # # # # # # # # # # # # # # #
# 
# INSTALLATION INSTRUCTIONS - PLEASE READ
#
# You may need to change the server's path to Perl (above)
# A good alternate line is  #!/usr/local/perl
# Use whatever is at the top of any existing (working) scripts 
# on your server.
#
# You may change the extension to ".pl" if ".cgi" is not 
# supported by your server.
#
# Envirolyzer is a Perl 5 script that identifies your server's
# environmental variables and reports them in your browser.
# 
# Simply upload this file (as ASCII text) to any path 
# in your domain or at its root. If your server administrator 
# restricts executables to a cgi or cgi-bin directory, 
# that's where you'd want to put the testmy.cgi file.
# 
# On Unix/Linux and perhaps other servers, set the 
# file permissions for the testmy.cgi document to 
# 755 (world executable or rwxr-xr-x).
# 
# That's it! Now open your browser and type:
# http://www.mydomainhere.com/path/testmy.cgi
#            ^                ^   your domain and path go here)
# 
# # # # # # # # # # # # # # # #
# 
# WHEN YOU USE Envirolyzer
# YOU AGREE WITH THESE TERMS AND CONDITIONS
#
# We encourage your feedback and suggestions; however, 
# Envirolyzer is distributed as "freeware" (no license fee is 
# collected) so user support is not available. User agrees to 
# run this application at his/her own risk, assumes all 
# liability, and no warranty as to the suitability or 
# performance of Envirolyzer for your specific purpose is 
# stated nor implied. If dissatisfied with Envirolyzer, 
# discontinue use.
#
# Envirolyzer may be freely distributed via the Internet or 
# included on CD-ROM as long as the original source code, 
# comments, instructions and credits remain intact. 
# Envirolyzer is free and may not be individually sold 
# though it may be bundled with other software whether 
# that distribution contains other software that is free, 
# shareware, demo or sold. In essence, no one should 
# materially profit from distribution of this script.
#
# You are urged not to link to this script from any public 
# pages on your site as the information reported about your 
# site by Envirolyzer may compromise the security of your site 
# and/or server.
# 
# Application and interface is (c)Copyright 2000. 
# All rights reserved worldwide.
# 
# If you like this environment analyzing tool, let me know. 
# Go to http://www.CraigRichards.com/software/ for upgrade info 
# as it becomes available.
#
# Feel free to email me at "CGI@CraigRichards.com" with your 
# comments and/or suggestions.
#
# # # # # # # # # # # # # # # #
#### 
#### USER-MODIFIABLE VARIABLES
   # 
#--> set access-restriction security feature below
   #    - only if you use a static IP address -
   #
   $secure=1; 
   #       ^ Set to 1 to enable IP address security.
   #
#--> input your static IP address here:
   # note: for multiple administrators, just duplicate 
   # the line below to add more static IP addresses.
   #
   $ipaddress .= "24.64.136.130\n"; # your IP goes here
   #
#--> set display color values below
   #
   $c1 = "7F007F"; # heads & borders
   $c2 = "000000"; # subtle color
   $c3 = "E0E0E0"; # table background color
   $c4 = "EDEDED"; # prompt background color
   $c5 = "FFFFFF"; # result background color
   $c6 = "000000"; # overall interface background color
   $c7="FFCC66"; # mouseover highlight color (CCS)
   $face="arial,helvetica,sans-serif"; # font set
   #
####
# # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # #
#                                           # #
# DO NOT CHANGE ANYTHING BELOW THIS POINT!  # #
#                                           # #
# # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # #
#
##########
# VARIABLES DEFINED

$fnt="<FONT SIZE=2 FACE=$face>";
$fnt1="<FONT SIZE=1 FACE=$face>";
$v="1.1";
$version = "v $v";
$secflag="<NOBR>not restricted<BR>\nuser IP:&nbsp;$ENV{REMOTE_ADDR}</NOBR>";
$row = "<TR VALIGN=TOP><TD BGCOLOR=$c4 ALIGN=RIGHT NOWRAP><NOBR>$fnt1";
$mid = "</FONT></NOBR></TD><TD BGCOLOR=$c5>$fnt";
$end = "</FONT></TD></TR>\n";

$sendmail	=`whereis sendmail`; $sendmail =~ s/sendmail: //;
 @mailpath = split(" ",$sendmail);
  foreach $sml(@mailpath) {$mailpath .= "$sml<BR>";}
$ppath	=`whereis perl`; $ppath =~ s/perl: //;
 @perlpath = split(" ",$ppath);
  foreach $pth(@perlpath) {$perlpath .= "$pth<BR>";}

##########
# ACCESS SUBROUTINE

if ($secure eq 1) {&access;}

sub access {

if ($ipaddress !~ /$ENV{REMOTE_ADDR}/) {
print "Location:http://www.CraigRichards.com/restricted.html?ref=$ENV{SERVER_NAME}&v=$v\n\n";
exit;
 } else {$secflag="<FONT SIZE=2 COLOR=$c1><B><NOBR>restricted</B></FONT><BR>\nuser&nbsp;IP:&nbsp;$ENV{REMOTE_ADDR}</NOBR>";}
}


##########
# PRINT ENVIRONMENTAL VARIABLES

print "Content-type: text/html\n\n";

# include other very helpful variables even if empty:

$ENV{"HTTP_COOKIE"}="$ENV{HTTP_COOKIE}" unless ($ENV{HTTP_COOKIE});
$ENV{"REDIRECT_ERROR_NOTES"}="$ENV{REDIRECT_ERROR_NOTES}" unless ($ENV{REDIRECT_ERROR_NOTES});
$ENV{"REDIRECT_REQUEST_METHOD"}="$ENV{REDIRECT_REQUEST_METHOD}" unless ($ENV{REDIRECT_REQUEST_METHOD});
$ENV{"REDIRECT_STATUS"}="$ENV{REDIRECT_STATUS}" unless ($ENV{REDIRECT_STATUS});
$ENV{"REDIRECT_UNIQUE_ID"}="$ENV{REDIRECT_UNIQUE_ID}" unless ($ENV{REDIRECT_UNIQUE_ID});
$ENV{"REDIRECT_URL"}="$ENV{REDIRECT_URL}" unless ($ENV{REDIRECT_URL});
$ENV{"REDIRECT_nokeepalive"}="$ENV{REDIRECT_nokeepalive}" unless ($ENV{REDIRECT_nokeepalive});
$ENV{"REDIRECT_ssl_unclean_shutdown"}="$ENV{REDIRECT_ssl_unclean_shutdown}" unless ($ENV{REDIRECT_ssl_unclean_shutdown});
$ENV{"TZ"}="$ENV{TZ}" unless ($ENV{TZ});
$ENV{"USER_ID"}="$ENV{USER_ID}" unless ($ENV{USER_ID});
$ENV{"USER_NAME"}="$ENV{USER_NAME}" unless ($ENV{USER_NAME});
$ENV{"UNIQUE_ID"}="$ENV{UNIQUE_ID}" unless ($ENV{UNIQUE_ID});

foreach $key(sort keys %ENV)	{
push (@envirolyzers,"$row$key$mid$ENV{$key}$end\n");}

print <<"EOF";

<HTML><HEAD><TITLE>Envirolyzer $version by Craig Richards</TITLE>
</SCRIPT>
<STYLE TYPE="text/css">
	A:link {text-decoration:underline;color:#$c2}
	A:visited {text-decoration:underline;color:#$c1;}
	A:active {text-decoration:none;color:#$c1; background-color:#$c7;}
	A:hover {text-decoration:none;color:#$c1; background-color:#$c7;}
</STYLE>
</HEAD>
<BODY BGCOLOR=$c6 MARGINWIDTH=12 MARGINHEIGHT=6 LEFTMARGIN=12 RIGHTMARGIN=12 TOPMARGIN=6 BOTTOMMARGIN=6 TEXT=000000 LINK=$c2 ALINK=FF0000 VLINK=$c1><BASEFONT SIZE=2>$fnt1

<CENTER><TABLE BGCOLOR=$c1 CELLPADDING=2 CELLSPACING=0 BORDER=0><TR ALIGN=CENTER VALIGN=MIDDLE><TD><TABLE BGCOLOR=$c3 CELLPADDING=2 CELLSPACING=1 BORDER=0>
<TR VALIGN=BOTTOM><TD NOWRAP><NOBR>$fnt1 access is $secflag
</NOBR></TD><TD WIDTH=100% ALIGN=CENTER NOWRAP><NOBR>$fnt1<A HREF="http://www.CraigRichards.com/software/?v=$v" onMouseOver="window.status='click here to go to Craig Richards Design now'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to go to Craig&nbsp;Richards Design"><IMG SRC="http://www.CraigRichards.com/images/envirolyzer-11.gif" WIDTH=96 HEIGHT=21 ALIGN=MIDDLE BORDER=0 ALT="Envirolyzer"></A> $version</NOBR></TD><TD ALIGN=RIGHT>$fnt1<FONT COLOR=808080><NOBR>&copy; Copyright 2000 Craig Richards Design.</NOBR> <NOBR>All rights reserved worldwide.
</NOBR></FONT></TD></TR></TABLE>
<TABLE BGCOLOR=$c3 CELLPADDING=2 CELLSPACING=1 BORDER=0>
<TR ALIGN=CENTER VALIGN=TOP><TD COLSPAN=2>$fnt &nbsp;<BR>
<B>Envirolyzer</B> can help streamline your authoring, programming and maintenance by<BR>
analyzing and reporting the environment in which your CGI scripts will perform.<BR>
&nbsp;$end
$row PERL VERSION$mid $^X $] ($^O OS compile version) $end
$row PATH TO PERL$mid $perlpath $end
@envirolyzers
$row PATH TO SENDMAIL$mid $mailpath $end
<TR ALIGN=RIGHT><TD COLSPAN=2 NOWRAP>$fnt1<FONT COLOR=909090>by <A HREF="http://www.CraigRichards.com/software/" onMouseOver="window.status='click here to go to Craig Richards Design now'; return true;" onMouseOut="window.status=''; return true;" TITLE="click here to go to Craig&nbsp;Richards Design now">Craig&nbsp;Richards&nbsp;Design</A>$end
</TABLE></TD></TR></TABLE></CENTER>
</BODY></HTML>

EOF

1;
exit;
#</XMP></BODY></HTML>




