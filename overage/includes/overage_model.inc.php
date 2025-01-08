<?php

declare(strict_types=1);

function input_overage(
    object $pdo,
    string $insp_id,
    string $loss_address,
    string $overage_date,
    string $loss_amount
) {
    try {
        // Insert the new overage entry into the database
        $overageQuery = "INSERT INTO RBi_Overage.overages (
            insp_id,
            loss_address,
            overage_date,
            loss_amount
        )
        VALUES (
            :insp_id,
            :loss_address,
            :overage_date,
            :loss_amount
        );";

        $stmt3 = $pdo->prepare($overageQuery);

        $stmt3->bindParam(":insp_id", $insp_id);
        $stmt3->bindParam(":loss_address", $loss_address);
        $stmt3->bindParam(":overage_date", $overage_date);
        $stmt3->bindParam(":loss_amount", $loss_amount);

        $stmt3->execute();

    } catch (PDOException $e) {
        die("Error in input_overage: " . $e->getMessage());
    }
}

function output_overage(object $pdo) {
    try {
        // Fetch the most recent entry (assumes a primary key or auto-increment column called `id`)
        $fetchQuery = "SELECT insp_id, loss_address, overage_date, loss_amount 
            FROM RBi_Overage.overages 
            ORDER BY overage_id DESC 
            LIMIT 1";

        $stmtFetch = $pdo->query($fetchQuery);
        $recentEntry = $stmtFetch->fetch(PDO::FETCH_ASSOC);

        if ($recentEntry) {
            // Display the most recent entry as a table
            echo "<div class='table-container'>";
            echo "<table>";
            echo "
            <tr>
                <th>Inspector ID</th>
                <th>Job Address</th>
                <th>Date of Overage</th>
                <th>Loss Amount</th>
            </tr>";
            echo "
            <tr>
                <td>" . htmlspecialchars((string)$recentEntry['insp_id']) . "</td>
                <td>" . htmlspecialchars($recentEntry['loss_address']) . "</td>
                <td>" . htmlspecialchars($recentEntry['overage_date']) . "</td>
                <td>" . htmlspecialchars($recentEntry['loss_amount']) . "</td>
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
