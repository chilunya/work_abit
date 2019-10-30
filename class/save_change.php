<?php
include_once("get_function.php");
if ($_POST['check_agry_change']== true) {	
		$obj = new get_function();
		$obj->config();
		
//+++++++++++++++++++++++
//if ( $_FILES['userfile']['error'] != 4){		

//$nam=$_POST['fam']."_".$_POST['name']."_".$_POST['otch'];
// проверяем есть ли фото
//$url = "../photo/".$nam.".jpg";
// пробуем открыть файл для чтения
//if (@fopen($url, "r")) {
	// удаляем фалй если такой есть
//	unlink($url);
//} 
	// если файл не найден показываем no name
//echo '<p><img src="photo/no_name.jpg" class="img-polaroid"></p>'; 

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

//print "</pre>";	
//}
//+++++++++++++++++++++++	
		if ($_POST['inostran'] == "3"){$inostran=3;} else {$inostran=1;}
		$obr = "UPDATE INFO SET 
		fam='".$_POST['fam']."', 
		name='".$_POST['name']."', 
		otch='".$_POST['otch']."', 
		data_rozhd='".$_POST['data_rozhd']."', 
		pol=".$_POST['pol'].", 
		pasport_ser='".$_POST['pasport_ser']."', 
		pasport_nom='".$_POST['pasport_nom']."', 
		pasport_kemvidan='".$_POST['pasport_kemvidan']."', 
		birth_place='".$_POST['birth_place']."', 
		pasport_data='".$_POST['pasport_data']."', 
		gosudarstvo=".$_POST['gosudarstvo'].", 
		type_sity='".$_POST['type_sity']."', 
		name_sity='".$_POST['name_sity']."', 
		rayon_centr='".$_POST['rayon_centr']."', 
		selo=".$_POST['selo'].", 
		type_str=".$_POST['type_str'].", 
		ulica='".$_POST['ulica']."', 
		dom='".$_POST['dom']."', 
		kvart='".$_POST['kvart']."', 
		telefon='".$_POST['telefon']."', 
		uch_zavedenie='".$_POST['uch_zavedenie']."', 
		nazvanie='".$_POST['nazvanie']."', 
		nom_uch_zaved='".$_POST['nom_uch_zaved']."', 
		god_okonch='".$_POST['god_okonch']."', 
		document='".$_POST['document']."', 
		doc_type_sity='".$_POST['doc_type_sity']."', 
		doc_name_sity='".$_POST['doc_name_sity']."', 
		doc_ser='".$_POST['doc_ser']."', 
		doc_nom='".$_POST['doc_nom']."', 
		doc_data='".$_POST['doc_data']."', 
		inostr_yaz=".$_POST['inostr_yaz'].", 
		medal='".$_POST['medal']."', 
		obwezhit='".$_POST['obwezhit']."', 
		vozvrat='".$_POST['vozvrat']."', 
		ege_ser='".$_POST['ege_ser']."', 
		ege_reg='".$_POST['ege_reg']."', 
		inostran=".$inostran.", 
		mail='".$_POST['mail']."' WHERE ID='".$_GET['id']."'";	
	echo $obr;
		$res_obr = mysql_query($obr);

		mysql_close($dbcnx);
		header('Location: ../index.php?pages=1&cl=2&id='.$_GET['id'].'&open=open');

		}
else {
		header('Location: ../index.php?pages=1&cl=2&id='.$_GET['id']);
		}

		?>