<?php session_start();		
// таблица направления "plan_budg" и "plan_kont"
include_once("../get_function.php");
// SELECT ID, IDspec, IDformaobuch_budg, IDkontrakt_budg, plan_budg, svodka12 FROM plan_budg 
// SELECT ID, IDspec, IDformaobuch_kont, IDkontrakt_kont, plan_kont, svodka12 FROM plan_kont 
	$obj = new get_function();
		// редактируем запись
		if ($_GET['point'] == 1){
			$obj->config();
			
			if ($_GET['kon'] == 1){
			$id_p = $_POST['id_pl'];
			$sql="UPDATE plan_budg SET 
			IDspec='".$_POST['napr_'.$id_p]."',
			IDformaobuch_budg='".$_POST['form_'.$id_p]."',  
			plan_budg='".$_POST['plan_'.$id_p]."',
			svodka12=".$_POST['svod_'.$id_p]." 
			WHERE ID = ".$id_p."
			";
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=1');
			}
			if ($_GET['kon'] == 2){
			$id_p = $_POST['id_pl'];
			$sql="UPDATE plan_kont SET 
			IDspec='".$_POST['napr_'.$id_p]."',
			IDformaobuch_kont='".$_POST['form_'.$id_p]."',  
			plan_kont='".$_POST['plan_'.$id_p]."',
			svodka12=".$_POST['svod_'.$id_p]." 
			WHERE ID = ".$id_p."
			";
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=2');
			}
			// SELECT ID, IDspec, IDkontrakt, cp_plan, IDformobuch FROM cp_plan ORDER BY ID
			if ($_GET['kon'] == 3){
			$id_p = $_POST['id_pl'];
			$sql="UPDATE cp_plan SET 
			IDspec='".$_POST['napr_'.$id_p]."',
			IDformobuch='".$_POST['form_'.$id_p]."',  
			cp_plan='".$_POST['plan_'.$id_p]."',
			IDkontrakt=1  
			WHERE ID = ".$id_p."
			";
			$res_obr = mysql_query($sql);
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=3');
			}
		}
		
		// удаляем запись
		if ($_GET['point'] == 2){
			$obj->config();
			if ($_GET['kon'] == 1){
			$zhurn = "DELETE FROM plan_budg WHERE ID = ".$_GET['id_pl'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=1');
			}
			if ($_GET['kon'] == 2){
			$zhurn = "DELETE FROM plan_kont WHERE ID = ".$_GET['id_pl'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=2');
			}
			if ($_GET['kon'] == 3){
			$zhurn = "DELETE FROM cp_plan WHERE ID = ".$_GET['id_pl'];
			$res_zhurn = mysql_query($zhurn); 
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=3');
			}
		}
// SELECT ID, IDspec, IDformaobuch_budg, IDkontrakt_budg, plan_budg, svodka12 FROM plan_budg 
// SELECT ID, IDspec, IDformaobuch_kont, IDkontrakt_kont, plan_kont, svodka12 FROM plan_kont 
		// добавляем новую запись 
		if ($_GET['point'] == 3){
			$obj->config();
			if ($_GET['kon'] == 1){
			$obr="INSERT INTO plan_budg (IDspec, IDformaobuch_budg, plan_budg, svodka12) VALUES ('".$_POST['napr']."', '".$_POST['form']."', '".$_POST['plan']."', '".$_POST['svod']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=1');
			}
			if ($_GET['kon'] == 2){
			$obr="INSERT INTO plan_kont (IDspec, IDformaobuch_kont, plan_kont, svodka12) VALUES ('".$_POST['napr']."', '".$_POST['form']."', '".$_POST['plan']."', '".$_POST['svod']."')";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=2');
			}
			if ($_GET['kon'] == 3){
			$obr="INSERT INTO cp_plan (IDspec, IDformobuch, cp_plan, IDkontrakt) VALUES ('".$_POST['napr']."', '".$_POST['form']."', '".$_POST['plan']."', 1)";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=3');
			}
		}
		if ($_GET['point'] == 4){
			$obj->config();
			if ($_GET['kon'] == 1){
			$obr="TRUNCATE TABLE plan_budg";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=1');
			}
			if ($_GET['kon'] == 2){
			$obr="TRUNCATE TABLE plan_kont";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=2');
			}
			if ($_GET['kon'] == 3){
			$obr="TRUNCATE TABLE cp_plan";
			//echo $obr;
			$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));
			header('Location: ../../index.php?pages=24&cl=25&fl=2&kon=3');
			}
		}
?>