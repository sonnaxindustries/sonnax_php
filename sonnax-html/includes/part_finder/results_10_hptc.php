		<form method=get action="add_to_quote_cart.php">
		<input type=hidden name='tc' value='1'>
		<input type=hidden name='pl' value='10'>
		<input type=hidden name='component' value='0'>
		<a href="speed_order.php">Speed Order Form</a><BR />
		<BR />
		<div id="scroll">
		<div class='short' style='font-weight:bold;'>Ref. No</div>
		<div class='med' style='font-weight:bold;'>Item</div>
		<div class='med' style='font-weight:bold;'>Part Number</div>
		<div class='long1' style='font-weight:bold;width:380px;'>Description</div>
		<div class='short' style='font-weight:bold;'>QTY</div>
		<div class='line'></div>
	<?
	if (!is_null($part_finder->assembly_stack) && !is_null($part_finder->assembly_stack->stack) && $part_finder->search_state ==2) {
		
		while ($assembly = $part_finder->assembly_stack->removeAssembly()) {
			$store_part_number = "9999";
			if ($assembly->indent == 0) {
				echo "<div class='line'></div>";
				echo "<div class='full'>$assembly->assembly</div>";
				while ($part = $assembly->part_stack->removePart()) {
					$same_part_number = false;
					if ($part->ref_number == 0) {
						$part->ref_number = "";
					}
					if ($store_part_number == $part->ref_number) {
						$same_part_number = true;
					}
					if ($same_part_number) {
						?><div class='clear'></div>
						  <div class='short'></div><?
					} else {
						?><div class='line'></div>
						  <div class='short'><?=$part->ref_number?></div><?
					}
					
					?>
					<div class='med'><?=$part->item?></div>
					<div class='med'><a href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
					<div class='long1' style='width:380px;'><?=cp1252_to_utf8($part->description)?></div>
					<div class='short'><input type='text' name='<?=$part->id?>' class='field'></div>
					
					<?
					$store_part_number = $part->ref_number;
				}
			} elseif ($assembly->indent == 1) {
				echo "<div class='line'></div>";
				echo "<div class='full_indent'>$assembly->assembly</div>";
				while ($part = $assembly->part_stack->removePart()) {
					$same_part_number = false;
					if ($store_part_number == ("$part->ref_number" . "&nbsp;&nbsp;" . "$part->item")) {
						$same_part_number = true;
					}
					if ($same_part_number) {
						?><div class='clear'></div>
						<div class='short'></div>
						<div class='med' style='font-weight:bold;'></div><?
					} else {
						?><div class='line'></div>
						<div class='short'></div>
						<div class='med' style='font-weight:bold;'><?=$part->ref_number?>&nbsp;&nbsp;<?=$part->item?></div><?
					}
					?>
					<div class='med'><a href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
					<div class='long1' style='width:380px;'><?=cp1252_to_utf8($part->description)?></div>
					<div class='short'><input type='text' name='<?=$part->id?>' class='field'></div>
					<?
					$store_part_number = "$part->ref_number" . "&nbsp;&nbsp;" . "$part->item";
				}
			}

		}
		?>
		<div class='line'></div>
		<div class="cleaner"></div>
		</div>
		<div style="width:778px;height:auto;border:1px solid #3A2574;border-top:0;">
		<img src="exploded-views/<?=$part_finder->unit->refFigure->exploded_view_file?>" style="margin-left:auto;margin-right:auto;display:block;"></div>
		<div class="cleaner"></div>
		<!--<input type="submit" name="add_to_order" value="ADD TO ORDER" class="submit" style="margin-left:570px;width:106px;">&nbsp;&nbsp;<input type="submit" name="view_order" value="VIEW ORDER" class="submit" style="width:90px;">-->
		<?
	} elseif ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==1 ) {
		$part_stack = $part_finder->part_stack;  						// PartStack object
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			?>
			<div class='short'>&nbsp;</div>
			<div class='med'><?=cp1252_to_utf8($part->item)?></div>
			<div class='med'><a href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
			<div class='long1' style='width:380px;'><?=cp1252_to_utf8($part->description)?></div>
			<div class='short'><input type='text' name='<?=$part->id?>' class='field'></div>
			<div class='line'></div>
			<?
		}
		?>
		<div class="cleaner"></div>
		</div>
		<div class="cleaner"></div>
		<?
	} else {
		// no parts in the stack
		?>
		<div class="cleaner"></div>
		<div class='long1' style='width:760px;text-align:center;font-weight:bold;font-size:16px;'><?=$part_finder->search_message?></div>
		<div class="cleaner"></div>
		</div>
	<?
	}?>
	
	<input type='submit' name='view_cart' value='VIEW CART' class='submit' style='margin-left:550px;width:100px;'>&nbsp;&nbsp;<input type='submit' name='add_to_order' value='ADD TO CART' class='submit' style='width:100px;'>
	</form>
	<div class="cleaner"></div>