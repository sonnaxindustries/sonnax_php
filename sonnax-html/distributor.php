<?PHP

require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
require_once "includes/generic_functions.php";

$product_line_id = $_GET["pl"];
if ( ! is_numeric($product_line_id) ) {
	$product_line_id = 3;
}

$order_by = $_GET["order_by"];

/*
$location = $_GET["location"];
if (strlen($location) < 1) {
	$location = "USA";
}
list($country, $state) = explode("~", $location);*/

$country = $_GET["country"];
if (strlen($country) < 1) {
	$country = "USA";
}

$ProductLine = new ProductLine($product_line_id);

$arrTsDisributors = getTsDisributors($country,$state,$order_by);

$int_num_distributors = count($arrTsDisributors["ts_distributors.id"])-1;
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
<title>Sonnax - <?=$ProductLine->name?> - Distributors</title>
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
</head>
<body>
<div id="container">
<div id="header_trans"><div class="header"><h3>
<?
if ($ProductLine->name == "Transmission Specialties&reg;") {
	echo "Transmission<BR>Specialties&reg;";
} elseif ($ProductLine->name == "High Performance Torque Converter") {
	echo "High Performance<BR>Torque Converter";
} elseif ($ProductLine->name == "High Performance Transmission") {
	echo "High Performance<BR>Transmission";
} else {
	echo $ProductLine->name;
}
?>
<br>Distributors</h3></div></div>
<?php require "nav.txt";?>
<div id="main">
<div class="content">
	<div class="cleaner"></div>
	<form name='trans_spec_dist' id='trans_spec_dist' method='GET' action='distributor.php' class='form'>
			<div class='label'>Locate a <?=$ProductLine->name?> Distributor:</div>
			<select name="country" id="country" class="dropdown">
				<?
				$arrLocations = getTsDisributorCountries();
				$int_num_locations = count($arrLocations["ts_distributors.country"])-1;//zero based
				
				for ($x=0;$x<=$int_num_locations;$x++) {		
					if ($country == $arrLocations["ts_distributors.country"][$x]) {
						$str_selected = " SELECTED";
					} else {
						$str_selected = "";
					}
					echo "<option value=\"".$arrLocations["ts_distributors.country"][$x]."\"".$str_selected. ">" . $arrLocations["ts_distributors.country"][$x] . "</option>\n";
				}
				?>
			</select>&nbsp;&nbsp;
			<input type="submit" name="go" value="GO" class="submit">
		</form>
		
		
	<div class="cleaner"></div>
		<div id='scroll'>

			<!-- START OF TITLE ROW -->
			<div class='long1' style='font-weight:bold;width:220px;'>Name</div>
			<div class='med' style='font-weight:bold;'><a href="distributor.php?pl=<?=$product_line_id?>&country=<?=$country?>&order_by=city">City</a></div>
			<div class='short' style='font-weight:bold;'><a href="distributor.php?pl=<?=$product_line_id?>&country=<?=$country?>&order_by=state">State</a></div>
			<div class='med' style='font-weight:bold;width:150px;'>Telephone</div>
			<div class='long' style='font-weight:bold;'>Company URL</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->

			<?for ($x=0;$x<=$int_num_distributors;$x++) {?>
			<div class='long1' style="width:220px;"><?=htmlentities($arrTsDisributors["ts_distributors.name"][$x])?></div>
			<div class='med'><?=htmlentities($arrTsDisributors["ts_distributors.city"][$x])?></div> 				
			<div class='short'><?=htmlentities($arrTsDisributors["ts_distributors.state"][$x])?></div>
			<div class='med' style="width:150px;"><?=htmlentities($arrTsDisributors["ts_distributors.phone"][$x])?></div>
			<?
			
			if (substr($arrTsDisributors["ts_distributors.url"][$x],0,7) == "http://") {
				$strHttp = "";
			} else {
				$strHttp = "http://";
			}
			?>
			<div class='long'><a href="<?=$strHttp?><?=$arrTsDisributors["ts_distributors.url"][$x]?>"><?=htmlentities($arrTsDisributors["ts_distributors.url"][$x])?></a></div>
			<div class="line"></div>
			<?}?>

		</div>	
	<div class="clear"></div>
<p style="padding-top:0;">*Stocking distributors with multiple locations. Please call for more information.</p>
<h4 style="text-align:center;"><a href="part_finder.php?pl=<?=$product_line_id?>"><?=$ProductLine->name?> Part Finder</a></h4>
<div class="cleaner"></div>
</div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "distributor.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>