<?php

require_once '../config.php';

$sensiteiveData = "$password";
$salt = bin2hex(random_bytes(16));  // Generate Random Salt
$pepper = "PepperString";

$dataToHash = $sensiteiveData . $salt . $pepper;

$hash = hash("sha256", $dataToHash);

/* ---- */

$storedSalt = ;
$storedHash = ;
$pepper = "";