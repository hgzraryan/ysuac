<?php
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_home_news="SELECT * FROM {$CONF['dbtable'][$_GLANG]} WHERE status='1' ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_home_news=mysql_query($q_home_news,$CONN);

$q_home_announcements="SELECT * FROM {$CONF['dbtable'][$_АLANG]} WHERE status='1' ORDER BY id DESC LIMIT 4";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_home_announcements=mysql_query($q_home_announcements,$CONN);

$q_home_slideshow="SELECT * FROM {$CONF['dbtable']['slideshow']} WHERE status='1' ORDER BY id";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_home_slideshow=mysql_query($q_home_slideshow,$CONN);


echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td height="400" valign="top">
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">
html;
					while(($row_home_slideshow=mysql_fetch_assoc($r_home_slideshow))!=false){
echo <<<html
						<img src="images/slider/{$row_home_slideshow['path']}" data-thumb="images/slider/1.jpg" alt="" data-transition="fade"/>
html;
					}
echo <<<html
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td height="20" id="home_announcements_title" align="left" valign="bottom">
			{$_SL['announcements_uppercase']}
		</td>
	</tr>
	<tr><td height="4" ></td></tr>
	<tr>
		<td height="89" id="home_announcements_addtable">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
				<tr><td height="8" ></td></tr>
				<tr>
					<td align="left">
						<div id="info" class="block">
							<ul id="ticker">
html;
								while(($row_home_announcements=mysql_fetch_assoc($r_home_announcements))!=false){
echo <<<html
								<li>						
									<span>
										<a href="?goto=announcements&id={$row_home_announcements['id']}">
html;
									string_limiter($row_home_announcements['title'],"100");
echo <<<html
										</a>
									</span>
									<a href="?goto=announcements&id={$row_home_announcements['id']}">
html;
									string_limiter($row_home_announcements['text'],"190");
echo <<<html
									</a>
								</li>
html;
								}
echo<<<html
							</ul>
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="8"></td></tr>
	<tr>
		<td height="20" id="home_announcements_title" align="left" valign="bottom">
			{$_SL['news_uppercase']}
		</td>
	</tr>
	<tr><td height="4" ></td></tr>
	<tr>
		<td valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
html;
			while(($row_home_news=mysql_fetch_assoc($r_home_news))!=false){
echo <<<html
				<tr>
					<td width="180" height="180" valign="center" align="center" id="home_news_bg" rowspan="3">
						<a href="?goto=news&id={$row_home_news['id']}"><img width="160" src="images/news/thumbs/{$row_home_news['news_image']}" border="0"></a>
					</td>
					<td id="home_news_title" height="50" valign="center">
html;
						string_limiter($row_home_news['news_title'],"100");
echo <<<html
					</td>
					<td width="10" id="home_news_bg"></td>
				</tr>
				<tr>
					<td class="home_news_text" valign="top">
html;
						string_limiter($row_home_news['news'],"243");
echo <<<html
					</td>
					<td id="home_news_bg"></td>
				</tr>
				<tr>
					<td align="right" valign="bottom" id="home_news_bg" height="21">
						<table border="0" cellpadding="0" cellspacing="0" width="100%" height="21">
							<tr>
								<td id="site_news_date" valign="center" align="left">
html;
						datetime($row_home_news['news_date']);
echo <<<html
								</td>
								<td align="right" valign="bottom" width="85">
									<a href="?goto=news&id={$row_home_news['id']}"><div class="home_news_more">{$_SL['more']}</div></a>
								</td>
							</tr>
						</table>
					</td>
					<td id="home_news_bg"></td>
				</tr>
				<tr>
					<td height="15" colspan="3"></td>
				</tr>
html;
			}
echo <<<html
				<tr>
					<td colspan="3" height="10">
					</td>
				</tr>
				<tr>
					<td height="24" id="pageing_constr" colspan="3" valign="center">
html;
#----------------------------------------------------------------------------------
	if($i_pageing>=2){
		if($_SESSION['page']!=1){
			$next_page=$_SESSION['page']-1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&page={$next_page}#pageing_constr"><div id="pageing_preview"></div></a>
html;
		}else{
echo <<<html
			<div id="pageing_preview_active"></div>
html;
		}

#----------------------------------------------------------------------------------
#-------------------------------- pageing --------------------------------------------------
		for($page=1; $page<=$i_pageing; $page++){
			if($page<=$_SESSION['view_pages']){
				if ($_SESSION['page']==$page){
echo <<<html
					<div id="pageing_numbers_active">{$page}</div>
html;
				}else {
echo <<<html
					<a href="?goto={$_SESSION['goto']}&page={$page}#pageing_constr"><div id="pageing_numbers">{$page}</div></a>
html;
				}
			}			
		}
#----------------------------------------------------------------------------------
#------------------------------ next ----------------------------------------------------
		if($_SESSION['page']<=$_SESSION['view_pages']-1){
			$next_page=$_SESSION['page']+1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&page={$next_page}#pageing_constr"><div id="pageing_next"></div></a>
html;
		}else{
echo <<<html
			<div id="pageing_next_active"></div>
html;
		}
	}
#----------------------------------------------------------------------------------


echo <<<html
					<div id="home_all_news" align="right"><a href="?goto=news_archive">{$_SL['all_news']}</div>
					</td>
				</tr>	
				<tr><td colspan="3" height="100%"></td></tr>
			</table>
		</td>
	</tr>
</table>
html;
?>