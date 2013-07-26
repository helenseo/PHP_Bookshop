<html>
<body>
<?php
	$con = mysql_connect("localhost","c63702","1db23");
	if (!$con)
		die('Could not connect: ' . mysql_error());
	else
		echo "Connected.";
	
	mysql_select_db("c63702", $con);

	mysql_query("DELETE FROM book_info WHERE $_POST[col]='$_POST[del]'"); 
			
	mysql_query($sql,$con);
	
	echo "Book record has been deleted.";

	mysql_close($con);
?>
		<br/>
		<a href="display_data.php" target='_blank'>display the updated book information table.</a>
	
</body>
</html>