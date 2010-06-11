<?php
/**
 * Finds a mirror unit for a TS unit in the HTP or vice versa
 *
 * @param integer $mirror_product_line
 * @param integer $make_id
 * @param string $unit_name
 * @return integer
 */
function fetchMirrorUnit( $mirror_product_line, $make_id, $unit_name)
{
	$dataconn = new DataConn("");
	
	$sql = "
		SELECT 
			`units`.`id` 
		FROM `units` 
			LEFT JOIN `unit_makes` ON `units`.`id` = `unit_makes`.`unit_id` 
		WHERE `units`.`product_line` = '" . mysql_real_escape_string($mirror_product_line) . "' 
			AND `units`.`name` = '" . mysql_real_escape_string($unit_name) . "' 
			AND `unit_makes`.`make_id` = '" . mysql_real_escape_string($make_id) . "'";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
	    // A matching unit name was found so return the unit id
	    // With the query above it should only ever be poosible to return a single record
		return $arr_data['units.id'][0];
	} else {
		return null;
	}
}


function cp1252_to_utf8($str) {
	$cp1252_map = array(
	    "\xc2\x80" => "\xe2\x82\xac", /* EURO SIGN */
	    "\xc2\x82" => "\xe2\x80\x9a", /* SINGLE LOW-9 QUOTATION MARK */
	    "\xc2\x83" => "\xc6\x92",     /* LATIN SMALL LETTER F WITH HOOK */
	    "\xc2\x84" => "\xe2\x80\x9e", /* DOUBLE LOW-9 QUOTATION MARK */
	    "\xc2\x85" => "\xe2\x80\xa6", /* HORIZONTAL ELLIPSIS */
	    "\xc2\x86" => "\xe2\x80\xa0", /* DAGGER */
	    "\xc2\x87" => "\xe2\x80\xa1", /* DOUBLE DAGGER */
	    "\xc2\x88" => "\xcb\x86",     /* MODIFIER LETTER CIRCUMFLEX ACCENT */
	    "\xc2\x89" => "\xe2\x80\xb0", /* PER MILLE SIGN */
	    "\xc2\x8a" => "\xc5\xa0",     /* LATIN CAPITAL LETTER S WITH CARON */
	    "\xc2\x8b" => "\xe2\x80\xb9", /* SINGLE LEFT-POINTING ANGLE QUOTATION */
	    "\xc2\x8c" => "\xc5\x92",     /* LATIN CAPITAL LIGATURE OE */
	    "\xc2\x8e" => "\xc5\xbd",     /* LATIN CAPITAL LETTER Z WITH CARON */
	    "\xc2\x91" => "\xe2\x80\x98", /* LEFT SINGLE QUOTATION MARK */
	    "\xc2\x92" => "\xe2\x80\x99", /* RIGHT SINGLE QUOTATION MARK */
	    "\xc2\x93" => "\xe2\x80\x9c", /* LEFT DOUBLE QUOTATION MARK */
	    "\xc2\x94" => "\xe2\x80\x9d", /* RIGHT DOUBLE QUOTATION MARK */
	    "\xc2\x95" => "\xe2\x80\xa2", /* BULLET */
	    "\xc2\x96" => "\xe2\x80\x93", /* EN DASH */
	    "\xc2\x97" => "\xe2\x80\x94", /* EM DASH */
	
	    "\xc2\x98" => "\xcb\x9c",     /* SMALL TILDE */
	    "\xc2\x99" => "\xe2\x84\xa2", /* TRADE MARK SIGN */
	    "\xc2\x9a" => "\xc5\xa1",     /* LATIN SMALL LETTER S WITH CARON */
	    "\xc2\x9b" => "\xe2\x80\xba", /* SINGLE RIGHT-POINTING ANGLE QUOTATION*/
	    "\xc2\x9c" => "\xc5\x93",     /* LATIN SMALL LIGATURE OE */
	    "\xc2\x9e" => "\xc5\xbe",     /* LATIN SMALL LETTER Z WITH CARON */
	    "\xc2\x9f" => "\xc5\xb8"      /* LATIN CAPITAL LETTER Y WITH DIAERESIS*/
	);
    
	return  strtr(utf8_encode($str), $cp1252_map);
}

