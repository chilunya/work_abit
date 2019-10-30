<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");
// SELECT id, Nom_prot, Data1, Data2 FROM PROTOKOL ORDER BY Nom_prot
	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_p = $_POST['id_prot'];
			$sql="UPDATE PROTOKOL SET 
			Nom_prot=".$_POST['nom_prot_'.$id_p].", 
			Data1='".$_POST['dat1_'.$id_p]."', 
			Data2='".$_POST['dat2_'.$id_p]."'  
			WHERE id = ".$id_p."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=5&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM PROTOKOL WHERE id = ".$_GET['id_p'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=5&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO PROTOKOL (Nom_prot, Data1, Data2) VALUES (".$_POST['nom_prot'].", '".$_POST['dat1']."', '".$_POST['dat2']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=5&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE PROTOKOL";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=5&open=open');
		}
?>