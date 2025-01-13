<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



require_once 'includes/config_session.inc.php';
// require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css"> 
    <title>Login Template</title>
</head>
<body>
    <!-- Header Section -->
    <header>

        <!-- Navigation Bar Section -->
        <nav>

        </nav>
    </header>
    
    <!-- Form to submit user name and password -->

    <div class="main-container">
    <form class="login_form" action="includes/login.inc.php" method="POST">
        <h3>User Login</h3>
    
        <!-- Inputs for Form -->
        <div class="user">
            <h3>User Name <i>required</i></h3>
            <input type="text" name="user_name" placeholder="User Name">
        </div>
        
        <div class="password">
            <h3>Password <i>required</i></h3>
            <input type="password" name="user_pw" placeholder="Password">
        </div>

        <div class="submit-button">
            <button type="submit">Submit</button>
        </div>
        </form>
    </div>
</body>
</html>