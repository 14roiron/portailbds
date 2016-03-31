/**
 * 
 */
/*jQuery(function($){
	
	//on cache toute les année et tous les mois 
	$("")
});
*/

$(document).ready(function(){
	//on masque les année et les mois 
	$("[id^=annee_]").hide();
	$("[id^=mois_]").hide();
	
	//on recupere la date 
	var laDate = new Date();
	
	var currentYear = laDate.getFullYear();
	var currentMonth = ((laDate.getMonth().length+1) === 1)? (laDate.getMonth()+1) : '0' + (laDate.getMonth()+1);
	
	
	//on affiche l'année et le mois en cours 
	$("[id=annee_"+currentYear+"]").show(); 
	$("[id=mois_"+currentMonth+"]").show();
	
	//on active les deux liens corespondant 
	$("[id=lien_annee_"+currentYear+"]").addClass('active');
	$("[id=lien_mois_"+currentMonth+"]").addClass('active');
	
	var currentDivYear = $("[id=lien_annee_"+currentYear+"]").attr('id').replace('lien_annee_','');
	var currentDivMonth = $("[id=lien_mois_"+currentMonth+"]").attr('id').replace('lien_mois_', '');
	
	$("[id^=lien_mois_]").click(function(){
		var mois = $(this).attr('id').replace('lien_mois_', '');
		
		if (mois != currentDivMonth){
			$("[id=mois_"+currentDivMonth+"]").slideUp();
			$("[id=mois_"+mois+"]").slideDown();
			$("[id^=lien_mois_]").removeClass('active');
			$("[id=lien_mois_"+mois+"]").addClass('active');
			currentDivMonth = mois;
		}
		
		return false;
		
	});
	
	$("[id^=lien_annee_]").click(function(){
		var annee = $(this).attr('id').replace('lien_annee_', '');
		
		if (annee != currentDivYear){
			$("[id=annee_"+currentDivYear+"]").slideUp();
			$("[id=annee_"+mois+"]").slideDown();
			$("[id^=lien_annee_]").removeClass('active');
			$("[id=lien_annee_"+annee+"]").addClass('active');
			currentDivYear = annee;
		}
		
		return false;
		
	});
	
	
});
