$(document).ready(function(){
    
    //on part sur la semaine suivante 
    $("[id^=button_lundi_]").click(function(){
        //afficher le loader
        
         //recuperer la date cible
    	var timestamp = $(this).attr('id').replace('button_lundi_', '');
    	
    	//charger le tableau superieur pour changer les dates des jours
    	$.post( pathToHeader+'/'+timestamp, function(data){
    		
    		$('#header_cal').html(data); //on remplit le header
    		
    	});
        
        //vider les évènements
    	for (var i = 1; i <= 7; i++){
    		$("[id^=jour_"+i+"_]").empty();
    	}
    	alert ("c'est vide");
    	
    	//charger les nouveaux noms de colonne
        $.ajax({
            url: pathToNomSemaine+"/"+timestamp,
            type: 'POST',
            data: 'string',
            dataType: 'json',
            success: function(json) {
                data = json;
                for (var i = 1; i <= 7; i++){
                	$("[id^=jour_"+i+"_]").attr({id: "jour_"+i+"_"+timestamp});
                }
                alert("titre de colonnes changés")
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert(errorThrown);
            }
            
        });
        
        //chargers les évènements avec ajax
        
        //les placer dans le nouveau calendrier
        
        //enlever le loader
        
        //recharger la barre d'aujourdhui 
        
    	//retourner false 
    	return false;
    });
});
