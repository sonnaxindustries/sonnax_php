		<? require "includes/inc_toolbar_unit_editing.php";?>	
		<div id='scroll'>
			<div class='scroll_inner'>
				<!-- START OF TITLE ROW -->
					<div class='longest' style='font-weight:bold;'>Part Number</div>
					<div class='longest' style='font-weight:bold;'>Driveline Series</div>
					<div class='longest' style='font-weight:bold;'>Steel Driveshaft<br>Tube O.D.</div>
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
							<div class='longest'>
								<?
								if (strlen($arr_data["unit_components.id"][$x]) < 1) {
									$component_id_temp = 0;
									$edit_description_temp = "New Data";
								} else {
									$component_id_temp = $arr_data["unit_components.id"][$x];
									$edit_description_temp = "Edit Data";
								}
								?>
								<a href="system_editor_pts_component_edit.php?component_id=<?=htmlentities($component_id_temp)?>&pl=<?=htmlentities($_GET['pl'])?>&part_id=<?=$arr_data["parts.id"][$x]?>&rd=<?=urlencode($rd)?>"><?=$edit_description_temp?></a>
								&nbsp;&nbsp;|&nbsp;&nbsp;
								<a href='table_edit.php?t=parts&if=id
										&strLookupField_Names=<?=rawurlencode('product_line')?>
										&strLookupField_Fields=<?=rawurlencode('id,name')?>
										&strLookupField_OrderBys=<?=rawurlencode('name')?>
										&strLookupField_Tables=<?=rawurlencode('product_lines')?>
										&id=<?=$arr_data["parts.id"][$x]?>&pl=<?=$part_finder->product_line?>&ucid=<?=$arr_data["unit_components.id"][$x]?>'><?=$arr_data["parts.part_number"][$x]?></a>
								
								
							</div>
							<div class='longest'><?=$arr_data["unit_components.driveline_series"][$x]?></div>
							<div class='longest'><?=$arr_data["unit_components.steel_driveshaft_tube_od"][$x]?></div>
							<div class='longest'><?=cp1252_to_utf8($arr_data["unit_components.description"][$x])?></div>
							<div class='longest'><?=$arr_data["unit_components.torque_fuse_options"][$x]?></div>
							<div class='longest'><?=$arr_data["unit_components.pts_series"][$x]?></div>
							<div class='longest'><?=cp1252_to_utf8($arr_data["unit_components.notes"][$x])?></div>
							<div class="line"></div>
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
			</div><!-- id=scroll_inner -->
			<div class="cleaner"></div>
		</div><!-- id=scroll -->
		<div class="cleaner"></div>