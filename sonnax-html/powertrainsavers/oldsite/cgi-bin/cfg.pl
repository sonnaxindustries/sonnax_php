$mailprog="/usr/sbin/sendmail -t";
#the system path to your mail program
$listdata="list.txt";
#the file name of the data file. You need to create this file and upload it to your server. Then chmod it to 777.
$main_page="http://www.powertrainsavers.com";
#main page url. 
$yourmail="fern\@powertrainsavers.com";
#your email. don't forget the back slash - \ 
$alert="n";
#send an alert mail to you if someone enters a wrong password
$header="y";
#Set this variable to n if you want to turn the header text off 
#It is the header for the email message, not the html pages
$footer="y";
#set this variable to n if you want to turn the footer text off
#It is the footer for the email message, not the html pages
#end of modification
1;