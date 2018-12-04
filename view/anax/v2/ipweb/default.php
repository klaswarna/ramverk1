<?php

namespace Anax\View;

?>
<h1>Validera ett ip-nummer</h1>

<h3>Få svar som text på webbsida</h3>
<p>Mata in ett godtyckligt ip-nummer i rutan:</p>
<form method="get" action="<?=url("ipweb/ipnummer")?>">
    <input type="text" name="ipnummer">
    <input type="submit" name="knapp" value="Kolla upp ip-numret (webbtext)">
</form>
<p>några snabbtest:</p>
<a href="<?=url("ipweb/ipnummer") . "?ipnummer=132.248.10.7"?>">132.248.10.7</a><br>
<a href="<?=url("ipweb/ipnummer") . "?ipnummer=123.123.123.123"?>">123.123.123.123</a><br>
<a href="<?=url("ipweb/ipnummer") . "?ipnummer=2001:0db8:0000:0000:0000:0000:1428:07ab"?>">2001:0db8:0000:0000:0000:0000:1428:07ab</a><br>
<a href="<?=url("ipweb/ipnummer") . "?ipnummer=123.123.1230.123"?>">123.123.1230.123</a><br>
<a href="<?=url("ipweb/ipnummer") . "?ipnummer=123.123.cykelpump.123"?>">123.123.cykelpump.123</a><br>
<h3>Få svar i json-format</h3>
<p>Nedan kan du göra samma sak som ovan, men resultatet kommer i form av json<br>
(I själva verket så postas ip-numret i post-variabeln "ipnummer" till<br> ... ramverk1/me/redovisa/htdocs/ipweb<br>
och det ska funka från godtycklig applikation ansluten till internet)</p>
<p>Mata in ett godtyckligt ip-nummer i rutan:</p>
<form method="post" action="<?=url("iprest/index")?>">
    <input type="text" name="ipnummer">
    <input type="submit" name="knapp" value="Kolla upp ip-numret (json)">
</form>
<p>några snabbtest:</p>
<form method="post" action="<?=url("iprest/index")?>">
    <input type="submit" name="ipnummer" value="132.248.10.7"><br>
    <input type="submit" name="ipnummer" value="123.123.123.123"><br>
    <input type="submit" name="ipnummer" value="2001:0db8:0000:0000:0000:0000:1428:07ab"><br>
    <input type="submit" name="ipnummer" value="123.123.1230.123"><br>
    <input type="submit" name="ipnummer" value="123.123.cykelpump.123"><br>
</form>
