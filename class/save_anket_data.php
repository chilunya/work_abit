<?php
include_once("get_function.php");
		$obj = new get_function();
		$obj->config();
		if ($_GET['fl'] == 1) {
			if ($_GET['priz_d_1'] == 2){
				$dat_orig1 = "";}
			elseif ($_GET['priz_d_1'] == 1){
				$dat_orig1 = date("Y.m.d G:i:s");}
		$obr = "UPDATE ZHURNAL SET IDstud='".$_GET['id_st_1']."', ZHURNAL.ekzam='".$_GET['exzam_1']."', Priznak_doc='".$_GET['priz_d_1']."', dat_sob='".$_GET['dat_sob_1']."', data_podachi_originala='".$dat_orig1."' WHERE ID_zh='".$_GET['id_zh_1']."'";	
			}
		elseif($_GET['fl'] == 2) {
			if ($_GET['priz_d_2'] == 2){
				$dat_orig2 = "";}
			elseif ($_GET['priz_d_2'] == 1){
				$dat_orig2 = date("Y.m.d G:i:s");}
		$obr = "UPDATE ZHURNAL SET IDstud='".$_GET['id_st_2']."', ZHURNAL.ekzam='".$_GET['exzam_2']."', Priznak_doc='".$_GET['priz_d_2']."', dat_sob='".$_GET['dat_sob_2']."', data_podachi_originala='".$dat_orig2."' WHERE ID_zh='".$_GET['id_zh_2']."'";	
			}
		elseif($_GET['fl'] == 3) {
			if ($_GET['priz_d_3'] == 2){
				$dat_orig3 = "";}
			elseif ($_GET['priz_d_3'] == 1){
				$dat_orig3 = date("Y.m.d G:i:s");}
		$obr = "UPDATE ZHURNAL SET IDstud='".$_GET['id_st_3']."', ZHURNAL.ekzam='".$_GET['exzam_3']."', Priznak_doc='".$_GET['priz_d_3']."', dat_sob='".$_GET['dat_sob_3']."', data_podachi_originala='".$dat_orig3."' WHERE ID_zh='".$_GET['id_zh_3']."'";	
			}
		echo $_GET['fl'];
		echo '<br>';
		echo $obr;
		$res_obr = mysql_query($obr);
		header('Location: ../index.php?pages=23&cl=24&fio='.$_GET['fio']);
		//$res_obr = mysql_query($obr);


		?>