<?
require_once("includes/classes/clsOrderQuote.php");

$order = new OrderQuote(1);
$order->sendOrderEmail();
header("Location: thanks.php");
exit(0);
?>