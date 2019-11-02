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
                            <a href="dashboard.php?id=<?=$v['id']?>" class="btn btn-dark btn-block">Se information</a>
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
    $id = $_GET['id'];
    $res = Teams::i()->getTeamData($id);
?>

<div class="container">
    <div class="container-fluid">
        <h1 class="display-4 text-center"><?=$res['name']?></h1>
            <hr>
            <?=Layout::i()->DeveloperNav($id)?>
        <br>

        <div class="row mt-1">

            <div class="col-sm-4">
                <div class="card">
                    <h1 class="display-4 text-center mt-3" style="font-size: 1.5em;">Antal produkter</h1>
                    <hr>
                    <div class="card-body">
                        <p class="card-text text-center display-4" id="value1" style="font-size: 1.4em;"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <h1 class="display-4 text-center mt-3" style="font-size: 1.5em;">Antal salg</h1>
                    <hr>
                    <div class="card-body">
                        <p class="card-text text-center display-4" id="value2" style="font-size: 1.4em;"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="card">
                    <h1 class="display-4 text-center mt-3" style="font-size: 1.5em;">Total indkomst</h1>
                    <hr>
                    <div class="card-body">
                        <p class="card-text text-center display-4" id="value3" style="font-size: 1.4em;"></p>
                    </div>
                </div>
            </div>

        </div>

        </div>
    </div>
</div>

<?php
}
// Echo our footer and scripts
Layout::i()->footer();
?>

<!-- Adding the Config::i()->getVersion() thing makes caching way easier to deal with. In development mode, the version will be a randomized string on each visit, to completely bypass the cache -->
<script src="/assets/js/index.js?v=<?=Config::i()->getVersion()?>"></script>
<script>
function animateValue(id, start, end, duration) {
    // assumes integer values for start and end

    let obj = document.getElementById(id);
    let range = end - start;
    // no timer shorter than 50ms (not really visible any way)
    let minTimer = 50;
    // calc step time to show all interediate values
    let stepTime = Math.abs(Math.floor(duration / range));

    // never go below minTimer
    stepTime = Math.max(stepTime, minTimer);

    // get current time and calculate desired end time
    let startTime = new Date().getTime();
    let endTime = startTime + duration;
    let timer;

    function run() {
        let now = new Date().getTime();
        let remaining = Math.max((endTime - now) / duration, 0);
        let value = Math.round(end - (remaining * range));
        obj.innerHTML = value;
        if (value == end) {
            clearInterval(timer);
        }
    }

    timer = setInterval(run, stepTime);
    run();
}

let productCount = <?=Teams::i()->GetProductsCount($id)?>;
let salesCount = <?= Teams::i()->GetSalesCount($id); ?>;
let incomeCount = <?= Teams::i()->GetIncome($id) ?>;
animateValue("value1", 0, productCount, 1000);
animateValue("value2", 0, salesCount, 1000);
animateValue("value3", 0, incomeCount, 1000);

</script>


<!-- Remember to close the body again! -->
</body>