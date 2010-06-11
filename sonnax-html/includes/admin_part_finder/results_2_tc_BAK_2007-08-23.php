	<? require "includes/inc_toolbar_unit_editing.php";?>
	<div id="scroll">
	<?
	if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==2 ) {
		// Unit/Make search?>
		<!-- START OF TITLE ROW - THIS IS LEFT ALONE -->
		<div class='short' style='font-weight:bold;'>Ref. No</div>
		<div class='long1' style='font-weight:bold;'>Item</div>
		<div class='long2' style='font-weight:bold;'>Description</div>
		<div class='med' style='font-weight:bold;'>Part Number</div>
		<div class='short' style='font-weight:bold;'>&nbsp;</div>
		<!-- END OF TITLE ROW -->
		<?
		$part_stack = $part_finder->part_stack;
		$store_part_number = "9999";
		
		while ($part = $part_stack->removePart()) {
			//if ($part->component_id == 8694) {
			//var_dump($part);
			//exit;
			//}
			$same_part_number = false;
			// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);// ?? never used ??
			//if ($store_part_number == $part->ref_number) {
			//	$same_part_number = true;
			//}
			if ($same_part_number == true) {
				?><div class='clear'></div>
				  <div class='short'></div><?
			} else {?>
				<div class='line'></div>
				  <div class='short'>
					<? if (strlen($part->ref_number) < 1) {
						$link_visualizer = "none";
					} else {
						$link_visualizer = "";
					}?>
				  	<a href="system_editor_component_edit.php?component_id=<?=htmlentities($part->component_id)?>&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['unit'])?>&part_id=<?=$part->id?>&rd=<?=urlencode($rd)?>"><?=$link_visualizer?><?=$part->ref_number?></a>
				</div>
			<? }?>		
			<div class='long1a'><strong><?=$part->item?></strong></div>
			<div class='long2'><?=cp1252_to_utf8($part->tc_description)?></div>
			<div class='med'>
				<? if (strlen($part->part_number) < 1) {
					$link_visualizer = "none";
				} else {
					$link_visualizer = "";
				}?>
				<a href='table_edit.php?t=parts&if=id
						&strLookupField_Names=<?=rawurlencode('product_line')?>
						&strLookupField_Fields=<?=rawurlencode('id,name')?>
						&strLookupField_OrderBys=<?=rawurlencode('name')?>
						&strLookupField_Tables=<?=rawurlencode('product_lines')?>
						&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$link_visualizer?><?=$part->part_number?></a>
			</div>
			<div class='short'>
				<? if (strlen($_GET['pl']) > 0 && strlen($_GET['unit']) >0) {?> 
				<a href="system_editor_exe.php?action=remove_part_from_unit&component_id=<?=htmlentities($part->component_id)?>&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['unit'])?>&part_id=<?=$part->id?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementUnitPart('<?=str_replace("'","",$link_visualizer.$part->part_number)?>')">Remove</a>
				<? }?>
			</div>
			<?
			$units = $part->getUnitsContainingPart($part_finder->make_id);
			$unitsUpperBound = count($units) - 1;
			unset($unitList);
			for ($y=0; $y <= $unitsUpperBound; $y++) {
				$brief_unit = new UnitBrief($units[$y]);
				if ($y < $unitsUpperBound) {
					$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=".$part_finder->make_id."&pl=$part_finder->product_line'>$brief_unit->name</a>, ";
				} else {
					$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=".$part_finder->make_id."&pl=$part_finder->product_line'>$brief_unit->name</a>";
				}
			}

			$store_part_number = $part->ref_number;
			
		}
		?>
		<div class='line'></div>

		<div class="cleaner"></div>
		</div>
		<div style="width:778px;height:auto;border:1px solid #3A2574;border-top:0;">
		<img src="../exploded-views/<?=$part_finder->unit->refFigure->exploded_view_file?>" style="margin-left:auto;margin-right:auto;display:block;"></div>
		<div class="cleaner"></div>
		<!--<input type="submit" name="add_to_order" value="ADD TO ORDER" class="submit" style="margin-left:570px;width:106px;">&nbsp;&nbsp;<input type="submit" name="view_order" value="VIEW ORDER" class="submit" style="width:90px;">-->
		<?
	} elseif ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state == 1 ) {
			// Part Search?>
			<!-- START OF TITLE ROW -->
			<div class='med_short' style='font-weight:bold;'>Part Number</div>
			<div class='med_long' style='font-weight:bold;'>Item</div>
			<div class='long1' style='font-weight:bold;'>Description</div>
			<div class='med' style='font-weight:bold;'>Make</div>
			<div class='long1' style='font-weight:bold;'>Units</div>
			<div class='short' style='font-weight:bold;'>&nbsp;</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
			<?
		$part_stack = $part_finder->part_stack;  						// PartStack object
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			//$product_line = new ProductLine($part->product_line);// ?? never used ??
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
				<div class='med_short'>
					<? if (strlen($part->part_number) < 1) {
						$link_visualizer = "none";
					} else {
						$link_visualizer = "";
					}?>
					<a href='table_edit.php?t=parts&if=id
							&strLookupField_Names=<?=rawurlencode('product_line')?>
							&strLookupField_Fields=<?=rawurlencode('id,name')?>
							&strLookupField_OrderBys=<?=rawurlencode('name')?>
							&strLookupField_Tables=<?=rawurlencode('product_lines')?>
							&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&make=<?=$makes[$x]?>'><?=$link_visualizer?><?=$part->part_number?></a>
				</div>
				<div class='med_long'><?=$part->item?></div>
				<div class='long1'><?=$part->description?></div>
				<?
				if ($b_makes_found == true) {
					$make = new Make($makes[$x]);
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
				<div class='med'><?=$make->make?></div>
				<div class='long1'><?=$unitList?></div>
				<div class='short'>&nbsp;</div>
				<div class="line"></div>
				<?
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
