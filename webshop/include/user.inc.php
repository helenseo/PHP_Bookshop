<?php
 class user extends DBSQL{//
   private$_DB;   //˽������$_DB���������ݱ������
   public function user(){
      parent::__construct();   //���ظ��๹�캯�����������ݿ�����
      $_DB="member";
      mysql_select_db($_DB) or die("�޷�ѡ�����ݿ⣡");
   }
}
?>