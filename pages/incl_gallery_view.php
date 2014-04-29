<?php
$g_title="name_".$_SESSION['lang'];
$g_title2="title_".$_SESSION['lang'];
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_gpic="SELECT id, {$g_title}, path FROM {$CONF['dbtable']['wallpapers']} WHERE cat='{$_SESSION['gid']}' ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_gpic=mysql_query($q_gpic,$CONN);


$q_gtitle="SELECT {$g_title2} FROM {$CONF['dbtable']['gallery_category']} WHERE id='{$_SESSION['gid']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_gtitle=mysql_query($q_gtitle,$CONN);
$row_gtitle=mysql_fetch_assoc($r_gtitle);

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td align="center" valign="center" colspan="3" height="29">
			<div id="news_news_link3"><a href="?goto=photo_gallery">{$_SL['photo_gallery']}</a></div>
			<div id="departments_sub"></div>
			<div id="news_link2">&nbsp;
html;
				string_limiter($row_gtitle[$g_title2], "60");
echo<<<html
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="15"></td></tr>
	<tr><td colspan="3" height="15" id="our_data_title" valign="top" align="center">{$row_gtitle[$g_title2]}</td></tr>
	<tr><td colspan="3" height="15"></td></tr>
	<tr>
		<td colspan="3" id="photo_gallery" valign="top" align="left">
			<table border="0" cellpadding="0" cellspacing="0" height="100%">
html;
				$j=1;
				while(($row_gpic=mysql_fetch_assoc($r_gpic))!=false){
					if ($j%4==1) {
						echo "<tr>";
					}
echo <<<html
							<td width="10"></td>
							<td>
								<a href="images/photos/watermark/{$row_gpic['path']}" class="highslide" onclick="return hs.expand(this)"><img src="images/photos/thumbnails/{$row_gpic['path']}"width="150"></a>
							</td>
							<td></td>
html;
					if ($j%4==0) {
						echo "</tr>";
						echo "<tr><td height='10' colspan='9'></td></tr>";
					}
					$j++;
				}
echo<<<html
			</table>
		</td>
	</tr>
	<tr><td height="10" colspan="3"></td></tr>
	<tr>
		<td height="24" id="pageing_constr" colspan="3" align="left">
html;
#----------------------------------------------------------------------------------
	if($i_pageing>=2){
		if($_SESSION['page']!=1){
			$next_page=$_SESSION['page']-1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&gid={$_SESSION['gid']}&page={$next_page}"><div id="pageing_preview"></div></a>
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
					<a href="?goto={$_SESSION['goto']}&gid={$_GET['gid']}&page={$page}"><div id="pageing_numbers">{$page}</div></a>
html;
				}
			}			
		}
#----------------------------------------------------------------------------------
#------------------------------ next ----------------------------------------------------
		if($_SESSION['page']<=$_SESSION['view_pages']-1){
			$next_page=$_SESSION['page']+1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&gid={$_GET['gid']}&page={$next_page}"><div id="pageing_next"></div></a>
html;
		}else{
echo <<<html
			<div id="pageing_next_active"></div>
html;
		}
	}
#----------------------------------------------------------------------------------
echo <<<html
			</td>
		</tr>	
		<tr><td height="10" colspan="3"></td></tr>
		<tr><td height="100%" colspan="3"></td></tr>
</table>
html;
?>