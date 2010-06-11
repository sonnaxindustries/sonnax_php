<?
require_once "clsDataConn.php";

class Drivelines {

// Fields ///////////////////////////////////////////////////////////////
	private $dataconn;
	public $list;
	public $count;
	public $values;
	public $displays;

// Methods //////////////////////////////////////////////////////////////
	function __construct () 
	{
		$this->dataconn = new DataConn("");
		$this->getList();
	}
	
	public function getList ()
	{
		$sql = "
			SELECT `id`,`name` 
			FROM `units`
			WHERE `product_line` = 11 
			ORDER BY `name` + 0 ASC";//this '+ 0 ASC' makes it sort the character numbers as real numbers
		$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($productlineData["units.id"]) - 1;
		for ($x=0; $x <= $this->count; $x++) {
			//Makes two arrays used by the FormObjects class to drive select boxes.
			$this->values[$x] = $productlineData["units.id"][$x];
			$this->displays[$x] = $productlineData["units.name"][$x];
		}
	}
}