<?php
   session_start();
   $userid=$_SESSION['userid'];   //启动会话
   $userIP=$_SERVER[REMOTE_ADDR];   //获取用户的IP地址，以识别用户
   $button=$_POST['sub'];
   require_once('config.inc.php');
   require_once('include/db.inc.php');
   require_once('include/control.inc.php');   //请求包含相应类的文件
   $chats=new control();
   $DTname="book_cart";$serach="cart_session_id ='".$userIP."'";
   $chat_s=$chats->GetDTdataset($DTname,$serach);   //获取购物车信息
   if(count($chat_s)==0){   //确认购物车上是否有图书
     $msg="Empty shopping cart.<br/>No book selected.";
     $submit="Back";
     $url="../index.php";
   }
   else{   //确认购物车上的图书是否已经生成订单
     $count=0;
     for($i=0;$i<count($chat_s);$i++){
      if($chat_s[$i][order_id]==0)  $count++;   //0表示未生成订单
     }
     if($count==0) {   //购物车上的图书已经生成订单
      $msg="Clear shopping cart.<br/>Selected book".count($chat_s)."order placed.";
      $submit="confirm";
      $url="cart_clear.php";
     }
     else{   //购物车上的图书未生成订单
      $msg="clear cart?<br/>Selected book".$count."didn't ordered.";
      $submit="confirm";
      $url="cart_clear.php";
     }
   }
   if($button=="confirm"){   //用户确认要清除购物车
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