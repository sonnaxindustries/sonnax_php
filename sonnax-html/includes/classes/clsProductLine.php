<?
/*
//debug code

require_once "clsDataConn.php";
$ProductLine = new ProductLine(2);
echo "top1 _" . $ProductLine->name . "_<BR>";

$ProductLine->name = "1.01";
echo "top2 _" . $ProductLine->name . "_<BR>";

$ProductLine->commitFields();

$RefFigure = new ProductLine(2);
echo "top3 _" . $ProductLine->name . "_<BR>";
*/

class ProductLine {

// Fields ///////////////////////////////////////////////////////////////
	public $id;
	public $name;
	
	private $dataconn;

// Methods //////////////////////////////////////////////////////////////
	function __construct ($id) 
	{
		$this->dataconn = new DataConn("");
		if (is_numeric($id)) {
			$this->id = $id;
			$this->name = $this->lookupProductLine($id);
		} else {
			$this->id = 0;
			$this->name = "";
		}
	}
	
	function __destruct ()
	{
		
	}
	
	public function deleteSelf () 
	{
		$sql = "DELETE FROM product_lines WHERE id = '".mysql_real_escape_string($this->id)."'";
		$this->dataconn->f_ExecuteSql($sql);
	}
	
	public function editName () 
	{
		$sql = "UPDATE product_lines SET name = '".mysql_real_escape_string($this->name)."' WHERE id = '".mysql_real_escape_string($this->id)."'";
		$this->dataconn->f_ExecuteSql($sql);
	}
	
	public function lookupProductLine ($id)
	{
		if (strlen($id) > 0) {
			$lookup_id = $id;
		} else {
			$lookup_id = $this->id;
		}
		$sql = "SELECT name FROM product_lines WHERE id = '".mysql_real_escape_string($lookup_id)."'";
		$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($productlineData)) {
			return $productlineData["product_lines.name"][0];
		} else {
			return "";
		}
	}
	
	public function lookupProductLineId ($name)
	{
		if (strlen($name) < 1) {
			return 0;
		} else {
			$sql = "SELECT id FROM product_lines WHERE name = '".mysql_real_escape_string($name)."'";
			$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
			if (is_array($productlineData)) {
				return $productlineData["product_lines.id"][0];
			} else {
				return 0;
			}
		}
	}
}