<?php

ini_set('session.use_only_cookies', 1);         // Set cookies to true (1)
ini_set('session.use_strict_mode', 1);          // Set Strict mode to true (1)

session_set_cookie_params([                     //  Accepts array inside parameters
    
    'lifetime' => 1800,                         //  Lifetime of cookie in seconds

    // This will need to be reset to correct domain each time template is used
    'domain' => '100.107.139.13',
    
    'path' => '/',                              // Include any subdirectories in domain
    'secure' => false,                           // Allow to only use HTTPS connection
    'httponly' => false                          //  Prevent users from adding things like Javascript to page
]);

// Start Session
session_start();


// Check if user is logged in/make sure user_id is set in the session
if (isset($_SESSION["user_id"])) {

    // If the session was never regerated after login, regenerate it now
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id_loggedin();
    } else {
        // Check if the session needs regeneration based on a 30-minute interval
        $interval = 60 * 30;                    // Define gegeneration interval (30 Minutes)
        if (time() - $_SESSION["last_regeneration"] >= $interval) {
            regenerate_session_id_loggedin();   //  Regenerate session if interval has passed
        }
    }
} else {
    //  Handle sessions for unauthenticated users
    if (!isset($_SESSION["last_regeneration"])) {
        regenerate_session_id();                // Regenerate session for first-time access
    
    } else {
        //  Check if session needs to be regenerated based on 30-minute interval
        $interval = 60 * 30;
        if (time() - ($_SESSION["last_regeneration"] >= $interval)) {
            regenerate_session_id();            // Regenerate session if interval has passed
        
        } 
}

}
//  Function to regenerate the session ID for logged-in users
function regenerate_session_id_loggedin(){
    session_regenerate_id(true);                // Generate a new session ID and invalidate the old one

    $userId = $_SESSION["user_id"];             // Get the user ID from the session
    $newSessionId = session_create_id();      // Create a new session ID
    $sessionId = $newSessionId . "_" . $userId; // Append the user ID to the new session ID
    $session_id($sessionId);                    // Update the last regeneration timestamp

    $_SESSION["last_regeneration"] = time();
}

// Function to regenerate the session ID for unauthenticated users
function regenerate_session_id(){
    session_regenerate_id(true);                // Generate a new session ID and invalidate the old one
    $_SESSION["last_regeneration"] = time();    // Update the last regeneration timestamp
}