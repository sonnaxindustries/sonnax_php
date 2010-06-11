		<? require "includes/inc_toolbar_unit_editing.php";?>
		<div id="scroll">
		<div class='short' style='font-weight:bold;'>Ref. No</div>
		<div class='med' style='font-weight:bold;'>Item</div>
		<div class='med' style='font-weight:bold;'>Part Number</div>
		<div class='long1' style='font-weight:bold;width:380px;'>Description</div>
		<div class='short' style='font-weight:bold;'>&nbsp;</div>
		<div class='line'></div>
	<?
	if (!is_null($part_finder->assembly_stack) && !is_null($part_finder->assembly_stack->stack) && $part_finder->search_state ==2) {
		// Unit/Make search
		
		//need to display non-assembly parts here
		
		while ($assembly = $part_finder->assembly_stack->removeAssembly()) {
			//var_dump($assembly);
			//exit;
			$store_part_number = "9999";
			if ($assembly->indent == 0) {?>
				<div class='line'></div>
				<div class='full'><?=$assembly->assembly?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="system_editor_assembly_name.php?assembly_id=<?=urlencode($assembly->id)?>&rd=<?=urlencode($rd)?>">Edit Name</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_exe.php?action=unit_component_indent&indent=1&component_id=<?=urlencode($assembly->component_id)?>&rd=<?=urlencode($rd)?>">Indent >></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_exe.php?action=assembly_delete&assembly_id=<?=urlencode($assembly->id)?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementAssembly('<?=str_replace("'","",$assembly->assembly)?>')">Delete</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_exe.php?action=assembly_move&direction=up&unit=<?=$_GET['unit']?>&unit_component_id=<?=urlencode($assembly->component_id)?>&rd=<?=urlencode($rd)?>">Move Up</a>&nbsp;&nbsp;|&nbsp;
				&nbsp;<a href="system_editor_exe.php?action=assembly_move&direction=down&unit=<?=$_GET['unit']?>&unit_component_id=<?=urlencode($assembly->component_id)?>
				&rd=<?=urlencode($rd)?>">Move Down</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_search.php?action=assembly_add_part&pl=<?=$part_finder->product_line?>&assembly_id=<?=urlencode($assembly->id)?>&rd=<?=urlencode($rd)?>">Add Part</a></div>
				<? while ($part = $assembly->part_stack->removePart()) {
					$same_part_number = false;
					if ($part->ref_number == 0) {
						$part->ref_number = "";
					}
					//if ($store_part_number == $part->ref_number) {
					//	$same_part_number = true;
					//}
					if ($same_part_number) {
						?><div class='clear'></div>
						  <div class='short'></div><?
					} else {?>
						<div class='line'></div>
						<? if (strlen($part->ref_number) < 1) {
							$link_visualizer = "blank";
						} else {
							$link_visualizer = "";
						}?>
						<div class='short'><a href="system_editor_assembly_ref.php?assembly_id=<?=urlencode($assembly->id)?>&assembly_part_id=<?=urlencode($part->component_id)?>&rd=<?=urlencode($rd)?>"><?=$link_visualizer?><?=$part->ref_number?></a></div><?
					}?>
					<div class='med'><?=$part->item?></div>
					<div class='med'>
						<a href='table_edit.php?t=parts&if=id
								&strLookupField_Names=<?=rawurlencode('product_line')?>
								&strLookupField_Fields=<?=rawurlencode('id,name')?>
								&strLookupField_OrderBys=<?=rawurlencode('name')?>
								&strLookupField_Tables=<?=rawurlencode('product_lines')?>
								&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&rdir=<?=urlencode($rd)?>'><?=$part->part_number?></a>
					</div>
					<div class='long1' style='width:380px;'><?=cp1252_to_utf8($part->description)?></div>
					<div class='short'>
						<? if (strlen($_GET['pl']) > 0 && strlen($_GET['unit']) >0) {?>
						<a href="system_editor_exe.php?action=remove_part_from_assembly&assembly_part_id=<?=$part->component_id/*this is an id from assembly_parts in this case*/?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementAssemblyPart('<?=str_replace("'","",$part->part_number)?>','<?=str_replace("'","",$assembly->assembly)?>')">Remove</a>
						<? }?>
					</div>
					<? $store_part_number = $part->ref_number;
				}
			} elseif ($assembly->indent == 1) {?>
				<div class='line'></div>
				<div class='full_indent'><?=$assembly->assembly?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="system_editor_assembly_name.php?assembly_id=<?=urlencode($assembly->id)?>&rd=<?=urlencode($rd)?>">Edit Name</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_exe.php?action=unit_component_indent&indent=0&component_id=<?=urlencode($assembly->component_id)?>&rd=<?=urlencode($rd)?>"><< Un-Indent</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_exe.php?action=assembly_delete&assembly_id=<?=urlencode($assembly->id)?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementAssembly('<?=str_replace("'","",$assembly->assembly)?>')">Delete</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_exe.php?action=assembly_move&direction=up&unit=<?=$_GET['unit']?>&unit_component_id=<?=urlencode($assembly->component_id)?>&rd=<?=urlencode($rd)?>">Up</a>&nbsp;&nbsp;|&nbsp;
				&nbsp;<a href="system_editor_exe.php?action=assembly_move&direction=down&unit=<?=$_GET['unit']?>&unit_component_id=<?=urlencode($assembly->component_id)?>
				&rd=<?=urlencode($rd)?>">Down</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="system_editor_search.php?action=assembly_add_part&pl=<?=$part_finder->product_line?>&assembly_id=<?=urlencode($assembly->id)?>&rd=<?=urlencode($rd)?>">Add Part</a></div>
				<? while ($part = $assembly->part_stack->removePart()) {
					$same_part_number = false;
					//if ($store_part_number == ("$part->ref_number" . "&nbsp;&nbsp;" . "$part->item")) {
					//	$same_part_number = true;
					//}
					if ($same_part_number) {?>
						<div class='clear'></div>
						<div class='short'></div>
						<div class='med' style='font-weight:bold;'></div><?
					} else {
						?><div class='line'></div>
						<div class='short'></div>
						<? if (strlen($part->ref_number) < 1) {
							$link_visualizer = "blank";
						} else {
							$link_visualizer = "";
						}?>
						<div class='med' style='font-weight:bold;'><a href="system_editor_assembly_ref.php?assembly_id=<?=urlencode($assembly->id)?>&assembly_part_id=<?=urlencode($part->component_id)?>&rd=<?=urlencode($rd)?>"><?=$link_visualizer?><?=$part->ref_number?></a>&nbsp;&nbsp;<?=$part->item?></div><?
					}?>
					<div class='med'>
						<a href='table_edit.php?t=parts&if=id
								&strLookupField_Names=<?=rawurlencode('product_line')?>
								&strLookupField_Fields=<?=rawurlencode('id,name')?>
								&strLookupField_OrderBys=<?=rawurlencode('name')?>
								&strLookupField_Tables=<?=rawurlencode('product_lines')?>
								&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&rdir=<?=urlencode($rd)?>'><?=$part->part_number?></a>
					</div>
					<div class='long1' style='width:380px;'><?=cp1252_to_utf8($part->description)?></div>
					<div class='short'>
						<? if (strlen($_GET['pl']) > 0 && strlen($_GET['unit']) >0) {?>
						<a href="system_editor_exe.php?action=remove_part_from_assembly&assembly_part_id=<?=$part->component_id/*this is an id from assembly_parts in this case*/?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementAssemblyPart('<?=str_replace("'","",$part->part_number)?>','<?=str_replace("'","",$assembly->assembly)?>')">Remove</a>
						<? }?>
					</div>
					<?
					$store_part_number = "$part->ref_number" . "&nbsp;&nbsp;" . "$part->item";
				}
			}
		}
		?>
		<div class='line'></div>
		<div class="cleaner"></div>
		</div>
		<div style="width:778px;height:auto;border:1px solid #3A2574;border-top:0;">
		
		<? if (is_numeric($part_finder->unit_id)) {?>
		<FORM name="ref_figure_form" id="ref_figure_form" method="GET" action="system_editor_exe.php">
		<input type="hidden" name="action" value="update_component_ref_figure_id">
		<input type="hidden" name="unit" value="<?=$part_finder->unit_id?>">
		<input type="hidden" name="rd" value="<?=$rd?>">
		<input type="hidden" name="pl" value="<?=$part_finder->product_line?>">
		<CENTER>Ref Figure: <?
		$arrRefFigureData = getRefFigureData();
		FormObjects::selectBoxRefFigures("ref_figure_id", $arrRefFigureData, $part_finder->unit->refFigure->id, "dropdown"); ?> <input type="submit" name="ref_figure_submit" id="ref_figure_submit" value="Update"></CENTER></FORM>
		<? }?>
		
		<img src="../exploded-views/<?=$part_finder->unit->refFigure->exploded_view_file?>" style="margin-left:auto;margin-right:auto;display:block;">
		</div>
		<div class="cleaner"></div>
		<!--<input type="submit" name="add_to_order" value="ADD TO ORDER" class="submit" style="margin-left:570px;width:106px;">&nbsp;&nbsp;<input type="submit" name="view_order" value="VIEW ORDER" class="submit" style="width:90px;">-->
		<?
	} elseif ( !is_null($part_finder->part_stack) && !is_null($part_finder->part_stack->stack) && $part_finder->search_state ==1 ) {
		// Part search
		$part_stack = $part_finder->part_stack;  						// PartStack object
		while ($part = $part_stack->removePart()) { 					// a part object from the array of parts
			$product_line = new ProductLine($part->product_line);
			?>
			<div class='short'>&nbsp;</div>
			<div class='med'><?=cp1252_to_utf8($part->item)?></div>
			<div class='med'>
				<a href='table_edit.php?t=parts&if=id
						&strLookupField_Names=<?=rawurlencode('product_line')?>
						&strLookupField_Fields=<?=rawurlencode('id,name')?>
						&strLookupField_OrderBys=<?=rawurlencode('name')?>
						&strLookupField_Tables=<?=rawurlencode('product_lines')?>
						&id=<?=$part->id?>&pl=<?=$part_finder->product_line?>&rdir=<?=urlencode($rd)?>'><?=$part->part_number?></a>
			</div>
			<div class='long1' style='width:380px;'><?=cp1252_to_utf8($part->description)?></div>
			<div class='short'>&nbsp;</div>
			<div class='line'></div>
			<?
		}
		?>
		<div class="cleaner"></div>
		</div>
		<div class="cleaner"></div>
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