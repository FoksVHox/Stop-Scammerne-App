<?php

class Settings
{
    use Singleton;

    // TODO Make checks if UserID is a player in SxDB

    private static $SetDefaultSettings = true;
    private static $ServerSettings = array(
        'New Jobs', 
        'New Job comment', 
        'New Job applicants', 
        'New budget', 
        'New Items', 
        'New Item comment',
        'New Item Purchase',
        'New Item Update',
        'New Item Deactivated',
        'New Blacklist',
        'New get blacklist',
        'New Scammer Online');


    // Make a new setting to a player for the spicefic setting
    public function newSetting($User, $Setting, $Active = 1)
    {
        // Check if user has this setting already
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM User_Settings WHERE UserID = :id AND Setting = :set');
        $stmt->bindParam(':id', $User);
        $stmt->bindParam(':set', $Setting);
        $stmt->execute();

        if($stmt->rowCount() == 0){
            // Check if the Active is a bool, so we can convert to a number
            if($Active === true){
                $Active = 1;
            } elseif($Active === false) {
                $Active = 0;
            }


            // Make new setting entry in no setting were found
            $stmt = SQL::i()->conn()->prepare('INSERT INTO User_Settings(UserID, Setting, Active) VALUES (:id, :set, :active)');
            $stmt->bindParam(':id', $User);
            $stmt->bindParam(':set', $Setting);
            $stmt->bindParam(':active', $Active);
            $stmt->execute();
        }
    }

    // Updates a setting
    public function updateSetting($User, $Setting, $Active)
    {
        // Check if the Active is a bool, so we can convert to a number
        if($Active === true){
            $Active = 1;
        } elseif($Active === false) {
            $Active = 0;
        }
        
        $stmt = SQL::i()->conn()->prepare('UPDATE User_Settings SET Active = :active, Updated = NOW() WHERE Setting = :set AND UserID = :id');
        $stmt->bindParam(':active', $Active);
        $stmt->bindParam(':set', $Setting);
        $stmt->bindParam(':id', $User);
        
        return $stmt->execute();
    }

    public function getSettings($Setting, $User)
    {
        $stmt = SQL::i()->conn()->prepare('SELECT Active FROM User_Settings WHERE Setting = :setting AND UserID = :id');
        $stmt->bindParam(':setting', $Setting);
        $stmt->bindParam(':id', $User);
        $stmt->execute();
        $res = $stmt->fetch();

        // Convert into HTML
        if($res['Active'] == 1){
            return 'checked';
        }

        //return $res;
    }

}