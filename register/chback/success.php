<?php
   session_start();
   $_SESSION['userid']=$_POST['userid'];
   $title="ע�����";
?>
<?php require_once("reghead.php"); ?>
<?php 
   $userid=$_POST["userid"]; $cardno=$_POST["cardno"]; $cash=$_POST["cash"];
   $username=$_POST["username"]; $password=$_POST["password"];
   $email=$_POST["email"]; $addr=$_POST["addr"];
   $post=$_POST["post"]; $phone=$_POST["phone"];
   include("sys_conf.inc");
   $connection=@mysql_connect($DBHOST,$DBUSER,$DBPWD) or die("�޷��������ݿ⣡");
   @mysql_query("set names 'gb2312'") ;
   @mysql_select_db("member") or die("�޷�ѡ�����ݿ⣡");
   $query="SELECT * FROM userinfo WHERE userid='$userid'"; 
   $result=@mysql_query($query,$connection) or die("���ʧ�ܣ�1");
   if($row=mysql_fetch_array($result)){
      $msg="�û�Աid�Ѿ�����ʹ��,��������д";
      echo "<meta http-equiv='Refresh' content='0;url=applysrc.php?msg=$msg'>";
   }
   //������Աid�͹��￨�ŵ���ϵ
   if($cardno!=""){
      $query="INSERT INTO usercard (userid,cardno) VALUES ('$userid','$cardno')";
      $result=@mysql_query($query,$connection) or die("�������ݿ�ʧ�ܣ�");
      //�޸Ŀ���״̬
      $query="UPDATE card SET cardstatus ='N' WHERE cardno='$cardno'";  
      $result=@mysql_query($query,$connection) or die("�������ݿ�ʧ�ܣ�");
   }
   //�����»�Ա���
   $time=Date("Y"). "��" .Date("n"). "��".Date("j") . "��" .Date("G"). ":" .Date("i");
   $query="INSERT INTO userinfo(userid,username,password,email,address,post,phone,createtime)"; 
   $query.=" VALUES ('$userid','$username','$password','$email','$addr','$post','$phone','$time')";
   $result=@mysql_query($query,$connection) or die("�������ݿ�ʧ�ܣ�");
   mysql_close($connection) or  die("�ر����ݿ�ʧ�ܣ�");
   //��ʾ����ɹ���Ϣ
   $msg="���Ļ�Ա��Ϊ:".$userid."<br/>";
   if($cardno!=""){
       $msg.="���鿨�ţ�".$cardno."<br/>";
       $msg.="���ý�".$cash;
   }
?>
    <div id="err">ע�Ṻ�鿨|��д��Ա��Ϣ|���</div>
    <div id="bt">��ϲ���Ѿ����������������<hr /></div>
    <div id="bd" class="tdl" align="center"><?php echo $msg; ?></div>
     <hr/>
     <iframe scrolling="no" width="780" height="60" src="regbottom.html"  marginwidth="0" marginheight="0" border="0" frameborder="0" align="center" >��֧��</iframe>
   </div>
  </body>
</html>