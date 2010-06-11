<?
require_once("includes/classes/clsOrderQuote.php");
require_once("includes/classes/clsCartQuote.php");
require_once("includes/classes/clsPart.php");

if (is_numeric($_GET['pl'])) {
	$product_line = $_GET['pl'];
	setcookie('pl',$_GET['pl]']);
} elseif (is_numeric($_COOKIE['pl'])) {
	$product_line = $_COOKIE['pl'];
} else {
	$product_line = 2;
}

$cart = new CartQuote($_GET);
//echo "<pre>";
//var_dump($cart);
//echo "</pre>";

$int_unique_part_counter = -1;
$int_NON_unique_part_counter = -1;

$arr_unique_parts = array();
$arr_NON_unique_parts = array();

$str_NON_unique_parts = "";
$b_non_unique_parts_found = false;
while ($part = $cart->order->order_stack->removePart()) {
	if (!in_array($part->id, $arr_unique_parts)) {
		$int_unique_part_counter++;
		$arr_unique_parts[$int_unique_part_counter] = $part->id;
	} else {
		if (!in_array($part->id, $arr_NON_unique_parts)) {
			$int_NON_unique_part_counter++;
			$arr_NON_unique_parts[$int_NON_unique_part_counter] = $part->id;
			if (strlen($str_NON_unique_parts) > 0) {
				$str_NON_unique_parts .= ", ";
			}
			$str_NON_unique_parts .= $part->part_number;
		}
		$b_non_unique_parts_found = true;
	}
}					
				
$cart = new CartQuote($_GET);//oh the horror

//echo "<pre>";
//var_dump($cart);
//echo "</pre>";
		
header( 'Content-Type: text/html;charset=windows-1252' ); //UTF-8 //windows-1252				
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
<div id="header_cart_tc"><div class="header"></div></div>
<?php require "nav.txt";?>
<div id="main">

<div class="content">
<?
if ($b_non_unique_parts_found == true) {?>
<div class="label" style="vertical-align: middle;color:red;font-weight:bold;">Duplicate entries for the following items have been detected: <?=$str_NON_unique_parts?></div>
<div class='cleaner'></div>
<? }?>

<div id="scroll">
			<div class='med' style='font-weight:bold;'>Part Number</div>
            <div class='med' style='font-weight:bold;'>Item</div>
			<div class='long1' style='font-weight:bold;width:380px;'>Description</div>
			<div class='short' style='font-weight:bold;'>QTY</div>
            <div class='short' style='font-weight:bold;'>Delete</div>
			<div class='line'></div>
<!-- END OF TITLE ROW -->
<!-- REGULAR BAR -->
		<form method=get action='order_form.php'>	
		
<?

while ($part = $cart->order->order_stack->removePart()) {
?>
	<div class='med'><a href='part_summary.php?id=<?=$part->id?>&pl=<?=$part->product_line?>'><?=$part->part_number?></a></div>	
	<div class='med'><?=$part->item?></div>
	<div class='long1' style="width:380px;"><?=$part->description?></div>
	<div class='short'><input type='text' name='<?=$part->shopping_cart_id?>' class='field' value="<?=$part->shopping_cart_quantity?>"></div>
    <div class='short'><a href='order_form.php?delete=<?=$part->shopping_cart_id?>'><img src="images/b_drop.png"></a></div>
	<div class='line'></div>
<?
}
?>
<!--
			<div class='med'><a href='.pdf'>GM-90-3G</a></div>	
			<div class='med'>Impeller Hub</div>
			<div class='long1' style="width:380px;">Process 90&deg;, 1.876' Journal Diameter, 2.625' long</div>
			<div class='short'><input type='text' name='part_qty' class='field' value="12"></div>
            <div class='short'><img src="images/b_drop.png"></div>
			<div class='line'></div>
						
			<div class='med'><a href='.pdf'>GM-90-3G</a></div>
            <div class='med'>Turbine Hub</div>
			<div class='long1' style="width:380px;">30-Tooth Internal Spline, Chrome-moly</div>
			<div class='short'><input type='text' name='part_qty' class='field' value="1"></div>
            <div class='short'><img src="images/b_drop.png"></div>
			<div class='line'></div>
-->	

	<!--	</form> -->
        </div>
        <div class="clear"></div>
		<div class="clear"></div>

        <input type='hidden' name='pl' value='<?=$product_line?>'>
		<div class="cleaner"></div>
		<div class='long1' style="width:780px;text-align:right;">
		<input type='submit' name='continue_shopping' value='CONTINUE CATALOG SHOPPING' class='submit' style='width:200px;'>&nbsp;&nbsp;
		<input type='submit' name='speed_order' value='CONTINUE SPEED ORDERING' class='submit' style='width:200px;'>&nbsp;&nbsp;
		<input type='submit' name='update_order' value='UPDATE' class='submit' style='width:65px;'>
		</div>
        </form>
		<div class="cleaner"></div>
<h3>Please fill out the following information to complete this order:</h3>
<div class="cleaner"></div>
<?
if ($_GET["email_problem"] == "true") {
	echo "<font color=\"#FF0000\">The email address entered appears to be invalid</font>";
}
if ($_GET["missing_info"] == "true") {
	echo "<font color=\"#FF0000\">Required info is missing below.</font>";
}
?>
<form name="order" id="order" method="get" action="order_form_exe.php" class="form" style="padding-left:100px;">
	<div class="labelset">*Name:</div><input type="text" name="name" class="field" style="width:30%;" value="<?=htmlentities($_GET["name"])?>"><div class="clear"></div>
	<div class="labelset">*Company:</div><input type="text" name="company" class="field" style="width:30%;" value="<?=htmlentities($_GET["company"])?>"><div class="clear"></div>
	<div class="labelset">*Zip Code:</div><input type="text" name="zip" class="field" value="<?=htmlentities($_GET["zip"])?>"><div class="clear"></div>
    <div class="labelset">*Email:</div><input type="text" name="email" class="field"  value="<?=htmlentities($_GET["email"])?>"><div class="clear"></div>
	<div class="labelset">P.O. Number:</div><input type="text" name="po_number" class="field" value="<?=htmlentities($_GET["po_number"])?>"><div class="clear"></div>
	<div class="labelset">Shipping Method:</div>
	<select name="shipping_method" id="shipping_method" class="dropdown" style="width:160px;">
		<option value="ups_ground">UPS Ground</option>
		<option value="ups_3day">UPS 3rd Day Select</option>
		<option value="ups_2day">UPS 2nd Day</option>
		<option value="ups_next">UPS Next Day</option>
	</select><div class="clear"></div>

	<p style="text-align:left;"> Please round my order quantities to suit standard packaged quantities<input type=checkbox name="round_quantities" value="round" checked><br>(uncheck box for us to contact you before any adjustments)</p>
	
	  
	  <div class="labelset">Comments, Special Instructions, Additional Parts:</div><textarea name="comments" rows="8" cols="30"><?=htmlentities($_GET["comments"])?></textarea>
	&nbsp;&nbsp;
	<input type="submit" name="send" value="SEND" class="submit" style="width:50px;">
</form>
<div class="clear"></div>
<h6 style="text-align:left;">*Required fields to process order</h6>






</div>
<div class="clear"></div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
</body>
</html>