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
			<a href="?go={$_GET['go']}&sub=specialized_council">{$LANG['admin_menu33'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=composition_of_board">{$LANG['admin_menu34'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=theses_defenses">{$LANG['admin_menu35'][$_SESSION['lang']]}</a>
			<a href="?go={$_GET['go']}&sub=authors_abstract_delivery_list">{$LANG['admin_menu36'][$_SESSION['lang']]}</a>
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