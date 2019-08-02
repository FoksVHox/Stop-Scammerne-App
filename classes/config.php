<?php
// This is our config class. This file contains the SQL passwords and API keys and the version of the app. 
// You can add other things as needed here as well. Make sure to update the details inside of here, if you update the apps keys/passwords, or are just cloning from git yourself.
class Config
{
    use Singleton;

    /* MYSQL CONNECTION */
    private static $SQL = [
        'user' => 'sxtdbu_stopscammerne',
        'pass' => '08a7bad9daf609f9',
        'default_database' => 'sxtdb_stopscammerne',
    ];

    // App version. Remember to change this when you update your app, to not have caching of your assets be messed up.
    private $Version = '1.0';
    // Is the app in development?
    private static $InDevelopment = true;

    // Stavox API key
    private static $SxApiKey = '344662e76a00aa9536637b947efd2a8729054927cdb539ae2147686f77758d4a62acf0a5438c5c89349ff5b78b37e7f796096cc15315ae2febe970b484ee3812';

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
}
