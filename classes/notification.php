<?php
// This class contains all the things that don't really fit into other classes, but we still need to be accessible from everywhere
class Notification
{
    use Singleton;

    public function SendNotification($User, $title, $body, $type)
    {
        if(User::i()->getUserData($User)['success'] === false){
            return 'No user';
        }
        $Notification = SxApi::i()->sendNotification($User, $title, $body);
        if($Notification['success'] == true){
            $NotificationID = $Notification['id']; 
            $stmt = SQL::i()->conn()->prepare('INSERT INTO User_Notification(NotificationID, UserID, Title, Type, Body) VALUES (:NotificationID, :UserID, :Title, :Type, :Body)');
            $stmt->bindParam(':NotificationID', $NotificationID);
            $stmt->bindParam(':UserID', $User);
            $stmt->bindParam(':Title', $title);
            $stmt->bindParam(':Type', $type);
            $stmt->bindParam(':Body', $body);
            $stmt->execute();

            Misc::i()->addToLog('STEAM_0:0:00000000', 'Notification - '.$title, User::i()->getName().' received notification #'.$NotificationID);

        } else {
            return 'Error';
        }
    }

}
