<?php
// This class contains all the functions for blacklisting

## HOW EVERY CLAS SHOULD BE BUILDT
// - Every get function should be get<functionname> Ex. getProducts()
// - tbd

class Blacklist
{
    use Singleton;

    public function BlacklistRequest($ScamID,$Reporter,$Reason, $Proof)
    {
        $res = SxApi::i()->getPlayerDataFromSteamID($ScamID);
        if(!$res['success']){
            return 'Error';
        }
        $stmt = SQL::i()->conn()->prepare('INSERT INTO Scam_Report(ReporterID, ScammerID, Reason, Proff) VALUES (:re, :scam, :reason, :proff)');
        $stmt->bindParam(':re', $Reporter);
        $stmt->bindParam(':scam', $ScamID);
        $stmt->bindParam(':reason', $Reason);
        $stmt->bindParam(':proff', $Proof);
        return $stmt->execute();
    }

    public function BlacklistConfirm($ScamID, $Auth)
    {
        $res = User::i()->getUserData($Auth);
        if($res['Status'] == 1){

            // Find the entry
            $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Report WHERE ID = :id');
            $stmt->bindParam(':id', $Auth);
            $stmt->execute();
            $res = $stmt->fetch();

            // Delete entry
            $stmt = SQL::i()->conn()->prepare('DELETE FROM Scam_Report WHERE ID = :id');
            $stmt->bindParam(':id', $Auth);
            if(!$stmt->execute() == true){
                return false;
            }

            // Add entry to the blacklist table
            $stmt = SQL::i()->conn()->prepare('INSERT INTO Scam_Blacklist(ReporterID, ScammerID, Reason, Proff, Authenticater) VALUES (:report, :scamid, :reason, :proff, :auth)');
            $stmt->bindParam(':report', $res['ReporterID']);
            $stmt->bindParam(':scamid', $res['ScammerID']);
            $stmt->bindParam(':reason', $res['Reason']);
            $stmt->bindParam(':proff', $res['Proff']);
            $stmt->bindParam(':auth', $Auth);
            if($stmt->execute()){
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    public function getBlacklisted()
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Blacklist');
        if($stmt->execute()){
            return $stmt->fetchAll();
        } else {
            return 'Error';
        }
    }

    public function getAwaiting()
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Report');
        if($stmt->execute()){
            return $stmt->fetchAll();
        } else {
            return 'Error';
        }
    }

    
}

// https://i.imgur.com/UAMni86.png