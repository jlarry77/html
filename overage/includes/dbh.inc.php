<?php

$host = '100.107.139.13';
$dbname = 'RBi_Overage';
$dbusername = 'root';
$dbpassword = 'Anchor77Crown';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed: " . $e->getMessage());
}