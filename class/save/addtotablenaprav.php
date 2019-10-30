<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");

	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_s = $_POST['id_spec'];
			$sql="UPDATE SPEC SET 
			KodSpec='".$_POST['kod_'.$id_s]."',
			NameSpec='".$_POST['nam_'.$id_s]."',  
			KratkoeName='".$_POST['short_'.$id_s]."', 
			predmets='".$_POST['pred_'.$id_s]."',
			NomFak=".$_POST['fac_'.$id_s]." 
			WHERE ID = ".$id_s."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=1&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM SPEC WHERE ID = ".$_GET['id_sp'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=1&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO SPEC (KodSpec, NameSpec, KratkoeName, predmets, NomFak) VALUES ('".$kod_sp."', '".$_POST['nam']."', '".$_POST['short']."', '".$_POST['pred']."', '".$_POST['fac']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=1&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE SPEC";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=1&open=open');
		}
?>