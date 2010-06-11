		
		<div id='scroll'>
			<div class='scroll_inner'>
				<!-- START OF SORT ROW --><!-- images/arrow_up.gif is in image folder -->
					<!--
					<div class='longest'></div>
					<div class='longest'><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
					<div class='longest'><a href='#' style='text-decoration:none;'>Sort<img src='images/arrow_down.gif' height='10' width='14' alt='Sort Down' style='border:0;'></a></div>
					<div class='longest'></div>
					<div class='longest'></div>
					<div class='longest'></div>
					<div class='longest'></div>
					<div class="line"></div>
					-->
				<!-- END OF SORT ROW -->
				<!-- START OF TITLE ROW -->
					<div class='short5' style='font-weight:bold;'>Part Number</div>
					<div class='short5' style='font-weight:bold;'>Driveline Series</div>
					<div class='short5' style='font-weight:bold;'>Steel Driveshaft<br>Tube O.D.</div>
					<div class='longest' style='font-weight:bold;'>Description</div>
					<div class='longest' style='font-weight:bold;'>Torque Fuse Options</div>
					<div class='longest' style='font-weight:bold;'>PTS Series</div>
					<div class='longest' style='font-weight:bold;'>Notes</div>
					<div class="line"></div>
				<!-- END OF TITLE ROW -->
				<!-- REGULAR BAR -->		
					<?
					$arr_data = $part_finder->partStackSetupPTSLine();
					if (is_array($arr_data)) {
						$int_num_data = count($arr_data["parts.id"])-1;
						for ($x=0;$x<=$int_num_data;$x++) {?>
							<div class='short5'><a href='part_summary.php?id=<?=$arr_data["parts.id"][$x]?>&ucid=<?=$arr_data["unit_components.id"][$x]?>&pl=<?=$part_finder->product_line?>'><?=$arr_data["parts.part_number"][$x]?></a></div>
							<div class='short5'><?=$arr_data["unit_components.driveline_series"][$x]?></div>
							<div class='short5'><?=$arr_data["unit_components.steel_driveshaft_tube_od"][$x]?></div>
							<div class='longest'><?=cp1252_to_utf8($arr_data["unit_components.description"][$x])?></div>
							<div class='longest'><?=$arr_data["unit_components.torque_fuse_options"][$x]?></div>
							<div class='longest'><?=$arr_data["unit_components.pts_series"][$x]?></div>
							<div class='longest'><?=cp1252_to_utf8($arr_data["unit_components.notes"][$x])?></div>
							<div class="line"></div>
						<?}
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
			</div><!-- id=scroll_inner -->
			<div class="cleaner"></div>
		</div><!-- id=scroll -->
		<div class="cleaner"></div>