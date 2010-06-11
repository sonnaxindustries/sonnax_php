<?
require_once("clsDataConn.php");

class DataList {

// Fields ///////////////////////////////////////////////////////////////
	public $count;
	public $arrayList;
	public $countOnTableDotField;
	private $dataconn;
	private $sql;

// Methods //////////////////////////////////////////////////////////////
	function __construct ($sql,$fieldToCountOn) {
		$this->sql = $sql;
		$this->countOnTableDotField = $fieldToCountOn;
		$this->dataconn = new DataConn("");
		$this->fillArray();
		$this->makeCount();
	}
	
	function __destruct () {
	}
	
	public function fillArray () {
		$this->arrayList = $this->dataconn->f_ReturnArrayAssoc_TF($this->sql);
	}
	
	public function makeCount () {
		//echo "new _" . $this->countOnTableDotField . "_<BR>\n";
		$this->count = count($this->arrayList["$this->countOnTableDotField"]);
		//echo "count _" . $this->count . "_<HR>\n";
	}
	
	public function toString() {
		echo "$this->sql";
	}
}