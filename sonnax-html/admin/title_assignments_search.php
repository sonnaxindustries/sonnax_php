<?
header( 'Content-Type: text/html;charset=UTF-8' );

error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";

require_once "../includes/classes/clsPublications.php";
require_once "../includes/generic_functions.php";
require_once "../includes/settings.php";//holds paths to pdfs, images, etc.

require_once "includes/inc_admin_validate.php";

$message = $_GET["message"];

$cls_publications = new Publications();
$subcategory_id = $_GET["subcategory_id"];
$title = $_GET["title"];
$arr_titles = $cls_publications->titleSearch($title);
$int_num_titles = count($arr_titles["publication_titles.id"])-1;

$subcategory_title = $cls_publications->getSubcategoryName($subcategory_id);

$url_start .= (($_SERVER['HTTPS'] != '') ? "https://" : "http://"); //get protocol
$rd = $url_start . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
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
	<div id="header_trans">
		<div class="header"><h3>Admin</h3></div>
	</div>
	<?php require "nav_admin.txt";?>
	<div id="main">
		<div class="content">
			<div class="cleaner"></div>
			<? if (strlen($message) > 0) {?>
				<div class="warning"><?=$message?></div>
				<div class="cleaner"></div>
			<? }?>
			
			
			
			<h4>Search Results for titles to add to sub-category <?php echo $subcategory_title?></h4>
			<form name="form1" method="get" action="title_assignments_search.php">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Search for titles to add to this sub-category beginning with... <input type="text" name="title" size="30" value="<?=htmlentities($title,ENT_COMPAT)?>"><input type="submit" value="GO">
			<input type="hidden" name="subcategory_id" value="<?=$subcategory_id?>">
			</form>
			<BR>
			<?=($int_num_titles+1)?> titles found<BR>
			<BR>
				<div id='scroll'>
				<!--<form name='get_pdf' id='get_pdf' method='post' action='#' class='form'>-->
		<!-- START OF TITLE ROW -->
					<div class='med_short' style='font-weight:bold;'>&nbsp;</div>
					<div class='long1' style='font-weight:bold;width:300px;'>Title</div>
					<div class='long1' style='font-weight:bold;width:125px;'>Author</div>
					<div class='med' style='font-weight:bold;'>Date</div>
					<div class='med_short' style='font-weight:bold;'>Volume</div>
					<!--<div class='short' style='font-weight:bold;'>Get PDF</div>-->
					<div class="line"></div>
					<? for ($x=0;$x<=$int_num_titles;$x++) {
						if ($subcategory_id == 14) {
							$str_url_base = $global_sonnaflow_charts_directory_rel;
						} else {
							$str_url_base = $global_tech_articles_directory_rel;
						}?>
					<div class='med_short' style='font-weight:bold;'>
						<a href="title_assignments_exe.php?action=add&title_id=<?=$arr_titles["publication_titles.id"][$x]?>&subcategory_id=<?=$subcategory_id?>&rd=<?=urlencode("title_assignments_list.php?subcategory_id=".$subcategory_id)?>">Add</a>
					</div>
					<div class='long1' style="width:300px;"><a href="<?=$str_url_base?><?=$arr_titles["publication_titles.pdf"][$x]?>"><?=$arr_titles["publication_titles.title"][$x]?></a></div>
					<div class='long1' style="width:125px;"><?=$arr_titles["publication_titles.author"][$x]?></div>
					<div class='med'><?=$arr_titles["publication_titles.date"][$x]?></div>
					<div class='med_short'><?=$arr_titles["publication_titles.volume"][$x]?></div>
					<!--<div class='short'><input type=checkbox onclick="window.location='<?=$global_tech_articles_directory_rel?><?=$arr_titles["publication_titles.pdf"][$x]?>'; return true;"></div>-->
					<div class="line"></div>
					<? }?>
				<!--</form>-->
				</div>	
			<div class="cleaner"></div>
			
			
		</div><? //content?>
	</div><? //main?>
	<div id="footer"><?php require "footer.txt";?></div>
</div><? //container?>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>