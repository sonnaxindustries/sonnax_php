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
$arr_publications = $cls_publications->lookupPublicationCategories();
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
			
			
			
			<?
			$int_num_categories = count($arr_publications["publication_categories.id"])-1;
			for ($x=0;$x<=$int_num_categories;$x++) {
			?>
				<form name='publication' id='publication' method='get' action='title_assignments_list.php'>
				<div class="form">
						<div class='label'><?=$arr_publications["publication_categories.category"][$x]?>:</div>
						<select name='subcategory_id' id='subcategory_id' class='dropdown'>
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
			<? }?>
			
			
			
			<div class="cleaner"></div>
		</div><? //content?>
	</div><? //main?>
	<div id="footer"><?php require "footer.txt";?></div>
</div><? //container?>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>