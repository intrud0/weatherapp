<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    {{-- <link rel="shortcut icon" type="image/png" href="/icon.png" /> --}}

    <link
      href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;600;700;800&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_API_KEY')}}&libraries=&v=weekly"></script>
    <title>Weather App</title>
  </head>
  <body>
    <div class="sidebar">
      <img src="{{ asset('images/weather.png') }}" alt="Logo" class="logo" />
        <div class="weather_info">
           <h2>140 Degree</h2> 
        </div>

      <p class="copyright">
        &copy; Copyright by
        <a
          class="twitter-link"
          target="_blank"
          href="https://twitter.com/VermonTroyd"
          >Vermon Troyd Orijuela</a
        >.
      </p>
    </div>

    <div id="map"></div>


  <script>
  let marker;
  let info;
  var mapElement = document.getElementById("map");
  var defaultLoc = new google.maps.LatLng(14.390798,120.973177);
  var mapOptions = {
        center: defaultLoc, zoom: 6,
        mapTypeId:google.maps.MapTypeId.ROADMAP
      };
  var map = new google.maps.Map(mapElement, mapOptions);
          google.maps.event.addListener(map, 'click', function(event) {
          placeMarker(map, event.latLng);
        });
        
        function placeMarker(map, location) {
          var lat = location.lat();
          var longit = location.lng();
          var activeInfoWindow;
          if (!marker || !marker.setPosition) {
              marker = new google.maps.Marker({
                  position: location,
                  map: map,
              });
          } else {
              marker.setPosition(location);
          }
          if (!!infowindow && !!infowindow.close) {
              infowindow.close();
          }
          
      }
  </script>
  </body>
</html>
