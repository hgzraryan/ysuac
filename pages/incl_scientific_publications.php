<?php
if($INCLUDE!="allow"){
	header("location: login.php");
	exit();
}
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td align="center" valign="center" colspan="3" height="29">
			<div id="constructors_union_link3">{$_SL['science']}</div>
			<div id="departments_sub"></div>
			<div id="news_link2">&nbsp;
				{$_SL['periodic_scientific']}
			</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20" colspan="3">
			<div id="departments_fhl"></div> <div id="departments_title">{$_SL['periodic_scientific']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td colspan="3">
			<ul id="faculties_base">
				<li><a href="?goto=bulletin">{$_SL['nuaca_bulletin']}</a></li>
				<li><a href="?goto=proceedings">{$_SL['ysuac_proceedings']}</a></li>
				<li><a href="?goto=collection">{$_SL['collection_builders']}</a></li>
			</ul>
		</td>
	</tr>
	<tr><td colspan="3" height="100%"></td></tr>
</table>
html;
?>