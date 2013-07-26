<?php
   session_start();
   $userid=$_SESSION['userid'];   //启动会话
   require_once('config.inc.php');
   require_once('include/db.inc.php');
   require_once('include/control.inc.php');   //请求包含相应类的文件
   $bookbmm=$_POST['bookbm']; $booknumm=$_POST['buynum'];   //获取提交表单的数据
   $title=$_GET['title']; $serach=$_GET['serach']; 
   $pp=$_GET['pp'];$page=$_GET['page'];   //获取URL传递的数据
   $url="book_show.php?title=$title&&pp=$pp&&serach=$serach&&page=$page";
   $userIP=$_SERVER[REMOTE_ADDR];   //获取用户的IP地址，以识别用户
   $chat=new control();   //创建购物车对象
   if(is_array($bookbmm)){   //判断用户是否选中了要购买的图书
      foreach($bookbmm as $key => $value) {   //寻找并处理被选中的图书
         $serach="(cart_session_id ='".$userIP."' AND book_id=".$key.")";
         if($value=="sel"){
           if($booknumm[$key]<1)  $msg1.="book selected".$key."number should be int.<br/>";
           else{
               $DTname="book_cart";
               $chat_s=$chat->GetDTdataset($DTname,$serach);   //查询用户是否已经选购过这本书
               if(count($chat_s)==0){   //没有选购的处理
                  $sql= "INSERT INTO book_cart(user_id, book_id, buy_num,cart_session_id) VALUES ('$userid', '$key', '$booknumm[$key]', '$userIP')";
                  $pp=$chat->insert($sql);   //插入到购物车表中
               }
               else{   //选购过的处理
                  $booknu=$chat_s[0][buy_num]+$booknumm[$key];
                  $sql ="UPDATE book_cart SET buy_num=".$booknu." WHERE".$serach;
                  $pp=$chat->update($sql);   //以累加值更新购书数量
               }
               if($pp) $msg1.="book selected".$key."added successed.<br/>";   //成功操作后的反馈信息
            }
         }
       }
   }
   else
       $msg1.="Didn't select any books.<br/>";   //没有选中图书的反馈信息
?>   
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Books display</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="appb">
     <div id="bt">Book order feedback information<hr /></div>
     <table width="600" border="0" cellspacing="0" class="tdl">
       <tr id="bb" align="center"><td colspan="3"><?php echo $msg1; ?></td></tr>
        <tr><td align="right"><form method="post" action="<?php echo $url; ?>"><input type="submit" value="continue_shopping&gt;&gt;"></form></td> 
      <td width="12">&nbsp;</td><td align="left">
        <form method="post" action="cart_check.php?page=1"><input type="submit" value="view_shoppingcart&lt;&lt;"></form></td></tr>
    </table>
    </div>
  </body>
</html>