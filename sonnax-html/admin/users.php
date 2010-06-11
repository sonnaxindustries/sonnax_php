<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
require_once "../includes/generic_functions.php";
require_once "includes/f_OutputErrorNow.php";

/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";


*/

require_once "includes/inc_admin_validate.php";

if ($login->b_edit_users != 1) {
	header("Location: admin.php");
	exit;
}

//$message = $_GET["message"];



//S-----Get input-----
	$strTableName = "`users`";
	$strIdField = "`id`";
	$strDisplayField = "`un`,`b_edit_users`,`b_edit_parts`,`b_edit_makes`,`b_edit_ref_figures`,`b_edit_publications`,`b_edit_distributors`";
	$strReturnFieldNames = "*";
	$strOrderBy = "`un`";
	
	$strLookupField_Names = "";//foreign key fields in the return list that need to be looked up
	$strLookupField_Tables = "";//table that the lookup field is being looked up in
	$strLookupField_Fields = "";//ex: 'id,name' where id represents the foreign key and name represents the lookup value
	$strLookupField_OrderBys = "";//field the lookup results are ordered by
	//$strPresetFieldValuePairs = $_GET["strPresetFieldValuePairs"];
	$strNonEditableFields = $_GET["strNonEditableFields"];
	
	//result paging variables
		$num_results_to_show = 50; //should always be even (odd numbers cause the pow bgcolors to be onff by one on some multiple page tables)
		$page_number = $_GET["page_number"]; //page_number
	//E-----Get input-----


		$url_start .= (($_SERVER['HTTPS'] != '') ? "https://" : "http://"); //get protocol
		$rd = $url_start . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	$strRedirect = $rd;//$_GET["rdir"];


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
		$strErrorMessage = "No Matching Results Found.";
		//f_OutputErrorNow ($strErrorMessage); //terminates page
	}

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
<center><a href='table_edit.php?t=<?=rawurlencode($strTableName)?>&if=<?=rawurlencode($strIdField)?>&df=<?=rawurlencode($strDisplayField)?>&rf=<?=rawurlencode($strReturnFieldNames)?>&ob=<?=rawurlencode($strOrderBy)?>&wh=<?=rawurlencode($strWhere)?><?=$strTableEditParams?>&id=0'>Add New User</a></center>

<BR>
<div align="center"><strong><font size="+1">Search Results</font></strong></div>

<? if ($intNumRecords == -1) {?>
<table align="center" cellspacing=0 cellpadding=5>
<tr bgcolor=#DDDDDD>
	<td>
		<?=$strErrorMessage?>
	</td>
	<td>
		<?
		//include "search_box.php";
		?>
	</td>
</tr>
</table>
<? } else {?>
<BR>
<table align="center" cellspacing=0 cellpadding=5>
<tr bgcolor=#FFFFFF>
	<td>
		<?
		f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages,$strLookupField_Names,$strLookupField_Tables,$strLookupField_Fields,$strLookupField_OrderBys,$strNonEditableFields,$search_for);
		?>
	</td>
	<td>
		<?
		//include "search_box.php";
		?>&nbsp;
	</td>
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
		<td align=center><font size=2><A href='table_edit.php?t=<?=rawurlencode($strTableName)?>&if=<?=rawurlencode($strIdField)?>&rf=<?=rawurlencode($strReturnFieldNames)?>&df=<?=rawurlencode($strDisplayField)?>&ob=<?=rawurlencode($strOrderBy)?>&wh=<?=rawurlencode($strWhere)?>&rdir=<?=rawurlencode($strRedirect)?><?=$strTableEditParams?>&id=<?=$arrTableData[$intIdOrdinal][$q]?>'>Edit</a></font></td>
		<!--<td align=center><font size=2><A href='edit_image_index.php?id=<?=$arrTableData[$intIdOrdinal][$q]?>'>Photos</a></font>&nbsp;</td>-->
		<?for($col = 1; $col <= $intNumColumns; $col++) {
			$pos_un = strpos($arrTableFieldStructure[$col][0], "un");
			$pos_pw = strpos($arrTableFieldStructure[$col][0], "pw");
			
			$pos1 = strpos($arrTableFieldStructure[$col][0], "b_edit_users");
			$pos2 = strpos($arrTableFieldStructure[$col][0], "b_edit_parts");
			$pos3 = strpos($arrTableFieldStructure[$col][0], "b_edit_makes");
			$pos4 = strpos($arrTableFieldStructure[$col][0], "b_edit_ref_figures");
			$pos5 = strpos($arrTableFieldStructure[$col][0], "b_edit_publications");
			$pos6 = strpos($arrTableFieldStructure[$col][0], "b_edit_distributors");
			if ($pos_un !== false || $pos_pw !== false) {?>
			<td align=left><font size=3>&nbsp;<?=$arrTableData[$col][$q]?></font></td>
			<?} elseif ($pos1 !== false || $pos2 !== false || $pos3 !== false || $pos4 !== false || $pos5 !== false || $pos6 !== false) {?>
			<td align=left><font size=3>&nbsp;<?=booleanValue($arrTableData[$col][$q])?></font></td>
			<?} else {//just display the field?>
			<td align=left><font size=3>&nbsp;<?=$arrTableData[$col][$q]?></font></td>
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
		f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages,$strLookupField_Names,$strLookupField_Tables,$strLookupField_Fields,$strLookupField_OrderBys,$strNonEditableFields,$search_for);
		?>
	</td>
	<td>
		<?
		//require_once "search_box.php";
		?>&nbsp;
	</td>
</tr>
</table>
<? }?>
<BR>
<div class="cleaner"></div>
</div><!-- contnent -->

