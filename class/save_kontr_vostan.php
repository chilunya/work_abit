<?php
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
for ($i=1; $i<=$_POST['num'];$i++){
	
//echo $_GET['check'.$i]. " ";
//echo $_GET['id_zch'.$i]. "<br>";
if (!isset($_POST['check'.$i])){$zach=0;}
elseif(isset($_POST['check'.$i])){$zach=1;}

	$obr = "UPDATE ZHURNAL_VOSTANOVLENIE SET 
	zachislen=".$zach.", 
	kontrakt='".$_POST['kontr'.$i]."', 
	nom_dogov='".$_POST['nom_dog'.$i]."', 
	data_dogov='".$_POST['dat_dog'.$i]."', 
	data_oplat='".$_POST['dat_opl'.$i]."', 
	zakazchik='".$_POST['zakaz'.$i]."' 
	WHERE ID_vos='".$_POST['id_zch'.$i]."'";	


	
	echo $obr;
		$res_obr = mysql_query($obr);
}
		mysql_close($dbcnx);
		header('Location: ../index.php?pages=13&cl=14&sp='.$_POST['sp'].'');



		?>