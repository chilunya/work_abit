<?php session_start();
	include_once("../get_function.php");
	$obj = new get_function();
	$obj->config();
	
	if ($_POST['pr_doc'] == 1) {$data_original = date("Y.m.d G:i:s");} else {$data_original = "";}
	
	$sql="SELECT ZHURNAL.ID_zh, ZHURNAL.Priznak_doc, ZHURNAL.Kontrakt, ZHURNAL.Nomer_po_zhurn, ZHURNAL.lgot_vne FROM ZHURNAL WHERE ZHURNAL.ID_zh = ".$_GET['idzh'];
	$res_sql = mysql_query($sql);
	$row_sql = mysql_fetch_array($res_sql, MYSQL_ASSOC);
	
	if ($row_sql['Priznak_doc'] != $_POST['pr_doc']){
		$type_change = 2;
		$before_ch = $row_sql['Priznak_doc'];
		$after_ch = $_POST['pr_doc'];
		$upd="INSERT INTO update_zhur (id_zhurnal, date_change, fio_emplour, before_change, after_change, type_change) VALUES ('".$_GET['idzh']."', '".date("Y.m.d G:i:s")."', '".$_SESSION['nnname']."', '".$before_ch."', '".$after_ch."', '".$type_change."')";
	//echo $upd;
		$res_upd = mysql_query($upd);
	}
	if ($row_sql['Kontrakt'] != $_POST['kontr']){
		$type_change = 3;
		$before_ch = $row_sql['Kontrakt'];
		$after_ch = $_POST['kontr'];
		$upd="INSERT INTO update_zhur (id_zhurnal, date_change, fio_emplour, before_change, after_change, type_change) VALUES ('".$_GET['idzh']."', '".date("Y.m.d G:i:s")."', '".$_SESSION['nnname']."', '".$before_ch."', '".$after_ch."', '".$type_change."')";
	//echo $upd;
		$res_upd = mysql_query($upd);
	}
	if ($row_sql['Nomer_po_zhurn'] != $_POST['number']){
		$type_change = 1;
		$before_ch = $row_sql['Nomer_po_zhurn'];
		$after_ch = $_POST['number'];
		$upd="INSERT INTO update_zhur (id_zhurnal, date_change, fio_emplour, before_change, after_change, type_change) VALUES ('".$_GET['idzh']."', '".date("Y.m.d G:i:s")."', '".$_SESSION['nnname']."', '".$before_ch."', '".$after_ch."', '".$type_change."')";
	//echo $upd;
		$res_upd = mysql_query($upd);
	}
	if ($row_sql['lgot_vne'] != $_POST['lgt']){
		$type_change = 4;
		$before_ch = $row_sql['lgot_vne'];
		$after_ch = $_POST['lgt'];
		$upd="INSERT INTO update_zhur (id_zhurnal, date_change, fio_emplour, before_change, after_change, type_change) VALUES ('".$_GET['idzh']."', '".date("Y.m.d G:i:s")."', '".$_SESSION['nnname']."', '".$before_ch."', '".$after_ch."', '".$type_change."')";
	//echo $upd;
		$res_upd = mysql_query($upd);	
	}
	//$upd="INSERT INTO update_zhur (id_zhurnal, date_change, fio_emplour, before_change, after_change, type_change) VALUES ('".$_GET['idzh']."', '".date("Y.m.d G:i:s")."', '".$_SESSION['nnname']."', '".$before_ch."', '".$after_ch."', '".$type_change."')";
	//echo $upd;
	//$res_upd = mysql_query($upd);
	
	mysql_free_result($res_upd);
	mysql_free_result($row_sql);
	//if ($_POST['akad_b'])
	$obr="UPDATE ZHURNAL SET 
	Nomer_po_zhurn=".$_POST['number'].", 
	Priznak_doc=".$_POST['pr_doc'].", 
	Kontrakt='".$_POST['kontr']."', 
	lgot_vne='".$_POST['lgt']."',
	data_podachi_originala='".$data_original."',
	akad_bak='".$_POST['akad_b']."', 
 	prik_bak='".$_POST['prik_b']."',
 	priority=".$_POST['prior']." 
	WHERE ID_zh=".$_GET['idzh'];
		//echo $obr;
	$res_obr = mysql_query($obr);
	mysql_close($dbcnx);
	header('Location: ../../index.php?pages=3&cl=4&id='.$_GET['id']);
?>