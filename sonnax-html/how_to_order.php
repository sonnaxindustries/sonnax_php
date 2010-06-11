<?
header( 'Content-Type: text/html;charset=UTF-8' );
require_once("includes/classes/clsPartFinder.php");
require_once("includes/classes/clsMakes.php");
require_once("includes/classes/clsUnits.php");
require_once("includes/classes/clsUnitsBrief.php");
require_once("includes/classes/clsPart.php");
require_once("includes/classes/clsProductLine.php");
require_once("includes/generic_functions.php");


$part_finder 		= new PartFinder($_GET);
$product_lines 		= new ProductLines();
//$product_line_obj 	= new ProductLine($part_finder->product_line);

//echo "oem_pn: _".$_GET["oem_pn"]."<BR>\n";
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
<title>Sonnax - How to Order</title>
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
<div id="header_gen"><div class="header"></div></div>
<?php require "nav.txt";?>
<div id="main">

<div class="content">
  <h3>How to Order</h3>
  <h3>&nbsp;</h3>
  <h3>Contact Sonnax directly if the information below does not answer your questions:</h3>
  <p>Call us: (800) 843-2600 or (802) 463-9722, Monday through Friday, 8:30 am - 5:00 pm ET<br><br>
Email us: <a href="mailto:info@sonnax.com">Info@sonnax.com</a> or <a href="mailto:InternationalSalesTeam@sonnax.com">InternationalSalesTeam@sonnax.com</a> for international customers</p>
<br>
<h3>Ordering Options for Sonnax Product Lines: </h3>
<p><strong>Transmission</strong><strong> Specialties®</strong><strong> products:&nbsp; </strong>Contact a <strong>Sonnax Transmission Specialties<strong>®</strong> Distributor.</strong> Authorized customers can place orders using the <u><a href="speed_order.php">Speed Order</a></u> form and selecting <strong>Transmission Specialties</strong><strong>® from the drop-down menu.</strong></p>
<form name='product_line_search' id='product_line_search' method='get' action='part_finder.php' class='form'>
  <div class='label'></div>
	</form>

<form name='trans_spec_dist' id='trans_spec_dist' method='GET' action='distributor.php' class='form'>
  <div class='label'><strong>Locate a Transmission Specialties&reg; Distributor:</strong></div>
	<select name="country" id="country" class="dropdown">
		<?
		//$country = $_GET["country"];
		//if (strlen($country) < 1) {
			$country = "USA";
		//}
		
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
	<input type="submit" name="go" value="GO" class="submit" style="width:34px;">
</form>


<p></p>

<p><strong>Torque Converter and High Performance Torque Converter products:</strong> Authorized customers can place an order using the online <br>
  <a href="part_finder.php?pl=2">Torque Converter Catalog</a> or <a href="speed_order.php">Speed Order</a> form. New converter parts buyers: Contact Sonnax for account requirements.</p>
<p><strong>High Performance Transmission Products:</strong> New High Performance Transmission parts buyers can contact a <a href="hp-distributors.html">High Performance Transmission Distrbutor</a> or contact Sonnax for account requirements.</p>
<p> <strong>Allison® Transmission Replacement Products:</strong> Authorized customers can place an order using the <a href="speed_order.php">Speed Order</a> form and selecting Allison from the drop down menu. New Allison parts buyers: Contact Sonnax for account requirements.  </p>
<p><strong>Harley Davidson® Replacement Products:</strong> to contact a Distributor of Sonnax Harley Davidson®  Replacement Products, <a href="harley_davidson_dist.php">click here</a>.  </p>
<p><strong>Ring Gear Products: </strong>For quotes and other information, <a href="mailto:webrg@sonnax.com">click here</a>.</p>
<p><strong>Power Train Savers® and Driveline products:</strong>  For quotes and other information, <a href="mailto:info@sonnax.com">click here</a>.</p>
<h4><a href="international_shipping.html">Payment and shipping options for international customers.</a></h4>

</div>
<div class="clear"></div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "how_to_order.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>