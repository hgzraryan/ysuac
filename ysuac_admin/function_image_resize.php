<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}

function image_resize($data,$width=null,$height=null,$quality=100,$interlace=false,$type="jpg") {
	
	if ( !$width && !$height ) {
		return $data;
	}

	$im=imagecreatefromstring($data);
	$width_orig=imagesx($im);
	$height_orig=imagesy($im);
	$ratio=$width_orig/$height_orig;
	
	
	if ( $width && !$height ) {
		$xx=$width;
		$yy=(int)($width/$ratio);
	}
	if ( $height && !$width ) {
		$yy=$height;
		$xx=(int)($height*$ratio);
	}
	
	if ( $width && $height) {
		if ( $ratio>=1 ) {
			if ( ($width/$ratio)<=$height ) {
				$xx=$width;
				$yy=(int)($width/$ratio);
			} else {
				$yy=$height;
				$xx=(int)($height*$ratio);
			}
		} else {
			if ( ($height*$ratio)<=$width ) {
				$yy=$height;
				$xx=(int)($height*$ratio);
			} else {
				$xx=$width;
				$yy=(int)($width/$ratio);
			}
		}
	}
	
	$im_small=imagecreatetruecolor($xx, $yy);
	if ( $interlace==true ) { imageinterlace($im_small,true); }
	imagecopyresampled($im_small, $im, 0, 0, 0, 0, $xx, $yy, $width_orig, $height_orig);
	

	ob_start();
	switch($type) {
		case "jpg":
		case "jpeg":
			imagejpeg($im_small,NULL,$quality);
		break;
		case "png":
			imagepng($im_small,NULL,$quality);
		break;
		case "gif":
			imagegif($im_small,NULL);
		break;
		case "wbmp":
			imagewbmp($im_small,NULL);
		break;
	}
	$out_img=ob_get_contents();
	ob_end_clean();
	
	imagedestroy($im_small);
	imagedestroy($im);
	return $out_img;
}

function image_resize_noratio($data,$width=null,$height=null,$quality=100, $type="jpg") {
	
	if ( !$width && !$height ) {
		return $data;
	}

	$im=imagecreatefromstring($data);
	$width_orig=imagesx($im);
	$height_orig=imagesy($im);
	
	

	
	if ( $width && $height) {
		$xx=$width;
		$yy=$height;
	}
	
	$im_small=imagecreatetruecolor($xx, $yy);
	if ( $interlace==true ) { imageinterlace($im_small,true); }
	imagecopyresampled($im_small, $im, 0, 0, 0, 0, $xx, $yy, $width_orig, $height_orig);
	

	ob_start();
	switch($type) {
		case "jpg":
		case "jpeg":
			imagejpeg($im_small,NULL,$quality);
		break;
		case "png":
			imagepng($im_small,NULL,$quality);
		break;
		case "gif":
			imagegif($im_small,NULL);
		break;
		case "wbmp":
			imagewbmp($im_small,NULL);
		break;
	}
	$out_img=ob_get_contents();
	ob_end_clean();
	
	imagedestroy($im_small);
	imagedestroy($im);
	return $out_img;
}



?>