<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}
$fac="fac_".$_SESSION['lang'];
$facdb="faculties_".$_SESSION['lang'];
$q_fac="SELECT * FROM {$CONF['dbtable']['units']} WHERE status='1' AND id='{$_SESSION['fid']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_fac=mysql_query($q_fac,$CONN);
$row_fac=mysql_fetch_assoc($r_fac);
if($row_fac){

$q_fac2="SELECT * FROM {$CONF['dbtable'][$facdb]} WHERE faculties_description='{$_SESSION['fid']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_fac2=mysql_query($q_fac2,$CONN);
$row_fac2=mysql_fetch_assoc($r_fac2);

#pre ($row_dep2);
#pre($row_dep);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center" id="design_fac_hyperlink">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="design_fac_sub_{$row_fac['color']}"></div>
			<div id="design_fac_link2_{$row_fac['color']}">&nbsp;<a href="?goto={$_SLD['faculties']}">{$_SL['faculties']}</a> / 
html;
			string_limiter($row_fac[$fac],"40");
echo<<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="fac_title">{$row_fac[$fac]}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" valign="top">
			<ul id="tabs">
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_fac['color']};"><a href="#" title="tab1">{$_SL['history']}</a></li>
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_fac['color']};"><a href="#" title="tab2">{$_SL['specialist_sections']}</a></li>
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_fac['color']};"><a href="#" title="tab3">{$_SL['team']}</a></li>
				<li style="margin: 0;padding: 0;float: left;background-color:#{$row_fac['color']};"><a href="#" title="tab4">{$_SL['council']}</a></li>    
			</ul>
			<div id="content"> 
				<div id="tab1">
				   {$row_fac2['faculties_history']}
				</div>
				<div id="tab2">  
					{$row_fac2['faculties_spec']}
				</div>
				<div id="tab3">
					 {$row_fac2['faculties_team']}
				</div>
				<div id="tab4">
					 {$row_fac2['faculties_council']}
				</div>
			</div>
		</td>
	</tr>
</table>
html;
}else{
echo <<<html
	<script language="javascript">window.location.href="?goto=faculties"</script>
html;
}
?>