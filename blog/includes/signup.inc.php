<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // ERROR HANDLERS - Make sure things are running correctly

        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
            $errors["empty_input"] = "Please fill in all fields.";
        }

        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Invaild e-mail used.";
        }

        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already in use.";
        }
        
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "E-mail already registered.";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];

            $_SESSION["signup_data"] = $signupData;

            header("Location: ../admin.php");
            die();

        }

        create_user($pdo, $username, $pwd, $email);

        header("Location:  ../admin.php?signup=success");

        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("Location:  ../admin.php");
    die();
}