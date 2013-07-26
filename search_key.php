<!--对left.php的表单处理程序，对数据处理和传递-->
<html>
<head>
<base target='mainFrame' />
</head>
<body>
<?php
	
   echo '<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />';
   $title="Search book"; //图书搜索->search book
   $keys=(string)$_POST['keys']; $cond=$_POST['selt1'];
   if($cond=="pub_date"){
	   $pattern="/^\d{4}\-[0-1]?[0-9]\-[0-3]?[0-9]$/";   //定义日期的正则表达式
       if(preg_match($pattern, $keys)==0) {
	      echo "<script type='text/javascript'>window.alert('输入的日期格式不合法！');</script> ";
		  echo "<meta http-equiv='Refresh' content='0;url=main.php'>";
	   }
       $serach="$cond>=%27$keys%27";               //U%27是对单引号（'）的URL编码
   }
   else  $serach="$cond=%27$keys%27"; 
  echo "<meta http-equiv='Refresh' content='0;url=webshop/book_show.php?title=$title&serach=$serach&page='>";

?>
</body>
</html>