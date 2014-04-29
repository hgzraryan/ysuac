<?php
if ($INCLUDE!=1){
	session_destroy();
	header("location:index.php");
	exit();
}
#----------------- database configure ----------------
$CONF[SERVER_TYPE]="secondary";
#$CONF[SERVER_TYPE]="primary";

if (  $CONF[SERVER_TYPE]=="primary" ) {
	$CONF[db][host]="localhost";
	$CONF[db][user]="root";
	$CONF[db][pass]="";
	$CONF[db][name]="tm";
} elseif ($CONF[SERVER_TYPE]=="secondary") {
	$CONF[db][host]="127.0.0.1";
	$CONF[db][user]="tm";
	$CONF[db][pass]="tm.seua.am";
	$CONF[db][name]="tm";
}
$CONF['dbtable']['administrators']="administrators";
$CONF['dbtable']['news']="news";
#----------------------------------------------------

#----------------------- alow pages -----------------
$ALLOWED_PAGES["home"]=1;
$ALLOWED_PAGES["about"]=1;
$ALLOWED_PAGES["training_program"]=1;
$ALLOWED_PAGES["lecturer"]=1;
$ALLOWED_PAGES["educational_direction"]=1;
$ALLOWED_PAGES["register"]=1;
$ALLOWED_PAGES["login"]=1;
$ALLOWED_PAGES["news"]=1;
$ALLOWED_PAGES["ebooks"]=1;
$ALLOWED_PAGES["schedule"]=1;
$ALLOWED_PAGES["graduates"]=1;
$ALLOWED_PAGES["g_applicanes"]=1;
#----------------------------------------------------

#--------------------- admin pages ------------------
$ALLOWED_PAGES["news"]=1;
$ALLOWED_PAGES["logout"]=1;
$ALLOWED_PAGES["admin_logout"]=1;
$ALLOWED_PAGES["lecturers"]=1;
#----------------------------------------------------
?>