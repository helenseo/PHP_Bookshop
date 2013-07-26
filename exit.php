
<html>
<body>
<?php
session_start(); 
$_SESSION['userid']=$_POST['userid'];
unset($_SESSION['userid']);

$url = "index.php";
echo "<script language='javascript' type='text/javascript'>";
echo "window.location.href='$url'";
echo "</script>";
?>
</body>
</html>