<?php

const ROUTES = [

    '/' => 'index.php',
    '/erreur' => 'error.php',
    '/connexion' => 'connection.php',
    '/creation-de-compte' => 'createAccount.php',
    '/deconnexion' => 'deconnection.php',
    '/cart' => 'cart.php',
    '/details' => 'details.php'
];

const DB_PARAMS = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION        
];

define('CONFIGURATIONS', parse_ini_file("configurations.ini", true));