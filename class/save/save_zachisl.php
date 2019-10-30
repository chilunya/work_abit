<?php
include_once("../get_function.php");
	$obj = new get_function();
	$obj->config();
for ($i=1; $i<=$_POST['num'];$i++){

if (!isset($_POST['check'.$i])){
	$zach=0;
	$n_prikaz = '';
	$dat_prikaz = '';
	}
elseif(isset($_POST['check'.$i])){
	$zach=1;
	$n_prikaz = $_POST['n_prikaz'];
	$dat_prikaz = $_POST['dat_prikaz'];
	if (isset($_POST['akad_b'.$i])){$akad_b=1;} else {$akad_b=0;}
	if (isset($_POST['prik_b'.$i])){$prik_b=1;} else {$prik_b=0;}
	
	}

	$obr = "UPDATE ZHURNAL SET 
	Zachislen=".$zach.", 
	n_prikaza='".$n_prikaz."', 
	data_prikaza='".$dat_prikaz."',
	akad_bak=".$akad_b.", 
	prik_bak=".$prik_b." 
	WHERE ID_zh='".$_POST['id_zch'.$i]."'";	
	//echo $obr;
	$res_obr = mysql_query($obr);
}
	mysql_close($dbcnx);
	header('Location: ../../index.php?pages=5&cl=6&open=open');
?>