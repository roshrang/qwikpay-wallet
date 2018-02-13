<?php
include('config.php');
$san_mail="parthu_rangwani@gmail.com";
$qry = $conn->query("SELECT usr_password`,`usr_name`,`usr_id` FROM `user_data` WHERE `usr_email`='$san_mail'");
$result = $qry->fetch();
$id = $result['Auto_Increment'];
echo $id."<br>Hello world";

