<?php
// This file defines our used traits and autoloading for our classes, and should be included in all other PHP files in the project.

// Singleton trait for classes. Read here for more info on Singleton patterns in PHP https://stackoverflow.com/a/24852235
trait Singleton 
{
    private static $instance;
    
    private final function __construct() {}
    private final function __clone() {}
    private final function __wakeup() {}
    
    public final static function i()
    {
        if(!self::$instance) {
            self::$instance = new self;    
        }
        
        return self::$instance;
    }
}

// Set our timezone
date_default_timezone_set('Europe/Copenhagen');

// Register the class autoloading function
spl_autoload_register(function ($class_name) {
    include 'classes/' . strtolower($class_name) . '.php';
});

// Cookie parameters
session_set_cookie_params(
    0, // Time
    '/', // Location
    $_SERVER['HTTP_HOST'], // Domain
    1, // Secure
    1 // Httponly
);

// Create new session
if (!isset($_SESSION)) {
    session_name('SXAPP_SESSION');
    session_start();
}

// If app is in development, echo all errors
if (Config::i()->isDevelopment()) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

## Make custom tables

// Make Scam_Report table
SQL::i()->MakeTable('create table if not exists Scam_Report
(
	ID int auto_increment,
	ReporterID varchar(255) not null,
	ScammerID VARCHAR(255) not null,
	Reason TEXT not null,
	Proff TEXT not null,
	created datetime default current_timestamp null,
	constraint Scam_Report_pk
		primary key (ID),
	constraint Scam_Report_Users_SteamID_fk
		foreign key (ReporterID) references Users (SteamID)
);');

// Make Scam_old_report table
SQL::i()->MakeTable('create table if not exists Scam_old_report
(
	ID int auto_increment,
	OldID int not null,
	ReporterID varchar(255) not null,
	ScammerID VARCHAR(255) not null,
	Reason TEXT not null,
	Proff TEXT not null,
	Status VARCHAR(255) not null,
	created datetime default current_timestamp null,
	constraint Scam_old_report_pk
		primary key (ID),
	constraint Scam_old_report_Users_SteamID_fk
		foreign key (ReporterID) references Users (SteamID)
);');

// Make Scam_Blacklist table
SQL::i()->MakeTable('create table if not exists Scam_Blacklist
(
	ID int auto_increment,
	ReporterID varchar(255) null,
	ScammerID varchar(255) null,
	Reason TEXT null,
	Proff text null,
	Authenticater varchar(255) null,
	Created timestamp default current_timestamp null,
	Nick varchar(255) not null,
	constraint Scam_Blacklist_pk
		primary key (ID),
	constraint Scam_Blacklist_Users__SteamID_fk
		foreign key ( ReporterID) references Users (SteamID),
	constraint Scam_Blacklist_Users__SteamID_fk_2
		foreign key (Authenticater) references Users (SteamID)
);');

SQL::i()->MakeTable('create table if not exists User_Settings
(
	ID int auto_increment,
	UserID varchar(255) null,
	Setting varchar(255) null,
	Active int default true null,
	Updated timestamp default current_timestamp null,
	Created timestamp default current_timestamp null,
	constraint User_Setting_pk
		primary key (ID),
	constraint User_Setting_Users_SteamID_fk
		foreign key (UserID) references Users (SteamID)
);');

SQL::i()->MakeTable('create table if not exists Logs
(
	ID int auto_increment,
	User varchar(255) null,
	Type varchar(255) not null,
	Changes text not null,
	Date timestamp default current_timestamp null,
	constraint Logs_pk
		primary key (ID),
	constraint Logs_Users_SteamID_fk
		foreign key (user) references Users (SteamID)
);');

SQL::i()->MakeTable('create table if not exists User_Notification
(
	ID int auto_increment,
	NotificationID int not null,
	UserID VARCHAR(255) not null,
	`Read` int default 0 not null,
	Title VARCHAR(255) not null,
	Type varchar(255) not null,
	Body text not null,
	constraint User_Notification_pk
		primary key (ID),
	constraint User_Notification_Users_SteamID_fk
		foreign key (UserID) references Users (SteamID)
);');

// Settings for the Jobs
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Jobs', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Job comment', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Job applicants', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New budget', true);

// Settings for the market place
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Items', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Item comment', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Item Purchase', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Item Update', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Item Deactivated', true);

// Settings for blacklist
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Blacklist', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New get blacklist', true);
// Settings::i()->newSetting(User::i()->getSteamID(), 'New Scammer Online', true);

//print_r(Settings::i()->getSettings());
//	SQL::i()->MakeTable('TRUNCATE TABLE User_Notification;');