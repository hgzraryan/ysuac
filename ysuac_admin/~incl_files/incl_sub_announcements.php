<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$tiny_name="etext_announcements";
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_announcements="SELECT * FROM {$CONF['dbtable'][$announcements_lang]} ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_announcements=mysql_query($q_announcements,$CONN);

echo <<<html
<form method="post">
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr><td height="10" colspan="3"></td></tr>
	<tr><td height="10" colspan="3" style="background: rgba(163, 188, 58, 0.2);"></td></tr>
	<tr>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
		<td height="20" id="news_title_text"  align="left" valign="top"  style="background: rgba(163, 188, 58, 0.2);">
			{$LANG['admin_lang18'][$_SESSION['lang']]} <span style="color:red;">*</span>
		</td>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
	</tr>
	<tr>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
		<td height="20" id="announcements_title"  align="left" valign="top" style="background: rgba(163, 188, 58, 0.2);">
			<input type="text" name="announcements_title" id="announcements_title_b" >
		</td>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
	</tr>
	<tr><td height="10" colspan="3" style="background: rgba(163, 188, 58, 0.2);"></td></tr>
	<tr>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
		<td height="20" id="news_title_text"  align="left" valign="top" style="background: rgba(163, 188, 58, 0.2);">
			{$LANG['admin_lang21'][$_SESSION['lang']]} <span style="color:red;">*</span>
		</td>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
	</tr>
	<tr>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
		<td align="center" valign="center" style="background: rgba(163, 188, 58, 0.2);">
html;
include_once("editor.php");
echo <<<html
		</td>
		<td width="5" style="background: rgba(163, 188, 58, 0.2);"></td>
	</tr>
	<tr><td height="100%" colspan="3"></td></tr>
	<tr><td height="10" colspan="3" style="background: rgba(163, 188, 58, 0.2);"></td></tr>
	<tr><td height="10" colspan="3"></td></tr>
html;
$id=$p_pageing+1;			
while(($row_announcements=mysql_fetch_assoc($r_announcements))!=false){
echo <<<html
	<tr>
		<td align="center" valign="top" colspan="3">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
				<tr>
					<td id="news_row" width="20" rowspan="2">{$id}</td>
					<td width="3" rowspan="2"></td>
					<td id="news_row_text">
						{$row_announcements['title']}
					</td>
					<td width="3" rowspan="2"></td>
					<td id="news_row" valign="center" align="center" width="35" rowspan="3">
						<input type="submit" class="news_delete" name="announcements_delete" value="{$row_announcements['id']}" title="{$LANG['admin_announcements1'][$_SESSION['lang']]}">
						<br />						
html;
						if($row_announcements['status']=="1"){
echo <<<html
							<input type="submit" class="news_switch_e" name="announcements_switch" value="{$row_announcements['id']}" title="{$LANG['admin_lang16'][$_SESSION['lang']]}">
html;
						}else{
echo <<<html
							<input type="submit" class="news_switch_d" name="announcements_switch" value="{$row_announcements['id']}" title="{$LANG['admin_lang17'][$_SESSION['lang']]}">
html;
						}
						
						
echo<<<html
								</br>							
html;
							if($row_announcements['top']=="1"){
echo <<<html
								<input type="submit" class="announcements_top_e" name="announcements_top" value="{$row_announcements['id']}" title="{$LANG['admin_lang16'][$_SESSION['lang']]}">
html;
							}else{
echo <<<html
								<input type="submit" class="announcements_top_d" name="announcements_top" value="{$row_announcements['id']}" title="{$LANG['admin_lang17'][$_SESSION['lang']]}">
html;
							}

							
							
							

echo <<<html
					</td>
				</tr>
				<tr>
					<td id="news_row_text">
						{$row_announcements['text']}
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td colspan="3" height="10"><td></tr>
html;
$id++;

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
					<a href="?go=home&sub=announcements&page={$page}"><div id="pageing_numbers">{$page}</div></a>
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