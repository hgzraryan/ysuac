<?php

$pg_title="title_".$_SESSION['lang'];
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_gcat="SELECT id, {$pg_title}, thumbnail FROM {$CONF['dbtable']['gallery_category']} ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_gcat=mysql_query($q_gcat,$CONN);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['photo_gallery']}</div>
		</td>
	</tr>
	<tr><td height="15"></td></tr>
	<tr>
		<td id="photo_gallery" valign="top" align="left">
			<table border="0" cellpadding="0" cellspacing="0" height="100%">
html;
				$j=1;
				while(($row_gcat=mysql_fetch_assoc($r_gcat))!=false){
					$q_pgcount="SELECT count(*) as count FROM {$CONF['dbtable']['wallpapers']} WHERE cat='{$row_gcat['id']}' AND block='1'";
					$r_pgcount=mysql_query($q_pgcount,$CONN);
					$row_pgcount=mysql_fetch_assoc($r_pgcount);
					if ($j%3==1) {
						echo "<tr>";
					}
echo <<<html
							<td width="10"></td>
							<td width="202" valign="top" id="photo_gallery_part" title="{$row_gcat[$pg_title]}" >
								<div id="photo_gallery_count">{$row_pgcount['count']}</div>
								<a href="?goto=gallery_view&gid={$row_gcat['id']}">
									<div id="photo_gallery_polar">
											<img src="images/gallery_category/{$row_gcat['thumbnail']}" width="190" height="190" border="0" >
											
									</div>
									<div id="photo_gallery_title">
html;
											string_limiter($row_gcat[$pg_title], "50");
echo<<<html
									</div>
								</a>
							</td>
							<td></td>
html;
					if ($j%3==0) {
						echo "</tr>";
						echo "<tr><td height='10' colspan='9'></td></tr>";
					}
					$j++;
				}
echo<<<html
			</table>
		</td>
	</tr>
	<tr><td height="10"></td></tr>
	<tr>
		<td height="24" id="pageing_constr" align="left">
html;
#----------------------------------------------------------------------------------
	if($i_pageing>=2){
		if($_SESSION['page']!=1){
			$next_page=$_SESSION['page']-1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&page={$next_page}"><div id="pageing_preview"></div></a>
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
					<a href="?goto={$_SESSION['goto']}&page={$page}"><div id="pageing_numbers">{$page}</div></a>
html;
				}
			}			
		}
#----------------------------------------------------------------------------------
#------------------------------ next ----------------------------------------------------
		if($_SESSION['page']<=$_SESSION['view_pages']-1){
			$next_page=$_SESSION['page']+1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&page={$next_page}"><div id="pageing_next"></div></a>
html;
		}else{
echo <<<html
			<div id="pageing_next_active"></div>
html;
		}
#----------------------------------------------------------------------------------
	}
echo <<<html
			</td>
		</tr>	
		<tr><td height="100%"></td></tr>
</table>
html;
?>