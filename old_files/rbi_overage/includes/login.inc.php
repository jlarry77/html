<?php

if ($_SERVER["REQUEST_METHODS"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        $errors = [];

        if (is_input_empty($username, $pwd,)) {
            $errors["empty_input"] = "Fill in all fields.";
        }
        


        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = "$errors";
        }

        
        }

    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }
} else {
    header("Location: ../index.php");
    die();
}
