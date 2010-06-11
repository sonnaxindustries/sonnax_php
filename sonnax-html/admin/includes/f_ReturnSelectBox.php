<?

/*
This function returns a list box or a the list options for a given table

f_ReturnSelectBox.php
1)	Used to make a list box form for a given lookup table in the database
2)	f_ReturnSelectBox()
	Accepts... (NOTE: table and field names must have ` 's around them if they contain spaces or resverved words
		a) strTableName
		b) strFields, two fields required, comma separated, the first is the value passed to the next page the second is diplayed in the box
		c) strOrderBy
		d) strSelectName, OPTIONAL select box name
		e) intItemSelected, OPTIONAL INTEGER value of the selected item ID
		f) strDefaultValue, OPTIONAL (prepended) value of first item of the list
		g) strDefaultDisplal, OPTIONAL (prepended) display for first item of the list
3)	Returns string containing compelete list box or list of options
*/


function f_ReturnSelectBox($strTableName,$strFields,$strOrderBy,$strSelectName,$intItemSelected,$strDefaultValue,$strDefaultDisplay){
	//echo "strTableName=" . $strTableName . "<BR>";
	//echo "strFields=" . $strFields . "<BR>";
	//echo "strOrderBy=" . $strOrderBy . "<BR>";
	//echo "strSelectName=" . $strSelectName . "<BR>";
	//echo "intItemSelected=" . $intItemSelected . "<BR>";
	//echo "strDefaultValue=" . $strDefaultValue . "<BR>";
	//echo "strDefaultDisplay=" . $strDefaultDisplay . "<BR>";

	
	
	$sqlTemp = "" .
		"SELECT " . $strFields . " " .
		"FROM " . $strTableName . " " .
		"ORDER BY " . $strOrderBy . ";";
	//echo $sqlTemp . "<BR>";
	$result = mysql_query ($sqlTemp);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sqlTemp . "<BR>";
			exit;
		}

	$intNumItems = mysql_num_rows($result) - 1; //make zero base
	$intNumFields = mysql_num_fields($result) - 1; //make zero base

	//echo "intNumItems_".$intNumItems."<BR>";
	if ($intNumItems > -1) {
		//transfer the data to an array (ugly but quick)
			$intCounter = -1; //initialize row counter
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intCounter++; //increment the counter
			
				for($i = 0;$i <= $intNumFields;$i++){
					$arrListItems[$i][$intCounter] = $row[$i];
				}
			}	
		//include opening select tag
			if ($strSelectName != "") {
				$f_ReturnSelectBox_temp = "<select name='" . $strSelectName . "'>\n";
			}
		
		//include default first item tag
			if ($strDefaultDisplay != "") {
				$f_ReturnSelectBox_temp .= "     <option value='" . $strDefaultValue . "'>" . $strDefaultDisplay . "</option>\n";
			}
			
		//write the list options
			if ($intItemSelected != "") {
				//test to see if the current item is the one to be selected
				for($x = 0;$x <= $intNumItems;$x++){
					if ($arrListItems[0][$x] == $intItemSelected) {
						$f_ReturnSelectBox_temp .= "     <option value='" . $arrListItems[0][$x] . "' SELECTED>" . $arrListItems[1][$x] . "</option>\n";
					} else {//not selected
						$f_ReturnSelectBox_temp .= "     <option value='" . $arrListItems[0][$x] . "'>" . $arrListItems[1][$x] . "</option>\n" ;
					}				
				} //x
			} else { //nothing selected so just write them
				for($x = 0;$x <= $intNumItems;$x++){
					$f_ReturnSelectBox_temp .= "     <option value='" . $arrListItems[0][$x] . "'>" . $arrListItems[1][$x] . "</option>\n";
				} //x
			}
		
		//include opening select tag
			if ($strSelectName != "") {
				$f_ReturnSelectBox_temp .= "</select>\n";
			}
	} else {
		$intNumItems = -1;
		$f_ReturnSelectBox_temp = "f_ReturnSelectBox not returning data<br>";
	}
	
	return $f_ReturnSelectBox_temp;
}


function f_OutputSelectBox ($sql,$strSelectName,$intItemSelected,$strDefaultValue,$strDefaultDisplay) {
		
	//echo $sql . "<BR>";
	$result = mysql_query ($sql);
		if(mysql_errno() != 0) {
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR><BR>\n";
			echo "SQL=" . $sql . "<BR>";
			exit;
		}

	$intNumItems = mysql_num_rows($result) - 1; //make zero base
	$intNumFields = mysql_num_fields($result) - 1; //make zero base

	//echo "intNumItems_".$intNumItems."<BR>";
	if ($intNumItems > -1) {
		//transfer the data to an array (ugly but quick)
			$intCounter = -1; //initialize row counter
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intCounter++; //increment the counter
			
				for($i = 0;$i <= $intNumFields;$i++){
					$arrListItems[$i][$intCounter] = $row[$i];
				}
			}	
		//include opening select tag
			if ($strSelectName != "") {
				echo "<select name='" . $strSelectName . "'>\n";
			}
		
		//include default first item tag
			if ($strDefaultDisplay != "") {
				echo "     <option value='" . $strDefaultValue . "'>" . $strDefaultDisplay . "</option>\n";
			//} else {
			//	echo "     <option value=''>Please Select</option>\n";
			}
			
		//write the list options
			if ($intItemSelected != "") {
				//test to see if the current item is the one to be selected
				for($x = 0;$x <= $intNumItems;$x++){
					if ($arrListItems[0][$x] == $intItemSelected) {
						echo "     <option value='" . $arrListItems[0][$x] . "' SELECTED>" . $arrListItems[1][$x] . "</option>\n";
					} else {//not selected
						echo "     <option value='" . $arrListItems[0][$x] . "'>" . $arrListItems[1][$x] . "</option>\n" ;
					}				
				} //x
			} else { //nothing selected so just write them
				for($x = 0;$x <= $intNumItems;$x++){
					echo "     <option value='" . $arrListItems[0][$x] . "'>" . $arrListItems[1][$x] . "</option>\n";
				} //x
			}
		
		//include opening select tag
			if ($strSelectName != "") {
				echo "</select>\n";
			}
	} else {
		echo "No Data";
	}
	
	return 1;
}
?>