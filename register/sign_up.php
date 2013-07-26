
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/register.css" rel="stylesheet" type="text/css" />
<title>sign up</title>
</head>
<body>

<div id="bt">Sign up here!</div>
<div id="bd" class="tdl">   <hr/>
<form name="sign" action="success.php" method="post">
User ID<input type="text" name="userid"/> 
<font color="#FF0000"><span>*</span></font> <br/>
Username<input type="text" name="username"/>
<font color="#FF0000"><span>*</span></font><br/>
Password<input type="text" name="password"/>
<font color="#FF0000"><span>*</span></font><br/>
Confirm Password<input type="text" name="password"/>
<font color="#FF0000"><span>*</span></font><br/>
Email<input type="text" name="email"/>
<font color="#FF0000"><span id="errorEmail">*</span></font><br/>
Address<input type="text" name="addr"/><br/>
Post Code<input type="text" name="post"/><br/>
Phone Number<input type="text" name="phone"/><br/>
<input type="submit" value="submit"/> <input type="reset" value="reset"/>

</form>
</div>
</body>
</html>