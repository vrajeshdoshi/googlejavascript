<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title></title>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
    <!--
function GetLocation() {
var geocoder = new google.maps.Geocoder();
var array1 = document.getElementById('txtAddress').value.split('\n');
var address = "";
var latitude = 0.0;
var longitude = 0.0;
document.getElementById("output_text").innerHTML = "";
document.getElementById("csv_output").value = "stop,latitude,longitude,link\n";
var LENGTH = array1.length;
var SUFFIX = document.getElementById("suffix").value;
(function loop(i) {
// got this from http://stackoverflow.com/a/28831613/4355695
	address = array1[i] + SUFFIX;
	var addressorig = array1[i];
	console.log(address);
	geocoder.geocode({ 'address': address }, function (results, status) {
	// got this from http://www.aspsnippets.com/Articles/Google-Maps-API-V3-Get-Latitude-and-Longitude-of-a-location-from-Address-using-JavaScript.aspx
		if (status == google.maps.GeocoderStatus.OK) {
			latitude = results[0].geometry.location.lat();
			longitude = results[0].geometry.location.lng();
			//alert(latitude + "," + longitude);
			document.getElementById("output_text").innerHTML += i + '. ' + address + ' : ' + '<a href="http://maps.google.com/?q=' + latitude + ',' + longitude + '" target="_blank">' + latitude + ',' + longitude + '</a><br>';
			document.getElementById("csv_output").value += '"' + addressorig + '","' + latitude + '","' + longitude + '","http://maps.google.com/?q=' + latitude + ',' + longitude  + '"\n';
			} else {
			document.getElementById("output_text").innerHTML += "Request failed for \"" + address + "\"<br>";
			document.getElementById("csv_output").value += '"' + addressorig + '"\n';
		}
	});
    i++;
    if (i < array1.length)
    {
        setTimeout(function() { loop(i); }, 1000);
    }
})(0);
};
        //-->
    </script>
</head>
<body>
<h2>Tool for getting Latitude, Longitude of places in bulk</h2>
<table width="100%">
<tr width="100%">
<td width="50%">
    <textarea id="txtAddress" rows="20" cols="60">Pune
    Mumbai
    Delhi
    Bengaluru
    Chennai
    Kolkota</textarea>
    <br />
	Common suffix for all addresses: <input type="text" id="suffix" value=", India"/> <br />
    <input type="button" onclick="GetLocation()" value="Get Location" />
</td>
<td>
CSV Output:<br>
<textarea id="csv_output" rows="10" cols="60" ></textarea>
</td>
</tr>
</table>
<br><br>Output with links:<br>
<div id="output_text" cols="60" rows="30"></div>
<br>
<a href="https://gist.github.com/answerquest/b6a97ed4251564bb5840">Get the code<</a>. Feedback? Send an email to nkhil.js [at] gmail.com


</body>
</html>