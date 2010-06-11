<?
require_once "clsDataConn.php";

$dataconn = new DataConn("");

	$sqlTemp = "SELECT `make` FROM `makes` WHERE 1";
	$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
	if (is_array($arr_data["makes.make"])) {
		var_dump($arr_data);	
	} else {
		echo "not an array";
	}
?>