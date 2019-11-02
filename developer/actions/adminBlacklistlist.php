<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once '../__init.php';

// Handle user sign-in
User::i()->login();

// Admin Panel

if(isset($_POST['Accept']) && $_GET['id']){
    $id = $_GET['id'];
    $reason = $_POST['Accept'];
    $case = Blacklist::i()->getRequestbyID($id);
    Blacklist::i()->BlacklistConfirm($case['ScammerID'], User::i()->getSteamID(), $reason);
}