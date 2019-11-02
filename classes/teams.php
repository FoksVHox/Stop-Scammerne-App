<?php



class Teams{
    use Singleton;
    public function newTeam($owner)
    {

        

    }

    public function getTeamData($id)
    {

        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Teams WHERE id = :n');
        $stmt->bindParam(':n', $id);
        $stmt->execute();
        return $stmt->fetch();

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

    public function GetProducts($id)
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Products WHERE team = :n');
        $stmt->bindParam(':n', $id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function GetProductsCount($id)
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Products WHERE team = :n');
        $stmt->bindParam(':n', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function GetSalesCount($id)
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Sales WHERE team = :n');
        $stmt->bindParam(':n', $id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function GetIncome($id)
    {
        $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Sales WHERE team = :n');
        $stmt->bindParam(':n', $id);
        $stmt->execute();
        $res = $stmt->fetchAll();
        $income = 0;
        foreach ($res as $k => $v) {
            $stmt = SQL::i()->conn()->prepare('SELECT * FROM Dev_Products WHERE id = :n');
            $stmt->bindParam(':n', $v['product']);
            $stmt->execute();
            $res = $stmt->fetch();
            $income = $income + $res['price'];
        }
        return $income;
    }

}