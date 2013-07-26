<?php
   $orderID=$_POST['orderID'];   $username=$_POST['username'];
   $email=$_POST['email'];   $sub=$_POST['set'];
   if($sub=="search"){
      require_once('config.inc.php');
      require_once('include/db.inc.php');
      require_once('include/control.inc.php');
      $order=new control();   //创建订单对象
      $search="(order_ID='".$orderID."' OR user_name ='".$username."' OR order_mail='".$email."')";
      $DTname="order_info";
      $order_s=$order->GetDTdataset($DTname,$serach);   //获取指定条件的订单信息
      if(count($order_s)<1) $msg="No information searched.";
      else
        echo "<meta http-equiv='Refresh' content='0;url=order_list.php?page=1&&orderID=".$orderID. "&&username=".$username."&&email=".$email."'/>";
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Order search</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript">
       function tjpd(){
         var orderID1=window.frm.orderID.value;
       var username1=window.frm.username.value;
         var email1=window.frm.email.value;   
         if(orderID1=="" && username1=="" && email1==""){
            window.alert("Input keyword");
            window.frm.orderID.focus();
         }
      }
   </script>
  </head>
  <body>
    <div id="appb">
      <div id="bt">Search order<hr /></div>
      <table width="600" border="0" cellspacing="0" class="tdl">
        <tr><td id="bb">Input your keyword</td></tr>
      </table>
     <form name="frm" action="order_search.php"  target="mainFrame" method="post">
     <table width="600" border="1" cellspacing="1" class="tdl">
      <tr><td align="right">Order number:</td>
         <td><input name="orderID" type="text" size="20"/>&nbsp;&nbsp;Or</td></tr>
       <tr><td align="right">Contact person:</td>
          <td><input name="username" type="text" size="20"/>&nbsp;&nbsp;Or</td></tr>
      <tr><td align="right">Email</td>
           <td><input name="email" type="text" size="20"/></td></tr>
        <tr><td colspan="2" align="center"><input name="set" type="submit" value="search" onmousedown="tjpd()" /><input type="reset" value="reset" /></td></tr>
      </table>
      </form>
      <div id="bb"><?php echo $msg; ?></div>
   </div>
  </body>
</html>