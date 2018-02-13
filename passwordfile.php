<?php
 
function randomPassword($length,$count, $characters) {
 
// $length - the length of the generated password
// $count - number of passwords to be generated
// $characters - types of characters to be used in the password
 
// define variables used within the function    
    $symbols = array();
    $passwords = array();
    $used_symbols = '';
    $pass = '';
 
// an array of different character types    
    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
    $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols["numbers"] = '1234567890';
    $symbols["special_symbols"] = '!?~@#-_+<>[]{}';
 
    $characters = split(",",$characters); // get characters types to be used for the passsword
    foreach ($characters as $key=>$value) {
        $used_symbols .= $symbols[$value]; // build a string with all characters
    }
    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
     
    for ($p = 0; $p < $count; $p++) {
        $pass = '';
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length); // get a random character from the string with all characters
            $pass .= $used_symbols[$n]; // add the character to the password string
        }
        $passwords[] = $pass;
    }
     
    return $pass; // return the generated password
}
 
$my_passwords = randomPassword(64,1,"lower_case,upper_case,numbers,special_symbols");
 
//print_r(str_split($my_passwords));


$splitter=array();
$splittereven='';
$splitterodd='';
$splitter=str_split($my_passwords);
$finalsalt=array();

print_r($splitter);
$k=0;
$j=0;
for($i=0;$i<64;$i++)
{	
	if($i%2==0)
	{
		$splittereven .=$splitter[$i];
		$k++;
	}
	else
	{
		$splitterodd .=$splitter[$i];
		$j++;
	}
	
}

echo "even";
print_r($splittereven);
echo "\n";
echo "odd";
print_r($splitterodd);


$evenshuffle=str_shuffle($splittereven);
$oddshuffle=str_shuffle($splitterodd);


print_r($evenshuffle);
print_r($oddshuffle);


$salt=$evenshuffle.$oddshuffle;

$finalsalt[]=str_shuffle($salt);

echo "final salt";
print_r($finalsalt);



$str="Hello World!";


$str=strrev($str);
$encryptedkey=password_hash($str, PASSWORD_BCRYPT, $finalsalt);

echo "encrypted key";


if (password_verify($str, $encryptedkey))
	{
		echo "Count";
    } else {
		echo "counting";
}



print_r(strrev($encryptedkey));


echo "decrption";



//my_simple_crypt("Hello World",'e',$evenshuffle,$oddshuffle);

function my_simple_crypt( $string, $action = 'e',$evenshuffle,$oddshuffle ) {
    // you may change these values to your own

    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $evenshuffle );
    $iv = substr( hash( 'sha256', $oddshuffle ), 0, 16 );
	
	
	echo "key";
	
	echo $key;
	
	echo "newkey";
	
	echo $iv;

    if( $action == 'e' ) {
        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		echo "hello";
		echo $output;
    }
    else if( $action == 'd' ){
        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
    }

    return $output;
}



 
?>