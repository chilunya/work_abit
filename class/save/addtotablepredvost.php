<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");

	$obj = new get_function();
		// редактируем запись
		// SELECT PREDM_VOSTAN.ID, PREDM_VOSTAN.Predmet, PREDM_VOSTAN.Krat_pred FROM PREDM_VOSTAN
		if ($_GET['point'] == 1){
			$obj->config();
			$id_s = $_POST['id_kyr'];
			$sql="UPDATE PREDM_VOSTAN SET 
			Predmet='".$_POST['name_'.$id_s]."',
			Krat_pred='".$_POST['krname_'.$id_s]."'   
			WHERE ID = ".$id_s."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=10&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM PREDM_VOSTAN WHERE ID = ".$_GET['id_k'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=10&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kodsp']);
			$obj->config();
			$obr="INSERT INTO PREDM_VOSTAN (Predmet, Krat_pred) VALUES ('".$_POST['name']."', '".$_POST['krname']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=10&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE PREDM_VOSTAN";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=10&open=open');
		}
?>