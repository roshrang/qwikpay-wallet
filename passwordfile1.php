<?php
function randomString($length = 6) {
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'),range('!','?'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}
$my_passwords = randomString(64,1,"lower_case,upper_case,numbers,special_symbols");
 
print_r($my_passwords);

?>