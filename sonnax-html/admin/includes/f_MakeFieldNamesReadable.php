<?
function f_MakeFieldNamesReadable($strTableName,$strFieldName){

	switch ($strTableName) {
		case "items":
			switch ($strFieldName) {
				case "ISBN":
					$strReadableFieldName = "Inventory Number";
					break;
				case "Year_Published":
					$strReadableFieldName = "Year";
					break;
				case "Title":
					$strReadableFieldName = "Web Label";
					break;
				case "PrimaryCategory":
					$strReadableFieldName = "Primary Category";
					break;
				case "Location_Category":
					$strReadableFieldName = "Secondary Category";
					break;
				case "Retail_Price ":
					$strReadableFieldName = "Web Price";
					break;
				case "AdditionalShipping":
					$strReadableFieldName = "Shipping Cost";
					break;
				case "NoWeb":
					$strReadableFieldName = "No Web";
					break;
				case "Special":
					$strReadableFieldName = "Feature";
					break;
				case "xxxxx":
					$strReadableFieldName = "xxxxx";
					break;
				case "xxxxx":
					$strReadableFieldName = "xxxxx";
					break;
				case "xxxxx":
					$strReadableFieldName = "xxxxx";
					break;
				default:
					//mail("joecool@example.com", "My Subject", "BodyLine 1\nBodyLine 2\nBodyLine 3");
					$strReadableFieldName = $strFieldName;
			}
			break;
		default:
			//mail("joecool@example.com", "My Subject", "BodyLine 1\nBodyLine 2\nBodyLine 3");
			$strReadableFieldName = $strFieldName;
	}
	return $strReadableFieldName;
}
?>