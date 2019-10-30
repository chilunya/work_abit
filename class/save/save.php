<?php session_start();		
include_once("../get_function.php");
if ($_POST['result'] == $_POST['summa']) {

		$obj = new get_function();
		$obj->config();
//+++++++++++++++++++++++		
//if ( $_FILES['userfile']['error'] != 4){
//$photo_name=$_POST['fam']."_".$_POST['name']."_".$_POST['otch'];
//$uploaddir = '../photo/'.$photo_name.'.jpg';
//$uploadfile = $uploaddir . basename($_FILES['userfile']);
//echo '<pre>';
//if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
//    echo "File is valid, and was successfully uploaded.\n";
//} else {
//    echo "Possible file upload attack!\n";
//}
//echo 'Here is some more debugging info:';
//print_r($_FILES);
//}

//+++++++++++++++++++++++	
		//if ($_POST['bal1'] != ""){$mesto1=2;} else {$mesto1=1;}
		//if ($_POST['bal2'] != ""){$mesto2=2;} else {$mesto2=1;}
		//if ($_POST['bal3'] != ""){$mesto3=2;} else {$mesto3=1;}
		//if ($_POST['bal4'] != ""){$mesto4=2;} else {$mesto4=1;}
		//if ($_POST['bal5'] != ""){$mesto5=2;} else {$mesto5=1;}
		//if ($_POST['inostran'] == "3"){$inostran=3;} else {$inostran=1;}
		//$compare_fio = preg_match('/([А-Яа-я ]+)/u',$fio);
		//$compare_email = preg_match('/(.+@.+\..+)/u',$_POST['mail']);
		
		if ($_POST['inostran'] != "3"){
		$fam = str_replace(" ", "", $_POST['fam']);  
		$name = str_replace(" ", "", $_POST['name']);
		$otch = str_replace(" ", "", $_POST['otch']);
		$inostran = 1;			
			} 
			else {
		$fam = $_POST['fam'];  
		$name = $_POST['name'];
		$otch = $_POST['otch'];
			}
		$pasp_ser = str_replace(" ", "", $_POST['pasport_ser']);  
		$pasp_nom = str_replace(" ", "", $_POST['pasport_nom']);	
		if (!isset($_POST['fl_indiv'])){ $flind=0;}
		else {$flind=1;}
		
		//ege_ser, ege_reg, bal1, bal2, bal3, bal4, bal5, pred_mesto1, pred_mesto2, pred_mesto3, pred_mesto4, pred_mesto5, 
		$obr = "INSERT INTO INFO (fam, name, otch, data_rozhd, pol, pasport_ser, pasport_nom, pasport_kemvidan, birth_place, pasport_data, gosudarstvo, type_sity, name_sity, rayon_centr, selo, type_str, ulica, dom, kvart, telefon, uch_zavedenie, nazvanie, nom_uch_zaved, god_okonch, document, doc_type_sity, doc_name_sity, doc_ser, doc_nom, doc_data, inostr_yaz, medal, obwezhit, vozvrat, inostran, mail, employee_name, fl_indiv) 
		VALUES (
		'".$fam."', 
		'".$name."', 
		'".$otch."', 
		'".$_POST['data_rozhd']."', 
		".$_POST['pol'].", 
		'".$pasp_ser."', 
		'".$pasp_nom."', 
		'".$_POST['pasport_kemvidan']."', 
		'".$_POST['birth_place']."', 
		'".$_POST['pasport_data']."', 
		".$_POST['gosudarstvo'].", 
		'".$_POST['type_sity']."', 
		'".$_POST['name_sity']."', 
		'".$_POST['rayon_centr']."', 
		".$_POST['selo'].", 
		".$_POST['type_str'].", 
		'".$_POST['ulica']."', 
		'".$_POST['dom']."', 
		'".$_POST['kvart']."', 
		".$_POST['telefon'].",  
		".$_POST['uch_zavedenie'].", 
		'".$_POST['nazvanie']."', 
		'".$_POST['nom_uch_zaved']."', 
		".$_POST['god_okonch'].", 
		".$_POST['document'].", 
		".$_POST['doc_type_sity'].", 
		'".$_POST['doc_name_sity']."', 
		'".$_POST['doc_ser']."', 
		'".$_POST['doc_nom']."', 
		'".$_POST['doc_data']."', 
		'".$_POST['inostr_yaz']."', 
		'".$_POST['medal']."', 
		'".$_POST['obwezhit']."', 
		'".$_POST['vozvrat']."',  
		'".$inostran."', 
		'".$_POST['mail']."', 
		'".$_SESSION['nnname']."', 
		".$flind.")";	

		echo $obr;
		$res_obr = mysql_query($obr) or die(header('Location: ../../index.php'));

		mysql_close($dbcnx);
	
		header('Location: ../../index.php?open=open');

		}
else {
		header('Location: ../../index.php');
		}

		?>