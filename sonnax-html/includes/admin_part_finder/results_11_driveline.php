		<? require "includes/inc_toolbar_unit_editing.php";?>	
		<div id='scroll'>
		<!-- START OF TITLE ROW -->
			<div class='med' style='font-weight:bold;'>Part Number</div>
			<div class='long1' style='font-weight:bold'>Industry Number</div>
			<div class='long1' style='font-weight:bold;'>Driveline Series</div>
			<div class='med' style='font-weight:bold;'>Tube Diameter</div>
			<div class='long1' style='font-weight:bold;'>Description</div>
			<div class='line'></div>
		<!-- END OF TITLE ROW -->
		<!-- REGULAR BAR -->		
			<?
			if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) ) {
				// we have parts in the stack
				$part_stack = $part_finder->part_stack;  				// PartStack object
				while ($part = $part_stack->removePart()) { 			// a part object from the array of parts
					$product_line = new ProductLine($part->product_line);
					?>	
					<div class='med'>
						<a href='table_edit.php?t=parts&if=id
								&strLookupField_Names=<?=rawurlencode('product_line')?>
								&strLookupField_Fields=<?=rawurlencode('id,name')?>
								&strLookupField_OrderBys=<?=rawurlencode('name')?>
								&strLookupField_Tables=<?=rawurlencode('product_lines')?>
								&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a><BR />
					<? if (strlen($_GET['driveline_series']) > 0) {?> 
					<BR /><a href="system_editor_exe.php?action=remove_part_from_unit&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['driveline_series'])?>&part_id=<?=$part->id?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementUnitPart('<?=str_replace("'","",$link_visualizer.$part->part_number)?>')">Remove</a>
					<? }?>
					</div>
					<div class='long1'><?=$part->oem_part_number?></div>
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
						$unitList .= "<a href='part_finder.php?driveline_series=".$units[$y]."&pl=$part_finder->product_line'>$brief_unit->name</a>";
					}?>
					<div class='long1'><?=$unitList?></div>
					<div class='med'><?=$part->tube_diameter?></div>
					<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
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
		<!-- REGULAR BAR -->		

	<div class="line"></div>
	</div>
	<div class="cleaner"></div>