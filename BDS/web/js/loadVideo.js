//on initialise le document 
$(document).ready(function(){
	
	//s'il y a déjà une Url on essaye de la charger 
	var url = $("#bds_corebundle_presentation_urlVideo").attr('value');
	var isBalise = false;
	
	if (url != null){
		//on ajoute la balise Iframe et on passe isBalise à true
		$("#video").append('"<iframe id="balise" width="100%"height="350" src="'+url+'" frameborder="0" allowfullscreen></iframe>"');
		isBalise = true;
	}
	
	$("#bds_corebundle_presentation_urlVideo").change(function(){
		
		if (isBalise == false){
			//on ajoute la balise Iframe et on passe isBalise à true
			$("#video").append('"<iframe id="balise" width="100%"height="350" src="'+$(this).val()+'" frameborder="0" allowfullscreen></iframe>"');
			isBalise = true;
		} else {
			$("#balise").attr('src', $(this).val())
		}
	});
	
});