<?php 
require_once 'models/userModel.php';
function urlActive(string|array $paths, string $class) : string
{
    $path = uriPath();
    if ( is_array($paths) && in_array($path, $paths) ) {
        return $class;
    } 
    if ( $path === $paths ) {
        return $class;
    }
    return "";
}


function isPost() {
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function dd(mixed $data, bool $die = true): void { #Die and Dump
    echo "<pre>";
    var_dump($data);
    echo "</pre>";

    if ($die) die();
}

function pre(mixed $data, bool $die = true): void {
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    if ($die) die();
}

function urlIs(string $url): bool {
    return $_SERVER['REQUEST_URI'] === $url;
}

function view($path, $attributes = []) : void
{
    extract($attributes);

    require "views/{$path}";
}

function sessionStart() : void
{

    if (session_status() === PHP_SESSION_NONE) { 
        session_start();
    }

}

function isAuthenticated() : bool
{
    sessionStart();
    return !empty($_SESSION['user']);

}

function isAdministrator() : bool 
{
    sessionStart();
    return !empty($_SESSION['user']) && $_SESSION['user']->role === 1;
}

function isValidEmail($email):bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}
function emailAlreadyExist(ModelJoueur $joueur, $email) {
    return !empty($joueur->selectByEmail($email));
}
function isValidPassword(string $password): bool {
    return strlen(trim($password)) > 7;
}