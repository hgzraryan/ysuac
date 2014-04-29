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
			<a href="?go={$_GET['go']}&sub=int_contacts">{$LANG['admin_menu31'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=events">{$LANG['admin_menu47'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=educational_process">{$LANG['admin_menu48'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=international_conferences">{$LANG['admin_menu49'][$_SESSION['lang']]}</a>
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