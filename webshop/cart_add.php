<?php
   session_start();
   $userid=$_SESSION['userid'];   //�����Ự
   require_once('config.inc.php');
   require_once('include/db.inc.php');
   require_once('include/control.inc.php');   //���������Ӧ����ļ�
   $bookbmm=$_POST['bookbm']; $booknumm=$_POST['buynum'];   //��ȡ�ύ��������
   $title=$_GET['title']; $serach=$_GET['serach']; 
   $pp=$_GET['pp'];$page=$_GET['page'];   //��ȡURL���ݵ�����
   $url="book_show.php?title=$title&&pp=$pp&&serach=$serach&&page=$page";
   $userIP=$_SERVER[REMOTE_ADDR];   //��ȡ�û���IP��ַ����ʶ���û�
   $chat=new control();   //�������ﳵ����
   if(is_array($bookbmm)){   //�ж��û��Ƿ�ѡ����Ҫ�����ͼ��
      foreach($bookbmm as $key => $value) {   //Ѱ�Ҳ�����ѡ�е�ͼ��
         $serach="(cart_session_id ='".$userIP."' AND book_id=".$key.")";
         if($value=="sel"){
           if($booknumm[$key]<1)  $msg1.="book selected".$key."number should be int.<br/>";
           else{
               $DTname="book_cart";
               $chat_s=$chat->GetDTdataset($DTname,$serach);   //��ѯ�û��Ƿ��Ѿ�ѡ�����Ȿ��
               if(count($chat_s)==0){   //û��ѡ���Ĵ���
                  $sql= "INSERT INTO book_cart(user_id, book_id, buy_num,cart_session_id) VALUES ('$userid', '$key', '$booknumm[$key]', '$userIP')";
                  $pp=$chat->insert($sql);   //���뵽���ﳵ����
               }
               else{   //ѡ�����Ĵ���
                  $booknu=$chat_s[0][buy_num]+$booknumm[$key];
                  $sql ="UPDATE book_cart SET buy_num=".$booknu." WHERE".$serach;
                  $pp=$chat->update($sql);   //���ۼ�ֵ���¹�������
               }
               if($pp) $msg1.="book selected".$key."added successed.<br/>";   //�ɹ�������ķ�����Ϣ
            }
         }
       }
   }
   else
       $msg1.="Didn't select any books.<br/>";   //û��ѡ��ͼ��ķ�����Ϣ
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