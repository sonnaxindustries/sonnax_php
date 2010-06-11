<?
require_once("clsCart.php");

/**
 * Class that defines an object to handle information passing to and from an OrderQuote object
 *
 */
class CartQuote extends Cart  {
	
	/**
	 * Order object
	 *
	 * @var OrderQuote
	 */
	public $order;
	
	public function __construct($get) {
		$tc = $get['tc'];
		if (is_numeric($get['tc'])) {
			$this->order = new OrderQuote($get['tc']);
		} else {
			$this->order = new OrderQuote(1);
		}
		if (array_key_exists('add_to_order',$get)) {
			// adding a part from the part finder
			$this->addToOrder($get);
		} elseif (array_key_exists('update_order',$get)) {
			// page submitted to self with updated quantities
			$this->updateQuantities($get);
		} elseif (array_key_exists('view_cart',$get)) {
			// just show contents of the cart, no need to run any methods in this class
		} elseif (array_key_exists('delete',$get)) {
			$this->deleteFromOrder($get);	
		} elseif (array_key_exists('continue_shopping',$get)) {
			header("Location: part_finder.php?pl=" . $get['pl']);
		} elseif (array_key_exists('speed_order',$get)) {
			header("Location: speed_order.php");
		}
	}
	
	
}?>