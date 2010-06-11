<?
error_reporting (E_ALL ^ E_NOTICE);
require "../includes/classes/clsDataConn.php";
require "../includes/classes/clsAdminLogin.php";

/*
require_once "includes/classes/clsPartFinder.php";
require_once "includes/classes/clsMakes.php";
require_once "includes/classes/clsUnits.php";
require_once "includes/classes/clsUnitsBrief.php";
require_once "includes/generic_functions.php";

*/

//$message = $_GET["message"];
$login = new Login();
$logged_in = $login->validate();
if (! $logged_in) {
	header ("Location: index.php");
	exit(0);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Editable Tables</title>
</head>

<body bgcolor=#FFFFFF>

<div align="center"><A href="adminhome.php">Admin Home</A></div>
<BR>

<div align="center"><strong><font size="+1">Editable Tables</font></strong></div>

<BR>
<table align="center">
<tr>
	<td>
		<a href="tw_eventcategory_contents.php">
		Event Category Code</a>
	</td>
</tr>
<tr>
	<td>
		<a href="table_contents.php?t=`sbo_EventLocationTowns`&if=`ID`&df=`Display`&ob=`Display`&rf=ID,Display,Value,Active">
		Event Location Towns</a>
	</td>
</tr>
<tr>
	<td>
		<BR>
	</td>
</tr>
<tr>
	<td>
		<a href="cuisinecode_contents.php">
		Cuisine Code</a>
	</td>
</tr>
<tr>
	<td>
		<!a href="table_contents.php?t=`sbo_DiningTypeCode`&if=`ID`&df=`Display`&ob=`Display`&rf=ID,Display,Value,Active">
		Dining Type Code</a> (Non-editable)
	</td>
</tr>

<tr>
	<td>
		<a href="table_contents.php?t=`sbo_MemberLocationTowns`&if=`ID`&df=`Display`&ob=`Display`&rf=ID,Display,Value,Active">
		Member Location Towns</a>
	</td>
</tr>
<tr>
	<td>
		<a href="table_contents.php?t=`sbo_MemberType`&if=`ID`&df=`Display`&ob=`Display`&rf=ID,Display,Value,Active">
		Member Type</a>
	</td>
</tr>
<tr>
	<td>
		<a href="table_contents.php?t=`sbo_PreferredContactMethod`&if=`ID`&df=`Display`&ob=`Display`&rf=ID,Display,Value,Active">
		Preferred Contact Method</a>
	</td>
</tr>
<tr>
	<td>
		<a href="subcategory_contents.php">
		Sub-Categories</a>
	</td>
</tr>
<tr>
	<td>
		<a href="table_contents.php?t=`sbo_WeddingSpecialties`&if=`ID`&df=`Display`&ob=`Display`&rf=ID,Display,Value,Active">
		Wedding Specialties</a>
	</td>
</tr>
</table>
<BR>
</body>
</html>

