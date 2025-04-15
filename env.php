<?php

// defaut: dev

// $env = 'test';
//$env = 'prod';
if(isset($env)){
    if($env == 'test'){
        // PHP 8.1
    }
    elseif($env == 'prod'){
        // LOL
    }
} // dev
else{
    $db = new PDO('mysql:host=localhost;dbname=tma;charset=utf8', 'root', '');
    // PHP 7.3.8

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

?>