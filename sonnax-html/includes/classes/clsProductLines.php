<?
require_once("clsDataConn.php");
require_once("clsProductLine.php");

class ProductLines {

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
		$this->makeFormObjectsArrays();
	}
		
	public function getList ()
	{
		$sql = "SELECT id FROM product_lines WHERE active = 1 ORDER BY display_order";
		$productlineData = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		$this->count = count($productlineData,1) - 1;
		// ?? should be $this->count = count($productlineData["product_lines.id"]) - 1;
		for ($x=0; $x <= $this->count - 1; $x++) {// ?? ths appears to be a second -1 ??
			$this->list[$x] = new ProductLine($productlineData["product_lines.id"][$x]);		
		}
	}
	
	/**
	 * Makes the arrays used by the FormObjects class to drive select boxes.
	 *
	 */
	private function makeFormObjectsArrays () {
		for ($x = 0; $x <= $this->count - 1; $x++) {
			$product_line = $this->list[$x];
			$this->values[$x] = $product_line->id;
			$this->displays[$x] = $product_line->name;
		}
	}
	
}