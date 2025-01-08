<?php

ini_set('display_errors', 1);               // These three lines added by Chatgtp
ini_set('display_startup_errors', 1);       // To display error messages
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';             //  Get db connection 1st
        require_once 'login_model.inc.php';     //  Model 2nd
        require_once 'login_contr.inc.php';     //  Controller 3rd, order is crucial

        // ERROR HANDLERS
        $errors = [];                           //  Create empty array called 'errors'

        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Please fill in all fields.";
        }

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect username info!";
        }
        
        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["pwd"])) {
            $errors["login_incorrect"] = "Incorrect password info!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            header("Location: ../index.php");
            die();
        }

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location:  ../index.php");
            die();
        }
        
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_Id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["last_reneration"] = time();

        // Once logged in, send user to main.php page
        header("Location:  ../main.php?login=success");

      

        $pdo = null;
        $stmt = null;
        
        die();
        
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("Location:  ../index.php");
    die();
}