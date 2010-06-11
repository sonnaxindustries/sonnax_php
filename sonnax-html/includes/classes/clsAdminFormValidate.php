<?

class FormValidate {
	private $dataconn;

	public function __construct() {
		$this->dataconn = new DataConn("southernvtauction");
	}

	public function __destruct() {

	}

	public static function checkEmailAddress($email) {
		$normal = "^[a-z0-9_\+-]+(\.[a-z0-9_\+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,4})$";
		$validButRare = "^[a-z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+(\.[a-z0-9,!#\$%&'\*\+/=\?\^_`\{\|}~-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*\.([a-z]{2,})$";

		if (eregi($normal, $email)) {
			return true;  // normal email address
		}

		else if (eregi($validButRare, $email)) {
			return true; // technically valid email address, but probably not a real address
		}

		else {
			return false;
		}
	}
	
	public static function cleanFormData($data) {
		echo "data _" . $data . "_<BR>";
		$data = stripslashes($data);
		$data = mysql_real_escape_string($data);  // sql injection preventer
		return $data;
	}

}

?>