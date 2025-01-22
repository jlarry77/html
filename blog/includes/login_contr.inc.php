<?php

// Enforce strict typing to ensure proper variable type usage
declare(strict_types=1);

/**
 * Checks if either the username or password input is empty.
 *
 * @param string $username The username input.
 * @param string $pwd The password input.
 * @return bool Returns true if either input is empty, otherwise false.
 */
function is_input_empty(string $username, string $pwd) {
    // Check if either the username or password is empty
    if (empty($username) || empty($pwd)) {
        return true; // Inputs are empty
    } else {
        return false; // Inputs are not empty
    }
}

/**
 * Checks if the provided username is invalid or does not exist.
 *
 * @param bool|array $result The result of a query or validation check.
 * @return bool Returns true if the username is invalid, otherwise false.
 */
function is_username_wrong(bool|array $result)
{
    // If the result is false (e.g., query returned no match), the username is invalid
    if (!$result) {
        return true;
    } else {
        return false;
    }
}

/**
 * Checks if the provided password does not match the stored hashed password.
 *
 * @param string $pwd The plain text password input.
 * @param string $hashedPwd The hashed password retrieved from the database.
 * @return bool Returns true if the password is incorrect, otherwise false.
 */
function is_password_wrong(string $pwd, string $hashedPwd)
{
    // Use PHP's password_verify function to compare the plain text password with the hashed password
    if (!password_verify($pwd, $hashedPwd)) {
        return true; // Password is incorrect
    } else {
        return false; // Password is correct
    }
}
