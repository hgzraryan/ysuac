<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}
$q_architectures_union="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_partners']} WHERE description='architectures_union'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_architectures_union=mysql_query($q_architectures_union,$CONN);
$row_architectures_union=mysql_fetch_assoc($r_architectures_union);


echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td align="center" valign="center" colspan="3" height="29">
			<div id="constructors_union_link3">{$_SL['our_partners']}</div>
			<div id="departments_sub"></div>
			<div id="news_link2">&nbsp;
				{$_SL['architectures_union']}
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['architectures_union']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text" colspan="3">
			{$row_architectures_union[$_BLANG]}
		</td>
	</tr>
</table>
html;
?>