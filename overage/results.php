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



<div class="content">
    <h3>Current Totals</h3>
    <?php
// Start session to access session data
session_start();

// Check if job_year is set in the session
if (isset($_SESSION['job_year'])) {
    $job_year = $_SESSION['job_year'];

    // Include the results model to display data
    require_once 'includes/results_model.inc.php';

    // Fetch and display the data
    input_year($pdo, $job_year);

    // Clear the session variable after use
    unset($_SESSION['job_year']);
} else {
    echo "<p>No year selected. Please return to the main page.</p>";
}
    ?>

</div>
        

</body>
</html>