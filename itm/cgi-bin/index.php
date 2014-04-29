<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ITM</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="moderna.css" rel="stylesheet" type="text/css" />
<form action="index.html"/>
<style type="text/css">
<!--
.style1 {
	font-size: 16px;
	font-weight: bold;
}
.style2 {font-size: 16px}
-->
</style>
</head>
<body>


<div id="container">

  <div id="banner">
  </div>
  <!-- Begin Top Menu -->
  <ul id="navlist">
    <li id="active"><a id="current" href="index.php?page=1">Գլխավոր</a></li>
        <li><a href="#">Նկարներ</a></li>
       <li><a href="index.php?page=6">Մեր տվյալները	</a></li>
  </ul>
  <!-- End Top Menu -->
  <div id="sidebar-a"> <img border="1" width="148px" align="center"  src="images/image01.jpg" alt="" />
    <h2>ԲԱԺԻՆ</h2>
	<div class='autocomplete' id='term_list' style='display:none'></div> 
    <div class="menu" >
	
      <ul>
        <li><a href="index.php?page=1">Գլխավոր</a></li>
        <li><a href="index.php?page=2">Պատմություն</a></li>
        <li><a href="index.php?page=3"> Աշխատակազմը</a></li>
        <li><a href="index.php?page=4">Միջազգային ծրագրեր</a> </li>
        <li><a href="index.php?page=5">Ուսանողին</a></li>
        
      </ul>
	  
    </div>
  </div>
</div>
  <div id="sidebar-b">
    <h3>Information</h3>
    <p>&nbsp; </p>
    <h3>Gallery</h3>
    <img class="border" src="images/image02.jpg" alt="" />
    <p>&nbsp;</p>
  </div>
  <div class="es" id="e">
    <div class="border" id="content">
	
	
	
	<?
	if($_GET['page'] == 1)
	{
		include("home.php");
	}elseif($_GET['page'] == 2)
	{
		include("patm.php");
	}elseif($_GET['page'] == 3)
	{
		include("ashxat.php");
	}elseif($_GET['page'] == 4)
	{
		include("interprog.php");
	}
	elseif($_GET['page'] == 5)
	{
		include("students.php");
	}elseif($_GET['page'] == 6)
	{
		include("contact.php");
	}else{
		include("home.php");
	}
	
	?>
	
     </div>
  <div class="intro2">
      <h3>Article Two</h3>
      <p class="update"> &nbsp; </p>
</div>
    <div class="intro3">
      <h4>News &amp; Updates</h4>
      <p class="update">&nbsp; </p>
    </div>
</div>
  <div id="footer">&nbsp;</div>
</div>
</form>
</body>
</html>
