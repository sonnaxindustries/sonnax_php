<style type="text/css">
<!--
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	color: #024368;
	font-weight: bold;
}

-->
</style>
		
        <link href="style.css" rel="stylesheet" type="text/css" />
<div></div>
        <div> 
		  <p align="left" class="verticalnavbardash">
		    <?php
		// This is a TS search. If a make and unit exist then try to find the mirror unit in HPT
		    // Known values provided by the part_finder
		    // $_GET["make"]   is the make id
		    // $_GET["unit"]   is the unit id
		    // $make_name      is the string name of the make
            // $unit_name      is the string name of the unit
            if ( !empty( $_GET["make"] ) && !empty( $GLOBALS['unit_name'] ) ) {
                $tsMirrorUnitId = fetchMirrorUnit( 1/* 3= HPT*/, $_GET["make"], $GLOBALS['unit_name'] );
                if ( $tsMirrorUnitId ) {?>
		    <a href="part_finder.php?unit=<?php echo $tsMirrorUnitId;?>&make=<?php echo urlencode($_GET["make"]);?>&pl=1">Go to <?php echo $GLOBALS['unit_name'];?> High Performance Transmission Parts List</a><br />
		    <br />
		        <?php }
            }
		?>
		        <a href="TS-valve-body-layouts.html" target="_blank">Valve Body Layouts</a>
	      </p>
</div>
        <div id='scroll'>
  <!-- START OF SORT ROW -->
  <!-- images/arrow_up.gif is in image folder -->
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
			<div class='med_long2' style='font-weight:bold;'>Item Notes<!-- Description 2 --></div>
			<div class='med' style='font-weight:bold;'>Make</div>
			<div class='med2' style='font-weight:bold;width:110px;'>Units</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
	<?
	if ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==2 ) {
		//make/unit search
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
			<?if ($part->new_item == 1) {
				$str_highlighted = "_highlighted";
				$str_highlighted_link = "style='color: #EEEEEE;text-decoration: none;' ";
				//$str_highlighted_link_close = "";
			} else {
				$str_highlighted = "";//"_".$part->new_item."_";
				$str_highlighted_link = "";
				//$str_highlighted_link_close = "";
			}?>
			<div class='med_short<?=$str_highlighted?>'><a <?=$str_highlighted_link?>href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>'><?=$part->part_number?></a></div>
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
				if ($y < $unitsUpperBound) {
					$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$make->id&pl=$part_finder->product_line'>$brief_unit->name</a>, ";
				} else {
					$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$make->id&pl=$part_finder->product_line'>$brief_unit->name</a>";
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
			//limit the display to one make on the new_only listings
			if ($_GET['new_only'] == "true" && $makesUpperBound > -1) {
				$makesUpperBound = 0;
			}
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
				<?if ($part->new_item == 1) {
					$str_highlighted = "_highlighted";
					$str_highlighted_link = "style='color: #EEEEEE;text-decoration: none;' ";
				} else {
					$str_highlighted = "";//"_".$part->new_item."_";
					$str_highlighted_link = "";
				}?>
				<div class='med_short<?=$str_highlighted?>'><a <?=$str_highlighted_link?>href='part_summary.php?id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&make=<?=$makes[$x]?>&unit='><?=$part->part_number?></a></div>
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
					if ($y < $unitsUpperBound) {
						$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$makes[$x]&pl=$part_finder->product_line'>$brief_unit->name</a>, ";
					} else {
						$unitList .= "<a href='part_finder.php?unit=$brief_unit->id&make=$makes[$x]&pl=$part_finder->product_line'>$brief_unit->name</a>";
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