<?
require_once "clsDataConn.php";

class TubeDiameterPTS {

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
			SELECT `steel_driveshaft_tube_od`
			FROM `unit_components`
			GROUP BY `steel_driveshaft_tube_od` 
			HAVING `steel_driveshaft_tube_od` <> '' 
			ORDER BY `steel_driveshaft_tube_od` + 0 ASC";//this '+ 0 ASC' makes it sort the character numbers as real numbers
		$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($productlineData["unit_components.steel_driveshaft_tube_od"]) - 1;
		for ($x=0; $x <= $this->count; $x++) {
			//Makes two arrays used by the FormObjects class to drive select boxes.
			$this->values[$x] = $productlineData["unit_components.steel_driveshaft_tube_od"][$x];
			$this->displays[$x] = $productlineData["unit_components.steel_driveshaft_tube_od"][$x];
		}
	}
}