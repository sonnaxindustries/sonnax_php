<?
require_once "includes/classes/clsOrderRetail.php";
require_once "includes/classes/clsCartRetail.php";
require_once "includes/classes/clsPart.php";
require_once "includes/settings.php";


$cart = new CartRetail($_GET);
header("Location: view_part_order.php")
?>