<?php

namespace Anax\View;

?>
<h1>Hur är vädret?</h1>
<p>Genom att mata in ett ip-nummer eller ange geografiska koordinater, får du reda på
    hur vädret är eller har varit på den plats koordinaterna anger eller där ip-användaren finns.</p>


    <form method="get" action="<?=url("weather/result")?>">
        <input type="radio" name="type" value="future" checked> Kommande väder<br>
        <input type="radio" name="type" value="past"> Vädret gångna månaden<br>



<h3>Mata in ett ip-nummer</h3>


    <input type="text" name="ipnummer">
    <input type="submit" name="knapp" value="Kolla väder (ip)">


<h3>Mata in koordinater</h3>

    Longitud:<input type="number" step="any" name="longitude"> &nbsp; &nbsp; Latitud:<input type="number" step="any" name="latitude">
    <input type="submit" name="knapp" value="Kolla väder (koordinater)">
</form>
