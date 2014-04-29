<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
echo "<div id='error'>";
	echo "ERROR 404 Page not found";
echo "</div>";
?>