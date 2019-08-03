<?php
// This is another page. This one shows details about the player, mainly the players gang

// Requires our autoloading and classes
require_once '__init.php';

// Handle user sign-in
User::i()->login();

// Echo the <head> into our document
Layout::i()->header();

// Echo our navbar
Layout::i()->nav();
?>

<div class="container">
    <div class="container-fluid">
        Comming soon
    </div>
</div>

<?php
// Echo our footer and scripts
Layout::i()->footer();
?>