<?php
require_once '__init.php';
$term = $_POST['term'];

$output = '';
if(isset($term) && !empty($term)){
    $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Blacklist WHERE ScammerID = :t');
    $stmt->bindParam(':t', $term);
    $stmt->execute();
    $res = $stmt->fetch();

    $output = '
    <tr>
        <td>'.$res['Nick'].'</td>
        <td>'.$res['ScammerID'].'</td>
        <td>'.$res['Reason'].'</td>
        <td>'.$res['Created'].'</td>
    </tr>';
} else {
    $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Blacklist');
    $stmt->execute();
    $res = $stmt->fetchAll();

    foreach($res as $k => $v){
        $output .= '
        <tr>
            <td>'.$v['Nick'].'</td>
            <td>'.$v['ScammerID'].'</td>
            <td>'.$v['Reason'].'</td>
            <td>'.$v['Created'].'</td>
        </tr>
        ';
    }
}

echo $output;
