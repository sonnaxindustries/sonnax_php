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
			<?
			if ($part_finder->product_line == 3) {
				if ($_GET["hide_ts"] == "true") {
					$hide_ts_checked = " CHECKED";
				} else {
					$hide_ts_checked = "";
				}
				if ($_GET["hide_sc"] == "true") {
					$hide_sc_checked = " CHECKED";
				} else {
					$hide_sc_checked = "";
				}
				if ($_GET["hide_tt"] == "true") {
					$hide_tt_checked = " CHECKED";
				} else {
					$hide_tt_checked = "";
				}
				?>
				<div class='label'><strong>Hide Sub-Families:</strong></div>
				TS<input type="checkbox" name="hide_ts" value="true"<?=$hide_ts_checked?>>&nbsp;&nbsp;
				SC<input type="checkbox" name="hide_sc" value="true"<?=$hide_sc_checked?>>&nbsp;&nbsp;
				TT<input type="checkbox" name="hide_tt" value="true"<?=$hide_tt_checked?>>&nbsp;&nbsp;
				<div class="clear"></div>
			<?}?>
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