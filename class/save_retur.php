<?php
include_once("get_function.php");
		$obj = new get_function();
		$obj->config();
		
		$obr = "UPDATE ZHURNAL SET 
		 priznak_vozvrata = NULL,  
		 employee_vozvrata = NULL,  
		 date_vozvrata = NULL 
		 WHERE ID_zh='".$_GET['id_zh']."'";	
	echo $obr;
		$res_obr = mysql_query($obr);
//
		mysql_close($dbcnx);
		header('Location: ../index.php?pages=21&cl=22');
		

		?>