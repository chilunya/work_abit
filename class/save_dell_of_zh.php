<?php session_start();
	$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
	
	if (isset($_POST['why_dell'])) {
		
	$vozvrat = "UPDATE ZHURNAL SET
	priznak_vozvrata=".$_POST['why_dell'].", 
	employee_vozvrata='".$_SESSION['nnname']."', 
	date_vozvrata='".date("Y.m.d G:i:s")."'  
	WHERE ID_zh='".$_GET['idzh']."'";	
	$voz_doc = mysql_query($vozvrat);	
		
		
/*	
	$copy = "SELECT ZHURNAL.ID_zh, ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Protokol, ZHURNAL.Date_podachi, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Special, ZHURNAL.Priznak_doc, ZHURNAL.Zachislen, ZHURNAL.Kontrakt, ZHURNAL.Nom_dogovor, ZHURNAL.Date_dogovora, ZHURNAL.Date_oplaty, ZHURNAL.lgot_vne, ZHURNAL.lgot_konk, ZHURNAL.ekzam, ZHURNAL.fio_emploeyee, ZHURNAL.data_podachi_originala, ZHURNAL.zakazchik, ZHURNAL.cp_organization FROM ZHURNAL WHERE ZHURNAL.ID_zh = ".$_GET['idzh'];
	$res_copy = mysql_query($copy);
	$row_copy = mysql_fetch_array($res_copy, MYSQL_ASSOC);
		
	$todell = "INSERT INTO ZHURNAL_dell (IDstud, Otdelenie, Protokol, Date_podachi, Nomer_po_zhurn, Special, Priznak_doc, Zachislen, Kontrakt, Nom_dogovor, Date_dogovora, Date_oplaty, lgot_vne, lgot_konk, ekzam, fio_emploeyee, data_podachi_originala, zakazchik, cp_organization, fio_sess, data_dell, why_dell) VALUES (
		'".$row_copy['IDstud']."', 
		'".$row_copy['Otdelenie']."', 
		'".$row_copy['Protokol']."', 
		'".$row_copy['Date_podachi']."', 
		'".$row_copy['Nomer_po_zhurn']."', 
		'".$row_copy['Special']."', 
		'".$row_copy['Priznak_doc']."', 
		'".$row_copy['Zachislen']."', 
		'".$row_copy['Kontrakt']."', 
		'".$row_copy['Nom_dogovor']."', 
		'".$row_copy['Date_dogovora']."', 
		'".$row_copy['Date_oplaty']."', 
		'".$row_copy['lgot_vne']."', 
		'".$row_copy['lgot_konk']."', 
		'".$row_copy['ekzam']."', 
		'".$row_copy['fio_emploeyee']."', 
		'".$row_copy['data_podachi_originala']."', 
		'".$row_copy['zakazchik']."', 
		'".$row_copy['cp_organization']."', 
		'".$_SESSION['nnname']."', 
		'".date("Y.m.d G:i:s")."', 
		'".$_POST['why_dell']."')"; 
	//'".$_SESSION['nnname']."'
	$tozhdel = mysql_query($todell);
	//echo $todell;		
	$zhurn = "DELETE FROM ZHURNAL WHERE ID_zh = ".$_GET['idzh'];
	$res_zhurn = mysql_query($zhurn);  
	 */
	
	mysql_free_result($voz_doc);	
	mysql_close($dbcnx);
	header('Location: ../index.php?pages=3&cl=4&id='.$_GET['id']);
	}
?>