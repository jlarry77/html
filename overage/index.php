<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roof Brokers Overage Database</title>
    <link rel="stylesheet" href="style/styles.css">
</head>
<header>
    <img src="images/RBi_logo_black_blue.png" alt="Roof Brokers Blue Logo" width="auto" height="75"/>
</header>
<br>
<h3>
    <?php
    output_username();
    ?>
</h3>

<body>
    <div class="center-container">
        <!-- Login Section -->
        <h3>Roof Brokers Overage Database Login</h3>
        <div class="index-login">
           
          <br>
            <form action="includes/login.inc.php" method="post">
                <p>User Name <i style = "color: red">(required)</i></p>
                <input type="text" name="username" placeholder="User Name">
                <p>Password <i  style = "color: red">(required)</i></p>
                <input type="password" name="pwd" placeholder="Password">
                <br>
                <button type="submit">Login</button>
            </form>
            <?php check_login_errors(); ?>
          
        </div>
       
        <!-- Registration Section -->
        <!-- <div class="index-registration">
          <h3>Registration</h3>
            <form action="includes/signup.inc.php" method="POST">
                <input type="text" name="username" placeholder="User Name">
                <input type="password" name="pwd" placeholder="Password">
                <input type="text" name="email" placeholder="e-mail">
                <button type="submit">Register</button> 
            </form>
            <?php check_signup_errors(); ?>
        </div>-->
           <!-- Logout Section -->
        <div class="logout">
        <h3>Logout</h3>
     
            <form action="includes/logout.inc.php" method="post">
                <br>
                <button>Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
