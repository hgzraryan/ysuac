<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$tiny_name="etext_news_edit";
$q_news_edit="SELECT * FROM {$CONF['dbtable'][$news_lang]} WHERE id='{$_GET['news_id']}'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_news_edit=mysql_query($q_news_edit,$CONN);
$row_news_edit=mysql_fetch_assoc($r_news_edit);
#pre($row_news_edit);
if(!$row_news_edit['news']){
echo <<<html
<script language="javascript">
	window.location.replace("admin.php?go=home&sub=news");
</script>
html;
exit();
}

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
					<td height="20" id="news_title_text"  align="left" valign="top">
						{$LANG['admin_lang18'][$_SESSION['lang']]} <span style="color:red;">*</span>
					</td>
					<td width="10"></td>
				</tr>
				<tr><td colspan="5" height="5"></td></tr>
				<tr>
					<td width="10"></td>
					<td height="20" id="news_title_edit"  align="left" valign="top">
						<input type="text" name="edit_title" id="news_title_b" value="{$row_news_edit['news_title']}">
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
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0" id="news_row_text" width="100%">
				<tr>
					<td>
		
		<td></td>
		<td  align="left">
html;
	if($row_news_edit['add_images']){
	$img_news=explode(":::", $row_news_edit['add_images']);
	foreach ($img_news as $key => $value) {
		if($value!=null){
echo<<<html
			<div style="float:left;margin-left:3px;margin-bottom:5px; background-color:#ffffff;">
				<div><a class="highslide" onclick="return hs.expand(this)" href="../images/news/additional/watermark/{$value}"><img src="../images/news/additional/min_thumbs/{$value}"></a></div>
				<div>
					<input type="submit" class="image_delete" name="news_image_delete" value="{$value}:://_:{$row_news_edit['id']}">
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
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>

html;
?>