<?php
include('config.php');

$email = $_POST['usr_email'];
$pwd= $_POST['usr_pwd'];
$san_mail =filter_var($email, FILTER_SANITIZE_EMAIL);
$san_pwd=filter_var($pwd, FILTER_SANITIZE_STRING);

$usr_nme="";


$stmt = $conn->prepare("SELECT `usr_email` FROM `user_data` WHERE `usr_email`=?");
$stmt->bind_param("s",$san_mail);

$stmt->execute();
$stmt->store_result();
	
     if ($stmt->num_rows == 0) 
     {

     echo "Not registered kindly Register First";
                      
     }
	 else
     {
$stmt = $conn->prepare("SELECT `usr_password`,`usr_name`,`usr_id` FROM `user_data` WHERE `usr_email`=?");
$stmt->bind_param("s",$san_mail);
$stmt->execute();
$stmt->bind_result($usr_password,$usr_nme,$usr_id);


while ($stmt->fetch()) {
	//usr_password
	if (password_verify($san_pwd, $usr_password)) 
	{
		$count=1;
    } else {
		$count=0;
}
}
$stmt->close();
//$stmt->store_result();

//$count=mysqli_stmt_num_rows($stmt);

/*if($count==1){

echo "New records created successfully";
{
    $row = mysql_fetch_assoc($result);
    if (crypt($password, $row['password']) == $row['password']){
        session_register("username");
        session_register("password"); 
        echo "Login Successful";
        return true;
    }
    else {
        echo "Wrong Username or Password";
        return false;
    }
}
}
$stmt->close();*/
$conn->close();
	 }

if($count==1)
{
	 session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['usr_nme'] = $usr_nme;
	$_SESSION['usr_id'] = $usr_id; 
	/*echo "<script>
alert('Welocme');
window.location.href='index.php';
</script>";*/
header("location:index.php");
}
else if($count==0)
{
	$msg="1";
	header("Location:login.php?msg=$msg");

}
else
{
	$msg="1";
	header("Location:login.php?msg=$msg");
}
?>
