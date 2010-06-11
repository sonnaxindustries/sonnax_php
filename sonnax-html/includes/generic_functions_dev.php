<?
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
?>