<?
class Admin {
	private $dataconn;

	public function __construct() {
		$this->dataconn = new DataConn("southernvtauction");
	}

	public function __destruct() {

	}

	/**
	*/
	
	
	public function current_photos_content_update ($str_data) {
		$sqlTemp = "
			UPDATE photos_page SET 
				content = '" . mysql_real_escape_string($str_data) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function current_photos_content_select() {
		$sqlTemp = "SELECT content FROM photos_page WHERE id = '1'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results["photos_page.content"][0];
		} else {
			return "";
		}
	}
	
	
	public function catalog_content_update ($str_data) {
		$sqlTemp = "
			UPDATE catalog_page SET 
				content = '" . mysql_real_escape_string($str_data) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function catalog_content_select() {
		$sqlTemp = "SELECT content FROM catalog_page WHERE id = '1'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results["catalog_page.content"][0];
		} else {
			return "";
		}
	}
	
	public function past_sales_image_update ($image_number, $image_id) {
		$sqlTemp = "
			UPDATE past_sales_page SET 
				past_sales_page.image" . $image_number . "_id = '" . mysql_real_escape_string($image_id) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function past_sales_select() {
		$sqlTemp = "
			SELECT 
				past_sales_page.id, 
				past_sales_page.image1_id, images_1.location, images_1.caption, 
				past_sales_page.image2_id, images_2.location, images_2.caption,
				past_sales_page.image3_id, images_3.location, images_3.caption,
				past_sales_page.image4_id, images_4.location, images_4.caption 
			FROM (((
				past_sales_page 
				LEFT JOIN images AS images_1 ON past_sales_page.image1_id = images_1.id) 
				LEFT JOIN images AS images_2 ON past_sales_page.image2_id = images_2.id) 
				LEFT JOIN images AS images_3 ON past_sales_page.image3_id = images_3.id) 
				LEFT JOIN images AS images_4 ON past_sales_page.image4_id = images_4.id 
			WHERE past_sales_page.id = '1'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results;
		} else {
			return -1;
		}
	}
	
	public function about_us_content_update ($str_data) {
		$sqlTemp = "
			UPDATE about_us_page SET 
				content = '" . mysql_real_escape_string($str_data) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function about_us_image_update ($image_number, $image_id) {
		$sqlTemp = "
			UPDATE about_us_page SET 
				about_us_page.image" . $image_number . "_id = '" . mysql_real_escape_string($image_id) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function about_us_select() {
		$sqlTemp = "
			SELECT 
				about_us_page.id, about_us_page.content, 
				about_us_page.image1_id, images_1.location, images_1.caption, 
				about_us_page.image2_id, images_2.location, images_2.caption,
				about_us_page.image3_id, images_3.location, images_3.caption 
			FROM ((
				about_us_page 
				LEFT JOIN images AS images_1 ON about_us_page.image1_id = images_1.id) 
				LEFT JOIN images AS images_2 ON about_us_page.image2_id = images_2.id) 
				LEFT JOIN images AS images_3 ON about_us_page.image3_id = images_3.id 
			WHERE about_us_page.id = '1'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results;
		} else {
			return -1;
		}
	}
	
	
	
	public function index_content1_update ($str_data) {
		$sqlTemp = "
			UPDATE index_page SET 
				content1 = '" . mysql_real_escape_string($str_data) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function index_content2_update ($str_data) {
		$sqlTemp = "
			UPDATE index_page SET 
				content2 = '" . mysql_real_escape_string($str_data) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function index_image_update ($image_number, $image_id) {
		$sqlTemp = "
			UPDATE index_page SET 
				index_page.image" . $image_number . "_id = '" . mysql_real_escape_string($image_id) . "' 
			WHERE id = 1";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}
	
	public function index_select() {
		$sqlTemp = "
			SELECT 
				index_page.id, index_page.content1, index_page.content2, 
				index_page.right_image_1_id, images_1.location, images_1.caption, 
				index_page.right_image_2_id, images_2.location, images_2.caption, 
				index_page.right_image_3_id, images_3.location, images_3.caption, 
				index_page.right_image_4_id, images_4.location, images_4.caption, 
				index_page.right_image_5_id, images_5.location, images_5.caption, 
				index_page.right_image_6_id, images_6.location, images_6.caption, 
				index_page.right_image_7_id, images_7.location, images_7.caption, 
				index_page.right_image_8_id, images_8.location, images_8.caption, 
				index_page.right_image_9_id, images_21.location, images_21.caption, 
				index_page.center_image_1_id, images_9.location, images_9.caption, 
				index_page.center_image_2_id, images_10.location, images_10.caption, 
				index_page.center_image_3_id, images_11.location, images_11.caption, 
				index_page.center_image_4_id, images_12.location, images_12.caption, 
				index_page.left_image_1_id, images_13.location, images_13.caption, 
				index_page.left_image_2_id, images_14.location, images_14.caption, 
				index_page.left_image_3_id, images_15.location, images_15.caption, 
				index_page.left_image_4_id, images_16.location, images_16.caption, 
				index_page.left_image_5_id, images_17.location, images_17.caption, 
				index_page.left_image_6_id, images_18.location, images_18.caption, 
				index_page.left_image_7_id, images_19.location, images_19.caption, 
				index_page.left_image_8_id, images_20.location, images_20.caption, 
				index_page.left_image_9_id, images_22.location, images_22.caption 
			FROM (((((((((((((((((((((
				index_page 
				LEFT JOIN images AS images_1 ON index_page.right_image_1_id = images_1.id) 
				LEFT JOIN images AS images_2 ON index_page.right_image_2_id = images_2.id) 
				LEFT JOIN images AS images_3 ON index_page.right_image_3_id = images_3.id) 
				LEFT JOIN images AS images_4 ON index_page.right_image_4_id = images_4.id) 
				LEFT JOIN images AS images_5 ON index_page.right_image_5_id = images_5.id) 
				LEFT JOIN images AS images_6 ON index_page.right_image_6_id = images_6.id) 
				LEFT JOIN images AS images_7 ON index_page.right_image_7_id = images_7.id) 
				LEFT JOIN images AS images_8 ON index_page.right_image_8_id = images_8.id) 
				LEFT JOIN images AS images_9 ON index_page.center_image_1_id = images_9.id) 
				LEFT JOIN images AS images_10 ON index_page.center_image_2_id = images_10.id) 
				LEFT JOIN images AS images_11 ON index_page.center_image_3_id = images_11.id) 
				LEFT JOIN images AS images_12 ON index_page.center_image_4_id = images_12.id) 
				LEFT JOIN images AS images_13 ON index_page.left_image_1_id = images_13.id) 
				LEFT JOIN images AS images_14 ON index_page.left_image_2_id = images_14.id) 
				LEFT JOIN images AS images_15 ON index_page.left_image_3_id = images_15.id) 
				LEFT JOIN images AS images_16 ON index_page.left_image_4_id = images_16.id) 
				LEFT JOIN images AS images_17 ON index_page.left_image_5_id = images_17.id) 
				LEFT JOIN images AS images_18 ON index_page.left_image_6_id = images_18.id) 
				LEFT JOIN images AS images_19 ON index_page.left_image_7_id = images_19.id) 
				LEFT JOIN images AS images_20 ON index_page.left_image_8_id = images_20.id) 
				LEFT JOIN images AS images_21 ON index_page.right_image_9_id = images_21.id) 
				LEFT JOIN images AS images_22 ON index_page.left_image_9_id = images_22.id 
			WHERE index_page.id = '1'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results;
		} else {
			return -1;
		}
	}
}


?>