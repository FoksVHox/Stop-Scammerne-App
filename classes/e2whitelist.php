<?php

class E2Whitelist
{
    use Singleton;

    public function getBlacklist()
    {
        $output ="";
        $url = 'https://www.e2whitelist.com/api/checkBlacklist.php';
        $data = array("API"=>"sAbf6A)37&235bSnsa7dSAS5nas53nl");
     
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
         
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) {  }
             
        //print_r($result);
        $array = unserialize(base64_decode($result));
        $output .= '
        <table>
                        <thead>
                        <tr>
                            <th>Navn</th>
                            <th>Steamid</th>
                            <th>Grund</th>
                            <th>Grad</th>
                            <th>Beviser</th>
                            <th>Dato</th>
                            <th>Admin</th>
                        </tr>
                        </thead>
                        <tbody>
        ';
        
        foreach($array as $k => $v){
            $output .= "
            <tr>
                <td>".$v["name"]."</td>
                <td>".$v["steamid"]."</td>
                <td>".$v["grund"]."</td>
                <td>".$v["grad"]."</td>
                <td>".$v["beviser"]."</td>
                <td>".$v["date"]."</td>
                <td>".$v["adminid"]."</td>
            </tr>  
            ";
        }
        $output .= "
        </tbody>
        </table>
        ";
        return $output;
    }
}