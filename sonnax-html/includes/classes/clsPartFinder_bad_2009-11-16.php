<?
require_once("clsProductLines.php");
require_once("clsDataConn.php");
require_once("clsFormObjects.php");
require_once("clsUnit.php");
require_once("clsUnitBrief.php");
require_once("clsPartStack.php");
require_once("clsAssemblyStack.php");

class PartFinder {
	// Fields ///////////////////////////////////////////////////////////////
	private $dataconn;
	public $part_number_search;
	public $oem_part_number_search;
	public $no_of_teeth_search;
	public $driveline_series;
	public $tube_diameter;
	//public $allison_unit_id;
	public $ring_gears_unit_id;
	public $torque_fuse_options;
	public $pts_driveline_series;
	public $make_id;
	public $unit_id;
	public $search_state;  // 0 for no search, 1 for part number search, 2 for make/unit search
	public $product_line;
	public $part_stack = null;  // may need to expand on this for HPTC and TC
	public $unit = null;
	public $assembly_stack = null;
	
	public $search_message;

	// Methods //////////////////////////////////////////////////////////////

	public function __construct($get) {
		$this->dataconn 				= new DataConn("");
		$this->part_number_search 		= $get["pn"];
		$this->oem_part_number_search 	= $get["oem_pn"];
		$this->no_of_teeth_search	 	= $get["no_of_teeth"];
		
		$this->driveline_series	 		= $get["driveline_series"];// ?? this might be a unit_id ??
		$this->tube_diameter	 		= stripslashes($get["tube_diameter"]);//this field has dbl quotes in it which get a backslash added through the url
		
		//$this->allison_unit_id			= $get["allison_unit_id"];
		$this->ring_gears_unit_id		= $get["ring_gears_unit_id"];
		$this->torque_fuse_options		= $get["torque_fuse_options"];
		$this->pts_driveline_series	 	= $get["pts_driveline_series"];
		
		$this->make_id 					= $get["make"];
		$this->unit_id 					= $get["unit"];
		$this->product_line 			= $get["pl"];
		
		$this->search_message = "";
		
		$this->part_stack = new PartStack();
		
		//echo "oem_part_number_search: _".$this->oem_part_number_search."<BR>\n";
		
		if ($this->product_line == 3 || $this->product_line == 12 || $this->product_line == 13 || $this->product_line == 14) {
			$this->partStackSetupTSLine(); // 3, 12, 13 right now (TS, TT, SC) (14 = SF has been eliminated)
		} elseif ($this->product_line == 2) { // TC
			$this->partStackSetupTCLine();
		} elseif ($this->product_line == 10) { //hptc
			$this->assemblyStackSetupHPTCLine();
		} elseif ($this->product_line == 1) { //now HPT (formerly HPTS)
			$this->partStackSetupTSLine();
		} elseif ($this->product_line == 8) { //ringgears
			$this->partStackSetupRingGearLine();
		} elseif ($this->product_line == 7) { //allison
			$this->partStackSetupAllisonLine();
		} elseif ($this->product_line == 11) { //driveline
			$this->partStackSetupDrivelineLine();
		} elseif ($this->product_line == 9) { //pts
			$this->partStackSetupPTSLine();	
		} else {
			$this->fixProductLine();//defaults us to 3 (TS)
			$this->search_message = "Use Search Above";
		}
	}
	
