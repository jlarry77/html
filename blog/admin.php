
<?php
 
    session_start();



    //print_r($_SESSION);
    require_once 'includes/dbh.inc.php';
    require_once 'includes/signup_view.inc.php';
    require_once 'includes/login_view.inc.php';
    require_once 'includes/blog_view.inc.php';

    log_redirect();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
    <title>Blog Admin/Post Entry</title>
</head>
<body>

        <!-- Header and Navigation Bar-->
        <header class="head-section">
        <h1 class="title-section">Blog Title (TBD)</h1>
        <div class="header-right">
            <nav class="nav-section">
                <a href="index.php">Home</a>
                <form action="includes/logout.inc.php">
                    <button class="admin-logout" type="submit">Log Out</button>
                </form>
            </nav>

            <div class="log-status">
                <?php
                    login_status();
                ?>
            </div>
        </div>

    </header>

   
    <!-- Blog Input Section -->
    <div class="blog-main"> 
        <div class="blog-input">
            <h3>Blog Content Creation</h3>
            <form action="includes/blog.inc.php" method="POST">
                <input type="text" name="title" placeholder="Post Title">
                <textarea name="blog_post" placeholder="Blog Content"></textarea>
                <button type="submit">Submit Post</button>
            </form>

        </div>

    <!-- Registration Section -->
    <div class="index-registration">
        <h3>User Registration</h3>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" name="username" placeholder="User Name">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit">Add User</button> 
        </form>
        <?php 
            check_signup_errors();
            display_messages();
        ?>
    </div>
    </div>


</body>
</html>