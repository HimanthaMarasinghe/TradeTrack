<?php

if($_SERVER['SERVER_NAME'] == 'localhost')
{
    // Database configuration
    // define('DB_HOST', 'localhost');
    // define('DB_USER', 'root');
    // define('DB_PASS', '');
    // define('DB_NAME', 'trade_track');

    $env = parse_ini_file(__DIR__ . '/.env');

    define('DB_HOST', $env['DB_HOST']);
    define('DB_USER', $env['DB_USER']);
    define('DB_PASS', $env['DB_PASS']);
    define('DB_NAME', $env['DB_NAME']);

    // URL configuration
    define('ROOT', 'http://localhost/TradeTrack/Public');
    define('LINKROOT', 'http://localhost/TradeTrack');
}
else
{
    define('DB_HOST', getenv('DB_HOST'));
    define('DB_USER', getenv('DB_USER'));
    define('DB_PASS', getenv('DB_PASS'));
    define('DB_NAME', getenv('DB_NAME'));

    define('ROOT', 'https://tradetrack.alwaysdata.net/Public');
    define('LINKROOT', 'https://tradetrack.alwaysdata.net');
    
}
date_default_timezone_set('Asia/Colombo'); 
define ('DEBUG', true); // set to false when in production, so that no error messages will be shown