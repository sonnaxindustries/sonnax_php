<?
require_once("clsDataConn.php");
require_once("clsUnit.php");

class Units {

// Fields ///////////////////////////////////////////////////////////////
	private $dataconn;
	public $list;
	public $count;
	public $values;
	public $displays;
	public $product_line;

// Methods //////////////////////////////////////////////////////////////
	function __construct ($product_line) 
	{
		$this->dataconn = new DataConn("");
		$this->product_line = $product_line;
		$this->getList();
		$this->makeFormObjectsArrays();
	}
		
	public function getList ()
	{
		$sql = "SELECT units.id FROM units
				WHERE units.product_line = '$this->product_line'
				ORDER BY units.name";
		$unitData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($unitData,1) - 1;
		for ($x=0; $x <= $this->count - 1; $x++) {
			$this->list[$x] = new Unit($unitData["units.id"][$x]);		
		}
	}
	
	/**
	 * Makes the arrays used by the FormObjects class to drive select boxes.
	 *
	 */
	private function makeFormObjectsArrays () {
		for ($x = 0; $x <= $this->count - 1; $x++) {
			$unit = $this->list[$x];
			$this->values[$x] = $unit->id;
			$this->displays[$x] = $unit->name;
		}
	}
	
}

?>
