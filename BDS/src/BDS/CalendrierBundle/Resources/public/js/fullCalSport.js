$(document).ready(function(){
    
    //on part sur la semaine suivante 
    $("[id^=button_lundi_]").click(function(){
        //afficher le loader

        // on récupère la date du prochain lundi 
        
        //charger le tableau superieur pour changer les dates des jours 
    	var timestamp = $(this).attr('id').replace('button_lundi_', '');
    	
    	$.post( pathToHeader+'/'+timestamp, function(data){
    		$('#header_cal').html(data);
    	});
        
        //vider les évènements 
        
        //chargers les évènements avec ajax
        
        //les placer dans le nouveau calendrier
        
        //enlever le loader
        
        //recharger la barre d'aujourdhui 
        
    	//retourner false 
    	return false;
    });
});
