<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
echo<<<html
<script type="text/javascript">
	//anylinkcssmenu.init("menu_anchors_class") ////Pass in the CSS class of anchor links (that contain a sub menu)
	anylinkcssmenu.init("anchorclass")
</script>
html;
$q_cat="SELECT * FROM {$CONF['dbtable']['gallery_category']} ORDER BY id";
$r_cat=mysql_query($q_cat,$CONN);
while( ($row_cat=mysql_fetch_assoc($r_cat))!=false ){
$tit="title_".$_SESSION['lang'];
$category_name=$row_cat[$tit];
echo <<<html
	<div id='category'>
		<a href='?go=gallery_cat&id={$row_cat['id']}'>
			<div class="anchorclass" rel="submenu1"><img width='187' height='187' src='../images/gallery_category/{$row_cat['thumbnail']}' alt="{$category_name}"></div>
		</a>
	</div>		
	<div id="submenu1" class="anylinkcss">
		<ul>
			<li>
html;
				string_limiter($category_name,"18");
echo <<<html
			</li>
			<li><a href="admin.php?go=gallery&del={$row_cat['id']}">{$LANG['admin_cat1'][$_SESSION['lang']]}</a></li>
		</ul>
	</div>
html;
}
echo <<<html
<a href="index.htm" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_menu6'][$_SESSION['lang']]}' })" id='add_category'>
	<img src='images/add_avat.png' border='0' title='{$LANG['admin_menu6'][$_SESSION['lang']]}' onMouseOver=this.src='images/add_avat_a.png' onMouseOut=this.src='images/add_avat.png'>
</a>
<div class="highslide-maincontent">
	<form method="post" onSubmit="document.getElementById('fileThing').disabled = true;">
		<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
			<tr>
				<td valign="center" align="center" height="83">
html;
				include_once("upload/gallery_script.php");
echo <<<html
				</td>
			</tr>
			<tr>
				<td id="drag_title">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text" id="cat_wall_textarea" name="cat_title_am" value="{$LANG['admin_lang2'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang2'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang2'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text"  id="cat_wall_textarea" name="cat_title_ru" value="{$LANG['admin_lang3'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang3'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang3'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text" id="cat_wall_textarea" name="cat_title_en" value="{$LANG['admin_lang4'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang4'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang4'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="10"></td></tr>
						<tr>
							<td height="18" align="center">
								<input type="text" id="cat_wall_textarea" name="cat_title_fr" value="{$LANG['admin_lang5'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang5'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang5'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td height="10"></td></tr>
			<tr>
				<td align="right">
					<input type="image" id="departments_add_buttons" src="images/add_buttons_{$_SESSION['lang']}.png" name="gallery_add" value="add" onMouseOver=this.src="images/add_buttons_{$_SESSION['lang']}.png" onMouseOut=this.src="images/add_buttons_{$_SESSION['lang']}.png">
				</td>
			</tr>
		</table>
	</form>
</div>
html;
?>