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
            return [];
        }

        $stmt = SQL::i()->conn()->prepare('INSERT INTO Scam_Report(ReporterID, ScammerID, Reason, Proff) VALUES (:re, :scam, :reason, :proff)');
        $stmt->bindParam(':re', $Reporter);
        $stmt->bindParam(':scam', $ScamID);
        $stmt->bindParam(':reason', $Reason);
        $stmt->bindParam(':proff', $Proof);
        Misc::i()->addToLog($Reporter, 'Blacklist Request', 'Requested a blacklist on '.$ScamID);
        return $stmt->execute();
    }

    public function BlacklistConfirm($ScamID, $Auth, $AReason)
    {
        $res = User::i()->getUserData($Auth);
        if($res['Status'] >= 2){

            // Find the entry
            $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Report WHERE ScammerID = :id');
            $stmt->bindParam(':id', $ScamID);
            $stmt->execute();
            $res = $stmt->fetch();

            $confirm = 'Confirmed';

            // Delete entry
            $stmt = SQL::i()->conn()->prepare('INSERT INTO Scam_old_report(OldID, ReporterID, ScammerID, Reason, Proff,Status, created) VALUES (:id, :rID, :sID, :reason, :proff, :status, :date)');
            $stmt->bindParam(':id', $res['ID']);
            $stmt->bindParam(':rID', $res['ReporterID']);
            $stmt->bindParam(':sID', $res['ScammerID']);
            $stmt->bindParam(':reason', $res['Reason']);
            $stmt->bindParam(':proff', $res['Proff']);
            $stmt->bindParam(':status', $confirm);
            $stmt->bindParam(':date', $res['created']);
            $stmt->execute();

            // Fully delete the entry
            $stmt = SQL::i()->conn()->prepare('DELETE FROM Scam_Report WHERE ID = :r');
            $stmt->bindParam(':r', $res['ID']);
            $stmt->execute();

            // Add entry to the blacklist table
            $stmt = SQL::i()->conn()->prepare('INSERT INTO Scam_Blacklist(ReporterID, ScammerID, Reason, Proff, Authenticater, Nick) VALUES (:report, :scamid, :reason, :proff, :auth, :nick)');
            $stmt->bindParam(':report', $res['ReporterID']);
            $stmt->bindParam(':scamid', $res['ScammerID']);
            $stmt->bindParam(':reason', $AReason);
            $stmt->bindParam(':proff', $res['Proff']);
            $stmt->bindParam(':auth', $Auth);
            $stmt->bindParam(':nick', User::i()->getUserData($res['ScammerID'])['Name'] );
            if($stmt->execute()){
                Misc::i()->addToLog($Auth, 'Blacklist Confirm', User::i()->getName().' confirmed Blacklist Request #'.$res['ID']);
                Notification::i()->SendNotification($res['ReporterID'],'Blacklist Request #'.$res['ID'], 
                'Hej, '.User::i()->getUserData($res['ReporterID'])['Name'].'
                Vi er meget glade for at medele at din blacklist Request (#'.$res['ID'].') er blevet godkendt! Vi har tilføjet '.User::i()->getUserData($res['ScammerID'])['Name'].' til blacklisten! 
                - Stop Scammerne', 'Success' );
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }

    public function BlacklistDeny($ScamID, $Auth, $AReason)
    {
        $res = User::i()->getUserData($Auth);
        if($res['Status'] >= 1){

            // Find the entry
            $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Report WHERE ScammerID = :id');
            $stmt->bindParam(':id', $ScamID);
            $stmt->execute();
            $res = $stmt->fetch();

            $confirm = 'Confirmed';

            // Delete entry
            $stmt = SQL::i()->conn()->prepare('INSERT INTO Scam_old_report(OldID, ReporterID, ScammerID, Reason, Proff,Status, created) VALUES (:id, :rID, :sID, :reason, :proff, :status, :date)');
            $stmt->bindParam(':id', $res['ID']);
            $stmt->bindParam(':rID', $res['ReporterID']);
            $stmt->bindParam(':sID', $res['ScammerID']);
            $stmt->bindParam(':reason', $res['Reason']);
            $stmt->bindParam(':proff', $res['Proff']);
            $stmt->bindParam(':status', $confirm);
            $stmt->bindParam(':date', $res['created']);
            $stmt->execute();

            // Fully delete the entry
            $stmt = SQL::i()->conn()->prepare('DELETE FROM Scam_Report WHERE ID = :r');
            $stmt->bindParam(':r', $res['ID']);
            if($stmt->execute()){
                Misc::i()->addToLog($Auth, 'Blacklist Denial', User::i()->getName().' decline Blacklist Request #'.$res['ID']);
                
                // Notifi the user
                Notification::i()->SendNotification($res['ReporterID'],'Blacklist Request #'.$res['ID'], 
                'Hej, '.User::i()->getUserData($res['ReporterID'])['Name'].'
               Vi kan medele, at din blacklist Request ('.$res['ID'].') er blevet afvist med grunden: '.$AReason.'
                - Stop Scammerne', 'Danger' );
                return true;
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

    public function getRequestbyID($id)
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Scam_Report WHERE ID = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

}

// https://i.imgur.com/UAMni86.png

// Blacklist thingy 

// https://i.imgur.com/qNPEgWr.png