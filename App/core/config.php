<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    // Database configuration
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'trade_track');

    // URL configuration
    define('images', 'http://localhost/TradeTrack/Public/images');
}
else
{
    
}