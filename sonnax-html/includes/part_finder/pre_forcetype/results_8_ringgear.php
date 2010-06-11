	<div id='scroll'>
		<div class='scroll_inner' style='width:1350px'>
			<!--
			<div class='longest'></div>
			<div class='longest'></div>
			<div class='longest'></div>
			<div class='longest'><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
			<div class='shorter'></div>
			<div class='shorter'></div>
			<div class='shorter'></div>
			<div class='shorter'></div>
			<div class='shorter'></div>
			<div class="line"></div>
			-->
			<div class='longest' style='font-weight:bold;'>Part Number</div>
			<div class='longest' style='font-weight:bold;'>Application</div>
			<div class='longest' style='font-weight:bold;'>OEM Number</div>
			<div class='longest' style='font-weight:bold;'>Number of Teeth</div>
			<div class='shorter' style='font-weight:bold;'>O.D.</div>
			<div class='shorter' style='font-weight:bold;'>ID</div>
			<div class='shorter' style='font-weight:bold;'>Pitch</div>
			<div class='shorter' style='font-weight:bold;'>Thick</div>
			<div class='shorter' style='font-weight:bold;'>Chamfer</div>
			<div class="line"></div>
			<?
			if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) ) {
				// we have parts in the stack
				$previous_part_number = "sdfwefuhieunfiwienfwefn";//starting value so we always show the first item
				$part_stack = $part_finder->part_stack;  						// PartStack object
				while ($part = $part_stack->removePart()) { 					// a part object from the array of parts			
					//compare previous part shown with current part to prevent duplicate listings
					if ($previous_part_number == $part->part_number) {
						continue;
					}
					?>
					<div class='longest'><?//<a href='part_summary.php?id=<?=$part->id?!>&pl=<?=$part_finder->product_line?!>&make=<?=$_NEED_SOMETHING_HERE?!>&unit='>?><?=$part->part_number?></a></div>
					<?
					//TJH 2007-04-22
					//not sure that there is any benefit to making these Applications (units) into links
					$units = $part->getUnitsContainingPart("");//accepts make_id as parameter but we dont want that here because these parts were not put in the unit_makes table
					$unitsUpperBound = count($units) - 1;
					//echo "unitsUpperBound _" . $unitsUpperBound."_<BR>\n";
					unset($unitList);
					for ($y=0; $y <= $unitsUpperBound; $y++) {
						$brief_unit = new UnitBrief($units[$y]);
						if ($y > 0) {
							$unitList .= ", ";
							
						}
						$unitList .= "<a href='part_finder.php?ring_gears_unit_id=".$units[$y]."&pl=$part_finder->product_line'>$brief_unit->name</a>";
					}?>
					<div class='longest'><?=$unitList?></div>
					<div class='longest'><?=$part->oem_part_number?></div>
					<div class='longest'><?=$part->no_of_teeth?></div>
					<div class='shorter'><?=$part->outer_diameter?></div>
					<div class='shorter'><?=$part->inner_diameter?></div>
					<div class='shorter'><?=$part->pitch?></div>
					<div class='shorter'><?=$part->thick?></div>
					<div class='shorter'><?=$part->chamfer?></div>
					<div class="line"></div>
					<?
					//store current part number for comparison on next iteration
					$previous_part_number = $part->part_number;
				}
			} else {
				// no parts in the stack
				?>
				<div class="cleaner"></div>
				<div class='long1' style='width:760px;text-align:center;font-weight:bold;font-size:16px;'><?=$part_finder->search_message?></div>
				<?
			}
			?>
		</div><!-- id=scroll_inner -->
	</div><!-- id=scroll -->
	<div class="cleaner"></div>