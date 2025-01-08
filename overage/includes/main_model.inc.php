<?php

declare(strict_types=1);

function input_data(
    object $pdo,
    string $insp_id,
    string $job_date,
    string $ccr,
    string $j_and_n,
    string $ovind,
    string $rbi,
    string $roofcorp,
    string $adobe
    
) {
    $query = "INSERT INTO RBi_Overage.construction_co (
    insp_id,
    job_date,
    ccr,
    j_and_n,
    ovind,
    rbi,
    roofcorp,
    adobe
    )
    VALUES (
    :insp_id,
    :job_date,
    :ccr,
    :j_and_n,
    :ovind,
    :rbi,
    :roofcorp,
    :adobe
    );";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":insp_id", $insp_id);
    $stmt->bindParam(":job_date", $job_date);
    $stmt->bindParam(":ccr", $ccr);
    $stmt->bindParam(":j_and_n", $j_and_n);
    $stmt->bindParam(":ovind", $ovind);
    $stmt->bindParam(":rbi", $rbi);
    $stmt->bindParam(":roofcorp", $roofcorp);
    $stmt->bindParam(":adobe", $adobe);

    $stmt->execute();
}


function output_jobs(object $pdo) {
    try {
        // Fetch the most recent entry (assumes a primary key or auto-increment column called `id`)
        $fetchQuery2 = "SELECT i.insp_fname, i.insp_lname, c.job_date, c.ccr, c.j_and_n, c.ovind, c.rbi, c.roofcorp, c.adobe
        FROM RBi_Overage.construction_co c
        INNER JOIN RBi_Overage.inspectors i ON c.insp_id = i.insp_id
        ORDER BY c.entry_id DESC
        LIMIT 1";
    

        $stmtFetch2 = $pdo->query($fetchQuery2);
        $recentEntry2 = $stmtFetch2->fetch(PDO::FETCH_ASSOC);

        if ($recentEntry2) {
            // Display the most recent entry as a table
            echo "<div class='table-container'>";
            echo "<table>";
            echo "
            <tr>
                <th>Inspector</th>
                <th></th>
                <th>Job Date</th>
                <th>CCR</th>
                <th>J and N</th>
                <th>Ovind</th>
                <th>RBi</th>
                <th>Roof Corp</th>
                <th>Adobe</th>
                
            </tr>";
            echo "
            <tr>
                <td>" . htmlspecialchars((string)$recentEntry2['insp_fname']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['insp_lname']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['job_date']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['ccr']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['j_and_n']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['ovind']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['rbi']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['roofcorp']) . "</td>
                <td>" . htmlspecialchars((string)$recentEntry2['adobe']) . "</td>
            </tr>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No recent entry found.</p>";
        }

    } catch (PDOException $e) {
        die("Error in output_overage: " . $e->getMessage());
    }
}


function resultYear(
    object $pdo

    
) {

    
    // SQL query to fetch data
    $sql = 
    "

USE RBi_Overage;

SELECT  
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
	
	WHERE YEAR(CURDATE()) = YEAR(job_date)
	GROUP BY insp_id ) c
    
    ON i.insp_id = c.insp_id
	WHERE o.insp_id = c.insp_id AND o.insp_id = i.insp_id AND YEAR(CURDATE()) = YEAR(overage_date)
    GROUP BY c.insp_id
;



";



    // Prepare and execute the query


    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute();


    // Fetch all results
    $contractorResults = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    // Check if results exist
    if ($contractorResults) {

        echo "<div class='table-container'>";
        echo "<table>";
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
        foreach ($contractorResults as $row) {
            echo 
            "<tr><td>" . htmlspecialchars($row['insp_fname']) . 
            "</td><td>" . htmlspecialchars($row['insp_lname']) . 
            "</td><td>" . htmlspecialchars($row['ccr_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['jn_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['ovind_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['rbi_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['roofcorp_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['adobe_total_jobs']) . 
            "</td><td>" . htmlspecialchars($row['total_jobs']) . 
            "</td><td>$" . htmlspecialchars($row['total_slush'], 2) . 
            "</td><td>$" . htmlspecialchars($row['loss_to_date'], 2) . 
            "</td><td>$" . htmlspecialchars($row['balance'], 2) . 
            "</td></tr>";
        }
        echo "</table>";
            echo "</div>";
        } else {
            echo "<p>No results found for the year</p>";
        }

}