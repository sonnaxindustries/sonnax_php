<?
require_once("includes/settings.php");//holds paths to pdfs, images, etc.
require_once("includes/classes/clsPart.php");
require_once("includes/classes/clsMakes.php");
require_once("includes/classes/clsProductLine.php");
require_once("includes/generic_functions.php");
require_once("includes/classes/clsUnitBrief.php");
require_once("includes/classes/clsSearch.php");

$product_line_id 	= $_GET["pl"];
$part_id 			= $_GET["id"];
$unit_components_id = $_GET["ucid"];

$Part 			= new Part($part_id);
$ProductLine 	= new ProductLine($product_line_id);

$Unit_Component = Search::componentById($unit_components_id);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
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
<title>Sonnax Transmission, Torque Converter, Performance, Driveline Parts :: <?=$ProductLine->name?> :: <?=$Part->part_number?> :: Part Summary</title>
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

</head>
<body>
<div id="container">
<?/*
Change <div id="header_gen"> to 
<div id="header_tranny, header_trans, header_sure, header_sonna, header_harley, etc."> depending on Product Line All headers are near the top of style.css

<div id="header_gen">
<div id="header_trans">
<div id="header_sure">
<div id="header_sonna">
<div id="header_harley">
<div id="header_allison">
<div id="header_tranny">
<div id="header_hp_trans">
<div id="header_hp_torque">
<div id="header_torque">
<div id="header_trade">
<div id="header_tasc_force">
*/?>
<div id="header_gen"><div class="header"><h3>
<?
if ($ProductLine->name == "High Performance Torque Converter") {
	echo "High Performance<BR>Torque Converter";
} else {
	echo $ProductLine->name;
}
?>
<br>
Part Summary</h3></div></div>
<?php require "nav.txt";?>
<div id="main">
<?if ($Part->id == 0 || !is_numeric($Part->id)) {//bogus part id IF?>
	<div class="content">
	Invalid Product ID <?=$part_id?><BR>
	</div>
<?} else {?>
<div class="content">
<?
if (file_exists($global_photo_directory_abs.$Part->photo) && (strlen($Part->photo) > 0) ) {
	$str_file_path = $global_photo_directory_rel.$Part->photo;
} else {
	$str_file_path = "images/no_photo.gif";
}?>
<img src="<?=$str_file_path?>"  alt="Product Line Part Summary" style="float:left;padding-right:10px;">
<?
//if ($Part->new_item == 1) {?!>
	//<p><span style='color: #3A2773; font-size: 22px; font-weight: bold;'>NEW</span></p>
//<!?}
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
		<p><strong>Driveline</strong>: <?=$unitList?></p>
		<?
	} elseif ($product_line_id == 7) {
		?>
		<p><strong>Allison</strong>: <?=$unitList?></p>
		<?
	} elseif ($product_line_id == 9) {
		?>
		<p><strong>Power Train Savers&reg;</strong></p>
		<?
	} else {
		?>
		<p><strong><?=$make_name?></strong>: <?=$unitList?></p>
		<?
	}
}
?>

<p><strong>Part Number:</strong>&nbsp;<?=$Part->part_number?></p>
<?if ($product_line_id == 9) {
	if (strlen($Unit_Component->arrayList["unit_components.description"][0]) > 0){?>
	<p><strong>Description:</strong>&nbsp;<?=cp1252_to_utf8($Unit_Component->arrayList["unit_components.description"][0])?></p>
	<?}
	if (strlen($Unit_Component->arrayList["unit_components.notes"][0]) > 0){?>
	<p><strong>Notes:</strong>&nbsp;<?=cp1252_to_utf8($Unit_Component->arrayList["unit_components.notes"][0])?></p>
	<?}
} else {?>
<p><!-- description1 --><?=cp1252_to_utf8($Part->description)?></p>
<p><!-- description2 --><?=cp1252_to_utf8($Part->notes)?></p>
<?}?>

