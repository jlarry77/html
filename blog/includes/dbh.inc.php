<?php


//  Database Connection File //

$dsn = "mysql:host=100.107.139.13; dbname= TBD ";

$dbusername = "root";
$dbpassword = "Anchor77Crown";

try {
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection Failed: " . $e->getMessage();
}