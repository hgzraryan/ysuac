<?php
session_start();
$INCLUDE="allow";
@include_once("conf.php");
@include_once("dbcfg.php");
@include_once("index_action.php");
#pre($_SERVER);
echo <<<html
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$_SL['title']}</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="generator" content="Harutyun Gzraryan" />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' /> 
	<meta name='viewport' content='width=device-width, initial-scale=1.0' /> 
	<meta name="robots" content="index,follow" />
	<meta name='description' content='{$_META['description']}' />
	<meta name='Keywords' content='ճարտարապետություն, ազգային համալսարան, պոլիտեխնիկ' />
	<link rel="icon" type="image/vnd.microsoft.icon" href="images/favicon.ico" />
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
	<link href="css/main_style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/slider.css" rel="stylesheet" type="text/css" media="all" />		
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
	<script type="text/javascript" src="js/ddaccordion.js"></script>
	<script type="text/javascript" src="js/menu.js"></script>
	<script type="text/javascript" src="js/timer.js"></script>
	<script type="text/javascript" src="js/motiongallery.js"></script>
	
	
	<script type="text/javascript" src="js/common.js"></script>
<!----------------------------------------------------------->
	<link href="highslide/highslide.css" rel="stylesheet" type="text/css" media="all" />		
	
	
	<script type="text/javascript" src="highslide/highslide-full.js"></script>
	<script type="text/javascript">
		hs.graphicsDir = 'highslide/graphics/';
		hs.align = 'center';
		hs.transitions = ['expand', 'crossfade'];
		hs.outlineType = 'rounded-white';
		hs.fadeInOut = true;
		hs.showCredits = false;
		hs.wrapperClassName = 'draggable-header';
		hs.dimmingOpacity = 0.75;
		// define the restraining box
		hs.useBox = true;
		hs.width = 800;
		hs.height = 600;
		hs.addSlideshow({
			interval: 5000,
			repeat: false,
			useControls: true,
			fixedControls: 'fit',
			overlayOptions: {
				opacity: 1,
				position: 'bottom center',
				hideOnMouseOut: true
			}
		});
	</script>

