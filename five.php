<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Directions service (complex)</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #warnings-panel {
        width: 100%;
        height:10%;
        text-align: center;
      }
    </style>
  </head>
  <body>
  <?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ydsmap";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	?>

    <div id="floating-panel">
    <b>Start: </b>
	<?php 
	$sql = "SELECT * FROM locationdata";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		echo "<select id='start'>";
		// output data of each row
		while($row = $result->fetch_assoc()) {
			echo "<option value='$row[lat],$row[lng]'>$row[first_name] $row[middle_name] $row[last_name]</option>";
		   // echo "First Name: $row[first_name], Middle Name: $row[middle_name], Last Name: $row[last_name], Location: ($row[lat],$row[lng]), Address: $row[address]<br>";
		}
		echo "</select>";
		
	} else {
		echo "0 results";
	}
	?>
<b>End: </b>
<?php
$sql = "SELECT * FROM locationdata";
$result1 = $conn->query($sql);
if ($result1->num_rows > 0) {
	echo "<select id='end'>";
    // output data of each row
    while($row1 = $result1->fetch_assoc()) {
		echo "<option value='$row1[lat],$row1[lng]'>$row1[first_name] $row1[middle_name] $row1[last_name]</option>";
       // echo "First Name: $row[first_name], Middle Name: $row[middle_name], Last Name: $row[last_name], Location: ($row[lat],$row[lng]), Address: $row[address]<br>";
    }
	echo "</select>";
	} else {
    echo "0 results";
}
?>
   
    </div>
    <div id="map"></div>
    &nbsp;
    <div id="warnings-panel"></div>
    <script>
      function initMap() {
        // Instantiate a directions service.
        var directionsService = new google.maps.DirectionsService;

        // Create a map and center it on Manhattan.
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: {lat: 19.219639, lng: 72.852139}
        });

        // Create a renderer for directions and bind it to the map.
        var directionsDisplay = new google.maps.DirectionsRenderer({map: map,suppressInfoWindows: true });

        // Instantiate an info window to hold step text.
		//var infostart = new google.maps.InfoWindow;
		//var infoend = new google.maps.InfoWindow;       

        // Display the route between the initial start and end selections.
        calculateAndDisplayRoute(
            directionsDisplay, directionsService, map);
        // Listen to change events from the start and end lists.
        var onChangeHandler = function() {
          calculateAndDisplayRoute(
              directionsDisplay, directionsService, map);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);
        document.getElementById('end').addEventListener('change', onChangeHandler);
      }

      function calculateAndDisplayRoute(directionsDisplay, directionsService, map) {
        

        // Retrieve the start and end locations and create a DirectionsRequest using
        // WALKING directions.
        directionsService.route({
          origin: document.getElementById('start').value,
		  destination: document.getElementById('end').value,
          travelMode: 'WALKING'
        }, 
		function(response, status) {
          // Route the directions and pass the response to a function
          
          if (status === 'OK') {
            document.getElementById('warnings-panel').innerHTML =
                '<b>' + response.routes[0].warnings + '</b>';
            directionsDisplay.setDirections(response);           
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

      

      
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHGMjbOuBg8O-c_LzWO5mkmlZpD15pYH8&callback=initMap">
    </script>
  </body>
</html>