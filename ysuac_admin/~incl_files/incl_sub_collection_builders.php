<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
#pre($_POST);

$q_cbuilders="SELECT * FROM {$CONF['dbtable']['cbuilders']} ORDER BY id DESC";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_cbuilders=mysql_query($q_cbuilders,$CONN);
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="left">
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
						{$LANG['admin_wall15'][$_SESSION['lang']]}
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
				$id=1;
				while( ($row_cbuilders=mysql_fetch_assoc($r_cbuilders))!=false){
					if($row_cbuilders['size']>=1024 && $row_cbuilders['size']<=1048576){
						$size_d=($row_cbuilders['size']/1024);
						$size_n=explode(".",$size_d);
						$size_r=substr($size_n[1], 0, 2);
						$size="{$size_n[0]}.{$size_r} {$LANG['admin_wall6'][$_SESSION['lang']]}";
					}elseif($row_cbuilders['size']>=1048576){
						$size_d=($row_cbuilders['size']/1024/1024);
						$size_n=explode(".",$size_d);
						$size_r=substr($size_n[1], 0, 2);
						$size="{$size_n[0]}.{$size_r} {$LANG['admin_wall7'][$_SESSION['lang']]}";
					}
echo <<<html
					<tr><td colspan="9" height="5"></td></tr>
					<tr>
						<td id="wallpaper_row" align="center" valign="center" width="32" height="80">
							{$id}
						</td>
						<td id="wallpaper_row" valign="center" width="120" >
							<a href="../images/library/bulletin/origin/{$row_cbuilders['thumbnails']}" class="highslide" onclick="return hs.expand(this)">
								<img src="../images/library/bulletin/thumbs/{$row_cbuilders['thumbnails']}" border="0" width="80">
							</a>
						</td>
						<td id="wallpaper_row" valign="center" width="285">
							<div title="{$title_lang}" id="wallpaper_row_text">
								{$row_cbuilders['real_name']}
							</div>
						</td>
						<td id="wallpaper_row" valign="center" width="90">
							{$size}
						</td>
						<td id="wallpaper_row" valign="center" width="100">
							{$row_cbuilders['pages']}
						</td>
						<td id="wallpaper_row" valign="center" width="180">
							{$row_cbuilders['upload_date']}
						</td>
						<td id="wallpaper_row" valign="center" align="center">
							&nbsp;
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
		<td colspan="3" valign="top" align="right" height="30">
			<a href="#" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_wall14'][$_SESSION['lang']]}' })" id="cat_wall">
				<img src='images/add.png' name='wall_add'>
			</a>
				<input type='image' src='images/delete.png' height='21' border='0' name='cbuilders_delete'>
			</form>
			<div class="highslide-maincontent">
				<form method="post" enctype="multipart/form-data">
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
						<tr>
							<td height="130" align="center" valign="top" colspan="2">
								  <div class="button">{$LANG['admin_cat4'][$_SESSION['lang']]}<input type="file" name="cbuilders_thumb" /></div>
							</td>
						</tr>
						<tr><td height="10" colspan="2"></td></tr>
						<tr>
							<td width="210" align="left" id="bulletin_text">
								{$LANG['admin_wall3'][$_SESSION['lang']]}
							</td>
							<td height="18" align="left">
								<input type="text" name="cbuilders_name" id="bulletin_input">						
							</td>
						</tr>
						<tr><td height="10" colspan="2"></td></tr>
						<tr>
							<td width="210" align="left" id="bulletin_text">
								{$LANG['admin_file1'][$_SESSION['lang']]}
							</td>
							<td height="18" align="left">
								<input type="file" name="cbuilders_file" id="bulletin_input">						
							</td>
						</tr>
						<tr><td height="10" colspan="2"></td></tr>
						<tr>
							<td width="210" align="left" id="bulletin_text">
								{$LANG['admin_menu71'][$_SESSION['lang']]}
							</td>
							<td height="18" align="left">
								<select name="cbuilders_number" id="bulletin_selection">
									<option value="0"></option>
html;
									for($num=1; $num<=12; $num++){
										echo "<option value='{$num}'>{$num}</option>";
									}
echo <<<html
								</select>							
							</td>
						</tr>
						<tr><td height="10" colspan="2"></td></tr>
						<tr>
							<td width="210" align="left" id="bulletin_text">
								{$LANG['admin_menu72'][$_SESSION['lang']]}
							</td>
							<td height="18" align="left">
								<select name="cbuilders_year" id="bulletin_selection">
									<option value="0"></option>
html;
									for($year=2000; $year<=date("Y"); $year++){
										echo "<option value='{$year}'>{$year}</option>";
									}
echo <<<html
								</select>							
							</td>
						</tr>
						<tr><td height="10" colspan="2"></td></tr>
						<tr>
							<td width="210" align="left" id="bulletin_text">
								{$LANG['admin_wall15'][$_SESSION['lang']]}
							</td>
							<td height="18" align="left">
								<input type="text" name="cbuilders_pages" id="bulletin_pages">					
							</td>
						</tr>
						<tr><td height="10" colspan="2"></td></tr>
						<tr>
							<td align="right" valign="center" height="33" colspan="2">
								<input type="image" id="departments_add_buttons" src="images/add_buttons_{$_SESSION['lang']}.png" name="add_cbuilders" value="add" title="{$LANG['admin_wall14'][$_SESSION['lang']]}" onMouseOver=this.src="images/add_buttonsa_{$_SESSION['lang']}.png" onMouseOut=this.src="images/add_buttons_{$_SESSION['lang']}.png">
							</td>
						</tr>
						<tr><td colspan="2"></td></tr>
					</table>
				</form>
			</div>
		</td>
	</tr>
</table>
html;
?>