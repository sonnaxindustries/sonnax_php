<?
error_reporting (E_ALL ^ E_NOTICE);
require "../includes/classes/clsDataConn.php";
require "../includes/classes/clsAdminLogin.php";
include "includes/f_OutputErrorNow.php";
include "includes/f_ReturnSelectBox.php";

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

//S-----Get input-----
	$strTableName = $_GET["t"];
		if (strTableName == "") {
			$strErrorMessage = "Valid Table Name Required";
			f_OutputErrorNow ($strErrorMessage); //terminates page
		}
	$strIdField = $_GET["if"];
		if ($strIdField == "") {
			$strErrorMessage = "ID Field Name Required";
			f_OutputErrorNow ($strErrorMessage); //terminates page
		}
	$strID = $_GET["id"];
		if ($strID == "") {
			$strErrorMessage = "Valid Id Required";
			f_OutputErrorNow ($strErrorMessage); //terminates page
		}
	$strDisplayField = $_GET["df"];
	$strOrderBy = $_GET["ob"];
	
	$strReturnFieldNames = $_GET["rf"];
		if ($strReturnFieldNames == "") {
			$strReturnFieldNames = "*";
		}
		
	$strPresetFieldValuePairs = $_GET["strPresetFieldValuePairs"];
		if ($strPresetFieldValuePairs != "") {
			$arrPresetFieldValuePairs = explode("|", $strPresetFieldValuePairs);
			$intNumPresetFieldValuePairs = count($arrPresetFieldValuePairs);
		} else {
			$intNumPresetFieldValuePairs = -1;
		}
		
		
	$strLookupField_Names = stripslashes($_GET["strLookupField_Names"]);
		if ($strLookupField_Names != "") {
			$arrLookupField_Names = explode("|", $strLookupField_Names);
			$intNumLookupFields = count($arrLookupField_Names)-1;
		}
	$strLookupField_Tables = stripslashes($_GET["strLookupField_Tables"]);
		if ($strLookupField_Tables != "") {
			$arrLookupField_Tables = explode("|", $strLookupField_Tables);
		}
	$strLookupField_Fields = stripslashes($_GET["strLookupField_Fields"]);
		if ($strLookupField_Fields != "") {
			$arrLookupField_Fields = explode("|", $strLookupField_Fields);
		}
	$strLookupField_OrderBys = stripslashes($_GET["strLookupField_OrderBys"]);
		if ($strLookupField_OrderBys != "") {
			$arrLookupField_OrderBys = explode("|", $strLookupField_OrderBys);
		}
		
		
	$strNonEditableFields = stripslashes($_GET["strNonEditableFields"]);
		if ($strNonEditableFields != "") {
			$arrNonEditableFields = explode("|", $strNonEditableFields);
			$intNumNonEditableFields = count($arrNonEditableFields);
		} else {
			$intNumNonEditableFields = -1;
			//$arrNonEditableFields[0];
			//$arrNonEditableFields[0] = "asdijew3838ufoos"; //Not needed but just to make sure we dont match on something accidentally (like blank) 
		}
		
	
	$strRedirect = $_GET["rdir"];
		if (strlen($strRedirect) <= 0) {
			$strRedirect = $_SERVER["HTTP_REFERER"]; //$REQUEST_URI; //getenv("HTTP_REFERER"); //ASP equiv Request.ServerVariables("HTTP_REFERER");
		}
	//E-----Get input-----
	
	
