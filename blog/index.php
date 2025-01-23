<?php
    require_once 'includes/dbh.inc.php';
    require_once 'includes/blog_model.inc.php';
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
        <nav class="nav-section">
            <a href="login.php">Log In</a>
            <form action="includes/logout.inc.php">
                <button class="admin-logout" type="submit">Log Out</button>
            </form>
        </nav>
    </header>

    <!-- Main Content / Blog Posts -->

    <div class="main-content">
        <?php 
            output_blogs($pdo, 'title', 'blog_post')
        ?>
    </div>
    

    <!-- Footer Section -->
     <footer class="footer">


     </footer>
</body>
</html>