<html>
<body>
<?php
	$con = mysql_connect("localhost","c63702","1db23");
	if (!$con)
		die('Could not connect: ' . mysql_error());
	else
		echo "Connected.";
	
	mysql_select_db("c63702", $con);

	mysql_query("UPDATE book_info SET $_POST[update_field]='$_POST[update_value]' WHERE $_POST[identifier]='$_POST[identifier_value]'"); 
			
	mysql_query($sql,$con);
	echo "Book record has been updated.";

	mysql_close($con);
?>
	<br/>
		<a href="display_data.php" target='_blank'>display the updated book information table.</a>
	
</body>
</html>