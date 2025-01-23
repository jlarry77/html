<?php

session_start();

ini_set('display_errors', 1);               // These three lines added by Chatgtp
ini_set('display_startup_errors', 1);       // To display error messages
error_reporting(E_ALL); 


// Check if the request method is POST (i.e., the form was submitted)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Retrieve the logged-in username
    $username = $_SESSION['username'] ?? null; // Default to null if not logged in

                                var_dump($_SESSION); 

    if (!$username) {
    die("You must be logged in to submit a blog post.");
}


    // Retrieve Blog Title and Post from POST request on admin.php //
    $title = trim($_POST['title'] ?? '');
    $blog_post = trim($_POST['blog_post'] ?? '');


    try {
        // Include required files for database connection and functionality
        require_once 'dbh.inc.php'; // Database connection
        require_once 'blog_model.inc.php'; // Functions/models for signup logic
        require_once 'blog_contr.inc.php'; // Controllers for signup logic

        // Initialize an array to store potential errors
        $errors = [];

        // Validate if all input fields are filled
        if (is_post_empty($title, $blog_post)) {
            $errors["empty_input"] = "Please fill in all fields.";
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

        // If no errors, create the post in the database
        create_post($pdo, $username, $title, $blog_post);

        // Redirect back to the admin page with a success message
        header("Location: ../admin.php?post=success");

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