//S-----Get table contents
	//wpull a recordset (even for adding so we can get the field names and types)
	$sqlTemp = "SELECT " . $strReturnFieldNames . " " .
		"FROM " . $strTableName . "";
		if ($strID != "0") {
			$strPageAction = "Edit";
			$sqlTemp = $sqlTemp . " WHERE " . $strIdField . " = " . $strID . " LIMIT 1;";
		} else { //strID = 0
			//This allows us to use this for Add as well as Edit functions
			$strPageAction = "Add to";
			$sqlTemp = $sqlTemp . ";";
		}
	//echo $sqlTemp . "<BR>";
	$result = mysql_query ($sqlTemp);
		//or die ("Query Failed (admin2/table_edit.php approx ln:89)");
		if(mysql_errno() != 0) {
			echo $sqlTemp . "<BR>";
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
			exit;
		}
	$intNumRows = mysql_num_rows($result) - 1; //make zero base
		//echo "intNumRows=" . $intNumRows . "<BR>";
	$intNumColumns = mysql_num_fields($result) - 1; //make zero base
		//echo "intNumColumns=" . $intNumColumns . "<BR>";
		
	//S-----Always Get the column info-----		
		for ($i=0; $i <= $intNumColumns; $i++) {
			$arrTableFieldStructure[$i][0] = mysql_field_name($result, $i);
			$arrTableFieldStructure[$i][1] = mysql_field_type($result, $i);
			$arrTableFieldStructure[$i][2] = mysql_field_len($result, $i);
			$arrTableFieldStructure[$i][3] = mysql_field_flags($result, $i);
			//echo "<BR>name=".$arrTableFieldStructure[$i][0]."<BR>type=".$arrTableFieldStructure[$i][1]."<BR>len=".$arrTableFieldStructure[$i][2]."<BR>flags=".$arrTableFieldStructure[$i][3]."<BR>\n";
		}			
		//E-----Always Get the column info-----
		
			
	//get the data or make sure we dont store the data if we are adding
		if ($strID == "0") { //Adding
			//basically do nothing
			$intNumRows = -1;
		} elseif ($intNumRows > -1) { //Editing
	
			//S-----Get the table data-----
				$arrTableData[0][0] = 0; //Error preventor
				
				$intCounter = -1; //initialize row counter
		
				while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
					$intCounter++; //increment the counter
				
					for($i = 0;$i <= $intNumColumns;$i++){
						$arrTableData[$intCounter][$i] = $row[$i];
						//echo "arrTableData[" . $intCounter . "][" . $i . "]=" . $arrTableData[$intCounter][$i] . "<BR>";
					}
					//echo "<BR>";
				}	
				//E-----Get the table data-----
				
			//test to see if we are adding
			// ??? JUNK code from ASP page probably not needed
			//if ($strID == "0") {
				//Erase any data in the array to prevent errors
				//and allow us to use this as a blank input form for Adding records
				//$arrTableData[0][0] = ""; 
			//}
		} else {
			//Only happens if we are passed an ID and it isnt in the table
			$strErrorMessage = "ID not found.";
			f_OutputErrorNow($strErrorMessage);//terminates page
		}
	//E-----Get table contents
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
<title><?=$strPageAction?>&nbsp;<?=$strTableName?>&nbsp;Table</title>
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
<div id="header_trans"><div class="header"><h3>Admin</h3></div></div>
<?php require "nav_admin.txt";?>
<div id="main">
<div class="content">
<?if ($strTableName != "parts") {?>
<center><a href="table_contents.php?t=<?=rawurlencode($strTableName)?>&if=<?=rawurlencode($strIdField)?>&df=<?=rawurlencode($strDisplayField)?>&rf=<?=rawurlencode($strReturnFieldNames)?>&ob=<?=rawurlencode($strOrderBy)?>">Table Contents</a></center>
<?}?>
<FORM NAME="form1" ACTION="table_edit_exe.php" METHOD="POST">
<input type=hidden name="TableEdit_strTableName" value="<?=htmlentities($strTableName,ENT_COMPAT)?>">
<input type=hidden name="TableEdit_intNumColumns" value="<?=htmlentities($intNumColumns,ENT_COMPAT)?>">
<input type=hidden name="TableEdit_strID" value="<?=htmlentities($strID,ENT_COMPAT)?>">
<input type=hidden name="TableEdit_strIdField" value="<?=htmlentities($strIdField,ENT_COMPAT)?>">
<input type=hidden name="TableEdit_strDisplayField" value="<?=htmlentities($strDisplayField,ENT_COMPAT)?>">
<input type=hidden name="TableEdit_strReturnFieldNames" value="<?=htmlentities($strReturnFieldNames,ENT_COMPAT)?>">
<input type=hidden name="TableEdit_strOrderBy" value="<?=htmlentities($strOrderBy,ENT_COMPAT)?>">
<input type=hidden name="TableEdit_Redirect" value="<?=htmlentities($strRedirect,ENT_COMPAT)?>">
<BR>
<div align="center"><strong><font size="+1"><?=$strPageAction?>&nbsp;<?=$strTableName?> Table</font></strong></div>
<BR>
<table align="center" cellspacing=0 cellpadding=3>
<?for($q = 0;$q <= $intNumColumns;$q++){
	if ($q % 2 == 0) {
		$strBGcolorTemp = "BBBBBB";
	} else {
		$strBGcolorTemp = "EEEEEE";
	}
	
	//Reset some vaules
		$bNonEditable = False;
	
	//Check for preset values
	if ($intNumPresetFieldValuePairs == -1) {
		//This isnt really needed but would allow us to override actual data if we wanted
		//Use normal data
		$strFieldData = $arrTableData[0][$q];
//echo "IF strFieldData=" . $strFieldData . "<BR>";
	} else {
		$strFieldNameLcaseTemp = strtolower($arrTableFieldStructure[$q][0]);
		
		//Check to see if this field gets a Preset value
		for($J = 0;$J <= $intNumPresetFieldValuePairs;$J++){
			$arrTemp = explode("~!~", $arrPresetFieldValuePairs[$J]);
			if (is_array($arrTemp) ) {
				if (strtolower($arrTemp[0]) == $strFieldNameLcaseTemp) {
					//Use the preset value passed via the querystring
					$strFieldData = $arrTemp[1];
						//NON-IMPLEMENTED SYSTEM for passing non editable with the name/value pairs
						//if (strtolower($arrTemp[2]) == "true" || $arrTemp[2] == True) {
						//	$bNonEditable = True;
						//}
					break; //Get out so we dont overwrite the one we just found	
				} else {
					//Use normal data
					$strFieldData = $arrTableData[$q][0];
				}
			} else {
				//Use normal data
				$strFieldData = $arrTableData[$q][0];
			}
		} //J
//echo "ELSE strFieldData=" . $strFieldData . "<BR>";
	}

?>
<tr bgcolor='#<?=$strBGcolorTemp?>'>
	<td width=100 align=right><b><?=$arrTableFieldStructure[$q][0]?></b></td>
	<?
	//Test to see if this is one of the non editiable fields
		$strFieldNameLcaseTemp = strtolower($arrTableFieldStructure[$q][0]);
		for($k = 0;$k <= $intNumNonEditableFields;$k++){
			$strTempField = strtolower(trim($arrNonEditableFields[$k]));
			$strTempField = str_replace("`", "", $strTempField);  //Replace($strTempField,"[","");
			//$strTempField = str_replace("]", "", $strTempField);  //Replace($strTempField,"]","");
			
			if ($strFieldNameLcaseTemp == $strTempField) {
				$bNonEditable = True;
			}
		} //k
		
		
	//Test if this is the ID field as that field needs some minor special handling
	$strIdFieldTemp = strtolower(trim($strIdField));
	$strIdFieldTemp = str_replace("`", "", $strIdFieldTemp); //Replace($strIdFieldTemp,"[","");
	//$strIdFieldTemp = str_replace("]", "", $strIdFieldTemp); //Replace($strIdFieldTemp,"]","");
	if ($strFieldNameLcaseTemp == $strIdFieldTemp) {
		//We have the ID field so we cant let them edit it
		if ($strID == "0") { /*they are adding so we show nothing*/?>
			<td width=400>
				Row ID will be assigned
				<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_QUOTES)?>">
				<input type=hidden name='field<?=$q?>_b' value="<?=htmlentities($arrTableFieldStructure[$q][1],ENT_QUOTES)?>">
				<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][2],ENT_QUOTES)?>">
				<input type=hidden name='field<?=$q?>_d' value="0">
				<input type=hidden name='field<?=$q?>_e' value="">
			</td>
		<?} else { /*display the field as text so as to make it non-editable*/?>
			<td width=400>
				<?=$strFieldData?>
				<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_QUOTES)?>">
				<input type=hidden name='field<?=$q?>_b' value='skip'>
				<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][2],ENT_QUOTES)?>">
				<input type=hidden name='field<?=$q?>_d' value="<?=htmlentities($strFieldData,ENT_COMPAT)?>">
				<input type=hidden name='field<?=$q?>_e' value="">
			</td>
		<?}
	} else { //Not the ID field
		
		//fix the date and boolean types
		if ($arrTableFieldStructure[$q][1] == "int") {
			//We should be testing for tinyint(1) but many dbs
			//has lot booleans that are tinyint(4) and tinyint(2) so go with less than 5
			//not perfect but should be workable
			if($arrTableFieldStructure[$q][2] < 5) {
				$arrTableFieldStructure[$q][1] = "boolean";
			}
		} elseif ($arrTableFieldStructure[$q][1] == "datetime") {
			$arrTableFieldStructure[$q][1] = "date";
		} elseif ($arrTableFieldStructure[$q][1] == "timestamp") {
			$arrTableFieldStructure[$q][1] = "date";
		} elseif ($arrTableFieldStructure[$q][1] == "time") {
			$arrTableFieldStructure[$q][1] = "date";
		} elseif ($arrTableFieldStructure[$q][1] == "year") {
			$arrTableFieldStructure[$q][1] = "date";
		}
		
		//each field must pass five parameters in the same order with the same name
			// 1) fieldX_a = FieldName
			// 2) fieldX_b = Field Type 	(or skip to not include it in the SQL statement)
			// 3) fieldX_c = FieldMaxLength (for text strings only)  
			// 4) fieldX_d = Actual Data	
			// 5) fieldX_e = FieldContangCharacter	(' for strings, # for dates, blank for numbers)		
			
		switch ($arrTableFieldStructure[$q][1]) {
			case "string": /* char, varchar */
				//echo "strTableName _".$strTableName."_<BR>\n";
				//echo "strFieldNameLcaseTemp _".$strFieldNameLcaseTemp."_<BR>\n";
				?>
				<td width=400>
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value='string'>
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					<?if ($bNonEditable == True) {?>
						<?=$strFieldData?>
						<input type=hidden name='field<?=$q?>_d' value="<?=htmlentities($strFieldData,ENT_COMPAT,"UTF-8")?>">
					<?} elseif ($strTableName == "parts" && $strFieldNameLcaseTemp == "product_line_from_ts_file") {
						$no_return = f_output_select_for_product_line_from_ts_file($strFieldData);
					} else {?>
						<input type=text name='field<?=$q?>_d' maxlength='<?=$arrTableFieldStructure[$q][2]?>' value="<?=htmlentities($strFieldData,ENT_COMPAT,"UTF-8")?>" size=50>
					<?}?>
					<input type=hidden name='field<?=$q?>_e' value="'">
				</td>
				<?
				break;
			case "blob": /* tinytext, mediumtext, text (also tinyblob, mediumblob, and blob but we dont want to edit those) */
				$pos = strpos($arrTableFieldStructure[$q][3], "binary");
				if (!is_integer($pos)) {?>
				<td width=400>
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value='blob'>
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					<?if ($bNonEditable == True) {?>
						<?=$strFieldData?>
						<input type=hidden name='field<?=$q?>_d' value="<?=htmlentities($strFieldData,ENT_COMPAT,"UTF-8")?>">
					<?} else {?>
						<textarea name='field<?=$q?>_d' rows=6 cols=50><?=$strFieldData?></textarea>
					<?}?>
					<input type=hidden name='field<?=$q?>_e' value="'">
				</td>
				<?
				} else {?>
				<td width=400>
					Non-editable binary field
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value="skip">
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_d' value="">
					<input type=hidden name='field<?=$q?>_e' value="">
				</td>
				<?}
				break;
			case "int": /* tinyint, smallint, mediumint, int, & bigint*/?>
				<td width=400>
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value='int'>
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					<?
				//?? case 3	could be done more elegantly but this works
						//Set some default values
							$bShowStandardTextField = False;
							$bUseLookupFunction = False;
							$intLookupField = -1;
						
						if ($strLookupField_Names != "") {
							//echo "We have lookups<BR>";
							//We have lookup fields so test to see if this one
							$strCurrentFieldTemp = $arrTableFieldStructure[$q][0];
							//echo "intNumLookupFields_".$intNumLookupFields."_<BR>";
							for($k = 0;$k <= $intNumLookupFields;$k++){
								//echo $arrLookupField_Names[$k] . " " . $arrLookupField_Fields[$k] . " " . $arrLookupField_OrderBys[$k] . "<BR>";
								//echo "|" . $arrLookupField_Names[$k] . "=" . $strCurrentFieldTemp . "|<BR>";
								$strTempField = trim($arrLookupField_Names[$k]);
								$strTempField = str_replace("`", "", $strTempField); //Replace($strTempField,"[","");
								if ($strCurrentFieldTemp == $strTempField) {
									//echo "lookup match<BR>";
									$bUseLookupFunction = True;
									$intLookupField = $k;
									//echo "intLookupField=" . $intLookupField . "<BR>";
								} else {
									//echo "NO lookup match<BR>";
								}
								//echo "<BR>";
								//Response.Flush;
							} //k
						
							if ($bUseLookupFunction == True) {
								//it is a lookup field so use the lookup function
									//f_ReturnSelectBox(strTableName,strFields,strOrderBy,strSelectName,intItemSelected,strDefaultValue,strDefaultDisplay);
								//echo "ln192<BR>";
								//Response.Flush;
								$strSelectOutput = f_ReturnSelectBox($arrLookupField_Tables[$intLookupField],trim($arrLookupField_Fields[$intLookupField]),trim($arrLookupField_OrderBys[$intLookupField]),"field" . $q . "_d",$strFieldData,"","");
								//MOVE BELOW echo $strSelectOutput;
							} else {
								//echo "lookups but no match<BR>";
								//Not a lookup field so just show the text box
								$bShowStandardTextField = True;
							}
						} else {
							//echo "No lookups<BR>";
							//We dont have lookup fields so just show the text box
							$bShowStandardTextField = True;
						}
						
						if ($bNonEditable == True) {
							//echo "23456<BR>";
							if ($bUseLookupFunction == True) {
								$strFieldsTemp = $arrLookupField_Fields[$intLookupField];
								$arrFieldsTemp = explode(",", $strFieldsTemp);
								echo f_Lookup_Conversion(0, $arrLookupField_Tables[$intLookupField], $arrFieldsTemp[0], $arrFieldsTemp[1], $strFieldData);
							} else {
								echo $strFieldData;
							}								
							?>
							<input type=hidden name='field<?=$q?>_d' value="<?=htmlentities($strFieldData,ENT_COMPAT)?>">
							<?
						} elseif ($bShowStandardTextField == True) {
							//echo "65443<BR>";?>
							<input type=text name='field<?=$q?>_d' maxlength='<?=$arrTableFieldStructure[$q][2]?>' value="<?=htmlentities($strFieldData,ENT_COMPAT)?>" size="10"> integer
							<?
						} else {
							echo $strSelectOutput;
						}
						?>
					<input type=hidden name='field<?=$q?>_e' value="">
				</td>
				<?break;
			case "boolean": //this is a tinyint(1) that is separated out fromthe int family above
				$strTrueChecked = "";	/*reset to default*/?>
				
				<td width=400>
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value='boolean'>
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					
					<?if ($bNonEditable == True) {?>
						<?=$strFieldData?>
						<input type=hidden name='field<?=$q?>_d' value="<?=htmlentities($strFieldData,ENT_COMPAT)?>">
					<?} else {
						//checkbox, selectbox  (or radiobuttons or anything else we care to add)
						$strBooleanDisplay = "checkbox";
						
						if ($strBooleanDisplay == "checkbox") {
							if ($strFieldData != 0) {
								$strTrueChecked = " CHECKED";
							}
							?>
							<input type=checkbox name='field<?=$q?>_d' value="1"<?=$strTrueChecked?>>
						<?} else {?>
							<SELECT name='field<?=$q?>_d'>
								<?
								if ($strFieldData != 0) {
									$strTrueChecked = " SELECTED";
								}
								?>
								<OPTION value="0">False
								<OPTION value="1"<?=$strTrueChecked?>>True
							</SELECT>
						<?}?>
					<?}?>
					<input type=hidden name='field<?=$q?>_e' value="">
				</td>
				<?break;
			case "date": /* date, datetime, timestamp, time, year (artificially broadened above) */?>
				<td width=400>
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value="date">
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					<?if ($bNonEditable == True) {?>
						<?=$strFieldData?>
						<input type=hidden name='field<?=$q?>_d' value="<?=htmlentities($strFieldData,ENT_COMPAT)?>">
					<?} else {?>
						<input type=text name='field<?=$q?>_d' maxlength="22" value="<?=htmlentities($strFieldData,ENT_COMPAT)?>" size="50"><BR>(YYYY-MM-DD hh:mm:ss) Use 24hr time format
					<?}?>
					<input type=hidden name='field<?=$q?>_e' value="'">
				</td>
				<?break;
			case "real": /* float, double, decimal*/?>
				<td width=400>
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value="real">
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					<?if ($bNonEditable == True) {?>
						<?=$strFieldData?>
						<input type=hidden name='field<?=$q?>_d' value="<?=htmlentities($strFieldData,ENT_COMPAT)?>">
					<?} else {?>
						<input type=text name='field<?=$q?>_d' maxlength="20" value="<?=htmlentities($strFieldData,ENT_COMPAT)?>" size="10"> real number
					<?}?>
					<input type=hidden name='field<?=$q?>_e' value="">
				</td>
				<?break;
			default:?>
				<td width=400>
					<b>Unknown Field Type</b><BR>
					Type: <?=$arrTableFieldStructure[$q][1]?><BR>
					Value: '<?=$strFieldData?>'<BR>
					<input type=hidden name='field<?=$q?>_a' value="<?=htmlentities($arrTableFieldStructure[$q][0],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_b' value='skip'>
					<input type=hidden name='field<?=$q?>_c' value="<?=htmlentities($arrTableFieldStructure[$q][3],ENT_COMPAT)?>">
					<input type=hidden name='field<?=$q?>_d' value="">
					<input type=hidden name='field<?=$q?>_e' value="">
				</td>
		<?}
	} /*Id/Non-ID field*/?>
