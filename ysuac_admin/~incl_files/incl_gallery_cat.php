<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$q_catd="SELECT * FROM {$CONF['dbtable']['gallery_category']} WHERE id='".addslashes($_GET['id'])."'";
$r_catd=mysql_query($q_catd,$CONN);
$row_catd=mysql_fetch_assoc($r_catd);
$tit_cat="title_".$_SESSION['lang'];
$title_category=$row_catd[$tit_cat];

$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_catd_wall="SELECT * FROM {$CONF['dbtable']['wallpapers']} WHERE cat='".addslashes($_GET['id'])."' ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
$r_catd_wall=mysql_query($q_catd_wall,$CONN);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="left">
	<tr>
		<td colspan="3" height="120">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="left">
				<tr>
					<td width="5"></td>
					<td align="left" valign="top" width="127" height="128" style="background:url(images/cat_imagebg.png) left top no-repeat">
						<a href="?go=gallery" title="{$LANG['admin_cat3'][$_SESSION['lang']]}"><img src="../images/gallery_category/{$row_catd['thumbnail']}" height="120" border="0"></a>
					</td>
					<td width="5">
					</td>
					<td width="260" align="left" valign="top" >
						<p style="color:#ed186d;font-weight:bold;" title="{$title_category}">
html;
							string_limiter($title_category,"68");
echo <<<html
							({$row_pageing['count']})
						</p>
						<p><hr></p>
						<p style="color:#333;font-size:13px;">{$row_catd['upload_date']}</p>
					</td>
					<td>&nbsp;</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td id="cat_left"></td>
		<td id="cat_rep">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="30">
				<tr>
					<td style="border-right:1px solid #d4d4d4; color:#444444; font-family: Tahoma;font-weight:bold;font-size:14px;width:32px;text-align:center; ">
						{$LANG['admin_wall1'][$_SESSION['lang']]}
					</td>
					<td style="border-right:1px solid #d4d4d4; color:#444444; font-family: Tahoma;font-weight:bold;font-size:14px;width:120px;text-align:center;">
						{$LANG['admin_wall2'][$_SESSION['lang']]}
					</td>
					<td style="border-right:1px solid #d4d4d4; color:#444444; font-family: Tahoma;font-weight:bold;font-size:14px;width:280px;text-align:center;">
						{$LANG['admin_wall3'][$_SESSION['lang']]}
					</td>
					<td style="border-right:1px solid #d4d4d4; color:#444444; font-family: Tahoma;font-weight:bold;font-size:14px;width:90px;text-align:center;">
						{$LANG['admin_wall5'][$_SESSION['lang']]}
					</td>
					<td style="border-right:1px solid #d4d4d4; color:#444444; font-family: Tahoma;font-weight:bold;font-size:14px;width:100px;text-align:center;">
						{$LANG['admin_wall8'][$_SESSION['lang']]}
					</td>
					<td style="border-right:1px solid #d4d4d4; color:#444444; font-family: Tahoma;font-weight:bold;font-size:14px;width:180px;text-align:center;">
						{$LANG['admin_wall9'][$_SESSION['lang']]}
					</td>
					<td width="125"></td>
					<td>
						 <input type="checkbox" title="{$LANG['admin_wall12'][$_SESSION['lang']]}" value='Check All' onClick='checkAll()' name="1">
					</td>
				</tr>
			</table>
		</td>
		<td id="cat_right"></td>
	</tr>
	<tr>
		<td colspan="3" valign="top" align="center">
		<form method="post">
			<table border="0" cellpadding="0" cellspacing="0" width="99%" height="100%" align="center">
