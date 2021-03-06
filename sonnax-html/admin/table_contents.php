﻿<?
error_reporting (E_ALL ^ E_NOTICE);
require "../includes/classes/clsDataConn.php";
require "../includes/classes/clsAdminLogin.php";
require "includes/f_OutputErrorNow.php";

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
		//this makes use of the table_edit_item.php page for editing the items table
		if (str_replace("`","",$strTableName) == "items") {
			$strItemTable = "_item";
		} else {
			$strItemTable = "";		
		}

	$strIdField = $_GET["if"];
		if ($strIdField == "") {
			$strErrorMessage = "ID Field Name Required";
			f_OutputErrorNow($strErrorMessage); //terminates page
		}
	$strDisplayField = $_GET["df"];
		//strDisplayField can contain more than one field name (comma delimited with `'s around and fileds with spaces)
		//but the first field in the list will be the one that represents how the field is reffered to in the javascript delete message
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
	$strWhere = $_GET["wh"];
	$strRedirect = $_GET["rdir"];
	
	$strLookupField_Names = $_GET["strLookupField_Names"];
	$strLookupField_Tables = $_GET["strLookupField_Tables"];
	$strLookupField_Fields = $_GET["strLookupField_Fields"];
	$strLookupField_OrderBys = $_GET["strLookupField_OrderBys"];
	
	//$strPresetFieldValuePairs = $_GET["strPresetFieldValuePairs"];
	
	$strNonEditableFields = $_GET["strNonEditableFields"];
	
	//result paging variables
		$num_results_to_show = 20; //should always be even (odd numbers cause the pow bgcolors to be onff by one on some multiple page tables)
		$page_number = $_GET["page_number"]; //page_number
	//E-----Get input-----
	
	
//S-----Get table contents
	//set the fields we need for this page
		//we always have a $strDisplayField even if they dont pass one because we set it equal to the $strIdField
		$strDisplayField_TEMP = $strIdField . "," . $strDisplayField;

	$sqlTemp = "SELECT " . $strDisplayField_TEMP . " " .
		"FROM " . $strTableName;
	if(strlen($strWhere) > 0){
		$sqlTemp .= " WHERE " . $strWhere;
	}
	$sqlTemp .= " ORDER BY " . $strOrderBy . ";";
	//echo $sqlTemp . "<BR>";
	//exit;
	$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}
	$intNumColumns = mysql_num_fields($result) - 1; //make zero base
		//echo "intNumColumns=" . $intNumColumns . "<BR>";
	$intNumRecords = mysql_num_rows($result) - 1; //make zero base
		//echo "intNumRecords=" . $intNumRecords . "<BR>";
		
		
	//S-----Always Get the column info-----
		for ($i=0; $i <= $intNumColumns; $i++) {
			$arrTableFieldStructure[$i][0] = mysql_field_name($result, $i);
			$arrTableFieldStructure[$i][1] = mysql_field_type($result, $i);
			$arrTableFieldStructure[$i][2] = mysql_field_len($result, $i);
			$arrTableFieldStructure[$i][3] = mysql_field_flags($result, $i);
			//echo "<BR>name=".$arrTableFieldStructure[$i][0]."<BR>type=".$arrTableFieldStructure[$i][1]."<BR>len=".$arrTableFieldStructure[$i][2]."<BR>flags=".$arrTableFieldStructure[$i][3]."<BR>\n";
		}			
		//E-----Always Get the column info-----
		
		
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
<TITLE><?=$strTableName?> Table Contents</TITLE>
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
<script language="javascript"><!--
	function fVerifyAgreement(strRecordName,intRecordID,strTableName) {
		var bDelete = confirm("Are you sure you want to remove the record '" + strRecordName + "' (id " + intRecordID + ") from table " + strTableName + "?");
	    return bDelete;
	}
	// -->
</script>
</head>
<body>
<div id="container">
<div id="header_trans"><div class="header"><h3>Admin</h3></div></div>
<?php require "nav_admin.txt";?>
<div id="main">
<div class="content">

