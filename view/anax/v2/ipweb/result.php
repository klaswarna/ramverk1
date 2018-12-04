<?php

namespace Anax\View;

?>

<p>Resultatet av inmatat ip-nummer är som följer:</p>
<table class="lilltabell">
<?php


foreach ($res as $key => $value) { ?>
    <tr>
        <td><?=$key?></td>
        <td><?=$value?></td>
    </tr>

<?php } ?>

</table>
