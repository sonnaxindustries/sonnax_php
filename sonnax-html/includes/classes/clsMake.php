<?
/*
//debug code

require_once "clsDataConn.php";
$Make = new Make(2);
echo "top1 _" . $Make->make . "_<BR>";

$Make->name = "1.01";
echo "top2 _" . $Make->make . "_<BR>";

$Make->commitFields();

$Make = new Make(2);
echo "top3 _" . $Make->make . "_<BR>";
*/

class Make {

// Fields ///////////////////////////////////////////////////////////////
	public $id;
	public $make;
	
	private $dataconn;
	
// Methods //////////////////////////////////////////////////////////////
	function __construct ($id) 
	{
		$this->dataconn = new DataConn("");
		if (is_numeric($id)) {
			$this->id = $id;
			$this->make = $this->lookupMake($id);
		} else {
			$this->id = 0;
			$this->make = "";
		}
	}
	
	function __destruct () 
	{
		
	}
	
	public function editName () 
	{
		$sql = "UPDATE makes SET make = '".mysql_real_escape_string($this->make)."' WHERE id = '".mysql_real_escape_string($this->id)."'";
		$this->dataconn->f_ExecuteSql($sql);
	}
	
	public function deleteSelf () 
	{
		$sql = "DELETE FROM makes WHERE id = '".mysql_real_escape_string($this->id)."'";
		$this->dataconn->f_ExecuteSql($sql);
	}
	
	public function lookupMake ($id)
	{
		if (strlen($id) > 0) {
			$lookup_id = $id;
		} else {
			$lookup_id = $this->id;
		}
		$sql = "SELECT make FROM makes WHERE id = '".mysql_real_escape_string($lookup_id)."'";
		$makeData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($makeData)) {
			return $makeData["makes.make"][0];
		} else {
			return "";
		}
	}
	
	public function lookupMakeId ($make)
	{
		if (strlen($make) < 1) {
			return 0;
		} else {
			$sql = "SELECT id FROM makes WHERE make = '".mysql_real_escape_string($make)."'";
			$makeData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
			if (is_array($makeData)) {
				return $makeData["makes.id"][0];
			} else {
				return 0;
			}
		}
	}
}