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
if($accept == true){
    echo $accept;
} elseif($accept == false) {
    echo 'bye';
}