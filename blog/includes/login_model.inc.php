<?php

declare(strict_types=1);

function get_user(object $pdo, string $username)
{
    $query = "SELECT * FROM users WHERE user_name = :user_name;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_name", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}