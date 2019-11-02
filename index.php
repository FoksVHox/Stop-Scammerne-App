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



// Check if there is a new profile picture to a player

Steam::i()->CheckPicture(User::i()->getSteamID())

?>



<div class="text-center">

    <h1 class="frontside-font">Velkommen til <?=Config::i()->getAppName()?></h1>    
</div>
<div>
<div class="container mt-3">
    <div class="container-fluid">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <img src="https://i.imgur.com/QKGAilq.jpg" class="d-block w-100" alt="..." width="500" height="600">
                    </div>
                    <div class="carousel-item">
                    <img src="assets/img/pic2.jpg" class="d-block w-100" alt="..." width="500" height="600">
                    </div>
                    <div class="carousel-item">
                    <img src="assets/img/pic3.jpg" class="d-block w-100" alt="..." width="500" height="600">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
</div>


</div>
<div class="container mt-3">
    <div class="container-fluid">
        <div class="row">

            <div class="card ml-auto mb-3 mr-auto" style="width: 21rem;">
                <img src="assets/img/nophoto.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card ml-auto mb-3 mr-auto" style="width: 21rem;">
                <img src="assets/img/nophoto.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card ml-auto mb-3 mr-auto" style="width: 21rem;">
                <img src="assets/img/nophoto.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card ml-auto mb-3 mr-auto" style="width: 21rem;">
                <img src="assets/img/nophoto.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card ml-auto mb-3 mr-auto" style="width: 21rem;">
                <img src="assets/img/nophoto.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            <div class="card ml-auto mb-3 mr-auto" style="width: 21rem;">
                <img src="assets/img/nophoto.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
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