<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "includes/classes/clsDataConn.php";
require_once "includes/generic_functions.php";

$session_id = $_GET["session_id"];
$pl = $_GET["pl"];
if ($pl == "10" || $pl == 10) {
	$pl = 10;
} elseif ($pl == "7" || $pl == 7) {
	$pl = 7;
} elseif ($pl == "3" || $pl == 3) {
	$pl = 3;
} else {
	$pl = 2;
}

$arr_data = getSpeedOrderItems($session_id);
$int_items = count($arr_data["speed_order_temp.part_number"])-1;
//echo "items _".$int_items."_<BR>\n";
//echo "session_id _".$session_id."_<BR>\n";
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
<title>Sonnax - Torque Converter and High Performance Speed Order Correction</title>
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
<div id="header_cart_tc"><div class="header" style="margin-left:60px;"><h3>Torque Converter and<br>High Performance Converter<br>Speed Order Correction</h3></div></div>
<?php require "nav.txt";?>

<div class="content">
<p>Problems have been found. Your items have not yet been added to the shopping cart.</p>
<p>Please correct the red boxed part number selections below and try again.</p>
<div class="cleaner"></div>

<form name="order" id="order" method="get" action="speed_order_exe.php">
	<select name="pl" id="pl" TABINDEX="1">
	<?
	if ($pl == 10) {
		$hptc_selected = " SELECTED";
		$product_line_name = "High Performance Torque Converter";
	} elseif ($pl == 7) {
		$allison_selected = " SELECTED";
		$product_line_name = "Allison&reg;";
	} elseif ($pl == 3) {
		$ts_selected = " SELECTED";
		$product_line_name = "Transmission Specialties&reg;";
	} else {
		$product_line_name = "Torque Converter";
	}?>
	<option value="2">Torque Converter</option>
	<option value="10"<?=$hptc_selected?>>High Performance Torque Converter</option>
	<option value="3"<?=$ts_selected?>>Transmission Specialties&reg;</option>
	<option value="7"<?=$allison_selected?>>Allison&reg;</option>
	</select>
	<div class="clnr"></div>
	<div class="form">
	
	<div id='scroll' style="border:none;">

<!-- START OF TITLE ROW -->
	<div style="border:none;">
			<div class='long1' style='font-weight:bold;text-align:left;'>Part Number</div>
			<div class='short' style='font-weight:bold;text-align:left;'>QTY</div>
			<div class='long1' style='font-weight:bold;text-align:left;'>Item</div>
			<div class='long2' style='font-weight:bold;text-align:left;'>Description</div>
			<div class='line' style="border:none;"></div>
	</div>
<!-- END OF TITLE ROW -->

<!-- BEGIN PART 1 ROW -->
	<?
	for($x=0;$x<=$int_items;$x++){
		if ( isValidPart($arr_data["speed_order_temp.part_number"][$x],$pl) == false || isValidQty($arr_data["speed_order_temp.qty"][$x]) == false ) {
			// invalid parts?>
			<div style="border:4px solid red;padding:4px 0 4px 0;margin:4px;">
			<? $arr_part_data = getPartData($arr_data["speed_order_temp.part_number"][$x],$pl);?>
			<div class='long1'><input type="text" name="part<?=$x?>" class="field" style="width:140px;" value="" TABINDEX="<?=(($x*2)+2)?>"></div>
			<div class='short'><input type="text" name="qty<?=$x?>" class="field" style="width:50px;" value="" TABINDEX="<?=(($x*2)+2)?>"></div>
			<div class='long1' style="text-align:left;"></div>
			<? if ( isValidPart($arr_data["speed_order_temp.part_number"][$x],$pl) == false ) {?>
			<div class='long2' style="vertical-align: middle;color:red;font-weight:bold;">Part number <strong><?=$arr_data["speed_order_temp.part_number"][$x]?></strong> could not be found in <strong><?=$product_line_name?></strong>.</div>
			<? } elseif ( isValidQty($arr_data["speed_order_temp.qty"][$x]) == false ) {?>
			<div class='long2' style="vertical-align: middle;color:red;font-weight:bold;">Invalid quantity for part number <strong><?=$arr_data["speed_order_temp.part_number"][$x]?></strong>.</div>
			<? }?>
			<div class='line' style="border:none;"></div>
			<div class="clnr"></div>
			</div>
		<? } else {
			// valid parts?>
			<div style="border:none;padding:4px 0 4px 0px;margin:4px;">
			<!--<div style="border:4px solid green;padding:4px 0 4px 0;margin:4px;">-->
			<? $arr_part_data = getPartData($arr_data["speed_order_temp.part_number"][$x],$pl);?>
			<div class='long1'><input type="text" name="part<?=$x?>" class="field" style="width:140px;" value="<?=$arr_data["speed_order_temp.part_number"][$x]?>" TABINDEX="<?=(($x*2)+2)?>"></div>
			<div class='short'><input type="text" name="qty<?=$x?>" class="field" style="width:50px;" value="<?=$arr_data["speed_order_temp.qty"][$x]?>" TABINDEX="<?=(($x*2)+2)?>"></div>
			<div class='long1' style="text-align:left;"><?=$arr_part_data["parts.item"][0]?></div>
			<div class='long2'><?=$arr_part_data["parts.description"][0]?></div>
			<div class='line' style="border:none;"></div>
			<div class="clnr"></div>
			</div>
		<? }?>
	<? }?>
<!-- END PART 1 ROW -->

		</div>

	
	</div>

	<!--<input type='submit' name='add_to_order' value='VIEW CART' class='submit' style='margin-left:550px;width:90px;' TABINDEX="22">&nbsp;&nbsp;--><input type='submit' name='view_cart' value='ADD TO CART' class='submit' style='margin-left:550px;width:106px;' TABINDEX='23'>
</form>
	
</div>





<div class="cleaner"></div>

<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
</body>
</html>
