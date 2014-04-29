<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
function image_quadrat($data,$quality=100,$type="jpg") {
	if ( $quality==null ) { $quality=100; }
	
	$src=imagecreatefromstring($data);
	$width_orig=imagesx($src);
	$height_orig=imagesy($src);
	
	if ( $width_orig>=$height_orig ) {
		$x=(int)(($width_orig-$height_orig)/2);
		$y=0;
		$new_size=$height_orig;
	} else {
		$y=(int)(($height_orig-$width_orig)/2);
		$x=0;
		$new_size=$width_orig;
	}

	$dest=imagecreatetruecolor($new_size,$new_size);
	imagecopy($dest, $src, 0, 0, $x, $y, $new_size, $new_size);
	
	
	ob_start();
	switch($type) {
		case "jpg":
		case "jpeg":
			imagejpeg($dest,NULL,$quality);
		break;
		case "png":
			imagepng($dest,NULL,$quality);
		break;
		case "gif":
			imagegif($dest,NULL);
		break;
		case "wbmp":
			imagewbmp($dest,NULL);
		break;
	}
	$out_img=ob_get_contents();
	ob_end_clean();
	
	imagedestroy($src);
	imagedestroy($dest);
	return $out_img;
}


?>