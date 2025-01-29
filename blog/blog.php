<?php
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/blog_model.inc.php';
require_once 'includes/login_view.inc.php';
require_once 'blog_post_model.inc.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['blog_id']) || empty($_GET['blog_id'])) {
    die("Blog ID not provided or empty.");
}

$blog_id = (int)$_GET['blog_id'];
$post = fetch_blog_post($pdo, $blog_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?></title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<body>
    <header class="head-section">
        <h1 class="title-section">Blog Title (TBD)</h1>
        <div class="header-right">
            <nav class="nav-section">
                <a href="index.php">Home</a>
                <a href="admin.php?login=success">Admin</a>
                <a href="login.php">Log In</a>
            </nav>
            <div class="log-status">
                <?php login_status(); ?>
            </div>
        </div>
    </header>
    
    <div class="blog-body">
        <main class="main-post">
            <?php blog_post_display($post); ?>
        </main>
    </div>

    <footer class="footer">
        <div class="foot-container"></div>
        <form action="includes/logout.inc.php">
            <button class="admin-logout" type="submit">Log Out</button>
        </form>
    </footer>
</body>
</html>
