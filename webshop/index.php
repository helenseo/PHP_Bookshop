<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
 
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
    <title>Online Bookstore</title>
    <link href="css/index.css" rel="stylesheet" type="text/css" />
  </head>
<body>
	
	<div id="container">
	<div id="top"> <?php include "top.php";?> </div>
    <div id="err">
		<?php $msg = $_GET["msg"]; $userid = $_GET["userid"]; 
		if($userid!="") {
			$str = "welcome ".$userid;
			//$msg = $msg; 
			echo $str; } ?><br/><br/>
	</div>
	<div id="left"><?php include "left.php";?></div>
	<div id="main">
		<iframe name="mainFrame" id="mainFrame" scrolling="no"  height="440" width="600" src="main.php" marginwidth="0" marginheight="0" target="_self" border="0" frameborder="0" align="right">Not Supported</iframe> 
    </div>
	<span class="clear" ></span>
	<div id="bottom"><?php include "linkbottom.php";?></div>
    </div>
  </body>
</html>
