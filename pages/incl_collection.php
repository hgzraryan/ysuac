<?php

$q_cbuilders="SELECT * FROM {$CONF['dbtable']['cbuilders']}";
mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");
$r_cbuilders=mysql_query($q_cbuilders,$CONN);

echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td colspan="3" height="29" align="center" valign="center">
			<div id="departments_link1"><a href="?goto=library">{$_SL['library']}</a></div>
			<div id="departments_sub"></div>
			<div id="departments_link2">&nbsp;{$_SL['collection_builders']}</div>
		</td>
	</tr>
	<tr><td colspan="3" height="20"></td></tr>
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['collection_builders']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			<table  border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" id="library_selbg">


			
			
			
			
			
			
			
			
			
html;
				$j=1;
				while(($row_cbuilders=mysql_fetch_assoc($r_cbuilders))!=false){
					if ($j%2==1) {
						echo "<tr>";
					}
echo <<<html
							<td id="library_cat1">
								<a href="?goto=bulletin">
									<div id="library_poster">
										<a href="files/{$row_cbuilders['type']}/{$row_cbuilders['name']}">
											<img src="images/library/bulletin/thumbs/{$row_cbuilders['thumbnails']}" width="72">
										</a>
									</div>
									<div id="library_bulletin_txt">
										ՏԵՂԵԿԱԳԻՐ ԹԻՎ {$row_cbuilders['number']}, {$row_cbuilders['year']}</br>
										Եր.: Ճարտարապետության և շինարարության հայաստանի ազգային համալսարան  {$row_cbuilders['year']}թ,  {$row_cbuilders['pages']}էջ:									
									</div>
								</a>
							</td>
							<td width="5"></td>
html;
					if ($j%2==0) {
						echo "</tr>";
						echo "<tr><td colspan='3' height='10'><td></tr>";
					}
					$j++;
				}
echo <<<html
			</table>
		</td>
	</tr>
	<tr><td height="100%"></td></tr>
	<tr><td height="20"></td></tr>
</table>
html;
?>