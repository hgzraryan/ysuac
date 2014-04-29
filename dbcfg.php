<?php
if ($INCLUDE!="allow"){
	session_destroy();
	header("location:http://{$_SERVER['SERVER_NAME']}");
	exit();
}
##### DB
$CONN=@mysql_connect($CONF['db']['host'],$CONF['db']['user'],$CONF['db']['pass']);  
if (!$CONN) { 
echo <<<html
	<html> 
		<head>
			<title>Սպասարկում!</title>
			<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		</head>
		<body>
			Կայքը ժամանակավորապես հասանելի չէ:
		</body>
	</html> 
html;
	exit(); 
}
$select_db=@mysql_select_db($CONF['db']['name'], $CONN);
if (!$select_db) {
echo <<<html
	<html> 
		<head>
			<title>Սպասարկում!</title>
			<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		</head>
		<body>
			Կայքը ժամանակավորապես հասանելի չէ:
		</body>
	</html> 
html;
	exit(); 
}
///// DB
date_default_timezone_set('Asia/Yerevan');
	

?>
