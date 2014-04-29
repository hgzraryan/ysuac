function checkAll() {
	for (var j = 1; j < qanak; j++) {
		if(document.getElementById('pbox['+j+']').checked == false){
			document.getElementById('pbox['+j+']').checked = true;
		} else {
			document.getElementById('pbox['+j+']').checked = false
		}
   }
}
