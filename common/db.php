<?php
//require_once __DIR__.'/../config.php';

$host = '127.0.0.1';
$db   = 'secureapp';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => true,//todo security issue
];
$db = new PDO($dsn, $user, $pass, $opt);