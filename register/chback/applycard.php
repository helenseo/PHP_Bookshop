<?php $title="注册购书卡";?>
<?php require_once("reghead.php");?>
    <script language="JavaScript">
        function jcidd(){
		  var idss=window.frm.userid.value;   
		  var cds=window.frm.cardno.value;
		  var pds=window.frm.cardpsd.value;      
		  if (idss==""){
			 window.alert("新会员id不能为空");
			 window.frm.userid.focus();
		  }
		  else if(idss.length<4 || pds.length>30){
			 window.alert("新会员id长度不合法,请重新输入");
			 window.frm.userid.value="";
			 window.frm.userid.focus();
		  }
		  else if (cds==""){
			 window.alert("购书卡号不能为空");
			 window.frm.cardno.focus();
		  }
		  else if (pds==""){
			 window.alert("购书卡密码不能为空");
			 window.frm.cardpsd.focus();
		  }
      }
    </script>
       <div id="err">注册购书卡&gt;&gt;</div>
       <div id="bt">填写购书卡信息 <hr /></div>
       <div id="bd"><form method="POST"  name="frm" action="apply.php">
            <table  width="100%" border="0" cellspacing="0" class="tdl">
               <tr><td align="right">新会员id　 </td>
                  <td> <input type="TEXT" name="userid" size="30"/>
                  (位数4-30，必须由字母与数字组成)</td>
                </tr>
                <tr><td align="right">购书卡号　 </td>
                   <td> <input type="TEXT" name="cardno" size="30"/>
                      (消费金额将在购物卡中计算)</td>
                </tr>
                <tr><td align="right">购书卡密码　 </td>
                  <td><input type="password" name="cardpsd" size="30"/></td>
               </tr>
               <tr><td  colspan="2" align="center"><input type="submit" name="select" value="下一步"  onMouseOver="jcidd()"><input type="submit" name="select" value="跳过" ></td>
               </tr>
            </table>
          </form>
       </div>
       <div id="err">
          <div align="center"><?php echo $msg; ?></div><br />
          1.如果申请购书卡，就填写表单信息，然后单击【下一步】按钮。<br />
          2.如果不想申请购书卡，就单击“跳过”按钮。
       </div>
     <hr />
     <iframe scrolling="no" width="780" height="60" src="regbottom.html"  marginwidth="0" marginheight="0" border="0" frameborder="0" align="center" >不支持</iframe>
     </div>
  </body>
</html>