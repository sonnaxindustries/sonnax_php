<?php



function formFieldSafe ($input)
{
	return htmlentities(stripslashes($input),ENT_COMPAT);
}

//public domain from http://quickwired.com/smallprojects/php_xss_filter_function.php
function RemoveXSS($val) {
   // remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed
   // this prevents some character re-spacing such as <java\0script>
   // note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs
   $val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val);
   
   // straight replacements, the user should never need these since they're normal characters
   // this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29>
   $search = 'abcdefghijklmnopqrstuvwxyz';
   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $search .= '1234567890!@#$%^&*()';
   $search .= '~`";:?+/={}[]-_|\'\\';
   for ($i = 0; $i < strlen($search); $i++) {
      // ;? matches the ;, which is optional
      // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars
   
      // &#x0040 @ search for the hex values
      $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ;
      // &#00064 @ 0{0,7} matches '0' zero to seven times
      $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ;
   }
   
   // now the only remaining whitespace attacks are \t, \n, and \r
   $ra1 = Array('javascript', 'vbscript', 'expression', 'applet', 'meta', 'xml', 'blink', 'link', 'style', 'script', 'embed', 'object', 'iframe', 'frame', 'frameset', 'ilayer', 'layer', 'bgsound', 'title', 'base');
   $ra2 = Array('onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');
   $ra = array_merge($ra1, $ra2);
   
   $found = true; // keep replacing as long as the previous round replaced something
   while ($found == true) {
      $val_before = $val;
      for ($i = 0; $i < sizeof($ra); $i++) {
         $pattern = '/';
         for ($j = 0; $j < strlen($ra[$i]); $j++) {
            if ($j > 0) {
               $pattern .= '(';
               $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?';
               $pattern .= '|(&#0{0,8}([9][10][13]);?)?';
               $pattern .= ')?';
            }
            $pattern .= $ra[$i][$j];
         }
         $pattern .= '/i';
         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag
         $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
         if ($val_before == $val) {
            // no replacements were made, so exit the loop
            $found = false;
         }
      }
   }
   return $val;
}
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
<title>Sonnax - Contact Sonnax</title>
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
<style type="text/css">
<!--
.underline {
	font-family: Arial, Helvetica, sans-serif;
	text-decoration: underline;
}
-->
</style>
<link href="site back up/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.asterix {
	color: #FF0033;
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style22 {color: #FF0000}
-->
</style>
</head>
<body>
<div id="container">
<div id="header_about"><div class="header"></div></div>
<?php require "nav.txt";?>
<div id="main">

<div class="content">
  <!-- BEGIN: Constant Contact Basic Opt-in Email List Form -->
 <div align="left" class="content">
   <h3><strong>Contact Sonnax with questions or comments:</strong></h3>
   <p><strong><u>Phone:</u></strong><br>
       <strong>For telephone assistance with any Sonnax product related technical questions, during regular business hours<br>
       (8:30 am – 5:00 pm, Mon – Fri. ET) call: (800) 843-2600 or (802) 463-9722 and ask for Tech Support.</strong></p>
   <p><strong><u>Email:</u></strong><br>
       <strong>For email assistance with any Sonnax product related technical issues or other concerns, submit your <br>
       questions or comments below:</strong></p>
   </div>
 <form name='register' id='register' method='get' action='contact_us_exe.php' class='form' style='margin-left:50px;'>
	<?if (strlen($_GET["missing_info"]) > 0) {?>
		<p><font color=#FF0000>Required information is missing</font></p>
	    <div align="left">
	      <?}?>
	      <?if (strlen($_GET["email_problem"]) > 0) {?>
        </div>
	    <p align="left"><font color=#FF0000>The email address entered appears to be invalid</font></p>
	    <p>
	      <?}?>
	    </p>
	    
	      
        <textarea name='comments' rows='8' cols='50'><?=RemoveXSS($_GET["comments"])?>
	        </textarea>
        <p align="left">&nbsp;</p>
	
	  <div align="left">
	    <table width="370" border="0" align="left" cellpadding="2">
	      <tr>
	        <td width="77" align="left" class="labelset"><div align="left"><span class="asterix">*</span>Name:</div></td>
              <td width="279"><input type='text' name='fullname' value="<?=formFieldSafe($_GET["fullname"])?>" class='field' style='width:250px;'></td>
            </tr>
	      <tr>
	        <td align="left" class="labelset"><div align="left"><span class="asterix">*</span>Email:</div></td>
              <td><input type='text' name='email' value="<?=formFieldSafe($_GET["email"])?>" class='field' style='width:250px;'></td>
            </tr>
	      <tr>
	        <td align="left" class="labelset"><div align="left"><span class="asterix" style="width:45px;">*</span>Company: </div></td>
              <td><input type="text" name="company" value="<?=formFieldSafe($_GET["company"])?>" class='field' style='width:250px;'></td>
            </tr>
	      <tr align="left">
	        <td class="labelset"><div align="left"><span class="style22" style="width:45px;">*</span>Phone:</div></td>
              <td><input type="text" name="phone" value="<?=formFieldSafe($_GET["phone"])?>" class='field' style='width:250px;'></td>
            </tr>
	      <tr>
	        <td colspan="2">
	          
	          <div align="center">
	            <input type="submit" name="button" id="button" value="Submit">&nbsp;
                <input type="Reset" name="button" id="button" value="Reset">
                
                </div></td>
            </tr>
	      <tr>
	        <td colspan="2"><div align="left"><span class="asterix">*</span><span class="cleaner"><strong>Required</strong></span></div></td>
            </tr>
	      </table>
	    </div>
 </form>
 <p>&nbsp;</p>
 <div class="content">
   <p>&nbsp;</p>
   <p><span class="underline"><strong>To sign up</strong></span><strong> for New Product emails:</strong> <strong><a href="insider.html">click here</a></strong>.</p>
 </div>
 </div>
<div class="clear"></div>

</div>
<div id="footer"><?php require "footer.txt";?></div>
</div>
<div id="copy"><h6>&copy; 2008 Sonnax Industries, Inc. Sonnax Transmission, Torque Converter, Performance, Driveline, Allison&reg; Replacement Parts for automotive aftermarket rebuilders.</h6></div>
</body>
</html>