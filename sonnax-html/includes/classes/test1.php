<?
/*
require_once "clsDataConn.php";

$dataconn = new DataConn("");
	
for ($x=28;$x<=102;$x++) {
	$sqlTemp = "INSERT INTO publication_subcategory_titles (`id`,`title_id`) VALUES ('".$x."','".$x."')";
	$arr_data = $dataconn->f_ExecuteSql($sqlTemp);
}*/

/*
$a = 1;
$b = 2;
$a=$a|$b;
$b=$a^$b;
$a=$a^$b;

echo $a."<BR>\n";
echo $b."<BR>\n";
*/

/*
require_once "clsDataConn.php";

$dataconn = new DataConn("");

$sql = "SELECT
			`id`,`part_number`,`weight`  
		FROM `hpt_weights` 
		ORDER BY `part_number`";
echo $sql . "<BR>\n";
$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
if (is_array($result)) {
	$int_ubound = count($result["hpt_weights.id"])-1;
	for ($x=0;$x<=$int_ubound;$x++) {
		$sql = "
			UPDATE parts SET 
				weight = '".$result["hpt_weights.weight"][$x]."' 
			WHERE part_number = '".$result["hpt_weights.part_number"][$x]."'"; 
				//AND product_line = 1";
		echo $sql . "<BR>\n";
		$int_records_affected = $dataconn->f_ExecuteSql($sql);
		echo "int_records_affected _".$int_records_affected."_<HR>\n";
	}
}*/

/*
require_once "clsDataConn.php";

$dataconn = new DataConn("");

$sql = "SELECT
			`id`,`part_number`,`weight`  
		FROM `hpt_weights` 
		ORDER BY `part_number`";
echo $sql . "<BR>\n";
$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
if (is_array($result)) {
	$int_ubound = count($result["hpt_weights.id"])-1;
	for ($x=0;$x<=$int_ubound;$x++) {
		if ($x > 0) {
			$part_numbers .= ",";
		}
		$part_numbers .= "'".$result["hpt_weights.part_number"][$x]."'";
	}
	
	$sql = "SELECT
				`id`,`part_number`,`product_line`  
			FROM `parts` 
			WHERE part_number IN (".$part_numbers.")
			ORDER BY `product_line` ,`part_number`";
	echo $sql . "<BR>\n";
	$result = $dataconn->f_ReturnArrayAssoc_TF($sql);
	var_dump($result);
}*/
?>