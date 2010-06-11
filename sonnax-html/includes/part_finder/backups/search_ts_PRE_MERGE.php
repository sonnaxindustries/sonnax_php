		<div class="long">
		<form name='product_line_search' id='product_line_search' method='get' action='part_finder.php' class='form'>
		<div class='label'><strong>Search Product Line:</strong></div>
			<? FormObjects::selectBoxForProductLineReload("pl", $product_lines->displays, $product_lines->values, $part_finder->product_line, "dropdown", "product_line"); ?>
		</form>
		</div>
		<div class="cleaner"></div>
		<!-- THIS SECTION IS HIDDEN UNTIL PRODUCT LINE HAS BEEN SELECTED -->
		<form name='part_number' id='part_number' method='get' action='part_finder.php' class='form'>
		<div class="long" style='width:340px;'>
			<div class='label'><strong>Search Part Number:</strong></div>
			<input type='text' name='pn' class='field' value='<?=htmlentities(stripslashes($_GET["pn"]),ENT_QUOTES)?>'>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</div>
		</form>
		<div class="cleaner"></div>
		<form name='form_make_unit' id='form_make_unit' method='get' action='part_finder.php' class='form'>
		<div class="long">
			<div class='label'><strong>Make:</strong></div>
				<? FormObjects::selectBoxForMakeReload("make", $makes->displays, $makes->values, $part_finder->make_id, "dropdown", "make"); ?>
				
		</div>
		<div class="long">
			<?
			if (!empty($part_finder->make_id)) {
				echo "<div class='label'><strong>Unit:</strong></div>\n";
				FormObjects::selectBox("unit", $unitsBrief->displays, $unitsBrief->values, $part_finder->unit_id, "dropdown", "unit");
				echo "&nbsp;&nbsp;";
				echo "<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>";
			}
			?>
		</div>
		<input type=hidden name=pl value="<?=$part_finder->product_line?>">		
		</form>