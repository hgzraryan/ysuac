<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_chairs="SELECT * FROM {$CONF['dbtable']['units']} WHERE t_id='3' ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_chairs=mysql_query($q_chairs,$CONN);

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
					<td>
						&nbsp;
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
			while(($row_chairs=mysql_fetch_assoc($r_chairs))!=false){
echo <<<html
				<tr><td colspan="5" height="5"><td></tr>
				<tr>
					<td id="moderators_contentid" align="center" valign="center">
							<a href="?go=chairs&chid={$row_chairs['id']}&lang=am">{$id}</a>
					</td>
					<td id="departments_content" valign="center" title="{$row_chairs['fac_am']}">
						<div style="width:7px;height:10px;background-color:#{$row_chairs['color']};position:absolute;margin-top:3px;float:left;"></div>
							<a href="?go=chairs&chid={$row_chairs['id']}&lang=am">
html;
							string_limiter($row_chairs['fac_am'],"19");
echo <<<html
							</a>
					</td>
					<td id="departments_content" valign="center" title="{$row_chairs['fac_ru']}">
						<a href="?go=chairs&chid={$row_chairs['id']}&lang=ru">
html;
							string_limiter($row_chairs['fac_ru'],"19");
echo <<<html
						</a>
					</td>
					<td id="departments_content" valign="center" title="{$row_chairs['fac_en']}">
						<a href="?go=chairs&chid={$row_chairs['id']}&lang=en">
html;
							string_limiter($row_chairs['fac_en'],"19");
echo <<<html
						</a>
					</td>
					<td id="departments_content" valign="center" title="{$row_chairs['fac_fr']}">	
						<a href="?go=chairs&chid={$row_chairs['id']}&lang=fr">
html;
							string_limiter($row_chairs['fac_fr'],"19");
echo <<<html
						</a>
					</td>
					<td id="moderators_contentlast">
html;
						if($row_chairs['status']=="1"){
echo <<<html
							<input type="submit" class="moderators_switch_e" name="chairs_switch" value="{$row_chairs['id']}">
html;
						}else{
echo <<<html
							<input type="submit" class="moderators_switch_d" name="chairs_switch" value="{$row_chairs['id']}">
html;
						}
echo <<<html
							<input type="submit" class="moderators_delete" name="chairs_delete" value="{$row_chairs['id']}">
					</td>
				</tr>
html;
			$id++;
			}
echo <<<html
			</table>
			</form>
		</td>
	</tr>
	<tr><td colspan="3" height="5"><td></tr>
	<tr>
		<td colspan="3" id="moderators_add" align="right">
			<a href="index.htm" onclick="return hs.htmlExpand(this, { headingText: '{$LANG['admin_title3'][$_SESSION['lang']]}' })"><img src="images/add.png"></a>
			<div class="highslide-maincontent">
				<form method="post">	
					<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
						<tr>
							<td id="departments_textbox">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" align="center">
									<tr>
										<td id="departments_iinfo2">
											{$LANG['admin_lang23'][$_SESSION['lang']]}
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" name="chairs_email">
										</td>
									</tr>	
									<tr>
										<td id="departments_iinfo2">
											{$LANG['admin_lang2'][$_SESSION['lang']]}
										</td>
									</tr>
									<tr>
										<td>
											<input type="text" name="chairs_arm">
										</td>
									</tr>	
									<tr>	
										<td id="departments_iinfo2">
											{$LANG['admin_lang3'][$_SESSION['lang']]}
										</td>
									</tr>	
										<td>
											<input type="text" name="chairs_rus">
										</td>
									</tr>
									<tr>	
										<td id="departments_iinfo2">
											{$LANG['admin_lang4'][$_SESSION['lang']]}
										</td>
									</tr>	
										<td>
											<input type="text" name="chairs_eng">
										</td>
									</tr>
									<tr>	
										<td id="departments_iinfo2">
											{$LANG['admin_lang5'][$_SESSION['lang']]}
										</td>
									</tr>	
									<tr>
										<td>
											<input type="text" name="chairs_fra">
										</td>
									</tr>
										<tr>	
										<td id="departments_iinfo2">
											{$LANG['admin_lang24'][$_SESSION['lang']]}
										</td>
									</tr>	
									<tr>
										<td align="left" id="units_colchbox">
											<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
												<tr>
													<td width="48">
														<div id="units_headcol1"></div>
													</td>
													<td width="15" align="center" valign="center">
														<input type="radio" name="chairs_color" value="cccccc" checked>
													</td>
													<td width="12"></td>
													<td width="48" >
														<div id="units_headcol2"></div>
													</td>
													<td width="15" align="center" valign="center">
														<input type="radio" name="chairs_color" value="99cc66">
													</td>
													<td width="12"></td>
													<td width="48">
														<div id="units_headcol3"></div>
													</td>
													<td width="15" align="center" valign="center">
														<input type="radio" name="chairs_color" value="8482e7">
													</td>
													<td width="12"></td>
													<td width="48">
														<div id="units_headcol4"></div>
													</td>
													<td width="15" align="center" valign="center">
														<input type="radio" name="chairs_color" value="62aeea">
													</td>
													<td width="12"></td>
													<td width="48">
														<div id="units_headcol5"></div>
													</td>
													<td width="15" align="center" valign="center">
														<input type="radio" name="chairs_color" value="bb77fe">
													</td>	
													<td width="12"></td>
													<td width="48">
														<div id="units_headcol6"></div>
													</td>
													<td width="15" align="center" valign="center">
														<input type="radio" name="chairs_color" value="fe8258">
													</td>
													<td>&nbsp;</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td height="10"></td>
									</tr>
								</table>
							</td>
						</tr>
						<tr><td height="5"></td></tr>
						<tr>
							<td colspan="3">
								<input type="image" src="images/add_buttons_{$_SESSION[lang]}.png" id="departments_add_buttons" name="add_chairs" onMouseOver=this.src='images/add_buttonsa_{$_SESSION[lang]}.png' onMouseOut=this.src='images/add_buttons_{$_SESSION[lang]}.png'>
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