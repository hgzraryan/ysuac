<?php
if($ADMIN_PROTECT!="allow"){
	header("location: login.php");
	exit();
}
$tiny_name="etext_foreign_entrant";
echo<<<html
<table border="0" cellpadding="0" cellspacing="0" width="100%" height="100%">	
	<tr>
		<td valign="top" align="center">
html;
include_once("editor.php");
echo <<<html
		</td>
	</tr>
</table>














html;
?>