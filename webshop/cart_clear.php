<?php
   session_start();
   $userid=$_SESSION['userid'];   //�����Ự
   $userIP=$_SERVER[REMOTE_ADDR];   //��ȡ�û���IP��ַ����ʶ���û�
   $button=$_POST['sub'];
   require_once('config.inc.php');
   require_once('include/db.inc.php');
   require_once('include/control.inc.php');   //���������Ӧ����ļ�
   $chats=new control();
   $DTname="book_cart";$serach="cart_session_id ='".$userIP."'";
   $chat_s=$chats->GetDTdataset($DTname,$serach);   //��ȡ���ﳵ��Ϣ
   if(count($chat_s)==0){   //ȷ�Ϲ��ﳵ���Ƿ���ͼ��
     $msg="Empty shopping cart.<br/>No book selected.";
     $submit="Back";
     $url="../index.php";
   }
   else{   //ȷ�Ϲ��ﳵ�ϵ�ͼ���Ƿ��Ѿ����ɶ���
     $count=0;
     for($i=0;$i<count($chat_s);$i++){
      if($chat_s[$i][order_id]==0)  $count++;   //0��ʾδ���ɶ���
     }
     if($count==0) {   //���ﳵ�ϵ�ͼ���Ѿ����ɶ���
      $msg="Clear shopping cart.<br/>Selected book".count($chat_s)."order placed.";
      $submit="confirm";
      $url="cart_clear.php";
     }
     else{   //���ﳵ�ϵ�ͼ��δ���ɶ���
      $msg="clear cart?<br/>Selected book".$count."didn't ordered.";
      $submit="confirm";
      $url="cart_clear.php";
     }
   }
   if($button=="confirm"){   //�û�ȷ��Ҫ������ﳵ
     $sql=" DELETE FROM book_cart WHERE cart_session_id ='$userIP'";
     $chats->delete($sql);
     $sql= "ALTER TABLE book_cart DROP cart_id;"; 
     $chats->delete($sql);
     $sql= "ALTER TABLE book_cart ADD cart_id INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;" ;
     $chats->delete($sql);
     $msg="cart cleared.<br/>No book in shopping cart.";
     $submit="back";
     $url="../index.php";
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head> 
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Clear shopping cart</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="appb">
      <div id="bt">Clear shopping cart<hr /></div>
      <table width="600" border="0" cellspacing="0" class="tdl">
        <tr id="bb" align="center"><td colspan="2"><?php echo $msg; ?></td></tr>
        <tr align="center"><td><form method="post" action="<?php echo $url; ?>"><input type="submit" name="sub" value="<?php echo $submit; ?>"></form></td>
<?php if($count<>0){ ?>
           <td align="right"><form  method="post" action="cart_check.php?<?php echo $page; ?>"><input type="submit" value="chech cart&gt;&gt;"></form></td>
<?php } ?>
        </tr> 
      </table>
    </div>
  </body>
</html>