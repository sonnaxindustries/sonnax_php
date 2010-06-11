<?



if (strlen($_GET["name"]) < 1 || strlen($_GET["company"]) < 1 ||
	strlen($_GET["address"]) < 1 || strlen($_GET["city"]) < 1 ||
	strlen($_GET["state"]) < 1 || strlen($_GET["zip"]) < 1 ||
	strlen($_GET["country"]) < 1 || strlen($_GET["email"]) < 1 || strlen($_GET["type"]) < 1) {
	header("Location: request_catalog.php?".$_SERVER["QUERY_STRING"]."#missing_info");
}

if (!check_email_address($_GET["email"])) {
	header("Location: request_catalog.php?".$_SERVER["QUERY_STRING"]."&email_problem=true#missing_info");
}

foreach ($_GET["catalog"] as $value) {
	$catalogs .= $value . "<BR>";
}
//var_dump($catalogs);

if (strlen($catalogs) < 1) {
	header("Location: request_catalog.php?".$_SERVER["QUERY_STRING"]."&select_catalog=true#catalogs");
}


$strSubject = "Catalog Request";
$strFrom = "SonnaxWebsite";
$strTo = "sonnaxlit@sonnax.com,nate@theklaibers.com";//"theinel@comcast.net";//

$strHeaders = "From: ".$strFrom."\r\n".
	"MIME-Version: 1.0\r\n" .
	"Content-type: text/html; charset=UTF-8\r\n";

$strBodyHeader = "
	<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
	<HTML>
		<BODY BGCOLOR=#FFFFFF>
	 		<TABLE BGCOLOR=#FFFFFF>";
				//<TR><TD>Field</TD><TD>Value</TD></TR>
$strBodyFooter = "</TABLE></BODY></HTML>";

$strBodyMain = "
	<TR><TD>Name</TD><TD>".$_GET["name"]."</TD></TR>\n
	<TR><TD>Company</TD><TD>".$_GET["company"]."</TD></TR>\n
	<TR><TD>Address</TD><TD>".$_GET["address"]."</TD></TR>\n
	<TR><TD>City</TD><TD>".$_GET["city"]."</TD></TR>\n
	<TR><TD>State</TD><TD>".$_GET["state"]."</TD></TR>\n
	<TR><TD>Zip</TD><TD>".$_GET["zip"]."</TD></TR>\n
	<TR><TD>Country</TD><TD>".$_GET["country"]."</TD></TR>\n
	<TR><TD>Telephone</TD><TD>".$_GET["telephone"]."</TD></TR>\n
	<TR><TD>Email</TD><TD>".$_GET["email"]."</TD></TR>\n
	<TR><TD>Type of Business</TD><TD>".$_GET["type"]."</TD></TR>\n
	<TR><TD>&nbsp;</TD><TD>&nbsp;</TD></TR>\n
	<TR><TD valign=top>Catalogs</TD><TD>".$catalogs."</TD></TR>\n";

mail($strTo, $strSubject, ($strBodyHeader . $strBodyMain . $strBodyFooter),$strHeaders);


header("Location: thanx_order.php");

//found on web, copuld be better
function check_email_address($email) {
	// First, we check that there's one @ symbol, and that the lengths are right
	if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
		// Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
		return false;
	}
	// Split it into sections to make life easier
	$email_array = explode("@", $email);
	$local_array = explode(".", $email_array[0]);
	for ($i = 0; $i < sizeof($local_array); $i++) {
		if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
			return false;
		}
	}
	if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
	$domain_array = explode(".", $email_array[1]);
		if (sizeof($domain_array) < 2) {
			return false; // Not enough parts to domain
		}
		for ($i = 0; $i < sizeof($domain_array); $i++) {
			if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
				return false;
			}
		}
	}
	return true;
}
?>