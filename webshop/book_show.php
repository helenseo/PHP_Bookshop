  <?php
   $keyword="PHP";
   $color="<font color='#0000FF'>".$keyword."</font>";
   ob_start();   
?>

<?php
   require_once('config.inc.php');
   require_once(Include_Path.'db.inc.php');
   require_once(Include_Path.'control.inc.php');
   require_once(Include_Path.'display.inc.php');   //请求包含相应类的文件
   $title=$_GET['title']; $serach=$_GET['serach'];
   $pp=$_GET['pp']; $page=$_GET['page'];   //获取由URL传递来的数据
   if($pp==1) { $DTname=$serach;$serach=1;}   //由特色图书链接进入
   else $DTname="book_info";   //由搜索菜单或输入的查询条件进入
   $serach=stripslashes($serach);   //去除自动添加的反斜杠\
   $serach=eregi_replace("%27", "'",$serach);  //把"%27替代为'
   $books=new control();
   $book_s=$books->Getbookdata($DTname,$serach);   //获取要显示图书的数据
   $serach=eregi_replace ( "'", "%27", $serach);  //把'替代为"%27
   if($pp==1) $serach=$DTname;
   $ss="?title=$title&&pp=$pp&&serach=$serach&&page=";
   $url="book_show.php". $ss;
   if($page<1) $page=1; 
   $displaybook=new display($book_s,$books->_pageSize);
   $displaybook->_pageSize=$books->_pageSize;   //统一显示页与数据分页的行数
   $pagelast=$displaybook->GetpageNum($book_s);   //提取显示的最后页码
   $book=$books->GetControlList($book_s,$page);   //提取当前页的显示数据
   $displaybar=$displaybook->GetJumpBar($book_s,$page,$url);    //生成分页导航栏信息 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>	
    <meta http-equiv="Content-Type" content="text/html; charset=GB2312">
    <title>Display Book</title>
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
  </head>
  <body>
	
    <div id="appb">
      <div id="bt"><?php echo $title; ?><hr/></div>
      <form action="<?php echo $url.$page1;?>" method="post" target="mainFrame">
      <table width="600" border="0" cellspacing="0" class="tdl">
        <tr><td>Total <?php echo count($book_s); ?>Books &nbsp;&nbsp; total <?php echo $pagelast; ?>pages &nbsp;&nbsp;<?php echo $displaybar['JumpBar']; ?></td>
          <td align="right">Input the page number: <input type="text" size="3" name="page1" value="<?php echo $page1; ?>"><input type="submit" name="send2" value="forward_to"/></td></tr>
      </table>
      </form>
      <table width="600" border="1" cellspacing="1" class="tdl">
      <form name="frm" action="cart_add.php<?php echo $ss;?>" method="post">
        <tr align="center" id="bb"><td width="28">Select</td><td width="182">Title</td>
          <td width="102">Author</td><td width="90">Publisher</td><td width="28">Original_Price</td>
          <td width="28">Discount</td><td width="57">Quantity</td><td width="42">Detail</td></tr>
		  
		  
<?php
   for($j=0;$j<count($book);$j++){   //按行依次输出图书信息
      echo "<tr class='tdl'>";
      echo "<td align='center'><input type='checkbox' name='bookbm[".$book[$j][book_id]."]' value='sel'>".$book[$j][book_id]."</td>";
      echo"<td width='200'>".$books->Getstr($book[$j][book_name],30)."</td>";
      echo"<td width='150'>".$books->Getstr($book[$j][author],20)."</td>";
      echo"<td>".$book[$j][publisher]."</td><td>";
      printf("%.2f",$book[$j][price]);
      echo"</td><td>";
      printf("%.2f",$book[$j][price_d]);
      echo'</td><td align="center"><input type="text" size="4" name="buynum['.$book[$j][book_id].']">'.$buynum[$book[$j][book_id]].'</td>';
      echo"<td align='center'><a href='book_fullinfo.php?bookid=".$book[$j][book_id]."' target='_blank'>Detail..</a></td></tr>";
   }   
   if(count($book)<$books->_pagesize){
      echo"<tr class='tdl'>";
      echo"<td align='center' colspan='8' height='".(abs($books->_pagesize-count($book))*27)."'>&nbsp;</td></tr>";
   }
?>
      <tr><td colspan="8" align="right"><?php echo $displaybar['msg'];?></td></tr>
      <tr id="bb"><td align="left" colspan="5">Note: first select the book, then input the quantity, and click the put_into _cart</td>
          <td colspan="3" align="center"><input type="submit"value="put_into_cart"/></td></tr>
        </form>
      </table>
    </div>
	<?php include "../pro2/linkbottom.php";?>
  </body>
</html>
<?php
   $str=ob_get_contents();
   $str=preg_replace("/".$keyword."/", $color,$str);
   ob_end_clean();   //对输出内容缓冲
   echo $str;
?>