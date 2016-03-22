/**
 * 
 */

/**chaque champ de l'adresse retournée par l'autoload peut être 
 * rendu sous deux formes différentes(short_name ou long_name)
 */
var componentForm = {
	      street_number: 'short_name',
	      route: 'long_name',
	      locality: 'long_name',
	      administrative_area_level_1: 'short_name',
	      country: 'long_name',
	      postal_code: 'short_name'
};

/**on creer les variables map, maker et autoload en global
 * pour s'en servir partout
 */
var map;
var maker;
var autocomplete;

//fonction d'initialisation de l'autoload et de la map
function initMap(){
	//on crée l'objet autoload relié à l'éléd'Id autocomplete
	autocomplete = new google.maps.places.Autocomplete(
			(document.getElementById('infoadress')),
			{types: ['geocode']});
	
	/**Quand l'adresse change on appelle la fonction qui va remplir 
	 * les champs du formulaire automatiquement
	 */
	autocomplete.addListener('place_changed', fillInAddress);
	
	//on cree un objet LatLng avec la position de base la map
	var myLatLng = {lat: 50.695521, lng: 3.16398300000003};
	//on initialise la map
	map = new google.maps.Map(document.getElementById('map'), {
		center: myLatLng,
		zoom: 15,
		disableDefaultUI: true
	});
	//on initialise le marker
	marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		title: 'Mon marker'
	});
	//quand on clique sur le marker on recentre la map et on zoom par defaut
	marker.addListener('click', function() {
		map.setZoom(15);
		map.setCenter(marker.getPosition());
	});
}

function fillInAddress() {
    // on récupère l'objet place
    var place = autocomplete.getPlace();
    // on vide les inputs
    emptyInputs();
    // pour chaque élément de place
    for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          // si le type choisi (short_name ou long_name) est défini
          if (componentForm[addressType]) {
                //on récupère la valeur
                var val = place.address_components[i][componentForm[addressType]];
                // on remplit le champ avec la valeur
                document.getElementById(addressType).value = val;
          }
    }
    //on ajoute les bonnes valeurs pour les champs latitude et longitude
    document.getElementById('lat').value = place.geometry.location.G;
    document.getElementById('lng').value = place.geometry.location.K;
}

//fonction qui vide les champs du formulaire
function emptyInputs() {
    for (var component in componentForm) {
    // on vide le champ
          document.getElementById(component).value = '';
          // on set l'attribut disabled à false
          document.getElementById(component).disabled = false;
          document.getElementById('lat').value = "";
          document.getElementById('lng').value = "";
    }
}
