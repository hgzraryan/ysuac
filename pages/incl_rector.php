<?php
if($_GET['goto']=="rector" && $_GET['mod']=="rectors_staff"){
$q_siteour_university5="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_university']} WHERE description='rectors_staff'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteour_university5=mysql_query($q_siteour_university5,$CONN);
$row_siteour_university5=mysql_fetch_assoc($r_siteour_university5);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['rector']}">{$_SL['rector']}</a> / {$_SL['rectors_staff']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['rectors_staff']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_siteour_university5[$_BLANG]}
		</td>
	</tr>
</table>
html;
}elseif ($_GET['goto']=="rector" && $_GET['mod']=="board_decisions") {
$q_siteour_university6="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_university']} WHERE description='board_decisions'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteour_university6=mysql_query($q_siteour_university6,$CONN);
$row_siteour_university6=mysql_fetch_assoc($r_siteour_university6);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['rector']}">{$_SL['rector']}</a> / {$_SL['board_decisions']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['board_decisions']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_siteour_university6[$_BLANG]}
		</td>
	</tr>
</table>
html;
}else{
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['rector']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['rector']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" id="management_board_box">
				<tr>
					<td height="330" align="center" valign="center" colspan="2" id="management_board_zero">
						<img src="images/management_board/rector_staff.jpg">
					</td>
				</tr>
				<tr><td height="15" colspan="2" id="management_board_zero"></td></tr>
				<tr><td colspan="2" id="management_board_zero"></td></tr>
				<tr>
					<td width="227" align="left" id="management_board_button_un"><a href="?goto=rector&mod={$_SLD['rectors_staff']}"><div class="management_board_button">{$_SL['rectors_staff']}</div></a></td>
					<td width="227" align="right" id="management_board_button_un"><a href="?goto=rector&mod={$_SLD['board_decisions']}"><div class="management_board_button">{$_SL['board_decisions']}</div></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
html;
}
?>