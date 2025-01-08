<?php

declare(strict_types=1);


// Enter variables for inspector/id contractors (no Nulls 0 or number in DB)
function is_overage_empty(
    string $insp_id, 
    string $loss_address, 
    string $overage_date, 
    string $loss_amount 
) {
    
        if (
        empty($insp_id) ||
        empty($loss_address) ||
        empty($overage_date) || 
        empty($loss_amount)
     ) {
        return true;
    } else {
        return false;
    }
}
