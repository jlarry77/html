<?php
 session_start();

ini_set('display_errors', 1);               // These three lines added by Chatgtp
ini_set('display_startup_errors', 1);       // To display error messages
error_reporting(E_ALL); 



//  Verify that Request Method is 'POST' //

 

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve username and password from Post Request on Index.php //
        $username = $_POST["username"];
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
                $error["empty_input"] = "Please fill in all fields.";
            }

            // Fetch user information from the database using dbh.inc.php //
            $result = get_user($pdo, $username);

            //  Ensure that user name exists in database //
            if (is_username_wrong($result)) {
                $error["login_incorrect"] = "Username not found.";
            }

            // Ensure that password is correct //
            if (!is_username_wrong($result) && is_password_wrong($password, $result["user_pw"])) {
                $error["login_incorrect"] = "Password is incorrect.";
            }

            // var_dump($result);

            //  Include session configuration //
            require_once 'config_session.inc.php';

            // Store any errors in the Session and redirect back to login.php //
            if ($error) {
                $_SESSION["errors_login"] = $error;
                header("Location: ../login.php");
                die();
            }

            //  Create a new Session ID and append the User's ID //
            $newSessionId = session_create_id();
            $sessionId = $newSessionId . "_" . $result["user_id"];
            session_id($sessionId);

            //  Store user information in the session variables //
            $_SESSION["user_id"] = $result["user_id"];
            $_SESSION["username"] = htmlspecialchars($result["username"]);
            $_SESSION["last_regeneration"] = time();

                                    // error_log("Session user_id: " . $_SESSION["user_id"]);

                                    // error_log("Session username set: " . $_SESSION['username']); // Log the session value


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
