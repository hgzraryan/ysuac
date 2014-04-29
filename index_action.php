<?php
if ($INCLUDE!="allow"){
	session_destroy();
	header("location:http://{$_SERVER['SERVER_NAME']}");
	exit();
}
@include_once("function_validate.php");
############################# language #########################
if ( !isset($_SESSION['lang']) ){
	$_SESSION['lang']="am";
}
if ( $_GET['lang']=="fr" || $_GET['lang']=="en" || $_GET['lang']=="ru" || $_GET['lang']=="am"){	
	$_SESSION['lang']=$_GET['lang'];
}
if($_GET['did']){
	$_SESSION['did']=$_GET['did'];
}else{
	$_SESSION['did']=$_SESSION['did'];
}
if($_GET['fid']){
	$_SESSION['fid']=$_GET['fid'];
}else{
	$_SESSION['fid']=$_SESSION['fid'];
}
if($_GET['cid']){
	$_SESSION['cid']=$_GET['cid'];
}else{
	$_SESSION['cid']=$_SESSION['cid'];
}

if($_GET['mod']){
	$_SESSION['mod']=$_GET['mod'];
}else{
	$_SESSION['mod']=$_SESSION['mod'];
}
################################################################
$_GLANG="news_".$_SESSION['lang'];
$_BLANG="text_".$_SESSION['lang'];
$_DLANG="dep_".$_SESSION['lang'];
$_АLANG="announcements_".$_SESSION['lang'];
############################## search ##########################
if($_POST['search']){
	header("location:index.php?goto=search");
}
############################ news ##############################
if($_GET['goto']=="news"){
	if($_GET['id']){
		$q_news="SELECT * FROM {$CONF['dbtable'][$_GLANG]} WHERE id='{$_GET['id']}' AND status='1' ORDER BY id DESC";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$r_news=mysql_query($q_news,$CONN);
		$row_news=mysql_fetch_assoc($r_news);
		
		$q_morenews="SELECT * FROM {$CONF['dbtable'][$_GLANG]} WHERE id!='{$_GET['id']}' AND status='1' ORDER BY id DESC LIMIT 6";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$r_morenews=mysql_query($q_morenews,$CONN);
	}else{
		$q_news="SELECT * FROM {$CONF['dbtable'][$_GLANG]}  WHERE status='1' ORDER BY id DESC";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$r_news=mysql_query($q_news,$CONN);
		$row_news=mysql_fetch_assoc($r_news);
		
		$q_morenews="SELECT * FROM {$CONF['dbtable'][$_GLANG]} WHERE id!='{$row_news['id']}' AND status='1' ORDER BY id DESC LIMIT 6";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		$r_morenews=mysql_query($q_morenews,$CONN);
	}

	$_META['description']=$row_news['news_title'];
}else{
	$_META['description']="ՃԱՐՏԱՐԱՊԵՏՈՒԹՅԱՆ ԵՎ ՇԻՆԱՐԱՐՈՒԹՅԱՆ ՀԱՅԱՍՏԱՆԻ ԱԶԳԱՅԻՆ ՀԱՄԱԼՍԱՐԱՆ, ԵՐԵՎԱՆԻ ՃԱՐՏԱՐԱՊԵՏՈՒԹՅԱՆ ԵՎ  ՇԻՆԱՐԱՐՈՒԹՅԱՆ ՊԵՏԱԿԱՆ ՀԱՄԱԼՍԱՐԱՆ";
}
################################################################

