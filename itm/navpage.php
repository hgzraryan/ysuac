<?
$lang=$_GET['lng'];
if($_GET['lng'] == 1)
{
	include("pages/navig/en_menu.php");
}
else if($_GET['lng'] == 2)
{
	include("pages/navig/ru_menu.php");
}else{
	include("pages/navig/arm_menu.php");
	
}


?>