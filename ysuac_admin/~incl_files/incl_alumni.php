<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">	
	<tr>
		<td id="cat_left_big"></td>
		<td id="cat_rep_big" valign="top" align="left">
			<a href="?go={$_GET['go']}&sub=alumni_home">{$LANG['admin_menu65'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=alumni_search">{$LANG['admin_menu59'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=alumni_charter">{$LANG['admin_menu60'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=alumni_functions">{$LANG['admin_menu61'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=alumni_registration">{$LANG['admin_menu62'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=alumni_events">{$LANG['admin_menu63'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=alumni_famous">{$LANG['admin_menu64'][$_SESSION['lang']]}</a>
		</td>
		<td id="cat_right_big"></td>
	</tr>
	<tr><td colspan="3" height="8"></td></tr>
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