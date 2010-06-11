		<?php
		// This is an HPT search. If a make and unti exist then try to find the mirror unit in TS
		    // Known values provided by the part_finder
		    // $_GET["make"]   is the make id
		    // $_GET["unit"]   is the unit id
		    // $make_name      is the string name of the make
            // $unit_name      is the string name of the unit
            if ( !empty( $_GET["make"] ) && !empty( $GLOBALS['unit_name'] ) ) {
                $tsMirrorUnitId = fetchMirrorUnit( 3/* 3= TS*/, $_GET["make"], $GLOBALS['unit_name'] );
                if ( $tsMirrorUnitId ) {?>
                    <a href="part_finder.php?unit=<?php echo $tsMirrorUnitId;?>&make=<?php echo urlencode($_GET["make"]);?>&pl=3">Go to <?php echo $GLOBALS['unit_name'];?> Transmission Specialties Parts List</a><br /><br />
                <?php }
            }
		?>
		<div id='scroll'><!--pl #1: hpt(s)-->
			<!--
			<form method=get action="add_to_order.php">
			<input type="hidden" name="component" value="0">
			<input type="hidden" name="tc" value="0">
			<input type="hidden" name="pl" value="1">
			-->
			<!-- START OF TITLE ROW -->
			<div class='med_short' style='font-weight:bold;'>Reference<?php //Formerly Product Line?></div>
			<div class='med_short' style='font-weight:bold;'>Part Number</div>
			<div class='long1' style='font-weight:bold;'>Description</div>
			<div class='med_long' style='font-weight:bold;'>Item Notes<!-- Description 2 --></div>
			<div class='short' style='font-weight:bold;'>Make</div>
			<div class='long1' style='font-weight:bold;'>Units</div>
			<!--
			<div class='shortest' style='font-weight:bold;'>Price</div>
			<div class='shortest' style='font-weight:bold;'>Qty</div>
			-->
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
	<?
	if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==2 ) {
	    // Unit/make search
		// we have parts in the stack
		$part_stack = $part_finder->part_stack;// PartStack object
		$counter = 0;
		while ($part = $part_stack->removePart()) { // a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			?>			
			<div class='med_short'><?=$part->ref_code; //$product_line->name?></div>
			<?if ($part_finder_admin == true) {//this may be a relic?>
			<div class='med_short'><a href='table_edit.php?t=parts&if=id&strLookupField_Names=product_line&strLookupField_Fields=id,name&strLookupField_OrderBys=name&strLookupField_Tables=product_lines&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
			<?} else {
				if ($part->new_item == 1) {
					$str_highlighted = "_highlighted";
					$str_highlighted_link = "style='color: #EEEEEE;text-decoration: none;' ";
				} else {
					$str_highlighted = "";//"_".$part->new_item."_";
					$str_highlighted_link = "";
				}?>
			<div class='med_short<?=$str_highlighted?>'><a <?=$str_highlighted_link?>href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
			<?}?>
			<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
			<div class='med_long'><?=cp1252_to_utf8($part->notes)?></div>
			<? 	
			$make = new Make($part_finder->make_id);
			$make_name = $make->make;
			$units = $part->getUnitsContainingPart($make->id);
			$unitsUpperBound = count($units) - 1;
			unset($unitList);
			for ($y=0; $y <= $unitsUpperBound; $y++) {
				$brief_unit = new UnitBrief($units[$y]);
				if ($y < $unitsUpperBound) {
					$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$make->id&pl=$part_finder->product_line'>$brief_unit->name</a>, ";
				} else {
					$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$make->id&pl=$part_finder->product_line'>$brief_unit->name</a>";
				}
			}
			$counter++;
			?>
			<div class='short'><?=$make_name?></div>
			<div class='long1'><?=$unitList?></div>
			<!--
			<div class='shortest'>$<?=number_format($part->price,2)?></div>
			<div class='shortest'><input type="text" name="<?=$part->id?>" class="field"></div>
			-->
			<div class="line"></div>
			<?
		}
	} elseif ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==1 ) {
	    // Part search
		$store_part_id = 0;
		$part_stack = $part_finder->part_stack;  						// PartStack object
		$no_return = $part_stack->sortByPartNumber;
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			$makes = $part->getMakesPartAppliesTo();
			$makesUpperBound = count($makes) - 1;
			//limit the display to one make on the new_only listings
			if ($_GET['new_only'] == "true" && $makesUpperBound > -1) {
				$makesUpperBound = 0;
			}
			for ($x=0; $x <= $makesUpperBound; $x++) {
				?>
				<div class='med_short'><?=$part->ref_code; //$product_line->name?></div>
				<?if ($part_finder_admin == true) {//this may be a relic?>
					<div class='med_short'><a href='table_edit.php?t=parts&if=id&strLookupField_Names=product_line&strLookupField_Fields=id,name&strLookupField_OrderBys=name&strLookupField_Tables=product_lines&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
				<?} else {
					if ($part->new_item == 1) {
						$str_highlighted = "_highlighted";
						$str_highlighted_link = "style='color: #EEEEEE;text-decoration: none;' ";
					} else {
						$str_highlighted = "";//"_".$part->new_item."_";
						$str_highlighted_link = "";
					}?>
					<div class='med_short<?=$str_highlighted?>'><a <?=$str_highlighted_link?>href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&make=<?=$makes[$x]?>&unit='><?=$part->part_number?></a></div>
				<?}?>
				<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
				<div class='med_long'><?=cp1252_to_utf8($part->notes)?></div>
				<?  
				$make = new Make($makes[$x]);
				$make_name = $make->make;
				$units =  $part->getUnitsContainingPart($makes[$x]);
				$unitsUpperBound = count($units) - 1;
				unset($unitList);
				for ($y=0; $y <= $unitsUpperBound; $y++) {
					$brief_unit = new UnitBrief($units[$y]);
					if ($y < $unitsUpperBound) {
						$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$makes[$x]&pl=$part_finder->product_line'>$brief_unit->name</a>, ";
					} else {
						$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$makes[$x]&pl=$part_finder->product_line'>$brief_unit->name</a>";
					}
				}
				?>
				<div class='short'><?=$make_name?></div>
				<div class='long1'><?=$unitList?></div>
				<!--
				<div class='shortest'>$<?=number_format($part->price,2)?></div>
				<div class='shortest'>
				<?
				if ($part->id != $store_part_id) {
				?>
					<input type="text" name="<?=$part->id?>" class="field">
				<?
				}
				?>
				</div>
				-->
				<div class="line"></div>
				<?
				$store_part_id = $part->id;
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
	<!--
	<input type='submit' name='add_to_order' value='ADD TO ORDER' class='submit' style='margin-left:570px;width:106px;'>&nbsp;&nbsp;<input type='submit' name='view_cart' value='VIEW ORDER' class='submit' style='width:90px;'>
	</form> -->