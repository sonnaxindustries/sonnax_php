<?
error_reporting (E_ALL ^ E_NOTICE);
require "../includes/classes/clsDataConn.php";
require "../includes/classes/clsAdminLogin.php";
//include "includes/f_OutputErrorNow.php";

/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
require_once "includes/generic_functions.php";

*/

require_once "includes/inc_admin_validate.php";

//$message = $_GET["message"];


//S-----Get the input
	$TableEdit_strTableName = $_POST["TableEdit_strTableName"];
	$TableEdit_intNumColumns = $_POST["TableEdit_intNumColumns"];
	$TableEdit_strID = $_POST["TableEdit_strID"];
	$TableEdit_strIdField = $_POST["TableEdit_strIdField"];
	$TableEdit_strDisplayField = $_POST["TableEdit_strDisplayField"];
	$TableEdit_strReturnFieldNames = $_POST["TableEdit_strReturnFieldNames"];
	$TableEdit_strOrderBy = $_POST["TableEdit_strOrderBy"];
	$TableEdit_strWhere = $_POST["TableEdit_strWhere"];
	//$TableEdit_strNonEditableFields = $_POST["TableEdit_strNonEditableFields"];
	$TableEdit_Redirect = $_POST["TableEdit_Redirect"];

	$strPresetFieldValuePairs = $_POST["strPresetFieldValuePairs"];
	$strLookupField_Names = $_POST["strLookupField_Names"];
	$strLookupField_Tables = $_POST["strLookupField_Tables"];
	$strLookupField_Fields = $_POST["strLookupField_Fields"];
	$strLookupField_OrderBys = $_POST["strLookupField_OrderBys"];
	$strNonEditableFields = $_POST["strNonEditableFields"];


	$strErrorMessage = "";

	for($x = 0;$x <= $TableEdit_intNumColumns;$x++) {
		//set the current field name
			$strFieldName = "field" . $x;
			
		//read the field data
			$strFieldDataTemp_a = $_POST[$strFieldName . "_a"];
			$strFieldDataTemp_b = $_POST[$strFieldName . "_b"];
			$strFieldDataTemp_c = $_POST[$strFieldName . "_c"];
			$strFieldDataTemp_d = $_POST[$strFieldName . "_d"];
			$strFieldDataTemp_e = $_POST[$strFieldName . "_e"];
		
		//store the data in an array
			$arrTableData[$x][0] = trim($strFieldDataTemp_a); //Field Name
			$arrTableData[$x][1] = trim($strFieldDataTemp_b); //Field Data Type
			$arrTableData[$x][2] = trim($strFieldDataTemp_c); //Field Attributes
			$arrTableData[$x][3] = trim($strFieldDataTemp_d); //Actual Data
				//$arrTableData[$x][3] = str_replace("'","\'",$arrTableData[$x][3]);
				
			//this is not needed in PHP because all field types can be enclosed with the apostrophe
			//$arrTableData[$x][4] = trim($strFieldDataTemp_e); //Field Bracket symbol 1("'","", or "#")

		//Validate the input
			switch($arrTableData[$x][1]) {
				case "string": //Text (unicode VarChar) possibly 129,130,200 also
					//echo "string<BR>";
					//Do Nothing; they can put whatever they want in here
					break;
				case "blob": //Memo (unicode LongVarChar) possibly 201 also
					//echo "blob<BR>";
					//Do Nothing; they can put whatever they want in here
					break;
				case "int": //Integer possibly also 2,16,17,18,19,20,21
					//echo "int<BR>";
					
					//remove commas so they dont affect the SQL
						$arrTableData[$x][3] = str_replace(",","",$arrTableData[$x][3]);
						
						
					//if (!is_numeric($arrTableData[$x][3])) {
					//	$strErrorMessage = $strErrorMessage . "<BR>The data supplied for the " . $arrTableData[$x][0] . " field must be an Integer.<BR>";
					//}
						
					if (f_IsThisAnInteger($arrTableData[$x][3]) == false) {
						$arrTableData[$x][3] = "0";
						//$strErrorMessage = $strErrorMessage . "<BR>The data supplied for the " . $arrTableData[$x][0] . " field must be an Integer.<BR>";
					}
					
					if (strlen($arrTableData[$x][3]) < 1) {
						$arrTableData[$x][3] = "0";
					}
					break;
				case "boolean": //Boolean	
					//echo "boolean<BR>";
					if ($arrTableData[$x][3] != "1") {
						$arrTableData[$x][3] = "0";
					}
					break;
				case "date": //Date (possibly also 133,134,135)	
					//echo "date<BR>";
//NEEDS WORK
	//check strtotime
//					if (!is_date($arrTableData[$x][3]) && $arrTableData[$x][3] != "") {
//						$strErrorMessage = $strErrorMessage . "<BR>The data you supplied for the " . $arrTableData[$x][0] . " field does not appear to be a date.<BR>";
//					}
					break;
				case "real": //real
					//echo "real<BR>";
					
					//remove commas so they dont affect the SQL
						$arrTableData[$x][3] = str_replace(",","",$arrTableData[$x][3]);
					
					if (!is_numeric($arrTableData[$x][3])) {
						$arrTableData[$x][3] = "0";
						//$strErrorMessage = $strErrorMessage . "<BR>The data supplied for the " . $arrTableData[$x][0] . " field must be a Real number.<BR>";
					}
					
					if (strlen($arrTableData[$x][3]) < 1) {
						$arrTableData[$x][3] = "0";
					}
					
					break;
				case "skip": //real
					//Do nothing because we know we are skipping this data
					break;
				default: //other (skip) or unknown
					//echo "unknown or other<BR>";
					
						$strErrorMessage = $strErrorMessage . "<BR>The `" . $arrTableData[$x][0] . "` field (#" . $x .") is of an unknown type. VTweb has been notified.<BR>";
						
						$strFrom = "support@vtweb.com";
						$strTo = "terry@vtweb.com";//,chris@vtweb.com
						
						$strHeaders = "From: " . $strFrom . "\r\n";/*.
							"MIME-Version: 1.0\r\n" .
							"Content-type: text/html; charset=iso-8859-1\r\n"; */
						
						$strBodyHeader = "";
						$strBodyFooter = "";
						//$strBodyHeader = "<HTML><BODY BGCOLOR=#FFFFFF>" . $company_name . "<BR>" . date ("Y-m-d H:i:s") . "<BR>Changes made to " . $page_used . ":<BR>\n<TABLE BGCOLOR=#CCCCCC><TR><TD align=center bgcolor=#BBBBBB><B>Field Name</B></TD><TD align=center bgcolor=#BBBBBB><B>New</B></TD><TD align=center bgcolor=#BBBBBB><B>Old</B></TD></TR>";
						//$strBodyFooter = "</TABLE></BODY></HTML>";
						
						$strSubject = "North Real Estate Error";
						$strBodyMain = "The " . $arrTableData[$x][0] . " field is of and Unknown type on property_edit_exe.php in the North Real Estate Project.";
						
						mail($strTo, $strSubject, ($strBodyHeader . $strBodyMain . $strBodyFooter),$strHeaders);
					break;
			}
	}

	//Output any errors
		if ($strErrorMessage != "") {
			f_OutputErrorNow ($strErrorMessage);
		}
	//E-----Get the input
	
	
