

<?php
   session_start();
   $_SESSION['userid']=$_POST['userid'];
   $title="finished register.";
?>
<?php 
   $userid=$_POST["userid"]; $cardno=$_POST["cardno"]; $cash=$_POST["cash"];
   $username=$_POST["username"]; $password=$_POST["password"];
   $email=$_POST["email"]; $addr=$_POST["addr"];
   $post=$_POST["post"]; $phone=$_POST["phone"];
	/*if(preg_match("/^[\-a-zA-Z][\-\w]{3,29}$/",$userid)==0){
	   $msg="Wrong userid！";
	   echo "<meta http-equiv='Refresh' content='0;url=sign_up.php?msg=$msg'>";
   }
   if(preg_match("/^[\w]{6,20}$/",$password)==0){
	   $msg="Wrong password";
	   echo "<meta http-equiv='Refresh' content='0;url=sign_up.php?msg=$msg'>";
   }
   include("sys_conf.inc");
   if($email!="" && isEmail($email)==0){
	   $msg="Wrong email";
	   echo "<meta http-equiv='Refresh' content='0;url=sign_up.php?msg=$msg'>";
   }
   if($post!="" && isPost($post)==0){
	   $msg="Wrong post code";
	   echo "<meta http-equiv='Refresh' content='0;url=sign_up.php?msg=$msg'>";
   }
   if($phone!="" && isPhone($phone)==0){
	   $msg="Wrong phone number";
	   echo "<meta http-equiv='Refresh' content='0;url=sign_up.php?msg=$msg'>";
   }*/
      
   
   $connection=@mysql_connect("localhost","c63702","1db23") or die("Cannot connect database!");
   @mysql_query("set names 'gb2312'") ;
   @mysql_select_db("c63702") or die("Cannot connect database!");
	
   $query="SELECT * FROM member_user WHERE userid='$userid'"; 
   $result=@mysql_query($query,$connection) or die("View failed.1");
   if(mysql_fetch_array($result)==1){
      $msg="User id already exists in database, please use another one!";
      echo "<meta http-equiv='Refresh' content='0;url=sign_up.php?msg=$msg'>";
	  echo $msg;
   }
   //建立会员id和购物卡号的联系
   if($cardno!=""){
      $query="INSERT INTO member_card (userid,cardno) VALUES ('$userid','$cardno')";
      $result=@mysql_query($query,$connection) or die("存入数据库失败！");
      //修改卡号状态
      $query="UPDATE member_card SET cardstatus ='N' WHERE cardno='$cardno'";  
      $result=@mysql_query($query,$connection) or die("存入数据库失败！");
   }
   //建立新会员身份
   $time=Date("Y").Date("n").Date("j").Date("G").Date("i");
   $query="INSERT INTO member_user(userid,username,password,email,addr,post,phone,createtime)"; 
   $query.=" VALUES ('$userid','$username','$password','$email','$addr','$post','$phone','$time')";
   $result=@mysql_query($query,$connection) or die("Failed intert data.");
   mysql_close($connection) or  die("Failed to connect data！");
   //显示申请成功信息
   $msg=$userid."<br/>"; //"Your user id: ".
   if($cardno!=""){
       $msg.="购书卡号：".$cardno."<br/>";
       $msg.="可用金额：".$cash;
   }
?>
    <div id="err">Sign up successfully.</div>
    <div id="bt">Congratulations!<hr /></div>
	<div><a href="regindex.php"/>Login now!</div>
    <div id="bd" class="tdl" align="center"><?php echo $msg; ?></div>
     <hr/>
     <iframe scrolling="no" width="780" height="60" src="regbottom.php"  marginwidth="0" marginheight="0" border="0" frameborder="0" align="center" >Not support</iframe>
   </div>
  </body>
</html>