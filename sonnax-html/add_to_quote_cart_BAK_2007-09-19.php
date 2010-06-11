<?
require_once("includes/classes/clsOrderQuote.php");
require_once("includes/classes/clsCartQuote.php");
require_once("includes/classes/clsPart.php");

if (is_numeric($_GET['pl'])) {
	setcookie('pl',$_GET['pl]']);
}

$cart = new CartQuote($_GET);
header("Location: order_form.php")
?>