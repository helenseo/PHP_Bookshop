<?php
	session_start();  //����session������ע��һ��Ҫ��������
	$userid=$_POST["userid"]; //��ȡ��������ֵ
	$password=$_POST["password"];
	$sub=$_POST["sub_login"];
	session_register("userid");  //ע��$userid������ע��û��$����
	include("sys_conf.inc.php");
	if($sub=="login"){
   	//������SQL���ݿ������
	
	
    $connection=@mysql_connect($DBHOST,$DBUSER,$DBPWD) or die("Cannot connect database!");
	@mysql_query("set names 'gb2312'") ;  //�����ַ�������ֹ������ʾ����
	@mysql_select_db($DBNAME) or die("Cannot connect database!");
	$query="SELECT * FROM member_user  WHERE userid='$userid'";   //��ѯ�û���Ϣ
	$result=@mysql_query($query,$connection) or die("Data requests failed1.");
	if($row=mysql_fetch_array($result)){
	  	if($row[password]==$password){ //�����֤�ɹ�
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