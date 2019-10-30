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

if(isset($_POST['nom_dog'.$i]) and $_POST['nom_dog'.$i] <> "") {$pasp = $_POST['pasp_zakaz'];}
else {$pasp = "";}



	$obr = "UPDATE ZHURNAL SET 
	Zachislen=".$zach.", 
	Kontrakt='".$_POST['kontr'.$i]."', 
	Nom_dogovor='".$_POST['nom_dog'.$i]."', 
	Date_dogovora='".$_POST['dat_dog'.$i]."', 
	Date_oplaty='".$_POST['dat_opl'.$i]."', 
	zakazchik='".$_POST['zakaz'.$i]."', 
	pasp_zakazchik='".$pasp."'  
	WHERE ID_zh='".$_POST['id_zch'.$i]."'";	


	
	//echo $obr;
		$res_obr = mysql_query($obr);
}
		mysql_close($dbcnx);
		header("Location: ../index.php?pages=17&cl=18&id=".$_POST['id_st']."");



		?>