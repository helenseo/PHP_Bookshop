<?php
   $userid=$_POST["userid"]; $select=$_POST["select"];
   $cardpsd=$_POST["cardpsd"];   $cardno=$_POST["cardno"];
    if($select=="����")
      echo "<meta http-equiv='Refresh' content='0;url=applysrc.php'>";
   if($select=="��һ��"){
     //������SQL���ݿ������
     require_once("sys_conf.inc");
     $connection=@mysql_connect($DBHOST,$DBUSER,$DBPWD) or die("�޷��������ݿ⣡");
     @mysql_query("set names='gb2312'") ;
     @mysql_select_db("member") or die("�޷�ѡ�����ݿ⣡");
     $query="SELECT * FROM usercard WHERE userid='$userid'"; 
     $result=@mysql_query($query,$connection) or die("���ʧ�ܣ�1");//�����ݿⷢ�Ͳ�ѯ����
     //��ȡ��¼����,���ౣ��
     if($row=mysql_fetch_array($result) ){
        $msg="�û�Աid�Ѿ�����ʹ��,��������д";
        echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
     }
     else{
        $query="SELECT * FROM `card` WHERE  cardno='$cardno'"; 
        $result=@mysql_query($query,$connection) or die("���ʧ�ܣ�2");
        if ($row=mysql_fetch_array($result)){
           if($row[cardstatus]=="N"){
              $msg="�ÿ�����ʹ�ã�";
              echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
           }
           elseif($row[cardpsd]==$cardpsd){
              include("applysrc.php");
           }
           else{
              $msg="����������������룡";
              echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
           }
        }
        else{
           $msg="�����ڸÿ��ţ�����������";
           echo "<meta http-equiv='Refresh' content='0;url=applycard.php?msg=$msg'>";
        }
     }
   }
?>