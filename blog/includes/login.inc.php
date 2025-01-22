<?php

//  Verify that Request Method is 'POST' //

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve username and password from Post Request on Index.php //
        $username = $_POST["user_name"];
        $password = $_POST["user_pw"];

        try {
            //  Include required files for database handling and login logic //
            require_once 'dbh.inc.php';
            require_once 'login_model.inc.php';
            require_once 'login_contr.inc.php';

            //  Error Handlers -> Stored as an array //
            $error =[];

            // Check for empty input fields //
            if (is_input_empty($username, $password)) {
                $errors["empty_input"] = "Please fill in all fields.";
            }

            // Fetch user information from the database using dbh.inc.php //
            $result = get_user($pdo, $username);

            //  Ensure that user name exists in database //
            if (is_username_wrong($result)) {
                $error["login_incorrect"] = "Username not found.";
            }

            // Ensure that password is correct //
            if (!is_username_wrong($result) && is_password_wrong($password, $result["user_pw"])) {
                $errors["login_incorrect"] = "Password is incorrect.";
            }

            //  Include session configuration //
            require_once 'config_session.inc.php';

            // Store any errors in the Session and redirect back to login.php //
            if ($errors) {
                $_SESSION["errors_login"] = $errors;
                header("Location: ..login.php");
                die();
            }

            //  Create a new Session ID and append the User's ID //
            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["id"];
            session_id($sessionId);

            //  Store user information in the session variables //
            $_SESSION["user_id"] = $result["id"];
            $_SESSION["user_username"] = htmlspecialchars($result["username"]);
            $_SESSION["last_regeneration"] = time();

            //  Once logged in, send user to admin.php page //
            header("location: ../admin.php?login=success");

            //  Close database connection and clean up resources //
            $pdo = null;
            $stmt = null;

            // Terminate the script //
            die();

        } catch (PDOException $e) {

            // Handle and Database query failures //
            die("Query Failed: " .$e->getMessage());
        }        
} else {
            //  Redirect to the Login page if the request method is not 'POST' //
            header("Location:  ../login.php");
            die();
}
