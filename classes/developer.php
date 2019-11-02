<?php

class Developer{
    use Singleton;

    public function addDeveloper($dev)
    {
        $stmt = SQL::i()->conn()->prepare('UPDATE Users SET Status = 1 WHERE SteamID = :n');
        $stmt->bindParam(':n', $dev);
        $stmt->execute();
    }

    public function GetRequestInfo($id)
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Requests WHERE id = :n');
        $stmt->bindParam(':n', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function GetRequests()
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Requests');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function DeleteRequest($steamid)
    {
        $stmt = SQL::i()->conn()->prepare('DELETE FROM Dev_Requests WHERE User = :n');
        $stmt->bindParam(':n', $steamid);
        $stmt->execute();
    }

    public function GetDevelopers()
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Users WHERE Status >= 1');
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function GetRequestCount()
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Requests');
        $stmt->execute();
        return $stmt->rowCount();
    }
}