<?
if(strlen($strLookupField_Names) > 0){
	$strTableEditParams = "&strLookupField_Names=" . rawurlencode($strLookupField_Names) . 
	"&strLookupField_Tables=" . rawurlencode($strLookupField_Tables) .
	"&strLookupField_Fields=" . rawurlencode($strLookupField_Fields) .
	"&strLookupField_OrderBys=" . rawurlencode($strLookupField_OrderBys) .
	"&strNonEditableFields=" . rawurlencode($strNonEditableFields);
	
	//$strPresetFieldValuePairs
} else {
	$strTableEditParams = "";
}		
?>
<center><a href='table_edit<?=$strItemTable?>.php?t=<?=rawurlencode($strTableName)?>&if=<?=rawurlencode($strIdField)?>&df=<?=rawurlencode($strDisplayField)?>&rf=<?=rawurlencode($strReturnFieldNames)?>&ob=<?=rawurlencode($strOrderBy)?>&wh=<?=rawurlencode($strWhere)?><?=$strTableEditParams?>&id=0'>Add New Record To Table</a>
</center>
<BR>
<div align="center"><strong><font size="+1"><?=$strTableName?> Table Contents</font></strong></div>
<!--
<BR>
<CENTER><b><font color="#FF0000">The Photos feature is being developed by VTweb. It is not yet ready for actual use.</font></b></CENTER>
-->
<BR>
<table align="center" cellspacing=0 cellpadding=5>
<tr bgcolor=#<?=$strBgColor?>>
	<td>
		<?
		f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages,$strLookupField_Names,$strLookupField_Tables,$strLookupField_Fields,$strLookupField_OrderBys,$strNonEditableFields,$strWhere);
		?>
	</td>
	<?php
	if ($strTableName == "`publication_titles`") {?>
	<td>
		<?
		include "search_box.php";
		?>
	</td>
	<?php }?>
</tr>
</table>
<table align="center" cellspacing=0 cellpadding=5>
<tr bgcolor=#BBBBBB>
	<td>&nbsp;</td>
	<!--<td>&nbsp;</td>-->
	<?for($col = 1; $col <= $intNumColumns; $col++) {?>
	<td align=center><b><?=f_FriendlyFieldNames($arrTableFieldStructure[$col][0])?></b></td>
	<?}?>
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
		$strJSSafe_DisplayField = str_replace('"', '', $strJSSafe_DisplayField);

	?>
	<tr bgcolor="#<?=$strBGcolorTemp?>">
		<td align=center><font size=2><A href='table_edit<?=$strItemTable?>.php?t=<?=rawurlencode($strTableName)?>&if=<?=rawurlencode($strIdField)?>&rf=<?=rawurlencode($strReturnFieldNames)?>&df=<?=rawurlencode($strDisplayField)?>&ob=<?=rawurlencode($strOrderBy)?>&wh=<?=rawurlencode($strWhere)?>&rdir=<?=rawurlencode($strRedirect)?><?=$strTableEditParams?>&id=<?=$arrTableData[$intIdOrdinal][$q]?>'>Edit</a></font></td>
		<!--<td align=center><font size=2><A href='edit_image_index.php?id=<?=$arrTableData[$intIdOrdinal][$q]?>'>Photos</a></font>&nbsp;</td>-->
		<?for($col = 1; $col <= $intNumColumns; $col++) {
			$pos = strpos($arrTableFieldStructure[$col][0], "Price");
			if ($pos === false) { // note: three equal signs?>
			<td align=left><font size=3>&nbsp;<?=$arrTableData[$col][$q]?></font></td>
			<?} else {?>
			<td align=right><font size=3>$ <?=number_format($arrTableData[$col][$q],2)?>&nbsp;</font></td>
			<?}
		}?>
		<td align=center><font size=2><A href='table_edit_delete.php?t=<?=rawurlencode($strTableName)?>&id_field=<?=rawurlencode($strIdField)?>&guid=<?=$arrTableData[$intIdOrdinal][$q]?>&rdir=<?=rawurlencode($strRedirect)?>' onclick="return fVerifyAgreement('<?=$strJSSafe_DisplayField?>','<?=$arrTableData[$intIdOrdinal][$q]?>','<?=$strTableName?>')">Delete</a></font></td>
	</tr>
	<?
} /*q*/
?>
</table>
<table align="center" cellspacing=0 cellpadding=5>
<tr bgcolor=#<?=$strBgColor?>>
	<td>
		<?
		f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages,$strLookupField_Names,$strLookupField_Tables,$strLookupField_Fields,$strLookupField_OrderBys,$strNonEditableFields,$strWhere);
		?>
	</td>
	<?php
	if ($strTableName == "`publication_titles`") {?>
	<td>
		<?
		include "search_box.php";
		?>
	</td>
	<?php }?>
