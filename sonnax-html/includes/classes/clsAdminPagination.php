<?
class Pagination {
	private $dataconn;

	public function __construct() {
		$this->dataconn = new DataConn("southernvtauction");
	}

	public function __destruct() {

	}

	/*
	function f_get_number_of_records ($sqlTemp) {
		
		$result = mysql_query ($sqlTemp);
			if(mysql_errno() != 0) {
				echo "f_get_number_of_records<BR><BR>";
				echo $sqlTemp . "<BR>";
				echo "<BR><BR>" . mysql_errno() . ": " . mysql_error() . "<BR>\n";
				exit;
			}
		return mysql_num_rows($result) - 1; //make zero base
	}
	*/
	
	function f_output_pagination_report ($page, $total_items, $items_per_page, $leading_output_text, $trailing_output_text) {
		$start_position = ($page - 1) * $items_per_page;
		$end_position = $start_position + $items_per_page;
		if ($end_position > $total_items) {
			$end_position = $total_items;
		}
		$pagination_report = "Viewing items <strong>" . ($start_position + 1) . "</strong> through <strong>" . $end_position . "</strong> of $total_items";
		if ($total_items > 0) {
			echo $leading_output_text . $pagination_report . $trailing_output_text;
		}
	}
	
	
	function f_output_pagination ($params, $page, $total_items, $items_per_page) {
		//echo "yup1";
		//global $str_base_url;
		
		//validate the $total_items
		//echo "totalitems_" . $totalitems . "_";
		if (!$total_items || !is_numeric($total_items) || $total_items < 1) {
			return ""; //we need this value to page so just bail if we dont get it
		}
		
		//maximum possible page
		$total_pages = ceil($total_items / $items_per_page);
		if ($total_pages > 20) {
			//this is an arbitrary design decision but if their search
			//returned more than 200 records they probably did a bad search 
			$total_pages = 20;
		}	
		
		//print the previous link
		$previous_page = $page - 1;	
		if($previous_page >= 1) { 
			echo "<a href=\"$str_base_url?page=$previous_page";
			if (strlen($params) > 0) {
				echo $params;
			}
			echo "\"><img alt=\"Previous Page\" width=20 height=14 border=0 src=\"images/previous.gif\" align=absmiddle>  <b><< Previous Page</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$b_print_divider = true;
		}
		
		//print the individual page links but leave the current page unlinked
		for ($a = 1; $a <= $total_pages; $a++) {
			if ($b_print_divider == true) {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";}
			if ($a == $page) {
				echo "<b><span style=\"color: #FF0000\">Page $a</span></b>";//dont link the current page
			} else {
				echo "<a href=\"$str_base_url?page=$a";
				if (strlen($params) > 0) {
					echo $params;
				}
				echo "\">Page $a</a>";
			}
			$b_print_divider = true;
		}
	
	
		//print the next link
		$next_page = $page + 1;
		if($next_page <= $total_pages) {
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$str_base_url?page=$next_page";
			if (strlen($params) > 0) {
				echo $params;
			}
			echo "\"><b>Next Page >></b> <img alt=\"Next Page\" width=20 height=14 border=0 src=\"images/next.gif\" align=absmiddle></a>"; 
		}
		/*
		echo "<BR>";
		echo "total_items: _" . $total_items . "_<BR>\n";
		echo "items_per_page: _" . $items_per_page . "_<BR>\n";
		
		echo "page: _" . $page . "_<BR>\n";
		echo "total_pages: _" . $total_pages . "_<BR>\n";
		echo "previous_page: _" . $previous_page . "_<BR>\n";
		echo "next_page: _" . $next_page . "_<BR>\n";
		*/
		return "";
	}

}


?>