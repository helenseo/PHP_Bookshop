<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
    <title>Search Book</title>
    <link href="css/left.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
    function ck_frm1(){
      var err="";
      var oj=window.frm1.input;
      if (oj.value==""){
        err="Input Cannot be Empty!";
        window.alert(err);
        oj.focus();
        oj.value="";
      }
    }
    </script>
  </head>
  <body>
    <div id="leftbg" align="left">
      <div id="nume">
        <form name="frm1" method="post" action="search_key.php" target="mainFrame">
          <fieldset><legend class="bt">Search Book</legend>
            <input name="keys" id="sele" class="text" type="text" value="Input" size="18" maxlength="20" onClick="this.value='';"/><br/>&nbsp;
            <select id="sele" name="selt1" value="Fields" >
              <option value="book_name">Title</option>
              <option value="author">Author</option>
			  <option value="book_no">ISBN</option>
              <option value="publisher">Publisher</option></select>
            <input type="submit" name="button" value="Search"  onmousedown="ck_frm1();"/>
          </fieldset>
        </form>
      </div>
      <div id="fl">  
        <form>
          <fieldset><legend class="bt">Categories Search</legend>
            <iframe name="numeFrame" allowtransparency="true" scrolling="no" width="165" src="left_menu.php" marginwidth="0" marginheight="0" border="0" frameborder="0">Not Surpported</iframe> 
            </fieldset>
        </form>
      </div>
      <div id="fl">  
        <form>
          <fieldset><legend class="bt">Related Links</legend>
            <a href="http://www.amazon.com">Amazon</a><br/>
            <a href="http://www.ebay.com">Ebay</a>
          </fieldset>
        </form>
      </div>
    </div>
  </body>
</html>