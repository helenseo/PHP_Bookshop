<?php
 class user extends DBSQL{//
   private$_DB;   //私有属性$_DB，定义数据表的名称
   public function user(){
      parent::__construct();   //加载父类构造函数，创建数据库连接
      $_DB="member";
      mysql_select_db($_DB) or die("无法选择数据库！");
   }
}
?>