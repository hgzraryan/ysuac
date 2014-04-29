<?php
if($_GET['goto']=="alumni" && $_GET['mod']=="main_search"){
$q_main_search="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_alumni']} WHERE description='main_search'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_main_search=mysql_query($q_main_search,$CONN);
$row_main_search=mysql_fetch_assoc($r_main_search);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a> / {$_SL['main_search']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['main_search']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top" id="bologna_text">
				{$row_main_search[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}elseif ($_GET['goto']=="alumni" && $_GET['mod']=="charter") {
$q_alumni_charter="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_charter'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_alumni_charter=mysql_query($q_alumni_charter,$CONN);
$row_alumni_charter=mysql_fetch_assoc($r_alumni_charter);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a> / {$_SL['charter']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['charter']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top" id="bologna_text">
				{$row_alumni_charter[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}elseif ($_GET['goto']=="alumni" && $_GET['mod']=="alumni_famous") {
$q_alumni_famous="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_famous'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_alumni_famous=mysql_query($q_alumni_famous,$CONN);
$row_alumni_famous=mysql_fetch_assoc($r_alumni_famous);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a> / {$_SL['alumni_famous']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['alumni_famous']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top" id="bologna_text">
				{$row_alumni_famous[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}elseif ($_GET['goto']=="alumni" && $_GET['mod']=="alumni_functions") {
$q_alumni_functions="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_functions'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_alumni_functions=mysql_query($q_alumni_functions,$CONN);
$row_alumni_functions=mysql_fetch_assoc($r_alumni_functions);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a> / {$_SL['alumni_functions']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['alumni_functions']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top" id="bologna_text">
				{$row_alumni_functions[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}if($_GET['goto']=="alumni" && $_GET['mod']=="alumni_registration"){
$q_alumni_registration="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_registration'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_alumni_registration=mysql_query($q_alumni_registration,$CONN);
$row_alumni_registration=mysql_fetch_assoc($r_alumni_registration);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a> / {$_SL['alumni_registration']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['alumni_registration']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top" id="bologna_text">
				{$row_alumni_registration[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}if($_GET['goto']=="alumni" && $_GET['mod']=="events"){
$q_alumni_events="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_events'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_alumni_events=mysql_query($q_alumni_events,$CONN);
$row_alumni_events=mysql_fetch_assoc($r_alumni_events);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">{$_SL['our_university']}</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;<a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a> / {$_SL['events']}</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20" colspan="3">
				<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['events']}</div>
			</td>
		</tr>
		<tr>
			<td colspan="3" align="center" valign="top" id="bologna_text">
				{$row_alumni_events[$_BLANG]}
			</td>
		</tr>
		<tr><td height="10"></td></tr>
	</table>
html;
}elseif($_GET['goto']=="alumni" && $_GET['mod']==""){
$q_alumni="SELECT {$_BLANG} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_home'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_alumni=mysql_query($q_alumni,$CONN);
$row_alumni=mysql_fetch_assoc($r_alumni);

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div  id="departments_title">{$_SL['alumni']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td align="left" valign="top" width="200">
			<ul id="alumni_base">
					<li><a href="?goto=alumni&mod={$_SLD['main_search']}">{$_SL['main_search']}</a></li>
					<li><a href="?goto=alumni&mod={$_SLD['alumni_registration']}">{$_SL['alumni_registration']}</a></li>
			</ul>
		</td>
		<td align="left" valign="top"  width="200">
			<ul id="alumni_base">
					<li><a href="?goto=alumni&mod={$_SLD['charter']}">{$_SL['charter']}</a></li>
					<li><a href="?goto=alumni&mod={$_SLD['events']}">{$_SL['events']}</a></li>
			</ul>
		</td>
		<td align="left" valign="top">
			<ul id="alumni_base">
				<li><a href="?goto=alumni&mod={$_SLD['alumni_functions']}">{$_SL['alumni_functions']}</a></li>
				<li><a href="?goto=alumni&mod={$_SLD['alumni_famous']}">{$_SL['alumni_famous']}</a></li>			
			</ul>
		</td>
	</tr>
	<tr><td colspan="3" height="10"></td></tr>
	<tr>
		<td colspan="3" valign="top" id="bologna_text">
			{$row_alumni[$_BLANG]}
		</td>
	</tr>
	<tr><td colspan="3" height="100%"></td></tr>
</table>
html;
}
?>






