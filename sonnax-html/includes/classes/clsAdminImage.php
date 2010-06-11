<?
class Image {
	private $dataconn;

	public function __construct() {
		$this->dataconn = new DataConn("southernvtauction");
	}

	public function __destruct() {

	}
	
	public function f_get_new_image_height_for_fixed_width ($uploaded_image_width,$uploaded_image_height,$image_width_new) {
		$ratio = $uploaded_image_height / $uploaded_image_width;
		$image_height_new = ceil($image_width_new * $ratio);
		return $image_height_new;
	}
	
	public function f_get_new_image_height ($uploaded_image_width,$uploaded_image_height,$resized_image_longest_side) {
		
		if ($uploaded_image_width > $uploaded_image_height) {
			$landscape = true;
			$image_width_new = $resized_image_longest_side;
			$ratio = $uploaded_image_height / $uploaded_image_width;
			$image_height_new = ceil($image_width_new * $ratio);
		} else { //also covers square images
			$landscape = false;
			$image_height_new = $resized_image_longest_side;
			$ratio = $uploaded_image_width / $uploaded_image_height;
			$image_width_new = ceil($image_height_new * $ratio);
		}
		
		return $image_width_new . "-" . $image_height_new;
	}
	
	public function f_insert_image_into_image_table ($file_name, $caption, $current_auction = 0) {
		if ($current_auction != 0) {
			$current_auction = 1;
		}
		$sqlTemp = "
			INSERT INTO `images` 
				(location,caption,current_auction) 
			VALUES (
				'$file_name',
				'$caption',
				'$current_auction'
			)";
		return $this->dataconn->f_ExecuteSQLInsertID($sqlTemp);
	}
	
	public function f_update_image_id ($image_table, $image_field, $image_id) {
		$sqlTemp = "
			UPDATE `$image_table` SET 
				`$image_field` = '$image_id' 
			WHERE id = '1'";
		$this->dataconn->f_ExecuteSQL($sqlTemp);
	}
	
	
	public function f_reset_page_image_reference ($image_type,$image_field) {
		
		switch ($image_type) {
			case "about_us":
				$image_table = "about_us_page";
				break;
			case "index_side":
				$image_table = "index_page";
				break;
			case "index_center":
				$image_table = "index_page";
				break;
			case "past_sales":
				$image_table = "past_sales_page";
				break;
			case "current":
				$image_table = "images";
				break;
			default:
				return false;
		}
		
		$sqlTemp = "
			UPDATE `$image_table` SET 
				`$image_field` = '0' 
			WHERE id = '1'";
		$this->dataconn->f_ExecuteSQL($sqlTemp);
	}


	public function f_get_page_image_id ($table, $field) {
		$sqlTemp = "SELECT $field FROM $table WHERE id = '1'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results["$table.$field"][0];
		} else {
			return 0;
		}
	}
	
	public function f_get_image_location ($image_id) {
		$sqlTemp = "SELECT location FROM images WHERE id = '" . mysql_real_escape_string($image_id) . "'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results["images.location"][0];
		} else {
			return 0;
		}
	}
	
	public function f_get_image_caption ($image_id) {
		$sqlTemp = "SELECT caption FROM images WHERE id = '" . mysql_real_escape_string($image_id) . "'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results["images.caption"][0];
		} else {
			return "";
		}
	}
	
	public function f_update_caption ($image_id,$caption_text) {
		//$arr_image_data is a 2d array of id/order#
		$sqlTemp = "
			UPDATE `images` SET 
				`caption` = '" . mysql_real_escape_string($caption_text) . "' 
			WHERE id = '" . mysql_real_escape_string($image_id) . "'";
		$this->dataconn->f_ExecuteSQL($sqlTemp);
	}

	public function f_delete_image ($image_id) {
		//lookup the filename
		$image_location = $this->f_get_image_location ($image_id);
		
		//delete the four possible locations for the file
		$image_directory_path = "/home/htmldocs/southernvtauction/images/";
		$image_directory_path2 = "/home/htmldocs/southernvtauction/images/auction/";
		unlink($image_directory_path.$image_location);//full size in "/images/"
		unlink($image_directory_path."t_".$image_location);//thumb size in "/images/"
		unlink($image_directory_path2.$image_location);//full size in "/images/auction"
		unlink($image_directory_path2."t_".$image_location);//thumb size in "/images/auction/"
		
		//remove from the db
		$sqlTemp = "DELETE FROM images WHERE id = '" . mysql_real_escape_string($image_id) . "'";
		$this->dataconn->f_ExecuteSQL($sqlTemp);
		
		
	}
	
	public function f_update_image_order ($image_id,$image_order) {
		//$arr_image_data is a 2d array of id/order#
		$sqlTemp = "
			UPDATE `images` SET 
				`order` = '" . mysql_real_escape_string($image_order) . "' 
			WHERE id = '" . mysql_real_escape_string($image_id) . "'";
		$this->dataconn->f_ExecuteSQL($sqlTemp);
	}
	
	public function clean ($input, $maxlength) {
		$input = substr($input, 0, $maxlength);
		$input = EscapeShellCmd($input);
		return ($input);
	}
	
	public function f_count_current_auction_photos () {
		/*
		$sqlTemp = "
			SELECT COUNT(*) 
			FROM images 
			WHERE current_auction = '1'";
		return $this->dataconn->f_count_records($sqlTemp);
		*/
		
		$sqlTemp = "
			SELECT location 
			FROM images 
			WHERE current_auction = '1'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return count($results["images.location"])-1;
		} else {
			return -1;
		}
	}
	
	public function f_get_current_auction_photos ($start_position, $items_per_page) {
		if (!is_numeric($start_position)) {
			$start_position = 0;
		} elseif ($start_position < 0) {
			$start_position = 0;
		}
		
		$sqlTemp = "
			SELECT `id`,`location`,`caption`,`order` 
			FROM `images` 
			WHERE `current_auction` = '1' 
			ORDER BY `order`";
		if (is_numeric($start_position) && is_numeric($items_per_page)) {
			$sqlTemp .= "LIMIT $start_position, $items_per_page;";
		} else {
			$sqlTemp .= "LIMIT 400;";
		}
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return $results;
		} else {
			return -1;
		}
	}
}


?>