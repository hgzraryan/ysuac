<?php
/*
$q_sitebologna="SELECT {$_BLANG} FROM {$CONF['dbtable']['bologna']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitebologna=mysql_query($q_sitebologna,$CONN);
$row_sitebologna=mysql_fetch_assoc($r_sitebologna);
*/
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['assessment_process']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="assesment_text">
			<a href="http://www.ysuac.am/new/download.php?file=63	">26.03.2013 - 13:00</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=62">21.03.2013 - 15:00</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=61">04.03.2013 - 14:00</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=60	">04.03.2013 - 10:00</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=59">28.02.2013 - 15:30</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=58">28.02.2013 - 14:00</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=57">27.02.2013 - 14:00</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=56">27.02.2013 - 12:00</a><br/>
			<a href="http://www.ysuac.am/new/download.php?file=55">26.02.2013 - 14:0</a>0
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
</table>
html;
?>