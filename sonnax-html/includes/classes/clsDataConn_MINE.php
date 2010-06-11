<?
class DataConn {
	
	private $link;
	
	/**
	 * Created a database connection to $database
	 *
	 * @param string $database
	 */
	function __construct($database) {
		
		if (strlen($database) < 1) {
			$database = "sonnax";
		}
		
		$this->link = mysql_connect("db2.vtweb.com", "sonnax", "eWrt443K9eJmFne") or die ("Could not connect");
		if ($this->link === FALSE) {
			die('Not connected : ' . mysql_error());
		}
		
		$this->chooseDatabase($database);//mysql_select_db($database) or die ("Could not select database");
	}
	
	/**
	 * Close database connection
	 *
	 */
	function __destruct() {
		if ($this->link) {
			//mysql_close is causing errors. there are web references to a php/mysql bug 
			//that causes the problem due to connection sharing and a counter which incorrectly 
			//stores the number of open connections and causes the link to close prematurely
				//mysql_close($this->link);
			
			$this->link = NULL;//a substitue command
		}
	}
	
	/**
	 * choose which database to use
	 *
	 * @param string $database
	 */
	function chooseDatabase($database) {
		mysql_select_db($database, $this->link) or die ("Could not select the database '$database'");
	}
	
	/**
	 * this returns a 2d associative array with the db "table.field" name as the first element
	 *
	 * @param string $str_sql
	 * @return array
	 */
	function f_ReturnArrayAssoc_TF ($str_sql) {
		//echo $str_sql . "<BR>f_ReturnArrayAssoc_TF<HR>";
		$result = mysql_query($str_sql, $this->link);
		if(mysql_errno($this->link) != 0) {
			echo "f_ReturnArrayAssoc_TF<BR><BR>";
			echo $str_sql . "<BR>";
			echo "<BR><BR>" . mysql_errno($this->link) . ": " . mysql_error($this->link) . "<BR>\n";
			exit;
		}
		$intNumColumns = mysql_num_fields($result) - 1; //make zero base
		
		$intNumRecords = mysql_num_rows($result) - 1; //make zero base
		
		//Get the table-column names
		for ($i=0; $i <= $intNumColumns; $i++) {
			//we should probalby "strtolower()" here but there is a lot of extant code that would break
			$arrTableFieldStructure[$i][0] = mysql_field_table($result, $i) . "." . mysql_field_name($result, $i);
		}
		if ($intNumRecords > -1) {
			//Put the data into the array
			// $arrData[0][0]; //Error preventor

			$intRecord = -1; //initialize row counter
			while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
				$intRecord++; //increment the counter

				for($intColumn = 0;$intColumn <= $intNumColumns;$intColumn++){
					$arrData[$arrTableFieldStructure[$intColumn][0]][$intRecord] = $row[$intColumn];

				}
			}
			mysql_free_result($result);
			return $arrData;
		} else {
			return -1;
		}
	}
	
	/**
	 * Execute SQL with number of rows affected returned
	 *
	 * @param string $str_sql
	 * @return integer
	 */
	function f_ExecuteSql ($str_sql) {
		//echo $str_sql . "<BR>f_ExecuteSql<HR>";
		$result = mysql_query ($str_sql, $this->link);
		if(mysql_errno($this->link) != 0) {
			echo "f_ExecuteSql<BR>\n<BR>\n";
			echo $str_sql . "<BR>\n";
			echo "<BR><BR>" . mysql_errno($this->link) . ": " . mysql_error($this->link) . "<BR>\n";
			exit;
		}
		
		return mysql_affected_rows($this->link); 
	}
	
	/**
	 * Execute SQL with id of last insert returned
	 *
	 * @param string $str_sql
	 * @return integer
	 */
	function f_ExecuteSqlInsertID ($str_sql) {
		// note: the id field in the database must be of type int, not bigint or any other type
		// also, this only works for simple insert queries, not other types
		//echo $str_sql . "<BR>f_ExecuteSqlInsertID<HR>";
		$result = mysql_query ($str_sql, $this->link);
		
		if(mysql_errno($this->link) != 0) {
			echo "f_ExecuteSqlInsertID<BR>\n<BR>\n";
			echo $str_sql . "<BR>\n";
			echo "<BR><BR>" . mysql_errno($this->link) . ": " . mysql_error($this->link) . "<BR>\n";
			exit;
		}
		
		return mysql_insert_id($this->link);
	}

}

?>