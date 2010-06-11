<?/* 
	$virtual_page = parts_finder.php,product_line,make,unit,new
	$virtual_page = parts_summary.php,product_line,part_number
	$virtual_page = tech_info_results.php,subcategory
*/
$virtual_page = str_replace("'","",$virtual_page);        //must be replaced due to the javascript below
$virtual_page = str_replace("&amp;","and",$virtual_page); //precaution
$virtual_page = str_replace("&reg;","",$virtual_page);    //precaution
?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
<script type="text/javascript">
	_uacct="UA-2838819-1";
	urchinTracker('<?=$virtual_page?>');
</script>