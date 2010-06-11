<?
$country = $_GET["country"];
if (strlen($country) > 0) {
	header("Location: distributor.php?pl=3&country=".$country);
} else {
	header("Location: distributor.php?pl=3");
}
?>