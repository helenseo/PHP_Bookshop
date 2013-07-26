<?php
   session_start();
   $userid=$_SESSION['userid']; 
   $userIP=$_SERVER[REMOTE_ADDR];   //获取用户的IP地址，以识别用户
   $msg=$_GET['msg'];
   require_once('config.inc.php');
   require_once(Include_Path.'db.inc.php');
   require_once(Include_Path.'control.inc.php');
   $bcob=new control();
   $DTname="book_cart";$serach="cart_session_id ='".$userIP."'";
   $chat_s=$bcob->GetDTdataset($DTname,$serach);   //获取购书车信息
   $book_s=$bcob->Getbookdata($DTname,$serach);   //获取购书车上所有的图书信息
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Order confirmation</title>
       <base target="_blank" />
    <link href="css/bscss.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript">
	function pdsr(){
		var username1=window.frm.username.value;
        var post1=window.frm.post_b.value;
        var addr1=window.frm.addr.value;
        var phone1=window.frm.phone.value;
        var email1=window.frm.email.value;
        if(username1==""){
			window.alert("Contact person cannot be empty.");
			window.frm.userid.focus();
        }
        else if (post1==""){
			window.alert("Post code cannot be empty.");
			window.frm.password.focus();
        }
        else if (addr1==""){
			window.alert("Address cannot be empty.");
			window.frm.password.focus();
        }
        else if (phone1==""){
			window.alert("Phone number cannot be empty.");
			window.frm.password.focus();
        }
        else if (email1==""){
			window.alert("Email cannot be empty.");
			window.frm.password.focus();
        }
		else return true;
      }
    </script>
  </head>
<body>
	<div id="appb">
		<div id="bt">
			Order confirmation<hr />
		</div>
		<div id="bb">
			<?php echo $userid; ?>: Your order list
			<p class="tdl">Total <?php echo count($chat_s); ?> items</p>
		</div>

		<table width="600" border="1" cellspacing="1" class="tdl">
			<tr id="bb" align="center">
				<td width="30%">Title</td>
				<td width="25%">Author</td>
				<td>Cover type</td>
				<td>Publisher</td>
				<td>Price</td>
				<td>Quantity</td>
				<td>Total</td>
			</tr>
	
				<?php
					for($j=0;$j<count($chat_s);$j++)//输出选购的图书信息
					{   
						if($book_s[$j][book_bs]==0) $bz="paperback"; else  $bz="hardcover";
						echo "<tr><td>".$book_s[$j][book_name]."</td><td>".$book_s[$j][author]."</td>";
						echo  "<td align='center'>".$bz."</td>";
						echo  "<td align='center'>".$book_s[$j][publisher]."</td>";
						echo  "<td align='center'>".$book_s[$j][price_m]."</td>";
						echo  "<td align='center'>".$chat_s[$j][buy_num]."</td>";
						echo  "<td align='center'>".$book_s[$j][price_m]*$chat_s[$j][buy_num]."</td></tr>";
						$b_id.=",".$chat_s[$j][book_id]; $b_num.=",".$chat_s[$j][buy_num]; 
						$total+=$book_s[$j][price_m]*$chat_s[$j][buy_num];   //记录购买的书号、数量和金额
					}
					echo "<tr id='bb'><td colspan='5' align='right'>Total</td>";
					echo "<td colspan='2'>".$total." &nbsp; &nbsp;Dollars</td></tr>";
					$b_id.=":".$b_num;   //记录购买的每本书的书号和数量
					$_SESSION['b_ID']=$b_id;$_SESSION['b_money']=$total;
					$_SESSION['bk_num']=count($chat_s);   //把购买的书号、数量和金额保存在SESSION 
				?>
	
	
			<tr><td colspan="7" class="tdl">Note: after placing your order, print it.</td></tr>
		</table>
		
		
	
		<table width="600" border="1" cellspacing="1" class="tdl">
			<form method="POST"  name="frm" action="order_p.php?cardp=<?php echo $cardp;?>">
				<tr><td id="bb" colspan="2"><? echo $_SESSION['userid']; ?>Confirm your delivery information</td></tr>
				<tr>
					<td align="right">Contact person:</td>
					<td><input type="text"size="20" name="username" value="<?php echo $user_s[0][username]; ?>" /></td>
				</tr>
				<tr>
					<td align="right">Post code:</td>
					<td><input type="text"size="20" name="post_b" value="<?php echo $user_s[0][post];?>"/></td>
				</tr>
				<tr>
					<td align="right">Address: </td>
					<td><input type="text" name="addr" size="40" value="<?php echo $user_s[0][address];?>" /></td>
				</tr>
				<tr>
					<td align="right">Phone number:</td>
					<td><input type="text" name="phone" size="20" value="<?php echo $user_s[0][phone];?>" /></td>
				</tr>
				<tr>
					<td align="right">Email:</td>
					<td><input type="text" name="email" size="30" value="<?php echo $user_s[0][email];?>" /></td>
				</tr>
				<tr id="bb">
					<td align="right">Delivery method:</td>	
				</tr>
				<tr class='tdl'>
					<td colspan="2"> 
					
				
						<input name="sendb" type="radio" value="one"/>One day shipping&nbsp;&nbsp;
						<input name="sendb" type="radio" value="two"/>Two day shipping&nbsp;&nbsp;
						<input name="sendb" type="radio" value="three"/>3-8 business day&nbsp;&nbsp;
						
					</td>
				</tr>
	
				<tr id="bb">
					<td align="right">Payment type:</td>
				</tr>
	
				<tr class='tdl'>
					<td colspan="2">payment detail information<br />
					<input name="pay" type="radio" value="member card"/>Member card&nbsp;&nbsp;
					<input name="pay" type="radio" value="credit"/>Credit card&nbsp;&nbsp;
					<input name="pay" type="radio" value="cash"/>Cash on delivery&nbsp;&nbsp;
					</td>
				</tr>
				<tr id="bb">
					<td align="center" colspan="2">
						<input type="submit" name="act" value="cancel" onclick="window.close()" />
						<input type="submit" name='act' value="confirm" onMouseover="pdsr()" onclick="window.close()"/>
					</td>
				</tr>
			</form>
		</table>
      <div id="bb"><?php echo $msg; ?></div>
    </div>
</body>
</html>