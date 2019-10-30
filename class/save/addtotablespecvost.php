<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");

	$obj = new get_function();
		// редактируем запись
		// SELECT SPEC_VOSTAN.ID, SPEC_VOSTAN.ID_spec, SPEC_VOSTAN.spec, SPEC_VOSTAN.krat_spec, SPEC_VOSTAN.fac, SPEC_VOSTAN.formaobuch FROM SPEC_VOSTAN ORDER BY SPEC_VOSTAN.spec
		if ($_GET['point'] == 1){
			$obj->config();
			$id_s = $_POST['id_kyr'];
			$sql="UPDATE SPEC_VOSTAN SET 
			ID_spec='".$_POST['kodsp_'.$id_s]."',
			spec='".$_POST['name_'.$id_s]."',  
			krat_spec='".$_POST['krname_'.$id_s]."', 
			fac='".$_POST['fac_'.$id_s]."',
			formaobuch=".$_POST['form_'.$id_s]." 
			WHERE ID = ".$id_s."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=9&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM SPEC_VOSTAN WHERE ID = ".$_GET['id_k'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=9&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			$kod_sp = str_replace(",", ".", $_POST['kodsp']);
			$obj->config();
			$obr="INSERT INTO SPEC_VOSTAN (ID_spec, spec, krat_spec, fac, formaobuch) VALUES ('".$kod_sp."', '".$_POST['name']."', '".$_POST['krname']."', '".$_POST['fac']."', '".$_POST['form']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=9&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE SPEC_VOSTAN";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=9&open=open');
		}
?>