<?php
// This class contains all the functions for blacklisting

## HOW EVERY CLAS SHOULD BE BUILDT
// - Every get function should be get<functionname> Ex. getProducts()
// - tbd

class Blacklist
{
    use Singleton;

    public function BlacklistRequest($scam,$reporter,$reason)
    {
        $res = SxApi::i()->getPlayerDataFromSteamID($scam);
        print_r($res);
    }

    public function BlacklistConfirm()
    {
        // TODO BlacklistConfirm()        
    }

    public function getBlacklisted()
    {
        // TODO getBlacklisted()
    }
}

// https://i.imgur.com/UAMni86.png