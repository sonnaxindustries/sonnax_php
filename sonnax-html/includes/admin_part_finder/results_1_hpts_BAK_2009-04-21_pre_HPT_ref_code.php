		<? require "includes/inc_toolbar_unit_editing.php";?>
		<div id='scroll'>		
			<!-- START OF TITLE ROW -->
			<div class='med_short' style='font-weight:bold;'>Product Line</div>
			<div class='med_short' style='font-weight:bold;'>Part Number</div>
			<div class='long1' style='font-weight:bold;'>Description</div>
			<? //<div class='med_long' style='font-weight:bold;'><!-- Description 2 --></div>?>
			<div class='short' style='font-weight:bold;'>Make</div>
			<div class='short' style='font-weight:bold;'>Units</div>
			<div class='shortest' style='font-weight:bold;'>Price</div>
			<div class='med_long' style='font-weight:bold;'>&nbsp;</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
	<?
	if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==2 ) {
		// Unit/Make search
		// we have parts in the stack
		$part_stack = $part_finder->part_stack;// PartStack object
		$counter = 0;
		while ($part = $part_stack->removePart()) { // a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			?>			
			<div class='med_short'><?=$product_line->name?></div>
			<div class='med_short'>
				<a href='table_edit.php?t=parts&if=id
						&strLookupField_Names=<?=rawurlencode('product_line')?>
						&strLookupField_Fields=<?=rawurlencode('id,name')?>
						&strLookupField_OrderBys=<?=rawurlencode('name')?>
						&strLookupField_Tables=<?=rawurlencode('product_lines')?>
						&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a>
			</div>
			<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
			<? //<div class='med_long'><!?=cp1252_to_utf8($part->notes)?!></div>?>
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
			<div class='short'><?=$unitList?></div>
			<div class='shortest'>$<?=number_format($part->price,2)?></div>
			<div class='med_long'>
				<? if (strlen($_GET['pl']) > 0 && strlen($_GET['unit']) >0) {?>
				<a href="system_editor_exe.php?action=remove_part_from_unit&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['unit'])?>&part_id=<?=$part->id?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementUnitPart('<?=str_replace("'","",$link_visualizer.$part->part_number)?>')">Remove From Unit</a>
				<? }?>
			</div>
			<div class="line"></div>
			<?
		}
	} elseif ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==1 ) {
		// Part Search
		$part_stack = $part_finder->part_stack;  						// PartStack object
		$no_return = $part_stack->sortByPartNumber;
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			$makes = $part->getMakesPartAppliesTo();
			$makesUpperBound = count($makes) - 1;
			if ($makesUpperBound > -1) {
				$b_makes_found = true;
			} else {
				$b_makes_found = false;
				$makesUpperBound = 0; //this causes the part to be displayed but without unit data
			}
			for ($x=0; $x <= $makesUpperBound; $x++) {
				?>
				<div class='med_short'><?=$product_line->name?></div>
				<div class='med_short'>
					<a href='table_edit.php?t=parts&if=id
							&strLookupField_Names=<?=rawurlencode('product_line')?>
							&strLookupField_Fields=<?=rawurlencode('id,name')?>
							&strLookupField_OrderBys=<?=rawurlencode('name')?>
							&strLookupField_Tables=<?=rawurlencode('product_lines')?>
							&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&make=<?=$makes[$x]?>'><?=$part->part_number?></a>
				</div>
				<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
				<? //<div class='med_long'><!?=cp1252_to_utf8($part->notes)?!></div>?>
				<?
				if ($b_makes_found == true) {
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
				} else {
					$unitList = "None";
				}?>
				<div class='short'><?=$make_name?></div>
				<div class='short'><?=$unitList?></div>
				<div class='shortest'>$<?=number_format($part->price,2)?></div>
				<div class='med_long'>&nbsp;</div>
				<div class="line"></div>
				<?
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