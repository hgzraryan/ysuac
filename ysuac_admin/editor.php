<?php
echo <<<html
<!-- TinyMCE -->
<script type="text/javascript" src="editor/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,cleanup,code,image,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "editor/examples/css/content.css",

		// Drop lists for link/image/media/template dialogs
	
		template_external_list_url : "editor/examples/lists/template_list.js",
		external_link_list_url : "editor/examples/lists/link_list.js",
		external_image_list_url : "editor/examples/lists/image_list.js",
		media_external_list_url : "editor/examples/lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->



<form method="post">
	<textarea id="elm1" name="{$tiny_name}" rows="15" cols="80" style="width: 99%; height:220px;">
html;
if($_SESSION['go']=="bologna_process"){
	$q_sitebologna="SELECT {$text_lang} FROM {$CONF['dbtable']['bologna']}";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_sitebologna=mysql_query($q_sitebologna,$CONN);
	$row_sitebologna=mysql_fetch_assoc($r_sitebologna);
	echo $row_sitebologna[$text_lang];
}
if($_SESSION['go']=="for_applicant" && $_SESSION['sub']=="postgraduate_degree"){
	$q_sitepostgraduate_degree="SELECT {$text_lang} FROM {$CONF['dbtable']['postgraduate_degree']}";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_sitepostgraduate_degree=mysql_query($q_sitepostgraduate_degree,$CONN);
	$row_sitepostgraduate_degree=mysql_fetch_assoc($r_sitepostgraduate_degree);
	echo $row_sitepostgraduate_degree[$text_lang];
}
if($_SESSION['go']=="for_applicant" && $_SESSION['sub']=="masters_degree"){
	$q_sitemasters_degree="SELECT {$text_lang} FROM {$CONF['dbtable']['masters_degree']}";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_sitemasters_degree=mysql_query($q_sitemasters_degree,$CONN);
	$row_sitemasters_degree=mysql_fetch_assoc($r_sitemasters_degree);
	echo $row_sitemasters_degree[$text_lang];
}
if($_SESSION['go']=="for_applicant" && $_SESSION['sub']=="distance_learning"){
	$q_sitedistance_learning="SELECT {$text_lang} FROM {$CONF['dbtable']['distance_learning']}";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_sitedistance_learning=mysql_query($q_sitedistance_learning,$CONN);
	$row_sitedistance_learning=mysql_fetch_assoc($r_sitedistance_learning);
	echo $row_sitedistance_learning[$text_lang];
}
if($_SESSION['go']=="for_applicant" && $_SESSION['sub']=="entry_course"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['entry_course']}";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="030_spec" && $_SESSION['sub']=="specialized_council"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['specialized_council']} WHERE description='specialized_council'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="030_spec" && $_SESSION['sub']=="composition_of_board"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['specialized_council']} WHERE description='composition_of_board'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="030_spec" && $_SESSION['sub']=="theses_defenses"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['specialized_council']} WHERE description='theses_defenses'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="030_spec" && $_SESSION['sub']=="authors_abstract_delivery_list"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['specialized_council']} WHERE description='authors_abstract_delivery_list'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_university" && $_SESSION['sub']=="board_staff"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_university']} WHERE description='board_staff'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_university" && $_SESSION['sub']=="board_sessions"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_university']} WHERE description='board_sessions'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_university" && $_SESSION['sub']=="academic_council"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_university']} WHERE description='academic_council'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_university" && $_SESSION['sub']=="decisions_council"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_university']} WHERE description='decisions_council'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_university" && $_SESSION['sub']=="rectors_staff"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_university']} WHERE description='rectors_staff'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_university" && $_SESSION['sub']=="board_decisions"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_university']} WHERE description='board_decisions'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_partners" && $_SESSION['sub']=="constructors_union"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_partners']} WHERE description='constructors_union'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="our_partners" && $_SESSION['sub']=="architectures_union"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_partners']} WHERE description='architectures_union'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="for_applicant" && $_SESSION['sub']=="construction_college"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['applicant']} WHERE description='construction_college'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="for_applicant" && $_SESSION['sub']=="foreign_entrant"){
	$q_siteapplicant="SELECT {$text_lang} FROM {$CONF['dbtable']['applicant']} WHERE description='foreign_entrant'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteapplicant=mysql_query($q_siteapplicant,$CONN);
	$row_siteapplicant=mysql_fetch_assoc($r_siteapplicant);
	echo $row_siteapplicant[$text_lang];
}
if($_SESSION['go']=="for_applicant" && $_SESSION['sub']=="high_school"){
	$q_siteapplicant="SELECT {$text_lang} FROM {$CONF['dbtable']['applicant']} WHERE description='high_school'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteapplicant=mysql_query($q_siteapplicant,$CONN);
	$row_siteapplicant=mysql_fetch_assoc($r_siteapplicant);
	echo $row_siteapplicant[$text_lang];
}
if($_SESSION['go']=="int_coo" && $_SESSION['sub']=="international_conferences"){
	$q_siteapplicant="SELECT {$text_lang} FROM {$CONF['dbtable']['international_cooperation']} WHERE description='international_conferences'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteapplicant=mysql_query($q_siteapplicant,$CONN);
	$row_siteapplicant=mysql_fetch_assoc($r_siteapplicant);
	echo $row_siteapplicant[$text_lang];
}
if($_SESSION['go']=="int_coo" && $_SESSION['sub']=="educational_process"){
	$q_siteapplicant="SELECT {$text_lang} FROM {$CONF['dbtable']['international_cooperation']} WHERE description='educational_process'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteapplicant=mysql_query($q_siteapplicant,$CONN);
	$row_siteapplicant=mysql_fetch_assoc($r_siteapplicant);
	echo $row_siteapplicant[$text_lang];
}
if($_SESSION['go']=="our_university" && $_SESSION['sub']=="menu_history"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_our_university']} WHERE description='history'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="home" && $_SESSION['sub']=="news_edit"){
	$q_news_edit_editor="SELECT news FROM {$CONF['dbtable'][$news_lang]} WHERE id='{$_GET['news_id']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_news_edit_editor=mysql_query($q_news_edit_editor,$CONN);
	$row_news_edit_editor=mysql_fetch_assoc($r_news_edit_editor);
	echo $row_news_edit_editor['news'];
}
if($_SESSION['go']=="legal_acts" && $_SESSION['sub']=="order_mse"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_legal_acts']} WHERE description='order_mse'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="legal_acts" && $_SESSION['sub']=="charter"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_legal_acts']} WHERE description='charter'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="legal_acts" && $_SESSION['sub']=="reg_rules"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_legal_acts']} WHERE description='reg_rules'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="legal_acts" && $_SESSION['sub']=="decrees_rector"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_legal_acts']} WHERE description='decrees_rector'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="legal_acts" && $_SESSION['sub']=="order_rector"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_legal_acts']} WHERE description='order_rector'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="legal_acts" && $_SESSION['sub']=="governing_council"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_legal_acts']} WHERE description='governing_council'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="alumni" && $_SESSION['sub']=="alumni_home"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_home'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="alumni" && $_SESSION['sub']=="alumni_search"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_search'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="alumni" && $_SESSION['sub']=="alumni_charter"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_charter'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="alumni" && $_SESSION['sub']=="alumni_functions"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_functions'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="alumni" && $_SESSION['sub']=="alumni_registration"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_registration'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="alumni" && $_SESSION['sub']=="alumni_events"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_events'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}
if($_SESSION['go']=="alumni" && $_SESSION['sub']=="alumni_famous"){
	$q_siteentry_course="SELECT {$text_lang} FROM {$CONF['dbtable']['site_alumni']} WHERE description='alumni_famous'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_siteentry_course=mysql_query($q_siteentry_course,$CONN);
	$row_siteentry_course=mysql_fetch_assoc($r_siteentry_course);
	echo $row_siteentry_course[$text_lang];
}

