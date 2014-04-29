<?php

if ($INCLUDE!="allow"){

	session_destroy();

	header("location:http://{$_SERVER['SERVER_NAME']}");

	exit();

}

#----------------- database configure ----------------

$CONF['SERVER_TYPE']="primary";

#$CONF['SERVER_TYPE']="secondary";



if (  $CONF['SERVER_TYPE']=="primary" ) {

	$CONF['db']['host']="localhost";

	$CONF['db']['user']="ysuac_newadmin";

	$CONF['db']['pass']="Teryan105Yerevan";

	$CONF['db']['name']="ysuac_newdb";

} elseif ($CONF['SERVER_TYPE']=="secondary") {

	$CONF['db']['host']="localhost";

	$CONF['db']['user']="root";

	$CONF['db']['pass']="";

	$CONF['db']['name']="ysuac_db";

}

#******************** Site allow pages ******************

$ALLOWED_PAGES['home']=1;

$ALLOWED_PAGES['news']=1;

$ALLOWED_PAGES['news_archive']=1;

$ALLOWED_PAGES['announcements_archive']=1;

$ALLOWED_PAGES['our_data']=1;

$ALLOWED_PAGES['rector']=1;

$ALLOWED_PAGES['departments']=1;

$ALLOWED_PAGES['faculties']=1;

$ALLOWED_PAGES['f_module1']=1;

$ALLOWED_PAGES['management_board']=1;

$ALLOWED_PAGES['scientific_council']=1;

$ALLOWED_PAGES['chairs']=1;

$ALLOWED_PAGES['bologna']=1;

$ALLOWED_PAGES['units']=1;

$ALLOWED_PAGES['specialized_council']=1;

$ALLOWED_PAGES['architectures_union']=1;

$ALLOWED_PAGES['photo_gallery']=1;

$ALLOWED_PAGES['gallery_view']=1;

$ALLOWED_PAGES['academic_council']=1;

$ALLOWED_PAGES['decisions_council']=1;

#$ALLOWED_PAGES['work_archive']=1;

#$ALLOWED_PAGES['newspaper']=1;

$ALLOWED_PAGES['press_about']=1;

$ALLOWED_PAGES['high_school']=1;

#$ALLOWED_PAGES['astghik_club']=1;

$ALLOWED_PAGES['charter']=1;

$ALLOWED_PAGES['alumni']=1;

$ALLOWED_PAGES['students_progress']=1;

$ALLOWED_PAGES['mail_send']=1;

#$ALLOWED_PAGES['science']=1;

$ALLOWED_PAGES['constructors_union']=1;

$ALLOWED_PAGES['assessment_process']=1;

$ALLOWED_PAGES['entry_course']=1;

$ALLOWED_PAGES['announcements']=1;

$ALLOWED_PAGES['masters_degree']=1;

$ALLOWED_PAGES['distance_learning']=1;

$ALLOWED_PAGES['foreign_entrant']=1;

$ALLOWED_PAGES['postgraduate_degree']=1;

$ALLOWED_PAGES['promotion_comments']=1;

$ALLOWED_PAGES['construction_college']=1;

$ALLOWED_PAGES['international_conferences']=1;

$ALLOWED_PAGES['educational_process']=1;

$ALLOWED_PAGES['international_rel']=1;

$ALLOWED_PAGES['menu_history']=1;

$ALLOWED_PAGES['search']=1;

$ALLOWED_PAGES['order_mse']=1;

$ALLOWED_PAGES['decrees_rector']=1;

$ALLOWED_PAGES['order_rector']=1;

$ALLOWED_PAGES['library']=1;

$ALLOWED_PAGES['reg_rules']=1;

$ALLOWED_PAGES['buy_store']=1;

$ALLOWED_PAGES['governing_council']=1;

$ALLOWED_PAGES['d_module']=1;

$ALLOWED_PAGES['c_module']=1;

$ALLOWED_PAGES['scientific_publications']=1;

$ALLOWED_PAGES['science']=1;

$ALLOWED_PAGES['papers']=1;

$ALLOWED_PAGES['bulletin']=1;

$ALLOWED_PAGES['collection']=1;

$ALLOWED_PAGES['credit_bulletin']=1;

$ALLOWED_PAGES['proceedings']=1;

$ALLOWED_PAGES['error']=1;



#********************************************************



############## Database tables ############

$CONF['dbtable']['units']="site_units";

$CONF['dbtable']['admin_premoderators']="admin_premoderators";

$CONF['dbtable']['admin_vislog']="admin_vislog";

$CONF['dbtable']['admin_languages']="admin_languages";

$CONF['dbtable']['site_str_languages']="site_str_languages";

$CONF['dbtable']['news_am']="site_news_am";

$CONF['dbtable']['news_ru']="site_news_ru";

$CONF['dbtable']['news_en']="site_news_en";

$CONF['dbtable']['news_fr']="site_news_fr";

$CONF['dbtable']['bologna']="site_bologna";

$CONF['dbtable']['files']="site_files";

$CONF['dbtable']['applicant']="site_applicant";

