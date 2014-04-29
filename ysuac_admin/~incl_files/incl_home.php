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
			<a href="?go={$_GET['go']}&sub=news">{$LANG['admin_menu3'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=announcements">{$LANG['admin_menu23'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=partners">{$LANG['admin_menu22'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=slideshow">{$LANG['admin_menu32'][$_SESSION['lang']]}</a>
		</td>
		<td id="cat_right"></td>
	</tr>
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