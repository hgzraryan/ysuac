<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$q_files="SELECT * FROM {$CONF['dbtable']['files']} ORDER BY id DESC";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_files=mysql_query($q_files,$CONN);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">	
	<tr>
		<td id="cat_left"></td>
		<td id="cat_rep">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="30">
				<tr>
					<td id="files_id">
						{$LANG['admin_lang0'][$_SESSION['lang']]}
					</td>
					<td id="files_type">
						{$LANG['admin_lang19'][$_SESSION['lang']]}
					</td>
					<td id="files_url_title">
						{$LANG['admin_partners1'][$_SESSION['lang']]}
					</td>
					<td id="files_lang_title">
						{$LANG['admin_wall5'][$_SESSION['lang']]}
					</td>
					<td id="files_name_title">
						{$LANG['admin_wall3'][$_SESSION['lang']]}
					</td>
					<td>
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td id="cat_right"></td>
	</tr>
	<tr><td height="5"></td></tr>
	<tr>
		<td colspan="3" valign="top" align="center">
			<form method="post">	
			<table border="0" cellpadding="0" cellspacing="0" width="99%" height="100%" align="center">
html;
			$i=1;
			while(($row_files=mysql_fetch_assoc($r_files))!=false){
				if($row_files['size']>=1024 && $row_files['size']<=1048576){
					$size_d=($row_files['size']/1024);
					$size_n=explode(".",$size_d);
					$size_r=substr($size_n[1], 0, 2);
					$size="{$size_n[0]}.{$size_r} {$LANG['admin_wall6'][$_SESSION['lang']]}";
				}elseif($row_files['size']>=1048576){
					$size_d=($row_files['size']/1024/1024);
					$size_n=explode(".",$size_d);
					$size_r=substr($size_n[1], 0, 2);
					$size="{$size_n[0]}.{$size_r} {$LANG['admin_wall7'][$_SESSION['lang']]}";
				}
echo <<<html
				<tr>
					<td id="moderators_contentid">{$i}</td>
					<td id="files_menu_type">{$row_files['type']}</td>
					<td id="files_menu_url">http://{$_SERVER['HTTP_HOST']}/download.php?file={$row_files['id']}</td>
					<td id="files_menu_size">{$size}</td>
					<td id="files_menu_name">{$row_files['unic_name']}</td>
					<td id="moderators_contentid">
						<input type="submit" class="moderators_delete" name="files_delete" value="{$row_files['id']}">
					</td>
				</tr>
				<tr><td colspan="6" height="5"></td></tr>
html;
				$i++;
			}
echo <<<html
			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td colspan="3" id="moderators_add" align="right">
			<a href="index.htm" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_file1'][$_SESSION['lang']]}' })"><img src="images/add.png"></a>
			<div class="highslide-maincontent">
				<form method="post" enctype="multipart/form-data">	
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
						<tr>
							<td id="departments_textbox">
								<input type="file" name="file_upload">
							</td>		
						</tr>
						<tr>
							<td id="departments_textbox">
								<input type="name" name="file_name">
							</td>		
						</tr>
						<tr><td height="5"></td></tr>
						<tr>
							<td colspan="3">
								<input type="image" src="images/add_buttons_{$_SESSION[lang]}.png" id="departments_add_buttons" name="add_file" onMouseOver=this.src='images/add_buttonsa_{$_SESSION[lang]}.png' onMouseOut=this.src='images/add_buttons_{$_SESSION[lang]}.png'>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</td>
	</tr>
</table>
html;
?>