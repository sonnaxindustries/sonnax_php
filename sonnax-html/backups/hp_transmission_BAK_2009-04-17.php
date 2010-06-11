<?
require_once("includes/settings.php");//holds paths to pdfs, images, etc.
require_once("includes/classes/clsPartFinder.php");
require_once("includes/classes/clsPart.php");
require_once("includes/classes/clsMakes.php");
require_once("includes/classes/clsProductLine.php");
require_once("includes/classes/clsUnitBrief.php");
require_once("includes/classes/clsSearch.php");
require_once("includes/generic_functions.php");


$product_line_id = 1;
$Part = getFeaturedPart($product_line_id);//this function returns a class
$ProductLine 	= new ProductLine($product_line_id);

//would need these to pull info from the unit_components table for some product lines
//$unit_components_id = $_GET["ucid"];
//$Unit_Component = Search::componentById($unit_components_id);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
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
<title>Sonnax - High Performance Trasmission Specialties</title>
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
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.HPDistributorbold {font-size: 14px}
.style2 {
	font-size: 10.5px
}
-->
</style>
</head>
<body>
<div id="container">
	<div id="header_hp_trans"><div class="header">
	</div></div>
	<?php require "nav.txt";?>
	
	<div id="right_content">
		<p><strong>Sonnax offers a line of quality transmission parts for the High Performance market. Our listings feature both hard-to-find OEM replacement parts as well as innovative solutions that will make your street, circle track or drag racing vehicle faster, stronger and more consistent. Made from materials equivalent or superior to OEM standards, many of our products have been re-engineered for improved performance and greater durability, based on input from customers actively involved in racing. &nbsp;</strong></p>
	  <p><strong>You can use our online <U><a href="http://www.sonnax.com/part_finder.php?pl=1">Part and Application Finder</a></U> and search by application (Make, Unit) or by Part Number to find the part you need quickly and easily. Then click on the Part Number for a photo, more detailed product information and installation instructions. For information on the latest in New Sonnax Performance Parts, &nbsp;click here to join our <U><a href="http://www.sonnax.com/termsandconditions.html">email list.</a></U></strong> </p>
	  <p><strong>For more information on Sonnax performance product options and your build needs, contact a Sonnax <a href="hp-distributors.html"  style="margin:0;color: #fff;padding: 1px 1px 1px 1px;background-color: #024368; font:normal 10px/11px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;">High performance distributor</a></strong></p>
<p><br />
	      <a href="part_finder.php?pl=1&new_only=true" style="margin:0;color: #fff;padding: 1px 6px 1px 6px;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;text-decoration:none;">New parts</a>	<a href="part_finder.php?pl=1"  style="margin:0;color: #fff;padding: 1px 6px 1px 6px;background-color: #024368; font:normal 12px/14px arial,helvetica,sans-serif;border: 1px solid #024368; text-transform:uppercase; vertical-align:center;"><span class="button" style="border:none;width:80px;text-decoration:none;">Part and Application Finder</span></a>
	      <?php if (is_object($Part)) {?>
	  </p>
	  <p><strong>Featured Product:</strong> <?=$Part->part_number?><br>
		<!--<strong>Item:</strong> <?=$Part->item?><br>-->
		<?php
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
				if ($y > 0) {
					$unitList .= ", ";
				}
				$unitList .= "<a href='part_finder.php?$unit_query_string=$brief_unit->id&make=$makes[$x]&pl=$product_line_id'>$brief_unit->name</a>";
			}
			if ($product_line_id == 11) {
				?>
				<strong>Driveline</strong>: <?=$unitList?><br>
				<?php
			} elseif ($product_line_id == 7) {
				?>
				<strong>Allison</strong>: <?=$unitList?><br>
				<?php
			} elseif ($product_line_id == 9) {
				?>
				<strong>Power Train Savers&reg;</strong><br>
				<?php
			} else {
				?>
				<strong>Make:</strong> <?=$make_name?><br>
				<strong>Unit:</strong> <?=$unitList?><br>
				<?php
			}
		}
		?>
		<!-- description1 --><?=cp1252_to_utf8($Part->description)?><br>
		<!-- description2 --><?=cp1252_to_utf8($Part->notes)?><br>
		<?php }?>
		
		<div class="cleaner"></div>
	</div>
<div class="left_content">
		<!--<img src="images/hp_transmission.jpg" width="365" height="365" alt="Sure Cure&reg; Transmission Reconditioning Kits">-->
		<?php
		if (file_exists($global_photo_directory_abs.$Part->photo) && (strlen($Part->photo) > 0) ) {
			$str_file_path = $global_photo_directory_rel.$Part->photo;
		} else {
			$str_file_path = "images/no_photo.gif";
		}?>
		<img src="<?=$str_file_path?>"  alt="Part Summary" style="float:left;padding-right:5px;">
	</div>
	<div class="clear"></div>
	<div class="content">
		
		<div align="center"></div>
	  
  </div>
	
  <div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "hp_transmission.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>