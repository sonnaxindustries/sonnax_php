
		<div class="long">
		<form name='product_line_search' id='product_line_search' method='post' action='' class='form'>
		<div class='label'><strong>Search Product Line:</strong></div>
			<? FormObjects::selectBoxForProductLineReload("pl", $product_lines->displays, $product_lines->values, $part_finder->product_line, "dropdown", "product_line"); ?>
		</form>
		</div>
		<div class="clear"></div>
		
		<form name='form_make_unit' id='form_make_unit' method='post' action='' class='form' onsubmit="submitMakeUnitForm()">
		<div class="long">
			<div class='label'><strong>Make:</strong></div>
			<? FormObjects::selectBoxForMakeReload("make", $makes->displays, $makes->values, $part_finder->make_id, "dropdown", "make"); ?>
		</div>
		<div class="long">
			<?
			if (!empty($part_finder->make_id)) {
				echo "<div class='label'><strong>Unit:</strong></div>\n";
				FormObjects::selectBoxForUnitReload("unit", $unitsBrief->displays, $unitsBrief->values, $part_finder->unit_id, "dropdown", "unit");
				echo "&nbsp;&nbsp;";
				echo "<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>";
			} else {?>
				<input type=hidden name=unit value="">
			<?}
			?>
		</div>
		<input type=hidden name=pl value="<?=$part_finder->product_line?>">		
		
		<div class="clear"></div>
		
		<div class="long" style='width:340px;'>
			<?
			if ($part_finder->product_line == 3) {
				if ($get["show_only_sc"] == "true") {
					$show_sc_checked = " CHECKED";
				} else {
					$show_sc_checked = "";
				}
				if ($get["show_only_tt"] == "true") {
					$show_tt_checked = " CHECKED";
				} else {
					$show_tt_checked = "";
				}
				?>
				<div class='label'><strong>Show Only:</strong></div>
				Tranny Tools&reg;<input type="checkbox" ONCHANGE="reloadPage()" name="show_only_tt" value="true"<?=$show_tt_checked?>>&nbsp;&nbsp;
				Sure Cure&reg;<input type="checkbox" ONCHANGE="reloadPage()" name="show_only_sc" value="true"<?=$show_sc_checked?>>&nbsp;&nbsp;
				<div class="clear"></div>
			<?} else {?>
				<input type=hidden name=show_only_tt value="">
				<input type=hidden name=show_only_sc value="">
			<?}?>
		</div>
		</form>
		<div class="clear"></div>
		<div class="long" style='width:340px;'>
		<form name='form_part_number' id='form_part_number' method='post' action='' class='form' onsubmit='partNumberSearch()'>
			<div class='label'><strong>Part Number Search:</strong></div>
			<input type='text' name='pn' class='field' value='<?=htmlentities(stripslashes($get["pn"]),ENT_QUOTES)?>'>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		</form>
		</div>
		<div class="cleaner"></div>