<?php
// Part Summay and Instruction go here for certain PLs
if ($product_line_id == "3" || $product_line_id == 3 || $product_line_id == "12" || $product_line_id == 12 || $product_line_id == "14" || $product_line_id == 14) {?>	
<!-- Show ONLY for TS SC and TT -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_announcement_directory_abs.$Part->announcement) && (strlen($Part->announcement) > 0)) {?>
	<a href="<?=$global_announcement_directory_rel.$Part->announcement?>">Part Summary</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	<?if (file_exists($global_instructions_directory_abs.$Part->instructions) && (strlen($Part->instructions) > 0)) {?>
	<a href="<?=$global_instructions_directory_rel.$Part->instructions?>">Instructions</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	</h4>
<?} elseif ($product_line_id == "2" || $product_line_id == 2) {?>	
<!-- Show ONLY for TC -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_announcement_directory_abs.$Part->announcement) && (strlen($Part->announcement) > 0)) {?>
	<a href="<?=$global_announcement_directory_rel.$Part->announcement?>">Part Summary</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	<?if (file_exists($global_instructions_directory_abs.$Part->instructions) && (strlen($Part->instructions) > 0)) {?>
	<a href="<?=$global_instructions_directory_rel.$Part->instructions?>">Instructions</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	</h4>
<?} elseif ($product_line_id == "11" || $product_line_id == 11) {?>	
<!-- Show ONLY for Driveline -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_announcement_directory_abs.$Part->announcement) && (strlen($Part->announcement) > 0)) {?>
	<a href="<?=$global_announcement_directory_rel.$Part->announcement?>">Part Summary</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	</h4>
<?} elseif ($product_line_id == "7" || $product_line_id == 7) {?>	
<!-- Show ONLY for Allison -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_announcement_directory_abs.$Part->announcement) && (strlen($Part->announcement) > 0)) {?>
	<a href="<?=$global_announcement_directory_rel.$Part->announcement?>">Part Summary</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	</h4>
<?} elseif ($product_line_id == "1" || $product_line_id == 1) {//not sure on this id?>
<!-- Show ONLY for High Performance Transmissions -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_announcement_directory_abs.$Part->announcement) && (strlen($Part->announcement) > 0)) {?>
	<a href="<?=$global_announcement_directory_rel.$Part->announcement?>">Part Summary</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	<?if (file_exists($global_instructions_directory_abs.$Part->instructions) && (strlen($Part->instructions) > 0)) {?>
	<a href="<?=$global_instructions_directory_rel.$Part->instructions?>">Instructions</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	</h4>
<?}?>

<div class="cleaner"></div>


<?if ($product_line_id == "3" || $product_line_id == 3 || $product_line_id == "12" || $product_line_id == 12 || $product_line_id == "14" || $product_line_id == 14) {?>	
<!-- Show ONLY for TS SC and TT -->
	<h4 style="text-align:center;">
	<a href="part_finder.php?pl=3">Transmission Specialties&reg; Part Finder</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?if (file_exists($global_instructions_directory_abs.$Part->vbfix) && (strlen($Part->vbfix) > 0)) { ?>
	<a href="<?=$global_instructions_directory_rel.$Part->vbfix?>">Fixture Instructions</a></h4>
	<?}?>
	<h4 style="text-align:center;">
	<a href="tech_info.php">Find a Transmission Specialties&reg; Publication</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<a href="distributor.php?pl=3">Find a Transmission Specialties&reg; Distributor</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<!--<a href="trans_spec_dist.php">Find a Transmission Specialties&reg; Distributor</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">-->
	<?if (file_exists($global_tech_directory_abs.$Part->tech) && (strlen($Part->tech) > 0)) {?>
	<a href="<?=$global_tech_directory_rel.$Part->tech?>">Additional Diagnostic Information</a>
	<?}?>
	</h4>
	
	<p style="text-align:center;">For a complete listing of High Performance Transmission Parts click <a href="part_finder.php?pl=1"><strong>Here.</strong></a></p>
<?} elseif ($product_line_id == "2" || $product_line_id == 2) {?>	
<!-- Show ONLY for TC -->
	<h4 style="text-align:center;">
	<a href="part_finder.php?pl=2">Torque Converter Part Finder</a>
	</h4>
<?} elseif ($product_line_id == "11" || $product_line_id == 11) {?>	
<!-- Show ONLY for Driveline -->
	<h4 style="text-align:center;">
	<a href="part_finder.php?pl=9">Driveline Part Finder</a>
	</h4>
<?} elseif ($product_line_id == "9" || $product_line_id == 9) {?>	
<!-- Show ONLY for PTS -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_announcement_directory_abs.$Part->announcement) && (strlen($Part->announcement) > 0)) {?>
	<a href="<?=$global_announcement_directory_rel.$Part->announcement?>">Part Summary</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	<a href="part_finder.php?pl=9">Power Train Saver&reg; Part Finder</a></h4>
<?} elseif ($product_line_id == "8" || $product_line_id == 8) {?>	
<!-- Show ONLY for Ring Gear -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_announcement_directory_abs.$Part->announcement) && (strlen($Part->announcement) > 0)) {?>
	<a href="<?=$global_announcement_directory_rel.$Part->announcement?>">Part Summary</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer">
	<?}?>
	<a href="part_finder.php?pl=8">Ring Gear Part Finder</a></h4>
<?} elseif ($product_line_id == "7" || $product_line_id == 7) {?>	
<!-- Show ONLY for Allison -->
	<h4 style="text-align:center;">
	<a href="part_finder.php?pl=7">Allison&reg; Part Finder</a>
	</h4>
<?} elseif ($product_line_id == "1" || $product_line_id == 1) {//not sure on this id?>
<!-- Show ONLY for High Performance Transmissions -->
	<h4 style="text-align:center;">
	<?if (file_exists($global_tech_directory_abs.$Part->tech) && (strlen($Part->tech) > 0)) {?>
	<a href="<?=$global_tech_directory_rel.$Part->tech?>">Additional Diagnostic Information</a>
	<?}?>
	<br>
	<a href="part_finder.php?pl=1">High Performance Transmission Part Finder</a><img src="images/spacer.jpg" width="30" height="1" alt="spacer"><a href=" http://www.sonnax.com/hp-distributors.html">HP Transmission Distributors</a>
	</h4>
<?}?>
</div>
<?}//bogus part id IF?>
</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
//$virtual_page = parts_summary.php,product_line,part_number
$virtual_page = "part_summary.php|".$ProductLine->name."|".$Part->part_number;
$virtual_page = str_replace("'","",$virtual_page);
$virtual_page = str_replace(",","",$virtual_page);
$virtual_page = str_replace("|",",",$virtual_page);
include_once "includes/analyticstracking.php";
?>
</body>
</html>
