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
    if(Blacklist::i()->BlacklistConfirm($case['ScammerID'], User::i()->getSteamID(), $reason)){
        header('Location: /admin/blacklist.php?success=true');
    }elseif(!isset($id)){
        header('Location: /admin/blacklist.php?err=noID');
    }elseif(!isset($reason)){
        header('Location: /admin/blacklist.php?err=noReason');
    }elseif(!isset($case['ScammerID'])){
        header('Location: /admin/blacklist.php?err=noScamID');
    }
    print_r($case);
    //header('Location: /admin/blacklist.php?success=false');
} elseif(isset($_POST['Deny']) && $_GET['id']){
    $id = $_GET['id'];
    $reason = $_POST['Deny'];
    $case = Blacklist::i()->getRequestbyID($id);
    if(Blacklist::i()->BlacklistDeny($case['ScammerID'], User::i()->getSteamID(), $reason)){
        header('Location: /admin/blacklist.php?success=true');
    }elseif(!isset($id)){
        header('Location: /admin/blacklist.php?err=noID');
    }elseif(!isset($reason)){
        header('Location: /admin/blacklist.php?err=noReason');
    }elseif(!isset($case['ScammerID'])){
        header('Location: /admin/blacklist.php?err=noScamID');
    }
} else {
    header('Location: /admin/blacklist.php?err=NoIDSet');
}