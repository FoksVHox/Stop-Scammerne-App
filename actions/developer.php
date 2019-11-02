<?php
require '../__init.php';

User::i()->login();

if(isset($_POST['developer'])){
    $reason = $_POST['reason'];
    if(empty($reason)){
        return ;
    }

    Developer::i()->Request($reason);
    
    header('Location: /');
}

$accept = $_POST['accept'];
$steamid = $_POST['steamid'];
if($accept == true){
    Developer::i()->addDeveloper($steamid);
    Misc::i()->addToLog(User::i()->getSteamID(), 'Developer acceptence', User::i()->getName(User::i()->getSteamID()).' accepted '.$steamid.' for developer');
    Developer::i()->DeleteRequest($steamid);
    Notification::i()->SendNotification($steamid, 'Tillykke med din Developer rank!', 'Vi har valgt at acceptere dig som udviker!', 'Success');
} elseif($accept == false) {
    Developer::i()->DeleteRequest($steamid);
    Misc::i()->addToLog(User::i()->getSteamID(), 'Developer denail', User::i()->getName(User::i()->getSteamID()).' denied '.$steamid.' for developer');
    Notification::i()->SendNotification($steamid, 'Du blev ikke udviker i denne omgang!', 'Vi har valgt at afvise dig, bedre held næste gang.', 'Danger');
}

