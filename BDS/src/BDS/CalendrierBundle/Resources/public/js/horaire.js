/**
 * 
 */
function updateHoraire()
{
	var maintenant = moment();
	
    if (this.timer)
        clearTimeout(this.timer);

    	$("#premiere_ligne").css('height', maintenant.hour()*60+maintenant.minute()); 
  
    this.timer = setTimeout('updateHoraire()', 60*1000);
}

updateHoraire();