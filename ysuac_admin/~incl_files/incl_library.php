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
			<a href="?go={$_GET['go']}&sub=bulletin">{$LANG['admin_menu70'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=bulletin_edboard">{$LANG['admin_menu84'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=bulletin_articles_requirements">{$LANG['admin_menu85'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=collection_builders">{$LANG['admin_menu75'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=credit_bulletin">{$LANG['admin_menu76'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=about_the_journal">{$LANG['admin_menu78'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=archive">{$LANG['admin_menu79'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=admission_order">{$LANG['admin_menu80'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=articles_requirements">{$LANG['admin_menu81'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=editional_borad">{$LANG['admin_menu82'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=journal">{$LANG['admin_menu83'][$_SESSION['lang']]}</a>
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