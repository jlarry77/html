<?php

ini_set('display_errors', 1);               // These three lines added by Chatgtp
ini_set('display_startup_errors', 1);       // To display error messages
error_reporting(E_ALL); 


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $insp_id = $_POST["insp_id"];
    $job_date = $_POST["job_date"];
    $ccr = $_POST["ccr"];
    $j_and_n = $_POST["j_and_n"];
    $ovind = $_POST["ovind"];
    $rbi = $_POST["rbi"];
    $roofcorp = $_POST["roofcorp"];
    $adobe = $_POST["adobe"];

    try {
        
        require_once 'dbh.inc.php';
        require_once 'main_model.inc.php';
        require_once 'main_contr.inc.php';

        // ERROR HANDLERS - Make sure things are running correctly

        $errors = [];



        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_main"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData;

            header("Location: ../main.php");
            die();

        }

        // Input Data into database
        input_data(
            $pdo,
            $insp_id,
            $job_date,
            $ccr,
            $j_and_n,
            $ovind,
            $rbi,
            $roofcorp,
            $adobe
        );
    


        // Change Below to jobs.php -> once set up
        header("Location:  ../jobs.php?input=success");


        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("Location:  ../results.php");
    die();
}