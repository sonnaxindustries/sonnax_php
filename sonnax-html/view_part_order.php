<?
require_once "includes/classes/clsOrderRetail.php";
require_once "includes/classes/clsCartRetail.php";
require_once "includes/classes/clsPart.php";
require_once "includes/settings.php";


$cart = new CartRetail($_GET);
$quantity = $cart->order->orderQuantity();
$total = $cart->order->orderTotal();

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
<title>Sonnax - Your Order</title>
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
<div id="header_hp_trans"><div class="header"><h3>View Cart<br>High Performance<br>Transmission</h3></div></div>
<?php require "nav.txt";?>
<div id="main">

<div class="content">
    <h4>Free UPS Ground shipping on orders over $250 (continental US only)</h4> 
    <div class="cleaner"></div>
	<form name='torque_converter_qty'  method='get' action='<?=$global_site_url?>/view_part_order.php'>
		<div id='scroll'>
<!-- START OF TITLE ROW -->
			<div class='med' style='font-weight:bold;'>Part Number</div>
			<div class='long1' style='font-weight:bold;width:240px;'>Description</div>
			<div class='long1' style='font-weight:bold;width:200px;'><!-- Description 2 --></div>
			<div class='short' style='font-weight:bold;'>Price</div>
			<div class='shortest' style='font-weight:bold;'>QTY</div>
            <div class='short' style='font-weight:bold;'>Delete</div>
			<div class="line"></div>
<!-- END OF TITLE ROW -->
<!-- REGULAR BAR -->	

<?
while ($part = $cart->order->order_stack->removePart()) {
?>
	<div class='med'><a href='part_summary.php?id=<?=$part->id?>&pl=<?=$part->product_line?>'><?=$part->part_number?></a></div>	
	<div class='long1' style='width:240px;'><?=$part->description?></div>
	<div class='long1' style="width:200px;"><?=$part->notes?></div>
	<div class='short'>$<?=number_format($part->price,2)?></div>
	<div class='shortest'><input type='text' name='<?=$part->shopping_cart_id?>' class='field' value="<?=$part->shopping_cart_quantity?>"></div>
    <div class='short'><a href='view_part_order.php?delete=<?=$part->shopping_cart_id?>'><img src="images/b_drop.png"></a></div>
	<div class='line'></div>
<?
}

$buywired_cart = new CartRetail($_GET);
?>

		</div>
		<div class="clear"></div>
		<div class="cleaner"></div>
		<input type='submit' name='continue_shopping' value='CONTINUE SHOPPING' class='submit' style='margin-left:530px;width:150px;'>&nbsp;&nbsp;<input type='submit' name='update_order' value='UPDATE' class='submit' style='width:65px;'>&nbsp;&nbsp;
		</form>
		<div class="cleaner"></div>
		<form method=post action="https://www.vermontsecure.com/cart.asp"> <? // action will be link to buywired ?>
		<input type='hidden' name='cID' value='54'>
		<input type='hidden' name='AddItem' value='1'>
		<?
		
		while ($part = $buywired_cart->order->order_stack->removePart()) {
			$product_name = $part->description;
			if (strlen($part->notes) > 0) {
				$product_name .= " - " . $part->notes;
			}
			$product_name = removeQuotes($product_name);
		?>
			<input type='hidden' name='Qty' value='<?=str_replace(",","",$part->shopping_cart_quantity)?>'>
			<input type='hidden' name='Sku' value='<?=str_replace(",","",$part->part_number)?>'>
			<input type='hidden' name='ProductName' value='<?=str_replace(",","",$product_name)?>'>
			<input type='hidden' name='PriceEach' value='<?=str_replace(",","",$part->price)?>'>
			<input type='hidden' name='Weight' value='<?=str_replace(",","",$part->weight/*$part->weight NEEDS TO BE ADDED TO clsPart.php*/)?>'>
		<?
		}
		
		?>
		
		<input type='submit' value='BUY NOW' class='submit' style='margin-left:683px;width:70px;'>
		</form>
	<div class="cleaner"></div>
	<p style="margin-left:530px;">You have <?=$quantity?> items totalling <strong>$<?=number_format($total,2)?></strong></p>
	<div class="cleaner"></div>
</div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
</body>
</html>
<?
function removeQuotes($product_name) {
	$product_name = str_replace('"',"",$product_name);
	$product_name = str_replace("'","",$product_name);
	return $product_name;
}
?>