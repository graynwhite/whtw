<?php
if(isset($_POST['submit'])){

return $_POST['returnMessage'];

}
$venue = isset($_GET['currentVenue']) ? $_GET['currentVenue'] : "Royal Oak Manor Royal Oak Mi.";

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Find Geo Code Location</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>


<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<script src="jqueryPopUp.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
  <style>
      body {
        font-family: sans-serif;
        font-size: 14px;
      }
      #map-canvas {
        height: 400px;
        width: 600px;
        margin-top: 0.6em;
      }
      input {
        border: 1px solid  rgba(0, 0, 0, 0.5);
      }
      input.notfound {
        border: 2px solid  rgba(255, 0, 0, 0.4);
      }
    </style>

    <script>
      function initialize() {
        var mapOptions = {
          center: new google.maps.LatLng(42.479480, -83.114689),
          zoom: 13,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);

        var input = document.getElementById('searchTextField');
        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          input.className = '';
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // Inform the user that the place was not found and return.
            input.className = 'notfound';
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
          };
          marker.setIcon(image);
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || ''),
			  (place.address_components[3] && place.address_components[3].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
		  document.returnForm.returnMessage.value = place.name + ", " + address;
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          google.maps.event.addDomListener(radioButton, 'click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
</head>
<body>
<div data-role=page id="mainPage" data-theme="b"/> 
<div data-role="header" class="header"><h1>Pjnews</h1></div>


<div data-role="content">
<p><?php echo $venue ?></p>
<div>
      <input id="searchTextField" type="text"  value="<?php echo $venue ?> "size="50">
      <input type="radio" name="type" id="changetype-all" checked="checked">
      <label for="changetype-all">All</label>

      <input type="radio" name="type" id="changetype-establishment">
      <label for="changetype-establishment">Establishments</label>

      <input type="radio" name="type" id="changetype-geocode">
      <label for="changetype-geocode">Geocodes</label>
    </div>
    <div id="map-canvas"></div>
	<form id="returnForm" name="returnForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<input type="text" name="returnMessage" id="returnMessage">
	<input type="radio" name="returnButton" id="okButton" value="Return This Address" >
	<input type="radio"  name="ReturnButton" id="noReturnButton" value="Return Original">
	<input type="submit" value="submit"  name="submit">
	</form> 
	</div><!--End of content-->
<div data_role=footer>footer</div>
</div><!-- End of Page -->
<!-- ========================== -->
</body>
</html>