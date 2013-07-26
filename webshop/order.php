<?php
   $orderID=$_GET['order_id'];
   require_once('config.inc.php');
   require_once(Include_Path.'db.inc.php');
   require_once(Include_Path.'control.inc.php');
   $order=new control();   //创建订单对象
   $DTname="order_info";$serach="order_id=".$orderID;
   $order_s=$order->GetDTdataset($DTname,$serach);   //获取制定订单号的订单信息
   $book_s=explode(":", $order_s[0][order_note]);   //分离出图书的序列号和数量
   $book_IDS=explode(",", $book_s[0]);   //分离出各本图书的序列号
   $book_nums=explode(",", $book_s[1]);   //分离出各本图书的数量
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
      <div id="bt">Order information<hr /></div>
      <table width="100%" border="0" cellspacing="0" class="tdl">
        <tr><td id="bb">Order number:<?php echo $orderID;?></td></tr>
        <tr><td >Total<?php echo $order_s[0][order_num];?>items</td></tr>
      </table>
      <table width="100%" border="1" cellspacing="1" class="tdl">
        <tr align="center" id="bb"><td width="30%">Title</td><td width="25%">Author</td>
          <td>Cover type</td><td>Publisher</td><td>Price</td><td>Quantity</td><td>Total</td>
		</tr>
<?php
   for($j=0;$j<$order_s[0][order_num];$j++){   //输出各本图书的信息
      $book=new control();
      $serach_b="SELECT * FROM book_info WHERE book_id=".$book_IDS[$j+1];
      $book=$book->select($serach_b);
      if($book[0][book_bs]==0) $bz="paperback" ;   else $bz="hardcover";
      echo "<tr><td>".$book[0][book_name]."</td><td>".$book[0][author]."</td>";
      echo "<td align='center'>".$bz."</td><td align='center'>".$book[0][publisher]."</td>";
      echo "<td align='center'>".$book[0][price_m]."</td><td align='center'>".$book_nums[$j+1]."</td>";
      echo "<td align='center'>".$book[0][price_m]*$book_nums[$j+1]."</td></tr>";
   }
      echo "<tr id='bb'><td colspan='5' align='right'>Total price</td>";
      echo "<td colspan='2'>".$order_s[0][order_money]."&nbsp;&nbsp;dollars</td></tr>";
?>
      </table>
      <table width="100%" border="1" cellspacing="1" class="tdl"><p align='center'
        <tr><td id="bb" colspan="2">Delivery information:</td></tr>
        <tr><td colspan="2">Contact person:<?php echo $order_s[0][user_name]; ?></td></tr>
        <tr><td>Address:<?php  echo $order_s[0][order_addr]; ?></td>
            <td>Post code:<?php  echo $order_s[0][order_post]; ?></td></tr>
        <tr><td>Email:<?php  echo $order_s[0][order_mail]; ?></td>
           <td>Phone number:<?php  echo $order_s[0][order_phone]; ?></td></tr>
        <tr><td colspan="2" id="bb">Delivery type:<?php  echo $order_s[0][order_send]; ?></td></tr>
        <tr><td colspan="2" id="bb">Payment method<?php  echo $order_s[0][order_fmoney]; ?></td></tr>
        <tr><td colspan="2" align="center" id="bb"><a href="#" onClick="javascript:window.close();return false;">back</a></td></tr>
      </table>
   </div>
</body>
</html>