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
    	
    	//charger les nouveaux noms de colonne
        $.ajax({
            url: pathToNomSemaine+"/"+timestamp,
            type: 'POST',
            data: 'string',
            dataType: 'json',
            success: function(json) {
            	var day;
            	var time;
                for (var i = 0; i < 7; i++){
                	day = i+1;
                	time = new Date(json[i]).getTime()/1000;
                	$("[id^=jour_"+day+"_]").attr('id', "jour_"+day+"_"+time);
                }
            },
            error: function (jqXHR, textStatus, errorThrown){
                alert(errorThrown);
            }
            
        });
        
        //chargers les évènements avec ajax et les placer dans le nouveau calendrier
        loadSport(pathLoadSportCal, timestamp);
        
        //empecher le comportement naturel
        return false;
    });
});
