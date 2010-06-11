<?
require_once("clsDataConn.php");
require_once("clsUnitMakes.php");
require_once("clsUnitComponents.php");
require_once("clsDataList.php");
require_once("clsRefFigure.php");
require_once("clsSearch.php");
require_once("clsComponent.php");

class Unit {

// Fields ///////////////////////////////////////////////////////////////
	public $id;
	public $components;
	public $makes;
	public $name;
	public $description;
	public $productLine;
	public $refFigure;
	private $dataList;
	private $dataconn;
	
// Methods //////////////////////////////////////////////////////////////
	function __construct ($id) {
		$this->dataconn = new DataConn("");
		$this->dataList = Search::unitById($id);
		$this->id = $id;
		$this->name = $this->dataList->arrayList['units.name'][0];
		$this->description = $this->dataList->arrayList['units.description'][0];
		$this->product_line = new ProductLine($this->dataList->arrayList['units.product_line'][0]);
		$this->refFigure = new RefFigure($this->dataList->arrayList['units.ref_figure_id'][0]);
		$this->lookupMakes();
		$this->lookupComponents();
	}
	
	function __destruct () {
	}
	
	private function lookupMakes () {
		$this->makes = new UnitMakes($this->id);
	}
	
	public function deleteMake ($makeId) {
		$this->makes->deleteUnitMake($makeId);
	}
	
	public function addMake ($makeId) {
		$this->makes->addUnitMake($makeId);
	}
	
	public function lookupComponents () {
		$this->components = new UnitComponents($this->id);
	}
	
	public function deleteComponent ($component_id) {
		$this->components->deleteComponent($component_id);
	}
	
	public function addComponent ($component_id) {
		$this->components->addComponent($component_id);
	}
	
	public function deleteSelf () {
		$this->dataconn->f_ExecuteSql("DELETE FROM unit_makes WHERE unit_id = $this->id ");
		$this->components->deleteAll();
		$this->dataconn->f_ExecuteSql("DELETE FROM units WHERE id = $this->id ");
	}
	
	public function toString() {
		echo "id: $this->id, name: $this->name, description: $this->description <BR>";
	}
}