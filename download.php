<?php
$INCLUDE="allow";
@include_once("conf.php");
@include_once("dbcfg.php");
if($_GET['file']){
$q_fd="SELECT * FROM {$CONF['dbtable']['files']} WHERE id='".addslashes($_GET['file'])."'";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_fd=mysql_query($q_fd,$CONN);
$row_fd=mysql_fetch_assoc($r_fd);

$dir="files/".$row_fd['type']."/";
$file_path=$dir.$row_fd['path'];
header("Content-type: application/{$type}");
header("Content-Disposition: attachment; filename="."{$row_fd['unic_name']}");
$f=fopen($file_path,"r");
while(   ($str=fread($f,8192))!=false   ) {
	echo $str;
}
fclose($f);
}else{
	header("location:http://{$_SERVER['SERVER_NAME']}");
	exit();
}
?>