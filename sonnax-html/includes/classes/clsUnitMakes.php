<?
require_once("clsDataConn.php");

class UnitMakes {

// Fields ///////////////////////////////////////////////////////////////
	public $unit_id;
	public $makeList;
	private $dataconn;
	public $count;
	
// Methods //////////////////////////////////////////////////////////////
	function __construct ($unit_id) {
		$this->dataconn = new DataConn("");
		$this->unit_id = $unit_id;
		$this->makeList = Search::unitMakes($this->unit_id);
		$this->makeCount();
	}
	
	function __destruct () {
	}
	
	public function deleteUnitMake ($makeId) {
		$sqlTemp = "DELETE FROM unit_makes WHERE unit_id=$this->unit_id AND make_id=$makeId";
		$this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function addUnitMake ($makeId) {
		$sqlTemp = "INSERT INTO unit_makes (unit_id, make_id) VALUES ($this->unit_id, $makeId)";
		$this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function makeCount () {
		$this->count = count($this->makeList);
	}
	
	public function toString() {
		echo "UnitMakes for unit: $this->unit_id <BR>";
		for ($x=0;$x <= ($this->count - 1); $x++) {
			$make &= $this->makeList[$x];
			echo "$make->id: $make->name;<BR>";
		}
		echo "<BR>";
	}
}


?>