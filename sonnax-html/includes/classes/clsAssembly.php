<?
class Assembly {
	
	// Fields /////////////////////////////////////////////////////////
	public $id=0;
	public $assembly="";
	private $assembly_parts;
	public $part_stack;
	private $dataconn;
	private $dataList;
	public $component_id;
	
	public $display_order;
	public $indent;
	
	// Methods ////////////////////////////////////////////////////////
	function __construct ($id, $display_order, $indent, $component_id) {
		$this->id = $id;
		$this->dataconn = new DataConn("");
		if ($id != 0 && is_numeric($id)) {
			$this->dataList = Search::assemblyById($id);
			$this->assembly = $this->dataList->arrayList['assemblies.assembly'][0];
			$this->lookupAssemblyParts();
			$this->display_order = $display_order;
			$this->indent = $indent;
			$this->component_id = $component_id;
		}
	}
	
	function __destruct () {
	}
	
	public function lookupAssemblyParts () {
		$this->part_stack = new PartStack();							// array of part objects
		$this->assembly_parts = Search::assemblyParts($this->id);
		$upperBound = count($this->assembly_parts) - 1;
		for ($x=0; $x <= $upperBound; $x++) {
			$assembly_part = $this->assembly_parts[$x];
			//$this->part_stack->addPart($assembly_part->part_id, $assembly_part->code_on_ref_figure);
			$this->part_stack->addPart($assembly_part->part_id, $assembly_part->code_on_ref_figure,"",$assembly_part->id/*MAY_NEED_ASSEMBLY_ID_HERE*/);
		}
		$this->part_stack->sortByRefNumberHPTC();//now being sorted by the SQL in the clsSearch 
	}
	
	public function removePart ($part_id, $reload=true) {
		if ($this->id != 0) {
			$this->dataconn->f_ExecuteSql("DELETE FROM assembly_parts WHERE part_id = $part_id AND assembly_id = $this->id ");
			if ($reload) {
				$this->lookupAssemblyParts();
			}
		}
	}
	
	public function addPart ($part_id, $code_on_ref_figure, $display_order=0) {
		if ($this->id != 0) {
			$this->dataconn->f_ExecuteSql("INSERT INTO assembly_parts (assembly_id, part_id, code_on_ref_figure, display_order) VALUES ('$this->id','$part_id','$code_on_ref_figure','$display_order')");
			$this->lookupAssemblyParts();
		}
	}
	
	public function commitFields () {
		if ( ($this->id == 0) && (strlen($this->assembly) > 0) ) {
			$this->id = $this->dataconn->f_ExecuteSqlInsertID("INSERT INTO assemblies (assembly) VALUES ('$this->assembly')");
		} elseif (strlen($this->assembly) > 0) {
			$this->dataconn->f_ExecuteSql("UPDATE assemblies SET assembly = '$this->assembly' WHERE id = $this->id");
		} else {
			echo "Assembly Commit Error => ID: $this->id, Assembly: $this->assembly";
			exit(0);
		}
	}
	
	public function deleteSelf () {
		$this->dataconn->f_ExecuteSql("DELETE FROM assembly_parts WHERE assembly_id = $this->id");
		$this->dataconn->f_ExecuteSql("DELETE FROM assemblies WHERE id = $this->id");
		$this->count = 0;
		$this->parts = null;
	}

}