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
			<a href="?go={$_GET['go']}&sub=foreign_entrant">{$LANG['admin_menu25'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=postgraduate_degree">{$LANG['admin_menu26'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=masters_degree">{$LANG['admin_menu27'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=distance_learning">{$LANG['admin_menu28'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=entry_course">{$LANG['admin_menu29'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=construction_college">{$LANG['admin_menu45'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=high_school">{$LANG['admin_menu46'][$_SESSION['lang']]}</a>
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