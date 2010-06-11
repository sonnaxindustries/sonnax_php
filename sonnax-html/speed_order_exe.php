<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "includes/classes/clsDataConn.php";
require_once "includes/generic_functions.php";
/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
require_once "includes/generic_functions.php";

*/
$b_error == false;

$pl = $_GET["pl"];
//allow only TC, HPTC, TS and Allison
if ($pl != "10" && $pl != "2" && $pl != "3" && $pl != "7") {
	$b_error = true;
}

//if ($pl == "10") {
	$component = 0; // part
//} elseif ($pl == "2") {
//	$component = 1; // assembly?
//}

foreach ($_GET as $key => $val){
	$arr_form_vars[$key] = $val;
}

$session_id = md5(uniqid(rand(),1)) . time() . str_replace(".","",$_SERVER["REMOTE_ADDR"]);

$count = -1;
$arr_item_data = array();

for($x=0;$x<=9;$x++){
	if(strlen($arr_form_vars["part$x"]) > 0){
		$count++;
		$arr_item_data["part_number"][$count] = $arr_form_vars["part$x"];
		$arr_item_data["qty"][$count] = $arr_form_vars["qty$x"];
		if ( isValidPart($arr_item_data["part_number"][$count],$pl) == false ) {
			$b_error = true;
		}
		if ( isValidQty($arr_item_data["qty"][$count]) == false ) {
			$b_error = true;
		}
	}
	//echo "<HR>\n";
}

//var_dump($arr_item_data);
		
if ($b_error == false) {
	//echo "good";
	//exit;
	$querystring = "tc=1&add_to_order=1&pl=$pl&component=$component";
	for($x=0;$x<=$count;$x++){
		
		//if ($pl == "2") {
		//	$arr_part_data = getPartData($arr_item_data["part_number"][$x],$pl);
		//	$key_name = $arr_part_data["parts.id"][0];
		//} else {
			$arr_part_data = getPartData($arr_item_data["part_number"][$x],$pl);
			$key_name = $arr_part_data["parts.id"][0];
		//}
		
		//var_dump($arr_part_data);
		//exit;
		
		$querystring .= "&".$key_name."=".str_replace(",","",$arr_item_data["qty"][$x]);

	}
	//echo "1";
	//exit;
	header("Location: add_to_quote_cart.php?".$querystring);
	exit;
} else {
	//echo "bad";
	//exit;
	
	for($x=0;$x<=$count;$x++){
		insertSpeedOrderItem($session_id,$arr_item_data["part_number"][$x],$arr_item_data["qty"][$x]);
	}
	//echo "2";
	//exit;
	header("Location: speed_order_correction.php?pl=$pl&session_id=".$session_id);
	exit;
}


?>

