<?
require_once("clsDataConn.php");
require_once("clsOrderStack.php");
require_once("clsOrder.php");

class OrderQuote extends Order {
	
	public function __construct($tc=1) {
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
		$cookie =  $_COOKIE['order_id_quote'];
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
		$sql = "INSERT INTO `order` (TC) VALUES ({$this->tc})/* OrderQuote->createNewOrder */";
		$order_id = $this->dataconn->f_ExecuteSqlInsertID($sql);
		if (!headers_sent()) {
			setcookie("order_id_quote","{$order_id}",time()+172800);
		}
		return $order_id;
	}
	
	
	
	private function writeOrderName () {
		$sql = "UPDATE `order` SET `name` = '{$_GET["name"]}' WHERE id = {$this->order_id}/* OrderQuote->writeOrderName */";
		$this->dataconn->f_ExecuteSql($sql); 
	}
	
	public function sendOrderEmail () {
		if (strlen($_GET["name"]) < 1 || strlen($_GET["company"]) < 1 ||  
			strlen($_GET["zip"]) < 1 || strlen($_GET["email"]) < 1 ) {
			header("Location: add_to_quote_cart.php?".$_SERVER["QUERY_STRING"]."&missing_info=true");
		}

		if (! $this->check_email_address($_GET["email"])) {
			header("Location: add_to_quote_cart.php?".$_SERVER["QUERY_STRING"]."&email_problem=true");
			exit(1);
		}
		
		$strSubject = "Quote Request";
		$strFrom = "SonnaxWebsite@sonnax.com";
		//theinel@comcast.net
		$strTo = "internetorders@sonnax.com";//internetorders@sonnax.com,chris@vtweb.com,terry@vtweb.com,tomoffice@vtweb.com
		$strHeaders = "From: ".$strFrom."\r\n".
						"MIME-Version: 1.0\r\n" .
						"Content-type: text/html; charset=UTF-8\r\n";

		$strBodyHeader = "
			<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
			<HTML>
				<BODY BGCOLOR=#FFFFFF>
			 		<TABLE BGCOLOR=#FFFFFF>";
		$strBodyFooter = "</TABLE></BODY></HTML>";
		
		if ($_GET["round_quantities"] == "round") {
			$rounding_message = "OK to round";
		} else {
			$rounding_message = "Contact me before rounding";
		}
		
		$strBodyMain = "
			<TR><TD>Name</TD><TD>".$_GET["name"]."</TD><TD colspan=2></TR>\n
			<TR><TD>Company</TD><TD>".$_GET["company"]."</TD></TR>\n
			<TR><TD>Zip</TD><TD>".$_GET["zip"]."</TD></TR>\n
			<TR><TD>Email</TD><TD>".$_GET["email"]."</TD></TR>\n
			<TR><TD>PO Number</TD><TD>".$_GET["po_number"]."</TD></TR>\n
			<TR><TD>Quantities</TD><TD>".$rounding_message."</TD></TR>\n
			<TR><TD>Shipping Method</TD><TD>".$_GET["shipping_method"]."</TD></TR>\n
			<TR><TD>Comments</TD><TD>".$_GET["comments"]."</TD></TR>\n
			<TR><TD>Quantity</TD><TD>Part Number</TD><TD>Item</TD><TD>Description</TD></TR>\n";
		
		$count = $this->order_stack->count();
		for ($x=0; $x <= $count-1; $x++) {
			$part = $this->order_stack->removePart();
			$strBodyMain .= "<TR><TD>{$part->shopping_cart_quantity}</TD><TD>{$part->part_number}</TD><TD>{$part->item}</TD><TD>{$part->description}</TD></TR>\n";
		}
		
		mail($strTo, $strSubject, ($strBodyHeader . $strBodyMain . $strBodyFooter),$strHeaders);
		setcookie("order_id_quote","",time());
		$this->writeOrderName();
		header("Location: thanks.php");
		
	}
	
	function check_email_address($email) {
		// First, we check that there's one @ symbol, and that the lengths are right
		if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
			// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			return false;
		}
		// Split it into sections to make life easier
		$email_array = explode("@", $email);
		$local_array = explode(".", $email_array[0]);
		for ($i = 0; $i < sizeof($local_array); $i++) {
			if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
				return false;
			}
		}
		if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
		$domain_array = explode(".", $email_array[1]);
			if (sizeof($domain_array) < 2) {
				return false; // Not enough parts to domain
			}
			for ($i = 0; $i < sizeof($domain_array); $i++) {
				if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
					return false;
				}
			}
		}
	return true;
}
}
?>