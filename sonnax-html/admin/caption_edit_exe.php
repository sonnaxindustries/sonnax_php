<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../classes/clsDataConn.php";
require_once "../classes/clsLogin.php";
require_once "../classes/clsFormValidate.php";
require_once "../classes/clsError.php";
require_once "../classes/clsImage.php";

$caption_text = $_GET["caption_text"];
$imageID = $_GET["iid"];
$redirect = $_GET["redirect"];

$image = new Image();
$no_return = $image->f_update_caption($imageID,$caption_text);

if (strlen($redirect) > 0) {
	header("Location: $redirect");
} else {
	header("Location: photos.php");
}
?>

