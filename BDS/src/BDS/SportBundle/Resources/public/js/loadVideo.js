//on initialise le document 
$(document).ready(function(){
	
	//s'il y a déjà une Url on essaye de la charger 
	var url = $("#bds_corebundle_presentation_urlVideo").attr('value');
	var isBalise = false;
	
	if (url != null){
		//on ajoute la balise Iframe et on passe isBalise à true
		$("#video").append('"<iframe class="embed-responsive-item" id="balise" src="'+url+'" allowfullscreen></iframe>"');
		isBalise = true;
	}
	
	$("#bds_corebundle_presentation_urlVideo").change(function(){
		
		if (isBalise == false){
			//on ajoute la balise Iframe et on passe isBalise à true
			$("#video").append('"<iframe id="balise" class="embed-responsive-item" src="'+$(this).val()+'" allowfullscreen></iframe>"');
			isBalise = true;
		} else {
			$("#balise").attr('src', $(this).val())
		}
	});
	
});