$CONF['dbtable']['postgraduate_degree']="site_postgraduate_degree";

$CONF['dbtable']['masters_degree']="site_masters_degree";

$CONF['dbtable']['entry_course']="site_entry_course";

$CONF['dbtable']['slideshow']="site_slideshow";

$CONF['dbtable']['distance_learning']="site_distance_learning";

$CONF['dbtable']['announcements_am']="site_announcements_am";

$CONF['dbtable']['announcements_ru']="site_announcements_ru";

$CONF['dbtable']['announcements_en']="site_announcements_en";

$CONF['dbtable']['announcements_fr']="site_announcements_fr";

$CONF['dbtable']['bologna']="site_bologna";

$CONF['dbtable']['gallery_category']="gallery_category";

$CONF['dbtable']['wallpapers']="gallery_photos";

$CONF['dbtable']['specialized_council']="specialized_council";

$CONF['dbtable']['site_legal_acts']="site_legal_acts";

$CONF['dbtable']['site_our_university']="site_our_university";

$CONF['dbtable']['site_our_partners']="site_our_partners";

$CONF['dbtable']['site_alumni']="site_alumni";

$CONF['dbtable']['international_cooperation']="site_international_cooperation";

$CONF['dbtable']['departments_am']="site_departments_am";

$CONF['dbtable']['departments_ru']="site_departments_ru";

$CONF['dbtable']['departments_en']="site_departments_en";

$CONF['dbtable']['departments_fr']="site_departments_fr";

$CONF['dbtable']['faculties_am']="site_faculties_am";

$CONF['dbtable']['faculties_ru']="site_faculties_ru";

$CONF['dbtable']['faculties_en']="site_faculties_en";

$CONF['dbtable']['faculties_fr']="site_faculties_fr";

$CONF['dbtable']['chairs_am']="site_chairs_am";

$CONF['dbtable']['chairs_ru']="site_chairs_ru";

$CONF['dbtable']['chairs_en']="site_chairs_en";

$CONF['dbtable']['chairs_fr']="site_chairs_fr";

$CONF['dbtable']['bulletin']="site_library_bulletin";

$CONF['dbtable']['cbuilders']="site_library_cbuilders";

$CONF['dbtable']['credit_bulletin']="site_credit_bulletin";

$CONF['dbtable']['press_about']="site_press_about";

$CONF['dbtable']['journal']="site_library_journal";

$CONF['dbtable']['proceedings']="site_library_proceedings";

#########################################################

#!!!!!!!!!!!!!!!!!Control panel allow pages!!!!!!!!!!!!!!

$ALLOWED_PAGES_ADMIN["home"]=1;

$ALLOWED_PAGES_ADMIN["our_university"]=1;

$ALLOWED_PAGES_ADMIN["news"]=1;

$ALLOWED_PAGES_ADMIN["for_applicant"]=1;

$ALLOWED_PAGES_ADMIN["moderators"]=1;

$ALLOWED_PAGES_ADMIN["exit"]=1;

$ALLOWED_PAGES_ADMIN["gallery"]=1;

$ALLOWED_PAGES_ADMIN["gallery_cat"]=1;

$ALLOWED_PAGES_ADMIN["files"]=1;

$ALLOWED_PAGES_ADMIN["bologna_process"]=1;

$ALLOWED_PAGES_ADMIN["admin_system"]=1;

$ALLOWED_PAGES_ADMIN["int_coo"]=1;

$ALLOWED_PAGES_ADMIN["030_spec"]=1;

$ALLOWED_PAGES_ADMIN["alumni"]=1;

$ALLOWED_PAGES_ADMIN["our_partners"]=1;

$ALLOWED_PAGES_ADMIN["legal_acts"]=1;

$ALLOWED_PAGES_ADMIN["departments"]=1;

$ALLOWED_PAGES_ADMIN["faculties"]=1;

$ALLOWED_PAGES_ADMIN["chairs"]=1;

$ALLOWED_PAGES_ADMIN["library"]=1;

$ALLOWED_PAGES_ADMIN["press_about"]=1;





$ALLOWED_SUBPAGES_ADMIN["news"]=1;

$ALLOWED_SUBPAGES_ADMIN["partners"]=1;

$ALLOWED_SUBPAGES_ADMIN["announcements"]=1;

$ALLOWED_SUBPAGES_ADMIN["admin_languages"]=1;

$ALLOWED_SUBPAGES_ADMIN["moderators"]=1;

$ALLOWED_SUBPAGES_ADMIN["foreign_entrant"]=1;

$ALLOWED_SUBPAGES_ADMIN["postgraduate_degree"]=1;

$ALLOWED_SUBPAGES_ADMIN["masters_degree"]=1;

$ALLOWED_SUBPAGES_ADMIN["entry_course"]=1;

$ALLOWED_SUBPAGES_ADMIN["distance_learning"]=1;

$ALLOWED_SUBPAGES_ADMIN["faculity"]=1;

$ALLOWED_SUBPAGES_ADMIN["units"]=1;

$ALLOWED_SUBPAGES_ADMIN["chairs"]=1;

