<?php
   require_once('config.inc.php');
   require_once(Include_Path.'db.inc.php');
   require_once(Include_Path.'control.inc.php');   //请求包含相应类的文件
   $bookid=$_GET['bookid']; $userid=$_POST['user_id'];
   $booklevel=$_POST['book_level']; 
   $bookcomm=$_POST['comm'];   //获取表单数据
   $usermsg=new control();   //创建反馈用户对象
   $sql="INSERT INTO user_message (user_id, book_id, book_level, message_content) VALUES
('$userid', '$bookid', '$booklevel', '$bookcomm')";   //插入数据的SQL语句
   if($usermsg->insert($sql))
      echo "<meta http-equiv='Refresh' content='0;url=book_fullinfo.php?bookid=".$bookid."'>";
?>