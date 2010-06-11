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
<title>Sonnax Catalogs</title>
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
<div id="header_gen"><div class="header"></div></div>
<?php require "nav.txt";?>

	<a name="catalogs">
  <div class="content">
		<?
		if ($_GET["select_catalog"] == "true") {
			echo "<font color=\"#FF0000\">Please Select at least one catalog</font>";
		} elseif (strlen($_GET["catalog"]) > 0) {
	
			foreach ($_GET["catalog"] as $value) {
				if ($value == "Transmission Specialties Catalog, Volume 7 in Print") {
					$TransmissionSpecialties_V7inPrint = " CHECKED";
				}
				if ($value == "Transmission Specialties Catalog, Volume 7 on CD") {
					$TransmissionSpecialties_V7onCD = " CHECKED";
				}
				if ($value == "Torque Converter Catalog, Volume 6") {
					$TorqueConverterCatalog_V6 = " CHECKED";
				}
				if ($value == "High Performance Catalog, Volume 6") {
					$HighPerformanceCatalog_V6 = " CHECKED";
				}
				if ($value == "Diagnostic Guide en Espanol") {
					$DiagnosticGuideEspanol = " CHECKED";
				}
				if ($value == "Driveline Brochure") {
					$DrivelineBrochure = " CHECKED";
				}
				if ($value == "PowerTrainSavers Catalog") {
					$PowerTrainSaversCatalog = " CHECKED";
				}
				if ($value == "Transmission Specialties Diagnostic Guide") {
					$TransmissionSpecialtiesDiagnosticGuide = " CHECKED";
				}
				if ($value == "Transmission Specialties in Chinese") {
					$TransmissionSpecialtiesChinese = " CHECKED";
				}
				if ($value == "Ring Gear Spec Sheet") {
					$RingGearSpecSheet = " CHECKED";
				}
				if ($value == "Transmission Specialties en Espanol") {
					$TransmissionSpecialtiesEspanol = " CHECKED";
				}
				if ($value == "Harley-Davidson Catalog") {
					$HarleyDavidsonCatalog = " CHECKED";
				}
				if ($value == "Allison Replacement Parts") {
					$AllisonReplacementParts = " CHECKED";
				}
				if ($value == "Valve Body Training DVD") {
					$ValveBodyTrainingDVD = " CHECKED";
				}
			}
		}
		?>
		<h4>Just a click away, you will find online versions of some of these catalogs. For any printed catalog, CD or DVD we have available to send, please select, then fill in all the fields below. </h4><br>
		<form name='order_catalog' id='order_catalog' method='get' action='request_catalog_exe.php' class='form'>
<div class="catalog"><img src="images/ts7cover-cd.jpg" alt="Transmission Specialties&reg; Catalog, Volume 7" width="155" height="160" align="top">
			  <p>Transmission Specialties&reg; Catalog, Volume 7 on CD Available Now! <br>
			  Select: <input type=checkbox name="catalog[]" value="Transmission Specialties Catalog, Volume 7 on CD"<?=$TransmissionSpecialties_V7onCD?>></p>
			  <p>Transmission Specialties Catalog, Volume 7 in print — <br>
		      access online catalog pages <a href="part_finder.php?pl=3">HERE</a> or get one from a <br>
		      <a href="http://www.sonnax.com/distributor.php?country=USA&go=GO">Transmission Specialties Distributor</a></p>
		  </div>
			
	    <div class="catalog"><img src="images/diagnostic-guide-cover-web.jpg" alt="Transmission Specialties&reg; Diagnostic Guide" width="144" height="186" align="top">
      <p>Transmission Specialties&reg; Diagnostic Guide<br>
		        Select:
		        <input type=checkbox name="catalog[]2" value="Transmission Specialties Diagnostic Guide"<?=$TransmissionSpecialtiesDiagnosticGuide?>>
		        <br>
	      </p>
	      </div>
			
			<div class="catalog"><img src="images/DVD-catalog-page.jpg" alt="Valve Body Training DVD" width="144" height="144" align="top">
              <p>Valve Body Training DVD<br>
                Select:
                <input type=checkbox name="catalog[]3" value="Valve Body Training DVD"<?=$ValveBodyTrainingDVD?>>
              </p>
          </div>
			
	    <div class="catalog"><img src="images/2006-tcpc-cover.jpg" alt="Torque Converter Catalog, Volume 6" width="144" height="188" align="top">
    <p>Torque Converter Catalog, Volume 6<br>
			      <span style="font-weight:normal;">You can access the online catalog pages <a href="part_finder.php?pl=2">HERE</a>.</span></p>
		  </div>

			<div class="clear"></div>
			
			<div class="catalog"><img src="images/2006_h_p_cover_web.jpg" alt="High Performance Catalog, Volume 6" width="144" height="185" align="top">
		    <p>High Performance Catalog, Volume 6<br>
			      <span style="font-weight:normal;">Access the online catalog pages <a href="part_finder.php?pl=1">HERE</a>.</span></p>
		  </div>
			
		  <div class="catalog"><img src="images/allison-vol2-cover-photo.jpg" alt="Allison Replacement Parts" width="144" height="189" align="top">
		    <p>Allison Replacement Parts<br>
		      Select:
		      <input type=checkbox name="catalog[]4" value="Allison Replacement Parts"<?=$AllisonReplacementParts?>>
		    </p>
	      </div>
			
	    <div class="catalog">
	      <p><img src="images/powertrainsaver-web.jpg" alt="PowerTrainSavers Catalog" width="144" height="189" align="top"><br>
