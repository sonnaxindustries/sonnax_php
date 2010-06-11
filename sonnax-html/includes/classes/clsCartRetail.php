<?
require_once("clsCart.php");

/**
 * Class that defines an object to handle information passing to and from an OrderRetail object
 *
 */
class CartRetail extends Cart {
	
	/**
	 * Order object
	 *
	 * @var OrderRetail
	 */
	public $order;
	
	public function __construct($get) {
		$tc = $get['tc'];
		if (is_numeric($get['tc'])) {
			$this->order = new OrderRetail($get['tc']);
		} else {
			$this->order = new OrderRetail(0);
		}
		if (array_key_exists('add_to_order',$get)) {
			// adding a part from the part finder
			$this->addToOrder($get);
			echo "\n\n<!-- addToOrder called -->\n\n";
		} elseif (array_key_exists('update_order',$get)) {
			// page submitted to self with updated quantities
			$this->updateQuantities($get);
			echo "\n\n<!-- updateQuantities called -->\n\n";
		} elseif (array_key_exists('view_cart',$get)) {
			// just show contents of the cart, no need to run any methods in this class
		} elseif (array_key_exists('delete',$get)) {
			$this->deleteFromOrder($get);	
		} elseif (array_key_exists('continue_shopping',$get)) {
			header("Location: part_finder.php?pl=1");
		}
	}
	
}