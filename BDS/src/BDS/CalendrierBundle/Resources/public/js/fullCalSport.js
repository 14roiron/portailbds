$(document).ready(function(){

    //on part sur la semaine suivante 
    $("[id^=button_lundi_]").click(clickEvent);
    
    function clickEvent (){
        //afficher le loader
    	e = document.createElement('div');
    	$(e).html('<img; src="'+pathToLoader+'" id="Loader" />');
    	$("#header-cal .row").append(e);
        
         //recuperer la date cible
    	var timestamp = parseInt($(this).attr('id').replace('button_lundi_', ''));
    	
    	//charger le tableau superieur pour changer les dates des jours
    	$.post( pathToHeader+'/'+timestamp, function(data){
    		
    		$('#header_cal').html(data); //on remplit le header
    	    $("[id^=button_lundi_]").click(clickEvent); //on ajoute les clickEvent
    		
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
                for (var i = 0; i < 7; i++){
                	var day = i+1;
                	var time = moment(json[i]).format('X');
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
    };
});
