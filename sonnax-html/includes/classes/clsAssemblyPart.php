<?
class AssemblyPart {
// Fields ///////////////////////////////////////////////////////////////
	public $id;
	public $assembly_id;
	public $part_id;
	public $code_on_ref_figure = "";
	public $display_order = 0;
	public $part;
	private $dataconn;
	private $datalist;
	
// Methods //////////////////////////////////////////////////////////////
	function __construct ($id) {
		$this->id = $id;
		$this->dataconn = new DataConn("");
		if ($id != 0 && is_numeric($id)) {
			$this->lookupAssemblyPart();
		}
	}
	
	function __destruct () {
	}
	
	function lookupAssemblyPart () {
		$this->datalist = Search::assemblyPartByID($this->id);
		$this->assembly_id = $this->datalist->arrayList["assembly_parts.assembly_id"][0];
		$this->part_id = $this->datalist->arrayList["assembly_parts.part_id"][0];
		$this->code_on_ref_figure = $this->datalist->arrayList["assembly_parts.code_on_ref_figure"][0];
		$this->display_order = $this->datalist->arrayList["assembly_parts.display_order"][0];
		$this->part = new Part($this->part_id);
	}
	
	public function commitFields () {
		if ( ($this->id == 0) && is_numeric($this->part_id) && is_numeric($this->assembly_id)  ) {
			$this->id = $this->dataconn->f_ExecuteSqlInsertID(
				"INSERT INTO assembly_parts (assembly_id, part_id, code_on_ref_figure, display_order) VALUES ('$this->assembly_id','$this->part_id','$this->code_on_ref_figure','$this->display_order')"
			);
		} elseif ( is_numeric($this->part_id) && is_numeric($this->assembly_id ) ) {
			$this->dataconn->f_ExecuteSql(
				"UPDATE assemblies SET 
					assembly_id = '$this->assembly_id',
					part_id = '$this->part_id',
					code_on_ref_figure = '$this->code_on_ref_figure',
					display_order = '$this->display_order' 
				WHERE id = $this->id"
			);
		} else {
			echo "AssemblyPart Commit Error => ID: $this->id, PartID: $this->part_id ";
			exit(0);
		}
	}
	
	public function deleteSelf () {
		$this->dataconn->f_ExecuteSql("DELETE FROM assembly_parts WHERE assembly_id = $this->id");
	}

}


?>