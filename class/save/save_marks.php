<?php
include_once("../get_function.php");
echo '1<br>'.$_GET['id'];
echo '2<br>';
if ($_POST['check_agry_change']== true) {	
	$obj = new get_function();
	$obj->config();

echo '3<br>';

	$obr = "UPDATE INFO SET 
	bal1='".$_POST['mark1']."', 
	bal2='".$_POST['mark2']."', 
	bal3='".$_POST['mark3']."', 
	bal4='".$_POST['mark4']."', 
	bal5='".$_POST['mark5']."', 
	pred_mesto1='".$_POST['mesto1']."', 
	pred_mesto2='".$_POST['mesto2']."', 
	pred_mesto3='".$_POST['mesto3']."', 
	pred_mesto4='".$_POST['mesto4']."', 
	pred_mesto5='".$_POST['mesto5']."', 
	kompdiz='".$_POST['kompdiz']."', 
	komparh='".$_POST['komparh']."', 
	grafdiz='".$_POST['grafdiz']."', 
	grafarh='".$_POST['grafarh']."', 
	risunok='".$_POST['risunok']."', 
	sochin='".$_POST['sochin']."', 
	individ='".$_POST['individ']."', 
	date_risunok='".$_POST['dat_ekz10']."', 
	date_grafdiz='".$_POST['dat_ekz8']."', 
	date_grafarh='".$_POST['dat_ekz9']."', 
	date_kompdiz='".$_POST['dat_ekz6']."', 
	date_komparh='".$_POST['dat_ekz7']."', 
	date_bal5='".$_POST['dat_ekz5']."', 
	date_bal4='".$_POST['dat_ekz4']."', 
	date_bal3='".$_POST['dat_ekz3']."', 
 	date_bal2='".$_POST['dat_ekz2']."', 
 	date_bal1='".$_POST['dat_ekz1']."' WHERE ID='".$_GET['id']."';";
echo $obr;
/*

	$obr1 = "UPDATE INFO SET 
	bal1='".$_POST['mark1']."', 
	bal2='".$_POST['mark2']."', 
	bal3='".$_POST['mark3']."', 
	bal4='".$_POST['mark4']."', 
	bal5='".$_POST['mark5']."', 
	pred_mesto1='".$_POST['mesto1']."', 
	pred_mesto2='".$_POST['mesto2']."', 
	pred_mesto3='".$_POST['mesto3']."', 
	pred_mesto4='".$_POST['mesto4']."', 
	pred_mesto5='".$_POST['mesto5']."', 
	kompdiz='".$_POST['kompdiz']."', 
	komparh='".$_POST['komparh']."', 
	grafdiz='".$_POST['grafdiz']."', 
	grafarh='".$_POST['grafarh']."', 
	risunok='".$_POST['risunok']."', 
	sochin='".$_POST['sochin']."', 
	individ='".$_POST['individ']."', 
	date_risunok='".$_POST['dat_ekz10']."', 
	date_grafdiz='".$_POST['dat_ekz8']."', 
	date_grafarh='".$_POST['dat_ekz9']."', 
	date_kompdiz='".$_POST['dat_ekz6']."', 
	date_komparh='".$_POST['dat_ekz7']."', 
	date_bal5='".$_POST['dat_ekz5']."', 
	date_bal4='".$_POST['dat_ekz4']."', 
	date_bal3='".$_POST['dat_ekz3']."', 
 	date_bal2='".$_POST['dat_ekz2']."', 
 	date_bal1='".$_POST['dat_ekz1']."' WHERE ID='".$_GET['id']."'";
	
*/	

	$res_obr = mysql_query($obr);
	mysql_close($dbcnx);
	
	header('Location: ../../index.php?pages=4&cl=5&id='.$_GET['id'].'&open=open');

}
else {
	header('Location: ../../index.php??pages=4&cl=5&id='.$_GET['id']);
}

?>