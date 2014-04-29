<?php
$q_press_about="SELECT {$_BLANG} FROM {$CONF['dbtable']['press_about']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_press_about=mysql_query($q_press_about,$CONN);
$row_press_about=mysql_fetch_assoc($r_press_about);
echo <<<html
<form method="post">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="800">
		<tr>
			<td height="20" valign="center" width="100">
				<div id="our_data_fhl"></div>
			</td>
			<td width="20"></td>
			<td id="our_data_title" valign="center" height="20">
				{$_SL['press_about']}
			</td>
		</tr>
		<tr><td colspan="3" height="15"></td></tr>
		<tr>
			<td colspan="3" valign="top" id="bologna_text">
				{$row_press_about[$_BLANG]}
			</td>
		</tr>
	</table>
</form>
html;
?>