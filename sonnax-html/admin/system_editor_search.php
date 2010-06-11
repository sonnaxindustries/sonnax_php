<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";

require_once "../includes/classes/clsPartFinder.php";
require_once "../includes/classes/clsMakes.php";
require_once "../includes/classes/clsUnits.php";
require_once "../includes/classes/clsUnitsBrief.php";
require_once "../includes/classes/clsPart.php";
require_once "../includes/classes/clsProductLine.php";
require_once "../includes/generic_functions.php";

require_once "includes/inc_admin_validate.php";

$message = 			$_GET["message"];
$action = 			$_GET["action"];
$unit_id = 			$_GET["unit_id"];
	if (strlen($unit_id) < 1) {
		$unit_id = 			$_GET["unit"];
	}
$product_line_id = 	$_GET["pl"];
$rd = 				urldecode($_GET["rd"]);
$assembly_id = 		$_GET["assembly_id"];

$product_lines 		= new ProductLines();

if (strlen($_GET["pn"]) > 0) {
	$part_finder 		= new PartFinder($_GET);
	
	$makes 				= new Makes($part_finder->product_line);
	$unitsBrief			= new UnitsBrief($part_finder->product_line,$part_finder->make_id);
	$product_line_obj 	= new ProductLine($part_finder->product_line);
	$title 				= $product_line_obj->name;// ?? not used
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
			<?
			if ($action == "add_part_to_unit") {?>
				<div class="warning">Search for a part to add to unit '<?=getUnitName($unit_id)?>'</div>
				<div class="cleaner"></div>
			<? } elseif ($action == "assembly_add_part") {?>
				<div class="warning">Search for a part to add to assembly '<?=getAssemblyName($assembly_id)?>'</div>
				<div class="cleaner"></div>
			<? }?>
			<form name='product_line_search2' id='product_line_search2' method='get' action='system_editor_search.php' class='form' style="padding-left:50px;">
			<div class="long">
				<div class='label'>Select Product Line:</div>
				<? FormObjects::selectBoxForProductLineNonReload("pl", $product_lines->displays, $product_lines->values, $_GET['pl'], "dropdown", "product_line"); ?>
			</div>
			<div class="cleaner"></div>
			<div class="long">
				<div class='label'>Search Part Number:</div>
				<input type='text' name='pn' class='field' value="<?=htmlentities($_GET['pn'],ENT_COMPAT)?>">&nbsp;&nbsp;
				<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
				<? if ($_GET['pl'] == "2" || $_GET['pl'] == "10") {?>
				&nbsp;&nbsp;<a href="system_editor_search.php?pl=<?=urlencode($product_line_id)?>&unit_id=<?=urlencode($unit_id)?>&assembly_id=<?=urlencode($assembly_id)?>&action=<?=urlencode($action)?>&rd=<?=urlencode($rd)?>&pn=none">View Labels</a>
				<? }?>
				<input type="hidden" name="pl" value="<?=$product_line_id?>">
				<input type="hidden" name="unit_id" value="<?=$unit_id?>">
				<input type="hidden" name="assembly_id" value="<?=$assembly_id?>">
				<input type="hidden" name="action" value="<?=$action?>">
				<input type="hidden" name="rd" value="<?=urlencode($rd)?>">
			</div>
			</form>
			<div class="cleaner"></div>
			
		<div id='scroll'>
			<!-- START OF TITLE ROW -->
			<div class='med' style='font-weight:bold;'>Product Line</div>
			<div class='med_short' style='font-weight:bold;'>Part Number</div>
			<div class='long1' style='font-weight:bold;'>Item</div>
			<div class='long1' style='font-weight:bold;'>Description</div>
			<div class='med_long2' style='font-weight:bold;'>&nbsp;</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
	<?
	if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) ) {
		//part search
		$part_stack = $part_finder->part_stack;  						// PartStack object
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			$makes = $part->getMakesPartAppliesTo();
			$makesUpperBound = count($makes) - 1;
			for ($x=0; $x <= $makesUpperBound; $x++) {
				?>				
				<div class='med'>
					<?
					if ($part->product_line_from_ts_file == "TT") {
						echo "Tranny Tools&trade;";
					} elseif ($part->product_line_from_ts_file == "SC") {
						echo "The Sure Cure&reg;";
					} else {
						echo $product_line->name;
					}
					?>
				</div>
				<div class='med_short'><?=$part->part_number?></div>
				<div class='long1'><?=$part->item?></div>
				<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
				<div class='med_long2' style='font-weight:bold;'><a href="system_editor_exe.php?action=<?=$action?>&pl=<?=$product_line_id?>&unit=<?=$unit_id?>&assembly_id=<?=$assembly_id?>&part_id=<?=$part->id?>&rd=<?=urlencode($rd)?>">Add Part</a></div>
				<div class="line"></div>
				<?
			}
		}
	} else {
		// no parts in the stack
		?>
		<div class="cleaner"></div>
		<div class='long1' style='width:760px;text-align:center;font-weight:bold;font-size:16px;'><?=$part_finder->search_message?></div>
		<?
	}
	?>
	<div class="line"></div>
	</div>
	<div class="cleaner"></div>
			
			
			
			
			
			
			
			
			
			
			
			
			
		</div>
	</div>
	<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>