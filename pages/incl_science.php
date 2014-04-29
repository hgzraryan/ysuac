<?php
echo <<<html
<form method="post">
	<table border="0" cellpadding="0" cellspacing="0" width="100%" height="800">
		<tr>
			<td height="20" valign="center" width="100">
				<div id="our_data_fhl"></div>
			</td>
			<td width="20"></td>
			<td id="our_data_title" valign="center" height="20">
				{$_SL['science']}
			</td>
		</tr>
		<tr><td colspan="3" height="15"></td></tr>
		<tr>
			<td colspan="3" valign="top">
				<ul id="specialized_council_base">
					<li>
						<a href="?goto=scientific_publications">{$_SL['periodic_scientific']}</a>
					</li>
					<br/>
					<li>
						<a href="?goto=d_module&did=15">{$_SL['aspirantura']}</a>
					</li>
					<br/>
					<li>
						<a href="?goto=d_module&did=15">{$_SL['scientific_research']}</a>
					</li>
					<br/>
					<li>
						<a href="?goto=postgraduate_degree">{$_SL['arka_heraka_ynd']}</a>
					</li>
					<br/>
					<li>
						<a href="?goto=postgraduate_degree">{$_SL['doctorate']} </a>
					</li>
				</ul>
			</td>
		</tr>
	</table>
</form>
html;
?>