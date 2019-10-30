<?php session_start();		
// очищаем таблицы INFO and ZHURNAL
include_once("../get_function.php");
	$obj = new get_function();
			$obj->config();
			if ($_GET['tab'] == 1){
				$obj->config();
				$obr="TRUNCATE TABLE INFO";
				//echo $obr;
				$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
				header('Location: ../../index.php?pages=24&cl=25&open=open');
			}
			if ($_GET['tab'] == 2){
				$obj->config();
				$obr="TRUNCATE TABLE ZHURNAL";
				$obr_ch="TRUNCATE TABLE update_zhur";
				//echo $obr;
				$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
				$res_obr_ch = mysql_query($obr_ch);// or die(header('Location: ../index.php?pages=2&cl=3'));
				header('Location: ../../index.php?pages=24&cl=25&open=open');
			}
			if ($_GET['tab'] == 3){
				$obj->config();
				$obr="TRUNCATE TABLE ZHURNAL_VOSTANOVLENIE";
				//echo $obr;
				$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
				header('Location: ../../index.php?pages=24&cl=25&open=open');
			}
?>