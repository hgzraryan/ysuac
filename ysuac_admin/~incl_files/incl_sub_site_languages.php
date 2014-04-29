<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
if($_GET['sid']){
	$search_string="WHERE id='{$_GET['sid']}'";
}
#pre($_POST);
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_lange="SELECT * FROM {$CONF['dbtable']['site_str_languages']} {$search_string}  ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_lange=mysql_query($q_lange,$CONN);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">	
	<tr>
		<td id="cat_left"></td>
		<td id="cat_rep">
			<table border="0" cellpadding="0" cellspacing="0" width="100%" height="30">
				<tr>
					<td id="moderators_id">
						{$LANG['admin_lang0'][$_SESSION['lang']]}
					</td>
					<td id="departments_lang_title">
						{$LANG['admin_lang2'][$_SESSION['lang']]}
					</td>
					<td id="departments_lang_title">
						{$LANG['admin_lang3'][$_SESSION['lang']]}
					</td>
					<td id="departments_lang_title">
						{$LANG['admin_lang4'][$_SESSION['lang']]}
					</td>
					<td id="departments_lang_title">
						{$LANG['admin_lang5'][$_SESSION['lang']]}
					</td>
					<td align="center">
						<input type="checkbox" name="" title="{$LANG['admin_wall12'][$_SESSION['lang']]}" value='Check All' onClick='checkAll()' name="1">
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
				while( ($row_lange=mysql_fetch_assoc($r_lange))!=false){
echo <<<html
					<tr><td colspan="8" height="5"></td></tr>
					<tr>
						<td id="wallpaper_row" align="center" valign="center" width="32" height="70" title="{$row_lange['description']}">
							{$id}
						</td>
						<td id="wallpaper_row" valign="center" width="215" >
							<textarea name="lang_armenian{$row_lange['id']}">{$row_lange['armenian']}</textarea>
						</td>
						<td id="wallpaper_row" valign="center" width="215">
							<textarea name="lang_russian{$row_lange['id']}">{$row_lange['russian']}</textarea>
						</td>
						<td id="wallpaper_row" valign="center" width="215">
							<textarea name="lang_english{$row_lange['id']}">{$row_lange['english']}</textarea>
						</td>
						<td id="wallpaper_row" valign="center" width="215">
							<textarea name="lang_france{$row_lange['id']}">{$row_lange['france']}</textarea>
						</td>
						<td id="wallpaper_row" align="center">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
								<tr>
									<td align="center" valign="center">
										<input type="submit" class="edit_languageb" name="edit_languageb" value="{$row_lange['id']}">
									</td>
									<td align="center" valign="center">
										<input type="checkbox" name='chbox[{$row_lange['id']}]' checkded id=pbox[{$id}]>
									</td>
								</tr>
							</table>
						</td>
					</tr>
html;
					$id++;
				}
echo <<<html
					<tr>
						<td colspan="8"></td>
					</tr>
				</table>
				<script language=javascript>var qanak={$id}</script>
		</td>
	</tr>
	<tr><td colspan="3" height="10"><td></tr>
	<tr>
		<td align="right" colspan="3" id="lang_add1">
			<a href="#" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_lang5'][$_SESSION['lang']]}' })" id="adm_lang">
				<img src='images/add.png' name='lang_add'>
			</a>
			<input type='image' src='images/delete.png' height='21' border='0' name='lang_delete'>
			</form>
			<div class="highslide-maincontent">
				<form method="post">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
						<tr>
							<td id="lang_b1" align="left">
								<input type="text" name="lang_desci" value="{$LANG['admin_lang13'][$_SESSION['lang']]}" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang13'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang13'][$_SESSION['lang']]}&quot; : this.value;">
							</td>
						</tr>
						<tr><td height="5"></td></tr>
						<tr>
							<td id="lang_b2">
								<textarea name="lang_am" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang2'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang2'][$_SESSION['lang']]}&quot; : this.value;">{$LANG['admin_lang2'][$_SESSION['lang']]}</textarea>
							</td>
						</tr>
						<tr><td height="5"></td></tr>
						<tr>
							<td id="lang_b2">
								<textarea name="lang_ru" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang3'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang3'][$_SESSION['lang']]}&quot; : this.value;">{$LANG['admin_lang3'][$_SESSION['lang']]}</textarea>
							</td>
						</tr>
						<tr><td height="5"></td></tr>
						<tr>
							<td id="lang_b2">
								<textarea name="lang_en" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang4'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang4'][$_SESSION['lang']]}&quot; : this.value;">{$LANG['admin_lang4'][$_SESSION['lang']]}</textarea>
							</td>
						</tr>
						<tr><td height="5"></td></tr>
						<tr>
							<td id="lang_b2">
								<textarea name="lang_fr" onfocus="this.value=(this.value==&quot;{$LANG['admin_lang5'][$_SESSION['lang']]}&quot;) ? &quot;&quot; : this.value;" onblur="this.value=(this.value==&quot;&quot;) ? &quot;{$LANG['admin_lang5'][$_SESSION['lang']]}&quot; : this.value;">{$LANG['admin_lang5'][$_SESSION['lang']]}</textarea>
							</td>
						</tr>
						<tr><td height="5"></td></tr>
						<tr>
							<td align="right" valign="center" height="33">
								<input type="image"  src="images/add_buttons_{$_SESSION['lang']}.png" id="languages_add_buttons" name="add_languageb" value="add" onMouseOver=this.src="images/add_buttonsa_{$_SESSION['lang']}.png" onMouseOut=this.src="images/add_buttons_{$_SESSION['lang']}.png">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="24" id="pageing_constr">
html;
		for($page=1; $page<=$i_pageing; $page++){
				if ($_SESSION['page']==$page){
echo <<<html
					<div id="pageing_numbers_active">{$page}</div>
html;
				}else {
echo <<<html
					<a href="?go={$_GET['go']}&sub={$_GET['sub']}&page={$page}"><div id="pageing_numbers">{$page}</div></a>
html;
				}	
			}
echo <<<html

		</td>
	</tr>
</table>
html;
?>