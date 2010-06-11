<?
require_once("clsDataConn.php");

/**
 * Used for making unit lists that do not contain all of the units data, just the name and id's.
 * Created for units select box.
 *
 */
class UnitsBrief {

// Fields ///////////////////////////////////////////////////////////////
	private $dataconn;
	public $count;
	public $values;
	public $displays;
	public $product_line;
	public $make;

// Methods //////////////////////////////////////////////////////////////
	function __construct ($product_line, $make = 0) 
	{
		$this->dataconn = new DataConn("");
		$this->product_line = $product_line;
		$this->make = $make;
		$this->getList();
	}
		
	public function getList ()
	{
		if ($this->make == 0) {
			$sql = "
				SELECT units.id, units.name 
				FROM units
				WHERE units.product_line = '".mysql_real_escape_string($this->product_line)."' 
				ORDER BY units.name";
		} elseif ($this->make != 0 && is_numeric($this->make)) {
			$sql = "
				SELECT units.id, units.name 
				FROM units
					INNER JOIN unit_makes 
						ON units.id = unit_makes.unit_id 
				WHERE units.product_line = '".mysql_real_escape_string($this->product_line)."' 
					AND unit_makes.make_id = '".mysql_real_escape_string($this->make)."' 
				ORDER BY units.name";
		}
		//echo $sql . "<BR>\n";
		$unitData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($unitData["units.id"]) - 1;
		for ($x=0; $x <= $this->count; $x++) {
			$this->values[$x] = $unitData["units.id"][$x];
			$this->displays[$x] = $unitData["units.name"][$x];
		}
	}	
}

?>
