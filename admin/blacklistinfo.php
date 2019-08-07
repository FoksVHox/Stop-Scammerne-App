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

if(!isset($_GET['id'])){
    header('Location: blacklist.php');
}
$id = $_GET['id'];
$res = Blacklist::i()->getRequestbyID($id);
$reqNum = $res['ID']
?>

<div class="container">
    <div class="container-fluid">
        <?=Layout::i()->AdminNav();?>

        <h1 class="display-4 text-center mt-3 mb-3"> Blacklist Request #<?=$id?></h1>

        <div class="row">
            <div class="col-md-9">
                <div class="card responsive mb-3">
                    <div class="card-body" style="background-color: #f6f6f6;">

                        <strong>Anmelderens navn: </strong><?=User::i()->getUserData($res['ReporterID'])['Name']?> <br>
                        <strong>Anmelderens SteamID: </strong><?=$res['ReporterID']?>
                            <br>
                            <br>
                        <strong>Scammerens navn: </strong><?=User::i()->getUserData($res['ScammerID'])['Name']?> <br>
                        <strong>Scammerens SteamID: </strong><?=$res['ScammerID']?>
                            <br>
                            <br>
                        <strong>Forklaring: </strong>
                        <?=nl2br($res['Reason'])?>
                            <br>
                            <br>
                        <strong>Beviser: </strong>
                        <?=nl2br($res['Proff'])?>

                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card responsive mb-3">
                    <div class="card-header">
                        Handlinger
                    </div>
                    <div class="card-body">
                        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#AcceptModal">Accepter</button>
                        <button class="btn btn-danger btn-block" data-toggle="modal" data-target="#RemoveModal">Afvis</button>
                        <button class="btn btn-info btn-block" data-toggle="modal" data-target="#InfoReportModal">Infomation om anmelder</button>
                        <button class="btn btn-info btn-block" data-toggle="modal" data-target="#InfoScamModal">Infomation om scammer</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="AcceptModal" tabindex="-1" role="dialog" aria-labelledby="AcceptModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="AcceptModalLabel">Accepter Blacklist Request #<?=$reqNum?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../actions/adminBlacklist.php?id=<?=$reqNum?>" method="post">
            <div class="form-group">
                <input type="text" name="Accept" class="form-control" placeholder="Skriv grund til blacklist">
            </div>
            <button type="submit" class="btn btn-success btn-block">Accepter</button>
        </form>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="RemoveModal" tabindex="-1" role="dialog" aria-labelledby="RemoveModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RemoveModalLabel">Afvis Blacklist Request #<?=$reqNum?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="../actions/adminBlacklist.php" method="post">
            <div class="form-group">
                <input type="text" name="Remove" class="form-control" placeholder="Skriv grund til afvising">
            </div>
            <button type="button" class="btn btn-danger btn-block">Afvis</button>
        </form>
      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="InfoReportModal" tabindex="-1" role="dialog" aria-labelledby="InfoReportModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InfoReportModalLabel">Information omkring <?=$Reporter?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>

    </div>
  </div>
</div>

<div class="modal fade" id="InfoScamModal" tabindex="-1" role="dialog" aria-labelledby="InfoScamModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="InfoScamModalLabel">Information omkring <?=$Scammer?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

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