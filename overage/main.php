<?php
// Error Handlers
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include necessary files
require_once 'includes/dbh.inc.php';
require_once 'includes/fetch_insp_ids.inc.php'; // Fetch Inspector IDs
require_once 'includes/login_view.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/styles.css">
    <title>RBi Overages Main</title>
</head>

<header>
    <img src="images/RBi_logo_black_blue.png" alt="Roof Brokers Logo" height= 75px width=auto>
</header>
<body>

    <div class="main-content">
        <!-- Left Column: Job Entry Form -->
        <div class="left-column">
            <h2>Job Entry Form</h2>
            <form action="includes/main.inc.php" method="post">
                <p>Inspector ID</p>
                <!-- Dropdown for Inspector ID -->
                <select name="insp_id">
                    <option value="" disabled selected>Select Inspector</option>
                    <?php
                    foreach ($insp_ids as $insp) {
                        echo "<option value='" . htmlspecialchars($insp['insp_id']) . "'>" . 
                             htmlspecialchars($insp['insp_fname'] . " " . $insp['insp_lname']) . 
                             "</option>";
                    }
                    ?>
                </select>

                <p>Job Date</i></p>
                <input type="date" name="job_date" placeholder="Job Date">

                <p>CCR</p>
                <input type="text" name="ccr" placeholder="enter total" value=0>

                <p>J and N</p>
                <input type="text" name="j_and_n" placeholder="J and N" value=0>

                <p>Ovind</p>
                <input type="text" name="ovind" placeholder="Ovind" value=0>

                <p>RBi</p>
                <input type="text" name="rbi" placeholder="RBi" value=0>

                <p>Roof Corp</p>
                <input type="text" name="roofcorp" placeholder="RoofCorp" value=0>

                <p>Adobe</p>
                <input type="text" name="adobe" placeholder="Adobe" value=0>
                
                <br>
                <button type="submit">Submit</button>
            </form>
    
        </div>

        <!-- Right Column: Loss Entry Form -->
        <div class="right-column">
            <div class="loss-entry">
            <h2>Loss Entry Form</h2>
            <form action="includes/overage.inc.php" method="post">
                <p>Inspector ID</p>
                <!-- Dropdown for Inspector ID -->
                <select name="insp_id">
                    <option value="" disabled selected>Select Inspector</option>
                    <?php
                    foreach ($insp_ids as $insp) {
                        echo "<option value='" . htmlspecialchars($insp['insp_id']) . "'>" . 
                             htmlspecialchars($insp['insp_fname'] . " " . $insp['insp_lname']) . 
                             "</option>";
                    }
                    ?>
                </select>

                <p>Job Address</p>
                <input type="text" name="loss_address" placeholder="Job Address">

                <p>Date of Overage</p>
                <input type="date" name="overage_date" placeholder="Date Entered">
                
                <p>Loss Amount</p>
                <input type="number" name="loss_amount" placeholder="Amount of Loss">

                <br>
                <button type="submit">Submit</button>
                <br>
                <br>
            </form>
            </div>

            <!-- Add Inspector to Database -->
            <div class = "right-lower-column">
            <h2>Add New Inspector</h2>
            <form action="includes/addInsp.inc.php" method="post">    
                <p>Inspector First Name</p>
                <input type="text" name="insp_fname" placeholder="First Name">

                <p>Inspector Last Name</p>
                <input type="text" name="insp_lname" placeholder="Last Name">
                <br>
                <button type="submit">Add Inspector</button>
                <br>
                <br>
            </form>
            </div>
            <!-- Current Inspector Totals and Logout -->
            
        </div>
    </div>

    <div class="totals-logout">
                <div class = "totals">
                <h2>Current Totals</h2>
                <br>    
                <form action="includes/results.inc.php" method="post">
  
                <div>
                <p>Select a Year</p>
                        <input type = "text" name = "job_year" placeholder="YYYY">
                        <br>
                        <button type="submit">Current Totals</button>
                    </div>    
                </form>
                </div>
                <div class="links">
                    <h2>Roof Brokers, Inc. Overage Database</h2>
                </div>    
                <div class = "logout">
                <h2>Log Out</h2>
                <br>
                <form action="includes/logout.inc.php" method="post">
                    <br>
                    <button>Logout</button>
                </form>
                </div>
            </div>
            
</body>
</html>
