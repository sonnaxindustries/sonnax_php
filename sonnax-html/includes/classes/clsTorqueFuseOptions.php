<?
require_once "clsDataConn.php";

class TorqueFuseOptions {

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
			SELECT `torque_fuse_options`
			FROM `unit_components`
			GROUP BY `torque_fuse_options` 
			HAVING `torque_fuse_options` <> '' 
			ORDER BY `torque_fuse_options` + 0 ASC";//adding '+ 0 ASC' makes it sort the character numbers as real numbers
		//echo $sql . "<BR>\n";
		//flush();
		$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($productlineData["unit_components.torque_fuse_options"]) - 1;
		for ($x=0; $x <= $this->count; $x++) {
			//Makes two arrays used by the FormObjects class to drive select boxes.
			$this->values[$x] = $productlineData["unit_components.torque_fuse_options"][$x];
			$this->displays[$x] = $productlineData["unit_components.torque_fuse_options"][$x];
		}
	}
}