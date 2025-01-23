<?php

//  Control File, takes care of input from the user

declare(strict_types=1); 

function is_post_empty(string $title, string $blog_post) {
    if (empty($title) || empty($blog_post)) {
        return true;
    }
    else {
        return false;
    }
}

function create_post(object $pdo, string $username, string $title, string $blog_post) {

    $username = $_SESSION['username'] ?? null;
    if (!$username) {
        die("You must be logged in to submit a blog post.");
    }
   input_blog($pdo, $username, $title, $blog_post);
} 