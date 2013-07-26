<!--sys_conf.inc:系统配置文件-->
<?php
   //数据库配置全局变量
   $DBHOST="localhost";
   $DBUSER="c63702";
   $DBPWD="1db23";
   $DBNAME="c63702";
   function isEmail($str){
	   $pattern="/^[a-zA-Z][\w]*@[\w]+(\.[\w]+)+$/";
	   if(preg_match($pattern, $str)==1) return true;
	   else return false;
   }
   function isuserID($str){
	   $pattern="/^[\-a-zA-Z][\-\w]{3,29}$/";
	   if(preg_match($pattern, $str)==1) return true;
	   else return false;
   }
   function isPost($str){
	   $pattern="/^([1-9]{1})([0-9]{5})$/";
	   if(preg_match($pattern, $str)==1) return true;
	   else return false;
   }
   function isPhone($str){
	   $pattern="/(^0[1-9]{2,3})\-([1-9]{8})$/";
	   if(preg_match($pattern, $str)==1) return true;
	   else {
	     $pattern="/(^1[3,5,8]{1})([0-9]{9})$/";
	     if(preg_match($pattern, $str)==1) return true;
             else return false;
          }
   }
?>
