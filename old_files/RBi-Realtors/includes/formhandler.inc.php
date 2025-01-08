<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $cc_email = $_POST["cc_email"];
    $cell_phone = $_POST["cell_phone"];
    $work_phone = $_POST["work_phone"];
    $home_phone = $_POST["home_phone"];
    $fax = $_POST["fax"];
    $company_name = $_POST["company_name"];
    $company_addr1 = $_POST["company_addr1"];
    $company_addr2 = $_POST["company_addr2"];
    $company_city = $_POST["company_city"];
    $company_state = $_POST["company_state"];
    $company_zip = $_POST["company_zip"];
    try {
        require_once "dbh.inc.php";

        $query = "INSERT INTO rbi_realtors (
            fname,
            lname,
            email,
            cc_email,
            cell_phone,
            work_phone,
            home_phone,
            fax,
            company_name,
            company_addr1,
            company_addr2,
            company_city,
            company_state,
            company_zip
            )
            VALUES (
            :fname,
            :lname,
            :email,
            :cc_email,
            :cell_phone,
            :work_phone,
            :home_phone,
            :fax,
            :company_name,
            :company_addr1,
            :company_addr2,
            :company_city,
            :company_state,
            :company_zip  
            );";

            $stmt = $pdo->prepare($query);

            $stmt->bindParam(":fname", $fname);
            $stmt->bindParam(":lname", $lname);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":cc_email", $cc_email);
            $stmt->bindParam(":cell_phone", $cell_phone);
            $stmt->bindParam(":work_phone", $work_phone);
            $stmt->bindParam(":home_phone", $home_phone);
            $stmt->bindParam(":fax", $fax);
            $stmt->bindParam(":company_name", $company_name);
            $stmt->bindParam(":company_addr1", $company_addr1);
            $stmt->bindParam(":company_addr2", $company_addr2);
            $stmt->bindParam(":company_city", $company_city);
            $stmt->bindParam(":company_state", $company_state);
            $stmt->bindParam(":company_zip", $company_zip);

            $stmt->execute();

            $pdo = null;
            $stmt = null;

            header("Location: ../good_bye.php");

            die();

    } catch (PDOException $e) {
        die("Query failed:  " . $e->getMessage());
    }
    

} else {
    header("Location:: ../index.php");
}