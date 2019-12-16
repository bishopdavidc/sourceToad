<?php
function displayArray($array){
    $keys = array_keys($array);
    for($i = 0; $i < count($array); $i++) {
        $p = $i+1;
        echo "Passenger ".$p . "\n";
        foreach($array[$keys[$i]] as $key => $value) {
            if(is_array($value))
            {
                $newKey = "";
                $uc = explode("_", $key);
                foreach($uc as $ucVal){
                    $newKey .= ucfirst($ucVal)." ";
                }
                echo $newKey."\n";
                $keys1 = array_keys($value);
                for($j=0;$j < count($value);$j++){
                //echo $keys1[$j] . "\n";
                    foreach($value[$keys1[$j]] as $key1 => $value1) {
                        $newKey = "";
                        $uc = explode("_", $key1);
                        foreach($uc as $ucVal){
                            $newKey .= ucfirst($ucVal)." ";
                        }   
                        if($value1 === true){
                            $newValue = 'Yes';
                        }else{
                            $newValue = $value1;
                        }
                        echo $newKey . " : " . $newValue . "\n";
                    }
                }
            }else{
             $newKey = "";
             $uc = explode("_", $key);
             foreach($uc as $ucVal){
                $newKey .= ucfirst($ucVal)." ";
            }
            if($value === true){
                $newValue = 'Yes';
            }else{
                $newValue = $value;
            }
            echo $newKey . " : " . $newValue . "\n";
        }
    }
    echo "\n";
}
}

$monkey =
array (  
    array (
        'guest_id' => 177,
        'guest_type' => 'crew',
        'first_name' => 'Marco',
        'middle_name' => NULL,
        'last_name' => 'Burns',
        'gender' => 'M',
        'guest_booking' => array (  
            array (
                'booking_number' => 20008683,
                'ship_code' => 'OST',
                'room_no' => 'A0073',
                'start_time' => 1438214400,
                'end_time' => 1483142400,
                'is_checked_in' => true,
            ),
        ),
        'guest_account' => array (  
            array (
                'account_id' => 20009503,
                'status_id' => 2,
                'account_limit' => 0,
                'allow_charges' => true,
            ),
        ),
    ),
    array (
        'guest_id' => 10000113,
        'guest_type' => 'crew',
        'first_name' => 'Bob Jr ',
        'middle_name' => 'Charles',
        'last_name' => 'Hemingway',
        'gender' => 'M',
        'guest_booking' => array (  
            array (
                'booking_number' => 10000013,
                'room_no' => 'B0092',
                'is_checked_in' => true,
            ),
        ),
        'guest_account' => array (  
            array (
                'account_id' => 10000522,
                'account_limit' => 300,
                'allow_charges' => true,
            ),
        ),
    ),
    array (
        'guest_id' => 10000114,
        'guest_type' => 'crew',
        'first_name' => 'Al ',
        'middle_name' => 'Bert',
        'last_name' => 'Santiago',
        'gender' => 'M',
        'guest_booking' => array (  
            array (
                'booking_number' => 10000014,
                'room_no' => 'A0018',
                'is_checked_in' => true,
            ),
        ),
        'guest_account' => array (  
            array (
                'account_id' => 10000013,
                'account_limit' => 300,
                'allow_charges' => true,
            ),
        ),
    ),
    array (
        'guest_id' => 10000115,
        'guest_type' => 'crew',
        'first_name' => 'Red ',
        'middle_name' => 'Ruby',
        'last_name' => 'Flowers ',
        'gender' => 'F',
        'guest_booking' => array (  
            array (
                'booking_number' => 10000015,
                'room_no' => 'A0051',
                'is_checked_in' => true,
            ),
        ),
        'guest_account' => array (  
            array (
                'account_id' => 10000519,
                'account_limit' => 300,
                'allow_charges' => true,
            ),
        ),
    ),
    array (
        'guest_id' => 10000116,
        'guest_type' => 'crew',
        'first_name' => 'Ismael ',
        'middle_name' => 'Jean-Vital',
        'last_name' => 'Jammes',
        'gender' => 'M',
        'guest_booking' => array (  
            array (
                'booking_number' => 10000016,
                'room_no' => 'A0023',
                'is_checked_in' => true,
            ),
        ),
        'guest_account' => array (  
            array (
                'account_id' => 10000015,
                'account_limit' => 300,
                'allow_charges' => true,
            ),
        ),
    ),
);
try{

if (!isset($argv[1]) || empty($argv[1])) {
    $passengerList = displayArray($monkey);
}else{
    $passengerList = $displayArray($argv[1]);
}
}catch ( Exception $e ) {
    die( $e->getMessage() );
}