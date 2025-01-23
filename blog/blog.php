<?php
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/blog_model.inc.php';
require_once 'includes/login_view.inc.php';

ini_set('display_errors', 1);               // These three lines added by Chatgtp
ini_set('display_startup_errors', 1);       // To display error messages
error_reporting(E_ALL); 

if (!isset($_GET['blog_id'])) {
    die("Blog ID not provided.");
}

$blog_id = (int)$_GET['blog_id'];

$query = "SELECT username, title, blog_date, blog_post
          FROM blog_posts
          WHERE blog_id = :blog_id";

try {
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":blog_id", $blog_id, PDO::PARAM_INT);
    $stmt->execute();

    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        die("Blog post not found.");
    }
} catch (PDOException $e) {
    error_log("Error fetching blog post: " . $e->getMessage());
    die("Unable to retrieve blog post. Please try again later.");
}
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
    <div class="blog-body">
    <main class="main-post">
        <article class="post-article">
        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
        <p><small>By <?php echo htmlspecialchars($post['username']); ?> on <?php echo htmlspecialchars($post['blog_date']); ?></small></p>
        <div><?php echo nl2br(htmlspecialchars($post['blog_post'])); ?></div>
        </article>
    </main>
    </div>
    <footer class="footer">
        
    </footer>
</body>
</html>
