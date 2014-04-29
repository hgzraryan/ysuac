<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_mod="SELECT * FROM {$CONF['dbtable']['admin_premoderators']} ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_mod=mysql_query($q_mod,$CONN);
#pre($_POST);
#pre($_SESSION);
$dep_lan="dep_".$_SESSION['lang'];
$q_mod_dep="SELECT id, {$dep_lan} FROM {$CONF['dbtable']['departments']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_mod_dep=mysql_query($q_mod_dep,$CONN);
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
					<td id="moderators_lang_title">
						{$LANG['admin_moderators1'][$_SESSION['lang']]}
					</td>
					<td id="moderators_lang_title">
						{$LANG['admin_moderators2'][$_SESSION['lang']]}
					</td>
					<td id="moderators_lang_title">
						{$LANG['admin_moderators3'][$_SESSION['lang']]}
					</td>
					<td id="moderators_lang_title">
						{$LANG['admin_moderators4'][$_SESSION['lang']]}
					</td>
					<td id="moderators_lang_title">
						{$LANG['admin_moderators5'][$_SESSION['lang']]}
					</td>
					<td id="moderators_lang_chbox">
						
					</td>
				</tr>
			</table>
		</td>
		<td id="cat_right"></td>
	</tr>
	<tr>
		<td colspan="3" valign="top" align="center">
			<form method="post" enctype="multipart/form-data">

			<table border="0" cellpadding="0" cellspacing="0" width="99%" height="100%" align="center">
html;
			$id=$p_pageing+1;			
			while(($row_mod=mysql_fetch_assoc($r_mod))!=false){
echo <<<html
				<tr><td colspan="3" height="5"><td></tr>
				<tr>
					<td id="moderators_contentid" align="center" valign="center">
						{$id}
					</td>
					<td id="moderators_content" valign="center" title="{$row_mod['first_name']}">
html;
							string_limiter($row_mod['first_name'],"13");
echo <<<html
					</td>
					<td id="moderators_content" valign="center" title="{$row_mod['last_name']}">
html;
							string_limiter($row_mod['last_name'],"13");
echo <<<html
					</td>
					<td id="moderators_content" valign="center" title="{$row_mod['email']}">
html;
							string_limiter($row_mod['email'],"20");
echo <<<html
					</td>
					<td id="moderators_content" valign="center" title="{$row_mod['depart_id']}">
html;
							string_limiter($row_mod['depart_id'],"13");
echo <<<html
					</td>
					<td id="moderators_content" valign="center">
						dd
					</td>
					<td align="center" id="moderators_contentlast">
html;
						if($row_mod['status']=="1"){
echo <<<html
							<input type="submit" class="moderators_switch_e" name="moderators_switch" value="{$row_mod['id']}">
html;
						}else{
echo <<<html
							<input type="submit" class="moderators_switch_d" name="moderators_switch" value="{$row_mod['id']}">
html;
						}
echo <<<html
							<input type="submit" class="moderators_delete" name="moderators_delete" value="{$row_mod['id']}">
					</td>
				</tr>
html;
			$id++;
			}
echo <<<html
			</form>
			</table>
		</td>
	</tr>
	<tr><td colspan="3" height="5"><td></tr>
	<tr>
		<td colspan="3" id="moderators_add" align="right">
			<a href="index.htm" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_title0'][$_SESSION['lang']]}' })"><img src="images/add.png"></a>
			<div class="highslide-maincontent">
				<form method="post" enctype="multipart/form-data">	
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
						<tr>
							<td id="moderators_iinfo">
								{$LANG['login_uname'][$_SESSION['lang']]}
							</td>
							<td width="180">
								<input type="text" id="moderators_username" name="username" >
							</td>
							<td>&nbsp;</td>
						</tr>
						<tr><td colspan="3" height="5"></td></tr>
						<tr>
							<td id="moderators_iinfo">
								{$LANG['login_passwd'][$_SESSION['lang']]}
							</td>
							<td>
								<input type="password" id="moderators_password" name="password" >
							</td>
							<td></td>
						</tr>
						<tr><td colspan="3" height="12" valign="center" id="moderators_hr"></td></tr>
						<tr>
							<td colspan="3">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
									<tr>
										<td id="moderators_iinfo2">
											{$LANG['admin_lang6'][$_SESSION['lang']]}
										</td>
										<td id="moderators_iinfo2">
											{$LANG['admin_lang8'][$_SESSION['lang']]}
										</td>
										<td id="moderators_iinfo2">
											{$LANG['admin_lang7'][$_SESSION['lang']]}
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" id="moderators_additional" name="first_name" >
										</td>
										<td>
											<input type="text" id="moderators_additional" name="last_name" >
										</td>
										<td>
											<input type="text" id="moderators_additional" name="patronymic" >
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td colspan="3" height="12" valign="center" id="moderators_hr"></td></tr>
						<tr>
							<td colspan="3">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
									<tr>
										<td id="moderators_iinfo2">
											{$LANG['admin_lang9'][$_SESSION['lang']]}
										</td>
										<td id="moderators_iinfo2" colspan="2">
											{$LANG['admin_lang11'][$_SESSION['lang']]}
										</td>
									</tr>
									<tr>
										<td height="130" align="center">
											<div class="moderators_button">
												<div id="moderators_fupload">{$LANG['admin_lang10'][$_SESSION['lang']]}</div>
												<input type="file" name="image_file" id="moderators_file" size="1">
											</div>
										</td>
										<td colspan="2" valign="top">
											<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
												<tr>
													<td valign="top" align="right" height="22">
														<input type="text" id="moderators_email" name="email" >
													<td/>
												</tr>
												<tr>
													<td height="30" id="moderators_input">
														<input type="radio" id="r1" name="prior" onclick="chradioEnableSubmit(this.value)" value="1"/>
														<label for="r1"><span></span>Մոդերատոր</label>
														<input type="radio" id="r2" name="prior" onclick="chradioEnableSubmit(this.value)" value="0" checked/>
														<label for="r2"><span></span>Ադմինիստրատոր</label>
													</td>
												</tr>
												<tr>
													<td id="moderators_iinfo2">
														{$LANG['admin_lang12'][$_SESSION['lang']]}
													</td>
												</tr>
												<tr>
													<td id="moderators_iinfo2">
														<select id="moderators_depart" type="text" name="depart" disabled>
html;
															while(( $row_mod_dep=mysql_fetch_assoc($r_mod_dep))!=false){
echo <<<html
															<option value="{$row_mod_dep['id']}">{$row_mod_dep[$dep_lan]}</option>
html;
															}
echo <<<html
														</select>
													<td/>
												</tr>
												<tr>
													<td>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								
							</td>
						</tr>
						<tr>
							<td colspan="3">
								<input type="image" src="images/add_buttons_{$_SESSION[lang]}.png" id="moderators_add_buttons" name="add_moderator" onMouseOver=this.src='images/add_buttonsa_{$_SESSION[lang]}.png' onMouseOut=this.src='images/add_buttons_{$_SESSION[lang]}.png'>
								<input type="hidden" name="add_mod" value="enter">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="3" height="24">
html;
		for($page=1; $page<=$i_pageing; $page++){
				if ($_SESSION['page']==$page){
echo <<<html
					<div id="pageing_numbers_active">{$page}</div>
html;
				}else {
echo <<<html
					<a href="?go={$_GET['go']}&page={$page}"><div id="pageing_numbers">{$page}</div></a>
html;
				}	
			}
echo <<<html

		</td>
	</tr>
</table>
html;
?>