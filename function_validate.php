<?php
if($INCLUDE!="allow"){
	header("location:index.php");
	exit();
}
function pre($a){echo "<pre>";print_r($a);echo "</pre>";}
function decode($dec_n){$decode=base64_decode($dec_n); return($decode);}
function validate ($str,$type) {
	switch($type) {
		case "username": {
			if ( preg_match("/^[a-z0-9-_][a-z0-9-_]{1,25}[a-z0-9]$/i", $str) )  {
				return true; } else { return false; }
			break;
		}
		case "password": {
			if ( preg_match("/^[a-z0-9-_]{3,21}$/i", $str) )  {
				return true; } else { return false;	}
			break;
		}
		case "get": {
			if ( preg_match("/^[a-z0-9-_]{2,41}$/i", $str) )  {
				return true; } else { return false;	}
			break;
		}
		case "get_num": {
			if (  ereg("^[0-9]", $str)   )  {
				return true; } else { return false;
			}
			break;
		}	
		case "post": {
			if ( preg_match("/^[a-z0-9-_]{2,30}$/i", $str) )  {
				return true; } else { return false;	}
			break;
		}
		case "num": {
			if (  ereg("^[0-9]", $str)   )  {
				return true; } else { return false;
			}
			break;
		}	
		case "mail": {
			if (  ereg("^[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[@]{1}[-A-Za-z0-9_]+[-A-Za-z0-9_.]*[.]{1}[A-Za-z]{2,4}$", $str)   ) {
				return true; } else { return false;
			}
		break;
		}
		/*
		case "get": {
			if (  ereg("^[0-9]", $str)   )  {
				return true; } else { return false;
			}
			break;
		}	*/
	}
}
function string_limiter($string,$c){
	$chars = preg_split('/<[^>]*[^\/]>/i', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	$name_unsplit=implode("",$chars);
	$results = array();
	preg_match_all('/./u', $name_unsplit, $results);
	foreach($results[0] as $key => $value){
		if($key<=$c){
			echo $value;
		}
	}
	if($results[0][$c]){
		echo "...";
	}
}
function datetime($datetime){
	if($datetime){
		$string=explode(" ",$datetime);
		$time=explode(":",$string['1']);
		$date=explode("-",$string['0']);
		echo $date['2']."-".$date['1']."-".$date['0']." ".$time['0'].":".$time['1'];
	}
}


?>