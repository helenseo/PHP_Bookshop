<?php
	session_start();  //启动session变量，注意一定要放在首行
	$userid=$_POST["userid"]; //获取表单变量的值
	$password=$_POST["password"];
	$sub=$_POST["sub_login"];
	session_register("userid");  //注册$userid变量，注意没有$符号
	include("sys_conf.inc.php");
	if($sub=="login"){
   	//建立与SQL数据库的连接
	
	
    $connection=@mysql_connect($DBHOST,$DBUSER,$DBPWD) or die("Cannot connect database!");
	@mysql_query("set names 'gb2312'") ;  //设置字符集，防止中文显示乱码
	@mysql_select_db($DBNAME) or die("Cannot connect database!");
	$query="SELECT * FROM member_user  WHERE userid='$userid'";   //查询用户信息
	$result=@mysql_query($query,$connection) or die("Data requests failed1.");
	if($row=mysql_fetch_array($result)){
	  	if($row[password]==$password){ //身份认证成功
			if($userid=="admin")
			{
				$_SESSION['userid']=$_POST['userid'];
				$msg= "Login as an administrator";
				$msg.="<a href='#;onclick=/'windows.close();return false;/''>Back.</a>";
			//echo "<meta http-equiv='Refresh' content='0;url=regindex.php?msg=$msg'>";
				echo "<meta http-equiv='Refresh' content='0;url=../admin/admin_page.php?userid=$userid'>";
			}
			else{
			$_SESSION['userid']=$_POST['userid'];
			$msg= "Login successfully. Go to buy books.";
			$msg.="<a href='#;onclick=/'windows.close();return false;/''>Back.</a>";
			//echo "<meta http-equiv='Refresh' content='0;url=regindex.php?msg=$msg'>";
			echo "<meta http-equiv='Refresh' content='0;url=../index.php?userid=$userid'>";
			}
		}
		else{
			$msg="Wrong password. Please Enter again.";
			echo "<meta http-equiv='Refresh' content='0;url=regindex.php?msg=$msg'>";
		}
	}
	else{
		$msg="Not exist user id, please sign up.";
		echo "<meta http-equiv='refresh' content='0;url=regindex.php?msg=$msg'>";	
	}
	}
	else if($sub=="sign_up")
		echo "<meta http-equiv='refresh' content='0;url=applycard.php'>";
?>