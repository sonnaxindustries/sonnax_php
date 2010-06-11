<?
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";



$login = new Login();

$username = $_POST["username"]; 
$password = $_POST["password"];
//echo "username: _" . $username . "<BR>";
//echo "password: _" . $password . "<BR>";

$tryLogin = $login->initialValidate($username, $password);

if ($tryLogin) {
	$user_id = $login->getUserIdDatabase($username, $password);
	header("Location: admin.php");
	exit(0);
}

header("Location: index.php?message=Login+Failed");
?>