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


//S-----Get input-----
	$strTableName = $_GET["t"]; //$_REQUEST["t"];
		//echo "strTableName=" . $strTableName . "<BR>";
		if ($strTableName == "") {
			$strErrorMessage = "Valid Table Name Required";
			$temp = f_OutputErrorNow($strErrorMessage); //terminates page
		}
	$strIdField = $_GET["if"];
		if ($strIdField == "") {
			$strErrorMessage = "ID Field Name Required";
			f_OutputErrorNow($strErrorMessage); //terminates page
		}
	$strDisplayField = $_GET["df"];
		if ($strDisplayField == "") {
			$strDisplayField = $strIdField;
		}
	$strReturnFieldNames = $_GET["rf"];
		if ($strReturnFieldNames == "") {
			$strReturnFieldNames = "*";
		}
		//echo "strReturnFieldNames=" . $strReturnFieldNames . "<BR>";
	$strOrderBy = $_GET["ob"];
		if ($strOrderBy == "") {
			$strOrderBy = $strIdField;
		}
	$strRedirect = $_GET["rdir"];
	
	//result paging variables
		$num_results_to_show = 50;
		$page_number = $_GET["page_number"]; //page_number
	//E-----Get input-----
	
	
//S-----Get table contents
	//set the fields we need for this page
		//we always have a $strDisplayField even if they dont pass one because we set it equal to the $strIdField
		$strDisplayField_TEMP = $strIdField . "," . $strDisplayField;

	$sqlTemp = "SELECT " . $strDisplayField_TEMP . " " .
		"FROM " . $strTableName . " " .
		"ORDER BY " . $strOrderBy . ";";
	//echo $sqlTemp . "<BR>";
	//exit;
	$result = mysql_query ($sqlTemp);
		//or die ("Query Failed (admin2/table_contets.php)");
	if(mysql_errno() != 0) {
		echo $sqlTemp . "<BR>";
		echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
		exit;
	}
	$intNumColumns = mysql_num_fields($result) - 1; //make zero base
		//echo "intNumColumns=" . $intNumColumns . "<BR>";
	$intNumRecords = mysql_num_rows($result) - 1; //make zero base
		//echo "intNumRecords=" . $intNumRecords . "<BR>";
	if ($intNumRecords > -1) {
		//S-----Create the paging variables-----
			//this is being done inside this IF so that we know $intNumRecords and 
			//can only load the actual data we will display into the array
			
			//calculate the total pages
				$intNumRecords_temp = $intNumRecords + 1; //zero base so adjust to 1 base
				$total_pages = intval($intNumRecords_temp / $num_results_to_show); //integer division replacement
					//echo "total_pages=" . $total_pages . "<BR>";
				$mod_total_pages = $intNumRecords_temp % $num_results_to_show; //Mod
					if ($mod_total_pages > 0) {
						$total_pages = $total_pages + 1;
					}
		
			
			//Create the start and end positions
				if (strlen($page_number) <= 0) {
					//no page number so check for start position
					$start_position = $_REQUEST["ap"]; // start position 
						//"sp" is NOT IMPLEMENTED so this if always triggers
						if (strlen($start_position) < 1) {
							//no start position so we assign one
							$start_position = 0;
							$page_number = 1;
						}
					$end_position = $start_position + $num_results_to_show  - 1;
				} Else {
					//fix any low page_numbers
						if ($page_number < 1) {
							$page_number = 1;
						}
					
					//fix any high page numbers
						if ($page_number > $total_pages) {
							$page_number = $total_pages;
						}
				
					//we found a page number so calculate the start position
					$start_position = ($page_number-1) * $num_results_to_show;
					$end_position = $start_position + $num_results_to_show  - 1;
				}
		
			
			//Adjust the start and end positions based on the total number of records
				if ($start_position < 0) {
					$start_position = 0;
				}
					//echo "start_position=" . $start_position . "<BR>";	
				if ($end_position > $intNumRecords) {
					$end_position = $intNumRecords;
				}
					//echo "end_position=" . $end_position . "<BR>";
			//E-----Create the paging variables-----
	
	
		//Set the array ordinal positions for the ID and Dipslay fields
			$intIdOrdinal = 0;
			$intDisplayOrdinal = 1;
			
			
		//Put the data into the array
			$arrTableData[0][0]; //Error preventor
			
			$intCounter = -1; //initialize row counter
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intCounter++; //increment the counter
				
				if ($intCounter < $start_position) {
					//dont need this data
				} elseif ($intCounter > $end_position) {
					//dont need this data
				} else {
					//in range so store that data
					for($i = 0;$i <= $intNumColumns;$i++){
						$arrTableData[$i][$intCounter] = $row[$i];
						//echo "arrTableData[" . $i . "][" . $intCounter . "]=" . $arrTableData[$i][$intCounter] . "<BR>";
					}
					//echo "<BR>";
				}
			}	

	} Else {
		$strErrorMessage = "Table not found or table is empty.";
		f_OutputErrorNow ($strErrorMessage); //terminates page
	}
	//E-----Get table contents
	
	
	
