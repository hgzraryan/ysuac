<?php
echo <<<html
<script>

var interval;
var minutes = 0
var seconds = 5;
window.onload = function() {
	countdown('countdown');
}

function countdown(element) {
	interval = setInterval(function() {
		var el = document.getElementById(element);
		if(seconds == 0) {
			if(minutes == 0) {
				location = 'index.php?goto=our_data';
				clearInterval(interval);
				return;
			} else {
				minutes--;
				seconds = 60;
			}
		}
		if(minutes > 0) {
			var minute_text = minutes + (minutes > 1 ? ' minutes' : ' minute');
		} else {
			var minute_text = '';
		}
		var second_text = seconds > 1 ? 'seconds' : 'second';
		el.innerHTML = minute_text + ' ' + seconds;
		seconds--;
	}, 1000);
}
</script> 
<table border="1" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td valign='top' align="center">
			<table border="0" cellpadding="0" cellspacing="0" style="border: 2px solid #ffffff;" align="center" align="center" width="500" height="150">
				<tr>
					<td id="our_data_text1" colspan="2">
						<center>
							{$_SL['our_data_sendmsg']}</br >
						</center>
					</td>
				</tr>
				<tr>
					<td width="230" height="20" id="our_data_text2">
						{$_SL['page_forward']}
					</td>
					<td>
						<div id='countdown'></div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
html;
unset ($_SESSION['username']);
?>