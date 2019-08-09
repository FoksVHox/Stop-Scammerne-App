<?php

class Team{
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

}