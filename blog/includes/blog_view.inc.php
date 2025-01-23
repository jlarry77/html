<?php

declare(strict_types=1); 

function check_blog_errors() {
    if (isset($_SESSION['errors_blog_submit'])) {
        $errors = $_SESSION['errors_blog_submit'];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class = "form-error">' . $error . '</p>';
        }

        unset($_SESSION['errors_blog_submit']);
        
    }  else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo '<br>';
        echo '<p class="form-success">Blog Post Success!</p>';
    }
    
}

function display_messages() {
    // Check for success message in the URL query
    if (isset($_GET['post']) && $_GET['post'] === 'success') {
        echo '<p class="success-message">Your post was successfully submitted!</p>';
    }

    // Display errors if any are stored in the session
    if (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];
        foreach ($errors as $error) {
            echo '<p class="error-message">' . $error . '</p>';
        }
        // Clear errors after displaying
        unset($_SESSION["errors_signup"]);
    }
}