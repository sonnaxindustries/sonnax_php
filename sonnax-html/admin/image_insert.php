<?
error_reporting (E_ALL ^ E_NOTICE);
require_once "../classes/clsDataConn.php";
require_once "../classes/clsLogin.php";
require_once "../classes/clsAdmin.php";
require_once "../classes/clsImage.php";


$login = new Login();
$logged_in = $login->validate();

if (! $logged_in) {
	header ("Location: index.php");
	exit(0);
}



$imageID = $_GET["iid"];//the actual image id from the images table
$imageType = $_GET["type"];//where is this image going eg. current, about_us, index_side, index_center, etc
$imageField = $_GET["field"];//this is used for the page level tables i.e. right_center_1_id in index_page table)
if (strlen($imageType) < 1) {
	$imageID = $_POST["iid"];
	$imageType = $_POST["type"];
	$imageField = $_POST["field"];
}

//echo "imageID: _" . $imageID . "_<BR>";
//echo "imageType: _" . $imageType . "_<BR>";
//echo "imageField: _" . $imageField . "_<BR>";

//phpinfo();
//var_dump(gd_info());
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta name="generator" content="HTML Tidy for Windows (vers 12 April 2005), see www.w3.org">
    <title>
      Southern Vermont Auctions
    </title>
    <meta name="copyright" content="Copyright 2006, ALL RIGHTS RESERVED">
    <meta name="DESCRIPTION" content="">
    <meta name="KEYWORDS" content="">
    <meta name="robots" content="all">
    <meta name="Author" content="Katie Kenny">
    <meta http-equiv="Content-Language" content="en-us">
    <link rel="stylesheet" type="text/css" href="style1.css">
  </head>
  <body topmargin="0" bottommargin="0" marginwidth="0" marginheight="0" leftmargin="0" rightmargin="0" link="#000000" vlink="#000000" alink="#000000">
    <table border="0" width="700" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td colspan="3" class="header" bgcolor="#75A164" align="center">
          <img alt="Southern Vermont Auctions" width="780" height="106" src="../images/header.gif"><br>
          <span class="head2"><a href="mailto:Info@SouthernVTAuction.com">Info@SouthernVTAuction.com</a></span><br>
          <br>
        </td>
      </tr>
      <tr>
        <td colspan="3" id="nav" align="center">
          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">
                <a href="index.php" class="nav">ADMIN</a>
              </td>
              <td align="center">
                <a href="index_admin.php" class="nav">HOME</a>
              </td>
              <td align="center">
                <a href="about_us.php" class="nav">ABOUT US</a>
              </td>
              <td align="center">
                <a href="photos.php" class="nav">CURRENT AUCTION PHOTOS</a>
              </td>
              <td align="center">
                <a href="catalogue.php" class="nav">CURRENT CATALOGUE</a>
              </td>
              <td align="center">
                <a href="pastsales.php" class="nav">PAST SALES</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
	  <tr>
        <td colspan="3" align="center" valign="top" id="main">
          <table border="0" cellpadding="10" cellspacing="0" width="100%">
            <tr>
              <td valign="top" class="home">
			  
			  
			  
			  
    <form method="post" action="image_insert_exe.php" enctype="multipart/form-data">

    <table align="center" cellpadding=2 cellspacing=2 width=500>
	<tr>
		<td colspan=2>
			<font face="Arial,Helvetica,sans-serif" size="+2" color="#333366">Upload an Image File</font><BR>
			<BR>
			<div align=justify>
			<font face="Arial,Helvetica,sans-serif" color="#3366CC">The system only excepts JPG files and has a file size limit of 1.8 MB.
			</DIV><BR>
			<font face="Arial,Helvetica,sans-serif" size="+1" color="#3366CC">Use the Browse button to choose a file.</font>
		</td>
	</tr>
    <tr>    
       <td><font face="Arial,Helvetica,sans-serif" color="#FF0000">File:</font></td>
       <td><input type="file" name="userfile" size="30"></td>
    </tr>

    <tr>
	   <td></td>
       <td><input type="submit" value="Upload Image"></td>
    </tr>
    </table>
    <input type="hidden" name="MAX_FILE_SIZE" value="1800000">
	<input type="hidden" name="iid" value="<? echo $imageID; ?>">
	<input type="hidden" name="type" value="<? echo $imageType; ?>">
	<input type="hidden" name="field" value="<? echo $imageField; ?>">
    </form>
			  
			  
			  
			  
			  </td>
			 </tr>
			</table>
		</td>
	</tr>
      <tr>
        <td colspan="3" id="nav" align="center">
          <table border="0" width="100%" cellpadding="0" cellspacing="0">
            <tr>
              <td align="center">
                <a href="index.php" class="nav">ADMIN</a>
              </td>
              <td align="center">
                <a href="index_admin.php" class="nav">HOME</a>
              </td>
              <td align="center">
                <a href="about_us.php" class="nav">ABOUT US</a>
              </td>
              <td align="center">
                <a href="photos.php" class="nav">CURRENT AUCTION PHOTOS</a>
              </td>
              <td align="center">
                <a href="catalogue.php" class="nav">CURRENT CATALOGUE</a>
              </td>
              <td align="center">
                <a href="pastsales.php" class="nav">PAST SALES</a>
              </td>
            </tr>
          </table>
        </td>
      </tr>  
    </body>
    </html>
