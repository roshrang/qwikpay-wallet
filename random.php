<?php
 
function randomPassword($length,$count, $characters) {
   
    $symbols = array();
    $passwords = array();
    $used_symbols = '';
    $pass = '';
   
    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
    $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols["numbers"] = '1234567890';
    $symbols["special_symbols"] = '!?~@#-_+[]{}';
 
    $characters = split(",",$characters);
    foreach ($characters as $key=>$value) {
        $used_symbols .= $symbols[$value];
    }
    $symbols_length = strlen($used_symbols) - 1;
     
    for ($p = 0; $p < $count; $p++) {
        $pass = '';
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length);
            $pass .= $used_symbols[$n];
        }
        $passwords[] = $pass;
    }
     
    return $pass;
}
