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

.Nav-header {
	font-size: 11pt;
	font-weight: bold;
}
.catalogpartfinder {font-size: 10.5pt}
-->
</style>
</head>
<body>
<div id="container">
	<div id="header_hp_trans"><div class="header">
	</div></div>
	<?php require "nav.txt";?>
	
	
		<table width="761" height="288" border="0" align="center" cellpadding="5" cellspacing="2">
          <tr>
            <td width="409" height="284" align="left" valign="top" scope="col">
              <p class="opening-paragraph">Sonnax High Performance Transmission parts include innovative solutions that perform under the toughest challenges and an extensive line of Powerglide parts. For all out racing, Sonnax Powerglide parts range from drums, pistons and gear sets to hard-to-find linkage items. Larger boost valves and servos, “shift-in-a-box” products, and line-to-lube pressure regulator valves typify the exceptional Sonnax products that help hardworking, daily-use transmission as well as race units perform better and last longer. </p>
              <p align="left" class="Exploded-view-name"><span class="verticalnavbardash"><span class="catalogpartfinder"><a href="http://www.sonnax.com/part_finder.php?pl=1" class="verticalnavbardash">Part and Application Finder</a></span><br>
                <a href="http://www.sonnax.com/part_finder.php?pl=1&new_only=true">New Parts</a><br>
                </strong><strong><a href="http://www.sonnax.com/hp-distributors.html">Distributors</a><br>
                <a href="http://www.sonnax.com/termsandconditions.html">Email Sign Up<br>
              </a><a href="http://www.sonnax.com/contact_us.php">Contact Us</a></strong> </span></p>
            </td>
            <td width="326" valign="top" scope="col"><p>
              <?php
		if (file_exists($global_photo_directory_abs.$Part->photo) && (strlen($Part->photo) > 0) ) {
			$str_file_path = $global_photo_directory_rel.$Part->photo;
		} else {
			$str_file_path = "images/no_photo.gif";
		}?>
              <img src="<?=$str_file_path?>"  alt="Part Summary" align="top" style="float:inherit; padding-right:0px;"></p>
              <p class="left_content">
                <?php if (is_object($Part)) {?>
                <br />
                <span class="form"><strong>Featured Product:</strong> <a href="part_summary.php?id=<?=$Part->id?>&pl=<?=$product_line_id?>">
                <?=$Part->part_number?>
                </a><br>
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
                <strong>Driveline</strong>:
                <?=$unitList?>
                <br>
                <?php
			} elseif ($product_line_id == 7) {
				?>
                <strong>Allison</strong>:
                <?=$unitList?>
                <br>
                <?php
			} elseif ($product_line_id == 9) {
				?>
                <strong>Power Train Savers&reg;</strong><br>
                <?php
			} else {
				?>
                <strong>Make:</strong>
                <?=$make_name?>
                <br>
                <strong>Unit:</strong>
                <?=$unitList?>
                </span><br>
                <?php
			}
		}
		?>
                <!-- description1 -->
                <?=cp1252_to_utf8($Part->description)?>
                <br>
                <!-- description2 -->
                <?=cp1252_to_utf8($Part->notes)?>
                <br>
                <?php }?>
            </p></td>
          </tr>
        </table>
  


<div class="clear"></div>
	<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "trans_spec.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>