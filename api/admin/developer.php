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
        
        <div class="row mt-5">

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header display-4 text-center" style="font-size: 1.4em;">Aktive udviklere</div>
                    <div class="card-body">
                        <p class="card-text text-center display-4" id="value" style="font-size: 1.4em;"></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header display-4 text-center" style="font-size: 1.4em;">Antal foresprøgelser</div>
                    <div class="card-body">
                        <p class="card-text text-center display-4" id="value1" style="font-size: 1.4em;"></p>
                    </div>
                </div>
            </div>

        </div>

        <hr>

        <div class="row">
        
            <?php
                $reqeusts = Developer::i()->GetRequests();
                foreach ($reqeusts as $k => $v) { 
                
                $res = User::i()->getUserData($v['User']);
                $name = $res['Name'];
                $picture = $res['ProfilePicture']
            ?>
                    <div class="card mb-3 mr-auto ml-auto" style="width: 313px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                            <img src="<?=$picture?>" class="card-img" style="height: 100%; width:auto;" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"><?=substr($name, 0, 14)?></h5>
                                    <a href="view.dev.php?id=<?=$v['id']?>" class="btn btn-dark btn-block">Se ansøgning</a>
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
let userCount = <?=Developer::i()->GetDevelopers()?>;
let productCount = <?php echo Developer::i()->GetRequestCount(); ?>;
animateValue("value", 0, userCount, 1000);
animateValue("value1", 0, productCount, 1000);

</script>

<?php
// Echo our footer and scripts
Layout::i()->footer();
?>

<!-- Adding the Config::i()->getVersion() thing makes caching way easier to deal with. In development mode, the version will be a randomized string on each visit, to completely bypass the cache -->
<script src="/assets/js/index.js?v=<?=Config::i()->getVersion()?>"></script>

<!-- Remember to close the body again! -->
</body>