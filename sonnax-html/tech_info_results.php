<?
header( 'Content-Type: text/html;charset=UTF-8' );

require_once "includes/classes/clsPublications.php";
require_once "includes/classes/clsPublicationCategory.php";
require_once "includes/classes/clsPublicationSubCategory.php";
require_once "includes/generic_functions.php";
require_once "includes/settings.php";//holds paths to pdfs, images, etc.


$cls_publications = new Publications();
$category_id      = $_GET["category_id"];
$subcategory_id   = $_GET["subcategory_id"];
$sort             = $_GET["sort"];
if (empty($sort)) {
    $sort = 'title';
}
$arr_titles       = $cls_publications->lookupSubCategoryTitles($subcategory_id, $sort);
$int_num_titles   = count($arr_titles["publication_titles.id"])-1;
$subcategory_name = $cls_publications->getSubcategoryName($subcategory_id);

$clsPublicationCategory    = new PublicationCategory($category_id);
$clsSubPublicationCategory = new PublicationSubCategory($subcategory_id);
$instructions     = (strlen($clsSubPublicationCategory->instructions)     > 0) ? $clsSubPublicationCategory->instructions     : $clsPublicationCategory->instructions;
$titleColumnName  = (strlen($clsSubPublicationCategory->titleColumnName)  > 0) ? $clsSubPublicationCategory->titleColumnName  : $clsPublicationCategory->titleColumnName;
$authorColumnName = (strlen($clsSubPublicationCategory->authorColumnName) > 0) ? $clsSubPublicationCategory->authorColumnName : $clsPublicationCategory->authorColumnName;
$dateColumnName   = (strlen($clsSubPublicationCategory->dateColumnName)   > 0) ? $clsSubPublicationCategory->dateColumnName   : $clsPublicationCategory->dateColumnName;
$volumeColumnName = (strlen($clsSubPublicationCategory->volumeColumnName) > 0) ? $clsSubPublicationCategory->volumeColumnName : $clsPublicationCategory->volumeColumnName;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
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
<title>Sonnax - Technical Information - Search Results</title>
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
<div id="header_gen"><div class="header"><h3>Technical<br>Information<br>Search Results</h3></div></div>
<?php require "nav.txt";?>
<div id="main">

<div class="content">
	<h3><?=$subcategory_name?></h3>
	<h4><?=$instructions?></h4>
		<div id='scroll'>
		<!--<form name='get_pdf' id='get_pdf' method='post' action='#' class='form'>-->
<!-- START OF TITLE ROW -->
			<div class='long1' style='font-weight:bold;width:355px;'><a href="tech_info_results.php?category_id=<?php echo $category_id?>&subcategory_id=<?php echo $subcategory_id?>&sort=title"><?=$titleColumnName?></a></div>
			<div class='long1' style='font-weight:bold;width:125px;'><a href="tech_info_results.php?category_id=<?php echo $category_id?>&subcategory_id=<?php echo $subcategory_id?>&sort=author"><?=$authorColumnName?></a></div>
			<div class='med_long' style='font-weight:bold;'><?=$dateColumnName?></div>
			<div class='med_short' style='font-weight:bold;'><?=$volumeColumnName?></div>
			<!--<div class='short' style='font-weight:bold;'>Get PDF</div>-->
			<div class="line"></div>
			<?for ($x=0;$x<=$int_num_titles;$x++) {
				if ($subcategory_id == 14) {
					$str_url_base = $global_sonnaflow_charts_directory_rel;
				} else {
					$str_url_base = $global_tech_articles_directory_rel;
				}?>
			<div class='long1' style="width:355px;"><a href="<?=$str_url_base?><?=$arr_titles["publication_titles.pdf"][$x]?>"><?=$arr_titles["publication_titles.title"][$x]?></a></div>
			<div class='long1' style="width:125px;"><?=$arr_titles["publication_titles.author"][$x]?></div>
			<div class='med_long'><?=$arr_titles["publication_titles.date"][$x]?></div>
			<div class='med_short'><?=$arr_titles["publication_titles.volume"][$x]?></div>
			<!--<div class='short'><input type=checkbox onclick="window.location='<?=$global_tech_articles_directory_rel?><?=$arr_titles["publication_titles.pdf"][$x]?>'; return true;"></div>-->
			<div class="line"></div>
			<?}?>
		<!--</form>-->
		</div>	
	<div class="cleaner"></div>
</div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
//$virtual_page = tech_info_results.php,subcategory
$virtual_page = "tech_info_results.php|".$subcategory_name;
$virtual_page = str_replace("'","",$virtual_page);
$virtual_page = str_replace(",","",$virtual_page);
$virtual_page = str_replace("|",",",$virtual_page);
include_once "includes/analyticstracking.php";
?>
</body>
</html>