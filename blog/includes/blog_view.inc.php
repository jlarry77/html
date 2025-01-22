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