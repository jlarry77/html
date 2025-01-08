<?php

//string = type of db:host;db name
$dsn = "mysql:host=100.107.139.13;dbname=RBi_Overage";

//string = username / password
$dbusername = "root";
$dbpassword = "Anchor77Crown";


// Try catch block, tries to catch errors
try {
    //pdo connection to connect to mysql db
    //php data objects - pdo - more versatile than mysqli, can connect to multiple db's
    //Creates connection based on parameters, and creates db object we can use
    // First line directly below is the code that connects to the database
    $pdo = new PDO($dsn, $dbusername, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // How do we handle error messages we may run into when we try to connect to db
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}