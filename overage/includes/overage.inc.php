<?php

ini_set('display_errors', 1);               // These three lines added by Chatgtp
ini_set('display_startup_errors', 1);       // To display error messages
error_reporting(E_ALL); 


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $insp_id = $_POST["insp_id"];
    $loss_address = $_POST["loss_address"];
    $overage_date = $_POST["overage_date"];
    $loss_amount = $_POST["loss_amount"];


    try {
        
        require_once 'dbh.inc.php';
        require_once 'overage_model.inc.php';
        require_once 'overage_contr.inc.php';

        // ERROR HANDLERS - Make sure things are running correctly

        $errors = [];

        if (is_overage_empty($insp_id, $loss_address, $overage_date, $loss_amount)) {
            $errors["empty_input"] = "Please fill in all fields.";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_main"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData;

            header("Location: ../index.php");
            die();

        }

        // Input Data into database
        input_overage(
            $pdo,
            $insp_id,
            $loss_address,
            $overage_date,
            $loss_amount
        );
    
        // Change Below to jobs.php -> once set up

        header("Location:  ../overages.php?input=success");
        
        exit;
        
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("Location:  ../results.php");
    die();
}