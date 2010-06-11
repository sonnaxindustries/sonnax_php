<?
class Admin {
	private $dataconn;

	public function __construct() {
		$this->dataconn = new DataConn("southernvtauction");
	}

	public function __destruct() {

	}

	/**
	 */
	public function addItem($wishlist_id, $ISBN, $item, $desired, $received=0) {
		$date = date("Y-m-d");
		if (! $this->itemInList($wishlist_id, $ISBN, $item)) {
			$sqlTemp = "INSERT INTO items (wishlist_id, isbn, item, date_added) VALUES ($wishlist_id,'$ISBN',$item,'$date')";
			return $this->dataconn->f_ExecuteSQLInsertID($sqlTemp);
		} else {
			return 0;
		}
	}

	public function itemInList($wishlist_id, $ISBN, $item) {
		$sqlTemp = "SELECT * FROM items WHERE isbn = '$ISBN' AND item = '$item'";
		$results = $this->dataconn->f_ReturnArrayAssoc_TF($sqlTemp);
		if (is_array($results)) {
			return true;
		} else {
			return false;
		}
	}

	public function deleteItem($id) {
		$sqlTemp = "DELETE FROM items WHERE id = $id";
		return $this->dataconn->f_ExecuteSQL($sqlTemp);
	}


	public function changeDesired ($id, $quantity) {
		$sqlTemp = "UPDATE items SET desired = $quantity WHERE id = $id";
		return $this->dataconn->f_ExecuteSql($sqlTemp);
	}


	public static function storeBookCookie ($ISBN, $item) {
		setcookie ("isbn", $ISBN, time()+60*60*6);
		setcookie ("item_no", $item, time()+60*60*6);
	}

	public static function readBookCookie() {
		$isbn =  $_COOKIE["isbn"];
		$item = $_COOKIE["item_no"];
		if (strlen($isbn) > 0) {
			$arrBook[0] = $isbn;
			$arrBook[1] = $item;
			return $arrBook;
		} else {
			return 0;
		}
	}

	public static function removeBookCookie() {
		setcookie ("isbn", "", time()-60*60);
		setcookie ("item_no", "", time()-60*60);
	}
	
	public function processBookCookie ($customer_id) {
		$arrBook = Items::readBookCookie();
		if (is_array($arrBook)) {
			$wishlist = new WishList();
			$wishlist_id = $wishlist->getDefaultID($customer_id);
			$this->addItem($wishlist_id,$arrBook[0],$arrBook[1],1);
			Items::removeBookCookie();
		}
	}

}


?>