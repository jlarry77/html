<?php

declare(strict_types=1);

function get_user(object $pdo, string $username)
{
    $query_user = "SELECT * FROM users WHERE username = :username;";
    $pdo_stmt = $pdo->prepare($query_user);
    $pdo_stmt->bindParam(":username", $username);
    $pdo_stmt->execute();

    $result = $pdo_stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}