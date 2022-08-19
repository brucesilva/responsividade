<?php

$host = 'localhost';
$dbname = 'gentequefaz2';
$user = 'root';
$pass  = '';


try {
    $pdo = new PDO("mysql:dbname=$dbname;host=$host", 'root', '');
} catch (PDOException $e) {
    echo $e->getMessage();
}
