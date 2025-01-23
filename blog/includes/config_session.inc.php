<?php

// ini_set('session.use_only_cookies', 1);     //  Set Cookies to True (1)
// ini_set('session.use_strict_mode', 1);      //  Set Strict Mode to True (1)

session_set_cookie_params([                 //  Accepts array inside parameters
    'lifetime' => 1800,                     //  Lifetime of cookie in seconds
    'domain' => 'TBD',                                                          //  Domain cookie should work on
    'path' => '/',                          //  Any Sub-directories in domain
    'secure' => true,                       //  Allow to only use in HTTPS connection
    'httponly' => true                      //  Prevents users from adding things like javascript to page
]);

session_start();

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedin();
    
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else {
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();
    
    } else {
        $interval = 60 * 30;
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id();
        }
    }
    
}



function regenerate_session_id_loggedin(){

    session_regenerate_id(true);

    $userId = $_SESSION["user_id"];
    $newSessionId = session_create_id();
    $sessionId = $newSessionId . "_" . $userId;
    session_id($sessionId);

    $_SESSION["last_regeneration"] = time();  // time = function, checks last time session id was updated
}

function regenerate_session_id(){
    session_regenerate_id(true);
    $_SESSION["last_regeneration"] = time();  // time = function, checks last time session id was updated
}