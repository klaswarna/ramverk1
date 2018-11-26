<?php

namespace Anax\View;

?>
<h1>Var finns ip-numret</h1>

<h3>Mata in ett ip-nummer</h3>
<p>Mata in ett godtyckligt ip-nummer i rutan:</p>
<form method="get" action="<?=url("geotag/result")?>">
    <input type="text" name="ipnummer" value="<?=$thisip?>">
    <input type="submit" name="knapp" value="Kolla upp ip-numret (webbtext)">
</form>



<p>några snabbtest:</p>
<a href="<?=url("geotag/result") . "?ipnummer=132.248.10.7"?>">132.248.10.7</a><br>
<a href="<?=url("geotag/result") . "?ipnummer=139.59.153.123"?>">139.59.153.123</a><br>
<a href="<?=url("geotag/result") . "?ipnummer=2001:0db8:0000:0000:0000:0000:1428:07ab"?>">2001:0db8:0000:0000:0000:0000:1428:07ab</a><br>
<h3>Få svar i json-format</h3>
<p>Nedan kan du göra samma sak som ovan, men resultatet kommer i form av json<br>
(I själva verket så postas ip-numret i post-variabeln "ipnummer" till<br> ... ramverk1/me/redovisa/htdocs/geotag<br>
och det ska funka från godtycklig applikation ansluten till internet)</p>
<p>Mata in ett godtyckligt ip-nummer i rutan:</p>
<form method="post" action="<?=url("geotag/index")?>">
    <input type="text" name="ipnummer">
    <input type="submit" name="knapp" value="Kolla upp ip-numret (json)">
</form>
<p>några snabbtest:</p>
<form method="post" action="<?=url("geotag/index")?>">
    <input type="submit" name="ipnummer" value="132.248.10.7"><br>
    <input type="submit" name="ipnummer" value="139.59.153.123"><br>
    <input type="submit" name="ipnummer" value="2001:0db8:0000:0000:0000:0000:1428:07ab"><br>
</form>
