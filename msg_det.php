<?php
include('config.php');

$msg = $_POST['message'];
$wallet_number= $_POST['wallet_number'];
$user_id= $_POST['user_id'];
$subject= $_POST['subject'];
$smsg=filter_var($msg, FILTER_SANITIZE_STRING);
$swallet_number=filter_var($wallet_number, FILTER_SANITIZE_NUMBER_INT);
$suser_id=filter_var($user_id, FILTER_SANITIZE_NUMBER_INT);
$ssubject=filter_var($subject, FILTER_SANITIZE_STRING);
$sts="Success";
$stmt2 = $conn->prepare("Insert into msg_details (`susr_id`,`rusr_id`,`msg_sub`,`msg_sts`,`msg_des`,`msg_date`) VALUES ( ?, ?, ?, ?,?, NOW())");
$stmt2->bind_param("iisss",$suser_id,$swallet_number, $ssubject,$sts,$smsg);
$stmt2->execute();
$stmt2->close();
$conn->close();
header("location:account.php");
?>