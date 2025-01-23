<?php
//  Model Form:  Queries and adds data to database



declare(strict_types=1);

require_once 'dbh.inc.php';

function input_blog(
    object $pdo,
    string $username,
    string $title,
    string $blog_post
) {
    $blog = "INSERT INTO prgm_blog.blog_posts (
    username,
    title,
    blog_post
    )
    VALUES (
    :username,
    :title,
    :blog_post
    );";
try {
    // Prepare the Query //
    $stmt = $pdo->prepare($blog);

    // Bind the parameters to the query //
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":blog_post", $blog_post);

    // Execute the query //
    $stmt->execute();
} catch (PDOException $e) {
            // Handle any PDO-related exceptions
            error_log("Error inserting blog post: " . $e->getMessage());
            throw new Exception("Unable to insert blog post. Please try again later.");
    }
}

function output_blogs(object $pdo) {
    $query = "SELECT blog_id, username, title, blog_date, blog_post
              FROM blog_posts
              ORDER BY blog_date DESC;";

    try {
        // Prepare and execute the query
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        // Fetch and display the results
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<article>";
            // Make the title a clickable link
            echo "<h2><a href='blog.php?blog_id=" . ($row['blog_id']) . "'>" . htmlspecialchars($row['title']) . "</a></h2>";
            echo "<p><small>By " . htmlspecialchars($row['username']) . " on " . htmlspecialchars($row['blog_date']) . "</small></p>";
            echo "<div>" . nl2br(htmlspecialchars(substr($row['blog_post'], 0, 100))) . "...</div>"; // Display a preview of the post
            echo "</article>";
        }
    } catch (PDOException $e) {
        // Log any errors and provide a user-friendly message
        error_log("Error fetching blog posts: " . $e->getMessage());
        throw new Exception("Unable to retrieve blog posts. Please try again later.");
    }
}

