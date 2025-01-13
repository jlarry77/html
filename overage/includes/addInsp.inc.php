<?php

ini_set('display_errors', 1);               // These three lines added by Chatgtp
ini_set('display_startup_errors', 1);       // To display error messages
error_reporting(E_ALL); 


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $insp_lname = $_POST["insp_lname"];
    $insp_fname = $_POST["insp_fname"];

    try {
        
        require_once 'dbh.inc.php';
        require_once 'addInsp_model.inc.php';

        input_inspector(
            $pdo,
            $insp_lname,
            $insp_fname
        );

        header("Location:  ../main.php?addition=success");

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

}