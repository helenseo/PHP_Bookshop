<?php
   $orderID=$_GET['orderID'];$username=$_GET['username'];
   $email=$_GET['email'];$page=$_GET['page'];
   if($page<1) $page=1;
   require_once('config.inc.php');
   require_once(Include_Path.'db.inc.php');
   require_once(Include_Path.'control.inc.php');
   require_once(Include_Path.'display.inc.php');
   $order=new control();   //创建订单对象
   $serach="(order_id='".$orderID."' OR user_name ='".$username."' OR order_mail='".$email."' )";
   $DTname="order_info";
   $order_s=$order->GetDTdataset($DTname,$serach);   //获取指定条件的订单信息
   $url="order_list?orderID=".$orderID."&&username=".$username."&&email=".$email."&&page=";
   $displayorder=new display();
   $displayorder->_pageSize=$order->_pageSize;
   $pagelast=$displayorder->GetpageNum($order_s);
   $orders=$order->GetControlList($order_s,$page);
   $displaybar=$displayorder->GetJumpBar($order_s,$page,$url);  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Order information</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="appb">
      <div id="bt">Order List information<hr /></div>
      <table width="600" border="0" cellspacing="0" class="tdl">
        <tr><td >Total<?php echo count($order_s); ?>orders&nbsp;&nbsp;Total<?php echo $pagelast; ?>pages&nbsp;&nbsp;<?php? echo $displaybar['JumpBar'];?></td>
          <td align="right"> Input page<input type="text" size="3" name="page1" value="<?php echo $page1; ?> "><input type="submit" name="send2" value="forward_to" /></td></tr>
      </table>
      <table width="600" border="1" cellspacing="1" class="tdl">
        <tr align="center" id="bb" ><td>Serial number</td><td>Order number</td><td>Contact person</td>
          <td>Quantity</td><td>Total price</td><td>order status</td><td>created time</td><td>details</td></tr>
<?php
   for($j=0;$j<count($orders);$j++){
      if($orders[$j][order_state]==1) $state="finished";
      else {
        if($orders[$j][order_fmonry]=="member card") $state="paid, in delivery";
        else $state="in process";
      }
      echo "<tr algin='center'><td>".($j+1)."</td>";
      echo "<td>".$orders[$j][order_id]."</td><td>".$orders[$j][user_name]."</td>";
      echo "<td>".$orders[$j][order_num]."</td><td>".$orders[$j][order_money]."</td>";
      echo "<td>".$state."</td><td>".$orders[$j][order_time]."</td>";
      echo "<td><a href='order.php?order_id=".$orders[$j][order_id]."' target='_blank'>Check</a></td></tr>";
   }
?>
        <tr><td colspan="8" align="right"><?php echo $displaybar['msg']; ?></td></tr>
        <tr id="bb"><td align="left" colspan="8">Note: click "check" to see the details of order.</td></tr>
      </table>
    </div>
  </body>
</html>