	public function assemblyStackSetupHPTCLine () {
		$this->determineSearchState();
		switch ($this->search_state) {
			case 0:
				// Going to do nothing and show no parts found message.
				break;
			case 1: 
				// bring back a parts list that looks like the TS line and let them click on units.
				// perform part search and set part_list
				$this->part_stack = new PartStack();
				$sql = "SELECT
							`id`
						FROM `parts` 
						WHERE 
							part_number LIKE '".mysql_real_escape_string($this->part_number_search)."%' 
							AND	product_line = '".mysql_real_escape_string($this->product_line)."' 
						ORDER BY part_number DESC";
				//echo $sql . "<BR>\n";
				$result = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
				if (is_array($result)) {
					for ($x=0; $x <= count($result["parts.id"]) - 1; $x++) {
						$this->part_stack->addPart($result["parts.id"][$x]);
					}
				} else {
					$this->search_state = 0;
					$no_return = $this->setErrorMessage("");
				}
				break;
			case 2: 
				$this->assembly_stack = new AssemblyStack();
				$unit_id = $this->getUnitId();
				if (!empty($unit_id)) {
					$this->unit = new Unit ($unit_id);
					$components = $this->unit->components; 									// UnitComponents Object
					$componentList = $components->componentList; 							// array of component objects
					for ($x=0; $x <= $components->count - 1; $x++) {
						$component = $componentList[$x]; 									// one component object from the array of component objects
						if ($component->component_type == 1) { 								// if component is a part
							$this->assembly_stack->addAssembly($component->assembly_or_part_id, $component->display_order, $component->indent, $component->id);
							//doesn't work
								//echo "cid _".$component->id."_<BR>\n";
								//$this->part_stack->addPart($component->assembly_or_part_id, $component->code_on_ref_figure, $component->tc_description, $component->id);
						}
					}
					$no_return = $this->assembly_stack->sortByDisplayOrder();
				} else {
					$this->search_state = 0;
					$no_return = $this->setErrorMessage("");
				}
				break;
		}
	}
	
	
	public function partStackSetupRingGearLine () {
		$this->determineSearchState();
		//echo "state ".$this->search_state."<BR>\n";
		//exit;
		switch ($this->search_state) {
			case 0:
				// Going to do nothing and show no parts found message.
				break;
			case 4:
				// perform part search and set part_list
				$this->part_stack = new PartStack();
				$sql = "SELECT
							`id`,`part_number` 
						FROM `parts` 
						WHERE 
							no_of_teeth LIKE '".mysql_real_escape_string($this->no_of_teeth_search)."%' 
							AND	product_line = '".mysql_real_escape_string($this->product_line)."' 
						ORDER BY part_number DESC";
				$result = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
				if (is_array($result)) {
					for ($x=0; $x <= count($result["parts.id"]) - 1; $x++) {
						$this->part_stack->addPart($result["parts.id"][$x]);
					}
				} else {
					$this->search_state = 0;
					$no_return = $this->setErrorMessage("");
				}
				break;
			case 8:
				// Perform unit search and return part_list
				$this->part_stack = new PartStack();
				$unit_id = $this->ring_gears_unit_id;
				if (!empty($unit_id)) {
					$this->unit = new Unit ($unit_id);
					$components = $this->unit->components; 									// UnitComponents Object
					$componentList = $components->componentList; 							// array of component objects
					for ($x=0; $x <= $components->count - 1; $x++) {
						$component = $componentList[$x]; 									// one component object from the array of component objects
						if ($component->component_type == 0) { 								// if component is a part
							$this->part_stack->addPart($component->assembly_or_part_id);
						}
					}
					$no_return = $this->part_stack->sortByPartNumber();
				} else {
					//echo "YUP2<BR>\n";
					$this->search_state = 0;
					$no_return = $this->setErrorMessage("");
				}
				break;
			case 12:
				// perform part search
				$this->part_stack = new PartStack();
				$sql = "SELECT
							`id`,`part_number` 
						FROM `parts` 
						WHERE 
							part_number LIKE '".mysql_real_escape_string($this->part_number_search)."%' 
							AND	product_line = '".mysql_real_escape_string($this->product_line)."' 
						ORDER BY part_number DESC";
				//echo $sql."<BR>\n";
				//flush;
				$result = $this->dataconn->f_ReturnArrayAssoc_TF($sql);
				if (is_array($result)) {
					for ($x=0; $x <= count($result["parts.id"]) - 1; $x++) {
						$this->part_stack->addPart($result["parts.id"][$x]);
					}
				} else {
					$this->search_state = 0;
					$no_return = $this->setErrorMessage("");
				}
				break;
		}
	}
	
	
	public function partStackSetupTSLine () {
		$this->determineSearchState();
		switch ($this->search_state) {
			case 0:
				// Going to do nothing and show no parts found message.
				break;
			case 1:
				// perform part search and set part_list
				$this->part_stack = new PartStack();
				$sql = "SELECT
							`id`
						FROM `parts` 
