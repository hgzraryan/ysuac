<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
function watermark($img){
$photo = imagecreatefromjpeg($img);
// This is the key. Without ImageAlphaBlending on, the PNG won't render correctly.
imagealphablending($photo, true);
// Copy the watermark onto the master, $offset px from the bottom right corner.
$width_xp=imagesx($photo);
$width_yp=imagesy($photo);
$watermark = imagecreatefrompng("watermark/watermark.png");
$width_xw=imagesx($watermark);
$width_yw=imagesy($watermark);
$offsetx = 10;
$offsety = 5;
imagecopy($photo, $watermark, $width_xp - $width_xw - $offsetx, $width_yp - $width_yw - $offsety, 0, 0, imagesx($watermark), imagesy($watermark));
ob_start();
imagejpeg($photo);
imagedestroy($photo);
$str=ob_get_contents();
ob_end_clean();
imagedestroy($watermark);
return $str;
}
?>