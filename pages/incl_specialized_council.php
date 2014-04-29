<?php
if(!$_GET['mod']){
echo <<<html
<form method="post">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="800">
		<tr>
			<td height="20" valign="center" width="100">
				<div id="our_data_fhl"></div>
			</td>
			<td width="20"></td>
			<td id="our_data_title" valign="center" height="20">
				{$_SL['specialized_council']}
			</td>
		</tr>
		<tr><td colspan="3" height="15"></td></tr>
		<tr>
			<td colspan="3" valign="top">
				<ul id="specialized_council_base">
						<li>
							<a href="?goto=specialized_council&mod={$_SLD['specialized_council']}">{$_SL['specialized_council']}</a>
						</li>
							<ul>
								<li id="subspecialized_council_base"><a href="?goto=specialized_council&mod={$_SLD['composition_of_board']}">{$_SL['composition_of_board']}</a></li>
								<li id="subspecialized_council_base"><a href="?goto=specialized_council&mod={$_SLD['theses_defenses']}">{$_SL['theses_defenses']}</a></li>
								<li id="subspecialized_council_base"><a href="?goto=specialized_council&mod={$_SLD['authors_abstract_delivery_list']}">{$_SL['authors_abstract_delivery_list']}</a></li>
							</ul>
						<li>
							<a href="http://www.ysuac.am/new/download.php?file=16">{$_SL['requirements_for_formation_of_theses']}</a>
						</li>
						<br/>
						<li>
							<a href="http://www.ysuac.am/new/download.php?file=17">{$_SL['requirements_for_formation_of_authors_abstracts']}</a>
						</li>
						<br/>
						<li>
							<a href="?goto=specialized_council&mod={$_SLD['029_professional_board']}">{$_SL['029_professional_board']}</a>
						</li>
						<br/>
						<li>
							<a href="?goto=specialized_council&mod={$_SLD['030_last_professional_board']}">{$_SL['030_last_professional_board']}</a>
						</li>
						<br/>
						<li>
							<a href="?goto=specialized_council&mod={$_SLD['list_of_theses']}">{$_SL['list_of_theses']}</a>
						</li>						
						<br/>
						<li>
							<a href="?goto=specialized_council&mod={$_SLD['specialized_board_archive_ysuac']}">{$_SL['specialized_board_archive_ysuac']}</a>
						</li>
				</ul>
			</td>
		</tr>
	</table>
</form>
html;
}elseif($_GET['goto']=="specialized_council" && $_GET['mod']){
	$q_specialized_council="SELECT {$_BLANG} FROM {$CONF['dbtable']['specialized_council']} WHERE description='{$_GET['mod']}'";
	#echo $q_specialized_council;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_specialized_council=mysql_query($q_specialized_council,$CONN);
	$row_specialized_council=mysql_fetch_assoc($r_specialized_council);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td colspan="3" height="29" align="center" valign="center">
				<div id="departments_link1">
					<a href="?goto=specialized_council">{$_SL['specialized_council']}</a>
				</div>
				<div id="departments_sub"></div>
				<div id="departments_link2">&nbsp;
html;
					string_limiter($_SL[$_GET['mod']],"43");
echo <<<html
				</div>
			</td>
		</tr>
		<tr><td colspan="3" height="20"></td></tr>
		<tr>
			<td height="20">
				<div  id="departments_title">{$_SL[$_GET['mod']]}</div>
			</td>
		</tr>
		<tr><td height="10"></td></tr>
		<tr>
			<td valign="top" id="news_news_text">
				{$row_specialized_council[$_BLANG]}
			</td>
		</tr>
	</table>
html;
}
?>