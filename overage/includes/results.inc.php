<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $job_year = $_POST["job_year"];

    try {
        require_once 'dbh.inc.php';
        require_once 'results_model.inc.php';

        // Save the year to a session variable
        session_start();
        $_SESSION['job_year'] = $job_year;

        // Redirect to results.php
        header("Location: ../results.php?query=success");
        exit();


        
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    // Redirect to results.php if accessed directly
    header("Location: ../results.php");
    exit();
}
