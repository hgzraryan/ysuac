<?php
$q_sitedistance_learning="SELECT {$_BLANG} FROM {$CONF['dbtable']['distance_learning']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitedistance_learning=mysql_query($q_sitedistance_learning,$CONN);
$row_sitedistance_learning=mysql_fetch_assoc($r_sitedistance_learning);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['applicant']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['distance_learning']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['distance_learning']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			{$row_sitedistance_learning[$_BLANG]}
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
</table>
html;
?>