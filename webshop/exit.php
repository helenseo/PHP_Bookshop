<?php
session_start(); 
$_SESSION['userid']=$_POST['userid'];
unset($_SESSION['userid']);
header("Location:index.php");
exit;
?>