<?/* 
	$virtual_page = parts_finder.php,product_line,make,unit,new
	$virtual_page = parts_summary.php,product_line,part_number
	$virtual_page = tech_info_results.php,subcategory
*/
$virtual_page = str_replace("'","",$virtual_page);        //must be replaced due to the javascript below
$virtual_page = str_replace("&amp;","and",$virtual_page); //precaution
$virtual_page = str_replace("&reg;","",$virtual_page);    //precaution
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2838819-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  
  $('a[href$="pdf"]').click(function(e) {
    var pageUrl = $(this).attr('href');
    var pageInfo = pageUrl + " (" + $(this).attr('title') + ")";
    _gaq.push(['_trackEvent', 'PDF', 'Downloaded', pageInfo]);
    _gaq.push(['_trackPageview', pageUrl]);
  });
</script>

