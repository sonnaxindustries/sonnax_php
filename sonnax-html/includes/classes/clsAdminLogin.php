<?
Class Login {
	// local class variables
	private $dataconn;
	
	public $b_edit_users = 0;
	public $b_edit_parts = 0;
	public $b_edit_makes = 0;
	public $b_edit_ref_figures = 0;
	public $b_edit_publications = 0;
	public $b_edit_distributors = 11;
	
	public function __construct() {
		$this->dataconn = new DataConn("");
	}

	public function __destruct() {

	}

	private function setCookies($username, $password_hash, $id) {
		setcookie ("user", $username, time()+60*60*6);
		setcookie ("browns", $password_hash, time()+60*60*6);
		setcookie ("id", $id, time()+60*60*6);
	}

	private function readCookies() {
		$username =  $_COOKIE["user"];
		$browns =  $_COOKIE["browns"];
		$id =  $_COOKIE["id"];
		if (strlen($username) > 0) {
			$arrCookies[0] = $username;
			$arrCookies[1] = $browns;
			$arrCookies[2] = $id;
		} else {
			$arrCookies = -1;
		}
		return $arrCookies;
	}

	/**
	 * Check username and password against database, return true and put cookie on client if authenticated
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function initialValidate($username, $password) {
		$sqlTemp = "
			SELECT 
				`id`,`b_edit_users`,`b_edit_parts`,`b_edit_makes`,
				`b_edit_ref_figures`,`b_edit_publications`,`b_edit_distributors` 
			FROM users 
			WHERE un = '" . mysql_real_escape_string($username) . "' 
				AND pw = '" . mysql_real_escape_string($password) . "'";
		$arrUser = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($arrUser)) {
			$id = $arrUser['users.id'][0];
			$password_hash = md5($password);
			$this->setCookies($username, $password_hash, $id);
			
			$this->b_edit_users 		= intval($arrUser['users.b_edit_users'][0]);
			$this->b_edit_parts 		= intval($arrUser['users.b_edit_parts'][0]);
			$this->b_edit_makes 		= intval($arrUser['users.b_edit_makes'][0]);
			$this->b_edit_ref_figures 	= intval($arrUser['users.b_edit_ref_figures'][0]);
			$this->b_edit_publications 	= intval($arrUser['users.b_edit_publications'][0]);
			$this->b_edit_distributors 	= intval($arrUser['users.b_edit_distributors'][0]);
			
			return true;
		} else {
			$this->setCookies("", "", 0);
			
			$this->b_edit_users 		= 0;
			$this->b_edit_parts 		= 0;
			$this->b_edit_makes 		= 0;
			$this->b_edit_ref_figures 	= 0;
			$this->b_edit_publications 	= 0;
			$this->b_edit_distributors 	= 0;
			
			return false;
		}
	}

	/**
	 * Test the clients cookies to see if they are logged in
	 *
	 * @return unknown
	 */
	public function validate() {
		$arrCookies = $this->readCookies();
		if (is_array($arrCookies)) {
			$sqlTemp = "
				SELECT 
					`pw`,`b_edit_users`,`b_edit_parts`,`b_edit_makes`,
					`b_edit_ref_figures`,`b_edit_publications`,`b_edit_distributors` 
				FROM users 
				WHERE un = '" . mysql_real_escape_string($arrCookies[0]) . "' 
				AND id=" . mysql_real_escape_string($arrCookies[2]);
			$arrUser = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
			if (is_array($arrUser)) {
				$password_hash = md5($arrUser['users.pw'][0]);
				if ($password_hash == $arrCookies[1]) {
					
					$this->b_edit_users 		= intval($arrUser['users.b_edit_users'][0]);
					$this->b_edit_parts 		= intval($arrUser['users.b_edit_parts'][0]);
					$this->b_edit_makes 		= intval($arrUser['users.b_edit_makes'][0]);
					$this->b_edit_ref_figures 	= intval($arrUser['users.b_edit_ref_figures'][0]);
					$this->b_edit_publications 	= intval($arrUser['users.b_edit_publications'][0]);
					$this->b_edit_distributors 	= intval($arrUser['users.b_edit_distributors'][0]);
					
					return true;	
				}
			}
		}
		
		$this->b_edit_users 		= 0;
		$this->b_edit_parts 		= 0;
		$this->b_edit_makes 		= 0;
		$this->b_edit_ref_figures 	= 0;
		$this->b_edit_publications 	= 0;
		$this->b_edit_distributors 	= 0;
		
		return false;
	}
	
	public function logout () {
		setcookie ("user", "", time()-60*60);
		setcookie ("browns", "", time()-60*60);
		setcookie ("id", "", time()-60*60);
	}
	
	/**
	 * Get the user id from the database using the username and password
	 *
	 * @param string $username
	 * @param string $password
	 * @return integer
	 */
	public function getUserIdDatabase ($username, $password) {
		$sqlTemp = "
			SELECT id 
			FROM users 
			WHERE `un` = '" . mysql_real_escape_string($username) . "' 
				AND `pw` = '".mysql_real_escape_string($password)."'";
		$id = $this->dataconn->f_ReturnArrayOrdinal($sqlTemp);
		return $id;
	}
	
	/**
	 * Get the user id from the cookie stored on their system
	 *
	 * @return integer
	 */
	public function getUserIdCookie () {
		$id =  $_COOKIE["id"];
		return $id;
	}
	
}