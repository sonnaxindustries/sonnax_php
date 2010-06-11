#!/usr/local/bin/perl

#################################################################
#             Mailing List V2.0
#
# This program is distributed as freeware. We are not            	
# responsible for any damages that the program causes	
# to your system. It may be used and modified free of 
# charge, as long as the copyright notice
# in the program that give me credit remain intact.
# If you find any bugs in this program. It would be thankful
# if you can report it to us at cgifactory@cgi-factory.com.  
# However, that email address above is only for bugs reporting. 
# We will not  respond to the messages that are sent to that 
# address. If you have any trouble installing this program. 
# Please feel free to post a message on our CGI Support Forum.
# Selling this script is absolutely forbidden and illegal.
##################################################################
#
#               COPYRIGHT NOTICE:
#
#         Copyright 1999-2001 CGI-Factory.com TM 
#		  A subsidiary of SiliconSoup.com LLC
#
#
#      Web site: http://www.cgi-factory.com
#      E-Mail: cgifactory@cgi-factory.com
#      Released Date: Junuary 29, 2001
#	
#   Mailing List v.2.0 is protected by the copyright 
#   laws and international copyright treaties, as well as other 
#   intellectual property laws and treaties.
###################################################################

$fullpath="./";
####
push(@INC, $fullpath);

$cfg="cfg.pl";
$passfile="pass.dat";
$version="V 2.0";
$admin="mail-admin.pl";

eval {
require "$cfg";

};
if ($@) {
&error("Unable to load $cfg. Please check out the readme file. $@");
}

read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
@pairs = split(/&/, $buffer);
foreach $pair (@pairs) {
($name, $value) = split(/=/, $pair);
$value =~ tr/+/ /;
$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
$form{$name} = $value;
}

################################# first time


if ($form{'action'} eq "firsttime") {
print "Content-type: text/html\n\n";
&firsttime; 
}
if ($form{'action'} eq "main_page") {
print "Content-type: text/html\n\n"; 
$description="Admin main page";
&main_page; 
}
if ($form{'action'} eq "preview") { 
$description="Send newsletter";
print "Content-type: text/html\n\n";
&preview; 
}
if ($form{'action'} eq "sendnow") { 
$description="Send newsletter";
&sendnow; 
}
if ($form{'action'} eq "view_all") { 
print "Content-type: text/html\n\n";
$description="View all subscribed emails";
&view_all; 
}
if ($form{'action'} eq "delete_entries") { 
print "Content-type: text/html\n\n";
$description="Delete entries";
&delete_entries; 
}

if ($form{'action'} eq "subscribe") { 
print "Content-type: text/html\n\n";
$description="Add an email";
&subscribe; 
}


####################################first time set up
open (DETECT,"<$fullpath/$passfile") or &decide;
@detect=<DETECT>;
close (DETECT);
if (!@detect) {
&decide;
}

sub decide {
	print "Content-type: text/html\n\n";
	if ($form{'action'} eq "firsttime") {
	   &firsttime;
	exit;
	}
	else {
		 &setup;	
	exit;
	}
}



sub setup {


print <<EOF;
<html>
<body bgcolor="#ffffff">
<table border="0" bgcolor="#000000" cellspacing="1" cellpadding="0">
  <form action="$admin" method="POST">
  <tr bgcolor="#7CA3DE">
    <td>
	  <font size="3" face="arial" color="#ffffff">
        <b>Mailing List $version Setup</b>
      </font>
    </td>
  </tr>
  <tr bgcolor="#999999">
    <td>
	  <font size="2" face="arial" color="#f0f0f0">
		<b>Please set up your admin name and password</b>
	  </font>
	</td>
  </tr>
  <tr>
  <td cellspacing="0" cellpadding="0">
  		 <table cellspacing="0" cellpadding="0" width="100%">

   	   	<tr bgcolor="#f0f0ff">
       		  <td>
			        Password:
			  </td>
			  <td>
	  			   <input type=\"text\" name=\"password1\">
	  		  </td>
  		 </tr>
       	 <tr bgcolor="#f0f0ff">
       		  <td>
			        Enter the passward again:
			  </td>
			  <td>
	 			 	<input type=\"text\" name=\"password2\">
	 		   </td>
  		 </tr> 
  		</table>
  </td></tr>
  <tr bgcolor="#7CA3DE">
    <td>
	  <input type=\"submit\" value=\"OK\">
	</td>
  </tr>
</table>
<input type=\"hidden\" name=\"action\" value=\"firsttime\">
</form>
</body>
</html>
EOF

exit;

}

