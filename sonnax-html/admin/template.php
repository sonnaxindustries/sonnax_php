﻿<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../includes/classes/clsDataConn.php";
require_once "../includes/classes/clsAdminLogin.php";
/*
require_once "../includes/classes/clsPartFinder.php";
require_once "../includes/classes/clsMakes.php";
require_once "../includes/classes/clsUnits.php";
require_once "../includes/classes/clsUnitsBrief.php";
require_once "../includes/generic_functions.php";
*/
require_once "includes/inc_admin_validate.php";

$message = $_GET["message"];
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
<title>Sonnax Admin</title>
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
</head>
<body>
<div id="container">
	<div id="header_trans">
		<div class="header"><h3>Admin</h3></div>
	</div>
	<?php require "nav_admin.txt";?>
	<div id="main">
		<div class="content">
			<div class="cleaner"></div>
			<? if (strlen($message) > 0) {?>
				<div class="warning"><?=$message?></div>
				<div class="cleaner"></div>
			<? }?>
			
			
			
			Content area<br>
			<BR>
			<B>Bold content</B><BR>
			<br>
			
			
			
			<div class="cleaner"></div>
		</div><? //content?>
	</div><? //main?>
	<div id="footer"><?php require "footer.txt";?></div>
</div><? //container?>
<div id="copy"><h6>&copy; 2007 Sonnax Industries, Inc.</h6></div>
</body>
</html>