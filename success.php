<?php
session_start();
 if($_SESSION['success'] == true)
		{
      echo "<h1> Transaction Processing"; 
    echo "<h3>Thank You. Your order status is Success</h3>";
    echo "<h4>We have received your payment.Your money will soon be added to the wallet.</h4>";
	
	header('Refresh: 3; URL = account.php');
	
	$_SESSION['success']==false;
	  unset($_SESSION["success"]);

  } else {
	  echo "<h1> Please Try Again Later";
	  $_SESSION['success']==false;
	  unset($_SESSION["success"]);
	  header('Refresh: 3; URL = account.php');
	
  }         
?>	