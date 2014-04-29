<?php
$q_sitebologna="SELECT {$_BLANG} FROM {$CONF['dbtable']['bologna']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitebologna=mysql_query($q_sitebologna,$CONN);
$row_sitebologna=mysql_fetch_assoc($r_sitebologna);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['bologna']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			{$row_sitebologna[$_BLANG]}
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
</table>
html;
?>