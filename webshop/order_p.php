<?php
   session_start();
   $userid=$_SESSION['userid'];$msg="";
   $sub=$_POST['act'];   //获取用户对前页的操作
   if($sub=="cancel"){   //用户放弃本次购书的反馈信和操作设置
 $msg=$userid.'Are you sure to cancel?<br/>After clicking the confirm button, cart will be cleared.';
      $button="confirm";
      $url="cart_clear.php";
   }
   else if($sub=="confirm"){   //用户确认本次购书的反馈信和操作设置
      $b_ID=$_SESSION['b_ID']; $b_num=$_SESSION['bk_num'];
      $b_money=$_SESSION['b_money'];   //获取SESSION变量
      $username=$_POST['username'];$post1=$_POST['post_b']; $addr1=$_POST['addr'];
      $phone1=$_POST['phone']; $email1=$_POST['email'];
      $send=$_POST['sendb'];  $fmoney=$_POST['pay'];   //获取提交的表单信息
      require_once('config.inc.php');
	  if(isEmail($email1)==0) $msg.="Wrong email";
	  else if(isPost($post1)==0) $msg.="Wrong post code";
	  else if(isPhone($phone1)==0) $msg.="Wrong phone number";
	  if($msg!="")echo "<meta http-equiv='Refresh' content='0;url=book_order.php?msg=$msg'>"; 
      require_once(Include_Path.'db.inc.php');
      if($fmoney=="member card"){   //对购书卡支付的处理
      require_once(Include_Path.'user.inc.php');
      $user=new user();
      $serach_u="SELECT * FROM  member_user WHERE userid='".$userid."'";
      $user_s=$user->select($serach_u);    //获取用户信息
      $msg1=$userid."member card paid<br/>";
      $j=0; $p_money=$b_money;   //备份本次消费金额
      while($p_money>0 && $j<count($user_s)){   //扣除购书卡本次消费的金额
         $sql_c="SELECT * FROM member_card WHERE cardno='".$user_s[$j][cardno]."'";
         $card_s=$user->select($sql_c);
         if($card_s[0][balance]>=$p_money){   //一张购书卡能支付本次消费的金额
           $cards=$card_s[0][balance]-$p_money;   //扣除本次消费的金额
           $p_money=0;   //尚未付费金额设置为0
          $serach_c="UPDATE card SET balance=$cards WHERE cardno='".$user_s[$j][cardno]."'";
           $cardu=$user->update($serach_c);   //更新购书卡的余额
           $msg=$msg1."购书卡".$user_s[$j][cardno]."内余额：".$cards."<br/><br/>";
         }
         else{   //一张购书卡不足以支付本次消费的金额
           $p_money=$p_money-$card_s[0][balance];   //设置尚未付费金额为0
           $msg1.="购书卡".$user_s[$j][cardno]."内已无余额<br/><br/>"; 
           $serach_c="UPDATE card SET balance=0 WHERE cardno='".$user_s[$j][cardno]."'";
           $cardu=$user->update($serach_c);   //设置该购书卡的金额为0
           $j++;
         }
       }
     }
     require_once(Include_Path.'control.inc.php');
     $bcob=new control();   //创建订单对象
     $sql_o="INSERT INTO order_info(user_name,order_post,order_addr,order_phone,order_mail,order_send,order_fmoney,
	 order_num,order_state,order_money,order_time,order_note) VALUES
	 ('$username','$post1','$addr1','$phone1','$email1','$send','$fmoney',
	 '$b_num','0','$b_money',current_timestamp,'$b_ID')";
     $order_o=(int)$bcob->insert($sql_o);   //生成一个新订单，返回的是该记录的序列号，作为订单号
     $sql_c="UPDATE book_cart SET order_id='".$order_o."' WHERE user_id ='".$userid."'";
     $chat_c=$bcob->update($sql_c);   //修改购书车的order_ID
     $msg.=$userid."Congratulations!<br/>Your order number is:".$order_o;
	 $sendTo=$email1;   //这个标准的电子邮件地址用于指明邮件要发送到哪里;
     $MsgSubject="Order";   //这是电子邮件消息的主题
     $sendHeader="From: admin<sliu15@student.gsu.edu>"."\r\n";   //电子邮件头标;
     $MsgBody=$msg;   //这是消息的主体，没有大小限制;
     mail($sendto, $MsgSubject, $MsgBody, $sendHeader);   //发送电子邮件函数
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