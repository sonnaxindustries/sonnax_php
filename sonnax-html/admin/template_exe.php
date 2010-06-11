<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
/*
require_once "../includes/classes/clsPartFinder.php";
require_once "../includes/classes/clsMakes.php";
require_once "../includes/classes/clsUnits.php";
require_once "../includes/classes/clsUnitsBrief.php";
require_once "../includes/generic_functions.php";

*/

$login = new Login();
$logged_in = $login->validate();
if (! $logged_in) {
	header ("Location: index.php");
	exit(0);
}

$message = $_GET["message"];
$str = $_POST["str"];



header("Location: page.php?pid=$strID");
?>

