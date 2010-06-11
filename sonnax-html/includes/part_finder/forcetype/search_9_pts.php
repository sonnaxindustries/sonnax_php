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
			require_once "includes/classes/clsDrivelineSeries.php";
			$driveline_series 		= new DrivelineSeries();
			FormObjects::selectBox("pts_driveline_series", $driveline_series->displays, $driveline_series->values, $get["pts_driveline_series"], "dropdown", "pts_driveline_series"); ?>
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
			require_once "includes/classes/clsTubeDiameterPTS.php";
			$tube_diameter		= new TubeDiameterPTS();
			FormObjects::selectBox("tube_diameter", $tube_diameter->displays, $tube_diameter->values, stripslashes($get["tube_diameter"]), "dropdown", "tube_diameter"); ?>
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>
		</form>
		
		<form name='part_number' id='part_number' method='get' action='part_finder.php' class='form'>
		<div class="long">
			<div class='label'><strong>&nbsp;&nbsp;Part Number Search:</strong></div>
			<input type='text' name='pn' class='field' value='<?=htmlentities(stripslashes($get["pn"]),ENT_QUOTES)?>'>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>	
		</form>