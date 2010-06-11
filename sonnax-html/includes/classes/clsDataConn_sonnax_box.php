<?
Class DataConn {
	private $link;
	private $debug = false;
	/**
	 * Created a database connection to $database
	 *
	 * @param string $database
	 */
	public function __construct($database = "sonnax") {
		if (strlen($database) < 1) {
			$database = "sonnax";
		}
		//$this->link = mysql_connect("localhost", "sonnax", "XbD.Srjf")
		//$this->link = mysql_connect("localhost", "sonnax", "XbD.Srjf");
		$this->link = mysql_connect("localhost", "sonnax", "auto99parts");
		or die ("Could not connect");
		mysql_select_db ($database)
		or die ("Could not select database");
		
		//mysql_query("SET CHARACTER SET 'utf8'", $this->link);
	}


	/**
	 * Close database connection
	 *
	 */
	function __destruct() {
		//mysql_close($this->link);  //obsolete
	}

	/**
	 * choose which database to use
	 *
	 * @param string $database
	 */
	function chooseDatabase($database) {
		mysql_select_db ($database)
		or die ("Could not select database");
	}




	/**
	 * this returns a 2d associative array with the db "table.field" name as the first element
	 *
	 * @param string $sql
	 * @return array
	 */
	public function f_ReturnArrayAssoc_TF($sql) {
		if ($this->debug==true) {echo "\n<!-- sqldebug f_ReturnArrayAssoc_TF ".$sql." -->\n";}
		$result = mysql_query ($sql);
		if(mysql_errno() != 0) {
			echo "f_ReturnArrayAssoc_TF<BR><BR>";
			echo $sql . "<BR>";
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
			exit;
		}
		$intNumColumns = mysql_num_fields($result) - 1; //make zero base

		$intNumRecords = mysql_num_rows($result) - 1; //make zero base

		//Get the table-column names
		for ($i=0; $i <= $intNumColumns; $i++) {
			$arrTableFieldStructure[$i][0] = mysql_field_table($result, $i) . "." . mysql_field_name($result, $i);
		}
		if ($intNumRecords > -1) {
			//Put the data into the array
			$arrData[0][0]; //Error preventor

			$intRecord = -1; //initialize row counter
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intRecord++; //increment the counter

				for($intColumn = 0;$intColumn <= $intNumColumns;$intColumn++){
					$arrData[$arrTableFieldStructure[$intColumn][0]][$intRecord] = $row[$intColumn];

				}
			}
			return $arrData;
		} else {
			return -1;
		}
	}

	/**
	 * this returns a 2d associative array with the db field names as the first element
	 *
	 * @param string $sql
	 * @return array
	 */
	public function f_ReturnArray($sql) {
		if ($this->debug==true) {echo "\n<!-- sqldebug f_ReturnArray ".$sql." -->\n";}
		$result = mysql_query ($sql);
		if(mysql_errno() != 0) {
			echo "f_ReturnArray<BR><BR>";
			echo $sql . "<BR>";
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
			exit;
		}
		$intNumColumns = mysql_num_fields($result) - 1;
		$intNumRecords = mysql_num_rows($result) - 1;
		//Get the column names
		for ($i=0; $i <= $intNumColumns; $i++) {
			$arrTableFieldStructure[$i][0] = mysql_field_name($result, $i);
		}
		if ($intNumRecords > -1) {
			//Put the data into the array
			$arrData[0][0]; //Error preventor

			$intRecord = -1; //initialize row counter
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intRecord++; //increment the counter

				for($intColumn = 0;$intColumn <= $intNumColumns;$intColumn++){
					$arrData[$arrTableFieldStructure[$intColumn][0]][$intRecord] = $row[$intColumn];
				}
			}
			return $arrData;
		} else {
			return -1;
		}
	}

	/**
	 * this returns a zero based 2d array numbers as the first element
	 *
	 * @param string $sql
	 * @return array
	 */
	public function f_ReturnArrayOrdinal($sql) {
		if ($this->debug==true) {echo "\n<!-- sqldebug f_ReturnArrayOrdinal ".$sql." -->\n";}
		$result = mysql_query ($sql);
		if(mysql_errno() != 0) {
			echo "f_ReturnArrayOrdinal<BR><BR>";
			echo $sql . "<BR>";
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
			exit;
		}
		$intNumColumns = mysql_num_fields($result) - 1; //make zero base
		//echo "intNumColumns=" . $intNumColumns . "<BR>";
		$intNumRecords = mysql_num_rows($result) - 1; //make zero base
		//echo "intNumRecords=" . $intNumRecords . "<BR>";
		if ($intNumRecords > -1) {
			//Put the data into the array
			$arrData[0][0]; //Error preventor

			$intRecord = -1; //initialize row counter
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intRecord++; //increment the counter

				for($intColumn = 0;$intColumn <= $intNumColumns;$intColumn++){
					$arrData[$intColumn][$intRecord] = $row[$intColumn];
					//echo "arrTempData[" . $intColumn . "][" . $intRecord . "]=" . $arrTempData[$intColumn][$intRecord] . "<BR>";
				}
				//echo "<BR>";
			}
			return $arrData;
		} else {
			return -1;
		}
	}

	/**
	 * Execute SQL with number of rows affected returned
	 *
	 * @param string $sql
	 * @return integer
	 */
	public function f_ExecuteSql($sql) {
		if ($this->debug==true) {echo "\n<!-- sqldebug f_ExecuteSql ".$sql." -->\n";}
		$result = mysql_query ($sql);
		if(mysql_errno() != 0) {
			echo "f_ExecuteSql<BR>\n<BR>\n";
			echo $sql . "<BR>\n";
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
			exit;
		}

		$intNumRowsAffected = mysql_affected_rows($this->link);
		return $intNumRowsAffected;
	}

	/**
	 * Execute SQL with id of last insert returned
	 *
	 * @param string $sql
	 * @return integer
	 */
	public function f_ExecuteSqlInsertID($sql) {
		// note: the id field in the database must be of type int, not bigint or any other type
		// also, this only works for simple insert queries, not other types
		if ($this->debug==true) {echo "\n<!-- sqldebug f_ExecuteSqlInsertID ".$sql." -->\n";}
		$result = mysql_query ($sql);

		if(mysql_errno() != 0) {
			echo "f_ExecuteSql<BR>\n<BR>\n";
			echo $sql . "<BR>\n";
			echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
			exit;
		}

		return mysql_insert_id($this->link);
	}

}

?>
