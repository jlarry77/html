<?php
// fetch_insp_ids.inc.php

// Ensure database connection is included
require_once 'dbh.inc.php'; // Make sure this is your database connection file

// Initialize empty array for inspector IDs
$insp_ids = [];

try {
    // Fetch insp_id, insp_fname, and insp_lname from the database
    $stmt = $pdo->prepare("SELECT insp_id, insp_fname, insp_lname FROM inspectors");
    $stmt->execute();
    $insp_ids = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error fetching Inspector IDs: " . $e->getMessage());
}
?>