html;
				$id=$p_pageing+1;			
				while( ($row_catd_wall=mysql_fetch_assoc($r_catd_wall))!=false){
					$lang="name_{$_SESSION['lang']}";
					$title_lang=$row_catd_wall[$lang];
					if($row_catd_wall['size']>=1024 && $row_catd_wall['size']<=1048576){
						$size_d=($row_catd_wall['size']/1024);
						$size_n=explode(".",$size_d);
						$size_r=substr($size_n[1], 0, 2);
						$size="{$size_n[0]}.{$size_r} {$LANG['admin_wall6'][$_SESSION['lang']]}";
					}elseif($row_catd_wall['size']>=1048576){
						$size_d=($row_catd_wall['size']/1024/1024);
						$size_n=explode(".",$size_d);
						$size_r=substr($size_n[1], 0, 2);
						$size="{$size_n[0]}.{$size_r} {$LANG['admin_wall7'][$_SESSION['lang']]}";
					}
					$resolution=str_replace("-", "x", $row_catd_wall['resolution']);
					if($row_catd_wall['block']=="0"){
						$act_mess=$LANG['admin_wall11'][$_SESSION['lang']];									
					}else{
						$act_mess=$LANG['admin_wall12'][$_SESSION['lang']];	
					}
echo <<<html
					<tr><td colspan="9" height="5"></td></tr>
					<tr>
						<td id="wallpaper_row" align="center" valign="center" width="32" height="80">
							{$id}
						</td>
						<td id="wallpaper_row" valign="center" width="120" >
							<a href="../images/photos/thumbnails/{$row_catd_wall['path']}" class="highslide" onclick="return hs.expand(this)">
								<img src="../images/photos/thumbnails/{$row_catd_wall['path']}" border="0" width="80">
							</a>
							<div class="highslide-caption">
								{$title_lang}
							</div>
						</td>
						<td id="wallpaper_row" valign="center" width="285">
							<div title="{$title_lang}" id="wallpaper_row_text">
html;
								string_limiter($title_lang,"62");
echo <<<html
							</div>
						</td>
						<td id="wallpaper_row" valign="center" width="90">
							{$size}
						</td>
						<td id="wallpaper_row" valign="center" width="100">
							{$resolution}
						</td>
						<td id="wallpaper_row" valign="center" width="180">
							{$row_catd_wall['udatetime']}
						</td>
						<td id="wallpaper_row" valign="center" align="center">
html;
							if($row_catd_wall['block']=="1"){
echo <<<html
								<input type="submit" class="gallery_switch_e" name="gallery_switch" value="{$row_catd_wall['id']}" title="{$LANG['admin_news3'][$_SESSION['lang']]}">
html;
							}else{
echo <<<html
								<input type="submit" class="gallery_switch_d" name="gallery_switch" value="{$row_catd_wall['id']}" title="{$LANG['admin_news2'][$_SESSION['lang']]}">
html;
							}
echo <<<html
						</td>
						<td id="wallpaper_row" align="center" width="18">
							<input type="checkbox" name='chbox[{$row_catd_wall['id']}]' checkded id=pbox[{$id}]>
						</td>
						<td width="4" id="wallpaper_row"></td>
					</tr>
html;
					$id++;
				}
echo <<<html
			<tr><td colspan="9"></td></tr>
			</table>

			<script language=javascript>var qanak={$id}</script>
		</td>
	</tr>
	<tr><td colspan="3" height="10"></td></tr>
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
					<a href="?go={$_GET['go']}&id={$_GET['id']}&page={$page}"><div id="pageing_numbers">{$page}</div></a>
html;
				}	
			}
echo <<<html
		</td>
	</tr>
	<tr>
		<td colspan="3" valign="top" align="right" height="30">
			<a href="#" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_wall0'][$_SESSION['lang']]}' })" id="cat_wall">
				<img src='images/add.png' name='wall_add'>
			</a>
				<input type='image' src='images/delete.png' height='21' border='0' name='wall_delete'>
			</form>
			<div class="highslide-maincontent">
				<form method="post" enctype="multipart/form-data">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
						<tr>
							<td height="130" align="center" valign="top">
								  <div class="button">{$LANG['admin_cat4'][$_SESSION['lang']]}<input type="file" name="cat_wallpapers" /></div>
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text" id="cat_wall_textarea" name="photo_amt" value="{$LANG['admin_lang2'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang2'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang2'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text" id="cat_wall_textarea" name="photo_rut" value="{$LANG['admin_lang3'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang3'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang3'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text" id="cat_wall_textarea" name="photo_ent" value="{$LANG['admin_lang4'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang4'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang4'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text" id="cat_wall_textarea" name="photo_frt" value="{$LANG['admin_lang5'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang5'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang5'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td align="right" valign="center" height="33">
								<input type="image" id="departments_add_buttons" src="images/add_buttons_{$_SESSION['lang']}.png" name="add_wallpaper" value="add" title="{$LANG['admin_wall0'][$_SESSION['lang']]}" onMouseOver=this.src="images/add_buttonsa_{$_SESSION['lang']}.png" onMouseOut=this.src="images/add_buttons_{$_SESSION['lang']}.png">
							</td>
						</tr>
						<tr><td></td></tr>
					</table>
				</form>
			</div>
		</td>
	</tr>
</table>
html;
?>