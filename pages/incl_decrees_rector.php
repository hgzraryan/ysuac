<?php
$q_decrees_rector="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_legal_acts']} WHERE description='decrees_rector'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_decrees_rector=mysql_query($q_decrees_rector,$CONN);
$row_decrees_rector=mysql_fetch_assoc($r_decrees_rector);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['legal_acts']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['decrees_rector']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['decrees_rector']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			{$row_decrees_rector[$_BLANG]}
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
	<tr><td height="20"></td></tr>
</table>
html;
?>