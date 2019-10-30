<?php session_start();
if ($_POST['check_agry_zhurn']== true) {	
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
		
	//SELECT ZHURNAL.Otdelenie, MAX(ZHURNAL.Nomer_po_zhurn) AS num_zhur, ZHURNAL.Special FROM ZHURNAL WHERE ZHURNAL.Otdelenie = 1 AND ZHURNAL.Special = 1
		$zhur = "SELECT ZHURNAL.Otdelenie, MAX(ZHURNAL.Nomer_po_zhurn) AS num_zhur, ZHURNAL.Special FROM ZHURNAL WHERE ZHURNAL.Otdelenie = ".$_POST['otdelenie']." AND ZHURNAL.Special = ".$_POST['spec']." ORDER BY ZHURNAL.Special";
		$res_obr = mysql_query($zhur);
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC);
		$num_zhurn = $row['num_zhur']+1;


		if ($_POST['priznak_doc'] == 1) {$data_original = date("Y.m.d G:i:s");} else {$data_original = "";}

		if ($_POST['spec'] == 11) {$akad_bak = 1; $prik_bak = 1;}
		elseif ($_POST['spec'] == 4) {$akad_bak = 1; $prik_bak = 1;}
		elseif ($_POST['spec'] == 5) {$akad_bak = 1; $prik_bak = 1;}
		elseif ($_POST['spec'] == 6) {$akad_bak = 0; $prik_bak = 1;}



		//$obr="INSERT INTO ZHURNAL (IDstud, Otdelenie, Protokol, Date_podachi, Nomer_po_zhurn, Special, Priznak_doc, Kontrakt, Nom_dogovor, Date_dogovora, Date_oplaty, lgot_vne, lgot_konk, ekzam, fio_emploeyee, data_podachi_originala, dat_sob, akad_bak, prik_bak) VALUES ('".$_GET['id']."', '".$_POST['otdelenie']."', '".$_POST['protokol']."', '".$_POST['date_podachi']."', '".$num_zhurn."', '".$_POST['spec']."', '".$_POST['priznak_doc']."', '".$_POST['kontrakt']."', '".$_POST['nom_dogovor']."', '".$_POST['date_dogovora']."', '".$_POST['date_oplaty']."', '".$_POST['lgot_vne']."', '".$_POST['lgot_konk']."', '".$_POST['ekzam']."', '".$_SESSION['nnname']."', '".$data_original."', '".$_POST['dat_sob']."', '".$_POST['akad_bak']."', '".$_POST['prik_bak']."')";
		$obr="INSERT INTO ZHURNAL (IDstud, Otdelenie, Protokol, Date_podachi, Nomer_po_zhurn, Special, Priznak_doc, Kontrakt, Nom_dogovor, Date_dogovora, Date_oplaty, lgot_vne, lgot_konk, ekzam, fio_emploeyee, data_podachi_originala, dat_sob, akad_bak, prik_bak, priority) VALUES ('".$_GET['id']."', '".$_POST['otdelenie']."', '".$_POST['protokol']."', '".$_POST['date_podachi']."', '".$num_zhurn."', '".$_POST['spec']."', '".$_POST['priznak_doc']."', '".$_POST['kontrakt']."', '".$_POST['nom_dogovor']."', '".$_POST['date_dogovora']."', '".$_POST['date_oplaty']."', '".$_POST['lgot_vne']."', '".$_POST['lgot_konk']."', '".$_POST['ekzam']."', '".$_SESSION['nnname']."', '".$data_original."', '".$_POST['dat_sob']."', '".$akad_bak."', '".$prik_bak."', '".$_POST['priority']."')";


		echo $obr;
		
		$res_obr = mysql_query($obr);// or die(header('Location: ../index.php?pages=2&cl=3'));

		//mysql_close($dbcnx);
		header('Location: ../index.php?pages=2&cl=3&id='.$_GET['id'].'&open=open');

		}
else {
		header('Location: ../index.php?pages=2&cl=3');
		}

		?>