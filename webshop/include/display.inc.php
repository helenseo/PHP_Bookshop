<?php
class display{
   public $_pageSize=5;   //ÿҳ��ʾ����
   private $_data;   //Ҫ��ҳ������
   private $_pageNum=1;   //��ҳ��
/**
   *���ܣ����캯��
   *������$dataҪ��ҳ�����ݣ�$pageSizeÿҳ��ʾ����
   */
   public function __counstruct($data,$pagesize=5){
      if($pagesize>0) $this->_pageSize=$pagesize; 
      $this->_data=$data;
      $this->_pageNum=$this->GetpageNum($data);
   }
/**
   *���ܣ�ȡ����ҳ��
   */
   public function GetpageNum($data){
      $data_num=count($data);
      $pagelast=ceil($data_num/$this->_pageSize);
      return $pagelast;
   }
/**
   *���ܣ����ɷ�ҳ������
   */
   public function GetJumpBar($data,$page=1,$url){
      $count=count($data);
      $pagelast=$this->GetpageNum($data);
      $strJumpBar="";
      if($pagelast<1) $pagelast=1;
      if($page>$pagelast) $page=$pagelast;
      if($count==0) {
         $msg1="No Information";
         $pagelast=0;
      }
      else {
         $msg1="Current Page".$page;
         if($page<>1) $strJumpBar.="<a href='".$url."1'>Page 1</a> ";
         else $strJumpBar.="Page 1";
         $strJumpBar.=" | ";
         if($page>1) $strJumpBar.="<a href='".$url.($page-1)."'>Previous</a> | ";
         if($page<$pagelast) $strJumpBar.="<a href='".$url.($page+1)."'>Next</a> | ";
         if($page!=$pagelast) $strJumpBar.="<a href='".$url.($pagelast)."'>Last</a> ";
         else $strJumpBar.=" Last";
      }
      return array('JumpBar'=>$strJumpBar,'msg'=>$msg1);
   }
}
?>