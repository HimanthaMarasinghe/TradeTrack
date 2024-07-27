<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    // Database configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'trade_track');

    // URL configuration
    define('ROOT', 'http://localhost/TradeTrack/Public');
}
else
{
    
}

define ('DEBUG', true); // set to false when in production, so that no error messages will be shown