//DEBUG
//	for ($x = 0;$x <= $TableEdit_intNumColumns;$x++) {
//		echo "arrTableData(" . $x . ",0)=" . $arrTableData[$x][0] . "<BR>";
//		echo "arrTableData(" . $x . ",1)=" . $arrTableData[$x][1] . "<BR>";
//		echo "arrTableData(" . $x . ",2)=" . $arrTableData[$x][2] . "<BR>";
//		echo "arrTableData(" . $x . ",3)=" . $arrTableData[$x][3] . "<BR>";
//		echo "arrTableData(" . $x . ",4)=" . $arrTableData[$x][4] . "<BR><BR>";
//	}
	
	
//S-----Create the SQL for updating or inserting
	
	//Make a version of TableEdit_strIdField without brackets
		$TableEdit_strIdField_CLEAN = str_replace("`","",$TableEdit_strIdField);

		
	if ($TableEdit_strID == "0") { //Insert
		//echo "TableEdit_strIdField_CLEAN='" . $TableEdit_strIdField_CLEAN . "'<BR>";
		
		$sql_select_pairs = "";
		
		//Create the Fields list
			for($x = 0;$x <= $TableEdit_intNumColumns;$x++) {
				//echo "arrTableData[x][0]='" . $arrTableData[$x][0] . "'<BR>";
				
				//skip the "id" field
					if (strtolower($arrTableData[$x][0]) == strtolower($TableEdit_strIdField_CLEAN)) {
						$arrTableData[$x][1] = "skip";
					}
				//skip blank "date" fields
					if ($arrTableData[$x][1] == "date" && strlen($arrTableData[$x][3]) <= 0) {
						$arrTableData[$x][1] = "skip";
					}
				
				//build the field list
					if ($arrTableData[$x][1] != "skip") { //dont include the fields we want to skip
						$sqlTempFields = $sqlTempFields . "`" . $arrTableData[$x][0] . "`,";
						
						if(strlen($sql_select_pairs) > 0){
							$sql_select_pairs .= " AND";
						}
						$sql_select_pairs .= " `" . $arrTableData[$x][0] . "` = ";
					//} else {
					//for debug
					// echo "match<BR>";
					}
	
				//build the Values list
					if ($arrTableData[$x][1] != "skip") { //dont include the fields we want to skip
						$sqlTempValues .= "'" . $arrTableData[$x][3] . "'" . ",";
						//This line was causing PHP to add problematic escape characters to the SQL
						//$sqlTempValues .= $arrTableData[$x][4] . $arrTableData[$x][3] . $arrTableData[$x][4] . ",";
						
						$sql_select_pairs .= "'" . $arrTableData[$x][3] . "'";
					}
			} //x
			
		//remove extra commas from list we just created
			//WE ONLY NEED THIS IF WE ARENT APPENDING THE date_created field BELOW
			$sqlTempFields = substr($sqlTempFields,0,strlen($sqlTempFields)-1);
			$sqlTempValues = substr($sqlTempValues,0,strlen($sqlTempValues)-1);


		//Add the date/time created to the date_created field in the DB
			//$sqlTempFields .= "`date_created`";
			//$sqlTempValues .= "'" . date("YmdHis") . "'";
		
		
		//Assemble the entire SQL statement
			$sqlTemp = "INSERT INTO " . $TableEdit_strTableName . " (" . $sqlTempFields . ") VALUES (" . $sqlTempValues . ");";
		
	} else {//Update

		//Create the Field/Data list
			for($x = 0;$x <= $TableEdit_intNumColumns;$x++) {
				//skip the "id" field
					if (strtolower($arrTableData[$x][0]) == strtolower($TableEdit_strIdField_CLEAN)) {
						$arrTableData[$x][1] = "skip";
					}
					
				//skip blank "date" fields
					if ($arrTableData[$x][1] == "date" && strlen($arrTableData[$x][3]) <= 0) {
						$arrTableData[$x][1] = "skip";
					}
				
				//build the field list	
					if ($arrTableData[$x][1] != "skip") { //dont include the fields we want to skip
						$sqlTempFieldsAndValues .= "`" . $arrTableData[$x][0] . "` = " . "'" . $arrTableData[$x][3] . "'" . ",";
					}
			} //x
			$sqlTempFieldsAndValues = substr($sqlTempFieldsAndValues,0,strlen($sqlTempFieldsAndValues)-1);
			
		//Assumble the entire SQL statement
			$sqlTemp = "UPDATE " . $TableEdit_strTableName . " SET " . $sqlTempFieldsAndValues . " WHERE " . $TableEdit_strIdField . " = " . $TableEdit_strID . ";";
	}
	//E-----Create the SQL for updating or inserting


