<?
function f_OutputErrorNow($strErrorMessage) {
	?>
	<HTML>
	<BODY bgcolor=#FFFFFF>
		<BR><BR><B>The following errors occured...</B><BR><BR>
		<font color=black>
	<?
	echo $strErrorMessage;
	?>	
		</font>
		<BR><BR>
		Please return to the <a href="javascript:history.back()">previous page</a>, correct these mistakes, and try again.
	</BODY>
	</HTML>
	<?
	die;
}
?>