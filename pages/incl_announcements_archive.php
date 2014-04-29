<?php

$p_pageing=($_SESSION['page']-1)*$_SESSION['view_on_page'];
$j_pageing=$_SESSION['view_on_page'];
$q_allannouncements="SELECT * FROM {$CONF['dbtable'][$_АLANG]} WHERE status='1' ORDER BY id DESC LIMIT {$p_pageing}, {$j_pageing}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_allannouncements=mysql_query($q_allannouncements,$CONN);
echo <<<html
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
		<tr>
			<td height="20" valign="center" width="100">
				<div id="our_data_fhl"></div>
			</td>
			<td width="20"></td>
			<td id="our_data_title" valign="center" height="20">
				{$_SL['all_announcements']}
			</td>
		</tr>
		<tr><td colspan="3" height="15"></td></tr>
		<tr>
			<td colspan="3" valign="top" align="left">			
html;
				while(($row_allannouncements=mysql_fetch_assoc($r_allannouncements))!=false){
echo <<<html
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							
							<td id="home_announcements_addtitle1" valign="center" align="left">
								<a href="?goto=announcements&id={$row_allannouncements['id']}">
									{$row_allannouncements['title']}<br/>
								</a>
								<div id="home_news_adddatetime">
html;
									datetime($row_allannouncements['upload_date']);
echo<<<html
								</div>
							</td>
						</tr>
						<tr><td colspan="2" height="6"></td></tr>
					</table>
html;
				}
echo <<<html
			</td>
		</tr>
		<tr><td colspan="3" height="10"></td></tr>
		<tr>
			<td height="24" id="pageing_constr" colspan="3" align="left">
html;



#----------------------------------------------------------------------------------
	if($i_pageing>=2){
		if($_SESSION['page']!=1){
			$next_page=$_SESSION['page']-1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&page={$next_page}#pageing_constr"><div id="pageing_preview"></div></a>
html;
		}else{
echo <<<html
			<div id="pageing_preview_active"></div>
html;
		}

#----------------------------------------------------------------------------------
#-------------------------------- pageing --------------------------------------------------
		for($page=1; $page<=$i_pageing; $page++){
			if($page<=$_SESSION['view_pages']){
				if ($_SESSION['page']==$page){
echo <<<html
					<div id="pageing_numbers_active">{$page}</div>
html;
				}else {
echo <<<html
					<a href="?goto={$_SESSION['goto']}&page={$page}#pageing_constr"><div id="pageing_numbers">{$page}</div></a>
html;
				}
			}			
		}
#----------------------------------------------------------------------------------
#------------------------------ next ----------------------------------------------------
		if($_SESSION['page']<=$_SESSION['view_pages']-1){
			$next_page=$_SESSION['page']+1;
echo <<<html
			<a href="?goto={$_SESSION['goto']}&page={$next_page}#pageing_constr"><div id="pageing_next"></div></a>
html;
		}else{
echo <<<html
			<div id="pageing_next_active"></div>
html;
		}
	}
#----------------------------------------------------------------------------------
echo <<<html
			</td>
		</tr>	
		<tr><td colspan="2" height="100%"></td></tr>
		<tr><td colspan="2" height="10"></td></tr>
	</table>
html;
?>