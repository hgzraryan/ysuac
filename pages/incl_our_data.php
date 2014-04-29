<?php
$q_siteodata="SELECT * FROM {$CONF['dbtable']['units']} WHERE status='1' AND t_id='4' ORDER BY id DESC";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_siteodata=mysql_query($q_siteodata,$CONN);
$odata_lan="fac_".$_SESSION['lang'];

#pre($_POST);
echo <<<html
<form method="post">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="800">
		<tr>
			<td height="20" valign="center" width="100">
				<div id="our_data_fhl"></div>
			</td>
			<td width="20"></td>
			<td id="our_data_title" valign="center" height="20">
				{$_SL['our_data']}
			</td>
		</tr>
		<tr><td colspan="3" height="15"></td></tr>
		<tr>
			<td colspan="2"></td>
			<td valign="top">
				<table border="0" cellpadding="0" cellspacing="0" width="100%" height="370">
					<tr>
						<td id="our_data_text" height="30">		
							{$_SL['questions']}
						</td>
					</tr>
					<tr><td height="10"></td></tr>
					<tr><td height="20" id="our_data_text">{$_SL['our_data_text1']}</td></tr>
					<tr><td height="15"></td></tr>
					<tr><td height="20" id="our_data_text1">{$_SL['our_data_sections']} <span id="our_data_required">({$_SL['necessarily']})</span></td></tr>
					<tr>
						<td id="our_data_select" height="25">		
							<select name="our_data_section">
								<option disabled='disabled' selected='selected'>{$_SL['our_data_reports']}</option>
html;
								while( ( $row_siteodata=mysql_fetch_assoc($r_siteodata))!=false){
echo <<<html
									<option value="{$row_siteodata['id']}">{$row_siteodata[$odata_lan]}</option>
html;
								}
echo <<<html
							</select>
						</td>
					</tr>
					<tr><td height="20"></td></tr>
					<tr><td height="20" id="our_data_text1">{$_SL['our_data_name']} <span id="our_data_required">({$_SL['necessarily']})</span></td></tr>
					<tr>
						<td height="20" id="our_data_uinput"><input type="text" name="our_data_name"></td>
					</tr>
					<tr><td height="20"></td></tr>
					<tr><td height="20" id="our_data_text1">{$_SL['our_data_email']} <span id="our_data_required">({$_SL['necessarily']})</span></td></tr>
					<tr>
						<td height="20" id="our_data_einput"><input type="text" name="our_data_email"></td>
					</tr>
					<tr><td height="20"></td></tr>
					<tr><td height="20" id="our_data_text1">{$_SL['our_data_textcontent']} <span id="our_data_required">({$_SL['necessarily']})</span></td></tr>
					<tr>
						<td height="90" id="our_data_tinput">
							<textarea name="our_data_content"></textarea>
						</td>
					</tr>
					<tr>
						<td valign="center" align="left" height="70">
							<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
								<tr>
									<td width="200">
										<img src="captcha.php" id="captcha" />
									</td>
									<td width="29" valign="center">
										<a href="#captcha-form" onclick="
											document.getElementById('captcha').src='captcha.php?'+Math.random();
											document.getElementById('captcha-form').focus();"
											id="change-image"><img src="images/reload.png" border="0"></a>

									</td>
									<td align="left" valign="center" width="150">
										<input type="text" name="captcha" id="captcha-form" autocomplete="off" />
									</td>
									<td align="right">
										<input type="submit" value="{$_SL['our_data_send']}" class="our_data_button" />
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td colspan="3" height="3"><div id="our_data_hr"></div></td></tr>
		<tr><td colspan="3" height="10"></td></tr>
		<tr>
			<td></td>
			<td colspan="2" height="299" align="center" >
				<div id="our_data_map_{$_SESSION['lang']}">
					<div id="our_data_maptext">{$_SL['title']}</div>
				</div>
			</td>
		</tr>
		<tr><td colspan="3" height="10"></td></tr>
		<tr><td colspan="3"></td></tr>
	</table>
</form>
html;
?>