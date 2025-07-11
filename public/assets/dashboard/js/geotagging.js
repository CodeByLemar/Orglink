 
    // $(this).attr('name');
    // $(this).prop('name');
    // var timin = $('[id^="time_in_txtbx"]'); 
    // var x = document.getElementsById("time_in_txtbx");


    // var test = document.getElementById("test10060");

    // function getLocation() {
    //   if (navigator.geolocation) {
    //     navigator.geolocation.getCurrentPosition(showPosition);
    //   } else { 
    //     test.innerHTML = "Geolocation is not supported by this browser.";
    //   }
    // }

    // function showPosition(position) {
    //   test.innerHTML = "Latitude: " + position.coords.latitude + 
    //   "<br>Longitude: " + position.coords.longitude;
    // }
    console.log('JS FOR GEOTAGGING')

        function getOrigin(data)        {
          

            if (navigator.geolocation) 
            {
                // navigator.geolocation.getCurrentPosition(showOrigin);
                
                 // $('#test').append("test");
                  // alert(arcy);

                  navigator.geolocation.getCurrentPosition(function (position) {
                      updatePosition(position, data);
                  }, errorPosition, optionsPosition);
            }
            else 
            { 
                timin.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        

        function updatePosition(position, data) {
          

          var san = '.time_in_txtbx-'+ data;
          $('.time_in_txtbx-'+ data).replaceWith("<label>Latitude:</label><br><input id='latitude_in' readonly name='latitude_in' value='" + position.coords.latitude + "'><br><label>Longitude:</label><br><input id='longitude_in' readonly name='longitude_in' value='"+ position.coords.longitude +"' /> ");
        }

        function errorPosition(error) {
        if (err.PERMISSION_DENIED === error.code) {

            }
        }

        var optionsPosition = {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        };


        function getDestination(data)        {
          
            if (navigator.geolocation) 
            {
                // navigator.geolocation.getCurrentPosition(showOrigin);
                
                 // $('#test').append("test");
                  // alert(arcy);

                  navigator.geolocation.getCurrentPosition(function (position) {
                      updatePosition2(position, data);
                  }, errorPosition, optionsPosition);
            }
            else 
            { 
                timin.innerHTML = "Geolocation is not supported by this browser.";
            }
            // document.getElementById('submit'+data+'').disabled  = false ;
        }

        function updatePosition2(position, data) {
          

          var san = '.time_out_txtbx-'+ data;
          $('.time_out_txtbx-'+ data).replaceWith("<label>Latitude:</label><br><input id='latitude_out' readonly name='latitude_out' value='" + position.coords.latitude + "'><br><label>Longitude:</label><br><input id='longitude_out' readonly name='longitude_out' value='"+ position.coords.longitude +"' /> ");
        }

        function errorPosition(error) {
        if (err.PERMISSION_DENIED === error.code) {

            }
        }

        var optionsPosition2 = {
            enableHighAccuracy: true,
            timeout: 10000,
            maximumAge: 0
        };

    // function showOrigin(position, data) {
    //      // x.innerHTML = "<p>" + position.coords.latitude + "</p>";
    //      // $(this).parent().find('.time_in_txtbx').append("test");
    //      $('.time_in_txtbx-'+ data).append("<label>Latitude:</label><br><input id='ho_lat' readonly name='latitude_in' value='" + position.coords.latitude + "'>");
    //       // timin.innerHTML = "<label>Latitude:</label><br><input id='ho_lat' readonly name='latitude_in' value='" + position.coords.latitude + 
    //       // "'><br><label>Longitude:</label><br><input id='ho_lon' readonly name='longitude_in' value='"+ position.coords.longitude +"' /> ";
    //     }

    // var y = document.getElementById("destination_txtbx");
    //     function getDestination()        {
    //         if (navigator.geolocation) 
    //         {
    //             navigator.geolocation.getCurrentPosition(showDestination);
    //         }
    //         else 
    //         { 
    //             y.innerHTML = "Geolocation is not supported by this browser.";
    //         }
    //     }

    //     function showDestination(position) {
    //       y.innerHTML = "<label>Latitude:</label><br><input id='route_lat' readonly name='latitude_out' value='" + position.coords.latitude + 
    //       "'><br><label>Longitude:</label><br><input id='route_lon' readonly name='longitude_out' value='"+ position.coords.longitude +"' /> ";
    //     }

    var map;

    function initMap() {
      var ho_lat = document.getElementById('ho_lat').value;
      var ho_lon = document.getElementById('ho_lon').value;
      var route_lat = document.getElementById('route_lat').value;
      var route_lon = document.getElementById('route_lon').value;

      // The map, centered on Central Park
      const center = {lat: parseFloat(ho_lat), lng: parseFloat(ho_lon)};
      const options = {zoom: 15, scaleControl: true, center: center};
      map = new google.maps.Map(
          document.getElementById('map'), options);
      // Locations of landmarks
      const dakota = {lat: parseFloat(ho_lat), lng: parseFloat(ho_lon)};
      const frick = {lat: parseFloat(route_lat), lng: parseFloat(route_lon)};

      let directionsService = new google.maps.DirectionsService();
      let directionsRenderer = new google.maps.DirectionsRenderer();
      directionsRenderer.setMap(map); // Existing map object displays directions
      // Create route from existing points used for markers
      const route = {
          origin: dakota,
          destination: frick,
          travelMode: 'DRIVING'
      }

      directionsService.route(route,
        function(response, status) { // anonymous function to capture directions
          if (status !== 'OK') {
            window.alert('Directions request failed due to ' + status);
            return;
          } else {
            directionsRenderer.setDirections(response); // Add route to the map
            var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
            if (!directionsData) {
              window.alert('Directions request failed');
              return;
            }
            else {
              document.getElementById('total-km').value += directionsData.distance.text;
              document.getElementById('total-time').value += directionsData.duration.text;
            }
          }
        });
    }

function getMap(){
  x = navigator.geolocation;

  x.getCurrentPosition(success, failure);

  function success(position)
  {
    var myLat = position.coords.latitude;
    var myLong = position.coords.longitude;

    var coords = new google.maps.LatLng(myLat, myLong);

    var mapOptions = {

      zoom: 15,
      center: coords,
      mapTypeId: google.maps.MapTypeId.ROADMAP

    }

    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

    var marker = new google.maps.Marker({map:map, position: coords});
  
  }

  function failure()
  {
    
  }
}