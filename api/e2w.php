<?php
include("../__init.php");


$url = 'https://www.e2whitelist.com/api/checkBlacklist.php';

//echo(E2Whitelist::i()->getBlacklist());

if($_POST["API"] == "nsA8sngA9f%8sS&mgSklAMdAnsqSeFXsw"){
 
    $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Blacklist');
    if($stmt->execute()){
        //$result = $stmt->fetchAll();
        $array = array();
        while($row = $stmt->fetchAll()){  
            $array[] = $row;
        }

        print_r(base64_encode(serialize($array)));
    }
}