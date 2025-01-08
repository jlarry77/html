<?php

// Error Handlers
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'includes/dbh.inc.php';
require_once 'includes/login_view.inc.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
    <title>Overage DB Results</title>
</head>

<body>
<header class=.main-header>
    <img src="images/RBi_logo_black_blue.png" alt="Roof Brokers Logo" height= 75px width=auto>
    <nav class="button-container">
    <form action="includes/home.inc.php" method="post">
            <button>Home</button>
        </form>
        <form action="includes/logout.inc.php" method="post">
        <button>Logout</button>
        </form>

        </nav>
        

        </header>    
    <div class = "content">

    <h3>Job Entry</h3>
    
        <?php

            require_once 'includes/main_model.inc.php';
            output_jobs($pdo);



            
           // resultYear($pdo);
            
        ?>
    
<div>

</body>
</html>