############################# pages ############################
#pre (validate($_GET['goto'], "get" ));
if ( $_GET['goto']){
	if( validate($_GET['goto'], "get" )){
		if (  $ALLOWED_PAGES[$_GET['goto']] ) {
			if($_GET['goto']=="exit"){
				session_destroy();
				session_write_close();
				header("location:index.php");
				exit();
			}	
			$_SESSION['goto']=$_GET['goto'];
		}else{
			$_SESSION['goto']="error";
		}	
	}else{		
		$_SESSION['goto']="error";	
	}
}else{	
	$_SESSION['goto']="home";
}
################################################################
######################### active buttons #######################
if ($_SESSION['goto']=="home" || $_SESSION['goto']=="news" || $_SESSION['goto']=="news_archive"  || $_SESSION['goto']=="announcements"){
	$style_home="active_home";
} else {
	$style_home="home";
}
if ($_SESSION['goto']=="masters_degree" || 
	$_SESSION['goto']=="foreign_entrant" || 
	$_SESSION['goto']=="postgraduate_degree" || 
	$_SESSION['goto']=="high_school" ||
	$_SESSION['goto']=="distance_learning" ||
	$_SESSION['goto']=="construction_college" ||
	$_SESSION['goto']=="entry_course"
	){
	$style_applicant="active_applicant";
} else {
	$style_applicant="applicant";
}
if ($_SESSION['goto']=="bologna"){
	$style_bologna="active_bologna";
} else {
	$style_bologna="bologna";
}
if ($_SESSION['goto']=="library"|| 
	$_SESSION['goto']=="bulletin"){
	$style_library="active_library";
} else {
	$style_library="library";
}
if ($_SESSION['goto']=="our_data"){
	$style_our_data="active_our_data";
} else {
	$style_our_data="our_data";
}
if ($_SESSION['goto']=="faculties"
 || $_SESSION['goto']=="departments"
 || $_SESSION['goto']=="d_module"
 || $_SESSION['goto']=="c_module"
 || $_SESSION['goto']=="management_board"
 || $_SESSION['goto']=="rector"
 || $_SESSION['goto']=="chairs"
 || $_SESSION['goto']=="units"
 || $_SESSION['goto']=="scientific_council"
 || $_SESSION['goto']=="f_module1"
 || $_SESSION['goto']=="alumni"
 || $_SESSION['goto']=="menu_history"
 ){
	$style_our_university="active_our_university";
} else {
	$style_our_university="our_university";
}
################ navbar active buttons ###############33
if ($_SESSION['goto']=="photo_gallery" || $_SESSION['goto']=="gallery_view"){
	$style_pg="headerbar1_active";
} else {
	$style_pg="headerbar1";
}
if ($_SESSION['goto']=="work_archive"){
	$style_wa="headerbar1_active";
} else {
	$style_wa="headerbar1";
}
if ($_SESSION['goto']=="newspaper"){
	$style_np="headerbar1_active";
} else {
	$style_np="headerbar1";
}
if ($_SESSION['goto']=="press_about"){
	$style_pa="headerbar1_active";
} else {
	$style_pa="headerbar1";
}
if ($_SESSION['goto']=="high_school"){
	$style_hs="headerbar1_active";
} else {
	$style_hs="headerbar1";
}
if ($_SESSION['goto']=="astghik_club"){
	$style_ac="headerbar1_active";
} else {
	$style_ac="headerbar1";
}
if ($_SESSION['goto']=="alumni"){
	$style_al="headerbar1_active";
} else {
	$style_al="headerbar1";
}
if ($_SESSION['goto']=="students_progress"){
	$style_sp="headerbar1_active";
} else {
	$style_sp="headerbar1";
}
if ($_SESSION['goto']=="science" ||
	$_SESSION['goto']=="scientific_publications"
){
	$style_sc="headerbar1_active";
} else {
	$style_sc="headerbar1";
}
if ($_SESSION['goto']=="specialized_council"){
	$style_sco="headerbar1_active";
} else {
	$style_sco="headerbar1";
}
if ($_SESSION['goto']=="buy_store"){
	$style_buy="headerbar1_active";
} else {
	$style_buy="headerbar1";
}

#################################################################################
if($_SESSION['lang']=="am"){
	$db_lang="armenian";
}elseif($_SESSION['lang']=="ru"){
	$db_lang="russian";
}elseif($_SESSION['lang']=="en"){
	$db_lang="english";
}elseif($_SESSION['lang']=="fr"){
	$db_lang="france";
}
$q_sitelang="SELECT description, {$db_lang} FROM {$CONF['dbtable']['site_str_languages']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitelang=mysql_query($q_sitelang,$CONN);
while( ($row_sitelang=mysql_fetch_assoc($r_sitelang))!=false){
	$_SLD[$row_sitelang['description']]=$row_sitelang['description'];
	$_SL[$row_sitelang['description']]=$row_sitelang[$db_lang];
}


$q_sitetop="SELECT id, news_title, news_date FROM {$CONF['dbtable'][$_GLANG]}  WHERE top='1' AND status='1' ORDER by news_date DESC";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitetop=mysql_query($q_sitetop,$CONN);