<p>PowerTrainSavers® Catalog<br>
		      Select:
              <input type=checkbox name="catalog[]5" value="PowerTrainSavers Catalog"<?=$PowerTrainSaversCatalog?>>
		    </p>
	      </div>
			
<div class="catalog">
  <p><img src="images/drivelinecover-web.jpg" alt="Driveline Brochure" width="144" height="186" align="top"><img src="images/new.gif" alt="New Catalog" width="48" height="20" align="absbottom"><br>
    </p>
<p>Driveline Brochure<br>
		      Select:
	          <input type=checkbox name="catalog[]6" value="Driveline Brochure"<?=$DrivelineBrochure?>>
	      </p>
	  </div>
      <div class="clear"></div>
      <div class="catalog"><img src="images/2006-spanish-diagnosticD1.jpg" alt="Diagnostic Guide en Espa&ntilde;ol" width="144" height="186" align="top">
	    <p>Diagnostic Guide en Espa&ntilde;ol<br>
	    Get one from a <a href="http://www.sonnax.com/distributor.php?country=USA&go=GO">Transmission Specialties Distributor</a></p>
      </div>
	  
			
		  
          <div class="catalog"><img src="images/Spanish-TS3.jpg" alt="Transmission Specialties&reg; en Espa&ntilde;ol" width="144" height="187" align="top">
		    <p>Transmission Specialties&reg; en Espa&ntilde;ol<br>
		    </p>
	      </div>
          <div class="catalog"><img src="images/chinese_cover.jpg" alt="Transmission Specialties&reg; in Chinese" width="144" height="189" align="top">
	        <p>Transmission Specialties&reg; in Chinese</p>
          </div>
			
		  <div class="catalog"><img src="images/ringgear-cover-web.jpg" alt="Ring Gear Spec Sheet" width="144" height="188" align="top">
		    <p>Ring Gear Spec Sheet<br>
		      Select:
		        <input type=checkbox name="catalog[]8" value="Ring Gear Spec Sheet"<?=$RingGearSpecSheet?>>
</p>
</div>
<div class="clear"></div>
			
		  <div class="catalog"><img src="images/harley-flyer-cover-web.jpg" alt="Harley-Davidson&reg; Catalog" width="144" height="188" align="top">
      <p>Harley-Davidson&reg; Catalog<br>
		        Select:
		        <input type=checkbox name="catalog[]9" value="Harley-Davidson Catalog"<?=$HarleyDavidsonCatalog?>>
	          </p>
		  </div>

			
		<div class="cleaner"></div><a name="missing_info">
		<?
		if ($_GET["email_problem"] == "true") {
			echo "<font color=\"#FF0000\">The email address entered appears to be invalid</font>";
		}
		?>
		<div style="margin-left:160px;">
			<div class="labelset">*Name:</div><input type="text" value="<?=htmlentities($_GET["name"])?>" name="name" class="field" style="width:30%;"><div class="clear"></div>
			<div class="labelset">*Company:</div><input type="text" value="<?=htmlentities($_GET["company"])?>" name="company" class="field" style="width:30%;"><div class="clear">
            </div>
			<div class="labelset">*Type of Business:</div><input type="text" value="<?=htmlentities($_GET["type"])?>" name="type" class="field" style="width:30%;"><div class="clear"></div>
			<div class="labelset">*Address:</div><input type="text" value="<?=htmlentities($_GET["address"])?>" name="address" class="field" style="width:30%;"><div class="clear"></div>
			<div class="labelset">*City:</div><input type="text" value="<?=htmlentities($_GET["city"])?>" name="city" class="field"><div class="clear"></div>
			<div class="labelset">*State:</div><input type="text" value="<?=htmlentities($_GET["state"])?>" name="state" class="field"><div class="clear"></div>
			<div class="labelset">*Zip Code:</div><input type="text" value="<?=htmlentities($_GET["zip"])?>" name="zip" class="field"><div class="clear"></div>
			<div class="labelset">*Country:</div><input type="text" value="<?=htmlentities($_GET["country"])?>" name="country" class="field"><div class="clear"></div>
			<div class="labelset">*Telephone:</div><input type="text" value="<?=htmlentities($_GET["telephone"])?>" name="telephone" class="field"><div class="clear"></div>
			<div class="labelset">*Email:</div><input type="text" value="<?=htmlentities($_GET["email"])?>" name="email" class="field" style="width:30%;">&nbsp;&nbsp;
			<input type="submit" name="send" value="SEND" class="submit" style="width:50px;">
		</div>
</form>

<div class="clear"></div>
<h6 style="text-align:left;">*Required fields</h6>
		<div class="clear"></div>
	</div>

<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
</body>
</html>