function output_select_box_options ($arr_options, $display_table_column, $value_table_column, $selected_value = "") {
	if (is_array($arr_options)) {
		$int_num_options = count($arr_options["$value_table_column"])-1;
		for ($x=0;$x<=$int_num_options;$x++) {		
			if ($selected_value == $arr_options["$value_table_column"][$x] ) {
				//echo "YUP sel_value: _".$selected_value."_ curr_value: _".$arr_options["$value_table_column"][$x]."_<BR>\n";
				$str_selected = " SELECTED";
			} else {
				//echo "NOPE sel_value: _".$selected_value."_ curr_value: _".$arr_options["$value_table_column"][$x]."_<BR>\n";
				$str_selected = "";
			}
			$str_options .= "<option value=\"" . $arr_options["$value_table_column"][$x] . "\"" . $str_selected . ">" . $arr_options["$display_table_column"][$x] . "</option>\n";
		}
		return $str_options;
	} else {
		return "<option value=\"\">Please Select";
	}
}

function getTsDisributorLocations($country,$state)
{
	$dataconn = new DataConn("");
	
	$sql = "SELECT state,country FROM ts_distributors ";
	if (strlen($country) > 0) {
		$sql .= "WHERE country = '" . mysql_real_escape_string($country) . "' ";
		$b_add_and = true;
	}
	if (strlen($state) > 0) {
		if ($b_add_and) {
			$sql .= "AND ";
		} else {
			$sql .= "WHERE ";
		}
		$sql .= "state = '" . mysql_real_escape_string($state) . "' ";
	}
	$sql .= "ORDER BY name";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function getTsDisributors ($country,$state,$order_by)
{
	if ($order_by == "city") {
		$order_by = "`city`";
	} elseif ($order_by == "state") {
		$order_by = "`state`,`city`";
	} else {
		$order_by = "`name`";
	}
	$dataconn = new DataConn("");
	
	$sql = "SELECT * FROM ts_distributors ";
	if (strlen($country) > 0) {
		$sql .= "WHERE country = '" . mysql_real_escape_string($country) . "' ";
		$b_add_and = true;
	}
	if (strlen($state) > 0) {
		if ($b_add_and) {
			$sql .= "AND ";
		} else {
			$sql .= "WHERE ";
		}
		$sql .= "state = '" . mysql_real_escape_string($state) . "' ";
	}
	$sql .= "ORDER BY ".$order_by."";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function getTsDisributorUsLocations ()
{
	$dataconn = new DataConn("");
	
	$sql = "SELECT state,country FROM ts_distributors GROUP BY state,country HAVING country = 'USA'";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function getTsDisributorNonUsLocations ()
{
	$dataconn = new DataConn("");
	
	$sql = "SELECT state,country FROM ts_distributors GROUP BY country HAVING country <> 'USA'";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function getTsDisributorCountries ()
{
	$dataconn = new DataConn("");
	
	$sql = "SELECT country FROM ts_distributors GROUP BY country ORDER BY country";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}


function getFeaturedPart ($productLine = 3)
{
	$dataconn = new DataConn("");
	
	$sql = "
		SELECT part_id 
		FROM parts_featured 
		WHERE product_line_id = '".mysql_real_escape_string($productLine)."' 
		ORDER BY part_id";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		$uBound = count($arr_data["parts_featured.part_id"]) - 1;
		$position_to_return = rand(0,$uBound);
		$Part = new Part($arr_data["parts_featured.part_id"][$position_to_return]);
		return $Part;
	} else {
		return NULL;
	}
}


function parsePartfinderForceTypeVariables ()
{
	$arrUrl = explode("/",$_SERVER["REQUEST_URI"]);  //BREAK UP THE URL PATH USING '/' as the delimiter
	
	$get = array();
	
	$ubound_arrUrl = count($arrUrl)-1;
	

	foreach ($arrUrl as $value) {
		
		$parameter_code = substr($value,0,3);
		$parameter_value =  substr($value,3);
		
		switch ($parameter_code) {
			case "pns":
				$get["pn"] = $parameter_value;
				break;
			case "pno":
				$get["oem_pn"] = $parameter_value;
				break;
			case "not":
				$get["no_of_teeth"] = $parameter_value;
				break;
			case "dls":
				$get["driveline_series"] = $parameter_value;
				break;
			case "tdi":
				$get["tube_diameter"] = stripslashes($parameter_value);
				break;
			case "rgu":
				$get["ring_gears_unit_id"] = $parameter_value;
				break;
			case "tfo":
				$get["torque_fuse_options"] = $parameter_value;
				break;
			case "pds":
				$get["pts_driveline_series"] = $parameter_value;
				break;
			case "mak":
				$get["make"] = $parameter_value;
				break;
			case "uni":
				$get["unit"] = $parameter_value;
				break;
			case "pli":
				$get["pl"] = $parameter_value;
				break;
			case "sos":
				$get["show_only_sc"] = $parameter_value;
				break;
			case "sot":
				$get["show_only_tt"] = $parameter_value;
				break;
		}
	}
	
	return $get;
}




//Admin functions
function removeTitleFromSubcategory ($assignment_id) {
	$dataconn = new DataConn("");
	$sql = "DELETE FROM publication_subcategory_titles WHERE id = '".mysql_real_escape_string($assignment_id)."'";
	$dataconn->f_ExecuteSql($sql);
}

function addTitleToSubcategory ($subcategory_id,$title_id) {
	$dataconn = new DataConn("");
	
	$sql = "INSERT INTO publication_subcategory_titles (subcategory_id,title_id) VALUES ('".mysql_real_escape_string(stripslashes($subcategory_id))."','".mysql_real_escape_string(stripslashes($title_id))."')";
	$new_assignment_id = $dataconn->f_ExecuteSqlInsertID($sql);
}





function addAssembly ($unit_id,$assembly_name) {
	$dataconn = new DataConn("");
	
	$sql = "INSERT INTO assemblies (assembly) VALUES ('".mysql_real_escape_string(stripslashes($assembly_name))."')";
	$new_assembly_id = $dataconn->f_ExecuteSqlInsertID($sql);
	
	$sql = "INSERT INTO unit_components (unit_id,component_type,assembly_or_part_id) VALUES ('".mysql_real_escape_string($unit_id)."','1','".mysql_real_escape_string($new_assembly_id)."')";
	$dataconn->f_ExecuteSql($sql);
}

function deletePart ($part_id) {
	$dataconn = new DataConn("");
	$sql = "DELETE FROM parts WHERE id = '".mysql_real_escape_string($part_id)."'";
	$dataconn->f_ExecuteSql($sql);
}

function deletePartFromAssembly ($assembly_part_id) {
	$dataconn = new DataConn("");
	$sql = "DELETE FROM assembly_parts WHERE id = '".mysql_real_escape_string($assembly_part_id)."'";
	$dataconn->f_ExecuteSql($sql);
}

function deleteAssembly ($assembly_id) {
	$dataconn = new DataConn("");
	
	$sql = "DELETE FROM assembly_parts WHERE assembly_id = '".mysql_real_escape_string($assembly_id)."'";
	$dataconn->f_ExecuteSql($sql);
	
	$sql = "DELETE FROM assemblies WHERE id = '".mysql_real_escape_string($assembly_id)."'";
	$dataconn->f_ExecuteSql($sql);
	
	$sql = "DELETE FROM unit_components WHERE component_type = 1 AND assembly_or_part_id = '".mysql_real_escape_string($assembly_id)."'";
	$dataconn->f_ExecuteSql($sql);
}

function deleteUnitComponentById ($unit_component_id) {
	$dataconn = new DataConn("");
	$sql = "DELETE FROM unit_components WHERE id = '".mysql_real_escape_string($unit_component_id)."'";
	$dataconn->f_ExecuteSql($sql);
}

function deleteUnitComponentByUnitIdAndPartId ($unit_id,$part_id) {
	$dataconn = new DataConn("");
	$sql = "DELETE FROM `unit_components` WHERE `unit_id` = '".mysql_real_escape_string($unit_id)."' AND `assembly_or_part_id` = '".mysql_real_escape_string($part_id)."' LIMIT 1";
	$dataconn->f_ExecuteSql($sql);
}

function addPartToAssembly ($assembly_id,$part_id) {
	$dataconn = new DataConn("");
	$sql = "
		INSERT INTO assembly_parts 
			(assembly_id,part_id) 
		VALUES (
			'".mysql_real_escape_string($assembly_id)."',
			'".mysql_real_escape_string($part_id)."'
		)";
	return $dataconn->f_ExecuteSqlInsertID($sql);
}

//??
function addUnit ($product_line,$unit_name) {
	$dataconn = new DataConn("");
	$sql = "
		INSERT INTO assembly_parts 
			(assembly_id,part_id) 
		VALUES (
			'".mysql_real_escape_string($assembly_id)."',
			'".mysql_real_escape_string($assembly_part_id)."'
		)";
	return $dataconn->f_ExecuteSqlInsertID($sql);
}

function addComponentToUnit ($unit_id, $assembly_or_part_id, $component_type=0, $code_on_ref_figure=0, $display_order=0, $indent=0, $description="") {
	
	$dataconn = new DataConn("");
	
	if (!is_numeric($unit_id) || !is_numeric($assembly_or_part_id)) {
		return NULL;
	}
	
	if ($component_type == 0 && $description == "") {
		$description = getPartDescription($assembly_or_part_id);
	}
	
	$sql = "
		INSERT INTO unit_components 
			(unit_id, component_type, assembly_or_part_id, display_order, 
			indent, code_on_ref_figure, description) 
		VALUES (
			'".mysql_real_escape_string($unit_id)."', 
			'".mysql_real_escape_string($component_type)."', 
			'".mysql_real_escape_string($assembly_or_part_id)."', 
			'".mysql_real_escape_string($display_order)."', 
			'".mysql_real_escape_string($indent)."', 
			'".mysql_real_escape_string($code_on_ref_figure)."', 
			'".mysql_real_escape_string($description)."' 
		)";
	return $dataconn->f_ExecuteSqlInsertID($sql);
}

function getPartDescription($part_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT description 
		FROM parts 
		WHERE id = '".mysql_real_escape_string($part_id)."'";
	$arrData = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arrData)) {
		return $arrData["parts.description"][0];
	} else {
		return "";
	}
}

function getRefFigureData() {
	$dataconn = new DataConn("");
	$sql = "
		SELECT id, name 
		FROM ref_figures 
		ORDER BY name";
	$arrData = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (!is_array($arrData)) {
		$arrData = NULL;
	}
	return $arrData;
}


function isValidPart ($part_number,$product_line=2) {
	$dataconn = new DataConn("");
	$sql = "SELECT id FROM parts WHERE product_line = '".mysql_real_escape_string($product_line)."' AND part_number = '".mysql_real_escape_string($part_number)."'";
	//echo $sql."<BR>\n";
	//flush;
	$arrData = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arrData)) {
		//echo "part GOOD<BR>\n";
		//flush;
		return true;
	} else {
		//echo "part INvalid<BR>\n";
		//flush;
		return false;
	}
}

