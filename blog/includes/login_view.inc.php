<?php


//  Enforce strict typing to ensure proper variable type usage //
declare(strict_types=1);

// Redirect back to log in if user is not logged in //
function log_redirect() {
    if (!isset($_SESSION['user_id']) && !isset($_SESSION['username'])) {
        // User is not logged in
        header("Location:  ../login.php");
        exit();	
    } else {
        // User is logged in
        
    }
    }


// Display login-related errors or success messages //
function check_login_errors() {

    // Check for login errors stored in session
    if (isset($_SESSION["errors_login"])) {

        //  Retrieve the array of errors from the session //
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>';
        }


        //  Clear login errors from teh session after displaying them //
        unset($_SESSION['errors_login']);
    }

    else if (isset($_GET['login']) && $_GET['login'] === "success") {
        echo '<br>';
        echo '<p>Login Successful</p>';
    }
}

// Display Login Status
function login_status() {
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    // User is logged in
    echo " You are logged in as " . $_SESSION['username'];
} else {
    // User is not logged in
    echo "You are not logged in.";
}
}
