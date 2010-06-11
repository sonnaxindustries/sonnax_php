<?
require_once("includes/settings.php");//holds paths to pdfs, images, etc.
require_once("includes/classes/clsPartFinder.php");
require_once("includes/classes/clsPart.php");
require_once("includes/classes/clsMakes.php");
require_once("includes/classes/clsProductLine.php");
require_once("includes/classes/clsUnitBrief.php");
require_once("includes/classes/clsSearch.php");
require_once("includes/generic_functions.php");


//$part_finder 		= new PartFinder($_GET);
$product_line_id = 3;
$Part = getFeaturedPart($product_line_id);//this function returns a class
$ProductLine 	= new ProductLine($product_line_id);

//would need these to pull info from the unit_components table for some product lines
//$unit_components_id = $_GET["ucid"];
//$Unit_Component = Search::componentById($unit_components_id);
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
<title>Sonnax - Transmission Specialties&reg;</title>
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
<link href="file:///DOCUMENTS/Styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Exploded-view-name {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
-->
</style>
</head>
<body>
<div id="container">
<div id="header_ts_test"><div class="header"><h3>&nbsp;</h3>
</div></div>
<?php require "nav.txt";?>
<div class="content_center">
  
  
  <div class="content">	
    
    <table width="785" height="124" border="0" align="center" cellpadding="5" cellspacing="2">
      
      <tr>
        <td width="379" rowspan="2" align="left" valign="baseline" scope="col"><div align="center">
          <p align="center" class="Exploded-view-name"><a href="TS-valve-body-layouts.html" target="_blank"><img src="Mitsubishi-F4A-F5A-home.jpg" width="330" height="220" border="0" align="top">
         </a></p>
          <p align="center" class="Exploded-view-name"><strong><a href="TS-valve-body-layouts.html" target="_blank">Mitsubishi F4A/F5A </a></strong> </p>
          <p align="center" class="Exploded-view-name">Click on image for printable pdf versions of valve body layouts including the one above.</p>
        </div>        </td>
        
        <td width="411" height="77" valign="top" scope="col"><p align="justify">Well-designed parts deserve well-designed product graphics. With the variety of valves in each valve body and line-up's in each bore, it's important to show the components in each kit, where they fit, and the complaints they address. Click <a href="TS-valve-body-layouts.html">Valve Body Layouts</a> for a growing list of units with printable pdf versions. </p>
        <p align="justify">It’s about more than having well-designed parts offered at a great value. In a fast-changing global marketplace, rebuilders routinely see new, complex units that require new tools, techniques and know-how. Published monthly in <a href="http://www.transmissiondigest.com/">Transmission Digest</a>, Sonnax <a href="http://www.sonnax.com/tech_info_results.php?category_id=2&subcategory_id=8&go=GO">TASCForce Tech Tips</a> are just one source of transmission technical articles available online on our <a href="http://www.sonnax.com/tech_info.php">Technical Information page</a>. </p></td>
      </tr>
      
      <tr>
        <td height="41" valign="top"><p align="right"><a href="part_finder.php?pl=3&new_only=true" style="margin:0;color: #fff;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;"><span class="button" style="border:none;width:80px;text-decoration:none;">New parts</span></a> <a href="part_finder.php?pl=3"  style="margin:0;color: #fff;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;"><span class="button" style="border:none;width:80px;text-decoration:none;">Part &amp; Application FindeR</span></a></p></td>
      </tr>
    </table>
	<p><br>
</p>

	
  <img src="images/spacer.jpg" width="450px" height="1px" alt="spacer"></div>
<div class="clear"></div>
<div class="content">
  <!-- start of the rotator PHP code -->
  <!-- end of the rotator PHP code -->	
</div>
</div>


<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "trans_spec.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>