function isValidQty ($quantity) {
	if (!is_numeric($quantity)) {
		//echo "qty IN1valid<BR>\n";
		//flush;
		return false;
	} elseif (!ctype_digit($quantity)) {
		//echo "qty IN2valid<BR>\n";
		//flush;
		return false;
	} elseif ($quantity<1) {
		//echo "qty IN3valid<BR>\n";
		//flush;
		return false;
	} else {
		//echo "qty GOOD<BR>\n";
		//flush;
		return true;
	}
}

function insertSpeedOrderItem ($session_id,$product_number,$quantity) {
	$dataconn = new DataConn("");
	$sql = "
		INSERT INTO speed_order_temp 
			(session_id,part_number,qty) 
		VALUES (
			'".mysql_real_escape_string($session_id)."',
			'".mysql_real_escape_string($product_number)."',
			'".mysql_real_escape_string($quantity)."'
		)";
	return $dataconn->f_ExecuteSqlInsertID($sql);
}

function getSpeedOrderItems($session_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT part_number, qty 
		FROM speed_order_temp 
		WHERE session_id = '".mysql_real_escape_string($session_id)."' 
		ORDER BY lastupdate";
	//echo $sql."<BR>\n";
	//flush;
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function getPartData ($part_number,$product_line) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT * 
		FROM parts 
		WHERE product_line = '".mysql_real_escape_string($product_line)."' 
			AND part_number = '".mysql_real_escape_string($part_number)."'";
	//echo $sql."<BR>\n";
	//flush;
	$arrData = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arrData)) {
		return $arrData;
	} else {
		return -1;
	}
}