$q_sitetop1="SELECT id, title, upload_date FROM {$CONF['dbtable'][$_АLANG]}  WHERE top='1' AND status='1' ORDER by upload_date DESC";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_sitetop1=mysql_query($q_sitetop1,$CONN);

#######################################################################################

################################################################
if (!empty($_REQUEST['captcha'])) {
    if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha']))!= $_SESSION['captcha']) {
		# echo "bad";
    } else {
#----------------------------- message send ----------------------------------
		$q_smail="SELECT email FROM {$CONF['dbtable']['units']} WHERE id='{$_POST['our_data_section']}'";
		$r_smail=mysql_query($q_smail,$CONN);
		$row_smail=mysql_fetch_assoc($r_smail);
		$to  = $row_smail['email']; 
		$subject = "ysuac.am հետադարձ կապ"; 
		$message = "
		<html> 
			<head> 
				<title>ysuac.am հետադարձ կապ</title>
			</head> 
			<body> 
				<p style='color:#333;'>Հետադարձ կապ է հաստատել <b>".$_POST['our_data_name']."</b></p> 
				<p style='color:#333;'><b>".$_POST['our_data_name']."</b>-ի էլեկտրոնային հասցեն է` ".$_POST['our_data_email']."</p> 
				<p style='color:#333;'><b>".$_POST['our_data_name']."</b>-ը գրում է</p> 
				<div style='width:500px; height:300px; background-color:#f3f3f3;padding:10px'>".$_POST['our_data_content']."</div>
			</body> 
		</html>"; 
		$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
		$headers .= "From: Հետադարձ կապ\r\n"; 
		$headers .= "Bcc: web@ysuac.am\r\n"; 

		mail($to, $subject, $message, $headers);

		header("location:index.php?goto=mail_send");
#-----------------------------------------------------------------------------	
    }
    unset($_SESSION['captcha']);
}
################################################################
if($_SESSION['goto']=="home" && validate($_SESSION['goto'], "get") && $_SESSION['lang']=="am"){
	$_SESSION['view_on_page']=7;
	$_SESSION['view_pages']=10;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['news_am']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
if($_SESSION['goto']=="home" && validate($_SESSION['goto'], "get") && $_SESSION['lang']=="ru"){
	$_SESSION['view_on_page']=4;
	$_SESSION['view_pages']=9;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['news_ru']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
if($_SESSION['goto']=="home" && validate($_SESSION['goto'], "get") && $_SESSION['lang']=="en"){
	$_SESSION['view_on_page']=4;
	$_SESSION['view_pages']=9;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['news_en']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
if($_SESSION['goto']=="home" && validate($_SESSION['goto'], "get") && $_SESSION['lang']=="fr"){
	$_SESSION['view_on_page']=4;
	$_SESSION['view_pages']=9;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['news_fr']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
#-------------------------------------- news pageing ---------------------------------------------
if($_SESSION['goto']=="news_archive" && validate($_SESSION['goto'], "get")){
	$_SESSION['view_on_page']=20;
	$_SESSION['view_pages']=30;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable'][$_GLANG]}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
#--------------------------------------------------------------------------------------------------
#-------------------------------------- gallery pageing ---------------------------------------------
if($_SESSION['goto']=="photo_gallery" && validate($_SESSION['goto'], "get")){
	$_SESSION['view_on_page']=9;
	$_SESSION['view_pages']=10;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['gallery_category']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
if($_SESSION['goto']=="gallery_view" && validate($_SESSION['goto'], "get")){
	$_SESSION['view_on_page']=20;
	$_SESSION['view_pages']=10;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['wallpapers']} WHERE cat='{$_GET['gid']}'";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
#--------------------------------------------------------------------------------------------------
if($_SESSION['goto']=="gallery_view" && !$_GET['gid']){
	$_SESSION['gid']=1;
	$_SESSION['goto']="photo_gallery";
}else{
	$_SESSION['gid']=$_GET['gid'];
}
#--------------------------------------------------------------------------------------------------
#-------------------------------------- announcements---------------------------------------------
if($_SESSION['goto']=="announcements_archive" && validate($_SESSION['goto'], "get")){
	$_SESSION['view_on_page']=40;
	$_SESSION['view_pages']=10;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable'][$_ALANG]}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
	if(	$_SESSION['view_pages']>=$i_pageing){
		$_SESSION['view_pages']=$i_pageing;
	}
}
#--------------------------------------------------------------------------------------------------
?>