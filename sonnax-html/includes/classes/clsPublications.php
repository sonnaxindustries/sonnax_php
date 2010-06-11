<?
require_once "clsDataConn.php";

class Publications {

	// Fields ///////////////////////////////////////////////////////////////
	//public $id;
	//public $name;
	
	private $dataconn;

	// Methods //////////////////////////////////////////////////////////////
	function __construct() 
	{
		$this->dataconn = new DataConn("");
		/*
		if (is_numeric($id)) {
			$this->id = $id;
			$this->name = $this->lookupProductLine($id);
		} else {
			$this->id = 0;
			$this->name = "";
		}*/
	}
	
	function __destruct()
	{
		
	}
	
	public function lookupPublicationCategories()
	{
		$sql = "SELECT 
				`id`, `category`, `instructions`, `titleColumnName`, 
				`authorColumnName`, `dateColumnName`, `volumeColumnName` 
			FROM publication_categories ORDER BY category";
		$arr_data = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($arr_data)) {
			return $arr_data;
		} else {
			return -1;
		}
	}
	
	public function lookupPublicationSubCategories($publication_category)
	{
		$sql = "
			SELECT 
				id,subcategory,publication_category 
			FROM publication_subcategories 
			WHERE publication_category = '".mysql_real_escape_string($publication_category)."' 
			ORDER BY subcategory";
		$arr_data = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($arr_data)) {
			return $arr_data;
		} else {
			return -1;
		}
	}
	
	public function getSubcategoryName($subcategory_id)
	{
		$sql = "
			SELECT 
				subcategory 
			FROM publication_subcategories 
			WHERE `id` = '".mysql_real_escape_string($subcategory_id)."'";
		$arr_data = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($arr_data)) {
			return $arr_data["publication_subcategories.subcategory"][0];
		} else {
			return "";
		}
	}
	
	public function lookupSubCategoryTitles($subcategory_id, $order_by = 'title')
	{
		$sql = "
			SELECT 
				`publication_titles`.`id`, `publication_titles`.`title`, 
				`publication_titles`.`author`, `publication_titles`.`date`, 
				`publication_titles`.`volume`, `publication_titles`.`pdf`, 
				`publication_subcategory_titles`.`id` 
			FROM `publication_subcategory_titles` 
				LEFT JOIN `publication_titles` 
				ON `publication_subcategory_titles`.`title_id` = `publication_titles`.`id`
			WHERE `subcategory_id` = '".mysql_real_escape_string($subcategory_id)."' 
			ORDER BY `publication_titles`.`" . $order_by . "`";
		$arr_data = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($arr_data)) {
			return $arr_data;
		} else {
			return -1;
		}
	}
	
	public function titleSearch($title)
	{
		$sql = "
			SELECT 
				`publication_titles`.`id`, `publication_titles`.`title`, 
				`publication_titles`.`author`, `publication_titles`.`date`, 
				`publication_titles`.`volume`, `publication_titles`.`pdf`, 
				`publication_subcategory_titles`.`id` 
			FROM `publication_titles` 
				LEFT JOIN `publication_subcategory_titles` 
				ON `publication_titles`.`id` = `publication_subcategory_titles`.`title_id` 
			WHERE `publication_titles`.`title` LIKE '".mysql_real_escape_string($title)."%' 
			ORDER BY `publication_titles`.`title`";
		//echo $sql . "<BR>\n";
		//flush;
		$arr_data = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (is_array($arr_data)) {
			return $arr_data;
		} else {
			return -1;
		}
	}
}