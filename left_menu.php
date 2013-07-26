<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"  />
    <title>Search Book</title>
    <link href="css/left.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <div class="txt">
<?php 
    require_once('webshop/config.inc.php');
	require_once('webshop/include/db.inc.php');
    require_once('webshop/include/booktype.inc.php');
    $bktc=new booktype();
    $bktlist=$bktc->GetBkTypeList();
    $tcount=count($bktlist);
    for($j=0;$j<$tcount;$j++){
       $i=$bktlist[$j][0];
       $tccount=$bktc->numb_item($i);
       if($tccount>0){
		   $item=$_GET['item'];  
          if($item==$i && $item!=0 ){ 
             $nume.="&nbsp;<a href='left_menu.php?item=0' target='_self'>-</a>&nbsp;".$bktlist[$j][book_type_name]."<br>";
              $nume.=$bktc->nemu_item($item);
           }
           else
              $nume.="&nbsp;<a href='left_menu.php?item=$i' target='_self'>+</a>&nbsp;".$bktlist[$j][book_type_name]."<br>";
      }
      else
        $nume.="&nbsp;&nbsp;&nbsp;<a href='webshop/book_show.php?title=".$bktlist[$j][book_type_name].
         "&&page=1&&serach=book_type_id=".$bktlist[$j][book_type_id]."' target='mainFrame'>"
         .$bktlist[$j][book_type_name]."</a><br>";
    }
    echo $nume;
?>
</div>
</body>
</html>		 