<?php
    require_once '../__init.php';
    $w = $_POST['width'];
    $h = $_POST['height'];
    $steam = User::i()->getSteamID();


    if(!isset($_SESSION['SizeLog'])){

        SQL::i()->MakeTable('create table if not exists User_ScreenSize
        (
            SteamID varchar(255) null,
            Width int not null,
            Height int not null,
            Date timestamp default current_timestamp not null
        );');

        $stmt = SQL::i()->conn()->prepare('INSERT INTO User_ScreenSize(SteamID, Width, Height) VALUES (:s, :w, :h)');
        $stmt->bindParam(':s', $steam);
        $stmt->bindParam(':w', $w);
        $stmt->bindParam(':h', $h);
        
        if(!$stmt->execute()){
            echo 'Error';
            return;
        }

        $_SESSION['SizeLog'] = true;
        echo 'Success';
    }
    
?>