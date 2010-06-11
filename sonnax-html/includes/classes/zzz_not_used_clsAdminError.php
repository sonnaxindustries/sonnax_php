<?
class nError {
	public static function redirectErrorPage ($errorMsg) {
		$errorMsg = urldecode($errorMsg);
		header ("Location: error.php?error=$errorMsg");	
		exit();
	}	
}
?>