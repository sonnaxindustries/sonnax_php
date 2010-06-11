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

</head>
<body>
<div id="container">
<div id="header_cart_tc"><div class="header"></div></div>
<?php require "nav.txt";?>


  <table width="761" height="279" border="0" align="center" cellpadding="5" cellspacing="2">
    <tr>
      <td width="409" height="275" valign="top" scope="col"><p class="opening-paragraph">Sonnax torque converter parts comprise a full line of quality components for domestic, import, industrial, racing and heavy-duty converters. Sonnax works closely with converter rebuilders around the world to develop new parts as new converters and requirements appear in the automatic transmission aftermarket. In a fast-paced and competitive marketplace, Sonnax remains committed<em> to providing the quality product, top service and technical support customers deserve.</em></p>
      <span class="verticalnavbardash"><a href="http://www.sonnax.com/part_finder.php?pl=2">Online Catalog</a><a href="http://www.sonnax.com/part_finder.php?pl=2"><br>
          </a><a href="http://www.sonnax.com/part_finder.php?pl=2&new_only=true">New Parts<br>
          </a><a href="http://www.sonnax.com/speed_order.php">Speed Order<br>
          </a><a href="http://www.sonnax.com/termsandconditions.html">Email Sign Up <br>
          </a><a href="http://www.sonnax.com/contact_us.php">Contact Us</a></span>
    </td>
      <td width="326" valign="top" scope="col"><div align="left">
        <?
if (file_exists($global_photo_directory_abs.$Part->photo) && (strlen($Part->photo) > 0) ) {
	$str_file_path = $global_photo_directory_rel.$Part->photo;
} else {
	$str_file_path = "images/no_photo.gif";
}?>
        <img src="<?=$str_file_path?>"  alt="Part Summary" align="top" style="float:inherit; padding-right:0px;"></strong>
      </div>
        <p align="left"><strong>Featured Product:</strong> <a href="part_summary.php?id=<?=$Part->id?>&pl=<?=$product_line_id?>">
            <?=$Part->part_number?>
            </a><br>
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
            <strong>Driveline</strong>:
            <?=$unitList?>
            <br>
            <?
	} elseif ($product_line_id == 7) {
		?>
            <strong>Allison</strong>:
            <?=$unitList?>
            <br>
            <?
	} elseif ($product_line_id == 9) {
		?>
            <strong>Power Train Savers&reg;</strong><br>
            <?
	} else {
		?>
            <strong>Make:</strong>
            <?=$make_name?>
            <br>
            <strong>Unit:</strong>
            <?=$unitList?>
            <br>
            <?
	}
}
?>
            <!-- description1 -->
            <?=cp1252_to_utf8($Part->description)?>
            <br>
            <!-- description2 -->
            <?=cp1252_to_utf8($Part->notes)?>
            <br>
        </td>
    </tr>
  </table>
  
  


 

<div id="footer" align="center"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "torque_converter.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>