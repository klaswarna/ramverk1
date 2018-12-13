<?php

namespace Anax\View;

/**
 * View to create a new book.
 */
// Show all incoming variables/functions
//var_dump(get_defined_functions());
//echo showEnvironment(get_defined_vars());

// Create urls for navigation
$urlToView = url("book");



?><h1>Ta bort bok</h1>

<?= $form ?>

<p>
    <a href="<?= $urlToView ?>">Se alla böcker</a>
</p>
