<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
require_once "includes/generic_functions.php";
*/
require "includes/inc_admin_validate.php";

$message = $_GET["message"];
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
<title>Sonnax Admin</title>
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

<div class="cleaner"></div>
<?
if (strlen($message) > 0) {?>
	<div class="warning"><?=$message?></div>
	<div class="cleaner"></div>
<?}


//echo "<pre>";
//var_dump($login);
//echo "</pre>";
?>

Admin Center<br>
<?if ($login->b_edit_parts == 1) {?>
<BR>
<B>Parts & Units</B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="part_finder.php">System Search for Parts & Units to Edit</a></B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="search_results.php">Direct Part Number Search</a></B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="parts_featured.php">Featured Part Rotator</a></B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='table_edit.php?t=parts&if=id
		&strLookupField_Names=<?=rawurlencode('product_line')?>
		&strLookupField_Fields=<?=rawurlencode('id,name')?>
		&strLookupField_OrderBys=<?=rawurlencode('name')?>
		&strLookupField_Tables=<?=rawurlencode('product_lines')?>
		&id=0'>Add Part</a></B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="system_editor_unit_add.php">Add Unit</a><BR>
<?}
if ($login->b_edit_makes == 1) {?>
<BR>
<B>Makes</B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="table_contents.php?t=`makes`&if=`id`&df=`make`&ob=`make`">Edit Makes</a></B><BR>
<?}
if ($login->b_edit_ref_figures == 1) {?>
<br>
<B>Reference Figures</B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="table_contents.php?t=`ref_figures`&if=`id`&df=`name`&ob=`name`">Edit Reference Figures</a></B><BR>
<?}
if ($login->b_edit_distributors == 1) {?>
<br>
<B>Distributors</B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="table_contents.php?t=`ts_distributors`&if=`id`&df=`name`&ob=`name`">Edit Distributors</a></B><BR>
<?}
if ($login->b_edit_publications == 1) {?>
<br>
<B>Publications</B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="table_contents.php?t=`publication_categories`&if=`id`&df=`category`&ob=`category`">Edit Category Names</a></B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="table_contents.php?t=`publication_subcategories`&if=`id`&df=`subcategory`&ob=`subcategory`
		&strLookupField_Names=<?=rawurlencode('publication_category')?>
		&strLookupField_Fields=<?=rawurlencode('id,category')?>
		&strLookupField_OrderBys=<?=rawurlencode('category')?>
		&strLookupField_Tables=<?=rawurlencode('publication_categories')?>">Edit Sub-Categories</a></B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="title_assignments.php">Edit Titles in Sub-Categories</a></B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="table_contents.php?t=`publication_titles`&if=`id`&df=`title`&ob=`title`">Edit Titles</a></B><BR>
<?}
if ($login->b_edit_users == 1) {?>
<br>
<B>Users</B><BR>
<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="users.php">Edit Users</a></B><BR>
<?//<B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="table_contents.php?t=`users`&if=`id`&df=`un`&ob=`un`">Edit Users</a></B><BR>?>
<?}?>
<div class="cleaner"></div>
</div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>