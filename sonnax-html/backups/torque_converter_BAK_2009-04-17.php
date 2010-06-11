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
$product_line_id = 2;
$Part = getFeaturedPart($product_line_id);//this function returns a class
$ProductLine 	= new ProductLine($product_line_id);

//would need these to pull info from the unit_components table for some product lines
//$unit_components_id = $_GET["ucid"];
//$Unit_Component = Search::componentById($unit_components_id);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="Content-Language" content="en">
	<meta name="description" content="Sonnax">
	<meta name="keywords" content="Sonnax">
	<meta name="author" content="Sonnax">
	<meta name="copyright" content="Sonnax">
	<meta name="robots" content="all">
	<link rel="contents" href="#" title="Sonnax">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<title>Sonnax - Torque Converter</title>
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
.style1 {color: #00257b}
a:link {
	color: #00257b;
}
a:visited {
	color: #00257b;
}
-->
</style>
</head>
<body>
<div id="container">
<div id="header_cart_tc"><div class="header"></div></div>
<?php require "nav.txt";?>

<div class="content">
  <p>Sonnax offers a full line of high-quality parts for domestic, foreign, performance and industrial torque converters. Working closely with our worldwide customer base, we develop new products as new units and requirements emerge in the aftermarket. In a fast-paced, changing marketplace, Sonnax remains committed<em> to providing the quality product, top service and technical support our customers deserve.<br>
  &nbsp;<br>
    </em>Sonnax is proud to be the only aftermarket distributor of Raybestos® friction materials&nbsp;for torque converter applications. To learn more about OEM friction material properties and applications, click on <strong><u><a href="raybe-fric-mat-recom.pdf" class="style1">Raybestos Friction Material Recommendations.</a></u> &nbsp;</strong>For part number and ring size information click on <span class="style1"><strong><u><a href="announcements/FRICTION-RINGS.pdf" class="style1">Raybestos Friction Rings from Sonnax Catalog</a></u></strong><a href="announcements/FRICTION-RINGS.pdf"><strong>.</strong></a></span><strong><br>
  &nbsp;<br>
    </strong></p>
  <hr align="center" width="75%" size="2" class="style1">
  <p>Our <strong><u><a href="part_finder.php?pl=2" class="style1">Torque Converter Online Catalog</a> </u></strong>makes it easy to find the parts you need. Search by application for an exploded view of the unit and part number information. Use the online catalog to place an order and enter the quantity in the order box beside the part number. &nbsp;To place your order quickly, use our <strong><u><a href="speed_order.php" class="style1">Torque Converter Speed Order</a></u></strong>. <strong>&nbsp; </strong>Many of you have asked us for an online version of our Catalog Details section, where all parts of a similar type are listed together. Click <u><a href="details.pdf" target="_blank"><strong>Details Section</strong></a></u> to view our current Details compilations.</p>
  <p>&nbsp;</p>
  <p align="right"><a href="part_finder.php?pl=2&new_only=true" style="margin:0;color: #fff;padding: 1px 6px 1px 6px;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;"><span class="button" style="border:none;width:80px;text-decoration:none;">New parts</span></a>    <a href="part_finder.php?pl=2" style="margin:0;color: #fff;padding: 1px 6px 1px 6px;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;"><span class="button" style="border:none;width:80px;text-decoration:none;">ONLINE CATALOG</span></a>	<a href="speed_order.php"  style="margin:0;color: #fff;padding: 1px 6px 1px 6px;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;"><span class="button" style="border:none;width:80px;text-decoration:none;">Speed Order</span></a>      </p>
  <div class="cleaner"></div>


</div>

<div id="right_content">
<br><br><br><br><br>
<p><strong>Featured Product:</strong> <?=$Part->part_number?><br>
<!--<strong>Item:</strong> <?=$Part->item?><br>-->
<?
$makes = $Part->getMakesPartAppliesTo();
$makesUpperBound = count($makes) - 1;
if ($product_line_id == 11) {
	$unit_query_string = "driveline_series";
} else {
	$unit_query_string = "unit";
}

for ($x=0; $x <= $makesUpperBound; $x++) {
	$make = new Make($makes[$x]);
	$make_name = $make->make;
	$units =  $Part->getUnitsContainingPart($makes[$x]);
	$unitsUpperBound = count($units) - 1;
	unset($unitList);
	for ($y=0; $y <= $unitsUpperBound; $y++) {
		$brief_unit = new UnitBrief($units[$y]);
		if ($y < $unitsUpperBound) {
			$unitList .= "<a href='part_finder.php?$unit_query_string=$brief_unit->id&make=$makes[$x]&pl=$product_line_id'>$brief_unit->name</a>, ";
		} else {
			$unitList .= "<a href='part_finder.php?$unit_query_string=$brief_unit->id&make=$makes[$x]&pl=$product_line_id'>$brief_unit->name</a>";
		}
	}
	if ($product_line_id == 11) {
		?>
		<strong>Driveline</strong>: <?=$unitList?><br>
		<?
	} elseif ($product_line_id == 7) {
		?>
		<strong>Allison</strong>: <?=$unitList?><br>
		<?
	} elseif ($product_line_id == 9) {
		?>
		<strong>Power Train Savers&reg;</strong><br>
		<?
	} else {
		?>
		<strong>Make:</strong> <?=$make_name?><br>
		<strong>Unit:</strong> <?=$unitList?><br>
		<?
	}
}
?>
<!-- description1 --><?=cp1252_to_utf8($Part->description)?><br>
<!-- description2 --><?=cp1252_to_utf8($Part->notes)?><br>
<div class="cleaner"></div>

</div>
<div class="left_content">
<?
if (file_exists($global_photo_directory_abs.$Part->photo) && (strlen($Part->photo) > 0) ) {
	$str_file_path = $global_photo_directory_rel.$Part->photo;
} else {
	$str_file_path = "images/no_photo.gif";
}?>
<img src="<?=$str_file_path?>"  alt="Part Summary" style="float:left;padding-right:10px;">
</div>



<div class="cleaner"></div>
<div class="content">
	<h4 style="text-align:center;"><a href="part_finder.php?pl=2"></a></h4>
</div>

<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "torque_converter.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>