</tr>
<?} /*q*/?>
<tr>
	<td colspan=2 align=center>
		<?
		if ($strID == "0") {
			$strButtonValue = "Add to " . $strTableName . " Table";
		} else {
			$strButtonValue = "Edit " . $strTableName . " Table";
		}
		?>
		<BR>
		<input type=submit value="<?=htmlentities($strButtonValue,ENT_COMPAT)?>" id=submit1 name=submit1>
	</td>
</tr>
</table>
</FORM>
<BR>
<div class="cleaner"></div>
</div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>

<?
function f_output_select_for_product_line_from_ts_file ($current_value) {
	$sql = "
		SELECT product_line_from_ts_file,product_line_from_ts_file 
		FROM parts 
		GROUP BY product_line_from_ts_file";
	$no_return = f_OutputSelectBox($sql,"product_line_from_ts_file",$current_value,"","");
	echo " Used only for TS,TT, and SC parts.";
}

/*
function f_OutputCustomFormField ($custom_output_name) {
	switch ($custom_output_name) {
		case "product_line_from_ts_file":
			$sql = "";
			f_OutputSelectBox($sql,$strSelectName,$intItemSelected,"","");
			break;
		default:
			echo "Unknown (".$custom_output_name.")";
			break;
	}
	
}*/
?>