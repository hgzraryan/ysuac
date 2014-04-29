<?php
ini_set("memory_limit", "256M");
ini_set('upload_max_filesize', "7M");
ini_set('post_max_size', "7M");



header('Content-type:text/html; charset=utf-8');
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$INCLUDE="allow";
@include_once("../function_validate.php");
@include_once("../conf.php");
@include_once("../dbcfg.php");
#pre($_POST);
#pre($_SESSION);
########################### admin pages #####################
if ( $_GET['go'] ) 
	{
		if(validate($_GET['go'], "get")){
			if (  $ALLOWED_PAGES_ADMIN[$_GET['go']] ) {
				if($_GET['go']=="exit"){
					session_destroy();
					session_write_close();
					header("location:index.php");
					exit();	
				}
				$_SESSION['go']=$_GET['go'];
			}else{
				$_SESSION['go']="error";
			}
		} else {
			$_SESSION['go']="error";	
		}
	} else {	
		$_SESSION['go']="home";
}
if ( !isset($_SESSION['lang']) ){
	$_SESSION['lang']="am";
}
if ( $_GET['lang']=="am" || $_GET['lang']=="ru" || $_GET['lang']=="en" || $_GET['lang']=="fr"){
	$_SESSION['lang']=$_GET['lang'];
}
############################################################
########################### admin sub pages ################
if ( $_GET['sub'] ) {
		if(validate($_GET['sub'], "get")){
			if (  $ALLOWED_SUBPAGES_ADMIN[$_GET['sub']] ) {
				if($_GET['go']=="exit"){
					session_destroy();
					session_write_close();
					header("location:index.php");
					exit();	
				}
				$_SESSION['sub']=$_GET['sub'];
			}else{
				$_SESSION['sub']="error";
			}
		} else {
			$_SESSION['sub']="error";	
		}
		$lang_get="&sub=".$_SESSION['sub'];
	} else{	
		if($_SESSION['go']=="admin_system"){
			$_SESSION['sub']="moderators";
		}elseif($_SESSION['go']=="our_university"){
			$_SESSION['sub']="board_staff";
		}elseif($_SESSION['go']=="for_applicant"){
			$_SESSION['sub']="foreign_entrant";
		}elseif($_SESSION['go']=="int_coo"){
			$_SESSION['sub']="int_contacts";
		}elseif($_SESSION['go']=="030_spec"){
			$_SESSION['sub']="specialized_council";
		}elseif($_SESSION['go']=="our_partners"){
			$_SESSION['sub']="constructors_union";
		}elseif($_SESSION['go']=="legal_acts"){
			$_SESSION['sub']="order_mse";
		}elseif($_SESSION['go']=="departments"){
			$_SESSION['sub']="dep_history";
		}elseif($_SESSION['go']=="faculties"){
			$_SESSION['sub']="fac_history";
		}elseif($_SESSION['go']=="chairs"){
			$_SESSION['sub']="ch_history";
		}elseif($_SESSION['go']=="alumni"){
			$_SESSION['sub']="alumni_home";
		}elseif($_SESSION['go']=="library"){
			$_SESSION['sub']="bulletin";
		}else{
			$_SESSION['sub']="news";
		}
}
############################################################




