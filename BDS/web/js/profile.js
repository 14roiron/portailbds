$(document).ready(function(){
	//on cache tous les panneau
	$("[id^=panneau_]").hide();
	
	//on affiche par défaut les sport 
	$("#panneau_sport").show();
	//on active le lien correspondant 
	$("#lien_sport").addClass('active');
	
	var currentPanel = 'sport';
	
	$("[id^=lien_]").click(function(){
		
		var panel = $(this).attr('id').replace('lien_','');
		
		if (panel != currentPanel){
			
			$("[id=panneau_"+currentPanel+"]").slideUp();
			$("[id=panneau_"+panel+"]").slideDown();
			$("[id^=lien_]").removeClass('active');
			$("[id=lien_"+panel+"]").addClass('active');
			currentPanel = panel;
			
		}
		
		return false;
	});
});