</div><!-- main -->
<div id="footer"><?php require "footer.txt";?></div>
</div><!-- container -->
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</BODY>
</HTML>

<?

function f_OutputPagingSystem($strTableName,$strIdField,$strDisplayField,$strReturnFieldNames,$strOrderBy,$strRedirect,$start_position,$end_position,$intNumRecords,$page_number,$total_pages,$strLookupField_Names,$strLookupField_Tables,$strLookupField_Fields,$strLookupField_OrderBys,$strNonEditableFields,$search_for) {
	//print the result totals and the result page navigation
		$strBaseAction = "search_results.php?t=" . rawurlencode($strTableName) . "&if=" . rawurlencode($strIdField) . "&df=" . rawurlencode($strDisplayField) . "&rf=" . rawurlencode($strReturnFieldNames) . "&ob=" . rawurlencode($strOrderBy) . "&rdir=" . rawurlencode($strRedirect) . "&search_for=" . rawurlencode($search_for);
		
		echo "<table WIDTH='100%' align=center cellspacing=2 cellpadding=2 bgcolor=#DDDDDD><tr>" .
			"<td bgcolor=#DDDDDD><FONT FACE='VERDANA, ARIAL' SIZE=2>Records " . ($start_position + 1) . " to " . ($end_position + 1) . " of " . ($intNumRecords + 1) . "...<BR></FONT></td>" .
			"<FORM name=pageset method=GET action='search_results.php'>\n" .
			"<input type=hidden name='t' value='" . $strTableName . "'>\n" .
			"<input type=hidden name='if' value='" . $strIdField . "'>\n" .
			"<input type=hidden name='df' value='" . $strDisplayField . "'>\n" .
			"<input type=hidden name='rf' value='" . $strReturnFieldNames . "'>\n" .
			"<input type=hidden name='ob' value='" . $strOrderBy . "'>\n" .
			"<input type=hidden name='search_for' value='" . $search_for . "'>\n" .
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
		case "un":
			return "Username";
			break;
		case "b_edit_users":
			return "Edit<BR>Users";
			break;
		case "b_edit_makes":
			return "Edit<BR>Makes";
			break;
		case "b_edit_parts":
			return "Edit<BR>Parts";
			break;
		case "b_edit_ref_figures":
			return "Edit<BR>RefFigures";
			break;
		case "b_edit_publications":
			return "Edit<BR>Publications";
			break;
		case "b_edit_distributors":
			return "Edit<BR>Distributors";
			break;
		default;
			return $strFieldName;
			break;
	}
}

function booleanValue($input) {
	if ( intval($input) == 1) {
		return "Yes";
	} else {
		return "No";
	}
}

?>
