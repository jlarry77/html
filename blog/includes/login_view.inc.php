<?php


//  Enforce strict typing to ensure proper variable type usage //
declare(strict_types=1);

// Output the username if user is loggin in, otherwise indicate that the user is not logged in //
function output_username()
{
    // Check if a user session exists with a "user_id" key //
    if (isset($_SESSION["user_id"])) {

        // Output the logged-in username stored in the session //
        echo "You are logged in as " . $_SESSION["user_username"];

    } else {

        // Inform the user they are not logged in //
        echo "You are not logged in";
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