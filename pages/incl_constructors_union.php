<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}

$q_constructors_union="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_partners']} WHERE description='constructors_union'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_constructors_union=mysql_query($q_constructors_union,$CONN);
$row_constructors_union=mysql_fetch_assoc($r_constructors_union);

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td align="center" valign="center" colspan="3" height="29">
			<div id="constructors_union_link3">{$_SL['our_partners']}</div>
			<div id="departments_sub"></div>
			<div id="news_link2">&nbsp;
				{$_SL['constructors_union']}
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['constructors_union']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr>
					<td height="109" valign="center" align="left">
						<img src="images/pages/architectures_union.jpg" border="0">
					</td>
				</tr>
				<tr><td height="20"><td></tr>
				<tr>
					<td valign="top" id="bologna_text">
						{$row_constructors_union[$_BLANG]}
					</td>
				</tr>
				<tr><td><td></tr>
			</table>
		</td>
	</tr>
</table>
html;
?>