<?


class Part {
// Fields ///////////////////////////////////////////////////////////////
	public $id;
	public $product_line;
	public $part_number;
	public $description;
	public $notes;
	public $item;
	public $price;
	public $photo;
	public $announcement;
	public $instructions;
	public $tech;
	public $vbfix;
	public $oem_part_number;
	public $product_line_from_ts_file;
	public $part_summary;
	public $part_type;
	public $tube_diameter;
	public $steel_driveshaft_tube_od;
	public $torque_fuse_options;
	public $no_of_teeth;
	public $outer_diameter;
	public $inner_diameter;
	public $pitch;
	public $thick;
	public $chamfer;
	public $weight;
	public $new_item;
	
	// 3 fields below are for shopping cart
	public $shopping_cart_quantity;
	public $shopping_cart_id;
	public $component_id;
	
	public $ref_number;  // used for TC and HPTC part stacks
	public $tc_description; // used for TC and HPTC part stacks and shopping cart
	private $dataconn;

// Methods //////////////////////////////////////////////////////////////
	function __construct ($id, $ref_number = 0, $tc_description="", $debugOutput = false) 
	{
		$this->dataconn = new DataConn("");
		$this->ref_number = $ref_number;
		$this->tc_description = $tc_description;
		$no_return = $this->loadFields($id,$debugOutput);
	}
	
	function __destruct ()
	{
		
	}
	
	public function loadFields ($id,$debugOutput = false)
	{
		if (is_numeric($id)) {
			$sql = "
				SELECT * 
				FROM parts 
				WHERE id = '".mysql_real_escape_string($id)."'/* Part->loadFields */";
			$partData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
			if (is_array($partData)) {
				
				$this->id = $id;
				$this->product_line = $partData["parts.product_line"][0];
				$this->part_number = $partData["parts.part_number"][0];
				$this->description = $partData["parts.description"][0];
				$this->notes = $partData["parts.notes"][0];
				$this->item = $partData["parts.item"][0];
				$this->price = $partData["parts.price"][0];
				$this->photo = $partData["parts.photo"][0];
				$this->announcement = $partData["parts.announcement"][0];
				$this->instructions = $partData["parts.instructions"][0];
				$this->tech = $partData["parts.tech"][0];
				$this->vbfix = $partData["parts.vbfix"][0];
				$this->oem_part_number = $partData["parts.oem_part_number"][0];
				$this->product_line_from_ts_file = $partData["parts.product_line_from_ts_file"][0];
				$this->part_summary = $partData["parts.part_summary"][0];
				$this->part_type = $partData["parts.part_type"][0];
				$this->tube_diameter = $partData["parts.tube_diameter"][0];
				$this->steel_driveshaft_tube_od = $partData["parts.steel_driveshaft_tube_od"][0];
				$this->torque_fuse_options = $partData["parts.torque_fuse_options"][0];
				$this->no_of_teeth = $partData["parts.no_of_teeth"][0];
				$this->outer_diameter = $partData["parts.outer_diameter"][0];
				$this->inner_diameter = $partData["parts.inner_diameter"][0];
				$this->pitch = $partData["parts.pitch"][0];
				$this->thick = $partData["parts.thick"][0];
				$this->chamfer = $partData["parts.chamfer"][0];
				$this->weight = $partData["parts.weight"][0];
				$this->new_item = $partData["parts.new_item"][0];
				
				if ($debugOutput == true) {
					var_dump($partData);
				}
				
				return true;
			}
		}
		
		$this->id = 0;
		$this->product_line = 0;
		$this->part_number = "";
		$this->description = "";
		$this->notes = "";
		$this->item = "";
		$this->price = 0;
		$this->photo = "";
		$this->announcement = "";
		$this->instructions = "";
		$this->tech = "";
		$this->vbfix = "";
		$this->oem_part_number = "";
		$this->product_line_from_ts_file = "";
		$this->part_summary = "";
		$this->part_type = "";
		$this->tube_diameter = "";
		$this->steel_driveshaft_tube_od = "";
		$this->torque_fuse_options = "";
		$this->no_of_teeth = "";
		$this->outer_diameter = "";
		$this->inner_diameter = "";
		$this->pitch = "";
		$this->thick = "";
		$this->chamfer = "";
		$this->weight = 0;
		$this->new_item = 0;
		return false;
	}
	
