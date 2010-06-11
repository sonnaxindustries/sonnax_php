<?
require_once("clsDataConn.php");
require_once("clsOrderStack.php");

class Order {
	
	/**
	 * Database Connection
	 *
	 * @var DataConn
	 */
	protected $dataconn;
	/**
	 * OrderStack Object which contains all the parts in this order
	 *
	 * @var OrderStack
	 */
	public $order_stack;
	protected $order_id;
	/**
	 * Binary, determines if this is a TC order or not
	 *
	 * @var integer
	 */
	protected $tc;
	
	
	protected function testOrderNumber($order_number) {
		$sql = "
			SELECT id, TC 
			FROM `order` 
			WHERE id = {$order_number}/* Order->testOrderNumber */";
		$arrOrderId = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		if (count($arrOrderId['id']) > 0) { 
			//we found an order id
			return true;
		} else {
			return false;
		}
	}
	
	protected function buildOrderStack () {
		//delete parts that have a quantity of zero
		$sql = "DELETE FROM order_parts WHERE quantity = 0/* Order->buildOrderStack */";
		$this->dataconn->f_ExecuteSql($sql);
		
		//get the rest of the parts for this order from the database
		$sql = "
			SELECT 
					`order_parts`.`id`, `order_parts`.`part_id`, `order_parts`.`quantity`, 
					`order_parts`.`product_line`, `order_parts`.`description` 
			FROM order_parts
			WHERE order_id = {$this->order_id}/* Order->buildOrderStack */";//odd syntax with { and }
		$arrOrderParts = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		
		//echo "<pre>";
		//var_dump($arrOrderParts);
		//echo "</pre>";
		
		$count = count($arrOrderParts['order_parts.id']);
		$this->order_stack = new OrderStack();
		for ($x=0; $x <= $count-1; $x++) {
			$this->order_stack->addPart($arrOrderParts['order_parts.part_id'][$x],
										$arrOrderParts['order_parts.product_line'][$x],
										$arrOrderParts['order_parts.quantity'][$x],
										$arrOrderParts['order_parts.id'][$x],
										$arrOrderParts['order_parts.description'][$x] );
		}
	}
	
	public function removePart ($id) {
		$sql = "DELETE FROM order_parts WHERE id = {$id}/* Order->removePart */";
		$this->dataconn->f_ExecuteSql($sql);
		$this->buildOrderStack();
	}
	
	public function updatePart ($id, $quantity) {
		if (is_numeric($id) && is_numeric($quantity)) {
			$sql = "
				UPDATE order_parts 
				SET 
					quantity = {$quantity} 
				WHERE id = {$id}/* Order->updatePart */";
			$this->dataconn->f_ExecuteSql($sql);
			$this->buildOrderStack();
		}
	}
	
	public function addPart ($component_id, $part_quantity, $product_line, $component=0) {
		//echo "$component_id, $part_quantity, $product_line, $component";
		if (is_numeric($component_id) && is_numeric($part_quantity) && is_numeric($product_line) && is_numeric($component)) {
			if ($component == 0) {
				$part = new Part($component_id);
				$description = $part->description;
				$part_id = $part->id;
			} elseif ($component == 1) {
				$component = new Component($component_id);
				$description = $component->tc_description;
				$part_id = $component->assembly_or_part_id;
			}
			$sql = "
				INSERT INTO order_parts (
					order_id, part_id, quantity, product_line, description
				) VALUES (
					{$this->order_id},
					{$part_id},
					{$part_quantity},
					{$product_line},
					'{$description}'
				)/* Order->addPart */";
			$this->dataconn->f_ExecuteSql($sql);
			$this->buildOrderStack();
		}
	}
	

	
}

?>