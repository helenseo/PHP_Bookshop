<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
		<title>Bookstore</title>
		<link href="css/main.css" rel="stylesheet" type="text/css" />
	</head>
<body>
	<div id="rightbt1"><br/>&nbsp; &nbsp;&nbsp;<a href="webshop/book_show.php">More...</a>
	<div id="rightconnect"> 
	<table width="580" border="0" cellspacing="0">
		<tr>
		<?php 
			require_once('webshop/config.inc.php');
			require_once('webshop/include/db.inc.php');
			require_once('webshop/include/control.inc.php');
			$books=new control();
			$DTname="book_hot";
			$serach=" 1 ORDER BY hot_order ASC LIMIT 0,5";    //get 5 records from the database
			$book=$books->Getbookdata($DTname,$serach);
			$count=count($book); $i=0;
			while($i<$count){
		?>
			<td width="55">
				<a href='webshop/book_fullinfo.php?bookid=<?php echo $book[$i][book_id];?>'target='_blank'>
						<img id="imgc" src="webshop/<?php echo $book[$i][book_pic];?>" />
				</a>
			</td>
			<td width="510">
			<?php echo $book[$i][book_name];?><br/>
			</td>
			<?php $i++; }?>
		</tr>
	</table>
    </div>
    </div>
	<br/><br/><br/>
	<div id="rightbt2">
	<div id="rightconnect">
		<table width="580" border="0" cellspacing="0">
		<tr>
		<?php 
			$DTname="book_recommend";
			$serach=" 1 ORDER BY recom_order ASC LIMIT 0,5";
			$book=$books->Getbookdata($DTname,$serach);
			$count=count($book);$i=0;
			while($i<$count){
		?>
			<td width="55">
				<a href='webshop/book_fullinfo.php?bookid=<?php echo $book[$i][book_id];?>'target='_blank'>
						<img id="imgc" src="webshop/<?php echo $book[$i][book_pic];?>" />
				</a>
			</td>
			<td width="510"> 
			<?php echo $book[$i][book_name];?><br/>
			<?php $i++;}?>
        </tr>
		</table>
    </div>
	</div>
  </body>
</html>