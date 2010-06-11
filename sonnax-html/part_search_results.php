<?php 
include 'includes/classes/clsPartSearch.php';

if (strlen($_GET["pn"]) == 0) {
	header('Location: http://www.sonnax.com/quick_search.php');
}

$partSearch = new PartSearch($_GET["pn"]);
$productLineCount = $partSearch->findProductLineCount();  // the number of different product lines in results
$partStack = $partSearch->getPartStack();


$show_results = true;  // show search results
if ( $partStack->count() == 1 ) {
	$part = $partStack->removePart();
	header('Location: part_summary.php?id=' . $part->id . '&pl=' . $part->product_line);
} else if ($productLineCount == 1) {
	// only one product line being shown, so redirect to the product line page
	$part = $partStack->removePart();
	header('Location: http://www.sonnax.com/part_finder.php?pn=' . $_GET["pn"] . '&go=GO&pl=' . $part->product_line);
} else if ( $partStack->count() == 0 ) {
	// no search results
	$show_results = false;
}

// test information
//echo "part count: " . $partStack->count() . " product lines: " . $productLineCount . " show results: " . $show_results . "<BR>";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta http-equiv="Content-Language" content="en">
	<meta name="description" content="Sonnax">
	<meta name="keywords" content="Sonnax">
	<meta name="author" content="Sonnax">
	<meta name="copyright" content="Sonnax">
	<meta name="robots" content="all">
	<link rel="contents" href="#" title="Sonnax">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<title>Sonnax Transmission, Torque Converter, Performance, Driveline Parts :: </title>
<!--[if IE]>
<style type="text/css" media="screen">
#menu{float:none;} 
/* IE Menu CSS */
body{behavior:url(css/csshover.htc);
font-size:100%; 
}
#menu ul li{float:left;width:100%;}
#menu h2, #menu a{height:1%;font:bold 0.7em/1.4em arial,helvetica,sans-serif;}
</style>
<![endif]-->
<script type="text/javascript" src="js/iehover-fix.js"></script>

</SCRIPT>
</head>
<body>
<div id="container">
	<div id="header_gen"><div class="header"><h3>
	<br>Title</h3></div></div>
	<?php require "nav.txt";?>
	<div id="main">
		<div class="content">
			<div class="cleaner"></div>
			<div id="search">
					<div class="long">
		
		<div class="long" style='width:340px;'>
		<form name='part_number' id='part_number' method='get' class='form'>
			<div class='label'><strong>Search Part Number:</strong></div>
			<input type='text' name='pn' class='field' value=''>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
		</form>
		</div>
					</div><!-- id=search -->
		
			<div class="cleaner"></div>
						<style type="text/css">
<!--
.style2 {
	font-family: Arial, Helvetica, sans-serif;
	color: #024368;
	font-weight: bold;
}

-->
</style>
		
        <div></div> 
		<div id='scroll'>
  			<div class='med' style='font-weight:bold;'>Part Number</div>
			<div class='long2' style='font-weight:bold;'>Product Line</div>
			<div class="line"></div>
			<!-- END OF TITLE ROW -->
			
<?php
			if ($show_results) {
				$partNumber = "";
								
				while ( ( $part = $partStack->removePart() ) ) {
					
					if ($partNumber != $part->part_number) { // if the part number has changed, then start a new part row
						if (strlen($partNumber) != 0) {  // add a closing div if not at the first part
	?>
					</div>
					
					<div class='line'></div>
	<?php
						}
	?>
					<div class='med'><strong><?php echo $part->part_number;?></strong></div>
					<div class='long2'>
	<?php 
					}
	?>
						<div style="border-bottom:0px solid #ccc;padding-bottom:4px;">
							<span style="display:block;width: 230px; float:left; padding-bottom:4px;">
							<?php echo $part->getProductLineName();?>
							</span> 
							<a href="part_summary.php?id=<?php echo $part->id?>&pl=<?php echo $part->product_line?>">More Info</a>
						</div>
			         
	<?php 
					$partNumber = $part->part_number;
				} // end while loop
			} else {
	?>
						<div style="border-bottom:0px solid #ccc;padding-bottom:4px;">
							<span style="display:block;width: 300px; float:left; padding-bottom:4px;padding-left:14px;">
							<BR>
							No Parts Found, Please Try Again.
							</span> 
						</div>
	<?php
			}
?> 
		</div>  
		<div class="cleaner"></div>
		</div>

<div class="cleaner"></div>			
						<div class="cleaner"></div>
						
			<div class="cleaner"></div>
		</div>	
		</div><!-- id=content -->
	</div><!-- id=main -->
	<div id="footer"><?php require "footer.txt";?></div>
</div><!-- id=container -->
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>


</body>
</html>