function getPartDataFromId ($part_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT * 
		FROM parts 
		WHERE id = '".mysql_real_escape_string($part_id)."'";
	//echo $sql."<BR>\n";
	//flush;
	$arrData = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arrData)) {
		return $arrData;
	} else {
		return -1;
	}
}

function createUnit ($product_line,$unit_name,$unit_description = "",$make_id = 0,$ref_figure_id = 0) {
	$dataconn = new DataConn("");
	$sql = "
		INSERT INTO units 
			(product_line,name,description,ref_figure_id) 
		VALUES (
			'".mysql_real_escape_string($product_line)."',
			'".mysql_real_escape_string($unit_name)."',
			'".mysql_real_escape_string($unit_description)."',
			'".mysql_real_escape_string($ref_figure_id)."'
		)";
	$new_unit_id = $dataconn->f_ExecuteSqlInsertID($sql);
	
	$sql = "
		INSERT INTO unit_makes 
			(unit_id,make_id) 
		VALUES (
			'".mysql_real_escape_string($new_unit_id)."',
			'".mysql_real_escape_string($make_id)."'
		)";
	$no_return = $dataconn->f_ExecuteSqlInsertID($sql);
	
	return $new_unit_id;
}

function updateUnitRefFigureId ($product_line, $unit_id, $ref_figure_id = 0) {
	//echo "product_line_".$product_line."_<BR>\n";
	//echo "unit_id_".$unit_id."_<BR>\n";
	//echo "ref_figure_id_".$ref_figure_id."_<BR>\n";
	
	if (!is_numeric($product_line) || !is_numeric($unit_id)) {
		return 0;
	}
	
	$dataconn = new DataConn("");
	
	$sql = "
		UPDATE units SET 
			ref_figure_id = '".mysql_real_escape_string($ref_figure_id)."' 
		WHERE 
			product_line = '".mysql_real_escape_string($product_line)."' 
			AND id = '".mysql_real_escape_string($unit_id)."'";
	//echo $sql."<BR>\n";
	//exit;
	$int_records_affected = $dataconn->f_ExecuteSql($sql);
}


