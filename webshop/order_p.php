<?php
   session_start();
   $userid=$_SESSION['userid'];$msg="";
   $sub=$_POST['act'];   //��ȡ�û���ǰҳ�Ĳ���
   if($sub=="cancel"){   //�û��������ι���ķ����źͲ�������
 $msg=$userid.'Are you sure to cancel?<br/>After clicking the confirm button, cart will be cleared.';
      $button="confirm";
      $url="cart_clear.php";
   }
   else if($sub=="confirm"){   //�û�ȷ�ϱ��ι���ķ����źͲ�������
      $b_ID=$_SESSION['b_ID']; $b_num=$_SESSION['bk_num'];
      $b_money=$_SESSION['b_money'];   //��ȡSESSION����
      $username=$_POST['username'];$post1=$_POST['post_b']; $addr1=$_POST['addr'];
      $phone1=$_POST['phone']; $email1=$_POST['email'];
      $send=$_POST['sendb'];  $fmoney=$_POST['pay'];   //��ȡ�ύ�ı���Ϣ
      require_once('config.inc.php');
	  if(isEmail($email1)==0) $msg.="Wrong email";
	  else if(isPost($post1)==0) $msg.="Wrong post code";
	  else if(isPhone($phone1)==0) $msg.="Wrong phone number";
	  if($msg!="")echo "<meta http-equiv='Refresh' content='0;url=book_order.php?msg=$msg'>"; 
      require_once(Include_Path.'db.inc.php');
      if($fmoney=="member card"){   //�Թ��鿨֧���Ĵ���
      require_once(Include_Path.'user.inc.php');
      $user=new user();
      $serach_u="SELECT * FROM  member_user WHERE userid='".$userid."'";
      $user_s=$user->select($serach_u);    //��ȡ�û���Ϣ
      $msg1=$userid."member card paid<br/>";
      $j=0; $p_money=$b_money;   //���ݱ������ѽ��
      while($p_money>0 && $j<count($user_s)){   //�۳����鿨�������ѵĽ��
         $sql_c="SELECT * FROM member_card WHERE cardno='".$user_s[$j][cardno]."'";
         $card_s=$user->select($sql_c);
         if($card_s[0][balance]>=$p_money){   //һ�Ź��鿨��֧���������ѵĽ��
           $cards=$card_s[0][balance]-$p_money;   //�۳��������ѵĽ��
           $p_money=0;   //��δ���ѽ������Ϊ0
          $serach_c="UPDATE card SET balance=$cards WHERE cardno='".$user_s[$j][cardno]."'";
           $cardu=$user->update($serach_c);   //���¹��鿨�����
           $msg=$msg1."���鿨".$user_s[$j][cardno]."����".$cards."<br/><br/>";
         }
         else{   //һ�Ź��鿨������֧���������ѵĽ��
           $p_money=$p_money-$card_s[0][balance];   //������δ���ѽ��Ϊ0
           $msg1.="���鿨".$user_s[$j][cardno]."���������<br/><br/>"; 
           $serach_c="UPDATE card SET balance=0 WHERE cardno='".$user_s[$j][cardno]."'";
           $cardu=$user->update($serach_c);   //���øù��鿨�Ľ��Ϊ0
           $j++;
         }
       }
     }
     require_once(Include_Path.'control.inc.php');
     $bcob=new control();   //������������
     $sql_o="INSERT INTO order_info(user_name,order_post,order_addr,order_phone,order_mail,order_send,order_fmoney,
	 order_num,order_state,order_money,order_time,order_note) VALUES
	 ('$username','$post1','$addr1','$phone1','$email1','$send','$fmoney',
	 '$b_num','0','$b_money',current_timestamp,'$b_ID')";
     $order_o=(int)$bcob->insert($sql_o);   //����һ���¶��������ص��Ǹü�¼�����кţ���Ϊ������
     $sql_c="UPDATE book_cart SET order_id='".$order_o."' WHERE user_id ='".$userid."'";
     $chat_c=$bcob->update($sql_c);   //�޸Ĺ��鳵��order_ID
     $msg.=$userid."Congratulations!<br/>Your order number is:".$order_o;
	 $sendTo=$email1;   //�����׼�ĵ����ʼ���ַ����ָ���ʼ�Ҫ���͵�����;
     $MsgSubject="Order";   //���ǵ����ʼ���Ϣ������
     $sendHeader="From: admin<sliu15@student.gsu.edu>"."\r\n";   //�����ʼ�ͷ��;
     $MsgBody=$msg;   //������Ϣ�����壬û�д�С����;
     mail($sendto, $MsgSubject, $MsgBody, $sendHeader);   //���͵����ʼ�����
     $button="Check the order details.";
     $url="order.php?order_id=".$order_o.'" target="_blank';
	 $order_s=new control();
	 
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>   
   <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <base target="mainFrame">
   <title>Order confirmation</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
   <div id="appb">
     <div id="bt">Order confirmation
<hr /></div>
     <div id="bb"><?php echo $msg; ?></div>
     <div align="center">
     <form action="<?php echo $url; ?>" method="POST"><input type="submit" value="<?php echo $button; ?>" />
<?php if($button=="Check the order details"){ ?>     
     <input type="submit" value="finished" onclick="window.location.replace('exit.php')" /></form>
<?php }?>
      </div>
    </div>
  </body>
</html>