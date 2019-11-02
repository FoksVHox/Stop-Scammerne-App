<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require_once '../__init.php';

// Handle user sign-in
User::i()->login();

// Settings for Marketplace and the jobs

