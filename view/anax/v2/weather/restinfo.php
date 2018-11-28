<?php

namespace Anax\View;

?>
<h1>Rest-api-väder-tjänst</h1>
<p>Du erbjuds ett restful api på adressen ... <b>weather/rest</b></p>

<p><u>Använd följande parametrar</u></p>
<ul>
    <li>ipn=&lt;ip-nummer&gt;</li>
    <li>lon=&lt;longitud&gt;</li>
    <li>lat=&lt;latitud&gt;</li>
    <li>type=&lt;"future" eller "past" (ger en veckas prognos eller en månads historiskt väder)&gt;</li>
</ul>


<p>t.ex. <i>..weather/rest?lon=18.067353&lat=59.327420&type=past </i> låter oss kolla temperaturen över riksdagshuset
    30 dagar bakåt. Där har blåst en hel del senaste månaden när detta skrevs (november 2018).</p>

<p>Obs om du anger ip-nummer skall du naturligtvis inte ange koordinater och vice versa!</p>
