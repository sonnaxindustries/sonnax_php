		<?
		$url_start .= (($_SERVER['HTTPS'] != '') ? "https://" : "http://"); //get protocol
		$rd = $url_start . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		
		if ($_GET['pl'] == "8" && strlen($_GET['ring_gears_unit_id']) > 0) {
			//ringgears
			$b_add_break = true;?>
			<a href="system_editor_search.php?action=add_part_to_unit&pl=<?=htmlentities($_GET['pl'])?>&unit_id=<?=htmlentities($_GET['ring_gears_unit_id'])?>&rd=<?=urlencode($rd)?>">Add Part to this Unit</a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_unit_name.php?unit=<?=htmlentities($_GET['ring_gears_unit_id'])?>&rd=<?=urlencode($rd)?>">Edit Unit Name</a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_exe.php?action=delete_unit&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['ring_gears_unit_id'])?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementUnit()">Delete this Unit</a>
		<? } elseif ($_GET['pl'] == "11" && strlen($_GET['driveline_series']) > 0 ) {
			//driveline
			$b_add_break = true;?>
			<a href="system_editor_search.php?action=add_part_to_unit&pl=<?=htmlentities($_GET['pl'])?>&unit_id=<?=htmlentities($_GET['driveline_series'])?>&rd=<?=urlencode($rd)?>">Add Part to this Unit</a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_unit_name.php?unit=<?=htmlentities($_GET['driveline_series'])?>&rd=<?=urlencode($rd)?>">Edit Unit Name</a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_exe.php?action=delete_unit&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['driveline_series'])?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementUnit()">Delete this Unit</a>
		<? } elseif (strlen($_GET['pl']) > 0 && strlen($_GET['unit']) > 0 ) {
			$b_add_break = true;?>
			<a href="system_editor_search.php?action=add_part_to_unit&pl=<?=htmlentities($_GET['pl'])?>&unit_id=<?=htmlentities($_GET['unit'])?>&rd=<?=urlencode($rd)?>">Add Part to this Unit</a>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_unit_name.php?unit=<?=htmlentities($_GET['unit'])?>&rd=<?=urlencode($rd)?>">Edit Unit Name</a>
			<? //if (strlen($_GET['make']) > 0 && doesUnitHaveMakeAssigned($_GET['unit'],$_GET['make'])) {?>
			<? if ($_GET['pl'] != "7") {?>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_unit_makes.php?unit=<?=htmlentities($_GET['unit'])?>&rd=<?=urlencode($rd)?>">Edit Unit Makes</a>
			<? }?>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_exe.php?action=delete_unit&pl=<?=htmlentities($_GET['pl'])?>&unit=<?=htmlentities($_GET['unit'])?>&rd=<?=urlencode($rd)?>" onclick="return fVerifyAgreementUnit()">Delete this Unit</a>
			<? if ( $_GET['pl'] == "10") {?>
			&nbsp;&nbsp;|&nbsp;&nbsp;
			<a href="system_editor_assembly_add.php?unit=<?=htmlentities($_GET['unit'])?>&rd=<?=urlencode($rd)?>">Add Assembly</a>
			<? }?>
			<?
			// onclick="return fVerifyAgreement('<?=$strJSSafe_DisplayField?!>','<?=$strTableName?!>')"
		}
		
		if ($b_add_break == true) {
			echo "<BR />\n<BR />\n";
		}
		?>