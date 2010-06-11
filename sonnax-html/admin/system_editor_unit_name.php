<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
require_once "../includes/generic_functions.php";
/*
require_once "../includes/classes/clsPartFinder.php";
require_once "../includes/classes/clsMakes.php";
require_once "../includes/classes/clsUnits.php";
require_once "../includes/classes/clsUnitsBrief.php";
*/
require_once "includes/inc_admin_validate.php";

$unit_id = 		$_GET["unit"];
$unit_name =	getUnitName($unit_id);
$rd =			$_GET['rd'];
$message = 		$_GET["message"];
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
			if (!is_numeric($unit_id) || $unit_name == -1) {?>
				Invalid Unit<BR>
			<? } else {?>
			<form name='form1' id='form1' method='get' action='system_editor_exe.php' class='form' style="padding-left:50px;">
			<div class="long">
				<div class='label'>Unit Name:</div>
				<input type='text' name='unit_name' class='field' value="<?=htmlentities($unit_name,ENT_COMPAT)?>"><BR>
				<div class="cleaner"></div>
				<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
				<input type="hidden" name="action" value="edit_unit_name">
				<input type="hidden" name="rd" value="<?=$rd?>">
				<input type="hidden" name="unit" value="<?=$unit_id?>">
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