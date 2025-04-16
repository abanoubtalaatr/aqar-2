    var map;
    var marker;
    var defaultLat = document.getElementById('latitude').value; // Replace with your default latitude
    var defaultLng = document.getElementById('longitude').value; // Replace with your default longitude

    function initMap() {

        $('form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: defaultLat, lng: defaultLng },
            zoom: 10,
        });

        // Initialize the Autocomplete service
        var input = document.getElementById('address');
        var autocomplete = new google.maps.places.Autocomplete(input);

        // Add event listener for place changed
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            if (place.geometry) {
                updateLatLng(place.geometry.location);
            }
        });

        // Add event listener for map click
        map.addListener('click', function (event) {
            updateLatLng(event.latLng);
            reverseGeocode(event.latLng);
        });

        // Initialize marker
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        // Add event listener for marker drag
        marker.addListener('dragend', function (event) {
            updateLatLng(event.latLng);
            reverseGeocode(event.latLng);
        });

        // Set the default marker position
        var defaultLocation = new google.maps.LatLng(defaultLat, defaultLng);
        marker.setPosition(defaultLocation);
        map.panTo(defaultLocation);
    }

    function updateLatLng(location) {
        document.getElementById('latitude').value = location.lat();
        document.getElementById('longitude').value = location.lng();

        // Update marker position
        marker.setPosition(location);

        // Center the map on the new location
        map.panTo(location);
    }


    function reverseGeocode(location) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: location }, function (results, status) {
            if (status === 'OK' && results[0]) {
                document.getElementById('address').value = results[0].formatted_address;
            }
        });
    }

    // Initialize the map on page load
    google.maps.event.addDomListener(window, 'load', initMap);