//echo "intIdOrdinal=" & $intIdOrdinal & "<BR>";
//echo "intDisplayOrdinal=" & $intDisplayOrdinal & "<BR>";
?>
<HTML>
<HEAD>
	<META NAME="GENERATOR" Content="Microsoft Visual Studio 6.0">
	<TITLE><?=$strTableName?> Table Contents</TITLE>
	
	<script language="javascript"><!--
		function fVerifyAgreement(strRecordName,intRecordID,strTableName) {
			var bDelete = confirm("Are you sure you want to permanently remove the record...\n\n'" + strRecordName + "' (id " + intRecordID + ")\n\n from table " + strTableName + "?\n\nYou will not be able to undo this event.");
		    return bDelete;
		}
		// -->
	</script>
</HEAD>

<BODY bgcolor=#FFFFFF>
<center><a href='table_edit_wizard.php?t=<?=rawurlencode($strTableName)?>&if=<?=rawurlencode($strIdField)?>&df=<?=rawurlencode($strDisplayField)?>&rf=<?=rawurlencode($strReturnFieldNames)?>&ob=<?=rawurlencode($strOrderBy)?>&id=0'>Add New Record To Table</a> | <A href="admin.php">Admin Home</A></center>
<BR>
<div align="center"><strong><font size="+1"><?=$strTableName?> Table Contents</font></strong></div>
<BR>
<table align="center" cellspacing=0 cellpadding=5>
<tr bgcolor=#DDDDDD>
	<td colspan=3>
		<?
		f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages);
		?>
	</td>
</tr>
<tr bgcolor=#BBBBBB>
	<td>&nbsp;</td>
	<td align=center><b><?=$strDisplayField?></b></td>
	<td>&nbsp;</td>
</tr>
<?
for($q = $start_position; $q <= $end_position; $q++) { //0 to intNumRecords
	if ($q % 2 == 0) {
		$strBGcolorTemp = "EEEEEE";
	} Else {
		$strBGcolorTemp = "BBBBBB";
	}
	
	//make the display field data safe for the javascript
		$strJSSafe_DisplayField = str_replace("'", "", $arrTableData[$intDisplayOrdinal][$q]);
	//THIS WOULD ALLOW US TO SHOW MORE COLUMNS (would also need a system for displaying their names just above this FOR LOOP)
	//For q = 0 to intNumColumns
	//<td align=center><b>arrTableFieldStructure[$q][0]</b></td>
	//Next //q
	?>
	<tr bgcolor="#<?=$strBGcolorTemp?>">
		<td align=center><font size=2>&nbsp;<A href='table_edit_wizard.php?t=<?=rawurlencode($strTableName)?>&if=<?=rawurlencode($strIdField)?>&rf=<?=rawurlencode($strReturnFieldNames)?>&df=<?=rawurlencode($strDisplayField)?>&ob=<?=rawurlencode($strOrderBy)?>&rdir=<?=rawurlencode($strRedirect)?>&id=<?=$arrTableData[$intIdOrdinal][$q]?>'>Edit</a>&nbsp;</font></td>
		<td align=left><font size=3>&nbsp;<?=$arrTableData[$intDisplayOrdinal][$q]?>&nbsp;</font></td>
		<td align=center><font size=2>&nbsp;<A href='table_edit_wizard_delete.php?t=<?=rawurlencode($strTableName)?>&id_field=<?=rawurlencode($strIdField)?>&guid=<?=$arrTableData[$intIdOrdinal][$q]?>&rdir=<?=rawurlencode($strRedirect)?>' onclick="return fVerifyAgreement('<?=$strJSSafe_DisplayField?>','<?=$arrTableData[$intIdOrdinal][$q]?>','<?=$strTableName?>')">Delete</a>&nbsp;</font></td>
	</tr>
	<?
} /*q*/
?>
<tr bgcolor=#DDDDDD>
	<td colspan=3>
		<?
		f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages);
		?>
	</td>
