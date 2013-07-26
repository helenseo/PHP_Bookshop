<?php
class control extends DBSQL {
   public $_pageSize;   //定义每页显示的记录数
   public function control(){   //加载父类构造函数，创建数据库连接
      parent::__construct();
      $this->_pageSize=8;
     }
/**
     *功能：提取指定数据表符合条件的记录
     *参数：数据表和查询条件 
     *返回：数组
     */
   public function GetDTdataset($DTname,$serach){
      $sql="SELECT * FROM $DTname WHERE ".$serach;
      $data_s=$this->select($sql);
      return $data_s;
     }
/**
     *功能：提取图书信息
     *参数：数据表和查询条件 
     *返回：数组
     */
   public function Getbookdata($DTname,$serach){
      $data_s=$this->GetDTdataset($DTname,$serach);
      if($DTname!="book_info"){
         $books=array();
         for($j=0;$j<count($data_s);$j++){
            $sql="SELECT * FROM book_info WHERE book_id=".$data_s[$j][book_id];
            $book=$this->select($sql);
   	         if(is_array($book)) $books=array_merge($books,$book);
         }
         return $books;
      }
       else return $data_s;
     }
/**
     *功能：分页提取图书/订单列表
     *参数：当前页码 
     *返回：数组
     */
   public function GetControlList($dataset,$page=1){
      $control_o=$dataset;
      if($page<1) $page=1;
      $control_num=count($control_o);
      $pagelast=ceil($control_num/$this->_pageSize);
      if($pagelast<1)   $pagelast=1;
      if($page>$pagelast)   $page=$pagelast;
      $pagenum=$control_num-(floor($control_num/$this->_pageSize)*$this->_pageSize);
      if($page<$pagelast || $pagenum==0) $pagenum=$this->_pageSize;
      $start=($page-1)*$this->_pageSize;
      if($start<$control_num) $b=array_slice($control_o,$start,$pagenum);
      return $b;
     }
/**
   *功能：提取有效字符串
   *返回：字符串
      */
   public function Getstr($str="",$num=20){
      $i=strlen($str);
      if($i<=$num) return $str;
      else return substr($str,0,$num-3)."...";
   }
 }
?>