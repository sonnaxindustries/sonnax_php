<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../classes/clsDataConn.php";
require_once "../classes/clsLogin.php";
require_once "../classes/clsFormValidate.php";
require_once "../classes/clsError.php";
require_once "../classes/clsImage.php";

$image_id = $_GET["iid"];
$image_type = $_GET["type"];
$image_field = $_GET["field"];
$redirect = $_GET["redirect"];

$image = new Image();

//delete the actual image file
$no_return = $image->f_delete_image($image_id);

//delete the reference to the image in the page table
$no_return = $image->f_reset_page_image_reference ($image_type,$image_field);

if (strlen($redirect) > 0) {
	header("Location: $redirect");
} else {
	header("Location: photos.php");
}
?>

