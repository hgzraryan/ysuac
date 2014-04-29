<?php
$q_sitech="SELECT * FROM {$CONF['dbtable']['units']} WHERE status='1' AND t_id='3' ORDER BY sort_id";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitech=mysql_query($q_sitech,$CONN);
$chairs_lan="fac_".$_SESSION['lang'];
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['chairs']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['chairs']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" valign="top">
			<ul id="faculties_base">
html;
				while( ( $row_sitech=mysql_fetch_assoc($r_sitech))!=false){
echo  <<<html
					<li><a href="?goto=c_module&cid={$row_sitech['id']}">{$row_sitech[$chairs_lan]}</a></li>
html;
				}
echo <<<html
			</ul>
		</td>
	</tr>
</table>
html;
?>