//S-----Execute the SQL
	//php is adding \ to the ' surrounding our text fields
	//This is weak but its all I can think of to get rid of them
		//$sqlTemp = str_replace("\\'","\'",$sqlTemp);
	//echo "SQL=" . $sqlTemp . "<BR>";

	$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo $sqlTemp . "<BR>";
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
			exit;
		}
	//E-----Execute the SQL
	
	
//S-----Lookup the id of the thing we just inserted
	if ($TableEdit_strID == "0") {
		//AAAAAAAAAARRRRRRRRRGGGGGGGGGGGGGGGGGHHHH!!!!!!!!!! $id_of_item_just_added = mysql_insert_id($link);
		$sqlTemp2 = "" .
			"SELECT " . $TableEdit_strIdField . " " .
			"FROM " . $TableEdit_strTableName . " " .
			"WHERE" . $sql_select_pairs . ";";
		$result2 = mysql_query ($sqlTemp2);
			if(mysql_errno() != 0) {
				echo $sqlTemp2 . "<BR>";
				echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
				exit;
			}
		$intNumRecords = mysql_num_rows($result2);
		while ($row = mysql_fetch_array($result2)) {
			//this rem code would allow us to tell if duplicates exist
			//if($intNumRecords == 1){
				$id_of_item_just_added = $row[0];
			//} else {
			//	$id_of_item_just_added = "non_unique";
			//}
		}
		if($intNumRecords < 1){
			$id_of_item_just_added = "not found";
		}
	}
	//E-----Lookup the id of the thing we just inserted
	
	
