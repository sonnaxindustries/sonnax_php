	<a href="speed_order.php">Speed Order Form </a>&nbsp;&nbsp;&nbsp;&nbsp;
    <A HREF="mailto:tcnew@sonnax.com?subject=New Torque Converter Product Request">Request New Parts</a>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="details.pdf"> Details Section</a><BR />
	<BR />
	<div id="scroll">
	<form method=get action="add_to_quote_cart.php">
	<input type=hidden name='tc' value='1'>
	<input type=hidden name='pl' value='2'>
	<?
	if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==2 ) {
		?>
		<input type=hidden name='component' value='1'>
		<!-- START OF TITLE ROW - THIS IS LEFT ALONE -->
		<div class='short' style='font-weight:bold;'>Ref. No</div>
		<div class='long1' style='font-weight:bold;'>Item</div>
		<div class='long2' style='font-weight:bold;'>Description</div>
		<div class='med' style='font-weight:bold;'>Part Number</div>
		<div class='short' style='font-weight:bold;'>QTY</div>
		<!-- END OF TITLE ROW -->
		<?
		$part_stack = $part_finder->part_stack;
		$store_part_number = "9999";

		while ($part = $part_stack->removePart()) {
			$same_part_number = false;
			// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
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
			<div class='long1'><strong><?=$part->item?></strong></div>
			<div class='long2'><?=cp1252_to_utf8($part->tc_description)?></div>
			<?if ($part->new_item == 1) {
				$str_highlighted = "_highlighted";
				$str_highlighted_link = "style='color: #EEEEEE;text-decoration: none;' ";
			} else {
				$str_highlighted = "";//"_".$part->new_item."_";
				$str_highlighted_link = "";
			}?>
			<div class='med<?=$str_highlighted?>'><a <?=$str_highlighted_link?>href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
			<div class='short'>
			<?
			if (strlen($part->part_number) > 0) {
			?>
				<input type='text' name='<?=$part->component_id?>' class='field'>
			<? 	
			}
			?>
			</div>
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

			$store_part_number = $part->ref_number;
			
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
	} elseif ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state == 1 ) {
			?>
			<input type=hidden name='component' value='0'>
			<!-- START OF TITLE ROW -->
			<div class='med_short' style='font-weight:bold;'>Part Number</div>
			<div class='med_long' style='font-weight:bold;'>Item</div>
			<div class='long1' style='font-weight:bold;'>Description</div>
			<div class='med' style='font-weight:bold;'>Make</div>
			<div class='long1' style='font-weight:bold;'>Units</div>
			<div class='short' style='font-weight:bold;'>QTY</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
			<?
		$part_stack = $part_finder->part_stack;  						// PartStack object
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			$makes = $part->getMakesPartAppliesTo();
			$makesUpperBound = count($makes) - 1;
			//limit the display to one make on the new_only listings
			if ($_GET['new_only'] == "true" && $makesUpperBound > -1) {
				$makesUpperBound = 0;
			}
			for ($x=0; $x <= $makesUpperBound; $x++) {
				if ($part->new_item == 1) {
					$str_highlighted = "_highlighted";
					$str_highlighted_link = "style='color: #EEEEEE;text-decoration: none;' ";
				} else {
					$str_highlighted = "";//"_".$part->new_item."_";
					$str_highlighted_link = "";
				}?>			
				<div class='med_short<?=$str_highlighted?>'><a <?=$str_highlighted_link?>href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&make=<?=$makes[$x]?>&unit='><?=$part->part_number?></a></div>
				<div class='med_long'><?=$part->item?></div>
				<div class='long1'><?=$part->description?></div>
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
				<div class='med'><?=$make_name?></div>
				<div class='long1'><?=$unitList?></div>
				<div class='short'>
				<? 
				if ($part->id != $store_part_id) {
				?>
					<input type='text' name='<?=$part->id?>' class='field'>
				<?
				}?>
				</div>
				<div class="line"></div>
				<?
				$store_part_id = $part->id;
			}
		}
		?>
		<div class="cleaner"></div>
		</div>
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
	<div class="cleaner"></div>
	<input type='submit' name='view_cart' value='VIEW CART' class='submit' style='margin-left:550px;width:100px;'>&nbsp;&nbsp;<input type='submit' name='add_to_order' value='ADD TO CART' class='submit' style='width:100px;'>
	</form>
	<div class="cleaner"></div>