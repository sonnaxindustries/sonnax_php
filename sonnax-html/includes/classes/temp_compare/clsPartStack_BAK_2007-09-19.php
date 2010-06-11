<?
require_once("clsPart.php");

class PartStack  {
	/// Fields //////////////////////////////////////////////////////////////
	public $stack = array();
	
	/// Methods /////////////////////////////////////////////////////////////
	public function addPart ($part_id, $ref_number = 0, $tc_description="", $component_id=0) {
		$part = new Part($part_id, $ref_number, $tc_description);
		$part->component_id = $component_id;//this is actually assebly_parts.id when handling assemblies
		$this->stack[] =  $part;
	}

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

	public function sortByRefNumber () {  // woohoo its a bubble sort!
		$upperBound = count($this->stack) - 1;
		for ($x = 0; $x <= $upperBound; $x++) {
			for ($y = 0; $y <= $upperBound; $y++) {
				if ($this->stack[$x]->ref_number > $this->stack[$y]->ref_number) {
					$hold = $this->stack[$x];
					$this->stack[$x] = $this->stack[$y];
					$this->stack[$y] = $hold;
				}
			}
		}
		//a secondary sort here by part number within the ref numbers would be nice
	}
	
	public function sortByPartNumber () {  // woohoo its a bubble sort!
		//echo "YES2<BR>\n";
		//sort descending so that they come off the stack in proper order
		$upperBound = count($this->stack) - 1;
		for ($x = 0; $x <= $upperBound; $x++) {
			for ($y = 0; $y <= $upperBound; $y++) {
				//strnatcmp
				if ( strcmp($this->stack[$x]->part_number, $this->stack[$y]->part_number) > 0 ) {
				//if ($this->stack[$x]->part_number > $this->stack[$y]->part_number) {
					$hold = $this->stack[$x];
					$this->stack[$x] = $this->stack[$y];
					$this->stack[$y] = $hold;
				}
			}
		}
	}
	
	public function sortByRefNumberHPTC () {  
		usort($this->stack, array("Part", "compare_parts_hptc_assembly"));
	}

}