</tr>
</table>
<BR>
<div class="cleaner"></div>
</div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</BODY>
</HTML>

<?

function f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages,$strLookupField_Names,$strLookupField_Tables,$strLookupField_Fields,$strLookupField_OrderBys,$strNonEditableFields,$strWhere) {
	//print the result totals and the result page navigation
		$strBaseAction = "table_contents.php?t=" . rawurlencode($strTableName) . "&if=" . rawurlencode($strIdField) . "&df=" . rawurlencode($strDisplayField) . "&rf=" . rawurlencode($strReturnFieldNames) . "&ob=" . rawurlencode($strOrderBy) . "&rdir=" . rawurlencode($strRedirect) . "&wh=" . rawurlencode($strWhere);
		
		echo "<table WIDTH='100%' align=center cellspacing=2 cellpadding=2 bgcolor=#DDDDDD><tr>" .
			"<td bgcolor=#DDDDDD><FONT FACE='VERDANA, ARIAL' SIZE=2>Records " . ($start_position + 1) . " to " . ($end_position + 1) . " of " . ($intNumRecords + 1) . "...<BR></FONT></td>" .
			"<FORM name=pageset method=GET action='table_contents.php'>\n" .
			"<input type=hidden name='t' value='" . $strTableName . "'>\n" .
			"<input type=hidden name='if' value='" . $strIdField . "'>\n" .
			"<input type=hidden name='df' value='" . $strDisplayField . "'>\n" .
			"<input type=hidden name='rf' value='" . $strReturnFieldNames . "'>\n" .
			"<input type=hidden name='ob' value='" . $strOrderBy . "'>\n" .
			"<input type=hidden name='wh' value='" . $strWhere . "'>\n" .
			"<input type=hidden name='rdir' value='" . $strRedirect . "'>\n";
			
		if(strlen($strLookupField_Names) > 0){
			echo "<input type=hidden name='strLookupField_Names' value='" . $strLookupField_Names . "'>\n" .
			"<input type=hidden name='strLookupField_Tables' value='" . $strLookupField_Tables . "'>\n" .
			"<input type=hidden name='strLookupField_Fields' value='" . $strLookupField_Fields . "'>\n" .
			"<input type=hidden name='strLookupField_OrderBys' value='" . $strLookupField_OrderBys . "'>\n" .
			"<input type=hidden name='strNonEditableFields' value='" . $strNonEditableFields . "'>\n";
			
			$strTableEditParams = "&strLookupField_Names=" . rawurlencode($strLookupField_Names) . 
			"&strLookupField_Tables=" . rawurlencode($strLookupField_Tables) .
			"&strLookupField_Fields=" . rawurlencode($strLookupField_Fields) .
			"&strLookupField_OrderBys=" . rawurlencode($strLookupField_OrderBys) .
			"&strNonEditableFields=" . rawurlencode($strNonEditableFields);
			
			//$strPresetFieldValuePairs
		} else {
			$strTableEditParams = "";
		}
					
		if ($page_number < $total_pages) {
			echo "<td align=center bgcolor=#AAAAAA><FONT FACE='VERDANA, ARIAL' SIZE=2><a href='" . $strBaseAction . $strTableEditParams . "&page_number=" . ($page_number + 1) . "'>Next</a></font></td>";
		}
					
		if ($total_pages > 1) {
			echo "<td align=center bgcolor=#DDDDDD><FONT FACE='VERDANA, ARIAL' SIZE=2>Page <input type=text name=page_number size=2 value='" . $page_number . "'> of " . $total_pages . " <input type=submit value='Go'></FONT></td>";
		}
					
		if ($page_number > 1) {
			echo "<td align=center bgcolor=#AAAAAA><FONT FACE='VERDANA, ARIAL' SIZE=2><a href='" . $strBaseAction . $strTableEditParams . "&page_number=" . ($page_number - 1) . "'>Back</a><BR></FONT></td>";
		}
					
		echo "</FORM></tr></table>";
}

function f_FriendlyFieldNames($strFieldName){
	switch($strFieldName){
		case "ISBN":
			return "Inventory#";
			break;
		case "Retail_Price";
			return "Web Price";
			break;
		default;
			return $strFieldName;
			break;
	}
}


?>
