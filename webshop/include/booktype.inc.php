<?php
class booktype extends DBSQL{
   public function __construct(){   //���ظ��๹�캯�����������ݿ�����
      parent::__construct();
   }
/**
   *���ܣ���ȡͼ�����б�
   *���أ�����
   */
   public function GetBkTypeList(){
      $sql="SELECT * FROM book_type";
      $b=$this->select($sql);
      return $b;
   }
/**
   *���ܣ���ȡͼ������б�
   *������ͼ�����
   *���أ�����
   */
   public function GetBkClassList($search=1){
      $sql="SELECT * FROM book_class WHERE book_type_id='$search'";
      $b=$this->select($sql);
      return $b;
   }
/**
	*���ܣ������˵��Ķ����˵������Ŀ
	*���أ��ַ���
	*/
     public function numb_item($itemno){
		 $bktclist=$this->GetBkClassList($itemno);
         $ccount=count($bktclist);
		 return $ccount;
     }
/**
	*���ܣ������˵��Ķ����˵���
	*���أ��ַ���
	*/
   public function nemu_item($itemno){
	  $bktclist=$this->GetBkClassList($itemno);
      $ccount=count($bktclist);   //ͳ�Ƶ����˵��Ķ����˵������Ŀ
      for($k=0;$k<$ccount;$k++)
         $item.="&nbsp;&nbsp;&nbsp;&nbsp;<a href='webshop/book_show.php?title=".$bktclist[$k][book_class_name]."&&page=1&&serach=book_class_id=".$bktclist[$k][book_class_id]."' target='mainFrame'>".$bktclist[$k][book_class_name]."</a><br>";
      return $item;
   }
}
?>