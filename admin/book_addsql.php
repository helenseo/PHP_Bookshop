<html>
<body>
<?php
	$con = mysql_connect("localhost","c63702","1db23");
	if (!$con)
		die('Could not connect: ' . mysql_error());
	else
		echo "Connected.";
	
	mysql_select_db("c63702", $con);

	mysql_query("INSERT INTO book_info(book_no,book_name,author,publisher,pub_date,price,price_m,price_d,
				book_storenum,book_class_id,book_type_id,book_index,book_abstract,book_level,book_level_pic,
				book_pic,input_date,book_bs,book_view)
				VALUES
				($_POST[book_no],'$_POST[book_name]','$_POST[author]','$_POST[publisher]',
				'$_POST[pub_date]',$_POST[price],$_POST[price_m],$_POST[price_d],$_POST[book_storenum],
				$_POST[book_class_id],$_POST[book_type_id],'$_POST[book_index]','$_POST[book_abstract]',
				$_POST[book_level],'$_POST[book_level_pic]','$_POST[book_pic]','$_POST[input_date]',
				'$_POST[book_bs]',$_POST[book_view])");
	mysql_query($sql,$con);
	echo "Book record has been inserted.";

	mysql_close($con);
?>
	
		<a href="display_data.php" target='_blank'>display the updated book information table.</a>
	
</body>
</html>