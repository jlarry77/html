<?php

declare(strict_types=1);


// Enter variables for inspector/id contractors (no Nulls 0 or number in DB)
function is_contractor_empty(
    string $insp_id, 
    string $job_date, 
    string $ccr, 
    string $j_and_n, 
    string $ovind, 
    string $rbi, 
    string $roofcorp, 
    string $adobe) {
    
        if (
        empty($insp_id) ||
        empty($job_date) ||
        empty($ccr) || 
        empty($j_and_n)|| 
        empty($ovind) || 
        empty($rbi) ||
        empty($roofcorp) ||
        empty($adobe)
     ) {
        return true;
    } else {
        return false;
    }
}
