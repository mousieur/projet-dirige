<?php

const ROUTES = [

    '/' => 'index.php',
    '/erreur' => 'error.php',
    '/create' => 'create.php',
    '/error' => 'error.php',
    '/connection' => 'connection.php',
    '/deconnection' => 'deconnection.php',
    '/cart' => 'cart.php',
    '/details' => 'details.php',
    '/updateCart' => 'updateCart.php',
    '/payCart' => 'payCart.php',
    '/inventory' => 'inventory.php',
    '/playerDetails' => 'playerDetails.php',
    '/enigma' => 'enigma.php',
];

const DB_PARAMS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION        
];

define('CONFIGURATIONS', parse_ini_file("configurations.ini", true));