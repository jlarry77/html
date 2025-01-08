<?php
    // Start Session
    require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roof Brokers Overage Database</title>
</head>
<header>
<img src="images/RBi_logo_black_blue.png" alt="Roof Brokers Blue Logo" width="auto" height="55"/>
</header>
<body>
<h3>Roof Brokers Overage Database Login</h3>
        <div class="flex-containter">
        <form action="includes/formhandler.inc.php" method="post">
            <p>User Name <i>(required)</i></p>
            <input type="text" name="username" placeholder="User Name (required)">
            <form action="includes/formhandler.inc.php" method="post">
            
            <p>User Name <i>(required)</i></p>
            <input type="password" name="password" placeholder="Password (required)">
            <form action="includes/formhandler.inc.php" method="post">

            <button>Login</button>
        
        </div>

        <?php 
            include "includes/dbh.inc.php"; 
        ?>

</body>
</html>