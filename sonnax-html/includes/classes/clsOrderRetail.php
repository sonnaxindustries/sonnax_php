<?
require_once("clsDataConn.php");
require_once("clsOrderStack.php");
require_once("clsOrder.php");

class OrderRetail extends Order  {
	
	
	public function __construct($tc=0) {
		$this->tc = $tc;
		$this->dataconn = new DataConn("");
		$order_number = $this->readCookie();
		if ($this->readCookie()) {  
			// we have a valid order number and it is stored in order_id class field
		} else {
			$this->order_id = $this->createNewOrder();
		}
		$this->buildOrderStack();
	}
	
	private function readCookie () {
		$cookie =  $_COOKIE['order_id_retail'];
		if (is_numeric($cookie)) {
			//we found a cookie
			$this->testOrderNumber($cookie);
			$this->order_id = $cookie;
			return true;
		} else {
			return false;
		}
	}
	

	
	private function createNewOrder () {
		$sql = "
			INSERT INTO `order` 
				(`TC`) 
			VALUES (
				'".mysql_real_escape_string($this->tc)."'
			)";
		$order_id = $this->dataconn->f_ExecuteSqlInsertID($sql);
		if (!headers_sent()) {
			setcookie("order_id_retail","{$order_id}",time()+172800);
		}
		return $order_id;
	}
	
	public function orderQuantity () {
		return $this->order_stack->orderQuantity();
	}
	
	public function orderTotal () {
		return $this->order_stack->orderTotal();
	}
	
}

?>