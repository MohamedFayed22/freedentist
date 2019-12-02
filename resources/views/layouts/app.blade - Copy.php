<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
	
   <script src="{{ asset('js/app.js') }}" ></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  
<script src="{{ asset('public/js/jquery-gmaps-latlon-picker.js') }}"></script>


 <script type="text/javascript">
        $(function () {
            $('.date-picker').datetimepicker({
                inline: true,
				format: "YYYY-MM-DD HH:mm:ss",
                sideBySide: true
            });
        });
    </script>
	
	<script>
        window.onload = function() {
            str=jQuery("#req_map_location").val();
            loc= str.split(",");
            //        alert(loc[0])
            var lat = parseFloat(loc[0]);
            var lng = parseFloat(loc[1]);
            var latlng = new google.maps.LatLng(lat, lng);
            //console.log(latlng);
            var map = new google.maps.Map(document.getElementById('googlemaps'), {
                center: latlng,
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
			// Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
  var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }
var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: 'Set lat/lng values for this property',
                draggable: true
            });
           google.maps.event.addListener(marker, 'dragend', function(a) {
                jQuery("#req_map_location").val(a.latLng.lat().toFixed(4) + ',' + a.latLng.lng().toFixed(4));
            });
            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                jQuery("#req_map_location").val(event.latLng.lat().toFixed(4) + ',' + event.latLng.lng().toFixed(4));
            });
		  
	   // Create a marker for each place.
            
               // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
           /* markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));*/

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });
      
         
          
			
            
			
        };
    </script>
    <script  async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhn_h7PC1k3TB3v9Hj7HsSKwKozh3sCf8&libraries=places&callback=initAutocomplete"></script>

  <!-- <script src="{{ asset('public/date-time/bootstrap-datepicker.js') }}" ></script>
   <script src="{{ asset('public/date-time/bootstrap-timepicker.js') }}" ></script>
   <script src="{{ asset('public/date-time/bootstrap-datetimepicker.js') }}" ></script>
   <script src="{{ asset('public/date-time/moment.js') }}" ></script>
   <script src="{{ asset('public/date-time/daterangepicker.js') }}" ></script>-->
 <!--
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
	<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>-->
	
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
					
                </a>
				 <!-- <a class="nav-link" href="{{ url('/home') }}"> Admin Dashboard</a>
             -->   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    
                        <!-- Authentication Links -->
                        @guest
                       
                       
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                  
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
<script>
	$('.date-picker').datepicker({
                format: 'yy/mm/dd',
                autoclose: true,
                todayHighlight: true
            });
</script>
