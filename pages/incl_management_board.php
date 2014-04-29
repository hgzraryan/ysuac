<?php
if($_GET['goto']=="management_board" && $_GET['mod']=="board_staff"){
$q_siteour_university="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_university']} WHERE description='board_staff'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteour_university=mysql_query($q_siteour_university,$CONN);
$row_siteour_university=mysql_fetch_assoc($r_siteour_university);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['management_board']}">{$_SL['management_board']}</a> / {$_SL['board_staff']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['board_staff']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top">
				{$row_siteour_university[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}elseif ($_GET['goto']=="management_board" && $_GET['mod']=="board_sessions") {
$q_siteour_university2="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_university']} WHERE description='board_sessions'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteour_university2=mysql_query($q_siteour_university2,$CONN);
$row_siteour_university2=mysql_fetch_assoc($r_siteour_university2);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['management_board']}">{$_SL['management_board']}</a> / {$_SL['board_sessions']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['board_sessions']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top">
				{$row_siteour_university2[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}else{
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['management_board']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['management_board']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" id="management_board_box">
				<tr>
					<td height="330" align="center" valign="center" colspan="2" id="management_board_zero">
						<img src="images/management_board/management_board_main.jpg">
					</td>
				</tr>
				<tr><td height="15" colspan="2" id="management_board_zero"></td></tr>
				<tr><td colspan="2" id="management_board_zero"></td></tr>
				<tr>
					<td width="227" align="left" id="management_board_button_un">
						<a href="?goto={$_SLD['management_board']}&mod={$_SLD['board_staff']}"><div class="management_board_button">{$_SL['board_staff']}</div></a>
					</td>
					<td width="227" align="right" id="management_board_button_un">
						<a href="?goto={$_SLD['management_board']}&mod={$_SLD['board_sessions']}"><div class="management_board_button">{$_SL['board_sessions']}</div></a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
html;
}
?>