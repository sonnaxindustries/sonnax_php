<?
require_once("clsDataConn.php");
require_once("clsMake.php");

class Makes {

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
		$sql = "SELECT unit_makes.make_id FROM unit_makes
				LEFT JOIN units ON unit_makes.unit_id = units.id
				LEFT JOIN makes ON unit_makes.make_id = makes.id
				WHERE units.product_line = '$this->product_line' 
					AND unit_makes.make_id > 0 
				GROUP BY unit_makes.make_id
				ORDER BY makes.make";
		$makeData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($makeData["unit_makes.make_id"]);
		for ($x=0; $x <= $this->count - 1; $x++) {
			$this->list[$x] = new Make($makeData["unit_makes.make_id"][$x]);		
		}
	}
	
	/**
	 * Makes the arrays used by the FormObjects class to drive select boxes.
	 *
	 */
	private function makeFormObjectsArrays () {
		for ($x = 0; $x <= $this->count - 1; $x++) {
			$make = $this->list[$x];
			$this->values[$x] = $make->id;
			$this->displays[$x] = $make->make;
		}
	}
	
	/**
	 * Returns a make name given a make id
	 *
	 */
	public function getMakeName ($make_id)
	{
		for ($x=0; $x <= $this->count - 1; $x++) {
			if ($make_id == $this->list[$x]->id) {
				return $this->list[$x]->make;
			}
		}
		return "";
	}
}

?>
