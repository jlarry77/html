<?php
session_start();
require_once 'includes/dbh.inc.php';
require_once 'includes/blog_model.inc.php';
require_once 'includes/login_view.inc.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Function to fetch a blog post by ID
function fetch_blog_post(PDO $pdo, int $blog_id) {
    $query = "SELECT username, title, blog_date, blog_post, image_path FROM blog_posts WHERE blog_id = :blog_id";
    
    try {
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":blog_id", $blog_id, PDO::PARAM_INT);
        $stmt->execute();

        $post = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$post) {
            die("No blog post found with the provided ID.");
        }

        return $post;
    } catch (PDOException $e) {
        error_log("Error fetching blog post: " . $e->getMessage());
        throw new Exception("Unable to retrieve blog post. Please try again later.");
    }
}

// Function to display a blog post
function blog_post_display(array $post) {
    echo "<article>";
    echo "<div class='blog-text'>";
    echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
    echo "<p><small>By " . htmlspecialchars($post['username']) . " on " . htmlspecialchars($post['blog_date']) . "</small></p>";
    echo "<div>" . nl2br(htmlspecialchars($post['blog_post'])) . "</div>";
    echo "</div>";

    if (!empty($post['image_path'])) {
        echo "<div class='blog-pic'>";
        echo "<img src='uploads/" . htmlspecialchars($post['image_path']) . "' alt='Blog Image' style='width:auto; height:125px; border-radius:10px; margin-bottom:10px;'>";
        echo "</div>";
    }

    echo "</article>";
}
?>
