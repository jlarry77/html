<?php
   //print_r($_SESSION);
session_start();
require_once 'includes/login_view.inc.php';
//ini_set('display_errors', 1);               // These three lines added by Chatgtp
//ini_set('display_startup_errors', 1);       // To display error messages
//error_reporting(E_ALL); 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
    <title>Blog Login Page</title>
</head>
<body>
        <!-- Header and Navigation Bar-->
        <header class="head-section">
        <h1 class="title-section">Blog Title (TBD)</h1>
        <div class="header-right">
            <nav class="nav-section">
                <a href="admin.php?login=success">Admin</a>
                <a href="index.php">Home</a>
            </nav>

            <div class="log-status">
                <?php
                    login_status();
                ?>
            </div>
        </div>

    </header>
    

    <!-- Form to submit user name and password -->

    <div class="login-container">
        <form class="login_form" action="includes/login.inc.php" method="POST">
            <h3>User Login</h3>
        
            <!-- Inputs for Form -->
            <div class="user">
                <h3>User Name <i>required</i></h3>
                <input type="text" name="username" placeholder="User Name">
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
    <footer class="footer">
        <div class="foot-container">

        </div>
        <form action="includes/logout.inc.php">
            <button class="admin-logout" type="submit">Log Out</button>
        </form>

     </footer>

</body>
</html>