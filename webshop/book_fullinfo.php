<?php
   require_once('config.inc.php');
   require_once(Include_Path.'db.inc.php');
   require_once(Include_Path.'control.inc.php');
   $bookid=$_GET['bookid'];   //Get bookid
   $book_s=new control();   //create book object
   $sql="SELECT * FROM book_info WHERE book_id=".$bookid;
   $book=$book_s->select($sql);   //select function from DB parent
   $user=new control();   //create user object
   $sql2="SELECT * FROM user_message WHERE book_id=".$bookid;
   $usermsg=$user->select($sql2);
   if(count($usermsg)==0) $msg="No Review";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312">
    <title>Book Detailed Information</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css"/>
  </head>
  <body>
    <div id="appb">
      <div id="bt">Detailed Information<hr/></div> 
      <table width="100%" border="0" cellspacing="0">
         <tr><td id="bb">&nbsp;&nbsp;</td></tr>
      </table>
      <table width="100%" border="1" cellspacing="1" class="tdl">
         <tr><td width="10%" align="right">Title</td>
             <td width="50%" class="tdd"><?php echo $book[0][book_name]; ?></td>
             <td rowspan="9" align="center"><img src="<?php echo $book[0][book_pic]; ?>" /></td></tr>
         <tr><td align="right">Author</td>
             <td class="tdd"><?php echo $book[0][author]; ?></td></tr>
         <tr><td align="right">Publiser</td>
             <td class="tdd"><?php echo $book[0][publisher]; ?>&nbsp;Publiser</td></tr>
         <tr><td align="right">Publish Date</td>
             <td class="tdd"><?php echo substr($book[0][pub_date],0,10); ?></td></tr>
         <tr><td align="right">Book ISBN</td>
             <td class="tdd"><?php echo $book[0][book_no]; ?></td></tr>
         <tr><td align="right">Original Price</td>
             <td class="tdd"><?php printf("%.2f",$book[0][price]); ?></td></tr>
         <tr><td align="right">Discounted Price</td>
             <td class="tdd"><?php printf("%.2f",$book[0][price_d]); ?></td></tr>
         <tr><td align="right">Member Price</td>
             <td class="tdd"><?php printf("%.2f",$book[0][price_m]); ?></td></tr>
         <tr><td align="right">Rank</td>
             <td class="tdd"><font color="#FF0000"><?php echo $book[0][book_level];?></font>&nbsp;&nbsp;&nbsp;
			      <img src="<?php echo $book[0][book_level_pic];?>" /></td></tr>
         <tr><td colspan="3">Abstract &nbsp;&nbsp;<span class="tdd"><?php echo $book[0][book_abstract];?></span></td></tr>
         <tr><td colspan="3">Catalog<pre class="tdd"><?php echo $book[0][book_index];?> </pre></td></tr>
         <tr><td colspan="3" align="center"><a href="#" onClick="javascript:window.close();return false;">Back</a></td></tr>
      </table>
	 
    </div>
  </body>
</html>