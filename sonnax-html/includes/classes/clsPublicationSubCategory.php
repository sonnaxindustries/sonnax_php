<?
require_once "clsDataConn.php";

class PublicationSubCategory
{

	// Fields ///////////////////////////////////////////////////////////////
	private $dataconn;
	
	public $id               = null;
	public $name             = '';
	public $instructions     = '';
	public $titleColumnName  = '';
	public $authorColumnName = '';
	public $dateColumnName   = '';
	public $volumeColumnName = '';
	

	// Methods //////////////////////////////////////////////////////////////
	function __construct($id='') 
	{
		$this->dataconn = new DataConn("");
		
		if (is_numeric($id)) {
			$this->id = $id;
			$this->loadSelf();
		}
	}
	
	
	private function loadSelf()
	{
		$sql = "SELECT 
				`id`, `subcategory`, `publication_category`, 
				`instructions`, `titleColumnName`, 
				`authorColumnName`, `dateColumnName`, `volumeColumnName` 
			FROM `publication_subcategories` 
			WHERE id = '".mysql_real_escape_string($this->id)."'";
		$arr_data = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($arr_data)) {
			$this->name             = $arr_data["publication_subcategories.subcategory"][0];
			if (strlen($arr_data["publication_subcategories.instructions"][0]) > 0) {
				$this->instructions     = $arr_data["publication_subcategories.instructions"][0];
			}
			if (strlen($arr_data["publication_subcategories.titleColumnName"][0]) > 0) {
				$this->titleColumnName  = $arr_data["publication_subcategories.titleColumnName"][0];
			}
			if (strlen($arr_data["publication_subcategories.authorColumnName"][0]) > 0) {
				$this->authorColumnName = $arr_data["publication_subcategories.authorColumnName"][0];
			}
			if (strlen($arr_data["publication_subcategories.dateColumnName"][0]) > 0) {
				$this->dateColumnName   = $arr_data["publication_subcategories.dateColumnName"][0];
			}
			if (strlen($arr_data["publication_subcategories.volumeColumnName"][0]) > 0) {
				$this->volumeColumnName = $arr_data["publication_subcategories.volumeColumnName"][0];
			}
			
			return true;
		} else {
			$this->id = null;
			return null;
		}
	}
}