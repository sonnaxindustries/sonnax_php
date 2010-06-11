<?
function GetPrimaryRow($item_id) { //make sure record exist for primary images on item, add one if neccessary
	
	if(strlen($item_id) < 1){
		$item_id = "0";
	}
	
	$sqlTemp = "SELECT ID FROM images WHERE itemID = $item_id AND primary_flag = 1";
	$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}
	$intNumRows = mysql_num_rows($result)-1; // check to see if row exists
	if ($intNumRows > -1) { 
		$row = mysql_fetch_array($result, MYSQL_NUM);
		return $row[0];
	} else {
		return -1;
	}
}

function GetPrimaryRowORIGINAL($item_id) { //make sure record exist for primary images on item, add one if neccessary
	
	if(strlen($item_id) < 1){
		$item_id = "0";
	}
	
	$sqlTemp = "SELECT ID FROM images WHERE itemID = $item_id AND primary_flag = 1";
	$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}
	
	$intNumRows = mysql_num_rows($result)-1; // check to see if row exists
	if ($intNumRows < 0) { 
		//add row to table
		$sqlTemp = "INSERT INTO images (itemID, primary_flag) VALUES ($item_id, 1);";
		$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}
		
		$sqlTemp = "SELECT ID FROM images WHERE itemID = $item_id AND primary_flag = 1";
		$result = mysql_query ($sqlTemp);
			if(mysql_errno() != 0) {
				echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
				echo "SQL=" . $sqlTemp . "<BR>";
				exit;
			}
	}

	$row = mysql_fetch_array($result, MYSQL_NUM);
	return $row[0];
}


function GetAdditionalImages($item_id) {
	$sqlTemp = "SELECT ID FROM images WHERE itemID = $item_id AND primary_flag <> 1 ORDER BY ID";
	$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}
	
	$intCounter = -1;
	while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
		$intCounter++;
		$arrAddImage[$intCounter] = $row[0];
	}
	return $arrAddImage;
}

function f_GetPrimaryImageIdFromProductCode($productcode) {
	
	if(strlen($productcode) > 0){
		
		$sqlTemp = "SELECT BookID FROM items WHERE ISBN = '" . $productcode . "';";
		$result = mysql_query ($sqlTemp);
			if(mysql_errno() != 0) {
				echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
				echo "SQL: " . $sqlTemp . "<BR>";
				exit;
			}
		$intNumRows = mysql_num_rows($result)-1;
		if ($intNumRows > -1) { 
			$row = mysql_fetch_array($result, MYSQL_NUM);
			$item_id = $row[0];
			
			$sqlTemp = "SELECT ID FROM images WHERE itemID = '" . $item_id . "' AND primary_flag = 1";
			$result = mysql_query ($sqlTemp);
				if(mysql_errno() != 0) {
					echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
					echo "SQL: " . $sqlTemp . "<BR>";
					exit;
				}
			$intNumRows = mysql_num_rows($result)-1;
			if ($intNumRows > -1) { 
				$row = mysql_fetch_array($result, MYSQL_NUM);
				return $row[0]; //Success, we found a primary image id
			} else {
				return -1; //Failure, itemID (with primary_flag = 1) not found in images table
			}
		} else {
			return -1; //Failure, product code not found in items table
		}
	} else {
		return -1; //Failure, bogus product code
	}
}


function f_GetPrimaryImageIdFromItemId($item_id) {
	if(strlen($item_id) > 0){
		$sqlTemp = "SELECT ID FROM images WHERE itemID = '" . $item_id . "' AND primary_flag = 1";
		$result = mysql_query ($sqlTemp);
			if(mysql_errno() != 0) {
				echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
				echo "SQL: " . $sqlTemp . "<BR>";
				exit;
			}
		$intNumRows = mysql_num_rows($result)-1;
		if ($intNumRows > -1) { 
			$row = mysql_fetch_array($result, MYSQL_NUM);
			return $row[0]; //Success, we found a primary image id
		} else {
			return -1; //Failure, itemID (with primary_flag = 1) not found in images table
		}
	} else {
		return -1; //Failure, bogus item_id
	}
}


function f_GetAdditionalImagesFromProductCode($productcode) {
	if(strlen($productcode) > 0){
		$sqlTemp = "SELECT BookID FROM items WHERE ISBN = '" . $productcode . "';";
		$result = mysql_query ($sqlTemp);
			if(mysql_errno() != 0) {
				echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
				echo "SQL: " . $sqlTemp . "<BR>";
				exit;
			}
		$intNumRows = mysql_num_rows($result)-1;
		if ($intNumRows > -1) { 
			$row = mysql_fetch_array($result, MYSQL_NUM);
			$item_id = $row[0];
			
			$sqlTemp = "SELECT ID FROM images WHERE itemID = $item_id AND primary_flag <> 1 ORDER BY ID";
			$result = mysql_query ($sqlTemp);
				if(mysql_errno() != 0) {
					echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
					echo "SQL=" . $sqlTemp . "<BR>";
					exit;
				}
			
			$intCounter = -1;
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intCounter++;
				$arrAddImage[$intCounter] = $row[0];
			}
			if($intCounter != -1){
				return $arrAddImage;
			} else {
				return -1; //Failure, itemID (with primary_flag = 1) not found in images table
			}
		} else {
			return -1; //Failure, product code not found in items table
		}
	} else {
		return -1; //Failure, bogus product code
	}
}?>