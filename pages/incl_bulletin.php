<?php
if($_GET['goto']=="bulletin" && !isset($_GET['mod'])){
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1"><a href="?goto=library">{$_SL['library']}</a></div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['nuaca_bulletin']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['nuaca_bulletin']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			<ul id="specialized_council_base">
				<li>
					<a href="?goto=bulletin&mod=bulletins">{$_SL['library_bullet']}</a>
				</li>
				<br/>
				<li>
					<a href="?goto=bulletin&mod=editional_borad">{$_SL['editional_borad']}</a>
				</li>
				<br/>
				<li>
					<a href="?goto=bulletin&mod=articles_requirements">{$_SL['articles_requirements']}</a>
				</li>
				<br/>
				<li>
					<a href="?goto=bulletin&mod=admission_order">{$_SL['admission_order']}</a>
				</li>
				<br/>
				<li>
					<a href="?goto=bulletin">{$_SL['archive']}</a>
				</li>
				<br/>
				<li>
					<a href="?goto=bulletin">{$_SL['library_bullet_about']}</a>
				</li>
				<br/>
			</ul>
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
	<tr><td height="20"></td></tr>
</table>
html;
}
elseif($_GET['goto']=="bulletin" && $_GET['mod']=="bulletins"){
$q_bulletin="SELECT * FROM {$CONF['dbtable']['bulletin']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_bulletin=mysql_query($q_bulletin,$CONN);

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1"><a href="?goto=library">{$_SL['library']}</a></div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto=bulletin">{$_SL['nuaca_bulletin']}</a> / {$_SL['library_bullet']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['library_bullet']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			<table  border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" id="library_selbg">
		
html;
				$j=1;
				while(($row_bulletin=mysql_fetch_assoc($r_bulletin))!=false){
					if ($j%2==1) {
						echo "<tr>";
					}
echo <<<html
							<td id="library_cat1">
								<a href="?goto=bulletin">
									<div id="library_poster">
										<a href="files/{$row_bulletin['type']}/{$row_bulletin['name']}">
											<img src="images/library/bulletin/thumbs/{$row_bulletin['thumbnails']}" width="72">
										</a>
									</div>
									<div id="library_bulletin_txt">
										ՏԵՂԵԿԱԳԻՐ ԹԻՎ {$row_bulletin['number']}, {$row_bulletin['year']}</br>
										Եր.: Ճարտարապետության և շինարարության հայաստանի ազգային համալսարան  {$row_bulletin['year']}թ,  {$row_bulletin['pages']}էջ:									
									</div>
								</a>
							</td>
							<td width="5"></td>
html;
					if ($j%2==0) {
						echo "</tr>";
						echo "<tr><td colspan='3' height='10'><td></tr>";
					}
					$j++;
				}
echo <<<html
			</table>
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
	<tr><td height="20"></td></tr>
</table>

html;

}
elseif($_GET['goto']=="bulletin" && $_GET['mod']=="editional_borad"){

$q_bulletin_edboard="SELECT {$_BLANG} FROM {$CONF['dbtable']['proceedings']} WHERE description='bulletin_edboard'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_bulletin_edboard=mysql_query($q_bulletin_edboard,$CONN);
$row_bulletin_edboard=mysql_fetch_assoc($r_bulletin_edboard);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1"><a href="?goto=library">{$_SL['library']}</a></div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto=bulletin">{$_SL['nuaca_bulletin']}</a> / {$_SL['editional_borad']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['editional_borad']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_bulletin_edboard[$_BLANG]}
		</td>
	</tr>
</table>
html;
}

elseif($_GET['goto']=="bulletin" && $_GET['mod']=="articles_requirements"){

$q_articles_requirements="SELECT {$_BLANG} FROM {$CONF['dbtable']['proceedings']} WHERE description='bulletin_articles_requirements'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_articles_requirements=mysql_query($q_articles_requirements,$CONN);
$row_articles_requirements=mysql_fetch_assoc($r_articles_requirements);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1"><a href="?goto=library">{$_SL['library']}</a></div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto=bulletin">{$_SL['nuaca_bulletin']}</a> / {$_SL['articles_requirements']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['articles_requirements']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_articles_requirements[$_BLANG]}
		</td>
	</tr>
</table>
html;
}


elseif($_GET['goto']=="bulletin" && $_GET['mod']=="admission_order"){

$q_admission_order="SELECT {$_BLANG} FROM {$CONF['dbtable']['proceedings']} WHERE description='admission_order'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_admission_order=mysql_query($q_admission_order,$CONN);
$row_admission_order=mysql_fetch_assoc($r_admission_order);


echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1"><a href="?goto=library">{$_SL['library']}</a></div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto=bulletin">{$_SL['nuaca_bulletin']}</a> / {$_SL['articles_requirements']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['admission_order']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_admission_order[$_BLANG]}
		</td>
	</tr>
</table>
html;
}
/*
elseif($_GET['goto']=="bulletin" && $_GET['mod']=="archive"){
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['library']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto=bulletin">{$_SL['proceedings_lib']}</a> / {$_SL['archive']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['archive']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
html;
			include_once("old_data/data/am/sm08_06_05.html");
echo<<<html
		</td>
	</tr>
</table>
html;
}elseif($_GET['goto']=="bulletin" && $_GET['mod']=="about_the_journal"){

$q_about_the_journal="SELECT {$_BLANG} FROM {$CONF['dbtable']['proceedings']} WHERE description='about_the_journal'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_about_the_journal=mysql_query($q_about_the_journal,$CONN);
$row_about_the_journal=mysql_fetch_assoc($r_about_the_journal);

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1">{$_SL['library']}</div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;<a href="?goto=bulletin">{$_SL['proceedings_lib']}</a> / {$_SL['about_the_journal']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['about_the_journal']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3" align="center" valign="top">
			{$row_about_the_journal[$_BLANG]}
		</td>
	</tr>
</table>
html;
}
*/
?>