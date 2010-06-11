<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
require_once "../includes/generic_functions.php";
/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
*/
require "includes/inc_admin_validate.php";

$action = $_GET["action"];
switch ($action) {
	case "remove":
		removeTitleFromSubcategory($_GET['assignment_id']);
		break;
	case "add":
		addTitleToSubcategory($_GET['subcategory_id'],$_GET['title_id']);
		break;
	default:
		//do nothing
		break;
}


if (strlen($_GET['rd']) > 0) {
	header("Location: ".$_GET['rd']);
	exit(0);
} else {
	header("Location: title_assignments.php");
	exit(0);
}
?>

