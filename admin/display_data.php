<?php
$con = mysql_connect("localhost","c63702","1db23");
if (!$con)
	die('Could not connect: ' . mysql_error());
else
	echo "connected.";
mysql_select_db("c63702", $con);
$result = mysql_query("SELECT * FROM book_info");
echo "<table border='1'>
	<tr>
		<th>book_id</th>
		<th>book_no</th>
		<th>book_name</th>
		<th>author</th>
		<th>publisher</th>
		<th>pub_date</th>
		<th>price</th>
		<th>price_m</th>
		<th>price_d</th>
		<th>book_storenum</th>
		<th>book_class_id</th>
		<th>book_type_id</th>
		<th>book_index</th>
		<th>book_abstract</th>
		<th>book_level</th>
		<th>book_level_pic</th>
		<th>book_pic</th>
		<th>input_date</th>
		<th>book_bs</th>
		<th>book_view</th>
	</tr>";
while($row = mysql_fetch_array($result))
{
	 
	echo "<tr>";
	echo "<td>" . $row[0] . "</td>";
	echo "<td>" . $row[1] . "</td>";
	echo "<td>" . $row[2] . "</td>";
	echo "<td>" . $row[3] . "</td>";
	echo "<td>" . $row[4] . "</td>";
	echo "<td>" . $row[5] . "</td>";
	echo "<td>" . $row[6] . "</td>";
	echo "<td>" . $row[7] . "</td>";
	echo "<td>" . $row[8] . "</td>";
	echo "<td>" . $row[9] . "</td>";
	echo "<td>" . $row[10] . "</td>";
	echo "<td>" . $row[11] . "</td>";
	echo "<td>" . $row[12] . "</td>";
	echo "<td>" . $row[13] . "</td>";
	echo "<td>" . $row[14] . "</td>";
	echo "<td>" . $row[15] . "</td>";
	echo "<td>" . $row[16] . "</td>";
	echo "<td>" . $row[17] . "</td>";
	echo "<td>" . $row[18] . "</td>";
	echo "<td>" . $row[19] . "</td>";
	echo "</tr>";
}
echo "</table>";
mysql_close($con);
?>
