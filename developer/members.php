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
$id = $_GET['id'];
$res = Teams::i()->getTeamData($id);

?>
<div class="container">
    <div class="container-fluid">
        <h1 class="display-4 text-center"><?=$res['name']?></h1>
            <hr>
            <?=Layout::i()->DeveloperNav($id)?>
        <br>
        <div class="row">
        
            <?php
                $rem = explode(',', $res['members']);
                foreach ($rem as $k => $v) {
                    $info = User::i()->getUserData($v);
                    if($info['SteamID'] == $res['owner']){
                        $own = true;
                    } else {
                        $own = false;
                    }
                ?>

                    <div class="card mb-3 mr-auto ml-auto" style="width: 313px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                        <img src="<?=$info['ProfilePicture']?>" class="card-img" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?=substr($info['Name'], 0, 14)?></h5>
                                <?php
                                    if($own == true){?>
                                        <span class="badge badge-success">Ejer</span>
                                <?php
                                    }
                                ?>
                                
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