<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
#pre($_SESSION);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">	
	<tr>
		<td id="cat_left_big"></td>
		<td id="cat_rep_big" valign="top" align="left">
			<a href="?go={$_GET['go']}&sub=board_staff">{$LANG['admin_menu14'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=board_sessions">{$LANG['admin_menu37'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=academic_council">{$LANG['admin_menu38'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=decisions_council">{$LANG['admin_menu39'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=rectors_staff">{$LANG['admin_menu40'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=board_decisions">{$LANG['admin_menu41'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=departments">{$LANG['admin_menu16'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=faculity">{$LANG['admin_menu17'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=chairs">{$LANG['admin_menu18'][$_SESSION['lang']]}</a>
			<a href="?go=alumni">{$LANG['admin_menu20'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=units">{$LANG['admin_menu19'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=menu_history">{$LANG['admin_menu50'][$_SESSION['lang']]}</a>
		</td>
		<td id="cat_right_big"></td>
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