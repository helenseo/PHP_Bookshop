<head>
<title>Book delete</title>
</head>
<body>
<form action="book_deletesql.php" method="post">
            <select name="col" >
			
            <option value="book_name">Title</option>
			<option value="book_id">Book ID</option>
              <option value="author">Author</option>
			  <option value="book_no">ISBN</option>
              <option value="publisher">Publisher</option>
			  <option value="pub_date">Publish Date</option>
			  <option value="price">Original Price</option>
			  <option value="price_d">Discounted Price</option>
			  <option value="price_m">Member Price</option>
			  <option value="book_storenum">Stock Number</option>
			  <option value="book_class_id">Book Subclass ID</option>
			  <option value="book_type_id">Book Type ID</option>
			  <option value="book_index">Catalog</option>
			  <option value="book_abstract">Abstract</option>
			  <option value="book_level">Rate</option>
			  <option value="book_level_pic">Rate Picture</option>
			  <option value="book_pic">Cover Picture</option>
			  <option value="input_date">Input Date</option>
			  <option value="book_bs">Wrap</option>
			  <option value="book_view">View Times</option>
			  </select>
			  
			 <input type="text" name="del" maxlength="50"/><br/>
<input type="submit" />
</form>
</body>
</html>
