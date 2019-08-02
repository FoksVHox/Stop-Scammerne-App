<?php
// This is our config class. This file contains the SQL passwords and API keys and the version of the app. 
// You can add other things as needed here as well. Make sure to update the details inside of here, if you update the apps keys/passwords, or are just cloning from git yourself.
class Config
{
    use Singleton;

    /* MYSQL CONNECTION */
    private static $SQL = [
        'user' => 'sxtdbu_stopscammerne',
        'pass' => '5fb77437766bc66c',
        'default_database' => 'sxtdb_stopscammerne',
    ];

    // App version. Remember to change this when you update your app, to not have caching of your assets be messed up.
    private static $Version = '1.0.1';
    // Is the app in development?
    private static $InDevelopment = true;

    // Stavox API key
    private static $SxApiKey = '633382e4d72f10c3b50cfb5c3bb2762bdb958b2bf1518bfdc9558f36f0d096e97009675ef5fe13534f2494c15aeb0d48c21cda257697f5e0313f0965a487ca0e';

    // Everything below is simply some functions to get the data out from this file

    public function getSQL()
    {
        return self::$SQL;
    }

    public function getSXApiKey()
    {
        return self::$SxApiKey;
    }

    public function getVersion()
    {
        if (self::$InDevelopment) {
            $this->Version = bin2hex(random_bytes(8));
        }

        return $this->Version;
    }

    public function isDevelopment()
    {
        return self::$InDevelopment;
    }

    public function getRealVer()
    {
        return self::$Version;
    }
}
