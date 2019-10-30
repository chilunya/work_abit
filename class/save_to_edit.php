<?php
include_once("get_function.php");
if (isset($_GET['id_inf'])) {	
		$obj = new get_function();
		$obj->config();

		$obr = "UPDATE INFO SET to_edit='1' WHERE ID='".$_GET['id_inf']."'";
		
		echo $obr;	
		$res_obr = mysql_query($obr);
		header('Location: ../index.php?pages=23&cl=24&fio='.$_GET['abit']);
		$res_obr = mysql_query($obr);

		}
else {
		header('Location: ../index.php?pages=23&cl=24&fio='.$_GET['abit']);
		}

		?>