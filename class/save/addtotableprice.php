<?php session_start();		
// таблица направления "SPEC"
include_once("../get_function.php");

	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			$id_p = $_POST['id_pr'];
			$sql="UPDATE price2013 SET 
			spec=".$_POST['napr_'.$id_p].", 
			formaobuch=".$_POST['form_'.$id_p].",  
			price=".$_POST['price_'.$id_p].", 
			russ=".$_POST['rezid_'.$id_p]." 
			WHERE ID = ".$id_p."
			";
			//echo $obr;
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=3');
			
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			$zhurn = "DELETE FROM price2013 WHERE ID = ".$_GET['id_pr'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=3');
		}
		
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			//$kod_sp = str_replace(",", ".", $_POST['kod']);
			$obj->config();
			$obr="INSERT INTO price2013 (spec, formaobuch, price, russ) VALUES (".$_POST['napr'].", ".$_POST['form'].", ".$_POST['price'].", ".$_POST['rezid'].")";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=3');

		}
		if ($_GET['point'] == 4){
			$obj->config();
			$obr="TRUNCATE TABLE price2013";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=3');
		}
?>