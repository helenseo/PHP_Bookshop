<?php
define("DBHost","localhost");
define("DBUser","c63702"); //mysql user
define("DBPassword","1db23");    //请填写密码
define("DBName","c63702"); // database name
define('Root_Path',dirname(_FILE_).'/');
define("Include_Path","include/");
define("ErrFile","err.php");
   function isEmail($str){
	   $pattern="/^[a-zA-Z][\w]*@[\w]+(\.[\w]+)+$/";
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