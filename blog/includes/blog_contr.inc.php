<?php

//  Control File, takes care of input from the user

declare(strict_types=1); 

function is_post_empty(string $title, string $blog_post) {
    if (empty($title) || empty($blog_post)) {
        return true;
    }
    else {
        return false;
    }
}



function create_post(object $pdo, string $title, string $blog_post) {
   set_post($pdo, $title, $blog_post);
}