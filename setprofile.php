<?php
include('config.php');

session_start();
$puser_id=$_SESSION['usr_id'];
$pass = $_POST['pwd1'];
$cpass = $_POST['pwd2'];
$digi= $_POST['fr_digit'];
$subject= $_POST['rndmnum'];
$spass=filter_var($pass, FILTER_SANITIZE_SPECIAL_CHARS);
$scpass=filter_var($cpass, FILTER_SANITIZE_SPECIAL_CHARS);
$sdigi=filter_var($digi, FILTER_SANITIZE_NUMBER_INT);
$suser_id=filter_var($puser_id, FILTER_SANITIZE_NUMBER_INT);


if($spass==$scpass)
{

$options = [
    'cost' => 15,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];

$san_psd=password_hash($spass, PASSWORD_BCRYPT, $options);


$prf_set=1;
//echo $san_psd;
$stmt2 = $conn->prepare("UPDATE user_profile SET `prf_pwd` =?,`prf_code`=?,`prf_set`=? WHERE `prf_usrid`=?");
if (!$stmt2->bind_param("siii",$san_psd, $sdigi, $prf_set,$suser_id)) {
			echo "Binding parameters failed: (" . $stmt2->errno . ") " . $stmt2->error;
					}
$stmt2->execute();
$stmt2->close();
$conn->close();
$msg="0";
header("Location:account.php?msg=$msg");
}
else
{
	$msg="1";
	header("Location:account.php?umsg=$msg");
}
?>