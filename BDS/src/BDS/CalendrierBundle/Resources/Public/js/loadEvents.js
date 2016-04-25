var data;

function loadSport(pathLoadSportCal){
  
    //envoyer la requette Ajax 
    $.ajax({
        url: pathLoadfullSportCal,
        type: 'POST',
        data: 'string',
        dataType: 'json',
        success: function(json) {
            data = json;
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert(errorThrown);
        }
        
    });
}
