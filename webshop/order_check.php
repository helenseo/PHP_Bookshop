<?php
   session_start();
   $userid=$_SESSION['userid'];
   $userIP=$_SERVER[REMOTE_ADDR];   //获取用户的IP地址，以识别用户
   require_once('config.inc.php');
   require_once(Include_Path.'db.inc.php');
   require_once(Include_Path.'control.inc.php');
   $bcob=new control();
   $DTname="book_cart";$serach="cart_seesion_id ='".$userIP."'";
   $chat_s=$bcob->GetDTdataset($DTname,$serach);   //获取购书车信息
   if(count($chat_s)==0){   //确认购书车上无图书的反馈和操作设置
      $msg="No book in the cart";
      $submit="home";
      $url="../main.php";
   }
   else{   //确认购书车上有图书
      if($userid==""){   //设置用户没有登录的反馈和操作
         $msg="Not Login<br/>Please login before confirm the order";
         $submit="login";
         $url="'../register/regindex.php' target='_blank'";
      }
      else{   //设置用户登录的反馈和操作
         $msg="Confirm Order?";
         $submit="Confirm";
         $url="'book_order.php' target='_blank'";
      }
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Order Placement Feedback Information</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="appb">
      <div id="bt">Order Placement Feedback Information<hr /></div>
      <table width="600" border="0" cellspacing="0" class="tdl">
        <tr id="bb" align="center"><td colspan="2"><?php echo $msg; ?></td></tr>
        <tr align="center"> <td><form method="post" action=<?php echo $url; ?> ><input type="submit" name="sub" value="<?php echo $submit; ?>"onmousedown="window.close();"></form></td></tr> 
      </table>
    </div>
  </body>
</html>