<?php 

include_once("config.php");
$query = "SELECT * FROM tabel_kecamatans";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaflet PHP Native</title>
     <!-- Inisialisasi Leaflet CSS -->
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <!-- Style Project -->
    <style>
        #mymap{
            height: 100%;
        }

        html,
        body {
        height: 100%;
        margin: 0;
        padding: 0;
        }
    </style>
</head>
<body>

    <div id="mymap"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script>
        // setview latitude longitude & setzoom view 
        let mymap = L.map('mymap').setView([-6.892659, 112.051369], 11);

        // set tile layer 
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(mymap);

        let data;

        <?php
            if ($data=mysqli_query($mysqli,$query)) {
                while($obj=mysqli_fetch_object($data)){
        ?>

        data = <?= $obj->geojson ?>;
        L.geoJSON(data, {
            style: function(feature){
                return {color: feature.properties.color};
            }
        }).bindPopup(function(layer){
            return layer.feature.properties.description;
        }).addTo(mymap);

        <?php
                }
            }
        ?>

    </script>
</body>
</html>

