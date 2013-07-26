<?php
   session_start();
   $userid=$_SESSION['userid'];   //启动会话
   require_once('config.inc.php');
   require_once('include/db.inc.php');
   require_once('include/control.inc.php');   //请求包含相应类的文件
   $bookbmm=$_POST['bookbm']; $booknumm=$_POST['booknum'];   //获取提交表单的数据
   $page=$_GET['page'];   //获取URL传递的数据
   $userIP=$_SERVER[REMOTE_ADDR];   //获取用户的IP地址，以识别用户
   $chat=new control();   //创建购物车对象
   if(is_array($booknumm)){   //处理用户更改了购买数量
      foreach($booknumm as $key => $value) {
         $DTname="book_cart";$serach="(cart_session_id ='".$userIP."' and book_id=".$key.")";
         $chatss=$chat->GetDTdataset($DTname,$serach);   //获取购物车信息
         if((int)$value<=0)
           $msg1.="Selected Books".$key."number should be integer number<br/>";
         else if((int)$value<>$chatss[0][buy_num]){
            $sql ="UPDATE book_cart SET buy_num=".$value." WHERE ".$serach_c;
            $pp=$chat->update($sql);
            $msg1.="Selected Books".$key."Change Sccessced<br/>";
         }
      }
   }
    if(is_array($bookbmm)){   //处理用户选中取消复选框
      foreach($bookbmm as $key => $value){
         if($value=="del"){
           $sql="DELETE FROM book_cart WHERE (cart_session_id ='".$userIP."' AND book_id=".$key.") ";
           $pp=$chat->delete($sql);
           $sql= "ALTER TABLE book_cart DROP cart_id "; 
           $pp=$chat->delete($sql);
           $sql="ALTER TABLE book_cart ADD cart_id INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST" ;
           $pp=$chat->delete($sql);
           $msg1.="Selected Books".$key."Order Canceled<br/>";
        }
      }
   }
   if($msg1=="") $msg1="Please select Change Method<br/>";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Change Order</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="appb">
      <div id="bt">Change Order<hr /></div>
      <table width="600" border="0" cellspacing="0" class="tdl">
        <tr id="bb" align="center"><td colspan="3"><?php echo $msg1; ?></td></tr>
        <tr><td align="left"><form method="post" action="cart_check.php?<?php echo $page; ?> "><input type="submit" value="Back&lt;&lt;"></form></td></tr>
    </table>
    </div>
  </body>
</html>