   <script language="JavaScript">
      function jcud(){
         var cds1=window.frm.userid.value;
         var cds2=window.frm.password.value;
         var cds3=window.frm.verify.value;
         if (cds1==""){
            window.alert("user id cannot be empty.");
            window.frm.userid.focus();
         }
         else if (cds2==""){
            window.alert("password cannot be empty.");
            window.frm.password.focus();
         }
         else if (cds3==""){
            window.alert("Enter the verify code.");
            window.frm.verify.focus();
        }
	  }
   </script>
   <div id="bt">Please log in</div>
   <div id="bd" class="tdl">   <hr/>
      <form method="POST" name="frm" action="login.php">
       <table width="100%" border="0">
          <tr><td align="right">User ID:</td>
            <td><input type="text" name="userid" size="30" />*</td></tr>
          <tr><td align="right">&nbsp;Password&nbsp;&nbsp;</td>
            <td><input type="password" name="password" size="21" />*</td></tr>
          <tr><td align="right"><input type="submit" name="sub_login" value="login" onclick="jcud()" /></td>
            <td><a href="sign_up.php">sign up</a>
			<!--<input type="submit" name="sign_up" value="sign_up" />--></td></tr>
       </table>
      </form>
   </div>
   <div id="err"><?php $msg = $_GET["msg"]; echo "$msg"; ?><br/><br/></div>