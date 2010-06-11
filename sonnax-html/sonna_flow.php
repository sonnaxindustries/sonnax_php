<?
header( 'Content-Type: text/html;charset=UTF-8' );

require_once "includes/classes/clsPublications.php";
require_once "includes/generic_functions.php";
require_once("includes/settings.php");//holds paths to pdfs, images, etc.


$cls_publications = new Publications();
$subcategory_id = "14";//we could write a function that searchs for the sonnaflow subcategory_id
$arr_titles = $cls_publications->lookupSubCategoryTitles($subcategory_id);
$int_num_titles = count($arr_titles["publication_titles.id"])-1;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta http-equiv="Content-Language" content="en">
	<meta name="description" content="Sonnax">
	<meta name="keywords" content="Sonnax">
	<meta name="author" content="Sonnax">
	<meta name="copyright" content="Sonnax">
	<meta name="robots" content="all">
	<link rel="contents" href="#" title="Sonnax">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<title>Sonnax - SonnaFlow&reg;</title>
<!--[if IE]>
<style type="text/css" media="screen">
#menu{float:none;} 
/* IE Menu CSS */
body{behavior:url(css/csshover.htc);
font-size:100%; 
}
#menu ul li{float:left;width:100%;}
#menu h2, #menu a{height:1%;font:bold 0.7em/1.4em arial,helvetica,sans-serif;}
</style>
<![endif]-->
<script type="text/javascript" src="js/iehover-fix.js"></script>
<script language="javascript" type="text/javascript">
<!--
function go()
{
	box = document.forms[0].navi;
	destination = box.options[box.selectedIndex].value;
	if (destination) location.href = destination;
}

// -->
</SCRIPT>
</head>
<body>
<div id="container">
<div id="header_sonna"><div class="header"><h3>Welcome to<br>SonnaFlow&reg;</h3></div></div>
<?php require "nav.txt";?>

<div class="content">
<p>Sonnax developed the SonnaFlow&reg; diagnostic kit for measuring ATF flow rates. This tool measures cooler flow in gallons per
minute, and can also be connected to a lab scope or used with a dynamometer. The SonnaFlow&reg; verifies cooler flow under
actual driving conditions and can even measure cooler flow during vehicle road tests. This unit allows you to detect a blocked
cooler flow circuit as well as weak pumps and more.</p>
<p>The SonnaFlow&reg; kit FM-01KA includes a meter with large display numbers and a low-flow warning light, technical manual,
all the necessary brass fittings, a detachable power cord and 12-foot insulated signal cable, durable electrical connectors and
12V power adapter. The SonnaFlow&reg; meter is spliced into the return line from the radiator to the transmission case, and should be
removed after testing. The SonnaFlow&reg; is not meant for permanent installation or for prolonged use. It can be installed in any vehicle,
whether the cooler return line is made of rubber or metal (metal return lines require a separate adapter). The power cord connects to
the cigarette adapter or can be modified for direct connection to the fuse box or to the battery.</p>
<p>Updated technical manual charts are available online.</p>
</div>

<div class="left_content">
  <a href="announcements/FM-01KA.pdf"><img src="images/sonna_flow.jpg" alt="Sure Cure&reg; Transmission Reconditioning Kits" width="365" height="259" border="0" style="padding-left:10px;"></a></div>

<div id="right_content">
<p style="padding-left:30px;">To download any SonnaFlow Chart (PDF) for your<br>
SonnaFlow Manual, select the application from the<br>
drop down menu:</p>

<p style="padding-left:30px;">For a blank SonnaFlow Data Form, <a href="static_pdf/sonnaflow_data_form.pdf">CLICK HERE</a></p>
<p style="padding-left:30px;">&nbsp;</p>
<div class="cleaner"></div>
<form name="sonnaflow_chart" action="" style="padding-left:30px;">
	<p>
	  <select name=navi onChange="go()">
	    <option value='' selected>--- Select SonnaFlow Chart ---
	      <?for ($x=0;$x<=$int_num_titles;$x++) {?>
	      <option value="<?=$global_sonnaflow_charts_directory_rel?><?=$arr_titles["publication_titles.pdf"][$x]?>">
          <?=$arr_titles["publication_titles.title"][$x]?>
          </option>
	    <?}?>
	    </select>
	</p>
	<p><a href="part_finder.php?pl=3"  style="margin:0;color: #fff;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;"><span class="button" style="border:none;width:80px;text-decoration:none;">Part &amp; Application FindeR</span></a><a href="http://www.sonnax.com/part_finder.php?pl=3"></a> </p>
</form>

</div>
<div class="clear"></div>
<div id="footer"></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "sonna_flow.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>
