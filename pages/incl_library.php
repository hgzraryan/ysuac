<?php
echo <<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">
	<tr>
		<td height="20">
			<div id="departments_fhl"></div><div id="departments_title">{$_SL['library']}</div>
		</td>
	</tr>
	<tr><td height="20"></td></tr>
	<tr>
		<td valign="top" id="bologna_text">
			<ul id="library_tabs">
				<li><a href="#" title="library_tab1">{$_SL['by_author']}</a></li>
				<li><a href="#" title="library_tab2">{$_SL['by_name']}</a></li>
			</ul>
			<div id="library_content"> 
				<div id="library_tab1">
					<a href="?goto=library&sby=auth&key=Ա">Ա</a> 
					<a href="?goto=library&sby=auth&key=Բ"> Բ</a>
					<a href="?goto=library&sby=auth&key=Գ"> Գ</a> 
					<a href=""> Դ</a>
					<a href=""> Ե</a>
					<a href=""> Զ</a> 
					<a href=""> Է</a> 
					<a href=""> Ը</a> 
					<a href=""> Թ</a>
					<a href=""> Ժ</a> 
					<a href=""> Ի</a> 
					<a href=""> Լ</a> 
					<a href=""> Խ</a> 
					<a href=""> Ծ</a>
					<a href=""> Կ</a> 
					<a href=""> Հ</a> 
					<a href=""> Ձ</a> 
					<a href=""> Ղ</a> 
					<a href=""> Ճ</a> 
					<a href=""> Մ</a> 
					<a href=""> Յ</a> 
					<a href=""> Ն</a> 
					<a href=""> Շ</a> 
					<a href=""> Ո</a> 
					<a href=""> Չ</a> 
					<a href=""> Պ</a> 
					<a href=""> Ջ</a> 
					<a href=""> Ռ</a> 
					<a href=""> Ս</a> 
					<a href=""> Վ</a> 
					<a href=""> Տ</a> 
					<a href=""> Ր</a> 
					<a href=""> Ց</a> 
					<a href=""> ՈՒ</a>
					<a href=""> Փ</a> 
					<a href=""> Ք</a>
					<a href=""> Օ</a> 
					<a href=""> Ֆ</a>
				</div>
				<div id="library_tab2">  
					<a href="">Ա</a> 
					<a href=""> Բ</a>
					<a href=""> Գ</a> 
					<a href=""> Դ</a>
					<a href=""> Ե</a>
					<a href=""> Զ</a> 
					<a href=""> Է</a> 
					<a href=""> Ը</a> 
					<a href=""> Թ</a>
					<a href=""> Ժ</a> 
					<a href=""> Ի</a> 
					<a href=""> Լ</a> 
					<a href=""> Խ</a> 
					<a href=""> Ծ</a>
					<a href=""> Կ</a> 
					<a href=""> Հ</a> 
					<a href=""> Ձ</a> 
					<a href=""> Ղ</a> 
					<a href=""> Ճ</a> 
					<a href=""> Մ</a> 
					<a href=""> Յ</a> 
					<a href=""> Ն</a> 
					<a href=""> Շ</a> 
					<a href=""> Ո</a> 
					<a href=""> Չ</a> 
					<a href=""> Պ</a> 
					<a href=""> Ջ</a> 
					<a href=""> Ռ</a> 
					<a href=""> Ս</a> 
					<a href=""> Վ</a> 
					<a href=""> Տ</a> 
					<a href=""> Ր</a> 
					<a href=""> Ց</a> 
					<a href=""> ՈՒ</a>
					<a href=""> Փ</a> 
					<a href=""> Ք</a>
					<a href=""> Օ</a> 
					<a href=""> Ֆ</a>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td height="65"></td>
	</tr>
	<tr>
		<td align="left">
			<table  border="0" cellpadding="0" cellspacing="0" width="100%" height="100%" id="library_selbg">
				<tr>
					<td id="library_cat1">
						<a href="?goto=bulletin">
							<div id="library_poster"><img src="images/library/buletin.jpg" border="0"></div>
							<div id="library_poster_txt">{$_SL['nuaca_bulletin']}</div>
						</a>
					</td>
					<td width="10"></td>
					<td id="library_cat1">
						<a href="?goto=credit_bulletin">
							<div id="library_poster"><img src="images/library/teghekagirq.jpg" border="0"></div>
							<div id="library_poster_txt">{$_SL['credit_bulletin']}</div>
						</a>
					</td>
				</tr>
				<tr><td colspan="3" height="10"><td></tr>
				<tr>
					<td id="library_cat1">
						<a href="?goto=proceedings">
							<div id="library_poster"><img src="images/library/tom.jpg" border="0"></div>
							<div id="library_poster_txt">{$_SL['proceedings_lib']}</div>
						</a>
					</td>
					<td width="10"></td>
					<td id="library_cat1">
						<a href="?goto=collection">
							<div id="library_poster"><img src="images/library/shinarar.jpg" border="0"></div>
							<div id="library_poster_txt">{$_SL['collection_builders']}</div>
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="45"></td>
	</tr>
	<tr>
		<td height="20" id="library_card_file">{$_SL['library_card']}</td>
	</tr>
	<tr><td height="100%"></td></tr>
</table>
html;
?>