<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");
// SELECT id_decan, FIO_Decan, decanat, id_dec FROM DECAN
	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_d = $_POST['id_dec'];
			$sql="UPDATE DECAN SET 
			FIO_Decan='".$_POST['name_dec_'.$id_d]."', 
			decanat='".$_POST['dec_'.$id_d]."' 
			WHERE id_decan = ".$id_d."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=6&open=open');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM DECAN WHERE id_decan = ".$_GET['id_d'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=6&open=open');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO DECAN (FIO_Decan, decanat) VALUES ('".$_POST['name_dec']."', '".$_POST['dec']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=6&open=open');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE DECAN";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=6&open=open');
		}
		
		if ($_GET['point'] == 5){
			$obj->config();
			$obr="UPDATE setting SET sort='".$_POST['optionsRadios']."' WHERE id=1";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25');
		}
		if ($_GET['point'] == 6){
			$obj->config();
			//$id = $_POST['id_spec'];
			for ($i=1;$i<17;$i++){
				if ($_POST['chek_'.$i] == 1){$val = 1;} else {$val = 0;}
			$obr="UPDATE setting_spec SET prik_spec=".$val." WHERE id_spec=".$_POST['id_spec_'.$i]."";
			$res_obr = mysql_query($obr);
			}
			//echo $obr;
			// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25');
		}
?>