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
<title>Sonnax - Quick Search</title>
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
function goThere(loc) {
	window.location.href=loc;
}
//-->
</SCRIPT>
<style type="text/css">
<!--
.style2 {
	color: #024368;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<div id="container">
<div id="header_gen">
<div class="header"></div>
</div>
<?php require "nav.txt";?>
<div id="main">

<div class="content">
<h4>Quick Search by Sonnax part number:</h4>
<form name='part_search' id='product_line_search2' method='get'
	action='part_search_results.php' class='form' style="padding-left: 50px;">
<div class="long">
<div class='label'></div>

</div>

<div class="long">
<div class='label'>Search Part Number:</div>
<input type='text' name='pn' class='field'> <input type='submit'
	name='go' value='GO' class='submit' style='width: 34px;'></div>
</form>

<div class="cleaner"></div>
<h4><a href="request_catalog.php">Request Sonnax Catalogs</a></h4>
</div>


</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy">
<h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque
Converter, Performance, Driveline, Allison&reg; Replacement Parts for
automotive aftermarket rebuilders.</h6>
</div>
</body>
</html>
