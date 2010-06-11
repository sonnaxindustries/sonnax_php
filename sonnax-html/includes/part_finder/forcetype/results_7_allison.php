		<div id='scroll'>
			<!-- START OF SORT ROW --><!-- images/arrow_up.gif is in image folder -->
			<!--
			<div class='med'></div>
			<div class='med'></div>
			<div class='med_long2'></div>
			<div class='med_long2'></div>
			<div class='med'></div>
			<div class='short'></div>
			<div class='med2'><a href='#' style='text-decoration:none;'>Sort<img src="images/arrow_down.gif" height="10" width="14" alt="Sort Down" style="border:0;"></a></div>
			<div class="line"></div>
			-->
			<!-- END OF SORT ROW -->
			<!-- START OF TITLE ROW -->
			<div class='med' style='font-weight:bold;'>Part Number</div>
			<div class='med' style='font-weight:bold;'>OEM Number</div>
			<div class='med_long2' style='font-weight:bold;'>Description</div>
			<div class='med_long2' style='font-weight:bold;'><!-- Description 2 --></div>
			<div class='med' style='font-weight:bold;'>Type</div>
			<!--<div class='short' style='font-weight:bold;'>Make</div>-->
			<div class='med2' style='font-weight:bold;'>Units</div>
			<div class="line"></div>	
			<!-- END OF TITLE ROW -->
			
			<?
			if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) ) {
				// we have parts in the stack
				$part_stack = $part_finder->part_stack;  						// PartStack object
				while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
					$product_line = new ProductLine($part->product_line);
					?>				
					<div class='med'><a href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
					<div class='med'><?=$part->oem_part_number?></div>
					<div class='med_long2'><?=cp1252_to_utf8($part->description)?></div>
					<div class='med_long2'><?=cp1252_to_utf8($part->notes)?></div>
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
					<div class='line'></div>
					
				<?}
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
	<div class="cleaner"></div