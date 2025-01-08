<?php



// string = type of db:host;db name

$dsn = "mysql:host=100.107.139.13;dbname=RBi_Overage";

// string = username / password

$dbusername = "root";
$dbpassword = "Anchor77Crown";

// Try-Catch Block:  tries to catch potential errors


try {
    // Create a PDO instance
    $pdo = new PDO($dsn, $dbusername, $dbpassword);

    // Set error mode to exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to fetch data
    $sql = 
    "SELECT  
		o.insp_id,
        i.insp_fname,
        i.insp_lname,
        	ccr_total_jobs,
			jn_total_jobs,
			ovind_total_jobs,
			rbi_total_jobs,
			roofcorp_total_jobs,
			adobe_total_jobs,
			total_jobs,
			total_slush,
		SUM(loss_amount) AS loss_to_date,
		(total_slush - (SUM(loss_amount)) ) AS balance
FROM overages AS o, inspectors i

	LEFT JOIN
		(SELECT
			insp_id,
			SUM(ccr) AS ccr_total_jobs,
			SUM(j_and_n) AS jn_total_jobs,
			SUM(ovind) AS ovind_total_jobs,
			SUM(rbi) AS rbi_total_jobs,
			SUM(roofcorp) AS roofcorp_total_jobs,
			SUM(adobe) AS adobe_total_jobs,
			SUM(adobe) + sum(ccr) + sum(j_and_n) + sum(ovind) + sum(rbi) + sum(roofcorp) AS total_jobs,
			(SUM(adobe) + sum(ccr) + sum(j_and_n) + sum(ovind) + sum(rbi) + sum(roofcorp)) * 30 AS total_slush
	FROM construction_co AS c
	
	
	GROUP BY insp_id ) c
    
    ON i.insp_id = c.insp_id
	WHERE o.insp_id = c.insp_id AND o.insp_id = i.insp_id
    GROUP BY c.insp_id
;";



    // Prepare and execute the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Fetch all results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if results exist
    if ($results) {
        echo "<table border='1'>";
        echo "
            <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>CCR Total Jobs</th>
            <th>J&N Total Jobs</th>
            <th>Ovind Total Jobs</th>
            <th>RBI Total Jobs</th>
            <th>Roof Corp Total Jobs</th>
            <th>Adobe Total Jobs</th>
            <th>Total Jobs</th>
            <th>Total Slush</th>
            <th>Loss To Date</th>
            <th>Current Balance</th>
            </tr>";

        // Loop through and display results
        foreach ($results as $row) {
            echo 
            "<tr><td>" . htmlspecialchars($row['insp_fname']) . 
            "</td><td>" . htmlspecialchars($row['insp_lname']) . 
            "</td><td>" . htmlspecialchars($row['ccr_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['jn_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['ovind_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['rbi_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['roofcorp_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['adobe_total_jobs']) . 
            "</td><td>" . number_format($row['total_jobs']) . 
            "</td><td>$" . number_format($row['total_slush'], 2) . 
            "</td><td>$" . number_format($row['loss_to_date'], 2) . 
            "</td><td>$" . number_format($row['balance'], 2) . 
            "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "No results found.";
    }
} catch (PDOException $e) {
    // Display error message
    echo "Database error: " . $e->getMessage();
}

