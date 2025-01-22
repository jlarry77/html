<?php

//  Model Form: Takes care of querying the Database

declare(strict_types=1);    // Set to true, allows type declarations

function get_username(object $pdo, string $username) {

    $query = "SELECT user_name FROM users WHERE user_name = :user_name;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_name", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;

}


function set_user(object $pdo, string $username, string $pwd) {
    $query = "INSERT INTO users (user_name, user_pw) VALUES (:user_name, :user_pwd);";
    $stmt = $pdo->prepare($query);
    
    $options = [
        'cost' => 12
    ];

    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
    
    $stmt->bindParam(":user_name", $username);
    $stmt->bindParam(":user_pwd", $hashedPwd);
    $stmt->execute();
}