<?
header( 'Content-Type: text/html;charset=UTF-8' );

require_once "includes/classes/clsPublications.php";
require_once("includes/classes/clsPartFinder.php");
require_once("includes/classes/clsProductLine.php");
require_once "includes/generic_functions.php";
require_once("includes/settings.php");//holds paths to pdfs, images, etc.


$cls_publications = new Publications();
$arr_publications = $cls_publications->lookupPublicationCategories();




/*
require_once("includes/classes/clsMakes.php");
require_once("includes/classes/clsUnits.php");
require_once("includes/classes/clsUnitsBrief.php");
require_once("includes/classes/clsPart.php");
*/




$product_lines 		= new ProductLines();
//$part_finder 		= new PartFinder($_GET);
//$makes 				= new Makes($part_finder->product_line);
//$unitsBrief			= new UnitsBrief($part_finder->product_line,$part_finder->make_id);
//$product_line_obj 	= new ProductLine($part_finder->product_line);
//$title 				= $product_line_obj->name;
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
<title>Sonnax - Quick Search</title>
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
<Script language="JavaScript">
function goThere(loc) {
	window.location.href=loc;
}

function forwardPagePublications(int_form_id) {
	var theForm 		= document.forms[int_form_id];
	int_category_id 	= theForm.elements[0].value;
	int_subcategory_id 	= theForm.elements[1].value;
		
	window.location.href= "tech_info_results.php?category_id="+int_category_id+"&subcategory_id="+int_subcategory_id;
}
//-->
</SCRIPT>
<style type="text/css">
<!--
.style2 {
	color: #024368;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<div id="container">
<div id="header_gen"><div class="header"></div></div>
<?php require "nav.txt";?>
<div id="main">

<div class="content">
<h4>Quick Search by application (Make, Unit, Series, etc.)</h4>
<form name='product_line_search1' id='product_line_search1' method='get' action='part_finder.php' class='form' style="padding-left:50px;">
		<div class="long">
			<div class='label'>Select Product Line:</div>
			<? FormObjects::selectBoxForProductLineReload("pl", $product_lines->displays, $product_lines->values, "3", "dropdown", "product_line"); ?>
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
		  </div>
		
		</form>
	<div class="cleaner"></div>
<h4>Quick Search by Sonnax part number:</h4>
<form name='product_line_search2' id='product_line_search2' method='get' action='part_search_results.php' class='form' style="padding-left:50px;">
		<div class="long">
			<div class='label'></div>
		</div>
		
		<div class="long">
			<div class='label'>Search Part Number:</div>
      <input type='text' name='pn' class='field'>
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
		</div>
		</form>
	<div class="cleaner"></div>
<h4>Quick Search by New Products:</h4>

	<form name='new_products_search' id='new_products_search' method='get' action='part_finder.php' class='form' style="padding-left:50px;">
	<div class="long">
		<div class="label">Select Product Line:</div>
		<select name="pl" class="dropdown"  id="product_line" ONCHANGE='goThere(this.options[this.selectedIndex].value)' > 
		<option value="part_finder.php?new_only=true&pl=7">Allison®</option>
        <option value="part_finder.php?new_only=true&pl=1">High Performance Transmission</option>
        <option value="part_finder.php?new_only=true&pl=10">Torque Converter & HP Converter</option>
         <option value="part_finder.php?new_only=true&pl=3" SELECTED>Transmission</option> 
		</select> 
		<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
	</div>
	<div class="cleaner"></div>
	<p>
	  <input type="hidden" name="new_only" value="true">
	</p>
	</form>
<div class="cleaner"></div>

<h4>Select the publication you need:</h4>
<?
$int_num_categories = count($arr_publications["publication_categories.id"])-1;
for ($x=0;$x<=$int_num_categories;$x++) {
?>
	<form name='publication' id='publication' method='get' action='tech_info_results.php' style="padding-left:50px;">
	<div class="form">
			<div class='label'><?=$arr_publications["publication_categories.category"][$x]?>:</div>
			<input type='hidden' name='category_id' value='<?=$arr_publications["publication_categories.id"][$x]?>'>
			<select name='subcategory_id' id='subcategory_id' class='dropdown' ONCHANGE='forwardPagePublications(<?=$x + 3?>)'>
				<option value='' selected>Select</option>
				<?
				$arr_subcategories = $cls_publications->lookupPublicationSubCategories($arr_publications["publication_categories.id"][$x]);
				$int_num_subcategories = count($arr_subcategories["publication_subcategories.id"])-1;
				for ($y=0;$y<=$int_num_subcategories;$y++) {?>
				<option value='<?=$arr_subcategories["publication_subcategories.id"][$y]?>'><?=$arr_subcategories["publication_subcategories.subcategory"][$y]?></option>
				<?}?>
			</select>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit'>
	</div>
	</form>
	<div class="cleaner"></div>
<?}?>
	<h4><a href="request_catalog.php">Request Sonnax Catalogs</a></h4>
</div>


</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>

<?php
$virtual_page = "quick_search.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>