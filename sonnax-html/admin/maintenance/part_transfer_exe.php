<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../../includes/classes/clsDataConn.php";
require_once "../../includes/classes/clsAdminLogin.php";
/*
require_once "../includes/classes/clsPartFinder.php";
require_once "../includes/classes/clsMakes.php";
require_once "../includes/classes/clsUnits.php";
require_once "../includes/classes/clsUnitsBrief.php";
require_once "../includes/generic_functions.php";

*/

$login = new Login();
$logged_in = $login->validate();
if (! $logged_in) {
	header ("Location: index.php");
	exit(0);
}

$message = $_GET["message"];

$dataconn = new DataConn("");

$sql2 = "
	SELECT *
	FROM `parts`
	WHERE `product_line` = '10'";
$arr_data = $dataconn->f_ReturnArrayAssoc_TF($sql2);
if (!is_array($arr_data)) {
	echo "No HPTC parts found";
	exit;
}

$int_ubound = count($arr_data["parts.product_line"])-1;
echo "inserting $int_ubound records<BR><BR>\n";
for ($x=0;$x<=$int_ubound;$x++) {
		$sql = "
			INSERT INTO parts (
				product_line, part_number,new_item,description,notes,item,price,photo,announcement,
				instructions,tech,vbfix,product_line_from_ts_file,oem_part_number,part_summary,part_type,
				tube_diameter,steel_driveshaft_tube_od,
				torque_fuse_options,no_of_teeth,outer_diameter,inner_diameter,pitch,thick,chamfer,pts_series,driveline_series,weight
			) VALUES (
				'99',
				'".mysql_real_escape_string($arr_data["parts.part_number"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.new_item"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.description"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.notes"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.item"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.price"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.photo"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.announcement"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.instructions"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.tech"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.vbfix"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.product_line_from_ts_file"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.oem_part_number"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.part_summary"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.part_type"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.tube_diameter"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.steel_driveshaft_tube_od"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.torque_fuse_options"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.no_of_teeth"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.outer_diameter"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.inner_diameter"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.pitch"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.thick"][$x])."',
				'".mysql_real_escape_string($arr_data["parts.chamfer"][$x])."', 
				'".mysql_real_escape_string($arr_data["parts.pts_series"][$x])."', 
				'".mysql_real_escape_string($arr_data["parts.driveline_series"][$x])."', 
				'".mysql_real_escape_string($arr_data["parts.weight"][$x])."' 
			/* Part->insertNew */)";
		echo $sql . "<BR>\n";
		$return_value = $dataconn->f_ExecuteSqlInsertID($sql);
		echo $return_value."<HR>\n";
}


echo "done";
exit;
?>

