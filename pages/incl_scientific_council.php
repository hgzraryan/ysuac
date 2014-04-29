<?php
if($_GET['goto']=="scientific_council" && $_GET['mod']=="academic_council"){
$q_siteour_university3="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_university']} WHERE description='academic_council'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteour_university3=mysql_query($q_siteour_university3,$CONN);
$row_siteour_university3=mysql_fetch_assoc($r_siteour_university3);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['scientific_council']}">{$_SL['scientific_council']}</a> / {$_SL['academic_council']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['academic_council']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_siteour_university3[$_BLANG]}			
		</td>
	</tr>
</table>
html;
}elseif ($_GET['goto']=="scientific_council" && $_GET['mod']=="decisions_council") {
$q_siteour_university4="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_our_university']} WHERE description='decisions_council'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteour_university4=mysql_query($q_siteour_university4,$CONN);
$row_siteour_university4=mysql_fetch_assoc($r_siteour_university4);

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['our_university']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['scientific_council']}">{$_SL['scientific_council']}</a> / {$_SL['decisions_council']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['decisions_council']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_siteour_university4[$_BLANG]}			
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
			<div id="departments_link2">&nbsp;{$_SL['scientific_council']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['scientific_council']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" id="management_board_box">
				<tr>
					<td height="330" align="center" valign="center" colspan="2" id="management_board_zero">
						<img src="images/management_board/scientific_council.jpg">
					</td>
				</tr>
				<tr><td height="15" colspan="2" id="management_board_zero"></td></tr>
				<tr><td colspan="2" id="management_board_zero"></td></tr>
				<tr>
					<td width="227" align="left" id="management_board_button_un"><a href="?goto=scientific_council&mod={$_SLD['academic_council']}"><div class="management_board_button">{$_SL['academic_council']}</div></a></td>
					<td width="227" align="right" id="management_board_button_un"><a href="?goto=scientific_council&mod={$_SLD['decisions_council']}"><div class="management_board_button">{$_SL['decisions_council']}</div></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
html;
}
?>