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
	$TableEdit_strTableName = $_GET["TableEdit_strTableName"];
	//$TableEdit_intNumColumns = $_GET["TableEdit_intNumColumns"];
	//$TableEdit_strID = $_GET["TableEdit_strID"];
	$TableEdit_strIdField = $_GET["TableEdit_strIdField"];
	$TableEdit_strDisplayField = $_GET["TableEdit_strDisplayField"];
	$TableEdit_strReturnFieldNames = $_GET["TableEdit_strReturnFieldNames"];
	$TableEdit_strOrderBy = $_GET["TableEdit_strOrderBy"];
	$TableEdit_strWhere = $_GET["TableEdit_strWhere"];
	$id_of_item_just_added = $_GET["id_of_item_just_added"];
	
	$strPresetFieldValuePairs = $_GET["strPresetFieldValuePairs"];
	$strLookupField_Names = $_GET["strLookupField_Names"];
	$strLookupField_Tables = $_GET["strLookupField_Tables"];
	$strLookupField_Fields = $_GET["strLookupField_Fields"];
	$strLookupField_OrderBys = $_GET["strLookupField_OrderBys"];
	$strNonEditableFields = $_GET["strNonEditableFields"];

	//$TableEdit_Redirect = $_GET["TableEdit_Redirect"];
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
	<title>Item&nbsp;added&nbsp;to&nbsp;<?=$TableEdit_strTableName?>&nbsp;table</title>
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

<?if($id_of_item_just_added != "non_unique"){?>
<center>
<h2>Item successfully added to <?=$TableEdit_strTableName?> table</h2>

<?} else {?>
<h2>It appears that a duplicate entry exist in the <?=$TableEdit_strTableName?> table for the item added</h2>
<!--<h2><a href="mailto:terry@vtweb.com">Contact VTweb for assistance</a></h2>-->
<?}

if ($TableEdit_strTableName == "`parts_featured`") {?>
<FORM NAME="form1" ACTION="table_edit.php" METHOD="GET">
<a href="#" onClick="form1.submit()">Add another entry to <?=$TableEdit_strTableName?></a><BR>
<input type=hidden name="t" value='<?=rawurldecode($TableEdit_strTableName)?>'>
<input type=hidden name="id" value='0'>
<input type=hidden name="if" value='<?=rawurldecode($TableEdit_strIdField)?>'>
<input type=hidden name="df" value='<?=rawurldecode($TableEdit_strDisplayField)?>'>
<input type=hidden name="rf" value='<?=rawurldecode($TableEdit_strReturnFieldNames)?>'>
<input type=hidden name="ob" value='<?=rawurldecode($TableEdit_strOrderBy)?>'>
<input type=hidden name="wh" value='<?=rawurldecode($TableEdit_strWhere)?>'>
<input type=hidden name="strPresetFieldValuePairs" value='<?=rawurldecode($strPresetFieldValuePairs)?>'>
<input type=hidden name="strLookupField_Names" value='product_line_id|part_id'>
<input type=hidden name="strLookupField_Tables" value='product_lines|parts'>
<input type=hidden name="strLookupField_Fields" value='id,name|id,part_number'>
<input type=hidden name="strLookupField_OrderBys" value='name|part_number'>
<input type=hidden name="strNonEditableFields" value='<?=rawurldecode($strNonEditableFields)?>'>
</FORM>

<a href="parts_featured.php">View table contents</a>
<?} elseif ($TableEdit_strTableName == "`users`") {?>
<FORM NAME="form1" ACTION="table_edit.php" METHOD="GET">
<a href="#" onClick="form1.submit()">Add another entry to <?=$TableEdit_strTableName?></a><BR>
<input type=hidden name="t" value='<?=rawurldecode($TableEdit_strTableName)?>'>
<input type=hidden name="id" value='0'>
<input type=hidden name="if" value='<?=rawurldecode($TableEdit_strIdField)?>'>
<input type=hidden name="df" value='<?=rawurldecode($TableEdit_strDisplayField)?>'>
<input type=hidden name="rf" value='<?=rawurldecode($TableEdit_strReturnFieldNames)?>'>
<input type=hidden name="ob" value='<?=rawurldecode($TableEdit_strOrderBy)?>'>
<input type=hidden name="wh" value='<?=rawurldecode($TableEdit_strWhere)?>'>
<input type=hidden name="strPresetFieldValuePairs" value='<?=rawurldecode($strPresetFieldValuePairs)?>'>
<input type=hidden name="strLookupField_Names" value=''>
<input type=hidden name="strLookupField_Tables" value=''>
<input type=hidden name="strLookupField_Fields" value=''>
<input type=hidden name="strLookupField_OrderBys" value=''>
<input type=hidden name="strNonEditableFields" value='<?=rawurldecode($strNonEditableFields)?>'>
</FORM>

<a href="users.php">View table contents</a>
<?} else {?>
<FORM NAME="form1" ACTION="table_edit.php" METHOD="GET">
<a href="#" onClick="form1.submit()">Add another entry to <?=$TableEdit_strTableName?></a><BR>
<input type=hidden name="t" value='<?=rawurldecode($TableEdit_strTableName)?>'>
<input type=hidden name="id" value='0'>
<input type=hidden name="if" value='<?=rawurldecode($TableEdit_strIdField)?>'>
<input type=hidden name="df" value='<?=rawurldecode($TableEdit_strDisplayField)?>'>
<input type=hidden name="rf" value='<?=rawurldecode($TableEdit_strReturnFieldNames)?>'>
<input type=hidden name="ob" value='<?=rawurldecode($TableEdit_strOrderBy)?>'>
<input type=hidden name="wh" value='<?=rawurldecode($TableEdit_strWhere)?>'>
<input type=hidden name="strPresetFieldValuePairs" value='<?=rawurldecode($strPresetFieldValuePairs)?>'>
<input type=hidden name="strLookupField_Names" value='<?=rawurldecode($strLookupField_Names)?>'>
<input type=hidden name="strLookupField_Tables" value='<?=rawurldecode($strLookupField_Tables)?>'>
<input type=hidden name="strLookupField_Fields" value='<?=rawurldecode($strLookupField_Fields)?>'>
<input type=hidden name="strLookupField_OrderBys" value='<?=rawurldecode($strLookupField_OrderBys)?>'>
<input type=hidden name="strNonEditableFields" value='<?=rawurldecode($strNonEditableFields)?>'>
</FORM>

<a href="table_contents.php?t=<?=rawurlencode($TableEdit_strTableName)?>&if=<?=rawurlencode($TableEdit_strIdField)?>&df=<?=rawurlencode($TableEdit_strDisplayField)?>&rf=<?=rawurlencode($TableEdit_strReturnFieldNames)?>&ob=<?=rawurlencode($TableEdit_strOrderBy)?>&wh=<?=rawurlencode($TableEdit_strWhere)?>">View table contents</a>
<?}?>

</center>
<div class="cleaner"></div>
</div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>

