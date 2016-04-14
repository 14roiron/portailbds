$(document).ready(function(){
	$("[class=file]").fileinput({
		maxFileCount: 1,
		allowFileExtensions: ["jpg", "png"]
	})
});