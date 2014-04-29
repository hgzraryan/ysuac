<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}
$fac="fac_".$_SESSION['lang'];
$depdb="departments_".$_SESSION['lang'];
$q_dep="SELECT * FROM {$CONF['dbtable']['units']} WHERE status='1' AND id='{$_SESSION['did']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_dep=mysql_query($q_dep,$CONN);
$row_dep=mysql_fetch_assoc($r_dep);

if($row_dep){
$q_dep2="SELECT * FROM {$CONF['dbtable'][$depdb]} WHERE department_description='{$_SESSION['did']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_dep2=mysql_query($q_dep2,$CONN);
$row_dep2=mysql_fetch_assoc($r_dep2);

#pre ($row_dep2);
#pre($row_dep);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center" id="design_fac_hyperlink">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="design_fac_sub_{$row_dep['color']}"></div>
			<div id="design_fac_link2_{$row_dep['color']}">&nbsp;<a href="?goto={$_SLD['departments']}">{$_SL['departments']}</a> / 
html;
			string_limiter($row_dep[$fac],"40");
echo<<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="fac_title">{$row_dep[$fac]}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" valign="top">
			<ul id="tabs">
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_dep['color']};"><a href="#" title="tab1">{$_SL['history']}</a></li>
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_dep['color']};"><a href="#" title="tab2">{$_SL['specialist_sections']}</a></li>
				<li style="margin-right: 4px;padding: 0;float: left;background-color:#{$row_dep['color']};"><a href="#" title="tab3">{$_SL['team']}</a></li>
				<li style="margin: 0;padding: 0;float: left;background-color:#{$row_dep['color']};"><a href="#" title="tab4">{$_SL['council']}</a></li>    
			</ul>
			<div id="content"> 
				<div id="tab1">
				   {$row_dep2['department_history']}
				</div>
				<div id="tab2">  
					{$row_dep2['department_spec']}
				</div>
				<div id="tab3">
					 {$row_dep2['department_team']}
				</div>
				<div id="tab4">
					 {$row_dep2['department_council']}
				</div>
			</div>
		</td>
	</tr>
</table>
html;
}else{
echo <<<html
	<script language="javascript">window.location.href="?goto=departments"</script>
html;
}
?>