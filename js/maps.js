function loadmap(){
var kupondole = {lat: 27.6862, lng: 85.3149};

        // Create a map object and specify the DOM element
        // for display.
        var map = new google.maps.Map(document.getElementById('map'), {
          center: kupondole,
          zoom: 4
        });
		}