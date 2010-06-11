<?
error_reporting (E_ALL ^ E_NOTICE);
require "../classes/clsDataConn.php";
require "../classes/clsLogin.php";
require_once "../classes/clsImage.php";


$login = new Login();
$logged_in = $login->validate();
if (! $logged_in) {
	header ("Location: index.php");
	exit(0);
}


$image = new Image();
$imageID = $_GET["iid"];//the actual image id from the images table
$auction = $_GET["auction"];
$redirect = $_GET["redirect"];
$caption_text = $image->f_get_image_caption($imageID);
$image_location = $image->f_get_image_location ($imageID);
if ($auction == "true") {
	$image_location = "auction/" . $image_location;
}
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
        <td class="header" bgcolor="#75A164" align="center">
          <img alt="Southern Vermont Auctions" width="780" height="106" src="../images/header.gif"><br>
          <span class="head2"><a href="mailto:Info@SouthernVTAuction.com">Info@SouthernVTAuction.com</a></span><br>
          <br>
        </td>
      </tr>
      <tr>
        <td id="nav" align="center">
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
        <td align="center" valign="top" id="main">
          <br>
          <br>
          <h2>Image Caption</h2>
		  <img src="../images/<?=$image_location?>" border=1><BR>
          <table border="0" width="80%" cellpadding="10" cellspacing="0" align="center">
            <tr>
			<form name="caption_edit" method="get" action="caption_edit_exe.php">
              <td valign="top" class="catalog" align="center">
			  	<textarea name="caption_text" id="caption_text" cols="50" rows="10"><?=$caption_text?></textarea><BR>
				<input type="submit" name="submit" value="Update Caption" class="button">
				<input type="hidden" name="iid" value="<?=$imageID?>">
				<input type="hidden" name="redirect" value="<?=$redirect?>">
              </td>
			  </form>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td id="nav" align="center">
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
    </table><br>
  </body>
</html>
