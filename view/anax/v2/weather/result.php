<?php
//för darkSky
namespace Anax\View;

?>

<?php if (isset($res["error"])) {
    echo($res["error"]);
} else { ?>



<p>Väderresultat med början <?=($res["type"] == "future" ? "idag" : "för 30 dagar sedan") ?>:</p>


<table class="lilltabell">
<th>dag</th>

<th>Vädersummering</th>
<th>Högsta temperatur</th>
<th>Lägsta temperatur</th>
<th>Vindstyrka</th>
<?php
foreach ($res["weatherresult"]->daily->data as $key => $value) { ?>
    <tr>
        <td><?=$key?></td>

        <td><?=$value->summary ?? "no data available"?></td>
        <td><?=$value->temperatureHigh ?? "---" ?></td>
        <td><?=$value->temperatureLow ?? "---"?></td>
        <td><?=$value->windSpeed ?? "---"?></td>
    </tr>

<?php } ?>

</table>
Stad: <?=$res["city"]?><br>
Land: <?=$res["country"]?>
<div class="nosynlig">
    <div>Longitud:</div><div id="longitude"><?=$res["longitude"]?></div>
    <div>Latitud:</div><div id="latitude"><?=$res["latitude"]?></div>
</div>

<br>


<div id="demoMap" style="height:250px; width:250px"></div>


<script src="http://www.openlayers.org/api/OpenLayers.js"></script>
<script>
    var latitude = document.getElementById("latitude").innerText;
    var longitude = document.getElementById("longitude").innerText;
    console.log("latitude: ");
    console.log(latitude);
    map = new OpenLayers.Map("demoMap");
    map.addLayer(new OpenLayers.Layer.OSM());
    map.zoomToMaxExtent();


    var lonLat = new OpenLayers.LonLat( longitude, latitude  )
          .transform(
            new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
            map.getProjectionObject() // to Spherical Mercator Projection
        );

    var zoom=12;

    var markers = new OpenLayers.Layer.Markers( "Markers" );
    map.addLayer(markers);

    markers.addMarker(new OpenLayers.Marker(lonLat));

    map.setCenter (lonLat, zoom);

</script>
<?php } ?>
