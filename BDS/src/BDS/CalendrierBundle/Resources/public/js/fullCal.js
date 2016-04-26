
/*
*@parma:
*	journeeCourante format DateTime
*	events liste d'evenements de doctrine
*/
function majFullCal(events){
	
	//on cherche le date de lundi 
	var lundi = new Date($("[id^=jour_1_").attr('id').replace('jour_1_', '')*1000);
	lundi.setHours(0);
	lundi.setMinutes(0);
	lundi.setSeconds(0);
	var jour = 1;
	var journeeCourante = new Date(lundi.getTime()); //format date
	var finPrecedent = [new Date(lundi.getTime())];
	var divCourant; //div selectionnée pour mettre les evenements dans le calendrier
	var decale = 0;	// int pour savoir de combien on décale l'evenement dans sa colonne s'il a des 
	var jourPlus = jour;
	var journeePlus = new Date(journeeCourante.getTime()); //format date decrit la journée courante (colonne du tableau)
	var finEvent = false; //boolean pour autoriser le passage à l'élément suivant 
	var temps;	//duree en seconde pour placer le debut de la divCourante
	var duree;	//duree en seconde pour connaitre la hauteur de la divCourante
	var heure = 0;
	var minute = 0;
	
	$.each(events, function(){
		//on demarre un nouvel evenement
		finEvent = false;
		//on verifie qu'on est toujours dans la même journée
		if (new Date(this['debut_evenement']) > new Date(journeeCourante.getTime()+24*60*60*1000)){
			journeeCourante.setTime(journeeCourante.getTime()+24*60*60*1000);
			jour++;
		}
		journeePlus.setTime(journeeCourante.getTime());
		jourPlus = jour;
		
		//on test le décalage
		decale ++
		for (var i = decale -1; i >= 0; i--){
			if (new Date(this['debut_evenement']) > finPrecedent[i]){
				decale--;
			} else {
				break;
			}
		}
		
		while(finEvent == false){
			divCourant = $("[id^=jour_"+jourPlus+"_]").append(document.createElement("div"));
			divCourant.css('z-index', decale+2);
			divCourant.css('margin-left', 2*(decale+1)+"px");
			divCourant.css('borderLeft', "1px "+this['couleur']);
			divCourant.css('color', this['couleur']);
			divCourant.css('opacity', 0.5);
			
			//on s'interesse au début de la boite
			if (new Date(this['debut_evenement']) < journeePlus){
				divCourant.css('top', "0px");
				temps = 0;
				divCourant.append(document.createTextNode("<strong>"+this['nom']+"</strong>"));
				this['debut_evenement'] = journeePlus;
			} else {
				//on récupère la durée en seconde de l'heure de debut
				heure = new Date(this['debut_evenement']).getHours();
				minute = new Date(this['debut_evenement']).getMinutes();
				temps = heure*60+minute;
				divCourant.css('top', temps+"px");
				divCourant.append(document.createTextNode("<div><p>"+heure+":"+minute+"</p><p><strong>"+this['nom']+"</strong></p></div>"));
			}
			
			//on s'interesse à la fin de la boite 
			if (new Date(this['fin_evenement']) < new Date(journeePlus.getTime()+24*60*60*1000)){
				duree = new Date( new Date(this['fin_evenement']).getTime() - new Date(this['debut_evenement']).getTime());
				temps = duree.getHours()*60+duree.getMinutes();
				divCourant.css('height', temps+"px");
				finEvent = true;
				
				//on s'interesse au niveau de décalage 
				for(var i = decale; i >= 0; i--){
					if (new Date(this['fin_evenement']) > finPrecedent[i]){
						finPrecedent[i].setTime(new Date(this['fin_evenement']).getTime());
					}
				}
			} else {
				divCourant.css('height', 1440-temps+"px");
				journeePlus.setTime(journeePlus.getTime()+24*60*60*1000);
			}
		}
	});
}		
