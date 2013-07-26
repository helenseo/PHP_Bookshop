<?php $title="新会员申请";?>
<?php require_once("reghead.php");?> 
<script language="JavaScript">   
   function pdsr(){
      var pds=window.frm.password.value;   
      var pds1=window.frm.passwd1.value;         
      var id=window.frm.userid.value;
      if (id==""){
         window.alert("userid不能为空");
         window.frm.password.focus();
      }
      if (pds==""){
         window.alert("密码不能为空");
         window.frm.password.focus();
      }
      else if(pds.length<6 || pds.length>20){
         window.alert("密码长度不合法,请重新输入");
         window.frm.password.value="";
         window.frm.password.focus();
      }
      else if (pds1!=window.frm.password.value)   {
         window.alert("两次密码输入不匹配,请重新输入");
         window.frm.passwd1.value="";
         window.frm.passwd1.focus();            
       }
   }
</script>
    <div id="err"><a href="applycard.php">注册购书卡</a>|填写会员信息&gt;&gt;</div>
    <div id="bt">填写会员信息<hr /></div>
    <div id="bd"><form method="POST"  name="frm" action="success.php">
      <table  width="100%" border="0" cellspacing="0" class="tdl">
          <tr><td colspan="2" align="center" >带&nbsp;*&nbsp;的选项是必须填写的</td>
          </tr>
          <tr><td width="30%"align="right">新会员id　</td>
              <td id="bitem"><input type="TEXT" name="userid" value="<? echo $userid; ?>" size="20" />&nbsp;*&nbsp;&nbsp;</td>  <!--显示前面填写的新会员id-->
          </tr>
          <tr><td align="right" class="tdl">新会员密码　</td>
              <td><input type="password" name="password" size="20" />&nbsp;*&nbsp;&nbsp;
              (密码位数6-20，必须由字母与数字组成)</td>
          </tr>
          <tr><td align="right">再次输入密码　</td><!--输入两次密码以确保密码输入无误-->
 <td><input type="password" size="20" name="passwd1" />&nbsp;*&nbsp;&nbsp;</td>
          </tr>
          <tr><td align="right">姓名　</td>
            <td><input type="TEXT" size="20" name="username" /></td>
           </tr>
          <tr><td align="right">Email　</td>
            <td><input type="TEXT" size="20" name="email" /></td>
           </tr>
          <tr><td align="right">邮编　</td>
            <td><input type="TEXT"size="20" name="post" /></td>
           </tr>
          <tr><td align=right>地址　</td>
            <td><input type="TEXT" name="addr" size="40" /></td>
           </tr>
          <tr><td align="right">电话号码　</td>
            <td><input type="TEXT" name="phone" size="20" /></td>
           </tr>
          <tr><td colspan="2" align="center"><input type="submit" value="提交" onMouseOver="pdsr()"/>
               <!--保存前面传递的数值到隐藏区域,以传递下一个程序-->
            <input type="hidden" name="cardno" value="<? echo $cardno; ?>">
            <input type="hidden" name="cash" value="<? echo $row[balance]; ?>"></td>
          </tr>
      </table>
      </form>
      </div>
      <div id="err">
          <div align="center" id="bitem"><?php echo $msg; ?></div>
       </div>
     <hr/>
     <iframe scrolling="no" width="780" height="60" src="regbottom.html"  marginwidth="0" marginheight="0" border="0" frameborder="0" align="center" >不支持</iframe>
     </div>
  </body>
</html>