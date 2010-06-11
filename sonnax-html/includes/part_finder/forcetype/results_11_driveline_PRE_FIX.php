		
		<div id='scroll'>
		<!-- START OF SORT ROW --><!-- images/arrow_up.gif is in image folder -->
			<div class='med'></div>
			<div class='long1'><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
			<div class='long1'><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
			<div class='med'"><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
			<div class='long1'></div>
			<div class='line'></div>
		<!-- END OF SORT ROW -->
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
					<div class='med'><?=$part->part_number?></div>
					<div class='long1'><?=$part->oem_part_number?></div>
					<div class='long1'><?//=$part->something?>UNIT</div>
					<div class='med'><?=$part->tube_diameter?></div>
					<div class='long1'><?=cp1252_to_utf8($part->description)?></div>
					<div class='line'></div>
				<?}
			} else {
				// no parts in the stack
				?>
				<div class="cleaner"></div>
				<div class='long1' style='width:760px;text-align:center;font-weight:bold;font-size:16px;'>No Parts Found</div>
				<?
			}
			?>					
		<!-- REGULAR BAR -->		

	<div class="line"></div>
	</div>
	<div class="cleaner"></div>