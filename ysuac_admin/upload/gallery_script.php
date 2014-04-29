<?php
echo <<<html
<script src="js/jquery.min.js" type="text/javascript"></script>
<div id="devcontainer">
	<script src="js/droparea.js"></script>
	<div id="areas">
		<input type="file" class="droparea spot" name="xfile" data-post="upload/upload_gallery.php" data-width="220" data-height="220" data-crop="true"/>
		<script>
			$('#sampleform').submit(function(e){
				e.preventDefault();
				$.ajax({
					url:$(this).attr('action'),
					type:'post',
					data:$(this).serialize(),
					dataType:'json',
					success:function(r){
						$('#form-result').append(
						'<div><b>Title: </b>'+r.title+'</div>'
						,'<div><b>Description: </b>'+r.description+'</div>'
						,'<div><b>Image/File: </b>'
						  +'<a href="'+ r.url +'" target="_blank">'+ r.url +'</a>'
						  +'</div>'
						);
					}
				});
		});
		</script>
	</div>

	<script>
	// Calling jQuery "droparea" plugin
	$('.droparea').droparea({
		'instructions': '<div style="font-size:10px;">{$LANG['admin_cat2'][$_SESSION['lang']]}</div>',
		'init' : function(result){
			//console.log('custom init',result);
		},
		'start' : function(area){
			area.find('.error').remove(); 
		},
		'error' : function(result, input, area){
			$('<div class="error">').html(result.error).prependTo(area); 
			return 0;
			//console.log('custom error',result.error);
		},
		'complete' : function(result, file, input, area){
			if((/image/i).test(file.type)){
				area.find('img').remove();
				//area.data('value',result.filename);
				area.append($('<img>',{'src': result.path + result.filename + '?' + Math.random()}));
			} 
			//console.log('custom complete',result);
		}
	});
	</script>
	<!-- /development area -->
</div>
html;
?>