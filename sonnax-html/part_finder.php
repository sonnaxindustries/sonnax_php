<?
header( 'Content-Type: text/html;charset=UTF-8' );
require_once("includes/classes/clsPartFinder.php");
require_once("includes/classes/clsMakes.php");
require_once("includes/classes/clsUnits.php");
require_once("includes/classes/clsUnitsBrief.php");
require_once("includes/classes/clsPart.php");
require_once("includes/classes/clsProductLine.php");
require_once("includes/generic_functions.php");

// Validate the Product Line befor instantiating the PartFinder class
switch ($_GET['pl']) {
	case 1://HPTS
	    // Valid
		break;
	case 2://TC
		// Valid
		break;
	case 3://TS
		// Valid
		break;
	case 7://Allison
		// Valid
		break;
	case 8://Ring Gears
		// Valid
		break;
	case 9://PTS
        // Product line removed (arbitrarily switch the request to TS instead)
        $_GET['pl'] = '3';
		break;
	case 10://HPTC
	    // Product line merged with TC
		$_GET['pl'] = '2';
		break;
	case 11://Driveline
		// Valid
		break;
	case 12://SC
		// Product line merged with TS
		$_GET['pl'] = '3';
		break;
	case 13://SF
		// Product line merged with TS
		$_GET['pl'] = '3';
		break;
	case 14://TT
		// Product line merged with TS
		$_GET['pl'] = '3';
		break;
	default:?>
		Invalid Product Line<BR>
		<?
		break;
}

$part_finder 		= new PartFinder($_GET);
$product_lines 		= new ProductLines();
$makes 				= new Makes($part_finder->product_line);
$unitsBrief			= new UnitsBrief($part_finder->product_line,$part_finder->make_id);
$product_line_obj 	= new ProductLine($part_finder->product_line);

if ($_GET["new_only"] == "true") {
	$title_type = "New Products";
	$google_new = "NewOnly";
} else {
	$title_type = "Part Finder";
	$google_new = "All";
}
//echo "oem_pn: _".$_GET["oem_pn"]."<BR>\n";

$make_name = $makes->getMakeName($_GET["make"]);
$unit_name = getUnitName($_GET["unit"]);

if (strlen($make_name)>0) {
	$title_addon .= " :: " . $make_name;
}
if (strlen($unit_name)>0 && $unit_name != -1) {
	$title_addon .= " :: " . $unit_name;
}
if (strlen($_GET["pn"])>0) {
	$title_addon .= " :: " . $_GET["pn"];
}
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

<title>Sonnax Transmission, Torque Converter, Performance, Driveline Parts :: <?=$product_line_obj->name?><?=$title_addon?></title>
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
<Script language="JavaScript">
function goThere(loc) {
	window.location.href=loc;
}

function reloadPage() {
	int_make = 	document.form_make_unit.make.value;
	int_pl = 	document.form_make_unit.pl.value;
	int_unit = 	document.form_make_unit.unit.value;
	
	strb_show_only_tt = 	document.form_make_unit.show_only_tt.checked;
	strb_show_only_sc = 	document.form_make_unit.show_only_sc.checked;
	
	window.location.href= "part_finder.php?pl="+int_pl+"&make="+int_make+"&unit="+int_unit+"&show_only_tt="+strb_show_only_tt+"&show_only_sc="+strb_show_only_sc;
	//alert(int_make);
}

function reloadPageAllisonUnit() {
	int_pl = 	document.form_unit_id.product_line.value;
	int_unit = 	document.form_unit_id.unit.value;
	window.location.href= "part_finder.php?pl="+int_pl+"&unit="+int_unit;
}

function reloadPageByMakeSelect() {
	int_make = 	document.form_make_unit.make.value;
	int_pl = 	document.form_make_unit.pl.value;
	strb_show_only_tt = 	document.form_make_unit.show_only_tt.checked;
	strb_show_only_sc = 	document.form_make_unit.show_only_sc.checked;
	window.location.href= "part_finder.php?pl="+int_pl+"&make="+int_make+"&show_only_tt="+strb_show_only_tt+"&show_only_sc="+strb_show_only_sc;
}

function reloadPageDrivelineSeries() {
	int_series 	= 	document.form_driveline_series.driveline_series.value;
	int_pl 		= 	document.form_driveline_series.pl.value;
	window.location.href= "part_finder.php?pl="+int_pl+"&driveline_series="+int_series;
}

