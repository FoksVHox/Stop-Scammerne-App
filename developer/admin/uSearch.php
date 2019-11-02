<?php
require_once '../__init.php';
$term = $_POST['term'];

if(!Steam::i()->isSteamID($term)){
    $term = '%'.$term.'%';
}


$output = '';
if(isset($term) && !empty($term)){
    $stmt = SQL::i()->conn()->prepare("SELECT * FROM Users WHERE SteamID LIKE :t OR Name LIKE :t");
    $stmt->bindParam(':t', $term);
    $stmt->execute();
    $res = $stmt->fetchAll();

    if($res > 1){
        foreach($res as $k => $v){
            $output .='
            <div class="card mb-3 mr-auto ml-auto" onclick="window.location.href=`../profile.php?id='.$v['SteamID'].'`" style="width: 313px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                <img src="'.$v['ProfilePicture'].'" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">'.substr($v['Name'], 0, 12).'</h5>
                        
                    </div>
                </div>
            </div>
        </div>
            ';
        }
    } else {

    }
}

echo $output;
