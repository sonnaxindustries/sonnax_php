<?
require_once "clsDataConn.php";

class TubeDiameterDriveline {

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
			SELECT `tube_diameter`
			FROM `parts`
			GROUP BY `tube_diameter` 
			HAVING `tube_diameter` <> '' 
			ORDER BY `tube_diameter` + 0 ASC";//this '+ 0 ASC' makes it sort the character numbers as real numbers
		$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($productlineData["parts.tube_diameter"]) - 1;
		for ($x=0; $x <= $this->count; $x++) {
			//Makes two arrays used by the FormObjects class to drive select boxes.
			$this->values[$x] = $productlineData["parts.tube_diameter"][$x];
			$this->displays[$x] = $productlineData["parts.tube_diameter"][$x];
		}
	}
}