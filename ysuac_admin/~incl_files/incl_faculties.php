<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">	
	<tr>
		<td id="cat_left"></td>
		<td id="cat_rep">
			<a href="?go={$_GET['go']}&facid={$_GET['facid']}&sub=fac_history">{$LANG['admin_menu66'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&facid={$_GET['facid']}&sub=fac_specialized_chairs">{$LANG['admin_menu67'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&facid={$_GET['facid']}&sub=fac_team">{$LANG['admin_menu68'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&facid={$_GET['facid']}&sub=fac_council">{$LANG['admin_menu69'][$_SESSION['lang']]}</a>
		</td>
		<td id="cat_right"></td>
	</tr>
	<tr><td colspan="3" height="5"></td></tr>
	<tr>
		<td colspan="3" valign="top" align="left">
html;
	include_once("~incl_files/incl_sub_{$_SESSION['sub']}.php");
echo <<<html
		</td>
	</tr>
</table>
html;
?>