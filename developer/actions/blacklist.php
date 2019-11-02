<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once '../__init.php';

// Handle user sign-in
User::i()->login();

if (isset($_POST['ScamID']) || isset($_POST['Proff']) || isset($_POST['Reason']) ){
        
    if(Blacklist::i()->BlacklistRequest($_POST['ScamID'], User::i()->getSteamID(), $_POST['Reason'], $_POST['Proff'])){
        header('Location: ../blacklist.php?call=success');
    } else {
        header('Location: ../blacklist.php?call=error');
    }

} else {
    header('Location: ../blacklist.php?call=Posterror');
}

