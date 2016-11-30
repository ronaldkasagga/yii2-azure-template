<?php

function containsAllKeys(array $collection, array $keys){
    foreach ($keys as $key)
        if(!isset($collection[$key])) return false;
    return true;
}
$dev_db_file = __DIR__ .'/db_local.php';

$dsn = 'mysql:host=localhost;dbname=test';
$username = 'root';
$password = '';

if(containsAllKeys($_ENV, ['DB_DSN', 'DB_USER', 'DB_PASSWORD'])){
    $dsn = $_ENV['DB_DSN'];
    $username = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
}elseif (file_exists($dev_db_file)){
    $db = include_once $dev_db_file;
    if(containsAllKeys($db, ['dsn', 'username', 'password'])){
        $dsn = $db['dsn'];
        $username = $db['username'];
        $password = $db['password'];
    }
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => $dsn,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
];