function getAllMakes () {
	$dataconn = new DataConn("");
	$sql = "
		SELECT makes.id, makes.make 
		FROM makes
		ORDER BY makes.make";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function deleteUnit ($unit_id,$product_line=0) {
	$dataconn = new DataConn("");
	$sql = "DELETE FROM `units` WHERE `id` = '".mysql_real_escape_string($unit_id)."' AND `product_line` = '".mysql_real_escape_string($product_line)."'";
	$dataconn->f_ExecuteSql($sql);
	
	$sql = "DELETE FROM `unit_makes` WHERE `unit_id` = '".mysql_real_escape_string($unit_id)."'";
	$dataconn->f_ExecuteSql($sql);
	
	$sql = "DELETE FROM `unit_components` WHERE `unit_id` = '".mysql_real_escape_string($unit_id)."'";
	$dataconn->f_ExecuteSql($sql);
}

function updateUnitName ($unit_id,$unit_name) {
	if (!is_numeric($unit_id) || strlen($unit_name) < 1) {
		return NULL;
	}
	$dataconn = new DataConn("");
	$sql = "
		UPDATE units SET 
			name = '".mysql_real_escape_string(stripslashes($unit_name))."' 
		WHERE id = '".mysql_real_escape_string($unit_id)."'";
	//echo $sql."<BR>\n";
	//exit;
	return $dataconn->f_ExecuteSql($sql);
}

