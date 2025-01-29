<?php





    session_start();
    // print_r($_SESSION);
    require_once 'includes/dbh.inc.php';
    require_once 'includes/blog_model.inc.php';
    require_once 'includes/login_view.inc.php';

    ini_set('display_errors', 1);               // These three lines 
    ini_set('display_startup_errors', 1);       // Display error messages
    error_reporting(E_ALL); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
    <title>JML Programming Blog</title>
</head>
<body>

    <!-- Header and Navigation Bar-->
    <header class="head-section">
        <h1 class="title-section">Blog Title (TBD)</h1>
        <div class="header-right">
            <nav class="nav-section">
                <a href="admin.php?login=success">Admin</a>
                <a href="login.php">Log In</a>
            </nav>

            <div class="log-status">
                <?php
                    login_status();
                ?>
            </div>
        </div>

    </header>

    <!-- Main Content / Blog Posts -->
        <!--<div class="blue"></div>-->
        <!--<div class="orange"></div>-->
        <!--<div class="yellow"></div>-->
    <div class="body-box">
    <div class="main-content">
        <?php 
            output_blogs($pdo, 'title', 'blog_post', 'image_path');
        ?>
    </div>
    </div>    

    <!-- Footer Section -->
     <footer class="footer">
        <div class="foot-container">

        </div>
        <form action="includes/logout.inc.php">
            <button class="admin-logout" type="submit">Log Out</button>
        </form>
 
     </footer>
</body>
</html> 