	public function commitFields ()
	{
		//THIS CODE IS UNTESTED
		// NEEDS `ITEM` ADDED TO LIST OF FIELDS FOR INSERT AND UPDATE
		// NEEDS `weight` ADDED TO LIST OF FIELDS FOR INSERT AND UPDATE
		
		//need validation here for any required fields
		
		$sql = "
			UPDATE parts SET 
				product_line = '".mysql_real_escape_string($this->product_line)."',
				part_number = '".mysql_real_escape_string($this->part_number)."',
				description = '".mysql_real_escape_string($this->description)."',
				notes = '".mysql_real_escape_string($this->notes)."',
				price = '".mysql_real_escape_string($this->price)."',
				photo = '".mysql_real_escape_string($this->photo)."',
				announcement = '".mysql_real_escape_string($this->announcement)."',
				instructions = '".mysql_real_escape_string($this->instructions)."',
				tech = '".mysql_real_escape_string($this->tech)."',
				vbfix = '".mysql_real_escape_string($this->vbfix)."',
				oem_part_number = '".mysql_real_escape_string($this->oem_part_number)."',
				part_summary = '".mysql_real_escape_string($this->part_summary)."',
				part_type = '".mysql_real_escape_string($this->part_type)."',
				tube_diameter = '".mysql_real_escape_string($this->tube_diameter)."',
				steel_driveshaft_tube_od = '".mysql_real_escape_string($this->steel_driveshaft_tube_od)."',
				torque_fuse_options = '".mysql_real_escape_string($this->torque_fuse_options)."',
				no_of_teeth = '".mysql_real_escape_string($this->no_of_teeth)."',
				outer_diameter = '".mysql_real_escape_string($this->outer_diameter)."',
				inner_diameter = '".mysql_real_escape_string($this->inner_diameter)."',
				pitch = '".mysql_real_escape_string($this->pitch)."',
				thick = '".mysql_real_escape_string($this->thick)."',
				chamfer = '".mysql_real_escape_string($this->chamfer)."' 
			WHERE id = '".mysql_real_escape_string($this->id)."'/* Part->commitFields */";
		//echo $sql . "<BR>\n";
		return $this->dataconn->f_ExecuteSql($sql);
	}
	
	public function insertNew ()
	{
		//THIS CODE IS UNTESTED
		
		//need validation here for any required fields
		
		$sql = "
			INSERT INTO parts (
				product_line, part_number,description,notes,price,photo,announcement,
				instructions,tech,vbfix,oem_part_number,part_summary,tube_diameter,steel_driveshaft_tube_od,
				torque_fuse_options,no_of_teeth,outer_diameter,inner_diameter,pitch,thick,chamfer
			) VALUES (
				'".mysql_real_escape_string($this->product_line)."',
				'".mysql_real_escape_string($this->part_number)."',
				'".mysql_real_escape_string($this->description)."',
				'".mysql_real_escape_string($this->notes)."',
				'".mysql_real_escape_string($this->price)."',
				'".mysql_real_escape_string($this->photo)."',
				'".mysql_real_escape_string($this->announcement)."',
				'".mysql_real_escape_string($this->instructions)."',
				'".mysql_real_escape_string($this->tech)."',
				'".mysql_real_escape_string($this->vbfix)."',
				'".mysql_real_escape_string($this->oem_part_number)."',
				'".mysql_real_escape_string($this->part_summary)."',
				'".mysql_real_escape_string($this->tube_diameter)."',
				'".mysql_real_escape_string($this->steel_driveshaft_tube_od)."',
				'".mysql_real_escape_string($this->torque_fuse_options)."',
				'".mysql_real_escape_string($this->no_of_teeth)."',
				'".mysql_real_escape_string($this->outer_diameter)."',
				'".mysql_real_escape_string($this->inner_diameter)."',
				'".mysql_real_escape_string($this->pitch)."',
				'".mysql_real_escape_string($this->thick)."',
				'".mysql_real_escape_string($this->chamfer)."'
			/* Part->insertNew */)";
		//echo $sql . "<BR>\n";
		return $this->dataconn->f_ExecuteSqlInsertID($sql);
	}
	
	public function deleteSelf ()
	{
		$sql = "DELETE FROM parts WHERE id = '".mysql_real_escape_string($this->id)."'/* Part->deleteSelf */";
		$this->dataconn->f_ExecuteSql($sql);
	}
	
	public function getUnitsContainingPart ($make_id)
	{
		/*
		provided with make_id (part_id is known)
		returns 1d array of unit_ids that match the part
		
		$make_id
		$this->id
		*/
		
		//set the counter
		$int_unit_counter = -1;
		$arr_units = array();
		
		//read the units that have the part in question assigned directly to them
		$sql = "
			SELECT unit_id 
			FROM unit_components 
			WHERE component_type = 0 
				AND assembly_or_part_id = '".mysql_real_escape_string($this->id)."'/* Part->getUnitsContainingPart */";
		//echo $sql . "<BR>\n";
		$unitData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($unitData)) {
			//echo "_".$unitData["unit_components.id"][0] . "_<BR>\n";
			$int_num_units = count($unitData["unit_components.unit_id"])-1;
			//echo "DIRECTLY ASSIGNED PARTS int_num_units: _".$int_num_units."_<BR>\n";
			for ($x=0;$x<=$int_num_units;$x++) {
				if (!in_array($unitData["unit_components.unit_id"][$x], $arr_units)) {
					$int_unit_counter++;
					$arr_units[$int_unit_counter] = $unitData["unit_components.unit_id"][$x];
				}
			}
		}
		
