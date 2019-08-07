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

<div class="container">
    <div class="container-fluid">
        <?=Layout::i()->AdminNav();?>

        <table class="table table-striped mt-5">
            <thead class="thead-dark">
                <tr>
                    <th scope="col" style="width: 20%;">#</th>
                    <th scope="col" style="width: 20%;">Reporter</th>
                    <th scope="col" style="width: 20%;">Scammer</th>
                    <th scope="col" style="width: 20%;">Tid</th>
                    <th scope="col" style="width: 20%;">Handling</th>
                </tr>
            </thead>
            <tbody>
            <?php
            
                $res = [];
                $res = Blacklist::i()->getAwaiting();

                if($res > 0){
                    foreach($res as $k => $v){
                        echo '            
                        <tr>
                            <td>'.$res[$k][0].'</td>
                            <td>'.User::i()->getUserData($res[$k]['ReporterID'])['Name'].'</td>
                            <td>'.User::i()->getUserData($res[$k]['ScammerID'])['Name'].'</td>
                            <td>'.$res[$k][5].'</td>
                            <td> <a href="blacklistinfo.php?id='.$v['ID'].'" class="btn btn-sm btn-success">Se mere</a></td>
                        </tr>';
                    }
                } else {
                    echo '
                    <tr>
                        <td colspan="4">Der er ingen blacklist anmodninger</td>
                    </tr>';
                }

            ?>

            </tbody>
        </table>

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