<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_SESSION['username'] ?? null;

    if (!$username) {
        die("You must be logged in to submit a blog post.");
    }

    $title = trim($_POST['title'] ?? '');
    $blog_post = trim($_POST['blog_post'] ?? '');

    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

        $image = $_FILES['image'];
        
        // Log the file upload details
        error_log("File details: " . print_r($image, true));
        
        if ($image['error'] !== 0) {
            die("File upload error. Code: " . $image['error']);
        }
    
        $imageName = basename($image['name']);
        $targetDir = "../uploads/";
        $targetFilePath = $targetDir . $imageName;
    
        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($image['type'], $allowedTypes)) {
            die("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
        }
  
    
        // Move uploaded file
        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            echo "File uploaded successfully to: $targetFilePath";
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "File upload error. Code: " . $_FILES['image']['error'];
    
    }
    
    // After moving the file
            if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                $imagePath = $imageName; // Pass just the image name to save in DB
                echo "File uploaded successfully to: $targetFilePath";
            } else {
                echo "Failed to move uploaded file.";
                $imagePath = null; // Set to null if upload fails
            }




    try {
        require_once 'dbh.inc.php';
        require_once 'blog_model.inc.php';

        if (empty($title) || empty($blog_post)) {
            $_SESSION['errors_blog_submit'] = ["Please fill in all fields."];
            header("Location: ../admin.php");
            exit();
        }
        
        input_blog($pdo, $username, $title, $blog_post, $imageName);

        header("Location: ../admin.php?post=success");
        exit();
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        die("An error occurred. Please try again later.");
    }
} else {
    header("Location: ../admin.php");
    exit();
}
