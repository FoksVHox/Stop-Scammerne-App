<?php
// This is the index/front page of your app. This is what will be shown to the user upon startup

// Requires our autoloading and classes
require_once '__init.php';

// Handle user sign-in
User::i()->login();

// Echo the <head> into our document
Layout::i()->header();

// Echo our navbar
Layout::i()->nav();
?>

<div class="text-center">
    <h1 class="display-4">Indstillinger </h1>   
</div>

<div class="container">
    <div class="container-fluid">
    
        <div class="setting mt-4">
            <hr>
            <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <h4>Handel</h4>
                    </button>
                </h2>
                </div>

                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <form action="action/settings.php" method="post">
                        
                            <strong>Jobs</strong>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" name="JobCheck1" class="custom-control-input" id="JobCheck1">
                                <label class="custom-control-label" for="JobCheck1">Modtag notifikationer ved nye jobopslag</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="JobCheck2" class="custom-control-input" id="JobCheck2">
                                <label class="custom-control-label" for="JobCheck2">Modtag notifikationer ved nye kommentar på dit job</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="JobCheck3" class="custom-control-input" id="JobCheck3">
                                <label class="custom-control-label" for="JobCheck3">Modtag notifikationer ved svar på din jobansøgning</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="JobCheck4" class="custom-control-input" id="JobCheck4">
                                <label class="custom-control-label" for="JobCheck4">Modtag notifikationer ved budgetforhanlinger</label>
                            </div>
                            <br>
                            <strong>Markedsplads</strong>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="Market1">
                                <label class="custom-control-label" for="Market1">Modtag notifikationer ved nye produkter på markedspladsen</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="Market2">
                                <label class="custom-control-label" for="Market2">Modtag notifikationer ved nye kommentar på dit produkt </label>
                            </div>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="Market3">
                                <label class="custom-control-label" for="Market3">Modtag notifikationer ved nye køb af dit produkt</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="Market4">
                                <label class="custom-control-label" for="Market4">Modtag notifikationer ved nye køb af dit produkt</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="Market5">
                                <label class="custom-control-label" for="Market5">Modtag notifikationer ved opdateringer af købte produkter</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-2">
                                <input type="checkbox" class="custom-control-input" id="Market6">
                                <label class="custom-control-label" for="Market6">Modtag notifikationer hvis et af dine købte produkter bliver deaktiveret</label>
                            </div>

                            <button type="submit" class="btn btn-success btn-block mt-4">Gem ændringer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Collapsible Group Item #2
                    </button>
                </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Collapsible Group Item #3
                    </button>
                </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
                </div>
            </div>
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