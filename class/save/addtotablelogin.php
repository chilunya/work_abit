<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");
// SELECT id, date_sob FROM date_sobes ORDER BY id
	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_p = $_POST['id_s'];
			$sql="UPDATE pass SET 
			log='".$_POST['log_'.$id_p]."', 
			pass='".$_POST['pas_'.$id_p]."', 
			level='".$_POST['lvl_'.$id_p]."', 
			fio='".$_POST['fio_'.$id_p]."'   
			WHERE userid = ".$id_p."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=11&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM pass WHERE userid = ".$_GET['id_k'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=11&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO pass (log, pass, level, fio) VALUES ('".$_POST['log']."', '".$_POST['pas']."', '".$_POST['lvl']."', '".$_POST['fio']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=11&open=open');

		}
		
?>