<?
require_once "clsDataConn.php";

class NoOfTeeth {

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
			SELECT `no_of_teeth`
			FROM `parts`
			GROUP BY `no_of_teeth` 
			HAVING `no_of_teeth` <> '' 
			ORDER BY `no_of_teeth` + 0 ASC";//this '+ 0 ASC' makes it sort the character numbers as real numbers
		$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($productlineData["parts.no_of_teeth"]) - 1;
		for ($x=0; $x <= $this->count; $x++) {
			//Makes two arrays used by the FormObjects class to drive select boxes.
			$this->values[$x] = $productlineData["parts.no_of_teeth"][$x];
			$this->displays[$x] = $productlineData["parts.no_of_teeth"][$x];
		}
	}
}