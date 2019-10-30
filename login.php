<?php session_start();
include("class/logmein.php");  
$log = new logmein();     //инициализация класса
$log->dbconnect();        //подключаем базу
$log->encrypt = false;
echo $log->logout();
include("index.php");
	?>
      