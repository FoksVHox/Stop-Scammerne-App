<?php
// This is the index/front page of your app. This is what will be shown to the user upon startup

// Requires our autoloading and classes
require_once '../__init.php';

// Handle user sign-in
User::i()->login();

// Echo the <head> into our document
Layout::i()->header();

if(!isset($_GET['id'])){
    header('Location: /');
}

?>
<body>

<?php
// Echo our navbar
Layout::i()->nav();

$reqInfo = Developer::i()->GetRequestInfo($_GET['id']);

$res = User::i()->getUserData($reqInfo['User']);
?>

<div class="container" style="margin-top: 1em;">
  <div class="card responsive mb-3">
    <div class="card-body" style="background-color: #f6f6f6;">
      <div class="row mt-3">

        <!-- Billede -->
        <div class="col-lg-2 ml-4">

            <img src="<?=$res['ProfilePicture']?>" class="rounded-circle" style="max-width: 128px; max-height: 128px;">
            <br><br>  
            <a href="#" onclick="Response(true)" class="btn btn-block btn-success">Accepter</a>
            <a href="developer.php" class="btn btn-block btn-dark">Tilbage</a>
            <a href="#" onclick="Response(false)" class="btn btn-block btn-danger">Afvis</a>
        </div>

        <div class="col-lg-9">
          <!-- Steam navn -->
          <h5 class="card-title">Brugernavn</h5>
          <input type="email" class="form-control mb-4" name="steamNameBuyer" aria-describedby="steamNamehelp" value="<?=$res['Name']?>" readonly>

          <h5 class="card-title">SteamID</h5>
          <input type="email" class="form-control mb-4" name="steamNameBuyer" aria-describedby="steamNamehelp" value="<?=$res['SteamID']?>" readonly>
            <hr>

            <h5 class="card-title">Ansøgning</h5>
            <p><?=nl2br($reqInfo['Reason'])?></p>

        </div>
      </div>

    </div>
  </div>
</div>

<script>
  function Response(res){
    console.log(res);
    if(res){
      
      $.post('../actions/developer.php',{accept: true}, data =>{
        console.log(data);
      });
    } else {
      $.post('../actions/developer.php',{accept: false}, data =>{
        console.log(data);
      });
    }
  }
</script>

<?php
// Echo our footer and scripts
Layout::i()->footer();
?>

<!-- Adding the Config::i()->getVersion() thing makes caching way easier to deal with. In development mode, the version will be a randomized string on each visit, to completely bypass the cache -->
<script src="/assets/js/index.js?v=<?=Config::i()->getVersion()?>"></script>

<!-- Remember to close the body again! -->
</body>