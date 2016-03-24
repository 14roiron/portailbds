/**
 * Namespace contenant les methodes que nous allons 
 * créer pour le système de drag&drop
 */
var dndHandler ={
	
	//propriété pointant vers l'élément en cours de déplacement 
	draggedElement: null,
		
	applyDragEvents: function(element){
		
		element.draggable = true;
		
		//variable necessaire pour l'event dragstart (facilite l'accès au namespace)
		var dndHandler = this;
		
		element.addEventListener('dragstart', function(e){
			//on stoppe la propagation de l'évènement pour empecger une zone de drop d'agir
			e.stopPropagation();
			
			//sauvegarde de l'élément en cours de drag
			dndHandler.draggedElement = e.target;
			
			//c'est cadeau juste pour fireFox
			e.dataTransfer.setData('text/plain', '');
		});
	},
	
	applyDropEvents: function(dropper){
		
		dropper.addEventListener('dragover', function(e){
			
			//on autorise le drop d'éléments
			e.preventDefault();
			
			//on met l'élément en surbrillance 
			
		
		});
	
		
		dropper.addEventListener('dragleave', function(e){
			
			//on revient au style de départ 
			
			
		});
		
		dropper.addEventListener('drop', function(e){
			
			var target = e.target;
			var draggedElement = dndHandler.draggedElement; //recuperation de l'élément draggé
			var cloneElement = draggedElement.cloneNode(true); //on crée immédiatement le clone de cette élément 
			
			while (target.id.indexOf('dropper') == -1 ){
				target = target.parentNode;
			}
			//application du style par défaut 
			
			//ajout de l'élément cloné à la zone de drop actuelle
			cloneElement = target.appendChild(cloneElement);
			
			//nouvelle application des évènements qui ont été perdus lors du clonage
			dndHandler.applyDragEvents(cloneElement);
			
			//suppression de l'élément d'origine 
			draggedElement.parentNode.removeChild(draggedElement);
			
			//modification du formulaire 
			switch (target.id){
			case "dropper_oui":
				//on récupère les elements radio 
				var radioElements = $('#' + cloneElement.firstChild.nodeValue + ' :radio');
				var radioLen = radioElements.length;
				for (var i =0; i < radioLen; i++)
				{
					//on cherche celui qui a la bonne valeur (j'ai pas réussi à le faire en une fois) et on le check
					if (radioElements[i].value == "1")
					{
						radioElements[i].checked = "checked";
					}
				}
			break;
				
			case "dropper_non":
				var radioElements = $('#' + cloneElement.firstChild.nodeValue + ' :radio');
				var radioLen = radioElements.length;
				for (var i =0; i < radioLen; i++)
				{
					if (radioElements[i].value == "0")
					{
						radioElements[i].checked = "checked";
					}
				}
			break;
			
			case "dropper_aucun":
				var radioElements = $('#' + cloneElement.firstChild.nodeValue + ' :radio');
				var radioLen = radioElements.length;
				for (var i =0; i < radioLen; i++)
				{
					if (radioElements[i].value == "")
					{
						radioElements[i].checked = "checked";
					}
				}
			break;
				
			}
				
			
		});
	}		
};

var elements = $('#dropzone p');
var elementsLen = elements.length;

for (var i = 0; i< elementsLen; i++){
	//application des parametres aux éléments déplacables
	dndHandler.applyDragEvents(elements[i]);
}

var droppers = $('#dropper_oui, #dropper_non, #dropper_aucun');
var droppersLen = droppers.length;

for (var i = 0; i < droppersLen; i++){
	//application des paramettres aux éléments de drop
	dndHandler.applyDropEvents(droppers[i]);
}
	
	