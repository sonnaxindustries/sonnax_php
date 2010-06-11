		<div class="long">
		<form name='product_line_search' id='product_line_search' method='get' action='part_finder.php' class='form'>
		<div class='label'><strong>Search Product Line:</strong></div>
			<? FormObjects::selectBoxForProductLineReload("pl", $product_lines->displays, $product_lines->values, $part_finder->product_line, "dropdown", "product_line"); ?>
		</form>
		</div>
		<div class='clear'></div>
		<!-- THIS SECTION IS HIDDEN UNTIL PRODUCT LINE HAS BEEN SELECTED -->
		<div class='long' style='width:340px;'>
		<div class='label'><strong>Driveline Series:</strong></div>
		<form name='form_driveline_series' id='form_driveline_series' method='get' action='part_finder.php' class='form'>
			<?
			require_once "includes/classes/clsDrivelines.php";
			$tube_diameter		= new Drivelines();
			FormObjects::selectBox("driveline_series", $tube_diameter->displays, $tube_diameter->values, stripslashes($get["driveline_series"]), "dropdown", "driveline_series"); ?>
			&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</form>
		</div>
		
		<div class='cleaner' style="height:5px;"></div>
		
		<form name='form_tube_diameter' id='form_tube_diameter' method='get' action='part_finder.php' class='form'>
		<div class='long'>
			<div class='label'><strong>Tube Diameter:</strong></div>
			<?
			require_once "includes/classes/clsTubeDiameterDriveline.php";
			$tube_diameter		= new TubeDiameterDriveline();
			FormObjects::selectBox("tube_diameter", $tube_diameter->displays, $tube_diameter->values, stripslashes($get["tube_diameter"]), "dropdown", "tube_diameter"); ?>
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>
		</form>
		
		<div class='long'>
		<form name='form_part_number' id='form_part_number' method='get' action='part_finder.php' class='form'>
			<div class='label'><strong>&nbsp;&nbsp;Part Number Search:</strong></div>
			<input type='text' name='pn' class='field' value='<?=htmlentities(stripslashes($get["pn"]),ENT_QUOTES)?>'>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</form>
		</div>