//S-----Return to specified redirect address
// Removed because of broken redirects.
	//if (strlen($TableEdit_Redirect) <= 0) {
	if ($TableEdit_strID == "0") { //Insert
		$strLocation = "table_edit_add_thanks.php?id_of_item_just_added=" . urlencode($id_of_item_just_added) . 
			"&TableEdit_strTableName=" . urlencode($TableEdit_strTableName) . 
			"&TableEdit_strIdField=" . urlencode($TableEdit_strIdField) . 
			"&TableEdit_strDisplayField=" . urlencode($TableEdit_strDisplayField) . 
			"&TableEdit_strReturnFieldNames=" . urlencode($TableEdit_strReturnFieldNames) . 
			"&TableEdit_strOrderBy=" . urlencode($TableEdit_strOrderBy) . 
			"&TableEdit_strWhere=" . urlencode($TableEdit_strWhere) .
			"&strPresetFieldValuePairs=" . urlencode($strPresetFieldValuePairs) .
			"&strLookupField_Names=" . urlencode($strLookupField_Names) .
			"&strLookupField_Tables=" . urlencode($strLookupField_Tables) .
			"&strLookupField_Fields=" . urlencode($strLookupField_Fields) .
			"&strLookupField_OrderBys=" . urlencode($strLookupField_OrderBys) .
			"&strNonEditableFields=" . urlencode($strNonEditableFields);
			
		header("Location: $strLocation");
		exit(0);
	} else {
		//header("Location: admin.php");
		
		if (strlen($TableEdit_Redirect) <= 0) {
			$strLocation = "table_contents.php?t=" . urlencode($TableEdit_strTableName) . 
				"&if=" . urlencode($TableEdit_strIdField) . 
				"&df=" . urlencode($TableEdit_strDisplayField) . 
				"&rf=" . urlencode($TableEdit_strReturnFieldNames) . 
				"&ob=" . urlencode($TableEdit_strOrderBy) . 
				"&wh=" . urlencode($TableEdit_strWhere) .
				"&strPresetFieldValuePairs=" . urlencode($strPresetFieldValuePairs) .
				"&strLookupField_Names=" . urlencode($strLookupField_Names) .
				"&strLookupField_Tables=" . urlencode($strLookupField_Tables) .
				"&strLookupField_Fields=" . urlencode($strLookupField_Fields) .
				"&strLookupField_OrderBys=" . urlencode($strLookupField_OrderBys) .
				"&strNonEditableFields=" . urlencode($strNonEditableFields);
		
				//$TableEdit_intNumColumns = $_POST["TableEdit_intNumColumns"];
				//$TableEdit_strID = $_POST["TableEdit_strID"];
	
				//$TableEdit_Redirect = $_POST["TableEdit_Redirect"];
		} else {
			$strLocation = stripslashes($TableEdit_Redirect);
		}
		header("Location: $strLocation");
		exit(0);
	}




		//echo "<BR><BR>No redirect address specified.";
		//exit;
	//} else {
	
		//GET redirect (Normal)
			//echo "Redirect=" . $TableEdit_Redirect . "<BR>";
			//header("Location: " . $TableEdit_Redirect);
			
		//POST redirect using ???
			//???

//	}
	//E-----Return to specified redirect address
	
function f_IsThisAnInteger($input_string) {
	$input_string_intval = intval($input_string);
	return ("$input_string" == "$input_string_intval");
}
?>
