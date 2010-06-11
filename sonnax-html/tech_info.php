<?
header( 'Content-Type: text/html;charset=UTF-8' );

require_once "includes/classes/clsPublications.php";
require_once "includes/generic_functions.php";
require_once("includes/settings.php");//holds paths to pdfs, images, etc.


$cls_publications = new Publications();
$arr_publications = $cls_publications->lookupPublicationCategories();
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
<title>Sonnax - Technical Information</title>
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
<Script language="JavaScript">
function forwardPage(int_form_id) {
	var theForm 		= document.forms[int_form_id];
	int_category_id 	= theForm.elements[0].value;
	int_subcategory_id 	= theForm.elements[1].value;
	
	window.location.href= "tech_info_results.php?category_id="+int_category_id+"&subcategory_id="+int_subcategory_id;
}
</Script>

<style type="text/css">
<!--
.links {
	color: #024368
}
-->
</style>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="container">

<div id="header_gen"><div class="header"></div></div>
<?php require "nav.txt";?>
<div id="main">
<form action="http://www.google.com/cse" target="_blank" id="cse-search-box">

        <div align="right">
          <input type="hidden" name="cx" 

value="015904203031338718468:pkyivudp_6m" />
          <input type="hidden" name="ie" value="UTF-8" />
          <span class="form"> Search : </span>
          <input type="text" name="q" size="31" />
          <input type="image" src="black-arrow.png" align="bottom" value="submit" name="submit" />
         
      </div>
    </form>

<div class="content">
<h3>Technical Information</h3>
<p class="content">Sonnax offers a broad range of publications to help technicians stay abreast of developments in automatic transmission rebuilding. Select from one of the publication types below for a list of articles to read online or print. Click on underlined text for <a href="sonnax-publications.html"><strong>a brief description of Sonnax publications</strong></a> or <a href="request_catalog.php"><strong> to request a catalog</strong>.</a></p>
<p class="content">&nbsp;</p>
<h4>Select the publication you need:</h4>
<div class="cleaner"><span class="required"><a name="spanish"></a></span></div>
<!-- goes to tech_info_results.php --><?
$int_num_categories = count($arr_publications["publication_categories.id"])-1;
for ($x=0;$x<=$int_num_categories;$x++) {
?>
	<form name='publication<?=$x?>' id='publication<?=$x?>' method='get' action='tech_info_results.php' >
	<input type='hidden' name='category_id' value='<?=$arr_publications["publication_categories.id"][$x]?>'>
	<div class="form">
			<div class='label'><?=$arr_publications["publication_categories.category"][$x]?>:</div>
			<select name='subcategory_id' id='subcategory_id' class='dropdown' ONCHANGE='forwardPage(<?=$x + 1?>)'>
				<option value='' selected>Select</option>
				<?
				$arr_subcategories = $cls_publications->lookupPublicationSubCategories($arr_publications["publication_categories.id"][$x]);
				$int_num_subcategories = count($arr_subcategories["publication_subcategories.id"])-1;
				for ($y=0;$y<=$int_num_subcategories;$y++) {?>
				<option value='<?=$arr_subcategories["publication_subcategories.id"][$y]?>'><?=$arr_subcategories["publication_subcategories.subcategory"][$y]?></option>
				<?}?>
			</select>&nbsp;&nbsp;
			<input type='submit' name='go' value='GO' class='submit' style='width:34px;'>
	</div>
	</form>
	<div class="cleaner"></div>
<? }?>
	<div class="cleaner"></div>
	<h4 align="left"><strong><a href="request_catalog.php"><img src="images/DVD-icon.jpg" width="72" height="59" margin="0" border="0" align="left"></a><a href="request_catalog.php">Valve Body Rebuilding Guidelines (click here to order Valve Body Training DVD)</a> </strong></h4>
<p>Narrated by Sonnax Vice President of Technical Development Bob Warnke, the Valve Body Training DVD covers valve and pump body wear, inspection, reaming procedures and testing. Learn the basics of visual inspection, Wet Air Tests, vacuum and deflection testing, along with step-by-step demonstrations on bore sizing, reaming, test stands and more.&nbsp;</p>
<table width="694" border="0" cellpadding="10">
  <tr>
    <td width="670"><p><a href="video/valve-body-clip-qt.mov" target="_blank"><strong>Click here to play a clip from the Valve Body Training DVD using QUICK TIME</strong></a> <br>
      If you do not have Quick Time, download it here: <a href="http://www.quick-time-download.com/"><strong>Quick Time</strong></a></p></td>
  </tr>
  <tr>
    <td height="77"><p><a href="video/valve-body-clip.wmv" target="_blank"><strong>Click here to play a clip from the Valve Body Training DVD using WINDOWS MEDIA</strong></a><br>
      </a> If you do not have Windows Media, download it here: <a href="http://www.microsoft.com/windows/windowsmedia/player/9series/"><strong>Windows Media</strong></a></p>
      </p></td>
  </tr>
</table>
<p class="required"><strong>Reaming Instructions (pdfs):</strong></p>
<table width="725" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="340" class="content" align="left"><strong><a href="tech-articles/sonnax-tool-kits-VB-FIX-visual.pdf" target="_blank">Sonnax Tool Kits using VB-FIX (visual layout)</a></strong></td>
    <td width="385" align="left" class="content"><strong><u><a href="tech-articles/sonnax-tool-kit-w-drill-jig.pdf" target="_blank">Sonnax Tool Kit with drill jig</a></u></strong></td>
  </tr>
  <tr>
    <td height="40" valign="top" class="content"><strong><u><a href="tech-articles/sonnax-tool-kits-using-VB-FIX.pdf" target="_blank">Sonnax Tool Kits using VB-FIX</a></u></strong>    </td>
    <td align="left" valign="top" class="content"><strong><a href="tech-articles/standard-sonnax-tool-kit.pdf" target="_blank">Standard Sonnax Tool Kit (no drill jig, no reaming fixture)</a></strong></td>
  </tr>
</table>

<p class="required"><strong>Vacuum Testing Guidelines</strong></p>
<p class="content">Vacuum testing information and test results provided in Sonnax literature  should be used as a guideline only. The pump, gauge and any calibration orifices used in specific equipment configurations will greatly influence vacuum test readings. Please read the source information below  for guidelines on set-up and calibration as well as general recommendations and pass/fail parameter suggestions. Please note: pass/fail parameters are altered by the number of spools tested in a captive circuit, spool diameters, and contact length of spool with its bore.</p>
<p>&nbsp;</p>
<p><br>
</p>
<div class="cleaner"></div>
</div>

	
</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
<?php
$virtual_page = "tech_info.php";
include_once "includes/analyticstracking.php";
?>
</body>
</html>