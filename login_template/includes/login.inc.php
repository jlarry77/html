<?php


//  Verify that Request Method is 'POST'
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    //  Retrieve username and passowrd from Post Requst on Index.php
    $username = $_POST["user_name"];
    $password = $_POST["password"];

    try {
        // Include required files for database handling and login logic
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // Error Handlers stored as an array
        $errors =[];

        //  Check for empty input fields
        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Pleas fille in all fields.";
    }
    // Fetch user information from the database
    $result = get_user($pdo, $username);


    //  Check if user name doesn't exist
    if (is_username_wrong($result)) {
        $errors["login_incorrect"] = "Incorrect username information!";
    }

    //  Ensure password is correct
    if (!is_username_wrong($result) && is_password_wrong($password, $result[$pwd])) {
        $errors["login_incorrect"] = "Incorrect password information!";
    }

    // Include session configuration
    require_once 'config_session.inc.php';


    // Store any errors in the Session and redirect back to index.php
    if ($errors) {
        $_SESSION["errors_signup"] = $errors;
        header("Location: ../index.php");
        die();
    }


    // Create a new Session ID and append the User's ID
    $newSessionID = session_create_id();
    $sessionId = $newSessionId . "_" . $result["id"];
    session_Id($sessionId);

    // Store user information in sessionvariables
    $_SESSION["user_id"] = $result["id"];
    $_SESSION["user_username"] = htmlspecialchars($result["username"]);
    $_SESSION["last_regeneration"] = time();

    // Once Logged in, send user to main.php pages

    header("location:  ../main.php?login=success");

    // Close database connection and cleanup resources
    $pdo = null;
    $stmt = null;
    // Terminate the script
    die();

} catch (PDOException $e) {

    // Handle Database query failures
    die("Query Failed: " . $e->getMessage());
}

} else {
    // Redirect to the index page if the request method is not POST
    header("Location:  ../index.php");
    die();
}