		//var_dump($arr_units) . "<HR>\n";
		
		//get the assemblies with the part in question assigned to them
		$sql = "
			SELECT assembly_id 
			FROM assembly_parts 
			WHERE part_id = '".mysql_real_escape_string($this->id)."'/* Part->getUnitsContainingPart */";
		//echo $sql . "<BR>\n";
		$assemblyPartData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($assemblyPartData)) {
			$int_num_assemblies = count($assemblyPartData["assembly_parts.assembly_id"])-1;
			//echo "ASSEMLIES CONTAING PART: _".$int_num_assemblies."_<BR>\n";
			for ($x=0;$x<=$int_num_assemblies;$x++) {
				
				//read the units which have this assembly assigned to them
				$sql = "
					SELECT unit_id 
					FROM unit_components 
					WHERE component_type = 1 
						AND assembly_or_part_id = '".mysql_real_escape_string($assemblyPartData["assembly_parts.assembly_id"][$x])."'/* Part->getUnitsContainingPart */";
				//echo $sql . "<BR>\n";
				$unitData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
				if (is_array($unitData)) {
					$int_num_units = count($unitData["unit_components.unit_id"])-1;
					//echo "UNITS WITH ASSEMBLIES ASSIGNED CONTAINTING PART int_num_units: _".$int_num_units."_<BR>\n";
					for ($q=0;$q<=$int_num_units;$q++) {
						if (!in_array($unitData["unit_components.unit_id"][$q], $arr_units)) {
							$int_unit_counter++;
							$arr_units[$int_unit_counter] = $unitData["unit_components.unit_id"][$q];
						}
					}
				} else {
					//echo "UNITS WITH ASSEMBLIES ASSIGNED CONTAINTING PART 0<BR>\n";
				}
			}
		}else {
			//echo "ASSEMLIES CONTAING PART _0_<BR>\n";
		}
		
		//print_r($arr_units) . "<BR>\n";
		//var_dump($arr_units) . "<HR>\n";
		
		//echo "int_unit_counter: _" . $int_unit_counter . "_<BR>\n";	
		//check the units we've found to contain the part to see if they match the make provided
		if (strlen($make_id)>0) {
			
			$int_units_that_match_this_make = -1;
			
			$sql = "
				SELECT unit_id 
				FROM unit_makes 
				WHERE make_id = '".mysql_real_escape_string($make_id)."'/* Part->getUnitsContainingPart */";
			//echo $sql . "<BR>\n";
			$unitMakeData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
			if (is_array($unitMakeData)) {
				$int_num_units_of_make = count($unitMakeData["unit_makes.unit_id"])-1;
				//echo "UNITS WITH MATHCING MAKE int_num_units_of_make: _".$int_num_units_of_make."_<BR>\n";
				for ($x=0;$x<=$int_unit_counter;$x++) {//units that contain the part
					for ($y=0;$y<=$int_num_units_of_make;$y++) {//units of the correct make
						//echo $arr_units[$x] . " == " . $unitMakeData["unit_makes.unit_id"][$y] . "<BR>\n";
						if ($arr_units[$x] == $unitMakeData["unit_makes.unit_id"][$y]) {
							$int_units_that_match_this_make++;
							$arr_matching_units[$int_units_that_match_this_make] = $arr_units[$x];
						}
					}
					//echo "<HR>\n";	
				}
			} else {
				//echo "NO UNITS WITH MATHCING MAKE<BR>\n";
				$arr_matching_units = -1;
			}
		} else {
			$arr_matching_units = $arr_units;
		}
		//eliminate duplicates
		//$arr_no_duplicates = array_unique($arr_matching_units);
		//this removed keys when duplicates existed so I am using in_array tests above
		
		//	var_dump($arr_matching_units);
		
		return $arr_matching_units;
	}
	
	public function getMakesPartAppliesTo ()
	{
		/*
		returns 1d array of make_ids that match the part
		
		$this->id
		*/
		
		//set the counter
		$int_unit_counter = -1;
		$arr_units = array();
		
		//read the units that have the part in question assigned directly to them
		$sql = "
			SELECT unit_id 
			FROM unit_components 
			WHERE component_type = 0 
				AND assembly_or_part_id = '".mysql_real_escape_string($this->id)."'/* Part->getMakesPartAppliesTo */";
		//echo $sql . "<BR>\n";
		$unitData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($unitData)) {
			//echo "_".$unitData["unit_components.id"][0] . "_<BR>\n";
			$int_num_units = count($unitData["unit_components.unit_id"])-1;
			//echo "DIRECTLY ASSIGNED PARTS int_num_units: _".$int_num_units."_<BR>\n";
			for ($x=0;$x<=$int_num_units;$x++) {
				if (!in_array($unitData["unit_components.unit_id"][$x], $arr_units)) {
					$int_unit_counter++;
					$arr_units[$int_unit_counter] = $unitData["unit_components.unit_id"][$x];
				}
			}
		}
		
		//var_dump($arr_units) . "<HR>\n";
		
		//get the assemblies with the part in question assigned to them
		$sql = "
			SELECT assembly_id 
			FROM assembly_parts 
			WHERE part_id = '".mysql_real_escape_string($this->id)."'/* Part->getMakesPartAppliesTo */";
		//echo $sql . "<BR>\n";
		$assemblyPartData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($assemblyPartData)) {
			$int_num_assemblies = count($assemblyPartData["assembly_parts.assembly_id"])-1;
			//echo "ASSEMLIES CONTAING PART: _".$int_num_assemblies."_<BR>\n";
			for ($x=0;$x<=$int_num_assemblies;$x++) {
				
				//read the units which have this assembly assigned to them
				$sql = "
					SELECT unit_id 
					FROM unit_components 
					WHERE component_type = 1 
						AND assembly_or_part_id = '".mysql_real_escape_string($assemblyPartData["assembly_parts.assembly_id"][$x])."'/* Part->getMakesPartAppliesTo */";
				//echo $sql . "<BR>\n";
				$unitData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
				if (is_array($unitData)) {
					$int_num_units = count($unitData["unit_components.unit_id"])-1;
					//echo "UNITS WITH ASSEMBLIES ASSIGNED CONTAINTING PART int_num_units: _".$int_num_units."_<BR>\n";
					for ($q=0;$q<=$int_num_units;$q++) {
						if (!in_array($unitData["unit_components.unit_id"][$q], $arr_units)) {
							$int_unit_counter++;
							$arr_units[$int_unit_counter] = $unitData["unit_components.unit_id"][$q];
						}
					}
				} else {
					//echo "UNITS WITH ASSEMBLIES ASSIGNED CONTAINTING PART 0<BR>\n";
				}
			}
		}else {
			//echo "ASSEMLIES CONTAING PART _0_<BR>\n";
		}
		
		//print_r($arr_units) . "<BR>\n";
		
		//find all of the makes represented by the units we've found to contain the part
		if ($int_unit_counter > -1) {
			$str_comma_separated_unit_ids = implode(",", $arr_units);
			//echo "cs list _" . $str_comma_separated_unit_ids . "_<BR>\n";
		} else {
			// part is not in any units so there are no matching makes
			return false;
		}
		
		$sql = "
			SELECT make_id 
			FROM unit_makes 
			WHERE unit_id IN (".$str_comma_separated_unit_ids.") 
				AND make_id > 0 
			GROUP BY make_id/* Part->getMakesPartAppliesTo */";
			//the AND was added on 2007-05-16 by TJH tp prevent a problem on part_summary.php
		//echo $sql . "<BR>\n";
		$arr_makes = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$makesCount = count($arr_makes["unit_makes.make_id"]);
		for ($x=0; $x <= $makesCount - 1; $x++) {
			$finalMakes[$x] = $arr_makes["unit_makes.make_id"][$x];
		}
		if (is_array($arr_makes)) {
			return $finalMakes;
		} else {
			return false;
		}
		
	}
	
	
	/**
	 * Compare two htpc part objects for use with a usort in a PartStack object
	 *
	 * @param Part $part_1  - part object
	 * @param Part $part_2  - part object
	 * @return sort order indicator
	 */
	public function compare_parts_hptc_assembly ($part_1, $part_2) {
		if ($part_1->ref_number == $part_2->ref_number) {
			if ($part_1->part_number != $part_2->part_number) {
				return ($part_1->part_number < $part_2->part_number) ? +1 : -1; 
			} else {
				return 0;
			}
		}
		return ($part_1->ref_number < $part_2->ref_number) ? +1 : -1;
	}
	
	/**
	 * Compare two tc part objects for use with a usort in a PartStack object
	 *
	 * @param Part $part_1  - part object
	 * @param Part $part_2  - part object
	 * @return sort order indicator
	 */
	public function compare_parts_tc ($part_1, $part_2) {
		$cmp = strnatcmp($part_1->ref_number, $part_2->ref_number) * -1;
		if (!$cmp) {
			if ($part_1->part_number != $part_2->part_number) {
				return ($part_1->part_number < $part_2->part_number) ? +1 : -1; 
			} else {
				return 0;
			}
		} else {
			return $cmp;
		}
	}
}