</tr>
</table>
<BR>

</BODY>
</HTML>

<?

function f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages) {
	//print the result totals and the result page navigation
		$strBaseAction = "table_contents.php?t=" . rawurlencode($strTableName) . "&if=" . rawurlencode($strIdField) . "&df=" . rawurlencode($strDisplayField) . "&rf=" . rawurlencode($strReturnFieldNames) . "&ob=" . rawurlencode($strOrderBy) . "&rdir=" . rawurlencode($strRedirect);
		
		echo "<table WIDTH='100%' align=center cellspacing=2 cellpadding=2 bgcolor=#DDDDDD><tr>" .
			"<td bgcolor=#DDDDDD><FONT FACE='VERDANA, ARIAL' SIZE=2>Records " . ($start_position + 1) . " to " . ($end_position + 1) . " of " . ($intNumRecords + 1) . "...<BR></FONT></td>" .
			"<FORM name=pageset method=GET action='table_contents.php'>" .
			"<input type=hidden name='t' value='" . $strTableName . "'>" .
			"<input type=hidden name='if' value='" . $strIdField . "'>" .
			"<input type=hidden name='df' value='" . $strDisplayField . "'>" .
			"<input type=hidden name='rf' value='" . $strReturnFieldNames . "'>" .
			"<input type=hidden name='ob' value='" . $strOrderBy . "'>" .
			"<input type=hidden name='rdir' value='" . $strRedirect . "'>";
					
		if ($page_number < $total_pages) {
			echo "<td align=center bgcolor=#AAAAAA><FONT FACE='VERDANA, ARIAL' SIZE=2><a href='" . $strBaseAction . "&page_number=" . ($page_number + 1) . "'>Next</a></font></td>";
		}
					
		if ($total_pages > 1) {
			echo "<td align=center bgcolor=#DDDDDD><FONT FACE='VERDANA, ARIAL' SIZE=2>Page <input type=text name=page_number size=2 value='" . $page_number . "'> of " . $total_pages . " <input type=submit value='Go'></FONT></td>";
		}
					
		if ($page_number > 1) {
			echo "<td align=center bgcolor=#AAAAAA><FONT FACE='VERDANA, ARIAL' SIZE=2><a href='" . $strBaseAction . "&page_number=" . ($page_number - 1) . "'>Back</a><BR></FONT></td>";
		}
					
		echo "</FORM></tr></table>";
}

function f_OutputErrorNow($strErrorMessage) {
	?>
	<HTML>
	<BODY bgcolor=#FFFFFF>
		<BR><BR><B>The following errors occured...</B><BR><BR>
		<font color=black>
	<?
	echo $strErrorMessage;
	?>	
		</font>
		<BR><BR>
		Please return to the <a href="javascript:history.back()">previous page</a>, correct these mistakes, and try again.
	</BODY>
	</HTML>
	<?
	die;
}
?>
