<?php
include('config.php');
include('inp_val.php');
if ( isset($_POST['usr_nme'])&& isset($_POST['usr_email'])   && isset($_POST['pwd1']) && isset($_POST['pwd2']) && isset($_POST['usr_num']) )
{
$name= $_POST['usr_nme'];
$name=input_valid($name);
$email = $_POST['usr_email'];
$email=input_valid($email);
$pwd= $_POST['pwd1'];
$pwd=input_valid($pwd);
$cpwd=$_POST['pwd2'];
$cpwd=input_valid($cpwd);
$number=$_POST['usr_num'];
$san_mne=filter_var($name, FILTER_SANITIZE_STRING);
$san_mail =filter_var($email, FILTER_SANITIZE_EMAIL);
$san_pwd=filter_var($pwd, FILTER_SANITIZE_STRING);
$san_cpwd=filter_var($cpwd, FILTER_SANITIZE_STRING);
if($san_pwd==$san_cpwd)
{
register($san_pwd,$san_cpwd,$san_mail,$san_mne,$number,$conn);
}
else
{
 $msg="7";
	header("Location:registerform.php?msg=$msg"); 
}
}
else
{
$msg="8";
	header("Location:registerform.php?msg=$msg"); 
}
function register($san_pwd,$san_cpwd,$san_mail,$san_mne,$number,$conn)
{
$options = [
    'cost' => 15,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];

$san_psd=password_hash($san_pwd, PASSWORD_BCRYPT, $options);
$san_num=filter_var($number, FILTER_SANITIZE_NUMBER_INT);
$dt = new DateTime();
$dt->format('Y-m-d H:i:s');

$stmt = $conn->prepare("SELECT `usr_email` FROM `user_data` WHERE `usr_email`=?");
$stmt->bind_param("s",$san_mail);

$stmt->execute();
$stmt->store_result();
	
     if ($stmt->num_rows == 1) 
     {

    $msg="9";
	header("Location:registerform.php?msg=$msg"); 
     }
	 else
     {
		 
$stmt = $conn->prepare("INSERT INTO `user_data` ( `usr_name`, `usr_email`, `usr_number`, `usr_password`, `usr_regtime`) VALUES ( ?, ?, ?, ?, NOW())");
$stmt->bind_param("ssss",$san_mne, $san_mail, $san_num,$san_psd);

$stmt->execute();

$stmt->close();

$qcn1="SELECT `usr_id` FROM `user_data` WHERE `usr_email`='$san_mail'"; 
				$result=mysqli_query($conn,$qcn1);
                while($rescn1=mysqli_fetch_array($result))
                {
					$usr_id=$rescn1[0];
				}

$amt=0;
$stmt2 = $conn->prepare("INSERT INTO `user_wallet` ( `usr_id`,`usr_amt`) VALUES ( ?, ?)");
$stmt2->bind_param("id",$usr_id,$amt);
$stmt2->execute();
$stmt2->close();

$stmt3 = $conn->prepare("INSERT INTO `user_profile` ( `prf_usrid`,`prf_set`) VALUES ( ?, ?)");
$stmt3->bind_param("ii",$usr_id,$amt);
$stmt3->execute();
$stmt3->close();
$conn->close();

 session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['usr_nme'] = $san_mne;
	$_SESSION['usr_id'] = $usr_id; 
	
header("location:index.php");
}
}
?>