<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once "autoload.php";

define("ENVIRONMENT", "development");
//define("ENVIRONMENT", "production");

if (ENVIRONMENT == 'development') {
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    define("HOME", "http://localhost/tcc/");
    $config = [
        'dbname' => 'bd_tcc',
        'dbuser' => 'root',
        'dbpass' => '',
        'host' => 'localhost'
    ];
} else {
    define("HOME", "http://www.meutcc.tk");
    $config = [
        'dbname' => 'bd_tcc',
        'dbuser' => '',
        'dbpass' => '',
        'host' => 'localhost'
    ];
}
define("ASSETS", HOME . 'assets/');
define("CSS", ASSETS . 'css/');
define("JS", ASSETS . 'js/');
define("IMG", ASSETS . 'images/');

try {
    global $db;
    $db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'] . ";charset=utf8", $config['dbuser'], $config['dbpass']);
} catch (PDOException $error) {
    echo "ERRO: " . $error->getMessage();
    exit();
}
