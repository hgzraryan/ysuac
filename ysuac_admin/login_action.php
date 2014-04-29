<?php
if($ADMIN_PROTECT!="1"){
	header("location: login.php");
	exit();
}
$INCLUDE="allow";
@include_once("../function_validate.php");
@include_once("../conf.php");
@include_once("../dbcfg.php");
if($_POST['submit_x'] || $_POST['submit_h']){
	if($_POST['uname'] && $_POST['passwd']){
		if(validate($_POST['uname'], "username")){
			$username=$_POST['uname'];
			if(validate($_POST['passwd'], "password")){
				$password=$_POST['passwd'];
			}else {
				$error="<div id='login_error'>{$LANG[login_error1][$_SESSION[lang]]}</div>";
			}
		}else {
			$error="<div id='login_error'>{$LANG[login_error2][$_SESSION[lang]]}</div>";
		}
		if($username && $password){
			$username=md5($username);
			$password=md5($password);
			#echo $username."</br>";
			#echo $password."</br>";
			$q="SELECT * FROM {$CONF['dbtable']['admin_premoderators']} WHERE username_md5='".addslashes($username)."' AND password_md5='".addslashes($password)."'";
			mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
			$r=mysql_query($q,$CONN);
			$row=mysql_fetch_assoc($r);
			#echo $q;
			if($row){
				if($row['group_id']==0){
					if($row['status']==1){
						$_SESSION['admin_fname']=$row['first_name'];
						$_SESSION['admin_lname']=$row['last_name'];
						$_SESSION['group_id']=$row['group_id'];
						$_SESSION['ysuac_admin_id']=$row['id'];
						#pre($_SESSION);
						session_write_close();
						header("location:admin.php");
						exit();
					}else{
						$error="<div id='login_error'>{$LANG['login_error4'][$_SESSION['lang']]}</div>";
					}
				}
			}else{
				$error="<div id='login_error'>{$LANG['login_error3'][$_SESSION['lang']]}</div>";
			}
		}
	} else {
		$error="<div id='login_error'>{$LANG['login_error4'][$_SESSION['lang']]}</div>";
	}
}
if ( !isset($_SESSION['lang']) ){
	$_SESSION['lang']="am";
}
if ( $_GET['lang']=="am" || $_GET['lang']=="ru" || $_GET['lang']=="en" || $_GET['lang']=="fr"){
	$_SESSION['lang']=$_GET['lang'];
}
?>