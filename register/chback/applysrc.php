<?php $title="�»�Ա����";?>
<?php require_once("reghead.php");?> 
<script language="JavaScript">   
   function pdsr(){
      var pds=window.frm.password.value;   
      var pds1=window.frm.passwd1.value;         
      var id=window.frm.userid.value;
      if (id==""){
         window.alert("userid����Ϊ��");
         window.frm.password.focus();
      }
      if (pds==""){
         window.alert("���벻��Ϊ��");
         window.frm.password.focus();
      }
      else if(pds.length<6 || pds.length>20){
         window.alert("���볤�Ȳ��Ϸ�,����������");
         window.frm.password.value="";
         window.frm.password.focus();
      }
      else if (pds1!=window.frm.password.value)   {
         window.alert("�����������벻ƥ��,����������");
         window.frm.passwd1.value="";
         window.frm.passwd1.focus();            
       }
   }
</script>
    <div id="err"><a href="applycard.php">ע�Ṻ�鿨</a>|��д��Ա��Ϣ&gt;&gt;</div>
    <div id="bt">��д��Ա��Ϣ<hr /></div>
    <div id="bd"><form method="POST"  name="frm" action="success.php">
      <table  width="100%" border="0" cellspacing="0" class="tdl">
          <tr><td colspan="2" align="center" >��&nbsp;*&nbsp;��ѡ���Ǳ�����д��</td>
          </tr>
          <tr><td width="30%"align="right">�»�Աid��</td>
              <td id="bitem"><input type="TEXT" name="userid" value="<? echo $userid; ?>" size="20" />&nbsp;*&nbsp;&nbsp;</td>  <!--��ʾǰ����д���»�Աid-->
          </tr>
          <tr><td align="right" class="tdl">�»�Ա���롡</td>
              <td><input type="password" name="password" size="20" />&nbsp;*&nbsp;&nbsp;
              (����λ��6-20����������ĸ���������)</td>
          </tr>
          <tr><td align="right">�ٴ��������롡</td><!--��������������ȷ��������������-->
 <td><input type="password" size="20" name="passwd1" />&nbsp;*&nbsp;&nbsp;</td>
          </tr>
          <tr><td align="right">������</td>
            <td><input type="TEXT" size="20" name="username" /></td>
           </tr>
          <tr><td align="right">Email��</td>
            <td><input type="TEXT" size="20" name="email" /></td>
           </tr>
          <tr><td align="right">�ʱࡡ</td>
            <td><input type="TEXT"size="20" name="post" /></td>
           </tr>
          <tr><td align=right>��ַ��</td>
            <td><input type="TEXT" name="addr" size="40" /></td>
           </tr>
          <tr><td align="right">�绰���롡</td>
            <td><input type="TEXT" name="phone" size="20" /></td>
           </tr>
          <tr><td colspan="2" align="center"><input type="submit" value="�ύ" onMouseOver="pdsr()"/>
               <!--����ǰ�洫�ݵ���ֵ����������,�Դ�����һ������-->
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
     <iframe scrolling="no" width="780" height="60" src="regbottom.html"  marginwidth="0" marginheight="0" border="0" frameborder="0" align="center" >��֧��</iframe>
     </div>
  </body>
</html>