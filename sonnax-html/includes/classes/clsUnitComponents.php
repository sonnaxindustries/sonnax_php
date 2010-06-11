<?
require_once("clsDataConn.php");

class UnitComponents {

// Fields ///////////////////////////////////////////////////////////////
	public $unit_id;
	public $componentList;
	private $dataconn;
	public $count;
	
// Methods //////////////////////////////////////////////////////////////
	function __construct ($unit_id) {
		$this->dataconn = new DataConn("");
		$this->unit_id = $unit_id;
		$this->componentList = Search::unitComponents($unit_id);
		$this->makeCount();
	}
	
	function __destruct() {
		
	}
	
	private function makeCount () {
		$this->count = count($this->componentList);
	}
	
	public function deleteComponent ($component_id, $reload) {
		$component = new Component($component_id);
		$component->deleteSelf();
		if ($reload) {
			$this->componentList = Search::unitComponents($unit_id);
			$this->makeCount();
		}
	}
	
	public function addComponent ($component_type, $assembly_or_part_id, $code_on_ref_figure, $display_order=0, $indent = 0, $description="") {
		$sqlTemp = "INSERT INTO unit_components (unit_id, component_type, assembly_or_part_id, display_order, indent, code_on_ref_figure, description) 
					VALUES ($this->unit_id, $component_type, $assembly_or_part_id, $display_order, $indent, '$code_on_ref_figure', '$description')";
		$this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function deleteSelf() {
		
	}
	
	public function deleteAll () {
		for ($x=0;$x<=($this->count - 1);$x++) {
			$component = $this->componentList[$x];
			$this->deleteComponent($component_id, false);
		}
		$this->count = 0;
		$this->componentList = null;
	}
	
}
?>