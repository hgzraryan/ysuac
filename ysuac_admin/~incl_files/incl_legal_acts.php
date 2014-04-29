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
			<a href="?go={$_GET['go']}&sub=order_mse">{$LANG['admin_menu52'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=charter">{$LANG['admin_menu53'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=reg_rules">{$LANG['admin_menu54'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=decrees_rector">{$LANG['admin_menu55'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=order_rector">{$LANG['admin_menu56'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=governing_council">{$LANG['admin_menu57'][$_SESSION['lang']]}</a>
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