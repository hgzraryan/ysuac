<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
echo <<<html
<table  border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td width="10"></td>
		<td width="47">
			<a href="?go=admin_system&sub=moderators"><img src="images/admin_users.png" border="0"></a>
		</td>
		<td width="10"></td>
		<td width="47">
			<a href="?go=admin_system&sub=site_languages"><img src="images/language.png" border="0"></a>
		</td>
		<td>&nbsp;</td>
		<td width="10"></td>
	</tr>
	<tr><td colspan="6" height="10"></td></tr>
	<tr>
		<td colspan="6" valign="top" align="left">
html;
	include_once("~incl_files/incl_sub_{$_SESSION['sub']}.php");
echo <<<html
		</td>
	</tr>
</table>
html;
?>