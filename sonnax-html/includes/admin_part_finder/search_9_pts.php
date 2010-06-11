		<div class="long">
		<form name='product_line_search' id='product_line_search' method='get' action='part_finder.php' class='form'>
		<div class='label'><strong>Search Product Line:</strong></div>
			<? FormObjects::selectBoxForProductLineReload("pl", $product_lines->displays, $product_lines->values, $part_finder->product_line, "dropdown", "product_line"); ?>
		</form>
		</div>
		<div class='clear'></div>
		
		<form name='series' id='series' method='get' action='part_finder.php' class='form'>
		<div class="long">
			<div class='label'><strong>Driveline Series:</strong></div>
			<?
			require_once $part_finder_admin_path_adjustment."includes/classes/clsDrivelineSeries.php";
			$driveline_series 		= new DrivelineSeries();
			FormObjects::selectBox("pts_driveline_series", $driveline_series->displays, $driveline_series->values, $_GET["pts_driveline_series"], "dropdown", "pts_driveline_series"); ?>
			&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>
		</form>
		
		<div class='cleaner' style="height:5px;"></div>
	
		<form name='form_tube_diameter' id='form_tube_diameter' method='get' action='part_finder.php' class='form'>
		<div class='long'>
			<div class='label'><strong>Tube Diameter:</strong></div>
			<?
			require_once $part_finder_admin_path_adjustment."includes/classes/clsTubeDiameterPTS.php";
			$tube_diameter		= new TubeDiameterPTS();
			FormObjects::selectBox("tube_diameter", $tube_diameter->displays, $tube_diameter->values, stripslashes($_GET["tube_diameter"]), "dropdown", "tube_diameter"); ?>
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>
		</form>
		
		<form name='part_number' id='part_number' method='get' action='part_finder.php' class='form'>
		<div class="long">
			<div class='label'><strong>&nbsp;&nbsp;Part Number Search:</strong></div>
			<input type='text' name='pn' class='field' value='<?=htmlentities(stripslashes($_GET["pn"]),ENT_QUOTES)?>'>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>	
		</form>
		<?/*
		<form name='form_fuse_options' id='form_fuse_options' method='get' action='part_finder.php' class='form'>
		<div class="long">
			<div class='label'><strong>Torque Fuse Options:</strong></div>
			<?
			require_once $part_finder_admin_path_adjustment."includes/classes/clsTorqueFuseOptions.php";
			$torque_fuse_options 		= new TorqueFuseOptions();
			FormObjects::selectBox("torque_fuse_options", $torque_fuse_options->displays, $torque_fuse_options->values, $_GET["torque_fuse_options"], "dropdown", "torque_fuse_options"); ?>
			&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>
		</form>*/?>