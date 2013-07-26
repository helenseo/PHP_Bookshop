<?php
   $userid=$_POST["userid"]; $select=$_POST["select"];
   $cardpsd=$_POST["cardpsd"];   $cardno=$_POST["cardno"];
    if($select=="跳过")
      echo "<meta http-equiv='Refresh' content='0;url=applysrc.php'>";
   if($select=="下一步"){
     //建立与SQL数据库的连接
     require_once("sys_conf.inc");
     $connection=@mysql_connect($DBHOST,$DBUSER,$DBPWD) or die("无法连接数据库！");
     @mysql_query("set names='gb2312'") ;
     @mysql_select_db("member") or die("无法选择数据库！");
     $query="SELECT * FROM usercard WHERE userid='$userid'"; 
     $result=@mysql_query($query,$connection) or die("浏览失败！1");//向数据库发送查询请求
     //读取记录数据,分类保存
     if($row=mysql_fetch_array($result) ){
        $msg="该会员id已经被人使用,请重新填写";
        echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
     }
     else{
        $query="SELECT * FROM `card` WHERE  cardno='$cardno'"; 
        $result=@mysql_query($query,$connection) or die("浏览失败！2");
        if ($row=mysql_fetch_array($result)){
           if($row[cardstatus]=="N"){
              $msg="该卡不能使用！";
              echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
           }
           elseif($row[cardpsd]==$cardpsd){
              include("applysrc.php");
           }
           else{
              $msg="密码错误，请重新输入！";
              echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
           }
        }
        else{
           $msg="不存在该卡号，请重新输入";
           echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
        }
     }
   }
?>