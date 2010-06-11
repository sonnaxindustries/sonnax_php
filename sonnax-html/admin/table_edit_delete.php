<?
error_reporting (E_ALL ^ E_NOTICE);
require "../includes/classes/clsDataConn.php";
require "../includes/classes/clsAdminLogin.php";

/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
require_once "includes/generic_functions.php";

*/

//$message = $_GET["message"];
$login = new Login();
$logged_in = $login->validate();
if (! $logged_in) {
	header ("Location: index.php");
	exit(0);
}
	
//get the input
	$strRedirect = $_GET["rdir"];
		if (strlen($strRedirect) <= 0) {
			$strRedirect = $_SERVER["HTTP_REFERER"]; //$REQUEST_URI; //getenv("HTTP_REFERER"); //ASP equiv Request.ServerVariables("HTTP_REFERER");
		}
		
	$intRecordToDeleteID = $_GET["guid"];
	$strIDField = $_GET["id_field"];
	$strTableName = $_GET["t"];

	
//issue the delete query
	$temp = f_DeleteRecord($strTableName,$strIDField,$intRecordToDeleteID);

	
//normal get redirect
	//echo $strRedirect . "<BR>";
	header("Location: " . $strRedirect);

	
function f_DeleteRecord($strTableName,$strIDField,$intRecordToDeleteID) {
	$sqlTemp = "" .
		"DELETE FROM " .
			$strTableName . " " .
		"WHERE " .
			$strIDField . " = " . $intRecordToDeleteID . ";";
	//echo $sqlTemp . "<BR>";

	$result = mysql_query ($sqlTemp);
    	//or die ("Query Failed (table_edit_delete.php approx ln:180)");
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}
}
?>



