 <div  id="contentdiv">
	<? 
	
	if($page == 1)
	{
		include("pages/home.php");
	}elseif($page == 2)
	{
		include("pages/ambion_npatak.php");
	}elseif($page == 3)
	{
		include("pages/ambion_struct.php");
	}elseif($page == 4)
	{
		include("pages/ambion_git_uxvac.php");
	}elseif($page == 5)
	{
		include("pages/ambion_zargac.php");
	}
	elseif($page == 6)
	{
		include("pages/ambion_seminar.php");
	}
	elseif($page == 7)
	{
		include("pages/ambion_news.php");
	}
	elseif($page == 8)
	{
		include("pages/contact.php");
	}
	elseif($page == 11)
	{
		include("pages/techConf.php");
	}elseif($page == 12)
	{
		include("pages/techArticle.php");
	}elseif($page == 13)
	{
		include("pages/bakinf.php");
	}elseif($page == 14)
	{
		include("pages/bakkar.php");
	}elseif($page == 25)
	{
		include("pages/ambion_verlucum.php");
	}elseif($page == 60)
	{
		include("pages/left/ambion_books.php");
	}elseif($page == 65)
	{
		include("pages/left/examination.php");
	}elseif($page == 66)
	{
		include("pages/left/partners.php");
	}elseif($page == 67)
	{
		include("pages/left/architects_eyes.php");
	}elseif($page == 70)
	{
		include("pages/left/kurser/K12.php");
	}elseif($page == 71)
	{
		include("pages/left/kurser/K13.php");
	}elseif($page == 72)
	{
		include("pages/left/kurser/K02.php");
	}elseif($page == 73)
	{
		include("pages/left/kurser/K03.php");
	}elseif($page == 74)
	{
		include("pages/left/kurser/K92.php");
	}elseif($page == 75)
	{
		include("pages/left/kurser/K93.php");
	}elseif($page == 76)
	{
		include("pages/left/kurser/K82.php");
	}elseif($page == 77)
	{
		include("pages/left/kurser/K83.php");
	}elseif($page == 78)
	{
		include("pages/left/kurser/shK82.php");
	}elseif($page == 79)
	{
		include("pages/left/kurser/shK83.php");
	
	}else{
		include("pages/home.php");
	}

	?>
	
     </div>