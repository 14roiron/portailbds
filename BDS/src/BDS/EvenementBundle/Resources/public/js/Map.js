/**
 *On creer les variables map, marker pour les utiliser tout le temps 
 */

var map;
var marker;

//fonction d'affichage de la map
function initMap(){
	//on creer l'objet LatLng
	var LatLng = new google.maps.LatLng(myLat, myLng);
	
	//on initialise la map
	map = new google.maps.Map(document.getElementById('map'), {
		center: LatLng,
		zoom: 15,
		disableDefaultUI: true
	});
	
	//on repositionne le marker 
	marker = new google.maps.Marker({
		position: LatLng,
		map: map,
		title: fullAdr
	});
	
	//quand on clique sur le marker on la recentre et on zoom par defaut 
	marker.addListener('click', function(){
		map.setZoom(15);
		map.setCenter(marker.getPosition())
	});
	
	
}

