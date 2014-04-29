<?php
session_start();
$ADMIN_PROTECT=1;
@include_once("languages/lang.php");
@include_once("login_action.php");
#pre($_SESSION);
echo <<<html
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>{$LANG['login_title'][$_SESSION[lang]]}</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="generator" content="H.G." />
	<meta name="robots" content="index,follow" />
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<link href="css/admin.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td valign="top" align="center">
			<table border="0" cellpadding="0" cellspacing="0" width="966" height="100%">
				<tr>
					<td id="top_left"></td>
					<td id="top_center">
						<div id="home_b">
							<a href="http://{$_SERVER['SERVER_NAME']}"><img src="images/home.png"></a>
						</div>
						<div id="lang_b">
							<ul id="lang">
								<li><a href="?lang=am" title="Հայերեն"><img src="images/arm.png"></a></li>
								<li><a href="?lang=ru" title="Русский"><img src="images/rus.png"></a></li>
								<li><a href="?lang=en"title="English"><img src="images/eng.png"></a></li>
								<li><a href="?lang=fr" title="France"><img src="images/fra.png"></a></li>
							</ul>
						</div>
					</td>
					<td id="top_right"></td>
				</tr>
				<tr>
					<td colspan="3" valign="center" align="center">
						<table border="0" cellpadding="0" cellspacing="0" height="265" id="login_main">
							<tr>
								<td>
									{$error}
									<form method="POST" name="form">
									<div id="login">
										<div id="logo"><a href="http://www.ysuac.am"><img src="images/logo.png" width="35" border="0"></a></div>
										<div id="login_log">
											<h1>{$LANG['login_uname'][$_SESSION[lang]]}</h1>
											<input type="text" name="uname" id="username" autofocus="autofocus">
											<h1>{$LANG['login_passwd'][$_SESSION[lang]]}</h1>
											<input type="password" name="passwd" id="password">
											<input type="image" src="images/login_b_{$_SESSION[lang]}.png" id="login_b" name="submit" onMouseOver=this.src='images/login_ba_{$_SESSION[lang]}.png' onMouseOut=this.src='images/login_b_{$_SESSION[lang]}.png'>
											<input type="hidden" name="submit_h" value="enter">
										</div>
									</div>
									</form>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>	
					<td id="constructor" colspan="3">
						{$LANG['creator'][$_SESSION[lang]]}
					</td>
				</tr>
			</table>
		</td>
	</tr>	
</table>
</body>
</html>
html;
 ?>