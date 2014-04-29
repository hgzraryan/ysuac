<?php
if($_GET['id']){
	$q_news="SELECT * FROM {$CONF['dbtable'][$_GLANG]} WHERE id='{$_GET['id']}' AND status='1' ORDER BY id DESC";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_news=mysql_query($q_news,$CONN);
	$row_news=mysql_fetch_assoc($r_news);
	
	$q_morenews="SELECT * FROM {$CONF['dbtable'][$_GLANG]} WHERE id!='{$_GET['id']}' AND status='1' ORDER BY id DESC LIMIT 6";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_morenews=mysql_query($q_morenews,$CONN);
}else{
	$q_news="SELECT * FROM {$CONF['dbtable'][$_GLANG]}  WHERE status='1' ORDER BY id DESC";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_news=mysql_query($q_news,$CONN);
	$row_news=mysql_fetch_assoc($r_news);
	
	$q_morenews="SELECT * FROM {$CONF['dbtable'][$_GLANG]} WHERE id!='{$row_news['id']}' AND status='1' ORDER BY id DESC LIMIT 6";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_morenews=mysql_query($q_morenews,$CONN);
}
if($_GET['id'] && $_SESSION['arf']!=$row_news['id']){
	$q_news_view="UPDATE {$CONF['dbtable'][$_GLANG]} SET viewed=viewed+1 WHERE id='".addslashes($_GET['id'])."'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_news_view=mysql_query($q_news_view,$CONN);
	$_SESSION['arf']=$row_news['id'];
}

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td align="center" valign="center" colspan="3" height="29">
			<div id="news_news_link3"><a href="?goto=news_archive">{$_SL['news']}</a></div>
			<div id="departments_sub"></div>
			<div id="news_link2">&nbsp;
html;
			string_limiter($row_news['news_title'],"57");
echo <<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="15"></td></tr>
html;
		if($row_news){
echo<<<html
	<tr>
		<td colspan="3" height="15" id="news_news_title">
			{$row_news['news_title']} <br/>
			<div id="news_news_date">
html;
						datetime($row_news['news_date']);
echo <<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="15"></td></tr>
	<tr>
		<td valign="top" align="left" id="news_news_text" colspan="3">
			<a href="images/news/watermark/{$row_news['news_image']}" class="highslide" onclick="return hs.expand(this)">
				<img src="images/news/thumbs/{$row_news['news_image']}" border="0" id="news_thumbnails">
			</a>	
			{$row_news['news']}
		</td>
	</tr>	<tr><td colspan="3" height="30"></td></tr>
html;
if($row_news['add_images']){
echo<<<html
	<tr><td colspan="3" valign="center" id="news_news_gallery">{$_SL['news_photos']}</td></tr>
	<tr>
		<td colspan="3" height="140" id="site_news_photos" align="left" valign="center">
			<div id="motioncontainer">
				<div id="motiongallery" style="position:absolute;left:0;top:0;white-space: nowrap;">
					<nobr id="trueContainer">
html;
						$img_news=explode(":::", $row_news['add_images']);
						foreach ($img_news as $key => $value) {
							if($value!=null){
echo<<<html
								<a href="images/news/additional/watermark/{$value}" class="highslide" onclick="return hs.expand(this)">
									<img src="images/news/additional/thumbs/{$value}" border="1" width="138">
								</a>
html;
							}
						}
echo<<<html
					</nobr>
				</div>
			</div>
		</td>
	</tr>
html;
}
echo<<<html
	<tr>
		<td colspan="3" height="20"></td>
	</tr>
	<tr>
		<td colspan="3" height="25" id="news_viewed" valign="center" align="right">
		
		<div style="float:left;">	
			<div id="fb-root"></div>
			<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=315546335174365";
				fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));
					
			</script>

			
				
			
			<div class="fb-share-button" data-href="http://ysuac.am/?goto=news&id={$row_news['id']}" data-type="button_count"></div>
		</div>	
			{$_SL['news_viewed']} {$row_news['viewed']} {$_SL['news_viewed1']}</td></tr>	<tr><td colspan="3" id="home_more_news">{$_SL['more_news']}
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="top" style="padding-left:10px;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" class="home_news_addtable">
				<tr><td colspan="2" height="10"></td></tr>
html;
			$j=1;
			while(($row_morenews=mysql_fetch_assoc($r_morenews))!=false){
				if ($j%2==1) {
					echo "<tr>";
				}
echo<<<html
					<td id="home_news_addimage">
						<a href="?goto=news&id={$row_morenews['id']}">
							<img src="images/news/min_thumbs/{$row_morenews['news_image']}" border="0">
						</a>
					</td>
					<td id="home_news_addtitle" align="left">
						<a href="?goto=news&id={$row_morenews['id']}">
html;
							string_limiter($row_morenews['news_title'],"65");
							echo "</br>";
echo<<<html
						</a>
						<div id="home_news_adddatetime">
html;
						datetime($row_morenews['news_date']);
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
echo <<<html
					<tr><td colspan="8" id="home_all_news" align="right"><a href="?goto=news_archive">{$_SL['all_news']}</td></tr>
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