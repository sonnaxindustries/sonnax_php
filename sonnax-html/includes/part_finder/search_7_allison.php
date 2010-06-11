<?		if ($_GET["new_only"] == "true" && $part_finder->product_line != 10) {//new part IF?>
<style type="text/css">
<!--
.style1 {color: #024368}
-->
</style>

			<div class="long" style='font-weight:bold;'>
			<span style='color: #024368; font-size: 22px;'>New</span> <span style='color: #3A2773; font-size: 16px;'><?=$title?> 
			<span class="style1">Products</span></span><BR>
			<br />
			This list will change as new product arrives so please check back frequently.
			</div>
<?} else {//new part IF?>
		<div class="long">
		<form name='product_line_search' id='product_line_search' method='get' action='part_finder.php' class='form'>
		<div class='label'><strong>Search Product Line:</strong></div>
			<? FormObjects::selectBoxForProductLineReload("pl", $product_lines->displays, $product_lines->values, $part_finder->product_line, "dropdown", "product_line"); ?>
		</form>
		</div>
		<div class="clear"></div>
		<!-- THIS SECTION IS HIDDEN UNTIL PRODUCT LINE HAS BEEN SELECTED -->
		<form name='pn' id='part_number' method='get' action='part_finder.php' class='form'>
		<div class="long" style='width:340px;'>
			<div class='label'><strong>Search Part Number:</strong></div>
			<input type='text' name='pn' class='field' value='<?=htmlentities(stripslashes($_GET["pn"]),ENT_QUOTES)?>'>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="7">
		</div>
		</form>
		<div class="clear"></div>
		<form name='oem_number' id='oem_number' method='get' action='part_finder.php' class='form'>
		<div class="long" style='width:340px;'>
			<div class='label'><strong>Search OEM Number:</strong></div>
			<input type='text' name='oem_pn' class='field' value='<?=htmlentities(stripslashes($_GET["oem_pn"]),ENT_QUOTES)?>'>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
			<input type=hidden name=pl value="7">
		</div>
		</form>
		<div class="clear"></div>
		<form name='form_unit_id' id='form_unit_id' method='get' action='part_finder.php' class='form'>
		<input type=hidden name="product_line" value="7">
		<div class="long">
			<div class='label'><strong>Unit:</strong></div>
				<? //FormObjects::selectBox("unit", $unitsBrief->displays, $unitsBrief->values, htmlentities(stripslashes($_GET["unit"]),ENT_QUOTES), "dropdown", "unit"); ?>
				<? FormObjects::selectBoxForAllisonUnitReload("unit", $unitsBrief->displays, $unitsBrief->values, htmlentities(stripslashes($_GET["unit"]),ENT_QUOTES), "dropdown", "unit"); ?>
				&nbsp;&nbsp;
				
		</div>
		<input type=hidden name=pl value="<?=$part_finder->product_line?>">
		<!--<input type=hidden name=make value="21"> might need to be 7 or removed entirely -->
		</form>
		<?}// new part IF?>