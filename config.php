<?php

require 'environment.php';

$config = array();
if(ENVIRONMENT == 'development'){
    define("BASE_URL", "http://projetox.pc/");
    $config['dbname'] = 'db_batepapo';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['pass'] = 'root';
} else {
    define("BASE_URL", "http://meusite.com.br/");
    $config['dbname'] = 'estrutura_mvc';
    $config['host'] = 'localhost';
    $config['dbuser'] = 'root';
    $config['pass'] = 'root';
}
global $db;
try{
    $db = new PDO('mysql:dbname='.$config['dbname'].';host='.$config['host'],$config['dbuser'],$config['pass']);
}catch(PDOException $e){
    echo 'Error: '.$e->getMessage();
}