function getUnitName ($unit_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT units.name 
		FROM units
		WHERE units.id = '".mysql_real_escape_string($unit_id)."'";
	//echo $sql."<BR>\n";
	//flush;
	$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($result)) {
		return $result["units.name"][0];
	} else {
		return -1;
	}
}

function updateAssemblyName ($assembly_id,$assembly_name) {
	if (!is_numeric($assembly_id) || strlen($assembly_name) < 1) {
		return NULL;
	}
	$dataconn = new DataConn("");
	$sql = "
		UPDATE assemblies SET 
			assembly = '".mysql_real_escape_string(stripslashes($assembly_name))."' 
		WHERE id = '".mysql_real_escape_string($assembly_id)."'";
	//echo $sql."<BR>\n";
	//exit;
	return $dataconn->f_ExecuteSql($sql);
}

function getAssemblyName ($assembly_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT assemblies.assembly 
		FROM assemblies
		WHERE assemblies.id = '".mysql_real_escape_string($assembly_id)."'";
	//echo $sql."<BR>\n";
	//flush;
	$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($result)) {
		return $result["assemblies.assembly"][0];
	} else {
		return -1;
	}
}

function getCodeOnRefFigureFromAssemblyPartId ($assembly_part_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT code_on_ref_figure 
		FROM assembly_parts 
		WHERE id = '".mysql_real_escape_string($assembly_part_id)."'";
	//echo $sql."<BR>\n";
	//flush;
	$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($result)) {
		return $result["assembly_parts.code_on_ref_figure"][0];
	} else {
		return -1;
	}
}

function getPartIdFromAssemblyPartId ($assembly_part_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT part_id 
		FROM assembly_parts 
		WHERE id = '".mysql_real_escape_string($assembly_part_id)."'";
	//echo $sql."<BR>\n";
	//flush;
	$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($result)) {
		return $result["assembly_parts.part_id"][0];
	} else {
		return -1;
	}
}

function updateAssemblyPartRefCode ($assembly_part_id,$code_on_ref_figure) {
	if (!is_numeric($assembly_part_id)) {
		return NULL;
	}
	$dataconn = new DataConn("");
	$sql = "
		UPDATE assembly_parts SET 
			code_on_ref_figure = '".mysql_real_escape_string(stripslashes($code_on_ref_figure))."' 
		WHERE id = '".mysql_real_escape_string($assembly_part_id)."'";
	//echo $sql."<BR>\n";
	//exit;
	return $dataconn->f_ExecuteSql($sql);
}

function getPartNumber ($part_id,$product_line = "") {
	$dataconn = new DataConn("");
	$sql = "
		SELECT part_number 
		FROM parts 
		WHERE id = '".mysql_real_escape_string($part_id)."'";
		if (strlen($product_line) > 0) {
			$sql .= " AND product_line = '".mysql_real_escape_string($product_line)."'";
		}
	//echo $sql."<BR>\n";
	//flush;
	$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($result)) {
		return $result["parts.part_number"][0];
	} else {
		return -1;
	}
}

function getMakesForUnit ($unit_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT unit_makes.make_id, makes.make 
		FROM unit_makes
			LEFT JOIN makes ON unit_makes.make_id = makes.id
		WHERE unit_makes.unit_id = '".mysql_real_escape_string($unit_id)."' 
		ORDER BY makes.make";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function removeUnitMake ($unit_id,$make_id) {
	$dataconn = new DataConn("");
	$sql = "
		DELETE FROM unit_makes 
		WHERE unit_makes.unit_id = '".mysql_real_escape_string($unit_id)."' 
			AND unit_makes.make_id = '".mysql_real_escape_string($make_id)."' LIMIT 1";
	$no_return = $dataconn->f_ExecuteSql($sql);
}

