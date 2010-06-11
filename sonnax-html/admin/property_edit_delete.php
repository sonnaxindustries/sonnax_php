<?
include 'inc_validate.php';

include "../includes/dataconn.php";
include "../includes/f_OutputErrorNow.php";

//get the input
	$strRedirect = $HTTP_GET_VARS["rdir"];
		if (strlen($strRedirect) <= 0) {
			//$strRedirect = $_SERVER["HTTP_REFERER"]; //$REQUEST_URI; //getenv("HTTP_REFERER"); //ASP equiv Request.ServerVariables("HTTP_REFERER");
		}
		
	$intRecordToDeleteID = $HTTP_GET_VARS["pid"];
	$strIDField = $HTTP_GET_VARS["id_field"];
	$strTableName = $HTTP_GET_VARS["t"];

	
//issue the delete query
	$temp = f_DeleteRecord($strTableName,$strIDField,$intRecordToDeleteID);

	
//S-----Return to specified redirect address
	if (strlen($strRedirect) <= 0) {

		header("Location: property_list.php");

	} else {
		header("Location: " . $strRedirect);
	}
	//E-----Return to specified redirect address

	
function f_DeleteRecord($strTableName,$strIDField,$intRecordToDeleteID) {
	$sqlTemp = "" .
		"DELETE FROM " .
			$strTableName . " " .
		"WHERE " .
			$strIDField . " = " . $intRecordToDeleteID . ";";
	//echo $sqlTemp . "<BR>";

	$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}
}
?>



