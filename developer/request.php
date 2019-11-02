<?php
// This is the index/front page of your app. This is what will be shown to the user upon startup

// Requires our autoloading and classes
require_once '../__init.php';

// Handle user sign-in
User::i()->login();

// Echo the <head> into our document
Layout::i()->header();

// Echo our navbar
Layout::i()->nav();

// Check if there is a new profile picture to a player
Steam::i()->CheckPicture(User::i()->getSteamID())
?>

<div class="text-center">
    <h1 class="display-4">Bliv Udvikler</h1>
    <p>At blive udvikler er meget let, og det koster ikke noget. Bare tryk på den grønne knap nedenunder.</p>
</div>

<div class="container mb-3">
    <div class="container-fluid">
        <form action="../actions/developer.php" method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Hvorfor vil du gerne være udvikler?</label>
                <textarea class="form-control" name="reason" id="textarea" rows="3" placeholder="Skriv hvorfor du gerne vil være udvikler, og uddyb dig gerne. Skriv mindst 100 tegn" required></textarea>
                <div id="textarea_feedback"></div>
            </div>

            <button type="submit" name="developer" class="btn btn-block btn-success">Ansøg om at bliv udvikler</button>
        </form>
    </div>
</div>
<?php
// Echo our footer and scripts
Layout::i()->footer();
?>
<script>

$(document).ready(function() {
    var text_max = 100;
    $('#textarea_feedback').html(text_max + ' tegn tilbage.');

    $('#textarea').keyup(function() {
        var text_length = $('#textarea').val().length;
        var text_remaining = text_max - text_length;
        if(text_remaining < 0){
            text_remaining = 0
        }

        $('#textarea_feedback').html(text_remaining + ' tegn tilbage.');
    });
});

</script>
<!-- Adding the Config::i()->getVersion() thing makes caching way easier to deal with. In development mode, the version will be a randomized string on each visit, to completely bypass the cache -->
<script src="/assets/js/index.js?v=<?=Config::i()->getVersion()?>"></script>

<!-- Remember to close the body again! -->
</body>