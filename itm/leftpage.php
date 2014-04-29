<div id="sidebar-a">
   <img border="1" width="180px" align="center"  src="images/image01.jpg" alt="" />
   <br /><br />
 <?
 if($_GET['lng'] == 1)
 {
 //include("left/en_menu.php");
 }
 elseif($_GET['lng'] == 2)
 {
 //include("left/ru_menu.php");
 }
 else{
	include("pages/left/arm_menu.php");
 }
 ?>

</div>

<?



?>