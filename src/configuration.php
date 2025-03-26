<?php

const ROUTES = [

    '/' => 'index.php',
    '/erreur' => 'error.php',
    '/connexion' => 'connection.php',
    '/create' => 'create.php',
    '/deconnexion' => 'deconnection.php',
    '/error' => 'error.php',
    '/connection' => 'connection.php',
    '/deconnection' => 'deconnection.php',
    '/cart' => 'cart.php',
    '/details' => 'details.php',
    '/updateCart' => 'updateCart.php',
    '/payCart' => 'payCart.php',
    '/inventory' => 'inventory.php'
];

const DB_PARAMS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION        
];

define('CONFIGURATIONS', parse_ini_file("configurations.ini", true));