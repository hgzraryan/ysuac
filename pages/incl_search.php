<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}
$q_siteuni="SELECT * FROM {$CONF['dbtable']['units']} WHERE status='1'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteuni=mysql_query($q_siteuni,$CONN);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['main_search']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			{$row_sitepostgraduate_degree[$_BLANG]}
		</td>
	</tr>
	<tr>
		<td height="100%" valign="top">
			{$_POST['search']}
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
</table>

html;
?>