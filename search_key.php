<!--��left.php�ı�������򣬶����ݴ���ʹ���-->
<html>
<head>
<base target='mainFrame' />
</head>
<body>
<?php
	
   echo '<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />';
   $title="Search book"; //ͼ������->search book
   $keys=(string)$_POST['keys']; $cond=$_POST['selt1'];
   if($cond=="pub_date"){
	   $pattern="/^\d{4}\-[0-1]?[0-9]\-[0-3]?[0-9]$/";   //�������ڵ�������ʽ
       if(preg_match($pattern, $keys)==0) {
	      echo "<script type='text/javascript'>window.alert('��������ڸ�ʽ���Ϸ���');</script> ";
		  echo "<meta http-equiv='Refresh' content='0;url=main.php'>";
	   }
       $serach="$cond>=%27$keys%27";               //U%27�ǶԵ����ţ�'����URL����
   }
   else  $serach="$cond=%27$keys%27"; 
  echo "<meta http-equiv='Refresh' content='0;url=webshop/book_show.php?title=$title&serach=$serach&page='>";

?>
</body>
</html>