sub firsttime {

if ($form{'password1'} eq "" and !$form{'password1'}) {
print "Please don't leave the password field blank!";
exit;
}
if ($form{'password2'} eq "" and !$form{'password2'}) {
print "Please don't leave the password field blank!";
exit;
}
if ($form{'password1'} ne "$form{'password2'}" and $form{'password1'} != $form{'password2'}){
print "You entered two different passwords. Please try again!";
exit;
}


$form{'password1'}=~ tr/A-Z/a-z/; 
$form{'password2'}=~ tr/A-Z/a-z/; 


$password = crypt($form{'password1'}, "YL");	
$password2 = crypt($form{'password2'}, "YL");	
unless ($password eq $password2){
print "You entered two different passwords. Please try again!";
exit;
}
   
open (PASSWORD, ">$fullpath/$passfile") or &error("unable to create the password file");
print PASSWORD "$password";
close (PASSWORD);
print "<h2>New admin name and password are saved. Please <a href=\"$admin\">click here</a> to login.</h2>\n";
exit;
}

###
print "Content-type: text/html\n\n";
print <<EOF;
<html>
<head>
<title>Mailing list Admin</title>
</head>
<body bgcolor="#ffffff">
<center><font face="Arial">
<b><font size="+3">Mailing List $version</font></b><font size="-1">&nbsp;&nbsp;<a href="http://www.cgi-factory.com/">from CGI-Factory.com!</a></font>
<br><br>
<table border="0">
<form action="$admin" method="post">
<tr><td><b>Admin Password:</b></td><td><input type="password" name="password"></td></tr>
<tr><td></td><td><input type="hidden" name="action" value="main_page">
<input type="submit" value="GO!">
</form></td></tr></table></font></center>
</body>
</html>
EOF
###
sub main_page {

&vpassword;

open (list, "<$listdata") or &error("Unable to open the data file for reading");
@list=<list>;
close(list);
$count=@list;

&admin_header;
print <<EOF;
<table border="0">
You have $count subscribers.<br>
<form action="$admin" method="post">
<tr><td><b>Subject:</b></td><td><input type="text" name="subject" size="60"></td></tr>
<tr><td valign="top"><b>Message:</b></td><td><br><textarea cols="70" rows="15" name="message"></textarea></td></tr>
<tr><td></td><td><input type="hidden" name="password" value="$form{'password'}"></td></tr>
<tr><td></td><td><input type="hidden" name="action" value="preview">
<input type="submit" value="GO!">
</form></td></tr></table>
<table border="0"><tr><td>
<form action="mail-admin.pl" method="post">
<input type="hidden" name="password" value="$form{'password'}">
<input type="hidden" name="action" value="view_all">
<br><input type="submit" value="View all subscribers">
</form>
</td></tr></table>
<br><br>
<h3>Add an email</h3>
<table border="0"><tr><td>
<form action="$admin" method="post">
<b>Email:</b> <input type="text" name="address" size="18" maxlength="50"><br>
<input type="hidden" name="action" value="subscribe">
<input type="hidden" name="password" value="$form{'password'}">
<br><input type="submit" value="GO!">
</form>
</td></tr>
</table>

EOF
&admin_footer;
exit;
}
sub view_all {

&vpassword;
&admin_header;
open (list, "<$listdata") or &error("Unable to open the data file for reading");
if ($flock eq "y") {
flock list, 2; 
}
@list=<list>;
close(list);

@list=sort(@list);

print "<form action=\"$admin\" method=\"post\">";

foreach $list (@list) {
chomp ($list);
print "$list<input type=\"checkbox\" name=\"email\" value=\"$list\"><br>\n";	
}	

print "<input type=\"hidden\" name=\"action\" value=\"delete_entries\"><input type=\"hidden\" name=\"password\" value=\"$form{'password'}\">
<input type=\"submit\" value=\"Delete all checked emails\"></form>";

print "<br>please close your browser if you want to log out.<br>
";
&back_button;
&admin_footer;

exit;
}

