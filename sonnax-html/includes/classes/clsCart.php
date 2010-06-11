<?
/**
 * Class that defines an object to handle information passing to and from and Order object
 *
 */
class Cart {
	
	protected $get;
	
	protected function addToOrder ($get) {
		$qs = $this->parseQueryString();
		foreach ($qs as $key => $value) {
			if (is_numeric($key)) {
				//we have a component id key
				if (is_numeric($value)) {
					$this->order->addPart($key, $value, $get['pl'], $get['component']);
				}
				
			}
		}
	}
	
	protected function deleteFromOrder($get) {
		foreach ($get as $key => $value) {
			if (is_numeric($get['delete'])) {
				$this->order->removePart($get['delete']);
			}
		}
	}
	
	protected function updateQuantities ($get) {
		foreach ($get as $key => $value) {
			if (is_numeric($key)) {
				//we have a component id key
				if (! is_numeric($value)) {
					$value = 0;	
				}
				$this->order->updatePart($key, $value);
			}
		}
	}
	
	protected function parseQueryString () {
		$arrQS = array();
		$qs = explode("&", $_SERVER['QUERY_STRING']);

		foreach ($qs as $qs_value) {
			$arrParameters = explode("=",$qs_value);
			if (is_numeric($arrParameters[0])) {
				if (array_key_exists($arrParameters[0],$arrQS)) {
					if (is_numeric($arrParameters[1])) {
						$arrQS[$arrParameters[0]] += $arrParameters[1];  
					}
				} elseif (is_numeric($arrParameters[1])) {
					$arrQS[$arrParameters[0]] = $arrParameters[1];
				}
			}
			
		}
		
		return $arrQS;
	}
	
}