function addUnitMake ($unit_id,$make_id) {
	if ( !is_numeric($unit_id) || !is_numeric($make_id) ) {
		return NULL;
	}
	$dataconn = new DataConn("");
	
	$sql = "
		SELECT id 
		FROM unit_makes
		WHERE unit_makes.unit_id = '".mysql_real_escape_string($unit_id)."' 
			AND unit_makes.make_id = '".mysql_real_escape_string($make_id)."'";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (!is_array($arr_data)) {
		$sql = "
			INSERT INTO unit_makes 
				(unit_id,make_id) 
			VALUES (
				'".mysql_real_escape_string($unit_id)."',
				'".mysql_real_escape_string($make_id)."'
			)";
		$no_return = $dataconn->f_ExecuteSql($sql);
	}
}

function doesUnitHaveMakeAssigned ($unit_id,$make_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT id 
		FROM unit_makes
		WHERE unit_makes.unit_id = '".mysql_real_escape_string($unit_id)."' 
			AND unit_makes.make_id = '".mysql_real_escape_string($make_id)."'";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return true;
	} else {
		return false;
	}
}

function getComponentData ($component_id) {
	$dataconn = new DataConn("");
	$sql = "
		SELECT * 
		FROM unit_components 
		WHERE id = '".mysql_real_escape_string($component_id)."'";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		return $arr_data;
	} else {
		return -1;
	}
}

function getProductLineName ($product_line_id) {
	$dataconn = new DataConn("");
	
	$sql = "SELECT name FROM product_lines WHERE id = '".mysql_real_escape_string($product_line_id)."'";
	$productlineData = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($productlineData)) {
		return $productlineData["product_lines.name"][0];
	} else {
		return $product_line_id;
	}
}

function updateComponent ($get) {
	$dataconn = new DataConn("");
	
	if (!is_numeric($get["component_id"])) {
		return NULL;
	}
	
	//we dont allow them to edit component_type or assembly_or_part_id
	//they must delete and then re-add to accomplish that
	
	$sql = "
		UPDATE unit_components SET 
			indent = '".mysql_real_escape_string(stripslashes($get["indent"]))."', 
			code_on_ref_figure = '".mysql_real_escape_string(stripslashes($get["code_on_ref_figure"]))."', 
			description = '".mysql_real_escape_string(stripslashes($get["description"]))."', 
			notes = '".mysql_real_escape_string(stripslashes($get["notes"]))."', 
			steel_driveshaft_tube_od = '".mysql_real_escape_string(stripslashes($get["steel_driveshaft_tube_od"]))."', 
			torque_fuse_options = '".mysql_real_escape_string(stripslashes($get["torque_fuse_options"]))."', 
			pts_series = '".mysql_real_escape_string(stripslashes($get["pts_series"]))."', 
			driveline_series = '".mysql_real_escape_string(stripslashes($get["driveline_series"]))."', 
			display_order = '".mysql_real_escape_string(stripslashes($get["display_order"]))."' 
		WHERE id = '".mysql_real_escape_string(stripslashes($get["component_id"]))."'";
	return $dataconn->f_ExecuteSql($sql);
}

function insertPtsComponent ($get) {
	$dataconn = new DataConn("");
	
	//creat the phantom unit name
	$unit_name = $get["driveline_series"]." x ".$get["steel_driveshaft_tube_od"];
	
	//lookup the phantom unit (and create it if it doesn't exist)
	$sql = "
		SELECT id 
		FROM units 
		WHERE name = '".mysql_real_escape_string($unit_name)."' 
			AND product_line = 9";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (is_array($arr_data)) {
		$unit_id = $arr_data["units.id"][0];
	} else {
		$unit_id = createUnit("9",$unit_name,"",0,0);
	}
	
	//creat the new entry in the unit components table
	$sql = "
		INSERT INTO unit_components 
			(unit_id, component_type, assembly_or_part_id, display_order, 
			indent, code_on_ref_figure, notes, pts_series, driveline_series, 
			steel_driveshaft_tube_od, torque_fuse_options, description) 
		VALUES (
			'".mysql_real_escape_string($unit_id)."', 
			'0', 
			'".mysql_real_escape_string($get["part_id"])."', 
			'".mysql_real_escape_string($get["display_order"])."', 
			'".mysql_real_escape_string($get["indent"])."', 
			'".mysql_real_escape_string($get["code_on_ref_figure"])."', 
			'".mysql_real_escape_string($get["notes"])."', 
			'".mysql_real_escape_string($get["pts_series"])."', 
			'".mysql_real_escape_string($get["driveline_series"])."', 
			'".mysql_real_escape_string($get["steel_driveshaft_tube_od"])."', 
			'".mysql_real_escape_string($get["torque_fuse_options"])."', 
			'".mysql_real_escape_string($get["description"])."' 
		)";
	return $dataconn->f_ExecuteSqlInsertID($sql);
}

