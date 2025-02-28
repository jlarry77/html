<?php

// Check if the request method is POST (i.e., the form was submitted)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Retrieve user input from the form submission
    $username = $_POST["username"]; // The username provided by the user
    $pwd = $_POST["pwd"]; // The password provided by the user

    try {
        // Include required files for database connection and functionality
        require_once 'dbh.inc.php'; // Database connection
        require_once 'signup_model.inc.php'; // Functions/models for signup logic
        require_once 'signup_contr.inc.php'; // Controllers for signup logic

        // Initialize an array to store potential errors
        $errors = [];

        // Validate if all input fields are filled
        if (is_input_empty($username, $pwd)) {
            $errors["empty_input"] = "Please fill in all fields.";
        }

        // Check if the username is already taken in the database
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "Username already in use.";
        }


        // Include session configuration for storing errors and data
        require_once 'config_session.inc.php';

        // If there are validation errors, store them in the session
        if ($errors) {
            $_SESSION["errors_signup"] = $errors; // Save errors to the session

            // Save user input data (except password) to the session for repopulating the form
            $signupData = [
                "username" => $username,
            ];

            $_SESSION["signup_data"] = $signupData;

            // Redirect back to the admin page to display errors
            header("Location: ../admin.php");
            die(); // Terminate the script
        }

        // If no errors, create the user in the database
        create_user($pdo, $username, $pwd);

        // Redirect back to the admin page with a success message
        header("Location: ../admin.php?signup=success");

        // Close the database connection and free resources
        $pdo = null;
        $stmt = null;

    } catch (PDOException $e) {
        // Handle database-related exceptions and output the error message
        die("Query Failed: " . $e->getMessage());
    }

} else {
    // If the request method is not POST, redirect to the admin page
    header("Location: ../admin.php");
    die();
}
