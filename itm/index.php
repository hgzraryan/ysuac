<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ITM Site</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/modern.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style/style.css" />
<!-- Beginning of compulsory code below -->
<link href="css/dropdown/dropdown.vertical.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/dropdown/themes/default/default.css" media="screen" rel="stylesheet" type="text/css" />

<!--[if lt IE 7]>
<script type="text/javascript" src="js/jquery/jquery.js"></script>
<script type="text/javascript" src="js/jquery/jquery.dropdown.js"></script>
<![endif]-->

<!-- / END -->


</head>

<body>
<?
/*stugel page@ numbera te che*/
if(is_numeric($_GET['page']) && isset($_GET['page'])  ){
	$page = $_GET['page'];
}else{
	$page = 1;
	}
	
if(is_numeric($_GET['lng'])&& $_GET['lng'] == 1)
 {
	 $lang = $_GET['lng'];
 
 }
 elseif(is_numeric($_GET['lng'])&& $_GET['lng'] == 2)
 {
	  $lang = $_GET['lng'];

 }
 else{
	  $lang = 0;

 }
?>

<table id="maintb" cellpadding="0" cellspacing="0">
<tr><td colspan="3" id="banner" ><img src="images/header.jpg" border="0" />

<!--div id="lang" align="right" style="float:right;border: 0px solid;">
<a href="?page=<?/*$page*/?>&lng=0">Հայերեն</a>&nbsp;|&nbsp;
<a href="?page=<?/*$page*/?>&lng=2">Русский</a> &nbsp;|&nbsp;
<a href="?page=<?/*$page*/?>&lng=1">English</a>
</div-->
</td></tr>

<tr><td colspan="3" id="banner2" >
<?
	include("navpage.php");

?>

</td></tr>
<tr>
<td id="left" valign="top" width="200px"> 
<?
	include("leftpage.php");

?>

</td>
<td id="content" valign="top" >
<?
include("contentpage.php");

?>



</td>

<td id="right" valign="top" width="200px">
<?
include("rightpage.php");

?>

</td></tr>
<tr><td id="footer" colspan="3"></td></tr>

</table>
</body>
</html>