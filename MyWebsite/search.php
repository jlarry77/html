<?php 




// Condition that prevents user from accessing code
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userSearch = $_POST["usersearch"];
    

    try {
        require_once "includes/dbh.inc.php";

        $query = "SELECT * FROM users WHERE username = :usersearch;";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":usersearch", $userSearch);


            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $pdo = null;
            $stmt = null;


    } catch (PDOException $e) {
        die("Query Failed:  " . $e->getMessage());
    }

}
else {
    header("Location:  ../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet"  href="style/style.css">
        <title>Search</title>
    </head>
<body>

<section>

    <h3>Search results:</h3>
        <?php
            
            if (empty($results)) {
                echo "<div>";
                echo "<p>There were no resuts.</p>";
                echo "</div>";
            }
            else {
             foreach ($results as $row) {
                echo "<div>";
                echo "<h4>" . htmlspecialchars($row ["email"]) . "</h4>";
                echo "</div>";
            }
            }
            

            
        ?>
</section>


</body
</html>