<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}
$q_sitefac="SELECT * FROM {$CONF['dbtable']['units']} WHERE status='1' AND t_id='1' ORDER BY id DESC";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitefac=mysql_query($q_sitefac,$CONN);
$fac_lan="fac_".$_SESSION['lang'];
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['faculties']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['faculties']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top">
			<ul id="faculties_base">
html;
				while( ( $row_sitefac=mysql_fetch_assoc($r_sitefac))!=false){
echo  <<<html
					<li><a href="?goto=f_module1&fid={$row_sitefac[id]}">{$row_sitefac[$fac_lan]}</a></li>
html;
				}
echo <<<html
			</ul>
		</td>
	</tr>
</table>
html;
?>