#---------------- global values ----------------
$date=date("Y-m-d H:i:s");
$news_lang="news_".$_SESSION['lang'];
$text_lang="text_".$_SESSION['lang'];
$dep_lang="departments_".$_SESSION['lang'];
$fac_lang="faculties_".$_SESSION['lang'];
$ch_lang="chairs_".$_SESSION['lang'];
$announcements_lang="announcements_".$_SESSION['lang'];
#-----------------------------------------------
#--------------------------------- visitor log --------------------------------
if($_SESSION['ysuac_admin_id']){
	if(!$_SESSION['key']){
		$ip_addr=$_SERVER['REMOTE_ADDR'];
		$log_id=$_SESSION['ysuac_admin_id'];
		$info=$_SERVER['HTTP_USER_AGENT'];
		$q_vis="INSERT INTO {$CONF['dbtable']['admin_vislog']} SET ip_address='{$ip_addr}', vis_id='{$log_id}', date='{$date}', info='{$info}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q_vis,$CONN);
		$_SESSION['key']="deny";
	}
}
#-----------------------------------------------------------------------------
#-------------------------------- select visitors -----------------------------
$q_selv="SELECT * FROM {$CONF['dbtable']['admin_vislog']} WHERE id=( ( SELECT MAX(id) FROM {$CONF['dbtable']['admin_vislog']} )-1 )";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_selv=mysql_query($q_selv,$CONN);
while( ($row_selv=mysql_fetch_assoc($r_selv))!=false ){
	#pre($row_selv);
	$vip=$row_selv['ip_address'];
	$vis_date=$row_selv['date'];
	#pre($row_selv);
}
#------------------------------------------------------------------------------------
#----------------------------------- moderators add --------------------------------
if($_POST['add_moderator_x'] && validate($_POST['add_moderator_x'], "num")){
	$username=md5($_POST['username']);
	$password=md5($_POST['password']);
	if($_POST['depart']==null){
		$depart="0";
	}else{
		$depart=$_POST['depart'];
	}
	$q_mod="INSERT INTO {$CONF['dbtable']['admin_premoderators']} SET 
	first_name='".addslashes($_POST['first_name'])."',
	name='".addslashes($_POST['patronymic'])."',
	last_name='".addslashes($_POST['last_name'])."',
	admin_avatar='',
	email='".addslashes($_POST['email'])."',
	username='".addslashes($_POST['username'])."',
	username_md5='{$username}',
	password_md5='{$password}',
	group_id='".addslashes($_POST['prior'])."',
	depart_id='{$depart}',
	date='{$date}',
	status='0'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q_mod,$CONN);
}
#------------------------------------------------------------------------------------
#----------------------------------- moderators switcher (on,off) --------------------------------
if($_POST['moderators_switch'] && validate($_POST['moderators_switch'], "num")){
	$q_nswitch="SELECT status FROM {$CONF['dbtable']['admin_premoderators']} WHERE id='".addslashes($_POST['moderators_switch'])."'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable']['admin_premoderators']} SET status='0' WHERE id='".addslashes($_POST['moderators_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable']['admin_premoderators']} SET status='1' WHERE id='".addslashes($_POST['moderators_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#---------------------------------------------------------------------------------------
#----------------------------------- moderators delete --------------------------------
if($_POST['moderators_delete'] && validate($_POST['moderators_delete'], "num")){
	$q="DELETE FROM {$CONF['dbtable']['admin_premoderators']} WHERE id='".addslashes($_POST['moderators_delete'])."'";
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------
#--------------------- moderators pageing ----------------------------------
if($_SESSION['sub']=="moderators" && validate($_SESSION['go'], "get")){
	$_SESSION['view_on_page']=13;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['admin_premoderators']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#----------------------------------------------------------------
#--------------------------- faculity add ----------------------------------
if($_POST['add_faculity_x'] && validate($_POST['add_faculity_x'], "num")){
	
	$q_fac="INSERT INTO {$CONF['dbtable']['units']} SET 
	fac_am='".addslashes($_POST['fac_arm'])."',
	fac_ru='".addslashes($_POST['fac_rus'])."',
	fac_en='".addslashes($_POST['fac_eng'])."',
	fac_fr='".addslashes($_POST['fac_fra'])."',
	status='0',
	email='".addslashes($_POST['fac_email'])."',
	color='".addslashes($_POST['faculty_color'])."',
	t_id='1'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q_fac,$CONN);
}
#----------------------------------------------------------------
#--------------------- faculity pageing ----------------------------------
if($_SESSION['sub']=="faculity" && validate($_SESSION['go'], "get")){
	$_SESSION['view_on_page']=13;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['units']} WHERE t_id='1'";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#----------------------------------------------------------------
#----------------------------------- faculity switcher (on,off) --------------------------------
if($_POST['faculity_switch'] && validate($_POST['faculity_switch'], "num")){
	$q_nswitch="SELECT status FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['faculity_switch'])."' AND t_id='1'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='0' WHERE id='".addslashes($_POST['faculity_switch'])."' AND t_id='1'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='1' WHERE id='".addslashes($_POST['faculity_switch'])."' AND t_id='1'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#---------------------------------------------------------------------------------------
#----------------------------------- faculity delete --------------------------------
if($_POST['faculity_delete'] && validate($_POST['faculity_delete'], "num")){
	$q="DELETE FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['faculity_delete'])."' AND t_id='1'";
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------
#---------------------------- chairs add ----------------------------------
if($_POST['add_chairs_x'] && validate($_POST['add_chairs_x'], "num")){
	
	$q_fac="INSERT INTO {$CONF['dbtable']['units']} SET 
	fac_am='".addslashes($_POST['chairs_arm'])."',
	fac_ru='".addslashes($_POST['chairs_rus'])."',
	fac_en='".addslashes($_POST['chairs_eng'])."',
	fac_fr='".addslashes($_POST['chairs_fra'])."',
	status='0',
	email='".addslashes($_POST['chairs_email'])."',
	color='".addslashes($_POST['chairs_color'])."',
	t_id='3'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q_fac,$CONN);
}
#----------------------------------------------------------------
#--------------------- chairs pageing ----------------------------------
if($_SESSION['sub']=="chairs" && validate($_SESSION['go'], "get")){
	$_SESSION['view_on_page']=30;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['units']} WHERE t_id='3'";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#----------------------------------------------------------------
#----------------------------------- chairs switcher (on,off) --------------------------------
if($_POST['chairs_switch'] && validate($_POST['chairs_switch'], "num")){
	$q_nswitch="SELECT status FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['chairs_switch'])."' AND t_id='3'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='0' WHERE id='".addslashes($_POST['chairs_switch'])."' AND t_id='3'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='1' WHERE id='".addslashes($_POST['chairs_switch'])."' AND t_id='3'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#---------------------------------------------------------------------------------------
#----------------------------------- chairs delete --------------------------------
if($_POST['chairs_delete'] && validate($_POST['chairs_delete'], "num")){
	$q="DELETE FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['chairs_delete'])."' AND t_id='3'";
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------
#--------------------------- departments add ----------------------------------
if($_POST['add_departments_x'] && validate($_POST['add_departments_x'], "num")){
		
	$q_dep="INSERT INTO {$CONF['dbtable']['units']} SET 
	fac_am='".addslashes($_POST['dep_arm'])."',
	fac_ru='".addslashes($_POST['dep_rus'])."',
	fac_en='".addslashes($_POST['dep_eng'])."',
	fac_fr='".addslashes($_POST['dep_fra'])."',
	status='0',
	email='".addslashes($_POST['dep_email'])."',
	color='".addslashes($_POST['departments_color'])."',
	t_id='2'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q_dep,$CONN);
	
}
#----------------------------------------------------------------
#--------------------- departments pageing ----------------------------------
if($_SESSION['sub']=="departments" && validate($_SESSION['go'], "get")){
	$_SESSION['view_on_page']=13;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['units']} WHERE t_id='2'";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#----------------------------------------------------------------
#----------------------------------- departments switcher (on,off) --------------------------------
if($_POST['departments_switch'] && validate($_POST['departments_switch'], "num")){
	$q_nswitch="SELECT status FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['departments_switch'])."' AND t_id='2'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='0' WHERE id='".addslashes($_POST['departments_switch'])."' AND t_id='2'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='1' WHERE id='".addslashes($_POST['departments_switch'])."' AND t_id='2'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#---------------------------------------------------------------------------------------
#----------------------------------- departments delete -------------------------------- ditarkel bolor tableneric jnjelu tarberaky
if($_POST['departments_delete'] && validate($_POST['departments_delete'], "num")){
	$q="DELETE FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['departments_delete'])."' AND t_id='2'";
	mysql_query($q,$CONN);
	
	$q_del="DELETE FROM {$CONF['dbtable']['departments_am']} WHERE department_description='".addslashes($_POST['departments_delete'])."' ";
	mysql_query($q_del,$CONN);
	#echo $q_del;
}
#---------------------------------------------------------------------------------------
#---------------------------- units add ----------------------------------
if($_POST['add_units_x'] && validate($_POST['add_units_x'], "num")){
	
	$q_units="INSERT INTO {$CONF['dbtable']['units']} SET 
	fac_am='".addslashes($_POST['units_arm'])."',
	fac_ru='".addslashes($_POST['units_rus'])."',
	fac_en='".addslashes($_POST['units_eng'])."',
	fac_fr='".addslashes($_POST['units_fra'])."',
	status='0',
	email='".addslashes($_POST['units_email'])."',
	color='".addslashes($_POST['units_color'])."',
	t_id='4'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q_units,$CONN);
}
#----------------------------------------------------------------
#--------------------- units pageing ----------------------------------
if($_SESSION['sub']=="units" && validate($_SESSION['go'], "get")){
	$_SESSION['view_on_page']=13;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['units']} WHERE t_id='4'";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#----------------------------------------------------------------
#----------------------------------- units switcher (on,off) --------------------------------
if($_POST['units_switch'] && validate($_POST['units_switch'], "num")){
	$q_nswitch="SELECT status FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['units_switch'])."' AND t_id='4'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='0' WHERE id='".addslashes($_POST['units_switch'])."' AND t_id='4'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable']['units']} SET status='1' WHERE id='".addslashes($_POST['units_switch'])."' AND t_id='4'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#---------------------------------------------------------------------------------------
#----------------------------------- units delete --------------------------------
if($_POST['units_delete'] && validate($_POST['units_delete'], "num")){
	$q="DELETE FROM {$CONF['dbtable']['units']} WHERE id='".addslashes($_POST['units_delete'])."' AND t_id='4'";
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------



#----------------------------------- Gallery category----------------------------------
#pre($_POST);
if($_POST['gallery_add_x'] && validate($_POST['gallery_add_x'], "post") ){
	$bac_g1=md5($LANG['admin_lang2'][$_SESSION['lang']]);
	$bac_g1a=md5($_POST['cat_title_am']);
	$bac_g2=md5($LANG['admin_lang3'][$_SESSION['lang']]);
	$bac_g2a=md5($_POST['cat_title_ru']);
	$bac_g3=md5($LANG['admin_lang4'][$_SESSION['lang']]);
	$bac_g3a=md5($_POST['cat_title_en']);
	$bac_g4=md5($LANG['admin_lang5'][$_SESSION['lang']]);
	$bac_g4a=md5($_POST['cat_title_fr']);
	if($bac_g1!=$bac_g1a && $bac_g2!=$bac_g2a && $bac_g3!=$bac_g3a && $bac_g4!=$bac_g4a ){
		if($_POST['cat_title_am'] && $_POST['cat_title_ru'] && $_POST['cat_title_en']){
			if($_SESSION['cat_image']){
				$cat_img=$_SESSION['cat_image'];
			}else{
				$cat_img="no_thumbnails.jpg";
			}
			$q_gall="INSERT INTO {$CONF['dbtable']['gallery_category']} SET 
			thumbnail='{$cat_img}', 
			title_am='".addslashes($_POST['cat_title_am'])."', 
			title_ru='".addslashes($_POST['cat_title_ru'])."', 
			title_en='".addslashes($_POST['cat_title_en'])."', 
			title_fr='".addslashes($_POST['cat_title_fr'])."',
			upload_date='{$date}', 
			info='{$_SESSION['ysuac_admin_id']}'";
			
			mysql_query($q_gall,$CONN);
			unset($_SESSION['cat_image']);
		}else{
			$admin_gerror="{$LANG['admin_wall_error'][$_SESSION['lang']]}";
		}
	}
}
#------------------------------------------------------------------------------
#----------------------------------- Galllery photo add----------------------------
if($_POST['add_wallpaper_x'] && validate($_POST['add_wallpaper_x'], "post")){
	$bac_w1=md5($LANG['admin_lang2'][$_SESSION['lang']]);
	$bac_w1a=md5($_POST['photo_amt']);
	$bac_w2=md5($LANG['admin_lang3'][$_SESSION['lang']]);
	$bac_w2a=md5($_POST['photo_rut']);
	$bac_w3=md5($LANG['admin_lang4'][$_SESSION['lang']]);
	$bac_w3a=md5($_POST['photo_ent']);
	$bac_w4=md5($LANG['admin_lang5'][$_SESSION['lang']]);
	$bac_w4a=md5($_POST['photo_frt']);
	if($bac_w1!=$bac_w1a && $bac_w2!=$bac_w2a && $bac_w3!=$bac_w3a && $bac_w4!=$bac_w4a){
		if($_GET['id'] && validate($_GET['id'], "get_num") && $_FILES['cat_wallpapers']['error']!=1){
			$datetime=date("YmdHis");
			list($usec)=explode(' ',microtime());
			$usec=substr($usec,2,6);
			$rand=mt_rand(10000000,99999999);
			$unical="{$datetime}_{$usec}_{$rand}";
			if ($_FILES['cat_wallpapers']['type']==="image/jpeg" || $_FILES['cat_wallpapers']['type']==="image/gif" || $_FILES['cat_wallpapers']['type']==="image/png" || $_FILES['cat_wallpapers']['type']==="image/pjpeg" || $_FILES['cat_wallpapers']['type']==="image/x-png"){
				if ($_FILES['cat_wallpapers']['type']==="image/jpeg"){
					$type="jpg";
				} elseif ($_FILES['cat_wallpapers']['type']==="image/gif"){
					$type="gif";
				} elseif ($_FILES['cat_wallpapers']['type']==="image/jpeg"){
					$type="jpg";
				} elseif ($_FILES['cat_wallpapers']['type']==="image/pjpeg"){
					$type="jpg";
				} elseif ($_FILES['cat_wallpapers']['type']==="image/x-png"){
					$type="png";
				}
				$img="{$unical}.{$type}";
				move_uploaded_file($_FILES['cat_wallpapers']['tmp_name'], "../images/photos/original/{$img}");
				$sha1=sha1_file("../images/photos/original/{$img}");
				$qsha="SELECT sha1 FROM {$CONF['dbtable']['wallpapers']} WHERE sha1='{$sha1}'";
				$rsha=mysql_query($qsha,$CONN);
				$rowsha=mysql_fetch_assoc($rsha);
				if ($rowsha!==false){
					$error="<span style='color:red; font-size:13px'>This file is uploaded</span>";
					unlink("../photos/{$img}");
				} else {
					if($_POST['photo_amt'] && $_POST['photo_rut'] && $_POST['photo_ent'] && $_POST['photo_frt']){
						$date=date("Y-m-d H:i:s");
						include_once("function_image_resize.php");
						include_once("function_image_quadrat.php");
						include_once("function_image_banner.php");
						include_once("function_watermark.php");
						$z=end(explode('.', "../images/photos/original/{$img}"));
						if($z=='jpg' || $z=='gif'){
							$str=file_get_contents("../images/photos/original/{$img}");
							$str1=image_resize($str,800,600, 100);
							file_put_contents("../images/photos/view/{$img}", $str1);
							$str=image_quadrat($str);
							$str1=image_resize($str,220,220, 100);
							file_put_contents("../images/photos/thumbnails/{$img}", $str1);
							$str_w=watermark("../images/photos/view/{$img}");
							file_put_contents("../images/photos/watermark/{$img}", $str_w);
							list($width, $height, $type, $attr) = getimagesize("../images/photos/original/{$img}");
							$size = @filesize("../images/photos/original/{$img}");
							$str=file_get_contents("../images/photos/original/{$img}");
							$info=$_SESSION['admin_fname']." ".$_SESSION['admin_lname'];
							$q="INSERT INTO {$CONF['dbtable']['wallpapers']} SET 
								cat='{$_GET['id']}',
								path='{$img}',
								block='0',
								name_am='".addslashes($_POST['photo_amt'])."', 
								name_ru='".addslashes($_POST['photo_rut'])."',
								name_en='".addslashes($_POST['photo_ent'])."',
								name_fr='".addslashes($_POST['photo_frt'])."',
								size='{$size}',
								resolution='{$width}-{$height}', 
								udatetime='{$date}', 
								priority='0',  
								info='{$info}', 
								sha1='{$sha1}' 
							";
							mysql_query($q,$CONN);
						}
					}
				}
			}
		}
	}	
}
#------------------------------------------------------------------------------
#----------------------------------- Delete category---------------------------
if($_GET['del'] && validate($_GET['del'], "num")){
	$q_cat_im="SELECT * FROM {$CONF['dbtable']['gallery_category']} WHERE id='".addslashes($_GET['del'])."'";
	$r_cat_im=mysql_query($q_cat_im,$CONN);
	$row_cat_im=mysql_fetch_assoc($r_cat_im);
	
	$q_cat_imw="SELECT * FROM {$CONF['dbtable']['wallpapers']} WHERE cat='{$row_cat_im['id']}'";
	$r_cat_imw=mysql_query($q_cat_imw,$CONN);
	while( ($row_cat_imw=mysql_fetch_assoc($r_cat_imw))!=false ){
		unlink("../images/photos/original/{$row_cat_imw['path']}");
		unlink("../images/photos/thumbnails/{$row_cat_imw['path']}");
		unlink("../images/photos/view/{$row_cat_imw['path']}");
		unlink("../images/photos/watermark/{$row_cat_imw['path']}");
	}
	
	$q_cat="DELETE FROM {$CONF['dbtable']['gallery_category']} WHERE id='".addslashes($_GET['del'])."'";
	mysql_query($q_cat,$CONN);
	unlink("../images/gallery_category/{$row_cat_im['thumbnail']}");
	
	$q_cat_wall="DELETE FROM {$CONF['dbtable']['wallpapers']} WHERE cat='".addslashes($_GET['del'])."'";
	mysql_query($q_cat_wall,$CONN);
}
#------------------------------------------------------------------------------
#----------------------------------- wallpapers delete ------------------------
if ( $_POST['wall_delete_x'] && $_POST['chbox']) {
	$q_wd="SELECT * FROM {$CONF['dbtable']['wallpapers']} WHERE id IN ( ";	
	foreach($_POST['chbox'] as $k => $v) {
		$a[]="'$k'";
	}
	$str=implode(",",$a);
	$q_wd.=$str." ) ";
	$r1_wd=mysql_query($q_wd,$CONN);
	while(($row_wd=mysql_fetch_assoc($r1_wd))!=false){
		unlink("../images/photos/original/{$row_wd['path']}");
		unlink("../images/photos/thumbnails/{$row_wd['path']}");
		unlink("../images/photos/view/{$row_wd['path']}");
		unlink("../images/photos/watermark/{$row_wd['path']}");
	}
	$q1="DELETE FROM {$CONF['dbtable']['wallpapers']} WHERE id IN (".$str.")";
	$r=mysql_query($q1,$CONN);
} else {
	$alert2="Select file to delete";
}
#------------------------------------------------------------------------------
#--------------------- admin_gallery_cat pageing ----------------------------------
if($_SESSION['go']=="gallery_cat" && validate($_SESSION['go'], "get")){
	$_SESSION['view_on_page']=10;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['wallpapers']} WHERE cat='".addslashes($_GET['id'])."'";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#----------------------------------------------------------------
#----------------------------------- gallery switcher (on,off) --------------------------------
if($_POST['gallery_switch']){
	$q_gswitch="SELECT block FROM {$CONF['dbtable']['wallpapers']} WHERE id='{$_POST['gallery_switch']}'";
	$r_gswitch=mysql_query($q_gswitch,$CONN);
	$row_gswitch=mysql_fetch_assoc($r_gswitch);
	if($row_gswitch['block']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable']['wallpapers']} SET block='0' WHERE id='{$_POST['gallery_switch']}'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable']['wallpapers']} SET block='1' WHERE id='{$_POST['gallery_switch']}'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#---------------------------------------------------------------------------------------
if($_POST['add_languageb_x']){
	$q_lang="INSERT INTO site_str_languages SET 
		description='".addslashes($_POST['lang_desci'])."', 
		armenian='".addslashes($_POST['lang_am'])."', 
		russian='".addslashes($_POST['lang_ru'])."', 
		english='".addslashes($_POST['lang_en'])."', 
		france='".addslashes($_POST['lang_fr'])."',
		date='{$date}'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q_lang,$CONN);
}
#-------------------------------- Language edit -------------------------------





if($_POST['edit_languageb']){
	$arm="lang_armenian".$_POST['edit_languageb'];
	$rus="lang_russian".$_POST['edit_languageb'];
	$eng="lang_english".$_POST['edit_languageb'];
	$fra="lang_france".$_POST['edit_languageb'];

	$q_ledit="UPDATE {$CONF['dbtable']['site_str_languages']} SET 
	armenian='".addslashes($_POST[$arm])."', 
	russian='".addslashes($_POST[$rus])."',
	english='".addslashes($_POST[$eng])."',
	france='".addslashes($_POST[$fra])."',
	date='{$date}'
	WHERE id='".addslashes($_POST['edit_languageb'])."'
	";
	$r_ledit=mysql_query($q_ledit,$CONN);
	
		#echo $q_ledit;

} 
#------------------------------------------------------------------------------ 
#------------------------------ Language delete -------------------------------
if($_POST['lang_delete_x']){
	if ( $_POST['lang_delete_x'] && $_POST['chbox']) {
		$q_ld="SELECT * FROM {$CONF['dbtable']['site_str_languages']} WHERE id IN ( ";	
		foreach($_POST['chbox'] as $k => $v) {
			$a[]="'$k'";
		}
		$str=implode(",",$a);
		$q_ld.=$str." ) ";
		$r1_ld=mysql_query($q_ld,$CONN);
		$q2="DELETE FROM {$CONF['dbtable']['site_str_languages']} WHERE id IN (".$str.")";
		$r=mysql_query($q2,$CONN);
	}
} 
#------------------------------------------------------------------------------
#--------------------- admin_languages_pageing----------------------------------
if($_SESSION['sub']=="site_languages" && validate($_SESSION['sub'], "get")){
	$_SESSION['view_on_page']=13;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['site_str_languages']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#-------------------------------------------------------------------------
#---------------------------------- news ---------------------------------













#-------------------------------------add news-------------------------
if($_FILES['images']['tmp_name']){
	if($_POST['title']){
		if($_POST['etext_news']){
			$onlyconsonants = str_replace('\"', '"', $_POST['etext_news']);
			$news_text=base64_encode($onlyconsonants);
			$datetime=date("YmdHis");
			list($usec)=explode(' ',microtime());
			$usec=substr($usec,2,6);
			$rand=mt_rand(10000000,99999999);
			$unical="{$datetime}_{$usec}_{$rand}";	
			if ($_FILES['images']['type']==="image/jpeg" || $_FILES['images']['type']==="image/gif" || $_FILES['images']['type']==="image/png" || $_FILES['images']['type']==="image/pjpeg" || $_FILES['images']['type']==="image/x-png"){
				if ($_FILES['images']['type']==="image/jpeg"){
					$type="jpg";
				} elseif ($_FILES['images']['type']==="image/gif"){
					$type="gif";
				} elseif ($_FILES['images']['type']==="image/jpeg"){
					$type="jpg";
				} elseif ($_FILES['images']['type']==="image/pjpeg"){
					$type="jpg";
				} elseif ($_FILES['images']['type']==="image/x-png"){
					$type="png";
				}
				$img="{$unical}.{$type}";
				move_uploaded_file($_FILES['images']['tmp_name'], "../images/news/origin/{$img}");
				@include_once("function_image_resize.php");
				@include_once("function_image_quadrat.php");
				@include_once("function_watermark.php");
				$z=end(explode('.', "../images/news/origin/{$img}"));
				if($z=='jpg' || $z=='gif'){
					$str=file_get_contents("../images/news/origin/{$img}");
					$str_q1=image_quadrat($str);
					$str_q2=image_resize($str_q1,72,72, 100);
					file_put_contents("../images/news/min_thumbs/{$img}", $str_q2);
					
					$str_t1=image_quadrat($str);
					$str_t2=image_resize($str_t1,160,160, 80);
					file_put_contents("../images/news/thumbs/{$img}", $str_t2);
					
					$str_v2=image_resize($str,800,600, 100);
					file_put_contents("../images/news/view/{$img}", $str_v2);
					
					$str_w=watermark("../images/news/view/{$img}");
					file_put_contents("../images/news/watermark/{$img}", $str_w);
					
					$q="INSERT INTO {$CONF['dbtable'][$news_lang]} SET 
						pid='{$_SESSION['ysuac_admin_id']}',
						news_image='{$img}', 
						news_title='".addslashes($_POST['title'])."', 
						news='".addslashes($_POST['etext_news'])."',
						news_date='{$date}', 
						news_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}',
						viewed='0'
						";
					mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
					mysql_query($q,$CONN);
				}
			}
		}
	}else{
		$admin_alert="Վերնագիր ընտրված չէ:";
	}
}else{
	$admin_alert="Նկար ընտրված չէ:";
}
#----------------------------------------------------------------------
#----------------------------- news delete -----------------------------------
if($_POST['news_delete']){
	$q_nd="SELECT * FROM {$CONF['dbtable'][$news_lang]} WHERE id='{$_POST['news_delete']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_nd=mysql_query($q_nd,$CONN);
	$row_nd=mysql_fetch_assoc($r_nd);
	
	$q="DELETE FROM {$CONF['dbtable'][$news_lang]} WHERE id='{$row_nd['id']}'";
	mysql_query($q,$CONN);
	unlink("../images/news/min_thumbs/{$row_nd['news_image']}");
	unlink("../images/news/origin/{$row_nd['news_image']}");
	unlink("../images/news/thumbs/{$row_nd['news_image']}");
	unlink("../images/news/view/{$row_nd['news_image']}");
	unlink("../images/news/watermark/{$row_nd['news_image']}");
	
	if($row_nd['add_images']){
		$img_nd=explode(":::", $row_nd['add_images']);
		foreach ($img_nd as $key => $value) {
				unlink("../images/news/additional/min_thumbs/{$value}");
				unlink("../images/news/additional/origin/{$value}");
				unlink("../images/news/additional/thumbs/{$value}");
				unlink("../images/news/additional/view/{$value}");
				unlink("../images/news/additional/watermark/{$value}");
		}
	}
}
#----------------------------------- news pages (on,off) --------------------------------
if($_SESSION['go']=="home" && $_SESSION['sub']=="news" && validate($_SESSION['sub'], "get" )){
	$_SESSION['view_on_page']=4;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable'][$news_lang]}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#-------------------------------------------------------------------------
if($_POST['news_switch'] && validate($_POST['news_switch'], "num")){
	$q_nswitch="SELECT status FROM {$CONF['dbtable'][$news_lang]} WHERE id='".addslashes($_POST['news_switch'])."'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable'][$news_lang]} SET status='0' WHERE id='".addslashes($_POST['news_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable'][$news_lang]} SET status='1' WHERE id='".addslashes($_POST['news_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#-------------------------------------- news top -----------------------------------
if($_POST['news_top'] && validate($_POST['news_top'], "num")){
	$q_nswitch="SELECT top FROM {$CONF['dbtable'][$news_lang]} WHERE id='".addslashes($_POST['news_top'])."'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['top']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable'][$news_lang]} SET top='0' WHERE id='".addslashes($_POST['news_top'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable'][$news_lang]} SET top='1' WHERE id='".addslashes($_POST['news_top'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#-------------------------------------- announcements top -----------------------------------
if($_POST['announcements_top'] && validate($_POST['announcements_top'], "num")){
	$q_nswitch="SELECT top FROM {$CONF['dbtable'][$announcements_lang]} WHERE id='".addslashes($_POST['announcements_top'])."'";
	$r_nswitch=mysql_query($q_nswitch,$CONN);
	$row_nswitch=mysql_fetch_assoc($r_nswitch);
	if($row_nswitch['top']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable'][$announcements_lang]} SET top='0' WHERE id='".addslashes($_POST['announcements_top'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable'][$announcements_lang]} SET top='1' WHERE id='".addslashes($_POST['announcements_top'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#----------------------------------- news additional photos----------------------------------
if($_POST['news_add_image'] && validate($_POST['news_add_image'], "num") ){
	$news_img_table="news_".$_SESSION['lang'];
	if($_FILES['news_ifile_add']){
		$datetime=date("YmdHis");
		list($usec)=explode(' ',microtime());
		$usec=substr($usec,2,6);
		$rand=mt_rand(10000000,99999999);
		$unical="{$datetime}_{$usec}_{$rand}";
		if ($_FILES['news_ifile_add']['type']==="image/jpeg" || $_FILES['news_ifile_add']['type']==="image/gif" || $_FILES['news_ifile_add']['type']==="image/png" || $_FILES['news_ifile_add']['type']==="image/pjpeg" || $_FILES['news_ifile_add']['type']==="image/x-png"){
			if ($_FILES['news_ifile_add']['type']==="image/jpeg"){
				$type="jpg";
			} elseif ($_FILES['news_ifile_add']['type']==="image/gif"){
				$type="gif";
			} elseif ($_FILES['news_ifile_add']['type']==="image/jpeg"){
				$type="jpg";
			} elseif ($_FILES['news_ifile_add']['type']==="image/pjpeg"){
				$type="jpg";
			} elseif ($_FILES['news_ifile_add']['type']==="image/x-png"){
				$type="png";
			}
			$img="{$unical}.{$type}";
			move_uploaded_file($_FILES['news_ifile_add']['tmp_name'], "../images/news/additional/origin/{$img}");
			$sha1=sha1_file("../images/news/additional/origin/{$img}");
			$date=date("Y-m-d H:i:s");
			@include_once("function_image_resize.php");
			@include_once("function_image_quadrat.php");
			@include_once("function_image_banner.php");
			@include_once("function_watermark.php");
			$z=end(explode('.', "../images/news/additional/origin/{$img}"));
			if($z=='jpg' || $z=='gif'){
				$str=file_get_contents("../images/news/additional/origin/{$img}");
				
				$str_q1=image_quadrat($str);
				$str_q2=image_resize($str_q1,72,72, 100);
				file_put_contents("../images/news/additional/min_thumbs/{$img}", $str_q2);
				
				$str1=image_resize($str,800,600, 100);
				file_put_contents("../images/news/additional/view/{$img}", $str1);
				
				$str=image_quadrat($str);
				$str1=image_resize($str,220,220, 100);
				file_put_contents("../images/news/additional/thumbs/{$img}", $str1);
				
				$str_w=watermark("../images/news/additional/view/{$img}");
				file_put_contents("../images/news/additional/watermark/{$img}", $str_w);
				
				$q_newsisel="SELECT add_images FROM {$CONF['dbtable'][$news_img_table]} WHERE id='{$_POST['news_add_image']}'";
				$r_newsisel=mysql_query($q_newsisel,$CONN);
				$row_newsisel=mysql_fetch_assoc($r_newsisel);
				if($row_newsisel['add_images']){
					$q_newsi="UPDATE {$CONF['dbtable'][$news_img_table]} SET 
					add_images='{$row_newsisel['add_images']}:::{$img}' WHERE id='{$_POST['news_add_image']}'";
					mysql_query($q_newsi,$CONN);
				}else{
					$q_newsi="UPDATE {$CONF['dbtable'][$news_img_table]} SET 
					add_images='{$img}' WHERE id='{$_POST['news_add_image']}'";
					mysql_query($q_newsi,$CONN);
				}
			}
		}
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- bologna process ------------------------------------------
if($_SESSION['go']=="bologna_process" && $_POST['etext_bologna']){
	$q="UPDATE {$CONF['dbtable']['bologna']} SET 
		{$text_lang}='".addslashes($_POST['etext_bologna'])."', 
		info='{$_SESSION['ysuac_admin_id']}'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- foreign_entrant ------------------------------------------
if($_SESSION['go']=="for_applicant" && $_POST['etext_foreign_entrant']){
	$q="UPDATE {$CONF['dbtable']['applicant']} SET 
		{$text_lang}='".addslashes($_POST['etext_foreign_entrant'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='foreign_entrant'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}

#---------------------------------------------------------------------------------------------------
#---------------------------------------- construction_college ------------------------------------------
if($_SESSION['go']=="for_applicant" && $_POST['etext_construction_college']){
	$q="UPDATE {$CONF['dbtable']['applicant']} SET 
		{$text_lang}='".addslashes($_POST['etext_construction_college'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='construction_college'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}

#---------------------------------------------------------------------------------------------------
#---------------------------------------- high_school ------------------------------------------
if($_SESSION['go']=="for_applicant" && $_POST['etext_high_school']){
	$q="UPDATE {$CONF['dbtable']['applicant']} SET 
		{$text_lang}='".addslashes($_POST['etext_high_school'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='high_school'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}

#---------------------------------------------------------------------------------------------------

#---------------------------------------- postgraduate_degree ------------------------------------------
if($_SESSION['go']=="for_applicant" && $_POST['etext_postgraduate_degree']){
	$q="UPDATE {$CONF['dbtable']['postgraduate_degree']} SET 
		{$text_lang}='".addslashes($_POST['etext_postgraduate_degree'])."', 
		info='{$_SESSION['ysuac_admin_id']}'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- masters_degree ------------------------------------------
if($_SESSION['go']=="for_applicant" && $_POST['etext_masters_degree']){
	$q="UPDATE {$CONF['dbtable']['masters_degree']} SET 
		{$text_lang}='".addslashes($_POST['etext_masters_degree'])."', 
		info='{$_SESSION['ysuac_admin_id']}'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- distance_learning ------------------------------------------
if($_SESSION['go']=="for_applicant" && $_POST['etext_distance_learning']){
	$q="UPDATE {$CONF['dbtable']['distance_learning']} SET 
		{$text_lang}='".addslashes($_POST['etext_distance_learning'])."', 
		info='{$_SESSION['ysuac_admin_id']}'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- Entry Course ------------------------------------------
if($_SESSION['go']=="for_applicant" && $_POST['etext_entry_course']){
	$q="UPDATE {$CONF['dbtable']['entry_course']} SET 
		{$text_lang}='".addslashes($_POST['etext_entry_course'])."', 
		info='{$_SESSION['ysuac_admin_id']}'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------- announcements adder --------------------------------------------
if($_POST['announcements_title'] && $_POST['etext_announcements']){
	$q="INSERT INTO {$CONF['dbtable'][$announcements_lang]} SET 
		title='".addslashes($_POST['announcements_title'])."', 
		text='".addslashes($_POST['etext_announcements'])."',
		status='0',
		upload_date='{$date}', 
		info='{$_SESSION['ysuac_admin_id']}'
		";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#----------------------------------- announcements pages --------------------------------------
if($_SESSION['go']=="home" && $_SESSION['sub']=="announcements" && validate($_SESSION['sub'], "get" )){
	$_SESSION['view_on_page']=2;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable'][$announcements_lang]}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#---------------------------------------------------------------------------------------------------
#-------------------------------------- announcements delete------------------------------------------------------
if($_POST['announcements_delete']  && validate($_POST['announcements_delete'], "num")){
	$q="DELETE FROM {$CONF['dbtable'][$announcements_lang]} WHERE id='{$_POST['announcements_delete']}'";
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------announcements switch (on,off)---------------------------------------------
if($_POST['announcements_switch'] && validate($_POST['announcements_switch'], "num")){
	$q_aswitch="SELECT status FROM {$CONF['dbtable'][$announcements_lang]} WHERE id='".addslashes($_POST['announcements_switch'])."'";
	$r_aswitch=mysql_query($q_aswitch,$CONN);
	$row_aswitch=mysql_fetch_assoc($r_aswitch);
	if($row_aswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable'][$announcements_lang]} SET status='0' WHERE id='".addslashes($_POST['announcements_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable'][$announcements_lang]} SET status='1' WHERE id='".addslashes($_POST['announcements_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------files upload------------------------------------------------
if($_POST['add_file_x'] && validate($_POST['add_file_y'], "num")){
	#pre($_FILES);
	$datetime=date("YmdHis");
	list($usec)=explode(' ',microtime());
	$usec=substr($usec,2,6);
	$rand=mt_rand(10000000,99999999);
	$unical="{$datetime}_{$usec}_{$rand}";
	$type=end(explode(".", $_FILES['file_upload']['name']));
	$fname="file_{$unical}.{$type}";
	if ($_FILES['file_upload']['type']==="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
		$_FILES['file_upload']['type']==="application/vnd.ms-excel" ||
		$_FILES['file_upload']['type']==="application/x-rar" || 
		$_FILES['file_upload']['type']==="application/octet-stream" || 
		$_FILES['file_upload']['type']==="application/vnd.openxmlformats-officedocument.presentationml.presentation"|| 
		$_FILES['file_upload']['type']==="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"|| 
		$_FILES['file_upload']['type']==="application/pdf" ||
		$_FILES['file_upload']['type']==="image/jpeg")
	{
		move_uploaded_file($_FILES['file_upload']['tmp_name'], "../files/{$type}/{$fname}");
		$sha1=sha1_file("../files/{$type}/{$fname}");
		$q="INSERT INTO {$CONF['dbtable']['files']} SET 
			name='{$_FILES['file_upload']['name']}',
			path='{$fname}',
			unic_name='".addslashes($_POST['file_name']).".{$type}', 
			size='{$_FILES['file_upload']['size']}', 
			type='{$type}', 
			upload_date='{$date}', 
			owner='{$_SESSION['ysuac_admin_id']}',
			sha='{$sha1}',
			status='0'
		";
		#echo $q;
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
	}
	#pre($_FILES);
}
#---------------------------------------------------------------------------------------------------
#-----------------------------------------file delete-----------------------------------------------
if($_POST['files_delete'] && validate($_POST['files_delete'], "num")){
	$q_cdf="SELECT * FROM {$CONF['dbtable']['files']} WHERE id='".addslashes($_POST['files_delete'])."'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_filedel=mysql_query($q_cdf,$CONN);
	$row_filedel=mysql_fetch_assoc($r_filedel);
	
	
	$q_fdel="DELETE FROM {$CONF['dbtable']['files']} WHERE id='{$row_filedel['id']}'";
	mysql_query($q_fdel,$CONN);
	unlink("../files/{$row_filedel['type']}/{$row_filedel['path']}");
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------------------------------------------------------------------
#----------------------------------- slideshow photo add----------------------------
if($_POST['add_slideshow_x'] && validate($_POST['add_slideshow_x'], "post")){
	$bac_w1=md5($LANG['admin_lang2'][$_SESSION['lang']]);
	$bac_w1a=md5($_POST['slideshow_amt']);
	$bac_w2=md5($LANG['admin_lang3'][$_SESSION['lang']]);
	$bac_w2a=md5($_POST['slideshow_rut']);
	$bac_w3=md5($LANG['admin_lang4'][$_SESSION['lang']]);
	$bac_w3a=md5($_POST['slideshow_ent']);
	$bac_w4=md5($LANG['admin_lang5'][$_SESSION['lang']]);
	$bac_w4a=md5($_POST['slideshow_frt']);
	if($bac_w1!=$bac_w1a && $bac_w2!=$bac_w2a && $bac_w3!=$bac_w3a && $bac_w4!=$bac_w4a){
		if($_FILES['slideshow_img']['error']!=1){
			$datetime=date("YmdHis");
			list($usec)=explode(' ',microtime());
			$usec=substr($usec,2,6);
			$rand=mt_rand(10000000,99999999);
			$unical="{$datetime}_{$usec}_{$rand}";
			if ($_FILES['slideshow_img']['type']==="image/jpeg" || $_FILES['slideshow_img']['type']==="image/gif" || $_FILES['slideshow_img']['type']==="image/png" || $_FILES['slideshow_img']['type']==="image/pjpeg" || $_FILES['slideshow_img']['type']==="image/x-png"){
				if ($_FILES['slideshow_img']['type']==="image/jpeg"){
					$type="jpg";
				} elseif ($_FILES['slideshow_img']['type']==="image/jpeg"){
					$type="jpg";
				} elseif ($_FILES['slideshow_img']['type']==="image/pjpeg"){
					$type="jpg";
				}
				$img="{$unical}.{$type}";
				move_uploaded_file($_FILES['slideshow_img']['tmp_name'], "../images/slider/original/{$img}");
				
				
				if($_POST['slideshow_amt'] && $_POST['slideshow_rut'] && $_POST['slideshow_ent'] && $_POST['slideshow_frt']){
					$date=date("Y-m-d H:i:s");
					include_once("function_image_resize.php");
					include_once("function_image_quadrat.php");
					include_once("function_image_banner.php");
					include_once("function_watermark.php");
					$z=end(explode('.', "../images/slider/original/{$img}"));
					if($z=='jpg' || $z=='gif'){
						$str=file_get_contents("../images/slider/original/{$img}");
												
						$str1=image_resize_noratio($str,661,374, 100);
						$str2=image_banner($str1);
						file_put_contents("../images/slider/{$img}", $str2);
						
						$str=image_quadrat($str);
						$str1=image_resize($str,220,220, 100);
						file_put_contents("../images/slider/min_thumbs/{$img}", $str1);
						
						list($width, $height, $type, $attr) = getimagesize("../images/slider/original/{$img}");
						$size = @filesize("../images/slider/original/{$img}");
						$str=file_get_contents("../images/slider/original/{$img}");
						$info=$_SESSION['admin_fname']." ".$_SESSION['admin_lname'];
						$q="INSERT INTO {$CONF['dbtable']['slideshow']} SET 
							path='{$img}',
							name_am='".addslashes($_POST['slideshow_amt'])."', 
							name_ru='".addslashes($_POST['slideshow_rut'])."',
							name_en='".addslashes($_POST['slideshow_ent'])."',
							name_fr='".addslashes($_POST['slideshow_frt'])."',
							link='http',
							size='{$size}',
							resolution='{$width}-{$height}', 
							udatetime='{$date}', 
							info='{$info}', 
							status='0'
						";
						mysql_query($q,$CONN);
					}
				}
			}
		}
	}	
}
#------------------------------------------------------------------------------
#-------------------------------- slideshow delete ----------------------------
if ( $_POST['slideshow_delete_x'] && $_POST['chbox']) {
	$q_wd="SELECT * FROM {$CONF['dbtable']['slideshow']} WHERE id IN ( ";	
	foreach($_POST['chbox'] as $k => $v) {
		$a[]="'$k'";
	}
	$str=implode(",",$a);
	$q_wd.=$str." ) ";
	$r1_wd=mysql_query($q_wd,$CONN);
	while(($row_wd=mysql_fetch_assoc($r1_wd))!=false){
		unlink("../images/slider/original/{$row_wd['path']}");
		unlink("../images/slider/min_thumbs/{$row_wd['path']}");
		unlink("../images/slider/{$row_wd['path']}");
	}
	$q1="DELETE FROM {$CONF['dbtable']['slideshow']} WHERE id IN (".$str.")";
	$r=mysql_query($q1,$CONN);
} else {
	$alert2="Select file to delete";
}
#-----------------------------------------------------------------------------
#-------------------------- slideshow switch (on,off) ------------------------
if($_POST['slideshow_switch'] && validate($_POST['slideshow_switch'], "num")){
	$q_aswitch="SELECT status FROM {$CONF['dbtable']['slideshow']} WHERE id='".addslashes($_POST['slideshow_switch'])."'";
	$r_aswitch=mysql_query($q_aswitch,$CONN);
	$row_aswitch=mysql_fetch_assoc($r_aswitch);
	if($row_aswitch['status']=="1"){
		$q_update_status="UPDATE {$CONF['dbtable']['slideshow']} SET status='0' WHERE id='".addslashes($_POST['slideshow_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}else{
		$q_update_status="UPDATE {$CONF['dbtable']['slideshow']} SET status='1' WHERE id='".addslashes($_POST['slideshow_switch'])."'";
		$r_update_status=mysql_query($q_update_status,$CONN);
	}
}
#-----------------------------------------------------------------------------
#----------------------------------- slideshow pages --------------------------------------
if($_SESSION['go']=="home" && $_SESSION['sub']=="slideshow" && validate($_SESSION['sub'], "get" )){
	$_SESSION['view_on_page']=8;
	$q_pageing="SELECT count(*) as count FROM {$CONF['dbtable']['slideshow']}";
	$r_pageing=mysql_query($q_pageing,$CONN);
	$row_pageing=mysql_fetch_assoc($r_pageing);
	$i_pageing=ceil($row_pageing['count']/$_SESSION['view_on_page']);
	if($_GET['page'] && validate($_GET['page'], "get_num")){		
		$_SESSION['page']=$_GET['page'];	
	}else{
		$_SESSION['page']="1";	
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- specialized_council ------------------------------------------
if($_SESSION['go']=="030_spec" && $_POST['etext_specialized_council']){
	$q="UPDATE {$CONF['dbtable']['specialized_council']} SET 
		{$text_lang}='".addslashes($_POST['etext_specialized_council'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE id='1'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- composition_of_board ------------------------------------------
if($_SESSION['go']=="030_spec" && $_POST['etext_composition_of_board']){
	$q="UPDATE {$CONF['dbtable']['specialized_council']} SET 
		{$text_lang}='".addslashes($_POST['etext_composition_of_board'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='composition_of_board'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- theses_defenses ------------------------------------------
if($_SESSION['go']=="030_spec" && $_POST['etext_theses_defenses']){
	$q="UPDATE {$CONF['dbtable']['specialized_council']} SET 
		{$text_lang}='".addslashes($_POST['etext_theses_defenses'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='theses_defenses'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- authors_abstract_delivery_list ------------------------------------------
if($_SESSION['go']=="030_spec" && $_POST['etext_authors_abstract_delivery_list']){
	$q="UPDATE {$CONF['dbtable']['specialized_council']} SET 
		{$text_lang}='".addslashes($_POST['etext_authors_abstract_delivery_list'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='authors_abstract_delivery_list'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- board_staff ------------------------------------------
if($_SESSION['go']=="our_university" && $_POST['etext_foreign_partners']){
	$q="UPDATE {$CONF['dbtable']['site_our_university']} SET 
		{$text_lang}='".addslashes($_POST['etext_foreign_partners'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='board_staff'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- history ------------------------------------------
if($_SESSION['go']=="our_university" && $_POST['etext_menu_history']){
	$q="UPDATE {$CONF['dbtable']['site_our_university']} SET 
		{$text_lang}='".addslashes($_POST['etext_menu_history'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='history'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------

#---------------------------------------- board_staff ------------------------------------------
if($_SESSION['go']=="our_university" && $_POST['etext_foreign_board_sessions']){
	$q="UPDATE {$CONF['dbtable']['site_our_university']} SET 
		{$text_lang}='".addslashes($_POST['etext_foreign_board_sessions'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='board_sessions'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- academic_council ------------------------------------------
if($_SESSION['go']=="our_university" && $_POST['etext_foreign_academic_council']){
	$q="UPDATE {$CONF['dbtable']['site_our_university']} SET 
		{$text_lang}='".addslashes($_POST['etext_foreign_academic_council'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='academic_council'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- decisions_council ------------------------------------------
if($_SESSION['go']=="our_university" && $_POST['etext_foreign_decisions_council']){
	$q="UPDATE {$CONF['dbtable']['site_our_university']} SET 
		{$text_lang}='".addslashes($_POST['etext_foreign_decisions_council'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='decisions_council'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- rectors_staff ------------------------------------------
if($_SESSION['go']=="our_university" && $_POST['etext_foreign_rectors_staff']){
	$q="UPDATE {$CONF['dbtable']['site_our_university']} SET 
		{$text_lang}='".addslashes($_POST['etext_foreign_rectors_staff'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='rectors_staff'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- board_decisions ------------------------------------------
if($_SESSION['go']=="our_university" && $_POST['etext_foreign_board_decisions']){
	$q="UPDATE {$CONF['dbtable']['site_our_university']} SET 
		{$text_lang}='".addslashes($_POST['etext_foreign_board_decisions'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='board_decisions'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- constructors_union ---------------------------------------
if($_SESSION['go']=="our_partners" && $_POST['etext_constructors_union']){
	$q="UPDATE {$CONF['dbtable']['site_our_partners']} SET 
		{$text_lang}='".addslashes($_POST['etext_constructors_union'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='constructors_union'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- architectures_union ---------------------------------------
if($_SESSION['go']=="our_partners" && $_POST['etext_architectures_union']){
	$q="UPDATE {$CONF['dbtable']['site_our_partners']} SET 
		{$text_lang}='".addslashes($_POST['etext_architectures_union'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='architectures_union'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- international_conferences ---------------------------------------
if($_SESSION['go']=="int_coo" && $_POST['etext_international_conferences']){
	$q="UPDATE {$CONF['dbtable']['international_cooperation']} SET 
		{$text_lang}='".addslashes($_POST['etext_international_conferences'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='international_conferences'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- order_mse ---------------------------------------
if($_SESSION['go']=="legal_acts" && $_POST['etext_order_mse']){
	$q="UPDATE {$CONF['dbtable']['site_legal_acts']} SET 
		{$text_lang}='".addslashes($_POST['etext_order_mse'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='order_mse'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- decrees_rector ---------------------------------------
if($_SESSION['go']=="legal_acts" && $_POST['etext_decrees_rector']){
	$q="UPDATE {$CONF['dbtable']['site_legal_acts']} SET 
		{$text_lang}='".addslashes($_POST['etext_decrees_rector'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='decrees_rector'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- governing_council ---------------------------------------
if($_SESSION['go']=="legal_acts" && $_POST['etext_governing_council']){
	$q="UPDATE {$CONF['dbtable']['site_legal_acts']} SET 
		{$text_lang}='".addslashes($_POST['etext_governing_council'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='governing_council'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- order_rector ---------------------------------------
if($_SESSION['go']=="legal_acts" && $_POST['etext_order_rector']){
	$q="UPDATE {$CONF['dbtable']['site_legal_acts']} SET 
		{$text_lang}='".addslashes($_POST['etext_order_rector'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='order_rector'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- charter ---------------------------------------
if($_SESSION['go']=="legal_acts" && $_POST['etext_charter']){
	$q="UPDATE {$CONF['dbtable']['site_legal_acts']} SET 
		{$text_lang}='".addslashes($_POST['etext_charter'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='charter'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- reg_rules ---------------------------------------
if($_SESSION['go']=="legal_acts" && $_POST['etext_reg_rules']){
	$q="UPDATE {$CONF['dbtable']['site_legal_acts']} SET 
		{$text_lang}='".addslashes($_POST['etext_reg_rules'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='reg_rules'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- educational_process ---------------------------------------
if($_SESSION['go']=="int_coo" && $_POST['etext_educational_process']){
	$q="UPDATE {$CONF['dbtable']['international_cooperation']} SET 
		{$text_lang}='".addslashes($_POST['etext_educational_process'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='educational_process'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------


#---------------------------------------- alumni_home ---------------------------------------
if($_SESSION['go']=="alumni" && $_POST['etext_alumni_home']){
	$q="UPDATE {$CONF['dbtable']['site_alumni']} SET 
		{$text_lang}='".addslashes($_POST['etext_alumni_home'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='alumni_home'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- alumni_search ---------------------------------------
if($_SESSION['go']=="alumni" && $_POST['etext_alumni_search']){
	$q="UPDATE {$CONF['dbtable']['site_alumni']} SET 
		{$text_lang}='".addslashes($_POST['etext_alumni_search'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='alumni_search'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- alumni_charter ---------------------------------------
if($_SESSION['go']=="alumni" && $_POST['etext_alumni_charter']){
	$q="UPDATE {$CONF['dbtable']['site_alumni']} SET 
		{$text_lang}='".addslashes($_POST['etext_alumni_charter'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='alumni_charter'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- alumni_functions ---------------------------------------
if($_SESSION['go']=="alumni" && $_POST['etext_alumni_functions']){
	$q="UPDATE {$CONF['dbtable']['site_alumni']} SET 
		{$text_lang}='".addslashes($_POST['etext_alumni_functions'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='alumni_functions'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- alumni_registration ---------------------------------------
if($_SESSION['go']=="alumni" && $_POST['etext_alumni_registration']){
	$q="UPDATE {$CONF['dbtable']['site_alumni']} SET 
		{$text_lang}='".addslashes($_POST['etext_alumni_registration'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='alumni_registration'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- alumni_events ---------------------------------------
if($_SESSION['go']=="alumni" && $_POST['etext_alumni_events']){
	$q="UPDATE {$CONF['dbtable']['site_alumni']} SET 
		{$text_lang}='".addslashes($_POST['etext_alumni_events'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='alumni_events'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- alumni_famous ---------------------------------------
if($_SESSION['go']=="alumni" && $_POST['etext_alumni_famous']){
	$q="UPDATE {$CONF['dbtable']['site_alumni']} SET 
		{$text_lang}='".addslashes($_POST['etext_alumni_famous'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='alumni_famous'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- news_edit ---------------------------------------
#pre($_SESSION);
if($_SESSION['go']=="home" && $_POST['etext_news_edit']){
	$q="UPDATE {$CONF['dbtable'][$news_lang]} SET 
		news='".addslashes($_POST['etext_news_edit'])."', news_title='{$_POST['edit_title']}', 
		news_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}' WHERE id='{$_GET['news_id']}'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- editional_borad ---------------------------------------
if($_SESSION['go']=="library" && $_POST['etext_editional_borad']){
	$q="UPDATE {$CONF['dbtable']['proceedings']} SET 
		{$text_lang}='".addslashes($_POST['etext_editional_borad'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='editional_borad'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- bulletin_edboard ---------------------------------------
if($_SESSION['go']=="library" && $_POST['etext_bulletin_edboard']){
	$q="UPDATE {$CONF['dbtable']['proceedings']} SET 
		{$text_lang}='".addslashes($_POST['etext_bulletin_edboard'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='bulletin_edboard'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- bulletin_articles_requirements ---------------------------------------
if($_SESSION['go']=="library" && $_POST['etext_bulletin_articles_requirements']){
	$q="UPDATE {$CONF['dbtable']['proceedings']} SET 
		{$text_lang}='".addslashes($_POST['etext_bulletin_articles_requirements'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='bulletin_articles_requirements'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- articles_requirements ---------------------------------------
if($_SESSION['go']=="library" && $_POST['etext_articles_requirements']){
	$q="UPDATE {$CONF['dbtable']['proceedings']} SET 
		{$text_lang}='".addslashes($_POST['etext_articles_requirements'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='articles_requirements'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- admission_order ---------------------------------------
if($_SESSION['go']=="library" && $_POST['etext_admission_order']){
	$q="UPDATE {$CONF['dbtable']['proceedings']} SET 
		{$text_lang}='".addslashes($_POST['etext_admission_order'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='admission_order'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- about_the_journal ---------------------------------------
if($_SESSION['go']=="library" && $_POST['etext_about_the_journal']){
	$q="UPDATE {$CONF['dbtable']['proceedings']} SET 
		{$text_lang}='".addslashes($_POST['etext_about_the_journal'])."', 
		info='{$_SESSION['ysuac_admin_id']}' WHERE description='about_the_journal'
	";
	#echo $q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#-------------------------------------- news image delete ------------------------------------------
if($_POST['news_image_delete']){
	$del_img=explode(":://_:", $_POST['news_image_delete']);
	$q_delimg="SELECT * FROM {$CONF['dbtable'][$news_lang]} WHERE id='{$del_img['1']}'";
	$r_delimg=mysql_query($q_delimg,$CONN);
	$row_delimg=mysql_fetch_assoc($r_delimg);
	$del_img2=explode(":::", $row_delimg['add_images']);
	foreach ($del_img2 as $key => $value) {
		if($value!=$del_img['0']){
			$delimg.=$value.":::";
		}
	}
	$q="UPDATE {$CONF['dbtable'][$news_lang]} SET 
		add_images='{$delimg}' WHERE id='{$del_img['1']}';
	";
	mysql_query($q,$CONN);
	unlink("../images/news/additional/min_thumbs/{$del_img['0']}");
	unlink("../images/news/additional/origin/{$del_img['0']}");
	unlink("../images/news/additional/thumbs/{$del_img['0']}");
	unlink("../images/news/additional/view/{$del_img['0']}");
	unlink("../images/news/additional/watermark/{$del_img['0']}");
}
#---------------------------------------------------------------------------------------------------

#---------------------------------------- departments_history ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="departments" && $_POST['etext_dep_history'] && isset($_GET['depid'])){
	$q_depsel="SELECT department_description FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='".addslashes($_GET['depid'])."'";
	$r_depsel=mysql_query($q_depsel,$CONN);
	$row_depsel=mysql_fetch_assoc($r_depsel);
	if($row_depsel['department_description']){
		$q="UPDATE {$CONF['dbtable'][$dep_lang]} SET 
		department_history='".addslashes($_POST['etext_dep_history'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}' WHERE department_description='{$_GET['depid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$dep_lang]} SET department_description='".addslashes($_GET['depid'])."', department_history='".addslashes($_POST['etext_dep_history'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- specialized_chairs ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="departments" && $_POST['etext_specialized_chairs'] && isset($_GET['depid'])){
	$q_depsel="SELECT department_description FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='".addslashes($_GET['depid'])."'";
	$r_depsel=mysql_query($q_depsel,$CONN);
	$row_depsel=mysql_fetch_assoc($r_depsel);
	if($row_depsel['department_description']){
		$q="UPDATE {$CONF['dbtable'][$dep_lang]} SET 
		department_spec='".addslashes($_POST['etext_specialized_chairs'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}' WHERE department_description='{$_GET['depid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$dep_lang]} SET department_description='".addslashes($_GET['depid'])."', department_spec='".addslashes($_POST['etext_specialized_chairs'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- dep_team ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="departments" && $_POST['etext_dep_team'] && isset($_GET['depid'])){
	$q_depsel="SELECT department_description FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='".addslashes($_GET['depid'])."'";
	$r_depsel=mysql_query($q_depsel,$CONN);
	$row_depsel=mysql_fetch_assoc($r_depsel);
	if($row_depsel['department_description']){
		$q="UPDATE {$CONF['dbtable'][$dep_lang]} SET 
		department_team='".addslashes($_POST['etext_dep_team'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}' WHERE department_description='{$_GET['depid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$dep_lang]} SET department_description='".addslashes($_GET['depid'])."', department_team='".addslashes($_POST['etext_dep_team'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- department_council ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="departments" && $_POST['etext_dep_council'] && isset($_GET['depid'])){
	$q_depsel="SELECT department_description FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='".addslashes($_GET['depid'])."'";
	$r_depsel=mysql_query($q_depsel,$CONN);
	$row_depsel=mysql_fetch_assoc($r_depsel);
	if($row_depsel['department_description']){
		$q="UPDATE {$CONF['dbtable'][$dep_lang]} SET 
		department_council='".addslashes($_POST['etext_dep_council'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}' WHERE department_description='{$_GET['depid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$dep_lang]} SET department_description='".addslashes($_GET['depid'])."', department_council='".addslashes($_POST['etext_dep_council'])."', department_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', department_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- faculties_history ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="faculties" && $_POST['etext_fac_history'] && isset($_GET['facid'])){
	$q_facsel="SELECT faculties_description FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='".addslashes($_GET['facid'])."'";
	$r_facsel=mysql_query($q_facsel,$CONN);
	$row_facsel=mysql_fetch_assoc($r_facsel);
	if($row_facsel['faculties_description']){
		$q="UPDATE {$CONF['dbtable'][$fac_lang]} SET 
		faculties_history='".addslashes($_POST['etext_fac_history'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}' WHERE faculties_description='{$_GET['facid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$fac_lang]} SET faculties_description='".addslashes($_GET['facid'])."', faculties_history='".addslashes($_POST['etext_fac_history'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------

#---------------------------------------- faculties_chairs ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="faculties" && $_POST['etext_fac_specialized_chairs'] && isset($_GET['facid'])){
	$q_facsel="SELECT faculties_description FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='".addslashes($_GET['facid'])."'";
	$r_facsel=mysql_query($q_facsel,$CONN);
	$row_facsel=mysql_fetch_assoc($r_facsel);
	if($row_facsel['faculties_description']){
		$q="UPDATE {$CONF['dbtable'][$fac_lang]} SET 
		faculties_spec='".addslashes($_POST['etext_fac_specialized_chairs'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}' WHERE faculties_description='{$_GET['facid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$fac_lang]} SET faculties_description='".addslashes($_GET['facid'])."', faculties_spec='".addslashes($_POST['etext_fac_specialized_chairs'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------

#---------------------------------------- faculties_team ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="faculties" && $_POST['etext_fac_team'] && isset($_GET['facid'])){
	$q_facsel="SELECT faculties_description FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='".addslashes($_GET['facid'])."'";
	$r_facsel=mysql_query($q_facsel,$CONN);
	$row_facsel=mysql_fetch_assoc($r_facsel);
	if($row_facsel['faculties_description']){
		$q="UPDATE {$CONF['dbtable'][$fac_lang]} SET 
		faculties_team='".addslashes($_POST['etext_fac_team'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}' WHERE faculties_description='{$_GET['facid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$fac_lang]} SET faculties_description='".addslashes($_GET['facid'])."', faculties_team='".addslashes($_POST['etext_fac_team'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- faculties_council ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="faculties" && $_POST['etext_fac_council'] && isset($_GET['facid'])){
	$q_facsel="SELECT faculties_description FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='".addslashes($_GET['facid'])."'";
	$r_facsel=mysql_query($q_facsel,$CONN);
	$row_facsel=mysql_fetch_assoc($r_facsel);
	if($row_facsel['faculties_description']){
		$q="UPDATE {$CONF['dbtable'][$fac_lang]} SET 
		faculties_council='".addslashes($_POST['etext_fac_council'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}' WHERE faculties_description='{$_GET['facid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$fac_lang]} SET faculties_description='".addslashes($_GET['facid'])."', faculties_council='".addslashes($_POST['etext_fac_council'])."', faculties_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', faculties_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------




#---------------------------------------- chairs_history ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="chairs" && $_POST['etext_ch_history'] && isset($_GET['chid'])){
	$q_chsel="SELECT chairs_description FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='".addslashes($_GET['chid'])."'";
	$r_chsel=mysql_query($q_chsel,$CONN);
	$row_chsel=mysql_fetch_assoc($r_chsel);
	if($row_chsel['chairs_description']){
		$q="UPDATE {$CONF['dbtable'][$ch_lang]} SET 
		chairs_history='".addslashes($_POST['etext_ch_history'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}' WHERE chairs_description='{$_GET['chid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$ch_lang]} SET chairs_description='".addslashes($_GET['chid'])."', chairs_history='".addslashes($_POST['etext_ch_history'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------

#---------------------------------------- chairs_scientific_process ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="chairs" && $_POST['etext_scientific_process'] && isset($_GET['chid'])){
	$q_chsel="SELECT chairs_description FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='".addslashes($_GET['chid'])."'";
	$r_chsel=mysql_query($q_chsel,$CONN);
	$row_chsel=mysql_fetch_assoc($r_chsel);
	if($row_chsel['chairs_description']){
		$q="UPDATE {$CONF['dbtable'][$ch_lang]} SET 
		chairs_scientific_process='".addslashes($_POST['etext_scientific_process'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}' WHERE chairs_description='{$_GET['chid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$ch_lang]} SET chairs_description='".addslashes($_GET['chid'])."', chairs_scientific_process='".addslashes($_POST['etext_scientific_process'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------




#---------------------------------------- chairs_team ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="chairs" && $_POST['etext_ch_team'] && isset($_GET['chid'])){
	$q_chsel="SELECT chairs_description FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='".addslashes($_GET['chid'])."'";
	$r_chsel=mysql_query($q_chsel,$CONN);
	$row_chsel=mysql_fetch_assoc($r_chsel);
	if($row_chsel['chairs_description']){
		$q="UPDATE {$CONF['dbtable'][$ch_lang]} SET 
		chairs_team='".addslashes($_POST['etext_ch_team'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}' WHERE chairs_description='{$_GET['chid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$ch_lang]} SET chairs_description='".addslashes($_GET['chid'])."', chairs_team='".addslashes($_POST['etext_ch_team'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------

#---------------------------------------- chairs_educational_process ---------------------------------------
#pre($_POST);
if($_SESSION['go']=="chairs" && $_POST['etext_educational_process'] && isset($_GET['chid'])){
	$q_chsel="SELECT chairs_description FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='".addslashes($_GET['chid'])."'";
	$r_chsel=mysql_query($q_chsel,$CONN);
	$row_chsel=mysql_fetch_assoc($r_chsel);
	if($row_chsel['chairs_description']){
		$q="UPDATE {$CONF['dbtable'][$ch_lang]} SET 
		chairs_educational_process='".addslashes($_POST['etext_educational_process'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}' WHERE chairs_description='{$_GET['chid']}'
		";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}else{
		$q="INSERT INTO {$CONF['dbtable'][$ch_lang]} SET chairs_description='".addslashes($_GET['chid'])."', chairs_educational_process='".addslashes($_POST['etext_educational_process'])."', chairs_info='{$_SESSION['admin_fname']} {$_SESSION['admin_lname']}', chairs_moddate='{$date}'";
		mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
		mysql_query($q,$CONN);
		#echo $q;
	}
}
#---------------------------------------------------------------------------------------------------




#--------------------------------------------add_bulletin---------------------------------------------
if($_POST['add_bulletin']){
	if($_FILES['bulletin_thumb']['tmp_name']){
		if($_POST['bulletin_number']){
			if($_POST['bulletin_year']){
				if($_POST['bulletin_pages']){
					if($_FILES['bulletin_file']['tmp_name']){
				
				
						$datetime=date("YmdHis");
						list($usec)=explode(' ',microtime());
						$usec=substr($usec,2,6);
						$rand=mt_rand(10000000,99999999);
						$unical="{$datetime}_{$usec}_{$rand}";	
						$type_file=end(explode(".", $_FILES['bulletin_file']['name']));
						$fname="file_{$unical}.{$type_file}";
						if ($_FILES['bulletin_file']['type']==="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
							$_FILES['bulletin_file']['type']==="application/vnd.ms-excel" ||
							$_FILES['bulletin_file']['type']==="application/x-rar" || 
							$_FILES['bulletin_file']['type']==="application/octet-stream" || 
							$_FILES['bulletin_file']['type']==="application/vnd.openxmlformats-officedocument.presentationml.presentation"|| 
							$_FILES['bulletin_file']['type']==="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"|| 
							$_FILES['bulletin_file']['type']==="application/pdf" ||
							$_FILES['bulletin_file']['type']==="application/msword" ||
							$_FILES['bulletin_file']['type']==="application/x-zip-compressed" ||
							$_FILES['bulletin_file']['type']==="image/jpeg"){
								move_uploaded_file($_FILES['bulletin_file']['tmp_name'], "../files/{$type_file}/{$fname}");
								$sha1=sha1_file("../files/{$type_file}/{$fname}");
						}
	

						if ($_FILES['bulletin_thumb']['type']==="image/jpeg" || $_FILES['bulletin_thumb']['type']==="image/gif" || $_FILES['bulletin_thumb']['type']==="image/png" || $_FILES['bulletin_thumb']['type']==="image/pjpeg" || $_FILES['bulletin_thumb']['type']==="image/x-png"){
							if ($_FILES['bulletin_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['bulletin_thumb']['type']==="image/gif"){
								$type="gif";
							} elseif ($_FILES['bulletin_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['bulletin_thumb']['type']==="image/pjpeg"){
								$type="jpg";
							} elseif ($_FILES['bulletin_thumb']['type']==="image/x-png"){
								$type="png";
							}
							$img="{$unical}.{$type}";
							move_uploaded_file($_FILES['bulletin_thumb']['tmp_name'], "../images/library/bulletin/origin/{$img}");
							@include_once("function_image_resize.php");
							@include_once("function_image_quadrat.php");
							$z=end(explode('.', "../images/library/bulletin/origin/{$img}"));
							if($z=='jpg' || $z=='gif'){
								$str=file_get_contents("../images/library/bulletin/origin/{$img}");
								$str_q2=image_resize($str,72,98, 100);
								file_put_contents("../images/library/bulletin/thumbs/{$img}", $str_q2);
								
								$q="INSERT INTO {$CONF['dbtable']['bulletin']} SET 
									thumbnails='{$img}', 
									name='{$fname}',
									real_name='{$_FILES['bulletin_file']['name']}',
									type='{$type_file}',
									number='{$_POST['bulletin_number']}',
									year='{$_POST['bulletin_year']}',
									pages='{$_POST['bulletin_pages']}',
									size='{$_FILES['bulletin_file']['size']}',
									upload_date='{$date}',
									info='{$_SESSION['ysuac_admin_id']}'
									";
								mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
								mysql_query($q,$CONN);
								#pre($_FILES);
							}
						}
					}
				}
			}
		}
	}
}




#---------------------------------------------------------------------------------------------------
#--------------------------------------------add_cbuilders---------------------------------------------
if($_POST['add_cbuilders']){
	if($_FILES['cbuilders_thumb']['tmp_name']){
		if($_POST['cbuilders_number']){
			if($_POST['cbuilders_year']){
				if($_POST['cbuilders_pages']){
					pre($_FILES['cbuilders_file']['error']);
					
					if($_FILES['cbuilders_file']['tmp_name']){
						$datetime=date("YmdHis");
						list($usec)=explode(' ',microtime());
						$usec=substr($usec,2,6);
						$rand=mt_rand(10000000,99999999);
						$unical="{$datetime}_{$usec}_{$rand}";	
						$type_file=end(explode(".", $_FILES['cbuilders_file']['name']));
						$fname="file_{$unical}.{$type_file}";
						if ($_FILES['cbuilders_file']['type']==="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
							$_FILES['cbuilders_file']['type']==="application/vnd.ms-excel" ||
							$_FILES['cbuilders_file']['type']==="application/x-rar" || 
							$_FILES['cbuilders_file']['type']==="application/octet-stream" || 
							$_FILES['cbuilders_file']['type']==="application/vnd.openxmlformats-officedocument.presentationml.presentation"|| 
							$_FILES['cbuilders_file']['type']==="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"|| 
							$_FILES['cbuilders_file']['type']==="application/pdf" ||
							$_FILES['cbuilders_file']['type']==="application/msword" ||
							$_FILES['cbuilders_file']['type']==="application/x-zip-compressed" ||
							$_FILES['cbuilders_file']['type']==="" ||
							$_FILES['cbuilders_file']['type']==="image/jpeg"){
								$aa=move_uploaded_file($_FILES['cbuilders_file']['tmp_name'], "../files/{$type_file}/{$fname}");
								$sha1=sha1_file("../files/{$type_file}/{$fname}");
						}
	

						if ($_FILES['cbuilders_thumb']['type']==="image/jpeg" || $_FILES['cbuilders_thumb']['type']==="image/gif" || $_FILES['cbuilders_thumb']['type']==="image/png" || $_FILES['cbuilders_thumb']['type']==="image/pjpeg" || $_FILES['cbuilders_thumb']['type']==="image/x-png"){
							if ($_FILES['cbuilders_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['cbuilders_thumb']['type']==="image/gif"){
								$type="gif";
							} elseif ($_FILES['cbuilders_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['cbuilders_thumb']['type']==="image/pjpeg"){
								$type="jpg";
							} elseif ($_FILES['cbuilders_thumb']['type']==="image/x-png"){
								$type="png";
							}
							$img="{$unical}.{$type}";
							move_uploaded_file($_FILES['cbuilders_thumb']['tmp_name'], "../images/library/bulletin/origin/{$img}");
							@include_once("function_image_resize.php");
							@include_once("function_image_quadrat.php");
							$z=end(explode('.', "../images/library/bulletin/origin/{$img}"));
							if($z=='jpg' || $z=='gif'){
								$str=file_get_contents("../images/library/bulletin/origin/{$img}");
								$str_q2=image_resize($str,72,98, 100);
								file_put_contents("../images/library/bulletin/thumbs/{$img}", $str_q2);
								
								$q="INSERT INTO {$CONF['dbtable']['cbuilders']} SET 
									thumbnails='{$img}', 
									name='{$fname}',
									real_name='{$_FILES['cbuilders_file']['name']}',
									type='{$type_file}',
									number='{$_POST['cbuilders_number']}',
									year='{$_POST['cbuilders_year']}',
									pages='{$_POST['cbuilders_pages']}',
									size='{$_FILES['cbuilders_file']['size']}',
									upload_date='{$date}',
									info='{$_SESSION['ysuac_admin_id']}'
									";
								mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
								mysql_query($q,$CONN);
								#pre($_FILES);
							}
						}
					}
				}
			}
		}
	}
}
#---------------------------------------------------------------------------------------------------
#--------------------------------------------add_credit_bulletin---------------------------------------------
if($_POST['add_credit_bulletin']){
	if($_FILES['credit_bulletin_thumb']['tmp_name']){
		if($_POST['credit_bulletin_number']){
			if($_POST['credit_bulletin_year']){
				if($_POST['credit_bulletin_pages']){
					if($_FILES['credit_bulletin_file']['tmp_name']){
						$datetime=date("YmdHis");
						list($usec)=explode(' ',microtime());
						$usec=substr($usec,2,6);
						$rand=mt_rand(10000000,99999999);
						$unical="{$datetime}_{$usec}_{$rand}";	
						$type_file=end(explode(".", $_FILES['credit_bulletin_file']['name']));
						$fname="file_{$unical}.{$type_file}";
						if ($_FILES['credit_bulletin_file']['type']==="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
							$_FILES['credit_bulletin_file']['type']==="application/vnd.ms-excel" ||
							$_FILES['credit_bulletin_file']['type']==="application/x-rar" || 
							$_FILES['credit_bulletin_file']['type']==="application/octet-stream" || 
							$_FILES['credit_bulletin_file']['type']==="application/vnd.openxmlformats-officedocument.presentationml.presentation"|| 
							$_FILES['credit_bulletin_file']['type']==="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"|| 
							$_FILES['credit_bulletin_file']['type']==="application/pdf" ||
							$_FILES['credit_bulletin_file']['type']==="application/msword" ||
							$_FILES['credit_bulletin_file']['type']==="application/x-zip-compressed" ||
							$_FILES['credit_bulletin_file']['type']==="image/jpeg"){
								$aa=move_uploaded_file($_FILES['credit_bulletin_file']['tmp_name'], "../files/{$type_file}/{$fname}");
								$sha1=sha1_file("../files/{$type_file}/{$fname}");
						}
	

						if ($_FILES['credit_bulletin_thumb']['type']==="image/jpeg" || $_FILES['credit_bulletin_thumb']['type']==="image/gif" || $_FILES['credit_bulletin_thumb']['type']==="image/png" || $_FILES['credit_bulletin_thumb']['type']==="image/pjpeg" || $_FILES['credit_bulletin_thumb']['type']==="image/x-png"){
							if ($_FILES['credit_bulletin_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['credit_bulletin_thumb']['type']==="image/gif"){
								$type="gif";
							} elseif ($_FILES['credit_bulletin_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['credit_bulletin_thumb']['type']==="image/pjpeg"){
								$type="jpg";
							} elseif ($_FILES['credit_bulletin_thumb']['type']==="image/x-png"){
								$type="png";
							}
							$img="{$unical}.{$type}";
							move_uploaded_file($_FILES['credit_bulletin_thumb']['tmp_name'], "../images/library/bulletin/origin/{$img}");
							@include_once("function_image_resize.php");
							@include_once("function_image_quadrat.php");
							$z=end(explode('.', "../images/library/bulletin/origin/{$img}"));
							if($z=='jpg' || $z=='gif'){
								$str=file_get_contents("../images/library/bulletin/origin/{$img}");
								$str_q2=image_resize($str,72,98, 100);
								file_put_contents("../images/library/bulletin/thumbs/{$img}", $str_q2);
								
								$q="INSERT INTO {$CONF['dbtable']['credit_bulletin']} SET 
									thumbnails='{$img}', 
									name='{$fname}',
									real_name='{$_FILES['credit_bulletin_file']['name']}',
									type='{$type_file}',
									number='{$_POST['credit_bulletin_number']}',
									year='{$_POST['credit_bulletin_year']}',
									pages='{$_POST['credit_bulletin_pages']}',
									size='{$_FILES['credit_bulletin_file']['size']}',
									upload_date='{$date}',
									info='{$_SESSION['ysuac_admin_id']}'
									";
								mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
								mysql_query($q,$CONN);
								#pre($_FILES);
							}
						}
					}
				}
			}
		}
	}
}
#---------------------------------------------------------------------------------------------------
#---------------------------------------- press_about ------------------------------------------
if($_SESSION['go']=="press_about" && $_POST['etext_press_about']){
	$q="UPDATE {$CONF['dbtable']['press_about']} SET 
		{$text_lang}='".addslashes($_POST['etext_press_about'])."', 
		info='{$_SESSION['ysuac_admin_id']}'
	";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	mysql_query($q,$CONN);
}
#---------------------------------------------------------------------------------------------------
#--------------------------------------------add_journal---------------------------------------------
if($_POST['add_journal']){
	if($_FILES['journal_thumb']['tmp_name']){
		if($_POST['journal_number']){
			if($_POST['journal_year']){
				if($_POST['journal_pages']){
					if($_FILES['journal_file']['tmp_name']){
				
				
						$datetime=date("YmdHis");
						list($usec)=explode(' ',microtime());
						$usec=substr($usec,2,6);
						$rand=mt_rand(10000000,99999999);
						$unical="{$datetime}_{$usec}_{$rand}";	
						$type_file=end(explode(".", $_FILES['journal_file']['name']));
						$fname="file_{$unical}.{$type_file}";
						if ($_FILES['journal_file']['type']==="application/vnd.openxmlformats-officedocument.wordprocessingml.document" || 
							$_FILES['journal_file']['type']==="application/vnd.ms-excel" ||
							$_FILES['journal_file']['type']==="application/x-rar" || 
							$_FILES['journal_file']['type']==="application/octet-stream" || 
							$_FILES['journal_file']['type']==="application/vnd.openxmlformats-officedocument.presentationml.presentation"|| 
							$_FILES['journal_file']['type']==="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"|| 
							$_FILES['journal_file']['type']==="application/pdf" ||
							$_FILES['journal_file']['type']==="application/msword" ||
							$_FILES['journal_file']['type']==="application/x-zip-compressed" ||
							$_FILES['journal_file']['type']==="image/jpeg"){
								move_uploaded_file($_FILES['journal_file']['tmp_name'], "../files/{$type_file}/{$fname}");
								$sha1=sha1_file("../files/{$type_file}/{$fname}");
						}
	

						if ($_FILES['journal_thumb']['type']==="image/jpeg" || $_FILES['journal_thumb']['type']==="image/gif" || $_FILES['journal_thumb']['type']==="image/png" || $_FILES['journal_thumb']['type']==="image/pjpeg" || $_FILES['journal_thumb']['type']==="image/x-png"){
							if ($_FILES['journal_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['journal_thumb']['type']==="image/gif"){
								$type="gif";
							} elseif ($_FILES['journal_thumb']['type']==="image/jpeg"){
								$type="jpg";
							} elseif ($_FILES['journal_thumb']['type']==="image/pjpeg"){
								$type="jpg";
							} elseif ($_FILES['journal_thumb']['type']==="image/x-png"){
								$type="png";
							}
							$img="{$unical}.{$type}";
							move_uploaded_file($_FILES['journal_thumb']['tmp_name'], "../images/library/journal/origin/{$img}");
							@include_once("function_image_resize.php");
							@include_once("function_image_quadrat.php");
							$z=end(explode('.', "../images/library/journal/origin/{$img}"));
							if($z=='jpg' || $z=='gif'){
								$str=file_get_contents("../images/library/journal/origin/{$img}");
								$str_q2=image_resize($str,72,98, 100);
								file_put_contents("../images/library/journal/thumbs/{$img}", $str_q2);
								
								$q="INSERT INTO {$CONF['dbtable']['journal']} SET 
									thumbnails='{$img}', 
									name='{$fname}',
									real_name='{$_FILES['journal_file']['name']}',
									type='{$type_file}',
									number='{$_POST['journal_number']}',
									year='{$_POST['journal_year']}',
									pages='{$_POST['journal_pages']}',
									size='{$_FILES['journal_file']['size']}',
									upload_date='{$date}',
									info='{$_SESSION['ysuac_admin_id']}'
									";
								mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
								mysql_query($q,$CONN);
								#pre($_FILES);
							}
						}
					}
				}
			}
		}
	}
}




#---------------------------------------------------------------------------------------------------

?>