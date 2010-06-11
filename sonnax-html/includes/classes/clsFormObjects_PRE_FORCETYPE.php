<?
/**
 * This is a collection of static methods that produce form objects like text input, radio buttons, checkboxes.
 *
 */
class FormObjects {
	
	public function replaceQuotes($data) {
		// replace ' with &#39;
		$data = str_replace("'", "&#39;", $data);
		return $data;
	}
	
	public function text ($name, $value, $length, $styleClass="") {
		$value = FormObjects::replaceQuotes($value);
		echo  "<input type='text' name='$name' value='$value' size='$length' ";
		if (strlen($styleClass) > 0) {
			echo "class='$styleClass' ";
		}
		echo "> \n";
	}
	
	public function textArea ($name, $value, $cols, $rows, $styleClass="") {
		$value = FormObjects::replaceQuotes($value);
		echo "<textarea name='$name' cols='$cols' rows='$rows' ";
		if (strlen($styleClass) > 0) {
				echo " class='$styleClass' ";
			}
		echo ">$value</textarea> \n";
	}
	
	public function radioButton($name, $arrValue, $arrValueDisplay, $styleClass="", $value) {
		for ($x=0;$x<count($arrValue);$x++){
			echo "$arrValueDisplay <input type='radio' name='$name' value='$arrValue[$x]' ";
			if ($value == $arrValue[$x]) {
				echo " checked ";
			}
			if (strlen($styleClass) > 0) {
				echo " class='$styleClass' ";
			}
			echo "><BR> \n";
		}
	}
	
	public function checkBox($name, $value,$valueDisplay, $checked, $styleClass="") {
		echo "$valueDisplay <input type='checkbox' value='$value' ";
		if (strlen($styleClass) > 0) {
				echo " class='$styleClass' ";
			}
		echo "> \n";
	}
	
	public function selectBox ($name, $arrOptionDisplay, $arrOptionValue, $value, $styleClass="", $styleId="") {
		echo "<select name='$name' ";
		if (strlen($styleClass) > 0) {
			echo " class='$styleClass' ";
		}
		if (strlen($styleId) > 0) {
			echo " id='$styleId' ";
		}
		echo "> \n";
		echo "<option value=''>Select</option>\n";
		for ($x=0;$x <= count($arrOptionDisplay) - 1;$x++) {
			echo "<option value='$arrOptionValue[$x]' ";
			if ($arrOptionValue[$x] == $value) {
				echo " selected ";
			}
			echo ">$arrOptionDisplay[$x]</option> \n";
			
		}
		echo "</select> \n";
	}
	
	public function submit ($name, $value, $styleClass="") {
		echo "<input type='submit' name='$name' value='$value' ";
		if (strlen($styleClass) > 0) {
				echo " class='$styleClass' ";
			}
		echo "> \n";
	}
	
	public function hidden ($name, $value) {
		$value = FormObjects::replaceQuotes($value);
		echo "<input type='hidden' name='$name' value='$value'>";
	}
	
	public function selectBoxForProductLineReload ($name, $arrOptionDisplay, $arrOptionValue, $value, $styleClass="", $styleId="") {
		echo "<select name='$name' ONCHANGE='goThere(this.options[this.selectedIndex].value)' ";
		if (strlen($styleClass) > 0) {
			echo " class='$styleClass' ";
		}
		if (strlen($styleId) > 0) {
			echo " id='$styleId' ";
		}
		echo "> \n";
		//echo "<option value=''>Select</option>\n";
		for ($x=0;$x <= count($arrOptionDisplay) - 1;$x++) {
			echo "<option value='part_finder.php?pl=$arrOptionValue[$x]' ";
			if ($arrOptionValue[$x] == $value) {
				echo " selected ";
			}
			echo ">$arrOptionDisplay[$x]</option> \n";
		}
		echo "</select> \n";
	}
	
	public function selectBoxForProductLineNonReload ($name, $arrOptionDisplay, $arrOptionValue, $value, $styleClass="", $styleId="") {
		echo "<select name='$name' ";
		if (strlen($styleClass) > 0) {
			echo " class='$styleClass' ";
		}
		if (strlen($styleId) > 0) {
			echo " id='$styleId' ";
		}
		echo "> \n";
		//echo "<option value=''>Select</option>\n";
		for ($x=0;$x <= count($arrOptionDisplay) - 1;$x++) {
			echo "<option value='$arrOptionValue[$x]' ";
			if ($arrOptionValue[$x] == $value) {
				echo " selected ";
			}
			echo ">$arrOptionDisplay[$x]</option> \n";
		}
		echo "</select> \n";
	}
	
	public function selectBoxForMakeReload ($name, $arrOptionDisplay, $arrOptionValue, $value, $styleClass="", $styleId="") {
		echo "<select name='$name' ONCHANGE='reloadPage()' ";
		if (strlen($styleClass) > 0) {
			echo " class='$styleClass' ";
		}
		if (strlen($styleId) > 0) {
			echo " id='$styleId' ";
		}
		echo "> \n";
		echo "<option value=''>Select</option>\n";
		for ($x=0;$x <= count($arrOptionDisplay) - 1;$x++) {
			echo "<option value='$arrOptionValue[$x]' ";
			if ($arrOptionValue[$x] == $value) {
				echo " SELECTED ";
			}
			echo ">$arrOptionDisplay[$x]</option> \n";
			
		}
		echo "</select> \n";
	}
	
}


?>