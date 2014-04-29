<?php
session_start();
$INCLUDE="allow";
@include_once("../function_validate.php");
@include_once("../conf.php");
@include_once("../dbcfg.php");

if($_GET['q'] && $_GET['q']!=" "){
	$q = $_GET['q'];
	mysql_query("SET NAMES utf-8");
	$ref_q="SELECT * FROM site_str_languages WHERE armenian LIKE '%{$q}%' LIMIT 10";
	#echo $ref_q;
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$ref_r=mysql_query($ref_q,$CONN);
	$i=1;
	while( ( $row_ref=mysql_fetch_assoc($ref_r))!=false ){
			echo "<a href='?go=admin_system&sub=site_languages&sid={$row_ref['id']}'><div style='padding:10px;color:#333;'>";
				$replace="<span style='color:red;'>".$q."</span>";
				echo str_ireplace($q, $replace,"<span>".$row_ref['armenian']."</span>")."</br>"; 
				echo $row_ref['description'];
			echo "</div></a>";
	$i++;
	}
}
?>