<?php
   session_start();
   $userid=$_SESSION['userid'];   //�����Ự
   require_once('config.inc.php');
   require_once('include/db.inc.php');
   require_once('include/control.inc.php');
   require_once('include/display.inc.php');   //���������Ӧ����ļ�
   $page=$_GET['page'];
   $userIP=$_SERVER[REMOTE_ADDR];   //��ȡ�û���IP��ַ����ʶ���û�
   if($page<1) $page=1;
   $chats=new control();//�������ﳵ����
   $DTname="book_cart";
   $serach="cart_session_id ='".$userIP."'";
   $chat_s=$chats->GetDTdataset($DTname,$serach);   //��ȡ���ﳵ��Ϣ
   $book_s=$chats->Getbookdata($DTname,$serach);   //��ȡ���鳵�����е�ͼ����Ϣ
   $url="cart_check.php?page=";
   $displaychat=new display();   //�������ﳵ��ʾ����
   $displaychat->_pageSize=$chats->_pageSize;
   $pagelast=$displaychat->GetpageNum($chat_s);
   $chat=$chats->GetcontrolList($chat_s,$page);
   $displaybar=$displaychat->GetJumpBar($chat_s,$page,$url);   //���ɹ��ﳵ��ʾ��ҳ�浼����
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Check shopping cart</title>
    <base target="mainFrame">
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
    <div id="appb">
      <div id="bt">Check shopping cart<hr /></div>
      <form action="<?php echo $url.$page1; ?>" method="post">
		<table width="600" border="0" cellspacing="0" class="tdl">
			<tr>
				<td height="24" >
					Total<?php echo count($chat_s); ?>Books&nbsp;&nbsp;
					Total<?php echo $pagelast; ?>pages&nbsp;&nbsp;
					<?php echo $displaybar['JumpBar'];?>
				</td>
				<td align="right"> Input page:
					<input type="text" size="3" name="page1" value="<?php echo $page1; ?> ">
					<input type="submit" name="send2" value="Forward_to" />
				</td>
			</tr>
		</table>
      </form>
      <table width="600" border="1" cellspacing="1" class="tdl">
      <form  method="post" action="cart_update.php?page=<?php echo $page; ?>">
         <tr align="center" id="bb"><td>Cancel</td><td>Book name</td><td>Author</td>
           <td>Publisher</td><td>Price</td><td>Quantity</td><td>Total</td></tr>
<?php 
   for($j=0;$j<count($chat);$j++){   //���ݹ��ﳵ�е�ͼ�����к�������ȡͼ����Ϣ
     echo '<tr><td><input type="checkbox" name="bookbm['.$chat[$j][book_id].']" value="del"> '.$chat[$j][book_id].'</td>';
     echo  "<td>".$chats->Getstr($book_s[$j][book_name],30)."</td>";
     echo  "<td>".$chats->Getstr($book_s[$j][author],20)."</td>";
     echo  "<td>".$book_s[$j][publisher]."</td>";
     echo  "<td>".$book_s[$j][price_d]."</td>";
     echo '<td><input type="text" size="6" name="booknum['.$chat[$j][book_id].']" value="'.$chat[$j][buy_num].'"></td>';
     echo "<td>".$book_s[$j][price_d]*$chat[$j][buy_num]."</td></tr>";
    }
?>
        <tr><td colspan="7" align="right"><?php echo $displaybar['msg']; ?></td></tr>
        <tr id="bb"><td colspan="5">Click "modify" to modify your order<br/>Click "confirm" to place your order</td>
           <td align="center"><input type="submit" value="modify" /></td>
   <td><input type="button" value="confirm" onclick="window.location.replace('order_check.php')" /></form></td></tr>
      </form>
      </table>
      <div align="center" class="tdl">&nbsp;<br/>&nbsp;</div>
    </div>
  </body>
</html>