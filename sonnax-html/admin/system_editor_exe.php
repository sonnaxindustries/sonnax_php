<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
require_once "../includes/generic_functions.php";

/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
*/
include "includes/f_OutputErrorNow.php";
require "includes/inc_admin_validate.php";

$action = $_GET["action"];
switch ($action) {
	case "remove_part_from_unit":
		if (strlen($_GET['component_id']) > 0) {
			//this is definitive, deleteUnitComponentByUnitIdAndPartId is not but works in most (if not all) cases
			deleteUnitComponentById($_GET['component_id']);
		} else {
			deleteUnitComponentByUnitIdAndPartId($_GET['unit'],$_GET['part_id']);
		}
		break;
	//may need a case here for each specific product line
	case "update_component_ref_figure_id":
		updateUnitRefFigureId($_GET['pl'],$_GET['unit'],$_GET['ref_figure_id']);
		break;
	case "add_part_to_unit":
		addComponentToUnit($_GET['unit'],$_GET['part_id']);
		break;
	case "add_unit":
		//could test for required fields here
		$new_unit_id = createUnit($_GET['pl'],$_GET['name'],$_GET['description'],$_GET['make_id'],$_GET['ref_figure_id']);
		if ($_GET['pl'] == 8) {
			header("Location: part_finder.php?pl=".$_GET['pl']."&ring_gears_unit_id=".$new_unit_id);
		} else {
			header("Location: part_finder.php?pl=".$_GET['pl']."&unit=".$new_unit_id."&make=".$_GET['make_id']);
		}
		exit(0);
		break;
	case "delete_unit":
		$new_unit_id = deleteUnit($_GET['unit'],$_GET['pl']);
		if ($_GET['pl'] == 8) {
			header("Location: part_finder.php?pl=".$_GET['pl']);
			exit(0);
		}
		break;
	case "edit_unit_name":
		$ignore_return = updateUnitName($_GET['unit'],$_GET['unit_name']);
		break;
	case "add_unit_make":
		$ignore_return = addUnitMake ($_GET['unit'],$_GET['make_id']);
		header("Location: system_editor_unit_makes.php?rd=".urlencode($_GET['rd'])."&unit=".$_GET['unit']);
		exit(0);
		break;
	case "remove_unit_make":
		$ignore_return = removeUnitMake ($_GET['unit'],$_GET['make_id']);
		header("Location: system_editor_unit_makes.php?rd=".urlencode($_GET['rd'])."&unit=".$_GET['unit']);
		exit(0);
		break;
	case "component_edit":
		if ($_GET["component_id"] == "0") {
			//should force entry of driveline_series and steel_driveshaft_tube_od
			if (strlen($_GET["driveline_series"]) < 1 || strlen($_GET["steel_driveshaft_tube_od"]) < 1) {
				f_OutputErrorNow("Driveline Series and Steel Driveshaft Tube OD are required");
			}
			$ignore_return = insertPtsComponent($_GET);
		} else {
			$ignore_return = updateComponent($_GET);
		}
		break;
	case "unit_component_indent":
		$ignore_return =  setComponentIndent($_GET['component_id'],$_GET['indent']);
		break;
	case "edit_assembly_name":
		$ignore_return = updateAssemblyName($_GET['assembly_id'],$_GET['assembly_name']);
		break;
	case "assembly_delete":
		$ignore_return = deleteAssembly($_GET['assembly_id']);
		break;
	case "assembly_add":
		$ignore_return = addAssembly($_GET['unit'],$_GET['assembly']);
		break;
	case "assembly_add_part":
		$ignore_return = addPartToAssembly($_GET['assembly_id'],$_GET['part_id']);
		break;
	case "remove_part_from_assembly":
		$ignore_return = deletePartFromAssembly ($_GET['assembly_part_id']);
		break;
	case "edit_assembly_part_ref_code":
		$ignore_return = updateAssemblyPartRefCode($_GET['assembly_part_id'],$_GET['code_on_ref_figure']);
		break;
	case "assembly_move":
		$ignore_return = moveAssembly($_GET['unit'],$_GET['unit_component_id'],$_GET['direction']);
		break;
	default:
		//do nothing
		break;
}


if (strlen($_GET['rd']) > 0) {
	header("Location: ".$_GET['rd']);
	exit(0);
} else {
	header("Location: admin.php");
	exit(0);
}
?>

