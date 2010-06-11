<?
require_once("clsAssembly.php");

class AssemblyStack  {
	/// Fields //////////////////////////////////////////////////////////////
	public $stack = array();
	
	/// Methods /////////////////////////////////////////////////////////////
	public function addAssembly ($assembly_id, $display_order, $indent, $component_id) {
		$this->stack[] = new Assembly($assembly_id, $display_order, $indent, $component_id);
	}

	public function removeAssembly () {
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

	function sortByDisplayOrder () {  // woohoo its a bubble sort!
		$upperBound = count($this->stack) - 1;
		for ($x = 0; $x <= $upperBound; $x++) {
			for ($y = 0; $y <= $upperBound; $y++) {
				if ($this->stack[$x]->display_order > $this->stack[$y]->display_order) {
					$hold = $this->stack[$x];
					$this->stack[$x] = $this->stack[$y];
					$this->stack[$y] = $hold;
				}
			}
		}
	}

}


