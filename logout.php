<?php
   session_start();
   unset($_SESSION["loggedin"]);
   unset($_SESSION["usr_nme"]);
   unset($_SESSION['usr_id']); 
   //echo 'Successfully Logged Out';
   header('Refresh: 2; URL = index.php');
?>