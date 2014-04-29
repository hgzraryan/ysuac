<?php
session_start();
if(!$_SESSION['ysuac_admin_id']){
	session_destroy();
	header("location:index.php");
	exit();
}
#echo $lang_get;
$ADMIN_PROTECT="allow";
@include_once("languages/lang.php");
@include_once("admin_action.php");
#pre($_SERVER);
#pre($_POST);
#pre($_FILES);
#pre($_SESSION);
echo <<<html
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>{$LANG['creator'][$_SESSION[lang]]}</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="generator" content="H.G." />
	<meta name="robots" content="index,follow" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<link href="css/admin.css" rel="stylesheet" type="text/css" media="all" />
	<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
	<script type="text/javascript" src="highslide/highslide-with-html.js"></script>
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/checkboxChanger.js"></script>
	<script type="text/javascript" src="js/live_s.js"></script>
	<script type="text/javascript">
		hs.graphicsDir = 'highslide/graphics/';
		hs.outlineType = 'rounded-white';
		hs.wrapperClassName = 'draggable-header';
	
	
		function chradioEnableSubmit(val) {
			var sbmt = document.getElementById('moderators_depart');
			if (val === "1") {
				moderators_depart.disabled = false;
			}
			else {
				moderators_depart.disabled = true;
			}
		}
		function checkboxEnableSubmit(val) {
			var sbmt = document.getElementById('moderators_depart');
			if (val === "0") {
				moderators_depart.disabled = false;
			}
			else {
				moderators_depart.disabled = true;
			}
		}
	</script>
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
							<a href="?go=exit"><img src="images/exit.png" title="{$LANG['admin_lang15'][$_SESSION[lang]]}"></a>
						</div>
						<div id="admin_ind">
							{$_SESSION['admin_fname']}
							{$_SESSION['admin_lname']}
						</div>
						<div id="visitor_b">
							{$LANG['admin_visitor'][$_SESSION[lang]]} <span title="{$vis_date}">{$vip}</span>
						</div>
						<div id="lang_b">
							<ul id="lang">
								<li><a href="?go={$_GET['go']}{$lang_get}&lang=am" title="Հայերեն"><img src="images/arm.png"></a></li>
								<li><a href="?go={$_GET['go']}{$lang_get}&lang=ru" title="Русский"><img src="images/rus.png"></a></li>
								<li><a href="?go={$_GET['go']}{$lang_get}&lang=en" title="English"><img src="images/eng.png"></a></li>
								<li><a href="?go={$_GET['go']}{$lang_get}&lang=fr" title="France"><img src="images/fra.png"></a></li>
							</ul>
						</div>
					</td>
					<td id="top_right"></td>
				</tr>	
				<tr>
					<td colspan="3">
						<div id="paraph"></div>
						<div id="optbar">
							<div id="optbar_left"></div>
							<div id="optbar_center">
								<div id="left_div1">
									<form autocomplete="off" method="POST" name="s">
										<input type="text" name="search" id="search_bar" onkeyup="showResult(this.value)" autofocus="autofocus">
									</form>
									<div id="livesearch"></div>
									<div id="left_div1_sub">
										<a href="admin.php?go=alumni">{$LANG['admin_menu58'][$_SESSION[lang]]}</a><br />
										<a href="admin.php?go=press_about">{$LANG['admin_menu77'][$_SESSION[lang]]}</a>
									</div>
								</div>
								<div id="left_div2">
									<a href="admin.php?go=home">{$LANG['admin_menu7'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=our_university">{$LANG['admin_menu8'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=for_applicant">{$LANG['admin_menu9'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=030_spec">{$LANG['admin_menu33'][$_SESSION[lang]]}</a><br />
									<!--<a href="admin.php?go=departments">{$LANG['admin_moderators4'][$_SESSION[lang]]}</a><br />-->
								</div>
								<div id="left_div3">
									<a href="admin.php?go=bologna_process">{$LANG['admin_menu10'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=library">{$LANG['admin_menu11'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=performance">{$LANG['admin_menu12'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=our_partners">{$LANG['admin_menu42'][$_SESSION[lang]]}</a><br />
									<!--<a href="admin.php?go=gallery">{$LANG['admin_menu4'][$_SESSION[lang]]}</a><br />-->
									<!--<a href="admin.php?go=library">{$LANG['admin_menu5'][$_SESSION[lang]]}</a><br />-->
								</div>
								<div id="left_div4">
									<a href="admin.php?go=gallery">{$LANG['admin_menu4'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=files">{$LANG['admin_menu24'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=int_coo">{$LANG['admin_menu30'][$_SESSION[lang]]}</a><br />
									<a href="admin.php?go=legal_acts">{$LANG['admin_menu51'][$_SESSION[lang]]}</a><br />
								</div>
								<div id="left_div5">
									<a href="admin.php?go=admin_system"><img src="images/options.png"></a>
								</div>
							</div>
							<div id="optbar_right"></div>
						</div>
						<div id="paraph"></div>
					</td>
				</tr>
				<tr><td height="10" colspan="3"></td></tr>
				<tr>
					<td colspan="3" style="padding-right:3px;">
html;
	include_once("~incl_files/incl_{$_SESSION[go]}.php");
echo <<<html
					</td>
				</tr>
				<tr><td colspan="3" height="10"></td></tr>
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