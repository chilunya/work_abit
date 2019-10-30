<?php session_start();
include_once("../get_function.php");
$obj = new get_function();
		$obj->config();
if ($_POST['check_agry_zhurn']== true) {	
		/*
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");

		*/
		
		$zhur = "SELECT max(ZHURNAL_VOSTANOVLENIE.num_po_zhurn) AS num_zhur, ZHURNAL_VOSTANOVLENIE.spec, ZHURNAL_VOSTANOVLENIE.otdelenie FROM ZHURNAL_VOSTANOVLENIE ORDER BY ZHURNAL_VOSTANOVLENIE.spec";
		$res_obr = mysql_query($zhur);
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC);
		$num_zhurn = $row['num_zhur']+1;
		
		$kurs = "SELECT SPEC_VOSTAN.ID, SPEC_VOSTAN.kurs FROM SPEC_VOSTAN WHERE SPEC_VOSTAN.ID = ".$_POST['spec']."";
		$res_kurs = mysql_query($kurs);
		$row_kurs = mysql_fetch_array($res_kurs, MYSQL_ASSOC);
		
		if ($row_kurs['kurs'] == 3){
			if ($_POST['kurs'] <=3){
		
		
		
		$obr="INSERT INTO ZHURNAL_VOSTANOVLENIE (abit, otdelenie, data_podachi, num_po_zhurn, spec, kontrakt, kurs, pred1, pred2, protokol, employeer, obraz_poln, obraz_nepoln) VALUES ('".$_POST['fio_abit']."', '".$_POST['otdelenie']."', '".$_POST['date_podachi']."', '".$num_zhurn."', '".$_POST['spec']."', '".$_POST['kontrakt']."', '".$_POST['kurs']."', '".$_POST['pred1']."', '".$_POST['pred2']."', '".$_POST['protokol']."', '".$_SESSION['nnname']."', '".$_POST['obrazov']."', '".$_POST['obraz_nepoln']."')";


		//echo $obr;
		$res_obr = mysql_query($obr);
		
		mysql_close($dbcnx);
		header('Location: ../../index.php?pages=11&cl=12&id='.$_GET['id'].'&open=open');
		}
		
		else {
			
		header('Location: ../../index.php?pages=11&cl=12&id='.$_GET['id'].'&error=error');	
			}
		
		}
		if ($row_kurs['kurs'] == 9){
			if ($_POST['kurs'] >3 and  $_POST['kurs'] <7){
		
		
		
		$obr="INSERT INTO ZHURNAL_VOSTANOVLENIE (abit, otdelenie, data_podachi, num_po_zhurn, spec, kontrakt, kurs, pred1, pred2, protokol, employeer, obraz_poln, obraz_nepoln) VALUES ('".$_POST['fio_abit']."', '".$_POST['otdelenie']."', '".$_POST['date_podachi']."', '".$num_zhurn."', '".$_POST['spec']."', '".$_POST['kontrakt']."', '".$_POST['kurs']."', '".$_POST['pred1']."', '".$_POST['pred2']."', '".$_POST['protokol']."', '".$_SESSION['nnname']."', '".$_POST['obrazov']."', '".$_POST['obraz_nepoln']."')";


		//echo $obr;
		$res_obr = mysql_query($obr);
		
		mysql_close($dbcnx);
		header('Location: ../../index.php?pages=11&cl=12&open=open');
		}
		
		else {
			
		header('Location: ../../index.php?pages=11&cl=12&error=error');	
			}
		
		}
		}


		?>