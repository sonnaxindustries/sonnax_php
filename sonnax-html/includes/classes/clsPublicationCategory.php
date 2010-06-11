<?
require_once "clsDataConn.php";

class PublicationCategory
{

	// Fields ///////////////////////////////////////////////////////////////
	private $dataconn;
	
	public $id               = null;
	public $name             = '';
	public $instructions     = 'Here are the results of your search. Click on the box to get the publication in printable pdf form.<br>Use your browser\'s back button to return to this page.';
	public $titleColumnName  = 'Title';
	public $authorColumnName = 'Author';
	public $dateColumnName   = 'Date';
	public $volumeColumnName = 'Volume';
	

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
				`id`, `category`, `instructions`, `titleColumnName`, 
				`authorColumnName`, `dateColumnName`, `volumeColumnName` 
			FROM publication_categories 
			WHERE id = '".mysql_real_escape_string($this->id)."'";
		$arr_data = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($arr_data)) {
			if (strlen($arr_data["publication_categories.category"][0]) > 0) {
				$this->name             = $arr_data["publication_categories.category"][0];
			}
			if (strlen($arr_data["publication_categories.instructions"][0]) > 0) {
				$this->instructions     = $arr_data["publication_categories.instructions"][0];
			}
			if (strlen($arr_data["publication_categories.titleColumnName"][0]) > 0) {
				$this->titleColumnName  = $arr_data["publication_categories.titleColumnName"][0];
			}
			if (strlen($arr_data["publication_categories.authorColumnName"][0]) > 0) {
				$this->authorColumnName = $arr_data["publication_categories.authorColumnName"][0];
			}
			if (strlen($arr_data["publication_categories.dateColumnName"][0]) > 0) {
				$this->dateColumnName   = $arr_data["publication_categories.dateColumnName"][0];
			}
			if (strlen($arr_data["publication_categories.volumeColumnName"][0]) > 0) {
				$this->volumeColumnName = $arr_data["publication_categories.volumeColumnName"][0];
			}
			
			return true;
		} else {
			$this->id = null;
			return null;
		}
	}
}