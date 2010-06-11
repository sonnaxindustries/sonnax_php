<?
require_once("clsPart.php");
require_once("clsComponent.php");
require_once("clsAssemblyPart.php");

class OrderStack  {
	/// Fields //////////////////////////////////////////////////////////////
	public $stack = array();
	
	/// Methods /////////////////////////////////////////////////////////////
	public function addPart ($part_id, $product_line, $quantity, $shopping_cart_id, $description) {
		$this->addPartLookUp($part_id, $product_line, $quantity, $shopping_cart_id, $description);
	}
	
	public function addPartLookUp ($part_id, $product_line, $quantity, $shopping_cart_id, $description) {
		if ($product_line == 1) { //HPT
			$part = new Part($part_id);
			$part->shopping_cart_quantity = $quantity;
			$part->shopping_cart_id = $shopping_cart_id;
			$part->description = $description;
			$this->stack[] =  $part;
		} elseif ($product_line == 2) { 
			$part = new Part($part_id);
			$part->description = $component->tc_description;
			$part->shopping_cart_quantity = $quantity;
			$part->shopping_cart_id = $shopping_cart_id;
			$part->description = $description;
			$this->stack[] =  $part;
		} elseif ($product_line == 10) { //HPTC
			$part = new Part($part_id);
			$part->shopping_cart_quantity = $quantity;
			$part->shopping_cart_id = $shopping_cart_id;
			$part->description = $description;
			$this->stack[] =  $part;
		}
		$this->sortByPartNumber();
	}

	/**
	 * Remove a part from the stack and return it from the method
	 *
	 * @return Part
	 */
	public function removePart () {
		$count=$this->count();
		if ($count){
			$value=$this->stack[$count-1];
			unset($this->stack[$count-1]);
			return $value;
		}
		else return false;
	}

	function count(){
		return count($this->stack);
	}
	
	public function sortByPartNumber () {  // woohoo its a bubble sort!
		//sort descending so that they come off the stack in proper order
		$upperBound = count($this->stack) - 1;
		for ($x = 0; $x <= $upperBound; $x++) {
			for ($y = 0; $y <= $upperBound; $y++) {
				if ($this->stack[$x]->part_number > $this->stack[$y]->part_number) {
					$hold = $this->stack[$x];
					$this->stack[$x] = $this->stack[$y];
					$this->stack[$y] = $hold;
				}
			}
		}
	}
	
	public function orderQuantity () {
		$quantity = 0;
		$upperBound = count($this->stack) - 1;
		for ($x = 0; $x <= $upperBound; $x++) {
			$part = $this->stack[$x];
			if (is_numeric($part->shopping_cart_quantity)) {
				$quantity += $part->shopping_cart_quantity;
			}
		}
		return $quantity;
	}
	
	public function orderTotal () {
		$total = 0;
		$upperBound = count($this->stack) - 1;
		for ($x = 0; $x <= $upperBound; $x++) {
			$part = $this->stack[$x];
			if (is_numeric($part->shopping_cart_quantity) && is_numeric($part->price)) {
				$total += ($part->shopping_cart_quantity) * ($part->price);
			}
		}
		return $total;
	}

}
?>