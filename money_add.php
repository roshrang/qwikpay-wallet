<?php
include('config.php');
session_start();

//
$userid=$_SESSION['usr_id'];
//$userid=$_SESSION['userid'];
$useramt=$_POST['amt'];
$suserid=filter_var($userid, FILTER_SANITIZE_NUMBER_INT);
$card_amt=filter_var($useramt, FILTER_SANITIZE_NUMBER_INT);
$usr_nme="";

if(isset($_POST['save_card']))
{
$add_card=$_POST['save_card'];
//echo $add_card;	
}
if(isset($_POST['pay_save_card']))
{
	$svcrd=$_POST['pay_save_card'];
	$stmt = $conn->prepare("SELECT `sv_name`,`sv_num`,`sv_cvv`,`sv_exp` FROM `savecard_details` WHERE `sv_id`=?");
//$stmt->bind_param('i',$scard_number);
if (!$stmt->bind_param("i", $svcrd)) {
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

     echo "Not registered kindly Register First1";
         exit();             
     }
	 else
     {
$stmt->bind_result($sdcard_name,$sdcard_num,$sdcard_cvv,$sdcard_exp); 
$stmt->fetch();
$stmt->close();

/////////////////
$stmt1 = $conn->prepare("SELECT `card_id`,`card_name`,`card_num`,`card_cvv`,`card_exp`,`card_amt` FROM `card_details` WHERE `card_num`=?");
//$stmt->bind_param('i',$scard_number);
if (!$stmt1->bind_param("i", $sdcard_num)) {
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

     echo "Not registered kindly Register First2";
         exit();             
     }
	 else
     {
$stmt1->bind_result($dcard_id,$dcard_name,$dcard_num,$dcard_cvv,$dcard_exp,$dcard_amt); 
$stmt1->fetch();
$stmt1->close();

	
	if($card_amt<$dcard_amt)
	{
		//echo "True";
		$stmt1 = $conn->prepare("UPDATE user_wallet SET `usr_amt` = usr_amt+? WHERE `usr_id` =?");
		if (!$stmt1->bind_param("ii", $card_amt,$suserid)) {
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
$sdes="Money Added through credit card \t";
$sdes .= $sdcard_num;
$sts="Success";		 
$stmt2 = $conn->prepare("INSERT INTO `transaction_details` ( `trn_des`, `trn_usr_id`, `trn_amt`, `trn_sts`, `trn_date`) VALUES ( ?, ?, ?, ?, NOW())");
$stmt2->bind_param("sids",$sdes, $suserid, $card_amt,$sts);
$stmt2->execute();
$stmt2->close();
$stmt3 = $conn->prepare("UPDATE card_details SET `card_amt` = card_amt-? WHERE `card_num` =?");
		if (!$stmt3->bind_param("ii", $card_amt,$sdcard_num)) {
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
	
}
}
}
//session_start();
$_SESSION['success'] = true;

 header('Refresh: 2; URL = success.php');
	}
	else
	{
		$card_number = $_POST['card_number'];
$card_cvv= $_POST['cvv_num'];
$card_name= $_POST['card_name'];
$card_exp= $_POST['exp_date'];
$option=$_POST['option'];
$scard_name=filter_var($card_name, FILTER_SANITIZE_STRING);
$scard_number=filter_var($card_number, FILTER_SANITIZE_NUMBER_INT);
$scard_cvv=filter_var($card_cvv, FILTER_SANITIZE_NUMBER_INT);
$scard_exp=stripslashes($card_exp);
$scard_exp=filter_var($card_exp, FILTER_SANITIZE_NUMBER_INT);
$stmt = $conn->prepare("SELECT `card_id`,`card_name`,`card_num`,`card_cvv`,`card_exp`,`card_amt` FROM `card_details` WHERE `card_num`=?");
//$stmt->bind_param('i',$scard_number);
if (!$stmt->bind_param("i", $scard_number)) {
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
$stmt->bind_result($dcard_id,$dcard_name,$dcard_num,$dcard_cvv,$dcard_exp,$dcard_amt); 
$stmt->fetch();
$stmt->close();
if(($card_name==$dcard_name) &&($card_cvv==$dcard_cvv)&&($scard_exp==$dcard_exp))
{
	//echo "success";
	
	if($card_amt<$dcard_amt)
	{
		//echo "True";
		$stmt1 = $conn->prepare("UPDATE user_wallet SET `usr_amt` = usr_amt+? WHERE `usr_id` =?");
		if (!$stmt1->bind_param("ii", $card_amt,$suserid)) {
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
$sdes="Money Added through credit card \t";
$sdes .= $scard_number;
$sts="Success";
$tpe=1;		 
$stmt2 = $conn->prepare("INSERT INTO `transaction_details` ( `trn_des`, `trn_usr_id`, `trn_amt`, `trn_sts`,trn_type, `trn_date`) VALUES ( ?, ?, ?, ?,?, NOW())");
$stmt2->bind_param("sidsi",$sdes, $suserid, $card_amt,$sts,$tpe);
$stmt2->execute();
$stmt2->close();
$stmt3 = $conn->prepare("UPDATE card_details SET `card_amt` = card_amt-? WHERE `card_num` =?");
		if (!$stmt3->bind_param("ii", $card_amt,$scard_number)) {
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
if(isset($_POST['save_card']))
{
if ($add_card==true)
{
	echo "entered";
$stmt2 = $conn->prepare("INSERT INTO `savecard_details` ( `sv_name`,`sv_num`,`sv_cvv`,`sv_exp`,`sv_usrid`) VALUES ( ?, ?, ?, ?, ?)");
echo $dcard_name;
echo $scard_number;
echo $card_cvv;
echo $card_exp;
echo $suserid;
if (!$stmt2->bind_param("siisi",$dcard_name,$scard_number,$scard_cvv,$scard_exp, $suserid))
{
	 echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
}
$stmt2->execute();
$stmt2->close();
}
}
$conn->close();

//session_start();
$_SESSION['success'] = true;

 header('Refresh: 2; URL = success.php');
	}
	else
	{
		echo "Insufficient Balance";
	}
}
else
{
	echo "details doesn't match please try again later";
}
	 }
	}
?>
