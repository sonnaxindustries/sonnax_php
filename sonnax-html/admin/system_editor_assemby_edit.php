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

$pl = 					$_GET["pl"];
$unit_id = 				$_GET["unit"];
$unit_name =			getUnitName($unit_id);
$part_id = 				$_GET["part_id"];
//$part_number =			getPartNumber($part_id,$pl);
$arr_part_data = 		getPartDataFromId($part_id);
	$part_number = 		$arr_part_data["parts.part_number"][0];
	$part_item = 		$arr_part_data["parts.item"][0];
	$part_description 			= $arr_part_data["parts.description"][0];
	/*
	$display_order 				= $arr_part_data["parts.display_order"][0];
	$notes 						= $arr_part_data["parts.notes"][0];
	$steel_driveshaft_tube_od 	= $arr_part_data["parts.steel_driveshaft_tube_od"][0];
	$torque_fuse_options 		= $arr_part_data["parts.torque_fuse_options"][0];
	$pts_series 				= $arr_part_data["parts.pts_series"][0];
	$driveline_series 			= $arr_part_data["parts.driveline_series"][0];
	*/
	
$component_id =			$_GET["component_id"];
$arr_component_data =	getComponentData($component_id);
$rd =					$_GET['rd'];
$message =				$_GET["message"];
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
			if (!is_array($arr_component_data) || !is_numeric($unit_id) || !is_numeric($component_id) || $unit_name == -1) {?>
				Invalid Component (id <?=strip_tags($component_id)?>) or Unit (id <?=strip_tags($unit_id)?>)<BR>
			<? } else {?>
			<form name='form1' id='form1' method='get' action='system_editor_exe.php' class='form' style="padding-left:50px;">
			<!--<div class="long">-->
				<div class='label'>Unit Name: <?=strip_tags($unit_name)?></div><BR>
				<div class='label'>Part Number: <?=strip_tags($part_number)?></div><BR>
				<div class='label'>Item: <?=strip_tags($part_item)?></div><BR>
				<div class='label'>Component ID: <?=strip_tags($component_id)?></div><BR>
				<?
				if ($arr_component_data["unit_components.component_type"][0] == 1) {
					$component_type = "Assembly";
				} else {
					$component_type = "Part";
				}
				?>
				<div class='label'>Component Type: <?=$component_type?></div><BR>
				<? /*<select name="component_type">
					<?!
					if ($arr_component_data["unit_components.component_type"][0] == 1) {
						$assembly_checked = " SELECTED";
					}
					
					<option value="0">Part</option>
					<option value="1"<!?=$assembly_checked?!>>Assembly</option>
				</select>
				*/?>
				<div class='label'>Assembly or Part ID:&nbsp;<?=$arr_component_data["unit_components.assembly_or_part_id"][0]?></div><BR>
				<BR>
				Code on Reference Figure:&nbsp;<input type='text' name='code_on_ref_figure' class='field' value="<?=htmlentities($arr_component_data["unit_components.code_on_ref_figure"][0],ENT_COMPAT)?>"><BR>
				<BR>
				Indent: <select name="indent">
					<?
					if ($arr_component_data["unit_components.indent"][0] == 1) {
						$indent_checked = " SELECTED";
					}
					?>
					<option value="0">No</option>
					<option value="1"<?=$indent_checked?>>Yes</option>
				</select><BR>
				<BR>
				Component Description: <BR>
				<textarea name="description" rows="5" cols="40"><?=$arr_component_data["unit_components.description"][0]?></textarea><BR>
				Component Notes: <BR>
				<textarea name="notes" rows="5" cols="40"><?=$arr_component_data["unit_components.notes"][0]?></textarea><BR>
				
				
				Steel Driveshaft Tube OD:&nbsp;<input type='text' name='steel_driveshaft_tube_od' class='field' value="<?=htmlentities($arr_component_data["unit_components.steel_driveshaft_tube_od"][0],ENT_COMPAT)?>"><BR>
				Torque Fuse Options:&nbsp;<input type='text' name='torque_fuse_options' class='field' value="<?=htmlentities($arr_component_data["unit_components.torque_fuse_options"][0],ENT_COMPAT)?>"><BR>
				PTS Series:&nbsp;<input type='text' name='pts_series' class='field' value="<?=htmlentities($arr_component_data["unit_components.pts_series"][0],ENT_COMPAT)?>"><BR>
				Driveline Series:&nbsp;<input type='text' name='driveline_series' class='field' value="<?=htmlentities($arr_component_data["unit_components.driveline_series"][0],ENT_COMPAT)?>"><BR>
				<input type='hidden' name='display_order' value="<?=htmlentities($arr_component_data["unit_components.display_order"][0],ENT_COMPAT)?>">
				<div class="cleaner"></div>
				<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
				<input type="hidden" name="action" value="component_edit">
				<input type="hidden" name="rd" value="<?=$rd?>">
				<input type="hidden" name="pl" value="<?=$pl?>">
				<input type="hidden" name="unit" value="<?=$unit_id?>">
				<input type="hidden" name="part_id" value="<?=$part_id?>">
				<input type="hidden" name="component_id" value="<?=$component_id?>">
			<!--</div>-->
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