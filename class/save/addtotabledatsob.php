<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");
// SELECT id, date_sob FROM date_sobes ORDER BY id
	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_p = $_POST['id_sob'];
			$sql="UPDATE date_sobes SET 
			date_sob='".$_POST['dat_'.$id_p]."'  
			WHERE id = ".$id_p."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=4&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM date_sobes WHERE id = ".$_GET['id_s'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=4&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO date_sobes (date_sob) VALUES ('".$_POST['dat']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=4&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE date_sobes";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=4&open=open');
		}
?>