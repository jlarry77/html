<?php

//  Control File, takes care of input from the user

declare(strict_types=1); 

function is_input_empty(string $username, string $pwd) {
    if (empty($username) || empty($pwd)) {
        return true;
    }
    else {
        return false;
    }
}


function is_username_taken(object $pdo, string $username) {
    if (get_username($pdo, $username)) {
        return true;
    }
    else {
        return false;
    }
}



function create_user(object $pdo, string $pwd, string $username) {
   set_user($pdo, $pwd, $username);
}