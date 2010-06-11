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

<style type="text/css">
<!--
.Nav-header {
	font-size: 11pt;
	font-weight: bold;
}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.catalogpartfinder {font-size: 10.5pt}
-->
</style>
</head>
<body>
<div id="container">
<div id="header_trans"><div class="header"><h3>&nbsp;</h3>
</div></div>
<?php require "nav.txt";?>
<table width="770" height="307" border="0" align="center" cellpadding="5" cellspacing="2">
      
      <tr>
        <td width="393" height="303" align="left" valign="top"><p class="opening-paragraph">Sonnax transmission parts feature carefully designed, innovative solutions that address common complaints and help rebuilders salvage expensive automatic transmissions and valve bodies. In addition, Sonnax offers many transmission and valve body parts for the latest automotive aftermarket units; direct replacement parts with proven track records; excellent product information; in-depth phone and online technical support; and a global network of knowledgeable transmission parts distributors. </p>
        <p align="left" span class="Nav-header"><span class="catalogpartfinder"><a href="part_finder.php?pl=3" class="verticalnavbardash">Part and Application Finder</a></span><a href="part_finder.php?pl=3" class="verticalnavbardash"><br>
          </a><span class="verticalnavbardash"><a href="part_finder.php?pl=3&new_only=true">New Parts<br>
          </a><a href="http://www.sonnax.com/distributor.php?country=USA&go=GO">Distributors<br>
          </a><a href="http://www.sonnax.com/termsandconditions.html">Email Sign Up<br>
          </a><a href="http://www.sonnax.com/contact_us.php" class="verticalnavbardash">Contact Us</a></span><strong><a href="part_finder.php?pl=3"><br>
          </a> </strong></p>
        </td>
        
        <td width="366" valign="top" scope="col"><p align="center" class="Exploded-view-name"><a href="TS-valve-body-layouts.html#tshome" target="_blank"><img src="722-6-VB-home.jpg" width="350" height="151" border="0"><br>
              </a></p>
          <p align="center" class="Exploded-view-name"><a href="TS-valve-body-layouts.html#tshome" target="_blank"><strong>Mercedes 722.6</strong></a><strong></strong> </strong></p>
        <p align="center" class="opening-paragraph">Click on image for printable Valve Body layouts. </p>          </td>
      </tr>
    </table>


<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "trans_spec.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>
