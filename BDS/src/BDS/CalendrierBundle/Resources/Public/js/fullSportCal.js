var divCourant;
var decale = 0;
var journeeCourante {{ lundi }};
var journeePlus = journeeCourante;
var finEvent = false;
var events = {{events}};
var temps;
var duree;

for each (event in events){
	//on demarre un nouvel evenement
	finEvent = false;
	//on verifie qu'on est toujours dans la même journée
	if (event[debutEvenement] > journeeCourante (+24)){
		journeeCourante = journeeCourante.setHours(journeePlus.getHours()+24);
	}
	journeePlus = journeeCourante;
	//on test le décalage 
	if(finEventPrec[decale] > event[debutEvenement]){
		decale++;
	}
	
	while(finEvent == false){
		divCourant = $("[id=jour_"+journeePlus+"]").appenchild(document.createElement("div"));
		divCourant.style.z-index = decale;
		divCourant.style.margin-left = 2*decale+"px";
		divCourant.style.border-left = "1px "+event[couleur];
		divCourant.color = event[couleur];
		divCourant.opacity = 0.5;
		
		//on s'interesse au début de la boite
		if (event[debutEvenement] < journeePlus){
			divCourant.style.top = "0px";
			temps = 0;
			divCourant.appenChild(document.createTextNode("<strong>"+event[nom]+"</strong>"));
			event[debutEvenement] = journeePlus;
		} else {
			//on récupère la durée en seconde de l'heure de debut
			temps = event[debutEvenement].getHours()*60+event[debutEvenement].getMinute();
			divCourant.style.top = temps+"px";
			divCourant.appenChild(document.createTextNode("<div><p>"+event[dateDebuEvenement].format("H:i")+"</p><p><strong>"+event[nom]+"</strong></p></div>");
		}
		
		//on s'interesse à la fin de la boite 
		if (event[finEvenement] < journeePlus (+24h)){
			duree = event[finEvenement] - event[debutEvenement]
			temps = duree.getHours()*60+duree.getMinute();
			divCourant.style.height = temps+"px";
			finEvent = true;
			//on enregistre la fin de l'evenement pour un eventuel decalage
			finEventPrec[decale] = event[finEvenement];
		} else {
			divCourant.style.height = 1440-temps+"px";
			journeePlus = journePlus.setHours(journeePlus.getHours()+24);
		}
	}
}
			
			
			
