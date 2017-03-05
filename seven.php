<!DOCTYPE html>
<html>
  <head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
		width: 60%;
		float:left;
      }
	  #check {
		  float:left;
	  }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
  <div>
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
       
    }
	echo "</select>";
	} else {
    echo "0 results";
}
?>
   
    </div>
    <div id="map"></div>
	<div id="check">Check List
	<form action="">
	<?php
	$sql = "SELECT * FROM `locationdata` LIMIT 3";
	$result1 = $conn->query($sql);
	if ($result1->num_rows > 0) {
	echo "<form action=''>";
    // output data of each row
    while($row1 = $result1->fetch_assoc()) {
		echo "<input type='checkbox' name='$row1[id]' value='$row1[lat],$row1[lng]'>$row1[first_name] $row1[middle_name] $row1[last_name]<br>";
       
    }
	echo "</form>";
	} else {
    echo "0 results";
}
	for($i = 0; $i<10; $i++){
		



	}
	?>
	</form>
	</div>
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
	  var directionsService = new google.maps.DirectionsService;
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHGMjbOuBg8O-c_LzWO5mkmlZpD15pYH8&callback=initMap"
    async defer></script>
  </body>
</html>