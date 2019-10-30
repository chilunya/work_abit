<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");
// SELECT ID, VIDKURSOV FROM VIDKURSOV ORDER BY ID
	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_k = $_POST['id_kyr'];
			$sql="UPDATE VIDKURSOV SET 
			VIDKURSOV='".$_POST['kyrs_'.$id_k]."' 
			WHERE ID = ".$id_k."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=8&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM VIDKURSOV WHERE ID = ".$_GET['id_k'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=8&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO VIDKURSOV (VIDKURSOV) VALUES ('".$_POST['kyrs']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=8&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE VIDKURSOV";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=8&open=open');
		}
?>