		<div id='scroll'>
			<!-- START OF SORT ROW --><!-- images/arrow_up.gif is in image folder -->
			<!--
			<div class='med'></div>
			<div class='med_short'><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
			<div class='long1'></div>
			<div class='med_long2'></div>
			<div class='med'><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
			<div class='med_long'><a href='#' style='text-decoration:none;'>Sort<img src="images/arrow_down.gif" height="10" width="14" alt="Sort Down" style="border:0;"></a></div>
			<div class="line"></div>
			-->
			<!-- END OF SORT ROW -->
			<!-- START OF TITLE ROW -->
			<div class='med' style='font-weight:bold;'>Product Line</div>
			<div class='med_short' style='font-weight:bold;'>Part Number</div>
			<div class='long1' style='font-weight:bold;'>Description</div>
			<div class='med_long2' style='font-weight:bold;'><!-- Description 2 --></div>
			<div class='med' style='font-weight:bold;'>Make</div>
			<div class='med2' style='font-weight:bold;width:110px;'>Units</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
	<?
	if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==2 ) {
		// we have parts in the stack
		$part_stack = $part_finder->part_stack;  				// PartStack object
		while ($part = $part_stack->removePart()) { 			// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			?>			
			<div class='med'>
				<?
				if ($part->product_line_from_ts_file == "TT") {
					echo "Tranny Tools&trade;";
				} elseif ($part->product_line_from_ts_file == "SC") {
					echo "The Sure Cure&reg;";
				} else {
					echo $product_line->name;
				}
				?>
			</div>
			<div class='med_short'><a href='<?=$global_site_url?>/part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
			<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
			<div class='med_long2'><?=cp1252_to_utf8($part->notes)?></div>
			<? 	
			$make = new Make($part_finder->make_id);
			$make_name = $make->make;
			$units = $part->getUnitsContainingPart($make->id);
			$unitsUpperBound = count($units) - 1;
			unset($unitList);
			for ($y=0; $y <= $unitsUpperBound; $y++) {
				$brief_unit = new UnitBrief($units[$y]);
				
				$unitList .= "<a href='".$global_site_url."/part_finder/uni".$brief_unit->id."/mak".$make->id."/pli".$part_finder->product_line."/'>$brief_unit->name</a>";
				if ($y < $unitsUpperBound) {
					$unitList .= ", ";
				}
			}
			?>
			<div class='med'><?=$make_name?></div>
			<div class='med2' style='width:110px;'><?=$unitList?></div>
			<div class="line"></div>
			<?
		}
	} elseif ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==1 ) {
		//part search
		$part_stack = $part_finder->part_stack;  						// PartStack object
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			$makes = $part->getMakesPartAppliesTo();
			$makesUpperBound = count($makes) - 1;
			for ($x=0; $x <= $makesUpperBound; $x++) {
				?>				
				<div class='med'>
					<?
					if ($part->product_line_from_ts_file == "TT") {
						echo "Tranny Tools&trade;";
					} elseif ($part->product_line_from_ts_file == "SC") {
						echo "The Sure Cure&reg;";
					} else {
						echo $product_line->name;
					}
					?>
				</div>
				<div class='med_short'><a href='<?=$global_site_url?>/part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&make=<?=$makes[$x]?>&unit='><?=$part->part_number?></a></div>
				<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
				<div class='med'><?=cp1252_to_utf8($part->notes)?></div>
				<?  
				$make = new Make($makes[$x]);
				$make_name = $make->make;
				$units =  $part->getUnitsContainingPart($makes[$x]);
				$unitsUpperBound = count($units) - 1;
				unset($unitList);
				for ($y=0; $y <= $unitsUpperBound; $y++) {
					$brief_unit = new UnitBrief($units[$y]);
					$unitList .= "<a href='".$global_site_url."/part_finder/uni".$brief_unit->id."/mak".$makes[$x]."/pli".$part_finder->product_line."/'>$brief_unit->name</a>";
					if ($y < $unitsUpperBound) {
						$unitList .= ", ";
					}
				}
				?>
				<div class='med'><?=$make_name?></div>
				<div class='med2' style='width:110px;'><?=$unitList?></div>
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