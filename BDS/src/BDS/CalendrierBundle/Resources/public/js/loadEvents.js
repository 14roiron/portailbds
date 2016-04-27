function loadSport(pathLoadSportCal, timestamp){
  
    //envoyer la requette Ajax 
    $.ajax({
        url: pathLoadSportCal+"/"+timestamp,
        type: 'POST',
        data: 'string',
        dataType: 'json',
        success: function(json) {
        	majFullCal(json)
        	//enlever le loader
        	$("#loader").remove();
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert(errorThrown);
        }
        
    });
}
