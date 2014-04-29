<?php
#pre($_POST);
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_vnews="SELECT * FROM {$CONF['dbtable']['news']} ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
$r_vnews=mysql_query($q_vnews,$CONN);
echo<<<html
<form method="POST">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="left">
	<tr>
		<td align="right" height="30" id="admin_news_add" valign="center">
			<a href="#" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_news0'][$_SESSION['lang']]}' })" id="cat_wall" title="{$LANG['admin_news0'][$_SESSION['lang']]}">
				<img src='images/add_new.png' name='wall_add'>
			</a>
			<div class="highslide-maincontent">
				
			</div>
		</td>
	</tr>
html;
$p=1;
while(($row_vnews=mysql_fetch_assoc($r_vnews))!=false){
echo <<<html
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="98%" height="100%" align="center">
				<tr>
					<td id="news_row" width="20" rowspan="2">{$row_vnews['id']}</td>
					<td></td>
					<td id="news_row_text">
						<table border="0" cellpadding="0" cellspacing="0" width="98%" height="100%" align="center">
							<tr>
								<td id="news_title" width="80" height="80">
									<img src="../images/news/min_thumbs/{$row_vnews['news_image']}">
								</td>
								<td id="news_title_text">
									{$news_title}
								</td>
							</tr>
						</table>
					</td>
					<td></td>
					<td id="news_row" valign="center" align="center" width="35" rowspan="2">
							<input type="submit" class="news_delete" name="news_delete" value="{$row_vnews['id']}" title="{$LANG['admin_news1'][$_SESSION['lang']]}">
							<br />
							<br />
							<input type="submit" class="news_edit" name="news_edit" value="{$row_vnews['id']}">z
							<br />
							<br />
html;
							if($row_vnews['status']=="1"){
echo <<<html
								<input type="submit" class="news_switch_e" name="news_switch" value="{$row_vnews['id']}" title="{$LANG['admin_news3'][$_SESSION['lang']]}">
html;
							}else{
echo <<<html
								<input type="submit" class="news_switch_d" name="news_switch" value="{$row_vnews['id']}" title="{$LANG['admin_news2'][$_SESSION['lang']]}">
html;

							}
echo <<<html
					</td>
				</tr>
				<tr>
					
					<td width="3"></td>
					<td id="news_row_text" align="left" valign="top" height="80">
						{$news_text}
					</td>
					<td width="3"></td>
				</tr>
				<tr><td height="10"></td></tr>
			</table>
		</td>
	</tr>
html;
$p++;
}
echo <<<html
	<tr>
		<td id="tp_content" colspan="3" valign="center" align="left">
html;
			for($page=1; $page<=$i_pageing; $page++){
				if ($_SESSION['page']==$page){
echo <<<html
					<div id="pageing_numbers_active">{$page}</div>
html;
				}else {
echo <<<html
					<a href="?goto=e_library&page={$page}"><div id="pageing_numbers">{$page}</div></a>
html;
				}	
			}
echo <<<html

		</td>
	</tr>

</table>
</form>
html;

?>