$ALLOWED_SUBPAGES_ADMIN["departments"]=1;

$ALLOWED_SUBPAGES_ADMIN["site_languages"]=1;

$ALLOWED_SUBPAGES_ADMIN["news_lang"]=1;

$ALLOWED_SUBPAGES_ADMIN["int_contacts"]=1;

$ALLOWED_SUBPAGES_ADMIN["slideshow"]=1;

$ALLOWED_SUBPAGES_ADMIN["specialized_council"]=1;

$ALLOWED_SUBPAGES_ADMIN["composition_of_board"]=1;

$ALLOWED_SUBPAGES_ADMIN["theses_defenses"]=1;

$ALLOWED_SUBPAGES_ADMIN["authors_abstract_delivery_list"]=1;

$ALLOWED_SUBPAGES_ADMIN["board_staff"]=1;

$ALLOWED_SUBPAGES_ADMIN["board_sessions"]=1;

$ALLOWED_SUBPAGES_ADMIN["academic_council"]=1;

$ALLOWED_SUBPAGES_ADMIN["decisions_council"]=1;

$ALLOWED_SUBPAGES_ADMIN["rectors_staff"]=1;

$ALLOWED_SUBPAGES_ADMIN["board_decisions"]=1;

$ALLOWED_SUBPAGES_ADMIN["high_school"]=1;

$ALLOWED_SUBPAGES_ADMIN["menu_history"]=1;

$ALLOWED_SUBPAGES_ADMIN["educational_process"]=1;

$ALLOWED_SUBPAGES_ADMIN["constructors_union"]=1;

$ALLOWED_SUBPAGES_ADMIN["architectures_union"]=1;

$ALLOWED_SUBPAGES_ADMIN["construction_college"]=1;

$ALLOWED_SUBPAGES_ADMIN["order_mse"]=1;

$ALLOWED_SUBPAGES_ADMIN["international_conferences"]=1;

$ALLOWED_SUBPAGES_ADMIN["news_edit"]=1;

$ALLOWED_SUBPAGES_ADMIN["charter"]=1;

$ALLOWED_SUBPAGES_ADMIN["decrees_rector"]=1;

$ALLOWED_SUBPAGES_ADMIN["order_rector"]=1;

$ALLOWED_SUBPAGES_ADMIN["governing_council"]=1;

$ALLOWED_SUBPAGES_ADMIN["reg_rules"]=1;

$ALLOWED_SUBPAGES_ADMIN["alumni_home"]=1;

$ALLOWED_SUBPAGES_ADMIN["alumni_search"]=1;

$ALLOWED_SUBPAGES_ADMIN["alumni_charter"]=1;

$ALLOWED_SUBPAGES_ADMIN["alumni_functions"]=1;

$ALLOWED_SUBPAGES_ADMIN["alumni_registration"]=1;

$ALLOWED_SUBPAGES_ADMIN["alumni_events"]=1;

$ALLOWED_SUBPAGES_ADMIN["alumni_famous"]=1;

$ALLOWED_SUBPAGES_ADMIN["dep_history"]=1;

$ALLOWED_SUBPAGES_ADMIN["specialized_chairs"]=1;

$ALLOWED_SUBPAGES_ADMIN["dep_team"]=1;

$ALLOWED_SUBPAGES_ADMIN["dep_council"]=1;

$ALLOWED_SUBPAGES_ADMIN["fac_history"]=1;

$ALLOWED_SUBPAGES_ADMIN["fac_specialized_chairs"]=1;

$ALLOWED_SUBPAGES_ADMIN["fac_team"]=1;

$ALLOWED_SUBPAGES_ADMIN["fac_council"]=1;

$ALLOWED_SUBPAGES_ADMIN["ch_history"]=1;

$ALLOWED_SUBPAGES_ADMIN["ch_specialized_chairs"]=1;

$ALLOWED_SUBPAGES_ADMIN["ch_team"]=1;

$ALLOWED_SUBPAGES_ADMIN["ch_council"]=1;

$ALLOWED_SUBPAGES_ADMIN["educational_process"]=1;

$ALLOWED_SUBPAGES_ADMIN["scientific_process"]=1;

$ALLOWED_SUBPAGES_ADMIN["bulletin"]=1;

$ALLOWED_SUBPAGES_ADMIN["collection_builders"]=1;

$ALLOWED_SUBPAGES_ADMIN["credit_bulletin"]=1;

$ALLOWED_SUBPAGES_ADMIN["about_the_journal"]=1;

$ALLOWED_SUBPAGES_ADMIN["archive"]=1;

$ALLOWED_SUBPAGES_ADMIN["admission_order"]=1;

$ALLOWED_SUBPAGES_ADMIN["articles_requirements"]=1;

$ALLOWED_SUBPAGES_ADMIN["editional_borad"]=1;

$ALLOWED_SUBPAGES_ADMIN["journal"]=1;

$ALLOWED_SUBPAGES_ADMIN["bulletin_edboard"]=1;

$ALLOWED_SUBPAGES_ADMIN["bulletin_articles_requirements"]=1;

?>