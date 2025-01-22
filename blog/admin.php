<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
    <title>Blog Admin/Post Entry</title>
</head>
<body>

    <!-- Blog Input Section -->
     <div class="blog-input">
        <h3>Blog Content Creation</h3>
        <form action="includes/blog.inc.php" method="POST">
            <input type="text" name="title" placeholder="Post Title">
            <input type="text" name="blog-content" placeholder="Blog Content">
            <button type="submit">Submit Post</button>
        </form>

     </div>

    <!-- Registration Section -->
    <div class="index-registration">
        <h3>User Registration</h3>
        <form action="includes/signup.inc.php" method="POST">
            <input type="text" name="username" placeholder="User Name">
            <input type="password" name="pwd" placeholder="Password">
            <input type="text" name="email" placeholder="e-mail">
            <button type="submit">Add User</button> 
        </form>
        <?php check_signup_errors(); ?>
    </div>



</body>
</html>