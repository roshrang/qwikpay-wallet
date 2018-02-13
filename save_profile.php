<?php
include('config.php');
session_start();
$user_id=$_SESSION['usr_id'];
if(isset($_POST['id']))
{
$id=$_POST['id'];
$email = $_POST['usr_email'];
$san_mail =filter_var($email, FILTER_SANITIZE_EMAIL);
$ppwd=$_POST['pwd3'];
$san_ppwd=filter_var($ppwd, FILTER_SANITIZE_STRING);
$stmt4 = $conn->prepare("SELECT `prf_pwd` FROM `user_profile` WHERE `prf_usrid`=?");
	  $stmt4->bind_param("i", $user_id); 
      $stmt4->execute();
	  $stmt4->bind_result($prf_pwd); 
	  $stmt4->fetch();
	  $stmt4->close();
	  
	  if (password_verify($san_ppwd, $prf_pwd)) 
	{
		$count=1;
		//echo $count;
    } else 
	{
		$count=0;
		//echo $count;
	}
	if($id==1 && $count==1)
	{
		changenumber($user_id,$conn);
	}
	if($id==2 && $count==1)
	{
	changepassword();
	}
	if($id==3 && $count==1)
	{
	removecard($user_id,$conn);
	}
}
else
{
	header("Location:account.php?inccrt=$4");
}
function changepassword()
{
$user_id=$_SESSION['usr_id'];
$pwd= $_POST['pwd1'];
$cpwd=$_POST['pwd2'];
$san_pwd=filter_var($pwd, FILTER_SANITIZE_STRING);
$san_cpwd=filter_var($cpwd, FILTER_SANITIZE_STRING);
if($san_pwd==$san_cpwd)
{
$options = [
    'cost' => 15,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];

$san_psd=password_hash($san_pwd, PASSWORD_BCRYPT, $options);

//echo $san_psd;
//echo $user_id;
$conn = new mysqli("localhost", "root", "", "websec_recharge");
$stmt3 = $conn->prepare("UPDATE user_data SET `usr_password` = ? WHERE `usr_id` =?");
		if (!$stmt3->bind_param("si", $san_psd,$user_id)) {
    echo "Binding parameters failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
if (!$stmt3->execute()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
if (!$stmt3->store_result()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}

$stmt3->fetch();
$stmt3->close();
$msg=2;
header("Location:account.php?inccrt=$msg");
}
else
{
	$msg=5;
	//echo "51";
header("Location:account.php?inccrt=$msg");
}
}

function removecard($user_id,$conn)
{
		echo "entered";
		$value=$_POST['cval'];
		for($i=0;$i<$value;$i++)
		{
		$para="pay_save_card".$i;
		$stmt3 = $conn->prepare("UPDATE `savecard_details` SET `IsActive` = 0 WHERE `sv_id` =?");
		if (!$stmt3->bind_param("i", $_POST[$para])) {
    echo "Binding parameters failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
if (!$stmt3->execute()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
if (!$stmt3->store_result()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}

$stmt3->fetch();
$stmt3->close();
$msg=3;
		}
		header("Location:account.php?inccrt=$msg");
}

function changenumber($user_id,$conn)
{
		$ch_num=$_POST['ch_num'];
$ch_num=filter_var($ch_num, FILTER_SANITIZE_NUMBER_INT);
$stmt3 = $conn->prepare("UPDATE user_data SET `usr_number` = ? WHERE `usr_id` =?");
		if (!$stmt3->bind_param("ii", $ch_num,$user_id)) {
    echo "Binding parameters failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
if (!$stmt3->execute()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}
if (!$stmt3->store_result()) {
    echo "Execute failed: (" . $stmt3->errno . ") " . $stmt3->error;
}

$stmt3->fetch();
$stmt3->close();
$msg=1;
		header("Location:account.php?inccrt=$msg");
	}



