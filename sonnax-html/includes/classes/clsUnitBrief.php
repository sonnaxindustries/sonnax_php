<?
require_once("clsDataConn.php");

class UnitBrief {
// Fields ///////////////////////////////////////////////////////////////
	private $dataconn;
	private $datalist;
	public $id;
	public $name;
	public $description;
	public $product_line;
	public $ref_figure_id;

// Methods //////////////////////////////////////////////////////////////
	function __construct ($id) {
		//$database = "";
		$this->datalist = Search::unitById($id);
		$this->id = $id;
		$this->name = $this->datalist->arrayList["units.name"][0];
		$this->description = $this->datalist->arrayList["units.description"][0];
		$this->product_line = $this->datalist->arrayList["units.product_line"][0];
		$this->ref_figure_id = $this->datalist->arrayList["units.ref_figure_id"][0];
	}
}
?>