<!----------------------------------------------------------->
	
	
<script type="text/javascript">
$(document).ready(function() {
	$("#content div").hide(); // Initially hide all content
	$("#tabs li:first").attr("id","current"); // Activate first tab
	$("#content div:first").fadeIn(0); // Show first tab content
    
	$("#library_tabs li:first").attr("id","current"); // Activate first tab
	$("#library_content div").hide(); // Initially hide all content
	$("#library_content div:first").fadeIn(0); // Show first tab content
	
    $('#tabs a').click(function(e) {
        e.preventDefault();        
        $("#content div").hide(); //Hide all content
        $("#tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(0); // Show content for current tab
    });
	
	$('#library_tabs a').click(function(libs_e) {
        libs_e.preventDefault();        
        $("#library_content div").hide(); //Hide all content
        $("#library_tabs li").attr("id",""); //Reset id's
        $(this).parent().attr("id","current"); // Activate this
        $('#' + $(this).attr('title')).fadeIn(0); // Show content for current tab
    });
})();
</script>
	
<!------------------------------------------------------------->	

<!------------------------------------------------------------->
	<script type="text/javascript">
		ddaccordion.init({
			headerclass: "headerbar",
			contentclass: "submenu",
			revealtype: "click",
			mouseoverdelay: 200,
			collapseprev: true,
			defaultexpanded: [0],
			onemustopen: true,
			animatedefault: false,
			persiststate: true,
			toggleclass: ["", "selected"],
			togglehtml: ["", "", ""],
			animatespeed: "normal",
			oninit:function(headers, expandedindices){},
			onopenclose:function(header, index, state, isuseractivated){}
		})
	</script>
	<script type="text/javascript">
		anylinkcssmenu.init("anchorclass")
	</script>
<!---- slideshow---->
    <script type="text/javascript">
    $(window).load(
		function() {
			$('#slider').nivoSlider();
		}
	);
    </script>
	<script>
    $(function () {
      $('.readmore').readmore();
    });
  </script>
<!---- slideshow---->
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="1006" height="100%" align="center" valign="top">
		<tr>
			<td id="header" colspan="3" valign="bottom">
<!---------------------------------------------- header ------------------------------------------------>
				<table border="0" cellpadding="0" cellspacing="0" height="201">
					<tr>
						<td width="35" rowspan="4"></td>
						<td width="160" height="30"></td>
						<td width="28" ></td>
						<td width="465"></td>
						<td width="25"></td>
						<td width="257" align="right"></td>
						<td width="35"></td>
					</tr>
					<tr>
						<td rowspan="3" valign="top">
							<a href="http://www.ysuac.am">
								<img src="images/logo.jpg" border="0" alt="logo">
							</a>
						</td>
						<td></td>
						<td height="107" valign="top" align="left">
							<img src="images/text_{$_SESSION['lang']}.png" border="0">
						</td>
						<td></td>
						<td valign="center" align="left">
							<form method="post">
								<table border="0" cellpadding="0" cellspacing="0" width="257" height="107">
									<tr>
										<td id="search" valign="center" height="28">
											<input type="text" name="search" id="search_bar">
											<input type="image" src="images/search_button.png" title="{$_SL['main_search']}" id="search_button">
										</td>
									</tr>
									<tr><td height="25"></td></tr>
									<tr>
										<td id="language" height="24">
											<ul>
												<li><a href="?goto={$_SESSION['goto']}&lang={$_SLD['fr']}" title="{$_SL['fr']}"><img src="images/fr.png" border="0" width="34"></a></li>
												<li><a href="?goto={$_SESSION['goto']}&lang={$_SLD['en']}" title="{$_SL['en']}"><img src="images/en.png" border="0" width="34"></a></li>
												<li><a href="?goto={$_SESSION['goto']}&lang={$_SLD['ru']}" title="{$_SL['ru']}"><img src="images/ru.png" border="0" width="34"></a></li>
												<li><a href="?goto={$_SESSION['goto']}&lang={$_SLD['am']}" title="{$_SL['am']}"><img src="images/am.png" border="0" width="34"></a></li>
											</ul>
										</td>
									</tr>
									<tr><td>&nbsp;</td></tr>
								</table>
							</form>
						</td>
						<td></td>
					</tr>
					<tr>
						<td height="43" colspan="5" align="left" valign="top">
<!------------------------------------------------------------------------------------------------------------------->
							<div class='button_divam'>
								<ul>
									<li class='{$style_home}'><a href='?goto={$_SLD['home']}'>{$_SL['home']}</a></li>
									<li class='{$style_our_university}'>
										<div class="anchorclass" rel="submenu1"><a href="" onclick="return false;">{$_SL['our_university']}</a></div>
										<div id="submenu1" class="anylinkcss">
											<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
												<tr><td id="navbar_cuc" colspan="3"></td></tr>
												<tr>
													<td id="navbar_cont_left">
														<a href="?goto={$_SLD['menu_history']}">{$_SL['menu_history']}</a><br>
														<a href="?goto={$_SLD['management_board']}">{$_SL['management_board']}</a><br>
														<a href="?goto={$_SLD['scientific_council']}">{$_SL['scientific_council']}</a><br>
														<a href="?goto={$_SLD['rector']}">{$_SL['rector']}</a><br>
														<a href="?goto={$_SLD['departments']}">{$_SL['departments']}</a><br>
														<a href="?goto={$_SLD['faculties']}">{$_SL['faculties']}</a><br>
														<a href="?goto={$_SLD['chairs']}">{$_SL['chairs']}</a>
													</td>
													<td id="navbar_cont_right" valign="top">
														<a href="?goto={$_SLD['units']}">{$_SL['units']}</a><br>
														<a href="?goto={$_SLD['promotion_comments']}">{$_SL['promotion_comments']}</a><br>
														<a href="?goto={$_SLD['construction_college']}">{$_SL['construction_college']}</a><br>
														<a href="?goto={$_SLD['high_school']}">{$_SL['high_school']}</a><br>
														<a href="?goto={$_SLD['astghik_club']}">{$_SL['astghik_club']}</a><br>
														<a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a><br>
													</td>
												</tr>
											</table>
										</div>
									</li>
									<li class='{$style_applicant}'>
										<div class="anchorclass" rel="submenu1"><a href="" onclick="return false;">{$_SL['applicant']}</a></div>
										<div id="submenu1" class="anylinkcss">
											<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
												<tr><td id="navbar_cuc2" colspan="3"></td></tr>
												<tr>
													<td id="navbar_cont_left" valign="center">
														<a href="?goto={$_SLD['high_school']}">{$_SL['high_school']}</a><br>
														<a href="?goto={$_SLD['construction_college']}">{$_SL['construction_college']}</a><br>
														<a href="?goto={$_SLD['entry_course']}">{$_SL['entry_course']}</a><br>
														<a href="?goto={$_SLD['distance_learning']}">{$_SL['distance_learning']}</a><br>
													</td>
													<td id="navbar_cont_right" valign="top">
														<a href="?goto={$_SLD['masters_degree']}">{$_SL['masters_degree']}</a><br>
														<a href="?goto={$_SLD['postgraduate_degree']}">{$_SL['postgraduate_degree']}</a><br>
														<a href="?goto={$_SLD['foreign_entrant']}">{$_SL['foreign_entrant']}</a><br>
														
													</td>
												</tr>
											</table>
										</div>
									</li>
									<li class='{$style_bologna}'><a href='?goto={$_SLD['bologna']}'>{$_SL['bologna']}</a></li>
									<li class='{$style_library}'><a href='?goto={$_SLD['library']}'>{$_SL['library']}</a></li>
									<li class='{$style_our_data}'><a href='?goto={$_SLD['our_data']}'>{$_SL['our_data']}</a></li>
								</ul>
							</div>
<!------------------------------------------------------------------------------------------------------------>
						</td>
					</tr>
					<tr>
						<td></td>
						<td colspan="4" height="20">&nbsp;</td>
					</tr>
				</table>
<!------------------------------------------------------------------------------------------------------>
			</td>
		</tr>
		<tr>
			<td id="main_lstyle"></td>
			<td id="white"></td>
			<td id="main_rstyle"></td>
		</tr>
		<tr>
			<td rowspan="2"></td>
			<td id="body" valign="top" align="left">
<!---------------------------------------------- content ----------------------------------------------->
				<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
					<tr>
						<td valign="top" rowspan="4">
html;
include_once("pages/incl_".$_SESSION['goto'].".php");
echo <<<html
						</td>
						<td width="10" rowspan="4" valign="top"></td>
						<td width="10" rowspan="4" valign="top"><div id="accordion_orangemark"></div></td>
						<td width="280" valign="top">
							<div class="urbangreymenu">
								<h3 class="headerbar"><a href="">{$_SL['international_cooperation']}</a></h3>
								<ul class="submenu">
									<li><div id="mark"></div><a href="?goto={$_SLD['international_rel']}">{$_SL['international_rel']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['events']}">{$_SL['events']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['educational_process']}">{$_SL['educational_process']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['international_conferences']}">{$_SL['international_conferences']}</a></li>
								</ul>
								<h3 class="{$style_sco}"><a href="?goto={$_SLD['specialized_council']}">{$_SL['specialized_council']}</a></h3>
								<h3 class="headerbar"><a href="?goto={$_SLD['student_council']}">{$_SL['student_council']}</a></h3>
								<ul class="submenu">
									<li><div id="mark"></div><a href="?goto={$_SLD['student_life']}">{$_SL['student_life']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['student_guide']}">{$_SL['student_guide']}</a></li>
								</ul>
								<h3 class="headerbar"><a href="?goto={$_SLD['legal_acts']}">{$_SL['legal_acts']}</a></h3>
								<ul class="submenu">
									<li><div id="mark"></div><a target="blank" href="http://www.parliament.am/parliament.php?id=constitution">{$_SL['constitution_ra']}</a></li>
									<li><div id="mark"></div><a target="blank" href="http://www.edu.am/index.php?menu1=85&menu2=89">{$_SL['lagislation_ra']}</a></li>
									<li><div id="mark"></div><a target="blank"  href="https://www.e-gov.am/gov-decrees/calendar/2012/06/">{$_SL['government_decisions']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['order_mse']}">{$_SL['order_mse']}</a></li>
									
									
									<li><div id="mark"></div><a href="?goto=rector&mod=board_decisions">{$_SL['board_decisions']}</a></li>
									
									
									<li><div id="mark"></div><a href="?goto={$_SLD['charter']}">{$_SL['charter']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['governing_council']}">{$_SL['governing_council']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['order_rector']}">{$_SL['order_rector']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['decrees_rector']}">{$_SL['decrees_rector']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['reg_rules']}">{$_SL['reg_rules']}</a></li>
								</ul>
								<h3 class="{$style_sc}"><a href="?goto={$_SLD['science']}">{$_SL['science']}</a></h3>
								<h3 class="headerbar"><a href="?goto={$_SLD['our_partners']}">{$_SL['our_partners']}</a></h3>
								<ul class="submenu">
									<li><div id="mark"></div><a href="?goto={$_SLD['constructors_union']}">{$_SL['constructors_union']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['architectures_union']}">{$_SL['architectures_union']}</a></li>
									<li><div id="mark"></div><a href="http://www.jhhi.am/">{$_SL['institut_rp']}</a></li>
									<li><div id="mark"></div><a href="http://www.yetri.am/">{$_SL['yetri']}</a></li>
								</ul> 
								<h3 class="headerbar"><a href="?goto={$_SLD['contact_out']}">{$_SL['contact_out']}</a></h3>
								<ul class="submenu">
									<li><div id="mark"></div><a href="?goto={$_SLD['exhibition']}">{$_SL['exhibition']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['test']}">{$_SL['test']}</a></li>
									<li><div id="mark"></div><a href="?goto={$_SLD['competitions']}">{$_SL['competitions']}</a></li>
								</ul> 
								<h3 class="{$style_pg}"><a href="?goto={$_SLD['photo_gallery']}">{$_SL['photo_gallery']}</a></h3>
								<h3 class="{$style_wa}"><a href="?goto={$_SLD['work_archive']}">{$_SL['work_archive']}</a></h3>
								<h3 class="{$style_np}"><a href="?goto={$_SLD['newspaper']}">{$_SL['newspaper']}</a></h3>																
								<h3 class="{$style_buy}"><a href="?goto={$_SLD['buy_store']}">{$_SL['buy_store']}</a></h3>
								<h3 class="{$style_np}"><a href="?goto={$_SLD['career_center']}">{$_SL['career_center']}</a></h3>
								<h3 class="{$style_pa}"><a href="?goto={$_SLD['press_about']}">{$_SL['press_about']}</a></h3>
								<h3 class="{$style_hs}"><a href="?goto={$_SLD['high_school']}">{$_SL['high_school']}</a></h3>
								<h3 class="{$style_ac}"><a href="?goto={$_SLD['astghik_club']}">{$_SL['astghik_club']}</a></h3>
								<h3 class="{$style_al}"><a href="?goto={$_SLD['alumni']}">{$_SL['alumni']}</a></h3>
								<h3 class="{$style_sp}"><a href="?goto={$_SLD['students_progress']}">{$_SL['students_progress']}</a></h3>
							</div>
<!--------------------------------------------- partners -------------------------------------------------->
							<table border="0" cellpadding="0" cellspacing="0" width="280" height="80">
								<tr>
									<td id="mulberry">
										<a href="http://95.140.200.133">
											{$_SL['mulberry']}
										</a>
									</td>
								</tr>
								<tr><td height="5"></td></tr>
								<tr>
									<td id="email_signin">
										<a href="http://ysuac.am/webmail">
											{$_SL['email_signin']}
										</a>
									</td>
								</tr>
								<tr><td height="5"></td></tr>
								<tr>
									<td id="admin_signin">
										<a href="http://ysuac.am/ysuac_admin">
											{$_SL['admin_signin']}
										</a>
									</td>
								</tr>
								<tr><td height="10"></td></tr>
							</table>
							
							<table border="0" cellpadding="0" cellspacing="0" width="280">
html;
								while( ($row_sitetop=mysql_fetch_assoc($r_sitetop))!=false){
echo<<<html
									<tr>
										<td id="index_top_content">
											<div>
											<a href="?goto=news&id={$row_sitetop['id']}">
html;
											string_limiter($row_sitetop['news_title'], "46");
echo<<<html
											</a>
											</div>
											<div id="index_top_datetime">
											{$row_sitetop['news_date']}
											</div>
										</td>
									</tr>
									<tr><td valign="center"><div id="index_top_hr"></div></td></tr>
html;
								}
								while( ($row_sitetop1=mysql_fetch_assoc($r_sitetop1))!=false){
echo<<<html
									<tr>
										<td id="index_top_content">
											<div>
											<a href="?goto=announcements&id={$row_sitetop1['id']}">
html;
											string_limiter($row_sitetop1['title'], "46");
echo<<<html
											</a>
											</div>
											<div id="index_top_datetime">
											{$row_sitetop1['upload_date']}
											</div>
										</td>
									</tr>
									<tr><td valign="center"><div id="index_top_hr"></div></td></tr>
html;
								}
echo<<<html
							</table>
							<table border="0" cellpadding="0" cellspacing="0" width="280" height="394" id="partners">
								<tr><td height="10" colspan="3"></td></tr>
								<tr>
									<td width="279" height="80" valign="center" align="center" colspan="3" id="home_assessment_process">
											
												<div>
													<a href="http://www.aeres-evaluation.fr/"><img src="images/partners/aeres.jpg" border="0" width="269"></br></a>			
													<a href="?goto={$_SLD['assessment_process']}">{$_SL['assessment_process']}</a>
												</div>
											
										</div>
									</td>
								</tr>
								<tr><td height="10"></td></tr>
								<tr>
									<td width="279" height="80" valign="center" align="center" colspan="3" id="home_assessment_process">
											
												<div>
													<a href="http://tempus-desire.thomasmore.be/consortium.php"><img src="images/partners/desire.jpg" border="0" width="269"></br></a>			
													<!--<a href="?goto={$_SLD['assessment_process']}">{$_SL['assessment_process']}</a>-->
												</div>
											
										</div>
									</td>
								</tr>
								<tr><td height="10"></td></tr>
								<tr>
									<td width="279" height="35" valign="center" align="center" colspan="3">
										<a href="http://www.scs.am/" target="blank"><img src="images/partners/head_arm.jpg" border="0"></a>					
									</td>
								</tr>
								<tr><td height="3"></td></tr>
								<tr>
									<td width="93" height="93" valign="center" align="center">
										<a href="http://aucls2011.bucea.edu.cn/" target="blank"><img src="images/partners/china_logo.jpg" border="0" width="88"></a>					
									</td>
									<td width="93" height="93" valign="center" align="center">
										<a href="http://www.bsec-edu.tuc.gr/" target="blank"><img src="images/partners/bsecedu.jpg" border="0" width="88"></a>					
									</td>
									<td valign="center" align="center">
										<a href="http://www.ecoma.am/" target="blank"><img src="images/partners/tempus.jpg" border="0" width="88"></a>						
									</td>
								</tr>
								<tr>
									<td width="93" height="93" valign="center" align="center">
										<a href="http://www.abcfinance.am/" target="blank"><img src="images/partners/abcfinance.jpg" border="0" width="88"></a>					
									</td>
									<td width="93" height="93" valign="center" align="center">
										<a href="http://www.jhhi.am/" target="blank"><img src="images/partners/logo_jhhi.jpg" border="0" width="88"></a>					
									</td>
									<td valign="center" align="center">
										<a href="http://95.140.200.132/download/docs/2009jfdp_am.rar" target="blank"><img src="images/partners/jfdp_am.jpg" border="0" width="88"></a>						
									</td>
								</tr>
								<tr>
									<td width="93" height="93" valign="center" align="center">
										<a href="http://boh.am/" target="blank"><img src="images/partners/boh.jpg" border="0" width="88"></a>					
									</td>
									<td width="93" height="93" valign="center" align="center">
										<a href="http://www.nla.am/arm/index.php" target="blank"><img src="images/partners/nla.am.jpg" border="0" width="88"></a>					
									</td>
									<td valign="center" align="center">
										<a href="http://atc.am/" target="blank"><img src="images/partners/atc.jpg" border="0" width="88"></a>						
									</td>
								</tr>
								<tr>
									<td width="279" height="100" valign="center" align="center" colspan="3">
										<a href="http://www.eurashe.eu/" target="blank"><img src="images/partners/eurashe.jpg" border="0"></a>					
									</td>
								</tr>
								<tr><td height="3"></td></tr>
								<tr>
									<td width="279" height="80" valign="center" align="center" colspan="3">
										<a href="http://www.restauroarmenia.org" target="blank"><img src="images/partners/restauroarmenia.jpg" border="0"></a>					
									</td>
								</tr>
								<tr><td height="6"></td></tr>
							</table>
<!------------------------------------------------------------------------------------------------------>
						</td>
					</tr>
				</table>
<!------------------------------------------------------------------------------------------------------>
			</td>
			<td rowspan="2"></td>
		</tr>
		<tr>
			<td id="footer">
<!----------------------------------------------- footer ----------------------------------------------->
				<table border="0" cellpadding="0" cellspacing="0" width="100%" height="50">
					<tr>
						<td valign="top" id="social_part" align="left" width="170">
							<ul>
								<li>
									<a href="http://www.facebook.com/pages/Ysuac/301774039860994">
										<img src="images/social_icons/facebook_gs.png" border="0" onMouseover=this.src='images/social_icons/facebook.png' onMouseout=this.src='images/social_icons/facebook_gs.png'>
									</a>
								</li>
								<li>
									<a href="http://www.twitter.com">
										<img src="images/social_icons/twitter_gs.png" border="0" onMouseover=this.src='images/social_icons/twitter.png' onMouseout=this.src='images/social_icons/twitter_gs.png'>
									</a>
								</li>
								<li>
									<a href="http://www.skype.com">
										<img src="images/social_icons/skype_gs.png" border="0" onMouseover=this.src='images/social_icons/skype.png' onMouseout=this.src='images/social_icons/skype_gs.png'>
									</a>
								</li>
								<li>
									<a href="http://www.youtube.com">
										<img src="images/social_icons/youtube_gs.png" border="0" onMouseover=this.src='images/social_icons/youtube.png' onMouseout=this.src='images/social_icons/youtube_gs.png'>
									</a>
								</li>
							</ul>
						</td>
						<td width="2" id="vert_break"></td>
						<td id="tel_email">
							{$_SL['main_tfe_info']} 
						</td>
						<td width="2" id="vert_break"></td>
						<td id="address">
							{$_SL['main_address']} 
						</td>
						<td width="2" id="vert_break"></td>
						<td id="copyright">
							{$_SL['copyright']}
						</td>
					</tr>
				</table>
<!------------------------------------------------------------------------------------------------------>
			</td>
		</tr>
</table>
<!--Openstat-->
<span id="openstat2329521"></span>
<script type="text/javascript">
var openstat = { counter: 2329521, next: openstat };
(function(d, t, p) {
var j = d.createElement(t); j.async = true; j.type = "text/javascript";
j.src = ("https:" == p ? "https:" : "http:") + "//openstat.net/cnt.js";
var s = d.getElementsByTagName(t)[0]; s.parentNode.insertBefore(j, s);
})(document, "script", document.location.protocol);
</script>
<!--/Openstat-->
</body>
</html>
html;
?>