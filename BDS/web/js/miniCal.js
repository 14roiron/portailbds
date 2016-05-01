/**
 * 
 */

$(document).ready(function(){
	
	//on masque les calendriers 
	$("[id^=tableau_]").hide();
	
	//on récupère la date 
	var laDate = new Date();
	
	var currentYear = laDate.getFullYear();
	var currentMonth = ((laDate.getMonth().length+1) === 1)? (laDate.getMonth()+1) : '0' + (laDate.getMonth()+1);
	var currentMonthInt = laDate.getMonth()+1;
	
	//on affiche le mois et l'année en cours
	$("[id=tableau_"+currentMonth+"_"+currentYear+"]").show();
	
	$("[id^=gauche_]").click(function(){
		//on recupère le mois précédent 
		if (currentMonthInt != 1){
			var moisInt = currentMonthInt - 1;
			var mois = (moisInt.length+1 === 1)? (moisInt) : '0' + moisInt;
			$("[id=tableau_"+currentMonth+"_"+currentYear+"]").slideUp();
			$("[id=tableau_"+mois+"_"+currentYear+"]").slideDown();
			currentMonthInt = moisInt;
			currentMonth = mois;
			
		} else {
			//on charge l'annee précédente en AJAX
		}
		
		return false;
	});
	
	$("[id^=droite_]").click(function(){
		//on recupère le mois précédent 
		if (currentMonthInt != 12){
			var moisInt = currentMonthInt + 1;
			var mois = (moisInt.length+1 === 1)? (moisInt) : '0' + moisInt;
			$("[id=tableau_"+currentMonth+"_"+currentYear+"]").slideUp();
			$("[id=tableau_"+mois+"_"+currentYear+"]").slideDown();
			currentMonthInt = moisInt;
			currentMonth = mois;
			
		} else {
			//on charge l'annee suivante en AJAX
		}
		
		return false;
	});
	
	
});