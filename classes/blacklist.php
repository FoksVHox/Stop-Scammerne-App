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
        $stmt = SQL::i()->prepare('INSERT INTO Scam_Report(ReporterID, ScammerID, Reason, Proff) VALUES (:re, :scam, :reason, :proff)');
        $stmt->bindParam(':re', $Reporter);
        $stmt->bindParam(':scam', $ScamID);
        $stmt->bindParam(':reason', $Reason);
        $stmt->bindParam(':proff', $Proof);
        $stmt->execute();
    }

    public function BlacklistConfirm($ScamID, $Auth)
    {
        // TODO BlacklistConfirm()        
    }

    public function getBlacklisted()
    {
        // TODO getBlacklisted()
    }
}

// https://i.imgur.com/UAMni86.png