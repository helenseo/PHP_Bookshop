<?php
class control extends DBSQL {
   public $_pageSize;   //����ÿҳ��ʾ�ļ�¼��
   public function control(){   //���ظ��๹�캯�����������ݿ�����
      parent::__construct();
      $this->_pageSize=8;
     }
/**
     *���ܣ���ȡָ�����ݱ���������ļ�¼
     *���������ݱ�Ͳ�ѯ���� 
     *���أ�����
     */
   public function GetDTdataset($DTname,$serach){
      $sql="SELECT * FROM $DTname WHERE ".$serach;
      $data_s=$this->select($sql);
      return $data_s;
     }
/**
     *���ܣ���ȡͼ����Ϣ
     *���������ݱ�Ͳ�ѯ���� 
     *���أ�����
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
     *���ܣ���ҳ��ȡͼ��/�����б�
     *��������ǰҳ�� 
     *���أ�����
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
   *���ܣ���ȡ��Ч�ַ���
   *���أ��ַ���
      */
   public function Getstr($str="",$num=20){
      $i=strlen($str);
      if($i<=$num) return $str;
      else return substr($str,0,$num-3)."...";
   }
 }
?>