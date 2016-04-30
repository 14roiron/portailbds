/**
 * On change le label de commentaire quand la personne met "non" et on le remet à commentaire si elle met "oui"
 */

//on récupère tous les radios
var radio = $('input:radio')

//on place un listener sur les radios 
$(radio).change(function(){
	
	var commentaire = this.parentNode.parentNode.parentNode.lastElementChild.firstChild.firstChild;
	var input = this.parentNode.parentNode.parentNode.lastElementChild.lastChild;
	
	switch (this.value){
	case "1":
		commentaire.nodeValue = "commentaire";
		input.placeholder = "ça va être de la balle";
	break;
	case "0":
		commentaire.nodeValue = "excuse";
		input.placeholder = "je peux pas j'ai poney";
	break;
	default:
		commentaire.nodeValue = "commentaire";
		input.placeholder = "pour l'instant je m'en fou";
	}
	
});