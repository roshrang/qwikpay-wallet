<?php
include('config.php');

session_start();
$user_id=$_SESSION['usr_id'];
//echo $user_id;
$suser_num = $_GET['wallet_number'];
$mvalue= $_GET['moneyvalue'];
$frndmnum= $_GET['rndmnum'];
$suser_num=filter_var($suser_num, FILTER_SANITIZE_NUMBER_INT);
$mvalue=filter_var($mvalue, FILTER_SANITIZE_NUMBER_INT);
//$scard_exp=stripslashes($card_exp);

//echo $frndmnum;

$stmt= $conn->prepare("SELECT `token_secret`,token_id FROM `user_tokendetails` WHERE `user_id`=? AND value_used=0 order by `token_id` DESC LIMIT 1");
//$stmt->bind_param('i',$scard_number);
if (!$stmt->bind_param("i", $user_id)) {
    echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
}

if (!$stmt->execute()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}
//$stmt->store_result();
if (!$stmt->store_result()) {
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
}	
     if ($stmt->num_rows == 0) 
     {

     echo "Not registered kindly Register First";
         exit();             
     }
	 else
     {
$stmt->bind_result($sec_token,$tokenid); 

//echo $sec_token;
//echo $tokenid;
$stmt->fetch();
$stmt->close();
if($sec_token==$frndmnum)
{
	//echo "entered";
	
	$stmt3 = $conn->prepare("UPDATE user_tokendetails SET `value_used` = 1 WHERE `token_id` =?");
		if (!$stmt3->bind_param("i",$tokenid)) {
    echo "Binding parameters failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
if (!$stmt3->execute()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
//$stmt->store_result();
if (!$stmt3->store_result()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}

//$stmt1->bind_result($ucart_amt); 
$stmt3->fetch();
//$stmt->close();
$stmt3->close();
	
	$stmt1 = $conn->prepare("SELECT `usr_amt`,`wallet_id` FROM `user_wallet` WHERE `usr_id`=?");
	
	if (!$stmt1->bind_param("i",$user_id)) {
    echo "Binding parameters failed: (" . $stmt1->errno . ") " . $stmt1->error;
	}
if (!$stmt1->execute()) {
    echo "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
	}
//$stmt->store_result();
if (!$stmt1->store_result()) {
    echo "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
	}
	 if ($stmt1->num_rows == 0) 
     {

     echo "Not registered kindly Register First";
         exit();             
     }
	 else
     {
$stmt1->bind_result($wllet_amt,$wallet_iduser); 
$stmt1->fetch();
$stmt1->close();
	
	
	if($wllet_amt>=$mvalue)
	{
		$stmt1 = $conn->prepare("UPDATE user_wallet SET `usr_amt` = usr_amt+? WHERE `usr_id` =?");
		if (!$stmt1->bind_param("ii", $mvalue,$suser_num)) {
    echo "Binding parameters failed: (" . $stmt1->errno . ") " . $stmt1->error;
}
if (!$stmt1->execute()) {
    echo "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
}
//$stmt->store_result();
if (!$stmt1->store_result()) {
    echo "Execute failed: (" . $stmt1->errno . ") " . $stmt1->error;
}

//$stmt1->bind_result($ucart_amt); 
$stmt1->fetch();
//$stmt->close();
$stmt1->close();
$stmt2 = $conn->prepare("UPDATE user_wallet SET `usr_amt` = usr_amt-? WHERE `usr_id` =?");
if (!$stmt2->bind_param("ii", $mvalue,$user_id)) {
    echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
}
if (!$stmt2->execute()) {
    echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
}
//$stmt->store_result();
if (!$stmt2->store_result()) {
    echo "Execute failed: (" . $stmt2->errno . ") " . $stmt2->error;
}

//$stmt1->bind_result($ucart_amt); 
$stmt2->fetch();
//$stmt->close();
$stmt2->close();
//session_start();
$_SESSION['success'] = true;

$ddes=$mvalue."Value transferred to other wallet";
$sts="Success";

$cdes=$mvalue."Value added to wallet";
$stmt2 = $conn->prepare("INSERT INTO `transaction_details` ( `trn_des`, `trn_usr_id`, `trn_amt`, `trn_sts`, `trn_date`) VALUES ( ?, ?, ?, ?, NOW())");
//$stmt2->bind_param("sids",$cdes, $suser_num, $mvalue,$sts);
if (!$stmt2->bind_param("sids",$cdes, $suser_num, $mvalue,$sts)) {
    echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
}
$stmt2->execute();
$stmt2->close();

$stmt1 = $conn->prepare("INSERT INTO `transaction_details` ( `trn_des`, `trn_usr_id`, `trn_amt`, `trn_sts`, `trn_date`) VALUES ( ?, ?, ?, ?, NOW())");
$stmt1->bind_param("sids",$ddes, $user_id, $mvalue,$sts);
$stmt1->execute();
$stmt1->close();
$conn->close();



 header('Refresh: 2; URL = success.php');
	}
	else
	{
	 header('Refresh: 2; URL = sendmoney.php?msg=2');
	}
}
}
else
{
	 header('Refresh: 2; URL = account.php?inccrt=7');
}
	 }
?>