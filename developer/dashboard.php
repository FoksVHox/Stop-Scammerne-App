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

if(!isset($_GET['id'])){?>

<div class="container">
    <div class="container-fluid">
        <h1 class="display-4 text-center">Dine teams</h1>

        <br>

            
        <hr>

        <div class="row">
            <?php
            foreach (Teams::i()->GetTeams() as $k => $v) {
                if($v['img'] == null){
                    $img = '/assets/img/nophoto.png';
                } else {
                    $img = $v['img'];
                }
                ?>
                <div class="card mb-3 mr-auto ml-auto" style="width: 313px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                    <img src="<?=$img?>" class="card-img" style="height: 100%; width:auto;" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=$v['name']?></h5>
                            <a href="dashboard.php?id=<?=$v['id']?>" class="btn btn-dark btn-block">Se infomation</a>
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
} else {
?>



<?php
}
// Echo our footer and scripts
Layout::i()->footer();
?>

<!-- Adding the Config::i()->getVersion() thing makes caching way easier to deal with. In development mode, the version will be a randomized string on each visit, to completely bypass the cache -->
<script src="/assets/js/index.js?v=<?=Config::i()->getVersion()?>"></script>

<!-- Remember to close the body again! -->
</body>