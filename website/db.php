<?php

$driver = 'mysql';
$host = 'localhost';
$db_name = 'website';
$db_user = 'admin';
$db_pass = '123';
$charset = 'utf8mb4';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
    $pdo = new
    PDO("$driver:host=$host;dbname=$db_name;charset=$charset", $db_user, $db_pass, $options);
    session_start();

} catch (PDOException $e) {
    die("Ошибка соединения с базой данных");
}