sub preview {

&vpassword;


$form{'message'}=~ s/\n/<br>/ig;

&admin_header;
print "The following information will be sent:<br>\n";
print "Subject: $form{'subject'}<br>\n";
print "Message:<br> $form{'message'}</br>\n";
$form{'subject'}=~ s/"/&quot;/ig;
$form{'message'}=~ s/"/&quot;/ig;
$form{'message'}=~ s/<br>/\n/ig;
$form{'subject'}=~ s/</&lt;/ig;
$form{'subject'}=~ s/>/&gt;/ig;
$form{'message'}=~ s/</&lt;/ig;
$form{'message'}=~ s/>/&gt;/ig;
print <<EOF;
<form action="$admin" method="post">
<input type="hidden" name="subject" value="$form{'subject'}">
<input type="hidden" name="message" value="$form{'message'}">
<input type="hidden" name="password" value="$form{'password'}"><br>
<input type="hidden" name="action" value="sendnow">
<input type="submit" value="GO!">
</form>
EOF
&admin_footer;
exit;
}
sub sendnow {
&vpassword;


FORK: {
	  if ($pid = fork) {
	  	 	    print "Content-type: text/html\n\n";
   	  	 	#parent here
				&admin_header;
				print "<br>Your mailing list request is been proccessed.<br>
				You will receive an email confirmation when the process is compeleted.<br><br>
				please close your browser if you want to log out.<br>";
				&back_button;
				&admin_footer;
				exit(0);
		
		
		} 
	
		elsif (defined $pid) { # $pid is zero here if defined
			  
			  #stop sending information to the browser
			  
			  close (STDOUT);
			  
			  
			  $form{'subject'}=~ s/&quot;/"/ig;
			  $form{'message'}=~ s/&quot;/"/ig;
			  $form{'subject'}=~ s/&lt;/</ig;
			  $form{'subject'}=~ s/&gt;/>/ig;
			  $form{'message'}=~ s/&lt;/</ig;
			  $form{'message'}=~ s/&gt;/>/ig;
			  
			  # child here
			  open (list, "<$listdata") or &error("Unable to open the data file for reading");
			  @list=<list>;
			  close(list);
		
			  #email header and footer
			  if ($header eq "y") {
			     open (HEADER, "<$fullpath/header.txt") or &error("Unable to open the header file for reading");
				    @header=<HEADER>;
					   close(HEADER);
			  }
			  if ($footer eq "y") {
		   	  	 open (FOOTER, "<$fullpath/footer.txt") or &error("Unable to open the header file for reading");
		  		 @footer=<FOOTER>;
		  		 close(FOOTER);
			  }
		
		#start to send emails
			   foreach $list (@list) {
			            chomp ($list);
			 	        open (MAIL, "|$mailprog") || &error("Can't open the mail program!");
				        print MAIL "To: $list\n";
					    print MAIL "From: $yourmail\n";
					    print MAIL "Subject: $form{'subject'}\n\n";
			  			print MAIL "@header" if ($header eq "y");
			  			print MAIL "$form{'message'}\n\n";
			  			print MAIL "@footer" if ($footer eq "y");
			  			close (MAIL);
			  			}		
						
								
			  &process_complete;					
			  exit(0);
			  
			  } 
			  elsif ($! =~ /No more process/) {     
			  		# EAGAIN, supposedly recoverable fork error
			  	sleep 5;
			  	redo FORK;
		
				} 
	
				else {
				# weird fork error
				print "Content-type: text/html\n\n";
				  		&error("Can't fork: $!\n");
					 }
		}

exit;	
}
################check password
sub vpassword{
if (!$ENV{'REMOTE_HOST'}) {
   $IP=$ENV{'REMOTE_ADDR'};
}
else {
	 $IP=$ENV{'REMOTE_HOST'};
}

open (PASS,"$fullpath/$passfile") || &error("unable to open $passfile"); 
$pass = <PASS>;
close(PASS);
$form{'password'}=~ tr/A-Z/a-z/;
$pass2 = crypt($form{'password'}, "YL");
unless ($pass eq "$pass2") {
$timenow=localtime();
&admin_header;
print "Incorrect logon. Use your back button to try again.<br>";
print "The password you entered is incorrect.<br>";
print "The following information has been sent to the webmaster of the web site<br>";
print "Your Information: <ul>$IP</ul>";
print "<ul>Password: $form{'password'}</ul>";
print "<ul>Time: $timenow</ul>";

open (errorlog, ">>$fullpath/errorlog.txt") or &error("unable to write to errorlog.txt"); #log the incorrect login
print errorlog "IP: $IP| pass: $form{'password'}| time: $timenow\n";
close (errorlog);

 
if ($alert eq "y") {       
     open (MAIL, "|$mailprog") or &error("Unable to open the mail program");
     print MAIL "To: $yourmail\n";
     print MAIL "From: $yourmail\n";
     print MAIL "Subject: bad password\n";
     print MAIL "Just a quick note to let you know that someone\n";
     print MAIL "entered the wrong password for entering the mailing list admin script.\n";
     print MAIL "Here are the information:\n\n";
     print MAIL "$IP\n";
     print MAIL "Password: $form{'password'}\n";
     print MAIL "$timenow\n";
     close(MAIL);
}      

&admin_footer;

exit;

}

}	

