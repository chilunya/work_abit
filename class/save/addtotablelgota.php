<?php session_start();		
// таблица ЛЬГОТЫ
include_once("../get_function.php");
// SELECT id_decan, FIO_Decan, decanat, id_dec FROM DECAN
	$obj = new get_function();
	if ($_GET['lg'] == 1){
		// SELECT ID, LGOTAVNEKONK FROM LGOTAVNEKONK ORDER BY ID
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_l = $_POST['id_lgt'];
			$sql="UPDATE LGOTAVNEKONK SET 
			LGOTAVNEKONK='".$_POST['lgota_'.$id_l]."' 
			WHERE ID = ".$id_l."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM LGOTAVNEKONK WHERE ID = ".$_GET['id_l'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO LGOTAVNEKONK (LGOTAVNEKONK) VALUES ('".$_POST['lgota']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE LGOTAVNEKONK";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');
		}
	}
	if ($_GET['lg'] == 2){
		// SELECT ID, LGOTAKONK FROM LGOTAKONK ORDER BY ID
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_l = $_POST['id_lgt'];
			$sql="UPDATE LGOTAKONK SET 
			LGOTAKONK='".$_POST['lgota_'.$id_l]."' 
			WHERE ID = ".$id_l."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM LGOTAKONK WHERE ID = ".$_GET['id_l'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO LGOTAKONK (LGOTAKONK) VALUES ('".$_POST['lgota']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE LGOTAKONK";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=7&open=open');
		}
	}
?>