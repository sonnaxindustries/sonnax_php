<?
require_once("clsDataList.php");
require_once("clsAssemblyPart.php");

class Search {


// Methods //////////////////////////////////////////////////////////////

	public function unitById ($id) {
		$sqlTemp = "
			SELECT name, description, product_line, ref_figure_id 
			FROM units 
			WHERE id='".mysql_real_escape_string($id)."'";
		$dataList = new DataList($sqlTemp, "units.name");
		$dl = &$dataList;
		return $dl;
	}
	
	public function unitMakes($unit_id) {
		$sqlTemp = "
			SELECT make_id 
			FROM unit_makes 
			WHERE unit_id = '".mysql_real_escape_string($unit_id)."'";
			/* ??? MAY NEED JOIN AND ORDER BY */
		$dataList = new DataList($sqlTemp, "makes.id");
		$upperBound = $dataList->count - 1;
		for ($x=0;$x <= $upperBound; $x++) {
			$arrayList[$x] = new Make($dataList->arrayList['unit_makes.make_id'][$x]);
		}
		$al = &$arrayList;
		return $al;
	}
	
	public function unitComponents ($unit_id) {		
		/*
		//this is the original sql. the new sql uses a join to do some ordering.
		$sqlTemp = "
			SELECT id 
			FROM unit_components 
			WHERE unit_id = '".mysql_real_escape_string($unit_id)."'";
		*/
		/* ??? MAY NEED JOIN AND ORDER BY */
		
		/*
		$sqlTemp = "
			SELECT unit_components.id 
			FROM unit_components 
			WHERE unit_components.unit_id = '".mysql_real_escape_string($unit_id)."'";
		*/
		
		//this join only helps if we are just looking for the directly assigned parts
		//if this is returning assemblies as well there may be issues
		$sqlTemp = "
			SELECT unit_components.id 
			FROM unit_components 
				LEFT JOIN parts 
				ON unit_components.assembly_or_part_id = parts.id 
			WHERE unit_components.unit_id = '".mysql_real_escape_string($unit_id)."'";
		global $get;
		if ($get["show_only_sc"] == "true" && $get["show_only_tt"] == "true") {
			$sqlTemp .= " AND parts.product_line_from_ts_file IN ('TT','SC')";
		} elseif ($get["show_only_sc"] == "true") {
			$sqlTemp .= " AND parts.product_line_from_ts_file = 'SC'";
		} elseif ($get["show_only_tt"] == "true") {
			$sqlTemp .= " AND parts.product_line_from_ts_file = 'TT'";
		}
		
		
		$sqlTemp .= " ORDER BY unit_components.code_on_ref_figure +0 DESC, parts.part_number DESC";
		
		
		$dataList = new DataList($sqlTemp, "unit_components.id");
		$upperBound = $dataList->count - 1;
		for ($x=0;$x <= $upperBound; $x++) {
			$arrayList[$x] = new Component($dataList->arrayList['unit_components.id'][$x]);
		}
		$al = &$arrayList;
		return $al;
	}
	
	public function componentById ($id) {
		$sqlTemp = "
			SELECT 
				unit_id, component_type, assembly_or_part_id, display_order, 
				indent, code_on_ref_figure, description, notes, steel_driveshaft_tube_od, 
				torque_fuse_options, pts_series, driveline_series 
			FROM unit_components 
			WHERE id = '".mysql_real_escape_string($id)."'";
		$dataList = new DataList($sqlTemp, "unit_components.unit_id");
		$dl = &$dataList;
		return $dl;
	}
	
	public function assemblyParts ($assembly_id) {
		/*
		$sqlTemp = "
			SELECT 
				id, part_id, code_on_ref_figure, display_order 
			FROM assembly_parts 
			WHERE assembly_id = '".mysql_real_escape_string($assembly_id)."' 
			ORDER BY code_on_ref_figure DESC, display_order DESC";*/
		
		//NOTES: 
			//I believe that the display_order field in the assembly_parts table is NOT being used.
			//I believe that the display_order field in the units_components table IS being used though.
		
		
		//this is so close but has some issues
		$sqlTemp = "
			SELECT 
				assembly_parts.id, assembly_parts.part_id, 
				assembly_parts.code_on_ref_figure, assembly_parts.display_order, 
				parts.part_number 
			FROM assembly_parts 
				LEFT JOIN parts ON assembly_parts.part_id = parts.id 
			WHERE assembly_parts.assembly_id = '".mysql_real_escape_string($assembly_id)."' 
			ORDER BY assembly_parts.code_on_ref_figure  DESC, parts.part_number DESC";
		
		$dataList = new DataList($sqlTemp, "assembly_parts.id");
		$upperBound = $dataList->count - 1;
		for ($x=0;$x <= $upperBound; $x++) {
			$arrayList[$x] = new AssemblyPart($dataList->arrayList['assembly_parts.id'][$x]);
		}
		$al = &$arrayList;
		return $al;
	}
	
	public function assemblyById ($assembly_id) {
		$sqlTemp = "
			SELECT id, assembly 
			FROM assemblies 
			WHERE id = '".mysql_real_escape_string($assembly_id)."'";
		$dataList = new DataList($sqlTemp, "assemblies.id");
		$dl = &$dataList;
		return $dl;
	}
	
	public function assemblyPartByID($id) {
		$sqlTemp = "
			SELECT assembly_id, part_id, code_on_ref_figure, display_order  
			FROM assembly_parts 
			WHERE id = '".mysql_real_escape_string($id)."'";
		$dataList = new DataList($sqlTemp, "assembly_parts.assembly_id");
		$dl = &$dataList;
		return $dl;
	}
	
}