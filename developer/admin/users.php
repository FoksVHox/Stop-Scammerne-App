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
?>

<div class="text-center">
    <h1 class="display-4">Brugere</h1>   
</div>


<div class="container mt-5">
    <div class="container-fluid">

        <div class="input-group mb-3">
            <input type="text" class="form-control" id = "search" placeholder="SteamID / Navn" aria-label="SteamID / Navn" aria-describedby="btn-search">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="btn-search" onclick = "search(1);">Søg</button>
            </div>
        </div>

        <div class="row" id="live">
            
            <?php
            
                $stmt = SQL::i()->conn()->prepare('SELECT * FROM Users');
                $stmt->execute();
                $res = $stmt->fetchAll();

                foreach($res as $k => $v){
                    
                    if($v['SteamID'] == 'STEAM_0:0:00000000'){
                        continue;
                    }
            ?>

                <div class="card mb-3 mr-auto ml-auto" onclick="window.location.href='../profile.php?id=<?=$v['SteamID']?>'" style="width: 313px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="<?=$v['ProfilePicture']?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?=substr($v['Name'], 0, 14)?></h5>
                                
                            </div>
                        </div>
                    </div>
                </div>
 
            <?php
                }
            ?>
        </div>

    </div>
</div>

<?php
// Echo our footer and scripts
Layout::i()->footer();
?>

<!-- Adding the Config::i()->getVersion() thing makes caching way easier to deal with. In development mode, the version will be a randomized string on each visit, to completely bypass the cache -->
<script src="/assets/js/index.js?v=<?=Config::i()->getVersion()?>"></script>

<!-- Remember to close the body again! -->
</body>

<script>

function search(num){
    $("#live").empty();
    $("#loadingbar").show();

    //var cat = $("#SortByCat").val();
    //var valu = $("#SortByValue").val();
    var search = $("#search").val();
   // var page = num;

    $.ajax({
        type: 'POST',
        url: 'uSearch.php',
        data: {
            //cat: cat,
            //valu: valu,
            term: search,
            //page: page
        },
        success: function(result){
                $("#live").html(result);
                $("#loadingbar").hide();                
        },
        error: function (jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Ikke forbundet til internettet.\n Tjek internetforbindelse.';
            } else if (jqXHR.status == 404) {
                msg = 'Siden blev ikke fundet. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Server fejl, kontakt ZeNoxXi [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Timeout, prøv igen';
            } else if (exception === 'abort') {
                msg = 'Afbrudt, prøv igen.';
            } else {
                msg = 'Ukendt fejl: .\n' + jqXHR.responseText;
            }
            $("#loadingbar").hide();
        },
    });
}

</script>