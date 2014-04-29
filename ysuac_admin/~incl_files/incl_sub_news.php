<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$tiny_name="etext_news";
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_newsam="SELECT * FROM {$CONF['dbtable'][$news_lang]} ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_newsam=mysql_query($q_newsam,$CONN);
echo<<<html
<form method="POST" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="left">
	<tr><td height="10"><td></tr>
	<tr><td height="10"  style="background: rgba(163, 188, 58, 0.2);"><td></tr>
	<tr>
		<td style="background: rgba(163, 188, 58, 0.2);">
		<form method="POST" enctype="multipart/form-data">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="60">
				<tr>
					<td width="10"></td>
					<td height="20" id="news_title_text" width="460" align="left" valign="top">
						{$LANG['admin_lang10'][$_SESSION['lang']]} <span style="color:red;">*</span>
					</td>
					<td width="10"></td>
					<td height="20" id="news_title_text"  align="left" valign="top">
						{$LANG['admin_lang18'][$_SESSION['lang']]} <span style="color:red;">*</span>
					</td>
					<td width="10"></td>
				</tr>
				<tr><td colspan="5" height="5"></td></tr>
				<tr>
					<td width="10"></td>
					<td height="20" id="news_image" width="460" align="center" valign="top">
						<div class="button">{$LANG['admin_cat4'][$_SESSION['lang']]}<input type="file" name="images"></div>
					</td>
					<td width="10"></td>
					<td height="20" id="news_title"  align="left" valign="top">
						<input type="text" name="title" id="news_title_b" >
					</td>
					<td width="10"></td>
				</tr>
			</table>
		<td>
	</tr>
	<tr><td height="10"  style="background: rgba(163, 188, 58, 0.2);"></td></tr>
	<tr>
		<td height="20" id="news_title_text"  align="left" valign="top"  style="background: rgba(163, 188, 58, 0.2);">
			{$LANG['admin_lang22'][$_SESSION['lang']]} <span style="color:red;">*</span>
		</td>
	</tr>
	<tr>
		<td valign="top" align="center"  style="background: rgba(163, 188, 58, 0.2);">
html;
include_once("editor.php");
echo <<<html
		<td>
	</tr>
	<tr><td height="10"  style="background: rgba(163, 188, 58, 0.2);"></td></tr>
	<tr><td height="10"></td></tr>
html;
$id=$p_pageing+1;			
while(($row_newsam=mysql_fetch_assoc($r_newsam))!=false){
echo <<<html
	<tr>
		<td align="center" valign="top">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
				<tr>
					<td id="news_row" width="20" rowspan="3">{$id}</td>
					<td></td>
					<td id="news_row_text">
						<table border="0" cellpadding="0" cellspacing="0" width="98%" height="100%" align="center">
							<tr>
								<td id="news_title" width="80" height="80">
									<img src="../images/news/min_thumbs/{$row_newsam['news_image']}">
								</td>
								<td id="news_title_text">
									{$row_newsam['news_title']}
								</td>
							</tr>
						</table>
					</td>
					<td></td>
					<td id="news_row" valign="center" align="center" width="35" rowspan="3">
						<input type="submit" class="news_delete" name="news_delete" value="{$row_newsam['id']}" title="{$LANG['admin_news1'][$_SESSION['lang']]}">
							<br />
							
<!-------------------------------------------------------------------------------------------------------->
							<a href="#" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_news_addimg'][$_SESSION['lang']]}' })" id="cat_wall">
								<img src='images/add.png' name='wall_add' title="{$LANG['admin_news_addimg'][$_SESSION['lang']]}">
							</a>
							<div class="highslide-maincontent">
								<form method="post" enctype="multipart/form-data">
									<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
										<tr>
											<td height="130" align="center" valign="top">
												  <div class="button">{$LANG['admin_cat4'][$_SESSION['lang']]}<input type="file" name="news_ifile_add" /></div>
											</td>
										</tr>
										<tr><td height="10"></td></tr>
										<tr>
											<td align="right" valign="center" height="33">
												<input type="submit" class="news_additional_imgadd" name="news_add_image" value="{$row_newsam['id']}" title="{$LANG['admin_news2'][$_SESSION['lang']]}">
											</td>
										</tr>
										<tr><td></td></tr>
									</table>
								</form>
							</div>
<!-------------------------------------------------------------------------------------------------------->
							<br />
							<br />
html;
							if($row_newsam['status']=="1"){
echo <<<html
								<input type="submit" class="news_switch_e" name="news_switch" value="{$row_newsam['id']}" title="{$LANG['admin_lang16'][$_SESSION['lang']]}">
html;
							}else{
echo <<<html
								<input type="submit" class="news_switch_d" name="news_switch" value="{$row_newsam['id']}" title="{$LANG['admin_lang17'][$_SESSION['lang']]}">
html;
							}
echo<<<html
								</br>							
html;
							if($row_newsam['top']=="1"){
echo <<<html
								<input type="submit" class="news_top_e" name="news_top" value="{$row_newsam['id']}" title="{$LANG['admin_lang16'][$_SESSION['lang']]}">
html;
							}else{
echo <<<html
								<input type="submit" class="news_top_d" name="news_top" value="{$row_newsam['id']}" title="{$LANG['admin_lang17'][$_SESSION['lang']]}">
html;
							}

echo <<<html
							</br>
							<a href="?go=home&sub=news_edit&news_id={$row_newsam['id']}" title="{$LANG['admin_lang25'][$_SESSION['lang']]}"><img src="images/edit.png" border="0"></a>
					</td>
				</tr>
				<tr>
					<td width="3"></td>
					<td id="news_row_text" align="left" valign="top" height="80">
						{$row_newsam['news']}
					</td>
					<td width="3"></td>
				</tr>
				<tr>
					
					<td></td>
					<td id="news_row_text" align="left">
html;
	if($row_newsam['add_images']){
	$img_news=explode(":::", $row_newsam['add_images']);
	foreach ($img_news as $key => $value) {
		if($value!=null){
echo<<<html
			<div style="float:left;margin-left:3px;margin-bottom:5px; background-color:#ffffff;">
				<div><a class="highslide" onclick="return hs.expand(this)" href="../images/news/additional/watermark/{$value}"><img src="../images/news/additional/min_thumbs/{$value}"></a></div>
				<div>
					<input type="submit" class="image_delete" name="news_image_delete" value="{$value}:://_:{$row_newsam['id']}">
				</div>
			</div>
html;
		}
	}
}
echo<<<html
					</td>
					<td></td>
				</tr>
				<tr><td height="10" colspan="5"></td></tr>
			</table>
		</td>
	</tr>
html;
$id++;
}
echo <<<html

		</td>
	</tr>

	<tr><td height="10"></td></tr>
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
					<a href="?go=home&sub=news&page={$page}"><div id="pageing_numbers">{$page}</div></a>
html;
				}	
			}
echo <<<html
	</tr>
</table>
</form>

html;
?>