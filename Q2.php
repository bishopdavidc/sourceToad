<?php

function sortBy(&$array,$sortValue,$sortValue2 = null)
{
    $field1 = "";
    function array_search_id($search_value,$array, $array2){ //sub function to find the path to the key that is going to be used for sorting
        if(is_array($array) && count($array) > 0) { //make sure the array is actually an array
            foreach($array as $key => $value) { 
                $temp_path = $array2; //store the starting array into the path value;
                $key1 = "";
                if(!is_numeric($key)){
                    $key1 = "'".$key."'"; //if the key isn't numeric, enclose it in single quotes
                }else{
                    $key1 = $key; //otherwise, just leave the key as it is
                }
                array_push($temp_path, "[".$key1."]"); //push the newest path value onto the path array
                if(is_array($value) && count($value) > 0) {  //if the value is itself an array, call the search again
                    $res_path = array_search_id($search_value, $value, $temp_path); 
                    if ($res_path != null) { 
                        return $res_path; 
                    } 
                } 
                else if($key === $search_value) {  //if we found the key we are looking for, return the search path 
                    return $temp_path; 
                } 
            } 
        }
    }
    $sortVal = explode(",", $sortValue); 
    foreach($sortVal as $sortValue){
    $temp_path1 = array_search_id($sortValue, $array,array());  //get the path for the key value we want to sort on
    $field1 = "";
    array_shift($temp_path1);
    foreach($temp_path1 as $test){ //convert the path array into a string so it can be passed to the sorting
        $field1 .=$test;
    }
    //sort the array 
    usort($array, create_function('$a, $b', '
        $a = $a'.$field1.';
        $b = $b'.$field1.';
        if ($a == $b) return 0;
        return ($a  > $b) ? -1 : 1;
        '));
    echo "Sorted Array: \n";
    print_r($array);
    echo "\n";
}
return true;
}

//Passengers list array
$passengers =
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
    echo "ORIGINAL ARRAY \n";
//Display the list before it has been sorted
    print_r($passengers);
    echo "SORTING \n\n"; //inform that the list is about to be sorted
    if (!isset($argv[1]) || empty($argv[1])) {
        $sortedPassengerList = sortBy($passengers,'account_id'); 
    }
    else{
        $sortedPassengerList = sortBy($passengers,$argv[1]);  
    }
}catch ( Exception $e ) {
    die( $e->getMessage() );
}
?>