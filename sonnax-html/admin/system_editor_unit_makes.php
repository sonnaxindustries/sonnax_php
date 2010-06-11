<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
require_once "../includes/classes/clsFormObjects.php";
require_once "../includes/generic_functions.php";
require_once "includes/inc_admin_validate.php";

$message = 			$_GET["message"];
$unit_id = 			$_GET["unit"];
$unit_name =		getUnitName($unit_id);
$rd = 				$_GET["rd"];
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
			<? }?>
			<a href="<?=$rd?>">Return to Part FInder</a>
			<div class="cleaner"></div>
			<?
			if (!is_numeric($unit_id) || $unit_name == -1) {?>
				Invalid Unit<BR>
			<? } else {?>
				
				<div class="long">
					<div class='label'>Add a make to unit '<?=$unit_name?>'</div>
					<div class="cleaner"></div>
				</div>
				<form name='form1' id='form1' method='get' action='system_editor_exe.php' class='form' style="padding-left:50px;">
				<div class="long">
					<div class='label'>Select make to add:</div>
					<?
					$arrMakeData = getAllMakes();
					FormObjects::selectBoxAllMakes("make_id", $arrMakeData, "", "dropdown"); ?>
					
					<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
					<input type="hidden" name="action" value="add_unit_make">
					<input type="hidden" name="rd" value="<?=$rd?>">
					<input type="hidden" name="unit" value="<?=$unit_id?>">
				</div>
				</form>
				<div class="cleaner"></div>
			
			
				<div class="long">
					<div class='label'>Remove current makes for unit '<?=$unit_name?>'</div>
					<div class="cleaner"></div>
				</div>
				<div id='scroll'>
				
				<!-- START OF TITLE ROW -->
				<div class='med' style='font-weight:bold;'>Make</div>
				<div class='med_long2' style='font-weight:bold;'>&nbsp;</div>
				<div class="line"></div>
				<!-- END OF TITLE ROW -->
				<?
				$arr_unit_makes = getMakesForUnit($unit_id);
				$unitMakesUpperBound = count($arr_unit_makes["makes.make"]) - 1;
				for ($x=0; $x <= $unitMakesUpperBound; $x++) {
					?>				
					<div class='med'><?=$arr_unit_makes["makes.make"][$x]?></div>
					<div class='med_long2' style='font-weight:bold;'><a href="system_editor_exe.php?action=remove_unit_make&unit=<?=$unit_id?>&make_id=<?=$arr_unit_makes["unit_makes.make_id"][$x]?>&rd=<?=urlencode($rd)?>">Remove</a></div>
					<div class="line"></div>
					<?
				}?>
				</form>
				<div class="cleaner"></div>
				</div>
			<? }?>
			
		</div>
	</div>
	<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>