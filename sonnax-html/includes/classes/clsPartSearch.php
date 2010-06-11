<?php

require_once("clsProductLines.php");
require_once("clsDataConn.php");
require_once ("clsPart.php");
require_once("clsPartStack.php");

class PartSearch  {

	private $partNumber;
	private $dataconn;
	/**
	 * Enter description here...
	 *
	 * @var PartStack
	 */
	private $partStack;
	
	/**
	 * Constructor
	 *
	 * @param string $partNumber all or part of a part number string
	 */
	function __construct($partNumber) {
		
		$this->partNumber = $partNumber;
		
		$this->dataconn = new DataConn("");
		$this->partStack = new PartStack();
		$this->findPartMatches();
	}
	
	/**
	 * use partNumber String to find partial matches of part numbers
	 */
	private function findPartMatches() {
		
		$this->partStack->stack = NULL;
		$this->partStack->stack = array();
		
		$sql = "SELECT id FROM parts 
				WHERE 
					part_number LIKE '" . mysql_real_escape_string($this->partNumber) . "%'
					AND
					product_line NOT IN (9,10) 
				ORDER BY part_number, product_line";

		$arrPartIds = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
		
		if (is_array($arrPartIds)) {
			for ($x=0; $x < count($arrPartIds["parts.id"]); $x++) {
				$this->partStack->addPart($arrPartIds["parts.id"][$x]);
			}
		}
	}

	/**
	 * @return PartStack object that contains the part matches for this part search
	 */
	public function getPartStack () { return $this->partStack; }

	/**
	 * count how many different product lines are present in the part stack
	 *
	 */
	public function findProductLineCount() {
		$counter = 0;
		if ($this->partStack->count() > 0) {
			// take all the product lines and put in separate array
			while ( ( $part = $this->partStack->removePart() ) ) { 
				$product_line[$counter] = $part->product_line;
				$counter++;
			}
		} else {
			return 0;
		}
		
		// repopulate the partStack
		$this->findPartMatches();
		
		// return the unique count for product lines in the array
		return count(array_unique($product_line));
	}
	
	
}


?>