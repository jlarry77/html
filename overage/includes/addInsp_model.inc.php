<?php

declare(strict_types=1);

function input_inspector(
    object $pdo,
    string $insp_lname,
    string $insp_fname

    
) {
    $addInspector = "INSERT INTO RBi_Overage.inspectors (
    insp_lname,
    insp_fname
        )
    VALUES (
    :insp_lname,
    :insp_fname
    );";

    $stmt4 = $pdo->prepare($addInspector);

    $stmt4->bindParam(":insp_lname", $insp_lname);
    $stmt4->bindParam(":insp_fname", $insp_fname);
    

    $stmt4->execute();
}