####################################################################
#send the user an email when the email sending process is completed#
####################################################################
sub process_complete {
     open (MAIL, "|$mailprog") or &error("Unable to open the mail program");
     print MAIL "To: $yourmail\n";
     print MAIL "From: $yourmail<Mailing List $version>\n";
     print MAIL "Subject: Message has been sent to all subscribers! Mailing List $version\n";
     print MAIL "Message has been sent to all subscribers!\n";
     close(MAIL);
}


################
#delete entries#
################
sub delete_entries {
&vpassword;
&flock($listdata.".lock");
open (list, "<$listdata") or &error("Unable to open the data file for reading");
@list=<list>;
close(list);
&unflock($listdata.".lock");

##############################################
# store all selected addresses into an array #
##############################################


@pairs2 = split(/&/, $buffer);
$count=0;
foreach $pair2 (@pairs2) {

		($field_name, $field_value) = split(/=/, $pair2);

		if ($field_name eq "email") {
		@entries[$count]="$field_value";
		$count++;
		}
        
}

#########################################################
# use a foreach loop to delete the selected entry files #
#########################################################
&admin_header;
		foreach $entry(@entries) {
				$count=0;
				foreach $list(@list) {

						if ($list =~ /$entry/i) {
   						   splice(@list, $count, 1);

   			 	 		   print "$entry was removed.<br>";
						}
   				 		$count++;
				 }
	
				 
		}
		&back_button;
		&admin_footer;
		
		&flock($listdata.".lock");
		open (list, ">$listdata") or &error("Unable to write to the data file");
		print list @list;
		close(list);
		&unflock($listdata.".lock");
		
		
		exit;
}

