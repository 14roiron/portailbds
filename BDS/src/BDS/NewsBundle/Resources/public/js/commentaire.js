/**
 * Ce script permet de ne recharger que le nouveau commentaire au moment de son envoi au serveur
 * grace au protocole AJAX
 */

var commenter =$('#bds_newsbundle_commentaire_commenter');

commenter.addEventListener('submit', function(e){
	//sauvegarde du commentaire 
	$.ajax({
		url: $('#form').attr('action'),
		type: $('#form').attr('method'),
		data: $('#form').serialize(),
		dataType: 'html',
		success: function(){
			//je me tate pour la balise toute mignone 
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert (errorThrown);
		}
	});
});