if($_SESSION['go']=="departments" && $_SESSION['sub']=="dep_history" && isset($_GET['depid'])){
	$q_departments="SELECT department_history FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='{$_GET['depid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_departments=mysql_query($q_departments,$CONN);
	$row_departments=mysql_fetch_assoc($r_departments);
	echo $row_departments['department_history'];
}
if($_SESSION['go']=="departments" && $_SESSION['sub']=="specialized_chairs" && isset($_GET['depid'])){
	$q_departments="SELECT department_spec FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='{$_GET['depid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_departments=mysql_query($q_departments,$CONN);
	$row_departments=mysql_fetch_assoc($r_departments);
	echo $row_departments['department_spec'];
}
if($_SESSION['go']=="departments" && $_SESSION['sub']=="dep_team" && isset($_GET['depid'])){
	$q_departments="SELECT department_team FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='{$_GET['depid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_departments=mysql_query($q_departments,$CONN);
	$row_departments=mysql_fetch_assoc($r_departments);
	echo $row_departments['department_team'];
}
if($_SESSION['go']=="departments" && $_SESSION['sub']=="dep_council" && isset($_GET['depid'])){
	$q_departments="SELECT department_council FROM {$CONF['dbtable'][$dep_lang]} WHERE department_description='{$_GET['depid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_departments=mysql_query($q_departments,$CONN);
	$row_departments=mysql_fetch_assoc($r_departments);
	echo $row_departments['department_council'];
}
if($_SESSION['go']=="faculties" && $_SESSION['sub']=="fac_history" && isset($_GET['facid'])){
	$q_faculties="SELECT faculties_history FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='{$_GET['facid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_faculties=mysql_query($q_faculties,$CONN);
	$row_faculties=mysql_fetch_assoc($r_faculties);
	echo $row_faculties['faculties_history'];
}
if($_SESSION['go']=="faculties" && $_SESSION['sub']=="fac_specialized_chairs" && isset($_GET['facid'])){
	$q_faculties="SELECT faculties_spec FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='{$_GET['facid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_faculties=mysql_query($q_faculties,$CONN);
	$row_faculties=mysql_fetch_assoc($r_faculties);
	echo $row_faculties['faculties_spec'];
}
if($_SESSION['go']=="faculties" && $_SESSION['sub']=="fac_team" && isset($_GET['facid'])){
	$q_faculties="SELECT faculties_team FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='{$_GET['facid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_faculties=mysql_query($q_faculties,$CONN);
	$row_faculties=mysql_fetch_assoc($r_faculties);
	echo $row_faculties['faculties_team'];
}
if($_SESSION['go']=="faculties" && $_SESSION['sub']=="fac_council" && isset($_GET['facid'])){
	$q_faculties="SELECT faculties_council FROM {$CONF['dbtable'][$fac_lang]} WHERE faculties_description='{$_GET['facid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_faculties=mysql_query($q_faculties,$CONN);
	$row_faculties=mysql_fetch_assoc($r_faculties);
	echo $row_faculties['faculties_council'];
}
if($_SESSION['go']=="chairs" && $_SESSION['sub']=="ch_history" && isset($_GET['chid'])){
	$q_chairs="SELECT chairs_history FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='{$_GET['chid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_chairs=mysql_query($q_chairs,$CONN);
	$row_chairs=mysql_fetch_assoc($r_chairs);
	echo $row_chairs['chairs_history'];
}
if($_SESSION['go']=="chairs" && $_SESSION['sub']=="ch_team" && isset($_GET['chid'])){
	$q_chairs="SELECT chairs_team FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='{$_GET['chid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_chairs=mysql_query($q_chairs,$CONN);
	$row_chairs=mysql_fetch_assoc($r_chairs);
	echo $row_chairs['chairs_team'];
}
if($_SESSION['go']=="chairs" && $_SESSION['sub']=="scientific_process" && isset($_GET['chid'])){
	$q_chairs="SELECT chairs_scientific_process FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='{$_GET['chid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_chairs=mysql_query($q_chairs,$CONN);
	$row_chairs=mysql_fetch_assoc($r_chairs);
	echo $row_chairs['chairs_scientific_process'];
}
if($_SESSION['go']=="chairs" && $_SESSION['sub']=="educational_process" && isset($_GET['chid'])){
	$q_chairs="SELECT chairs_educational_process FROM {$CONF['dbtable'][$ch_lang]} WHERE chairs_description='{$_GET['chid']}'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_chairs=mysql_query($q_chairs,$CONN);
	$row_chairs=mysql_fetch_assoc($r_chairs);
	echo $row_chairs['chairs_educational_process'];
}
if($_SESSION['go']=="press_about"){
	$q_press_about="SELECT {$text_lang} FROM {$CONF['dbtable']['press_about']}";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_press_about=mysql_query($q_press_about,$CONN);
	$row_press_about=mysql_fetch_assoc($r_press_about);
	echo $row_press_about[$text_lang];
}
if($_SESSION['go']=="library" && $_SESSION['sub']=="editional_borad"){
	$q_editional_borad="SELECT {$text_lang} FROM {$CONF['dbtable']['proceedings']} WHERE description='editional_borad'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_editional_borad=mysql_query($q_editional_borad,$CONN);
	$row_editional_borad=mysql_fetch_assoc($r_editional_borad);
	echo $row_editional_borad[$text_lang];
}
if($_SESSION['go']=="library" && $_SESSION['sub']=="articles_requirements"){
	$q_articles_requirements="SELECT {$text_lang} FROM {$CONF['dbtable']['proceedings']} WHERE description='articles_requirements'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_articles_requirements=mysql_query($q_articles_requirements,$CONN);
	$row_articles_requirements=mysql_fetch_assoc($r_articles_requirements);
	echo $row_articles_requirements[$text_lang];
}
if($_SESSION['go']=="library" && $_SESSION['sub']=="admission_order"){
	$q_admission_order="SELECT {$text_lang} FROM {$CONF['dbtable']['proceedings']} WHERE description='admission_order'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_admission_order=mysql_query($q_admission_order,$CONN);
	$row_admission_order=mysql_fetch_assoc($r_admission_order);
	echo $row_admission_order[$text_lang];
}
if($_SESSION['go']=="library" && $_SESSION['sub']=="about_the_journal"){
	$q_about_the_journal="SELECT {$text_lang} FROM {$CONF['dbtable']['proceedings']} WHERE description='about_the_journal'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_about_the_journal=mysql_query($q_about_the_journal,$CONN);
	$row_about_the_journal=mysql_fetch_assoc($r_about_the_journal);
	echo $row_about_the_journal[$text_lang];
}
if($_SESSION['go']=="library" && $_SESSION['sub']=="bulletin_edboard"){
	$q_bulletin_edboard="SELECT {$text_lang} FROM {$CONF['dbtable']['proceedings']} WHERE description='bulletin_edboard'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_bulletin_edboard=mysql_query($q_bulletin_edboard,$CONN);
	$row_bulletin_edboard=mysql_fetch_assoc($r_bulletin_edboard);
	echo $row_bulletin_edboard[$text_lang];
}
if($_SESSION['go']=="library" && $_SESSION['sub']=="bulletin_articles_requirements"){
	$q_bulletin_articles_requirements="SELECT {$text_lang} FROM {$CONF['dbtable']['proceedings']} WHERE description='bulletin_articles_requirements'";
	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
	$r_bulletin_articles_requirements=mysql_query($q_bulletin_articles_requirements,$CONN);
	$row_bulletin_articles_requirements=mysql_fetch_assoc($r_bulletin_articles_requirements);
	echo $row_bulletin_articles_requirements[$text_lang];
}










echo<<<html
	</textarea>
</form>
html;
?>
