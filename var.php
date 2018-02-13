<?php

include('inp_val.php');
$inpvar="  Hello  @#!  ";

$inpvar=input_valid($inpvar);

echo $inpvar;
?>