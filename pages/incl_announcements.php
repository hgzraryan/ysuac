<?php
if($_GET['id']){
	$q_announcements="SELECT * FROM {$CONF['dbtable'][$_АLANG]} WHERE id='{$_GET['id']}' AND status='1' ORDER BY id DESC";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_announcements=mysql_query($q_announcements,$CONN);
	$row_announcements=mysql_fetch_assoc($r_announcements);
	
	$q_moreannouncements="SELECT * FROM {$CONF['dbtable'][$_АLANG]} WHERE id!='{$_GET['id']}' AND status='1' ORDER BY id DESC LIMIT 6";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_moreannouncements=mysql_query($q_moreannouncements,$CONN);

}else{
	$q_announcements="SELECT * FROM {$CONF['dbtable'][$_АLANG]}  WHERE status='1' ORDER BY id DESC";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_announcements=mysql_query($q_announcements,$CONN);
	$row_announcements=mysql_fetch_assoc($r_announcements);
	
	$q_moreannouncements="SELECT * FROM {$CONF['dbtable'][$_АLANG]} WHERE id!='{$row_announcements['id']}' AND status='1' ORDER BY id DESC LIMIT 6";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_moreannouncements=mysql_query($q_moreannouncements,$CONN);
}
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td align="center" valign="center" colspan="3" height="29">
			<div id="announcements_announcements_link3"><a href="?goto=announcements_archive">{$_SL['announcements']}</a></div>
			<div id="departments_sub"></div>
			<div id="news_link2">&nbsp;
html;
			string_limiter($row_announcements['title'],"50");
echo <<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="15"></td></tr>
html;
		if($row_announcements){
echo<<<html
	<tr>
		<td colspan="3" height="15" id="news_news_title">
			{$row_announcements['title']} <br/>
			<div id="news_news_date">
html;
						datetime($row_announcements['upload_date']);
echo <<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="15"></td></tr>
	<tr>
		<td valign="top" align="left" id="news_news_text" colspan="3">
			{$row_announcements['text']}
		</td>
	</tr>
	<tr><td colspan="3" height="10"></td></tr>
	<tr><td colspan="3" id="home_more_news">{$_SL['more_announcements']}</td></tr>
	<tr>
		<td colspan="3" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" class="home_news_addtable">
				<tr><td colspan="6" height="10"></td></tr>
html;
					$j=1;
					while(($row_moreannouncements=mysql_fetch_assoc($r_moreannouncements))!=false){
						if ($j%2==1) {
							echo "<tr>";
						}
echo<<<html
						<td id="home_announcements_addtitle" align="left">
							<a href="?goto=announcements&id={$row_moreannouncements['id']}">
html;
							string_limiter($row_moreannouncements['title'],"65");
							echo "</br>";
echo<<<html
							</a>
							<div id="home_news_adddatetime">
html;
							datetime($row_moreannouncements['upload_date']);
echo <<<html
						</td>
						<td width="5"></td>
						<td></td>
html;
						if ($j%2==0) {
							echo "</tr>";
							echo "<tr><td height='5' colspan='8'></td></tr>";
						}
						$j++;
					}
echo<<< html
				<tr><td colspan="6" id="home_all_news" align="right"><a href="?goto=announcements_archive">{$_SL['all_announcements']}</td></tr>
			</table>
		</td>
	</tr>
html;
}
echo<<<html
	<tr><td colspan="3" height="10"></td></tr>
	<tr>
		<td colspan="3" height="100%"></td>
	</tr>
</table>
html;
?>