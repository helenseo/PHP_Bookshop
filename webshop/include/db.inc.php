<?php
/**  private
   ���ܣ����ݿ�Ļ���������
   **/
class DBSQL{
   private $CONN="";   //�������ݿ����ӱ���
/**
   *���ܣ����캯�����������ݿ�
   */
    public function __construct(){
      $connect=mysql_connect(DBHost,DBUser,DBPassword) or die("cannot connect to database��");
      mysql_query("set names'gb2312'");
      mysql_select_db(DBName) or die("Database not exists");
      $this->CONN=$connect;
   }
/**
   *���ܣ����ݿ��ѯ����
   *������$sqlSQL���
   *���أ���Ψ�����false
   */
   public function select($sql){   
      if(empty($sql)) return false;   //���SQL���Ϊ���򷵻�FALSE
      if(empty($this->CONN)) return false;   //�������Ϊ���򷵻�FALSE
      $results=mysql_query($sql,$this->CONN);
      if((!$results)or(empty($results))){   //�����ѯ���Ϊ�����ͷŽ��������FALSE
         @mysql_free_result($results);
         return false;
      }
      $count=0;
      $data=array();
      while($row=@mysql_fetch_array($results)){   //�Ѳ�ѯ��������һ����ά����
         $data[$count]=$row;
         $count++;
      }
      @mysql_free_result($results);
      return $data;
   }
/**
   *���ܣ����ݲ��뺯��
   *������$sqlSQL���
   *���أ�0���²������ݵ�ID
   */
   public function insert($sql=""){
      if(empty($sql)) return 0;   //���SQL���Ϊ���򷵻�FALSE
      if(empty($this->CONN)) return 0;   //�������Ϊ���򷵻�FALSE
      try{   //�������ݿ�ѡ�������ʾ�����ļ�
         $results=mysql_query($sql,$this->CONN);
      }catch(Exception$e){
         $msg=$e;
         include(ERRFILE);
      }
      if(!$results) return 0;   //�������ʧ�ܷ���0�����򷵻ص�ǰ��������ID
      else return @mysql_insert_id($this->CONN);
   }
/**
   *���ܣ����ݸ��º���
   *������$sqlSQL���
   *���أ�TRUEORFALSE
   */
   public function update($sql=""){
      if(empty($sql)) return false;   //���SQL���Ϊ���򷵻�FALSE
      if(empty($this->CONN)) return false;   //�������Ϊ���򷵻�FALSE
      try{   //�������ݿ�ѡ�������ʾ�����ļ�
         $result=mysql_query($sql,$this->CONN);
      }catch(Exception$e){
         $msg=$e;
         include(ERRFILE);
      }
      return $result;
   }
/**
   *���ܣ�����ɾ������
   *������$sqlSQL���
   *���أ�TRUEORFALSE
   */
   public function delete($sql=""){
      if(empty($sql)) return false;   //���SQL���Ϊ���򷵻�FALSE
      if(empty($this->CONN)) return false;   //�������Ϊ���򷵻�FALSE
      try{
         $result=mysql_query($sql,$this->CONN);
      }catch(Exception$e){
         $msg=$e;
         include(ERRFILE);
      }
      return $result;
   }
/**
   *���ܣ���������
   */
   public function begintransaction(){
      mysql_query("SETAUTOCOMMIT=0");   //����Ϊ���Զ��ύ��MySQLĬ������ִ��
      mysql_query("BEGIN");//��ʼ������
   }
/**
   *���ܣ��ع�
   */
   public function rollback(){
      mysql_query("ROOLBACK");
   }
/**
   *���ܣ��ύִ��
   */
   public function commit(){
      mysql_query("COMMIT");
   }
}
?>