##############################
#subscribe
##############################
sub subscribe {
	
###search the data to see if the address is already in the database


if ($form{'address'}=~ tr/;<>*|`&$!#()[]{}:'"//) {
	&admin_header;
	print "<h2>Unable to subscribe the email address</h2>\n"; 
	print "Please don't use weird symbols<br>\n";
	print "Please click <a href=\"$main_page\">here</a> to return to our main page.<br>\n";
	&back_button;
	&admin_footer;
	exit;
}

unless ($form{'address'}=~/.*\@.*\..*/)   { 
	&admin_header;
	
	print "<h2>Unable to subscribe the email address</h2>\n"; 
	print "You've entered an invalid email address.<br>\n";
	&back_button;
	&admin_footer;
exit;
}
 &flock($listdata.".lock");	
 open (list, "<$listdata") or &error("Unable to open the data file for reading");
 @list=<list>;
 close(list);
 &unflock($listdata.".lock");
	
	foreach $list(@list) {

			if ($list =~ /$form{'address'}/i) {
		       &admin_header;
		       print "<h2>Unable to subscribe the email address</h2>\n"; 
		       print "Sorry, this email address \"$form{'address'}\" is already in the database<br>\n";
			   &back_button;
		   	   &admin_footer;
		   	   exit;
		   		}
		   }
		   
		   &flock($listdata.".lock");
		   open (data, ">>$listdata") or &error("Unable to open the data file for writing");
		   print data "$form{'address'}\n";
		   close(data);
		   &unflock($listdata.".lock");

	&admin_header;
	print "<br>$form{'address'} has been added<br>\n";
	&back_button;
	&admin_footer;
	exit;	
}

#########################################################
#file lock. useage  &flock([name of the file lock])     #
# &unflock([name of the file lock]) 		 			# 
#########################################################
sub flock
  {
  local ($lock_file) = @_;
  local ($timeout);

  $timeout=20;
  while (-e $lock_file && 
        (stat($lock_file))[9]+$timeout>time)
  { sleep(1);}
 
  open LOCK_FILE, ">$lock_file" 
    or &error("Unable to create $lock_file");
}

sub unflock
  {
  local ($lock_file) = @_;

  close(LOCK_FILE);
  unlink($lock_file);
  }

##############################
#admin header and footer subroutins#
##############################
sub admin_header {
print <<EOF;
<html>
<head>
<title>Mailing List Admin</title>
</head>
<body bgcolor="#ffffff">
<table border="0" bgcolor="#000000" cellspacing="1" cellpadding="0" width="100%">
  <tr bgcolor="#7CA3DE">
    <td>
	  <font size="3" face="arial" color="#ffffff">
        <b>Mailing List $version</b>
      </font>
    </td>
  </tr>
  <tr bgcolor="#ffffff">
    <td>
	  <font size="1" face="arial" color="#00000f">
		<b>$description &nbsp;</b>
	  </font>
	</td>
  </tr>
  
 <tr bgcolor="#f0f0ff">
    <td><font size="2" face="arial" color="#000000"><ul>
	<br>
EOF
}

sub admin_footer {

print <<EOF;
	  </ul>
     	</td>
	  </tr>
	    <tr bgcolor="#ffffff">
    <td>
	  <font size="2" face="arial" color="#000000">
		<b>Copyright 1999-2001 CGI-Factory.com of SiliconSoup.com LLC</b>
	  </font>
	</td>
  </tr>
	  </table>
	</td>
  </tr>
</table>
</td>
</tr>
</table>
</body></html>
EOF
$description="";
}

sub back_button {
	
	print "
	<form action=\"$admin\" method=\"post\">
	<input type=\"hidden\" name=\"action\" value=\"main_page\">
	<input type=\"hidden\" name=\"password\" value=\"$form{'password'}\">
	<input type=\"submit\" value=\"Back to the admin main page\">
	</form>";


}
###############error alert
sub error{
print "An error has been occured. The error is: $_[0]<br>\n";
print "<font color=\"red\">Reason: $!</font>\n";
exit;
}

