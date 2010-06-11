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

<?
$status = $_GET["status"];
$imageID = $_GET["iid"];
$imageType = $_GET["type"];
$imageField = $_GET["field"];

switch ($imageType) {
	case "about_us":
		$show_set = false;
		$image_directory_path = "images/";
		$table = "about_us_page";
		$redirect = "about_us.php";
		break;
	case "index_side":
		$show_set = false;
		$image_directory_path = "images/";
		$table = "index_page";
		$redirect = "index_admin.php";
		break;
	case "index_center":
		$show_set = false;
		$image_directory_path = "images/";
		$table = "index_page";
		$redirect = "index_admin.php";
		break;
	case "past_sales":
		$show_set = true;
		$image_directory_path = "images/";
		$table = "past_sales_page";
		$redirect = "pastsales.php";
		break;
	case "current":
		$show_set = true;
		$image_directory_path = "images/auction/";
		$table = "images";
		$redirect = "photos.php";
		break;
	default:
		$show_set = false;
		$image_directory_path = "";
		$table = "";
		$redirect = "index_admin.php";
		$message .= "?";
}

$cls_image = new Image();
//$arr_data = $cls_image->index_select();

// did the insert operation succeed?
switch ($status) {
	case "T":
		// Yes, insert operation succeeded. 
		
		$str_image_source = $cls_image->f_get_image_location ($imageID);
		?>
		<table align="center">
		<tr>
			<td colspan=2>
				<font face="Arial,Helvetica,sans-serif" size="+2" color="#333366">File Insert Receipt</font><br>
				<font face="Arial,Helvetica,sans-serif" size="+1" color="#3366CC">The following file was successfully uploaded:</font>
			</td>
		</tr>
		<tr>
		   <td><font color="red" face="Arial,Helvetica,sans-serif" color="#3366CC">File:</font></td>
		   <td>
		   	<? if ($show_set == true) {?>
		   		<img src="../<?=$image_directory_path?><?=$str_image_source ?>"><BR>
				<img src="../<?=$image_directory_path?>t_<?=$str_image_source ?>"><BR>
			<? } else {?>
		   		<img src="../<?=$image_directory_path?><?=$str_image_source ?>"><BR>
			<? }?>
		   </td>
		</tr>
		</table>
		<?
		break;
	case "F":
		// No, insert operation failed
		// Show an error message?>
		<table align="center">
			<tr>
				<td>
				The file insert operation failed.<BR>
				Contact the system administrator.<BR>
				</td>
			</tr>
		</table>
		<? break;
	default:
		// User did not provide a status parameter?>
		<table align="center">
			<tr>
				<td>
				You arrived unexpectedly at this page.
				</td>
			</tr>
		</table>
	<? } // end of switch

?>

<table align="center">
	<tr>
		<td>
		<a href="<?=$redirect?>">Return to previous page</a><br>
		<a href="admin_index.php">Admin Home Page</a><BR>
		</td>
	</tr>
</table>
<BR><BR><BR>
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