function reloadPageRingGearTeeth() {
	int_no_of_teeth = 	document.form_no_of_teeth.no_of_teeth.value;
	int_pl 			= 	document.form_no_of_teeth.pl.value;
	
	window.location.href= "part_finder.php?pl="+int_pl+"&no_of_teeth="+int_no_of_teeth;	
}

function reloadPageDrivelineTubeDiameter() {
	int_tube = 	document.form_tube_diameter.tube_diameter.value;
	int_pl = 	document.form_tube_diameter.pl.value;
	window.location.href= "part_finder.php?pl="+int_pl+"&tube_diameter="+int_tube;
}
</SCRIPT>
</head>
<body>
<div id="container">
	<div id="header_gen"><div class="header"><h3>
	<?
	if ($product_line_obj->name == "High Performance Torque Converter") {
		echo "High Performance<BR>Torque Converter";
	} else {
		echo $product_line_obj->name;
	}
	?>
	<br><?=$title_type?></h3></div></div>
	<?php require "nav.txt";?> 
	<div id="main">
		<div class="content">
			<div class="cleaner"></div>
			<div id="search">
			<?
			//include the search form
			switch ($part_finder->product_line) {
				case 1://HPTS
					require_once "includes/part_finder/search_ts.php";
					break;
				case 2://TC
					require_once "includes/part_finder/search_ts.php";
					break;
				case 3://TS
					require_once "includes/part_finder/search_ts.php";
					break;
				case 7://Allison
					require_once "includes/part_finder/search_7_allison.php";
					break;
				case 8://Ring Gears
					require_once "includes/part_finder/search_8_ringgear.php";
					break;
				//case 9://PTS
				//	require_once "includes/part_finder/search_9_pts.php";
				//	break;
				case 10://HPTC
					require_once "includes/part_finder/search_ts.php";
					break;
				case 11://Driveline
					require_once "includes/part_finder/search_11_driveline.php";
					break;
				case 12://SC
					require_once "includes/part_finder/search_ts.php";
					break;
				case 13://SF
					require_once "includes/part_finder/search_ts.php";
					break;
				case 14://TT
					require_once "includes/part_finder/search_ts.php";
					break;
				default:?>
					Invalid Product Line<BR>
					<?
					break;
			}?>
			</div><!-- id=search -->
		
			<div class="cleaner"></div>
			<?
			//include the file that produces the search results
			switch ($part_finder->product_line) {
				case 1://HPTS
					require_once "includes/part_finder/results_1_hpts.php";
					break;
				case 2://TC
					require_once "includes/part_finder/results_2_tc.php";
					break;
				case 3://TS
					require_once "includes/part_finder/results_ts.php";
					break;
				case 7://Allison
					//echo "please_please<BR>\n";
					require_once "includes/part_finder/results_7_allison.php";
					break;
				case 8://Ring Gears
					require_once "includes/part_finder/results_8_ringgear.php";
					break;
				case 9://PTS
					require_once "includes/part_finder/results_9_pts.php";
					break;
				case 10://HPTC
					require_once "includes/part_finder/results_10_hptc.php";
					break;
				case 11://Driveline
					require_once "includes/part_finder/results_11_driveline.php";
					break;
				case 12://SC
					require_once "includes/part_finder/results_ts.php";
					break;
				case 13://SF
					require_once "includes/part_finder/results_ts.php";
					break;
				case 14://TT
					require_once "includes/part_finder/results_ts.php";
					break;
				default:
					echo "Invalid Product Line<BR>\n";
					break;
			}
			?>			
			<div class="cleaner"></div>
			<?if ($part_finder->product_line == 3 || $part_finder->product_line == 12 || $part_finder->product_line == 13 || $part_finder->product_line == 14) {?>
			<form action="distributor.php" name="" id="form_distributor" method="get">
				<input type='submit' name='distributor_submit' value='FIND A DISTRIBUTOR' class='submit' style='margin-left:350px;width:150px;'>
			</form>
			<div class="cleaner"></div>
			<?}?>
			
		</div><!-- id=content -->
	</div><!-- id=main -->
	<div id="footer"><?php include "footer.txt";?></div>
</div><!-- id=container -->
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
//$virtual_page = parts_finder.php,product_line,make,unit,part_number,new 
$virtual_page = "part_finder.php|".$product_line_obj->name."|".$make_name/*$part_finder->make_id*/."|".$unit_name/*$Part->unit*/."|".$_GET["pn"]."|".$google_new;
$virtual_page = str_replace(",","",$virtual_page);
$virtual_page = str_replace("|",",",$virtual_page);
include_once "includes/analyticstracking.php";
?>
</body>
</html>