function setComponentIndent ($component_id,$indent) {
	if ( !is_numeric($component_id) ) {
		return NULL;
	}
	if ($indent != 1 && $indent != "1") {
		$indent = 0;
	}
	$dataconn = new DataConn("");
	$sql = "
		UPDATE unit_components SET 
			indent = '".mysql_real_escape_string(stripslashes($indent))."' 
		WHERE id = '".mysql_real_escape_string($component_id)."'";
	//echo $sql."<BR>\n";
	//exit;
	return $dataconn->f_ExecuteSql($sql);
}


function moveAssembly ($unit_id,$unit_component_id,$direction) {
	$dataconn = new DataConn("");
	//get the assemblies in the unit_components table in order
	$sql = "
		SELECT id,assembly_or_part_id,display_order 
		FROM unit_components 
		WHERE unit_id = '".mysql_real_escape_string($unit_id)."' 
			AND component_type = 1 
		ORDER BY display_order";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql);
	if (!is_array($arr_data)) {
		return -1;
	}
	
	//find the ordinal of the assembly we are moving
	$int_num_assemblies = count($arr_data["unit_components.id"])-1;
	echo "int_num_assemblies: _".$int_num_assemblies."_<BR>\n";
	for ($x=0;$x<=$int_num_assemblies;$x++) {
		echo "x: _".$x."_<BR>\n";
		echo "x: _".$arr_data["unit_components.id"][$x]."_ and _".$unit_component_id."_<BR>\n";
		if ($arr_data["unit_components.id"][$x] == $unit_component_id) {
			$position_current = $x;
			break;//terminate the for loop
		}
	}
	
	//terminate if moving up and its already first or vice versa
	if ( ($position_current == 0 && $direction == "up") || ($position_current == $int_num_assemblies && $direction == "down") ) {
		return -1;
	}
	
	//swap the two items
	if ($direction == "up") {
		$sql = "
			UPDATE unit_components SET 
				display_order = '".mysql_real_escape_string($arr_data["unit_components.display_order"][$x-1])."' 
			WHERE id = '".mysql_real_escape_string($arr_data["unit_components.id"][$x])."'";
		$ignore_return = $dataconn->f_ExecuteSql($sql);
		$sql = "
			UPDATE unit_components SET 
				display_order = '".mysql_real_escape_string($arr_data["unit_components.display_order"][$x])."' 
			WHERE id = '".mysql_real_escape_string($arr_data["unit_components.id"][$x-1])."'";
		$ignore_return = $dataconn->f_ExecuteSql($sql);
	} elseif ($direction == "down") {
		$sql = "
			UPDATE unit_components SET 
				display_order = '".mysql_real_escape_string($arr_data["unit_components.display_order"][$x+1])."' 
			WHERE id = '".mysql_real_escape_string($arr_data["unit_components.id"][$x])."'";
		$ignore_return = $dataconn->f_ExecuteSql($sql);
		$sql = "
			UPDATE unit_components SET 
				display_order = '".mysql_real_escape_string($arr_data["unit_components.display_order"][$x])."' 
			WHERE id = '".mysql_real_escape_string($arr_data["unit_components.id"][$x+1])."'";
		$ignore_return = $dataconn->f_ExecuteSql($sql);
	} else {
		return -1;
	}
	//echo "position_current: _".$position_current."_<BR>\n";
	//exit;
}
?>