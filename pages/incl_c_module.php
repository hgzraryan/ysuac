<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}
$fac="fac_".$_SESSION['lang'];
$chdb="chairs_".$_SESSION['lang'];
$q_ch="SELECT * FROM {$CONF['dbtable']['units']} WHERE status='1' AND id='{$_SESSION['cid']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_ch=mysql_query($q_ch,$CONN);
$row_ch=mysql_fetch_assoc($r_ch);

#pre($row_ch);
$q_ch2="SELECT * FROM {$CONF['dbtable'][$chdb]} WHERE chairs_description='{$_SESSION['cid']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_ch2=mysql_query($q_ch2,$CONN);
$row_ch2=mysql_fetch_assoc($r_ch2);

#pre ($row_dep2);
#pre($row_dep);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center" id="design_fac_hyperlink">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="design_fac_sub_{$row_ch['color']}"></div>
			<div id="design_fac_link2_{$row_ch['color']}">&nbsp;<a href="?goto={$_SLD['chairs']}">{$_SL['chairs']}</a> / 
html;
			string_limiter($row_ch[$fac],"40");
echo<<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="fac_title">{$row_ch[$fac]}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" valign="top">
			<ul id="tabs">
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_ch['color']};"><a href="#" title="tab1">{$_SL['history']}</a></li>
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_ch['color']};"><a href="#" title="tab2">{$_SL['team']}</a></li>
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_ch['color']};"><a href="#" title="tab3">{$_SL['modc_educational_process']}</a></li>
				<li style="margin: 0;padding: 0;float: left;background-color:#{$row_ch['color']};"><a href="#" title="tab4">{$_SL['modc2_educational_process']}</a></li>    
			</ul>
			<div id="content"> 
				<div id="tab1">
				   {$row_ch2['chairs_history']}
				</div>
				<div id="tab2">  
					{$row_ch2['chairs_team']}
				</div>
				<div id="tab3">
					 {$row_ch2['chairs_scientific_process']}
				</div>
				<div id="tab4">
					 {$row_ch2['chairs_educational_process']}
				</div>
			</div>
		</td>
	</tr>
</table>
html;
?>