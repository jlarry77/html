<?php

// View File:  12/12/24 - I think this is complete

declare(strict_types=1);

function output_username()
{
    if (isset($_SESSION["user_id"])) {
        echo "You are logged in as " . $_SESSION["user_username"];

    } else {
        echo "You are not logged in";
    }
}
