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
	
	//on affiche l'année en cours 
	$("[id=annee_"+laDate.getFullYear()+"]").show();
	//puis le mois en cours 
	$("[id=mois_"+(laDate.getMonth()+1)+"]").show();
	
	//on active les deux liens corespondant 
	$("[id=lien_annee_"+laDate.getFullYear()+"]").addClass('active');
	$("[id=lien_mois_"+(laDate.getMonth())+"]").addClass('active');
	
	var currentYear = $("[id=lien_annee_"+laDate.getFullYear()+"]").attr('id').replace('lien_annee_','');
	var currentMonth = $("[id=lien_mois_"+(laDate.getMonth()+1)+"]").attr('id').replace('lien_mois_', '');
	
	$("[id^=lien_mois_]").click(function(){
		var mois = $(this).attr('id').replace('lien_mois_', '');
		
		if (mois != currentMonth){
			$("[id=mois_"+currentMonth+"]").slideUp();
			$("[id=mois_"+mois+"]").slideDown();
			$("[id^=lien_mois_]").removeClass('active');
			$("[id=lien_mois_"+mois+"]").addClass('active');
			currentMonth = mois;
		}
		
		return false;
		
	});
	
	$("[id^=lien_annee_]").click(function(){
		var annee = $(this).attr('id').replace('lien_annee_', '');
		
		if (annee != currentYear){
			$("[id=annee_"+currentYear+"]").slideUp();
			$("[id=annee_"+mois+"]").slideDown();
			$("[id^=lien_annee_]").removeClass('active');
			$("[id=lien_annee_"+annee+"]").addClass('active');
			currentYear = annee;
		}
		
		return false;
		
	});
	
	
});
