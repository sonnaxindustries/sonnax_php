		<? require "includes/inc_toolbar_unit_editing.php";?>
		<div id='scroll'>
			<!-- START OF TITLE ROW -->
			<div class='med' style='font-weight:bold;'>Part Number</div>
			<div class='med' style='font-weight:bold;'>OEM Number</div>
			<div class='med_long2' style='font-weight:bold;'>Description</div>
			<? //<div class='med_long2' style='font-weight:bold;'><!!-- Description 2 --!!></div>?>
			<div class='med' style='font-weight:bold;'>Type</div>
			<!--<div class='short' style='font-weight:bold;'>Make</div>-->
			<div class='med2' style='font-weight:bold;'>Units</div>
			<div class='med_long2' style='font-weight:bold;'>&nbsp;</div>
			<div class="line"></div>	
			<!-- END OF TITLE ROW -->
			
			<?
			if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) ) {
				// we have parts in the stack
				$part_stack = $part_finder->part_stack;  						// PartStack object
				while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
					$product_line = new ProductLine($part->product_line);
					?>				
					<div class='med'>
						<a href='table_edit.php?t=parts&if=id
								&strLookupField_Names=<?=rawurlencode('product_line')?>
								&strLookupField_Fields=<?=rawurlencode('id,name')?>
								&strLookupField_OrderBys=<?=rawurlencode('name')?>
								&strLookupField_Tables=<?=rawurlencode('product_lines')?>
								&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a>
					</div>
					<div class='med'><?=$part->oem_part_number?></div>
					<div class='med_long2'><?=cp1252_to_utf8($part->description)?></div>
					<? //<div class='med_long2'><!?=cp1252_to_utf8($part->notes)?!></div>?>
					<div class='med'><?=$part->part_type?></div>
					<?
					$units = $part->getUnitsContainingPart("");//accepts make_id as parameter but we dont want that here because these parts were not put in the unit_makes table
					$unitsUpperBound = count($units) - 1;
					//echo "unitsUpperBound _" . $unitsUpperBound."_<BR>\n";
					unset($unitList);
					for ($y=0; $y <= $unitsUpperBound; $y++) {
						$brief_unit = new UnitBrief($units[$y]);
						if ($y > 0) {
							$unitList .= ", ";
							
						}
						$unitList .= "<a href='part_finder.php?unit=".$units[$y]."&pl=$part_finder->product_line'>$brief_unit->name</a>";
					}?>
					<!--<div class='short'><?//=$product_line->name?></div>-->
					<div class='med2'><?=$unitList?></div>
					<div class='med_long2' style='font-weight:bold;'>
						<? if (strlen($part->part_number) < 1) {
							$link_visualizer = "Part ID ".$part->id;
						} else {
							$link_visualizer = "";
						}?>
						<? if (strlen($_GET['pl']) > 0 && strlen($_GET['unit']) >0) {?>
						<a href="system_editor_exe.php?action=remove_part_from_unit&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['unit'])?>&part_id=<?=$part->id?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementUnitPart('<?=str_replace("'","",$link_visualizer.$part->part_number)?>')">Remove Part From Unit</a>
						<? }?>
					</div>
					<div class='line'></div>
					
				<? }
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