<?
require_once("clsSearch.php");

class Component {

// Fields ///////////////////////////////////////////////////////////////
	public $id;
	public $unit_id;
	public $component_type = 0;  // 0 for part and 1 for assembly
	public $assembly_or_part_id;
	public $display_order = 0;
	public $indent = 0;
	public $code_on_ref_figure;
	public $tc_description;
	private $dataconn;
	private $dataList;
	
// Methods //////////////////////////////////////////////////////////////
	function __construct ($id) {
		$this->id = $id;
		$this->dataconn = new DataConn("");
		if ($id != 0) {
			$this->dataList = Search::componentById($id);
			$this->unit_id = $this->dataList->arrayList['unit_components.unit_id'][0];
			$this->component_type = $this->dataList->arrayList['unit_components.component_type'][0];
			$this->assembly_or_part_id = $this->dataList->arrayList['unit_components.assembly_or_part_id'][0];
			$this->display_order = $this->dataList->arrayList['unit_components.display_order'][0];
			$this->indent = $this->dataList->arrayList['unit_components.indent'][0];
			$this->code_on_ref_figure = $this->dataList->arrayList['unit_components.code_on_ref_figure'][0];
			$this->tc_description = $this->dataList->arrayList['unit_components.description'][0];
		}
	}
	
	function __destruct () {
	}
	
	public function commitFields () {
		if ($this->id != 0) {
			$sqlTemp = "UPDATE unit_components SET
							unit_id = '$this->unit_id',
							component_type = '$this->component_type',
							assembly_or_part_id = '$this->assembly_or_part_id',
							display_order = '$this->display_order',
							indent = '$this->indent',
							code_on_ref_figure = '$this->code_on_ref_figure',
							description = '$this->tc_description'
							WHERE id = $this->id";
		} else {
			$sqlTemp = "INSERT INTO unit_components 
							(unit_id, component_type, assembly_or_part_id, display_order, indent, code_on_ref_figure, description)
							VALUES
							('$this->unit_id','$this->component_type','$this->assembly_or_part_id','$this->display_order','$this->indent','$this->code_on_ref_figure', '$this->tc_description')";
		}
		$this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function deleteSelf () {
		$sqlTemp = "DELETE FROM unit_components WHERE id = $this->id";
		$this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
}