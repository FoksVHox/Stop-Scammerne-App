<?php



class Teams{
    use Singleton;
    public function newTeam($owner)
    {

        

    }

    public function getTeamData($id)
    {

        # code...

    }

    public function getTeamCount()
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Teams');
        $stmt->execute();
        return $stmt->rowCount();
    }
    
    public function GetTeams()
    {
        $steamid = User::i()->getSteamID();
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Teams WHERE owner = :n');
        $stmt->bindParam(':n', $steamid);
        $stmt->execute();
        return $stmt->fetchAll();
    }


}