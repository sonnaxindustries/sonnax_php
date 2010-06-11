<table align=center cellspacing=2 cellpadding=2 bgcolor=#DDDDDD>
<tr>
<form action="search_results.php" method=GET name="search_form">
<td>
	&nbsp;<input type=text name="search_for" size=10 value="<?=htmlentities($search_for,ENT_COMPAT)?>"><input type=submit name="submit" value="Search">
</td>
</form>
</tr>
</table>