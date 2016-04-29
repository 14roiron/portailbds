
/*
*@parma:
*	journeeCourante format DateTime
*	events liste d'evenements de doctrine
*/
function majFullCal(events){
	
	//on cherche le date de lundi 
	var lundi = moment.unix(parseInt($("[id^=jour_1_").attr('id').replace('jour_1_', '')));
	var jour = 1;
	var journeeCourante = moment(lundi); //format date
	var finPrecedent = [];
	finPrecedent[0] = moment(lundi);
	var divCourant; //div selectionnée pour mettre les evenements dans le calendrier
	var decale = 0;	// int pour savoir de combien on décale l'evenement dans sa colonne s'il a des 
	var finEvent = false; //boolean pour autoriser le passage à l'élément suivant 
	var temps;	//duree en seconde pour placer le debut de la divCourante
	var duree;	//duree en seconde pour connaitre la hauteur de la divCourante
	var format = "YYYY-MM-DD\THH:mm:ss";	//format dans lequel sont parsé les evenements
	var largeur = $("[id^=jour_1_").css('width'); //largeur des td
	
	$.each(events, function(){
		//on demarre un nouvel evenement
		finEvent = false;
		var dEvent = moment(this['debut_evenement'], format);
		var fEvent = moment(this['fin_evenement'], format);
		
		//on verifie qu'on est toujours dans la même journée
		if (dEvent > moment(journeeCourante).add(1, 'd')){
			journeeCourante.add(1, 'd');
			jour++;
		}
		var journeePlus = moment(journeeCourante);
		var jourPlus = jour;
		
		//on test le décalage
		decale ++
		for (var i = decale -1; i >= 0; i--){
			if ( dEvent > finPrecedent[i]){
				decale--;
			} else {
				break;
			}
		}
		
		while(finEvent == false){
			divCourant = $(document.createElement("div"));
			divCourant.attr('id', 'evenement_'+this['id']);
			divCourant.css('position', 'absolute');
			divCourant.css('left', 5*(decale+1)+"px");
			divCourant.width(largeur-5*(decale+1)+"px");
			//divCourant.css('z-index', decale+3);
			divCourant.css('borderLeft', "2px solid "+this['couleur']);
			divCourant.css('background-color', this['couleur']);
			var couleur = divCourant.css('background-color').replace(')', ', 0.5)').replace('rgb', 'rgba');
			divCourant.css('background-color', couleur);
			//divCourant.css('color', this['couleur']);
			divCourant.css('opacity', 0.5);
			$("[id^=jour_"+jourPlus+"_]").append(divCourant);
			
			
			//on s'interesse au début de la boite
			if ( dEvent < journeePlus){
				divCourant.css('top', "0px");
				temps = 0;
				divCourant.html("<strong>"+this['nom']+"</strong>");
				this['debut_evenement'] = journeePlus.format(format);
				dEvent = moment(this['debut_evenement'], format);
			} else {
				//on récupère la durée en seconde de l'heure de debut
				temps = dEvent.hour()*60 + dEvent.minute();
				divCourant.css('top', temps+"px");
				divCourant.html("<div><small>"+dEvent.hour()+":"+dEvent.minute()+"</br><strong>"+this['nom']+"</strong></small></div>");
			}
			
			//on s'interesse à la fin de la boite 
			if (fEvent < moment(journeePlus).add(1,'d')){
				duree = moment(fEvent).subtract(dEvent.unix(), 's');
				temps = duree.hour()*60+duree.minute();
				divCourant.css('height', temps+"px");
				finEvent = true;
				
				//on s'interesse au niveau de décalage 
				for(var i = decale; i >= 0; i--){
					if (fEvent > finPrecedent[i]){
						finPrecedent[i] = moment(fEvent);
					}
				}
			} else {
				divCourant.css('height', 1440-temps+"px");
				journeePlus.add(1, 'd');
				jourPlus++;
			}
		}
	});
}		
