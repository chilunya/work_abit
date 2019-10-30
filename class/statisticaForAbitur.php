<?php
include_once("get_string.php");
include_once("get_function.php");
class statisticaForAbitur{
	
	function statForAbit(){
		$title = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3221225472)){
			//3232235520
	
	//echo "<br>";
	
		//$ip1="192.168.4.0";
		//echo $ip1;
		//echo "<br>";
		//$a1=explode(".",$ip1);
		//$intip1 = $a1[0]*256*256*256+$a1[1]*256*256+$a1[2]*256+$a1[3];
		//echo $intip1;
	//echo "<br>";
		
		//$ip2="192.168.4.255";
		//echo $ip2;
		//echo "<br>";
		//$a2=explode(".",$ip2);
		//$intip2 = $a2[0]*256*256*256+$a2[1]*256*256+$a2[2]*256+$a2[3];
		//echo $intip2;	
		
		echo '<table class="table table-striped">';
		echo '<thead><tr><th colspan="3"><p>'; echo $title->getStringForm('svod'); echo '</p></th><th><p></p></th></tr><tbody>';
		echo '<tr><td width="30%">';
		echo '<p>'; echo $title->getStringForm('count_abit'); echo '</p></td>';
		echo '<td align="left" colspan="2"><strong>'; $this->abit_count(); echo '</strong></td></tr>';
		echo '<tr><td><p>'; echo $title->getStringForm('count_zayav'); echo '</p></td>';
		echo '<td align="left" colspan="2"><strong>'; $this->zayavl_count(); echo '</strong></td></tr>';
		echo '<tr><td><p>'; echo $title->getStringForm('count_podl'); echo '</p></td>';
		echo '<td align="left">
		<p>Федеральный бюджет:</p>
		<p>Дневное: <strong>'; $this->fb_d_count(); echo '</strong></p>
		<p>Заочное: <strong>'; $this->fb_z_count(); echo '</strong></p>
		<p>Магистратура: <strong>'; $this->fb_m_count(); echo '</strong></p></td>';
		echo '<td align="left">
		<p>Договорная форма:</p>
		<p>Дневное: <strong>'; $this->d_d_count(); echo '</strong></p>
		<p>Заочное: <strong>'; $this->d_z_count(); echo '</strong></p>
		<p>Магистратура: <strong>'; $this->d_m_count(); echo '</strong></p>';
		echo '</td></tr>';
		
		echo '<tr><td><p>'; echo $title->getStringForm('count_copy'); echo '</p></td>';
		echo '<td align="left">
		<p>Федеральный бюджет:</p>
		<p>Дневное: <strong>'; $this->fb_d_count_copy(); echo '</strong></p>
		<p>Заочное: <strong>'; $this->fb_z_count_copy(); echo '</strong></p>
		<p>Магистратура: <strong>'; $this->fb_m_count_copy(); echo '</strong></p></td>';
		echo '<td align="left">
		<p>Договорная форма:</p>
		<p>Дневное: <strong>'; $this->d_d_count_copy(); echo '</strong></p>
		<p>Заочное: <strong>'; $this->d_z_count_copy(); echo '</strong></p>
		<p>Магистратура: <strong>'; $this->d_m_count_copy(); echo '</strong></p>';
		echo '</td></tr>';
		echo '</tbody>';
		echo '</table>';
		
		echo '<p align="center"><strong>'; echo $title->getStringForm('podl_po_napr'); echo '</strong></p>';
		echo '<table class="table table-striped">';
		echo '<thead><tr><th>'; echo $title->getStringForm('kod_sp'); echo '</th><th>'; echo $title->getStringForm('kr_spec'); echo '</th><th>'; echo $title->getStringForm('pod_coun'); echo '</th></tr></thead>';
		echo '<tbody>';
		echo $this->podlinn_napravl();
		echo '</tbody></table>';
		
		
		echo '<p align="center"><strong>'; echo $title->getStringForm('podl_po_napr_k'); echo '</strong></p>';
		echo '<table class="table table-striped">';
		echo '<thead><tr><th>'; echo $title->getStringForm('kod_sp'); echo '</th><th>'; echo $title->getStringForm('kr_spec'); echo '</th><th>'; echo $title->getStringForm('pod_coun'); echo '</th></tr></thead>';
		echo '<tbody>';
		echo $this->podlinn_napravl_k();
		echo '</tbody></table>';
}
	else {
				echo $title->getStringForm('close');}
		//echo '<a href="index.php?pages=7&cl=8&nap=1">'; echo $title->getStringForm('spis'); echo '</a>';


}
function podlinn_napravl(){
	$spec="SELECT SPEC.ID, SPEC.KodSpec, SPEC.NameSpec FROM SPEC WHERE SPEC.ID <> 15 and SPEC.ID < 17";
	$res_spec = mysql_query($spec);
    /* show result */
	  	while ($row = mysql_fetch_array($res_spec, MYSQL_ASSOC)) 
		{
			$sql="SELECT SPEC.NameSpec, count(ZHURNAL.Priznak_doc) AS expr1, ZHURNAL.Priznak_doc, SPEC.ID, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt FROM SPEC INNER JOIN ZHURNAL ON SPEC.ID = ZHURNAL.Special WHERE ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 1 AND ZHURNAL.Kontrakt = 1 AND SPEC.ID = ".$row["ID"]." AND ZHURNAL.priznak_vozvrata IS NULL GROUP BY ZHURNAL.Special";
			
			$sql_spec = mysql_query($sql);
			$row_sp = mysql_fetch_array($sql_spec, MYSQL_ASSOC);
			
			
			echo '<tr><td>'.$row["KodSpec"].'</td><td>'.$row["NameSpec"].'</td><td><strong>'.$row_sp["expr1"].'</strong></td></tr>';
		}
	

}
function podlinn_napravl_k(){
	$spec="SELECT SPEC.ID, SPEC.KodSpec, SPEC.NameSpec FROM SPEC WHERE SPEC.ID <> 15 and SPEC.ID < 17";
	$res_spec = mysql_query($spec);
    /* show result */
	  	while ($row = mysql_fetch_array($res_spec, MYSQL_ASSOC)) 
		{
			$sql="SELECT SPEC.NameSpec, count(ZHURNAL.Priznak_doc) AS expr1, ZHURNAL.Priznak_doc, SPEC.ID, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt FROM SPEC INNER JOIN ZHURNAL ON SPEC.ID = ZHURNAL.Special WHERE ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 1 AND ZHURNAL.Kontrakt = 2 AND SPEC.ID = ".$row["ID"]." AND ZHURNAL.priznak_vozvrata IS NULL GROUP BY ZHURNAL.Special";
			
			$sql_spec = mysql_query($sql);
			$row_sp = mysql_fetch_array($sql_spec, MYSQL_ASSOC);
			
			
			echo '<tr><td>'.$row["KodSpec"].'</td><td>'.$row["NameSpec"].'</td><td><strong>'.$row_sp["expr1"].'</strong></td></tr>';
		}
	

}
	function spisForAbit(){
		$title = new get_String_Form();
		$obj = new get_function();
		//********************************************************************** ПРОВЕРКА НА IP АДРЕС (начало)
		
		//$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//$a=explode(".",$ip);
		//$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		//if (($intip < 3232301055 and $intip > 3221225472)){

		//********************************************************************** ПРОВЕРКА НА IP АДРЕС (конец)
		
		$obj->config();
		$obr = "SELECT SPEC.NameSpec, SPEC.KodSpec, SPEC.ID FROM SPEC ORDER BY SPEC.ID ";	
		$res_obr = mysql_query($obr);
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($row["ID"] < 17){
			printf ("<a href='index.php?pages=8&cl=9&nap=1&spec=".$row["ID"]."'>");
			printf ($row["ID"].". ".$row["NameSpec"]);
			printf ("</a><br>");
			}
		}

		mysql_free_result($res_obr);	
		
		//********************************************************************** ПРОВЕРКА НА IP АДРЕС
		//}
		//else {
		//	echo $title->getStringForm('close');
		//	}
		//********************************************************************** ПРОВЕРКА НА IP АДРЕС (конец)
			
	}
	function specForAbit($id){
		
		$title = new get_String_Form();
		$obj = new get_function();
		$obj->config();;
		/*
		$obr = "SELECT spec_otd.id_spec, spec_otd.otd1, spec_otd.otd2, spec_otd.otd3, spec_otd.otd4, SPEC.NameSpec FROM SPEC INNER JOIN spec_otd ON SPEC.ID = spec_otd.id_spec WHERE spec_otd.id_spec = ".$id;	
		$res_obr = mysql_query($obr);
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			echo '<p><a href="index.php?pages=8&cl=9&nap=1">'; echo $title->getStringForm('back'); echo '</a></p>';
			echo '<p><strong>'.$row["NameSpec"].'</strong></p>';
			echo '<a href="index.php?pages=8&cl=9&nap=1&spec='.$id.'&otd=1">'.$row["otd1"].'</a><br>';
			echo '<a href="index.php?pages=8&cl=9&nap=1&spec='.$id.'&otd=2">'.$row["otd2"].'</a><br>';
			//echo '<a href="index.php?pages=8&cl=9&nap=1&spec='.$id.'&otd=3">'.$row["otd3"].'</a><br>';
			echo '<a href="index.php?pages=8&cl=9&nap=1&spec='.$id.'&otd=4">'.$row["otd4"].'</a><br>';
		
			//echo $row["otd1"]." ".$row["otd2"]." ".$row["otd3"];
		}
		echo "</table>";
		mysql_free_result($res_obr);
		*/
		$obr = "SELECT plan_budg.IDspec, SPEC.NameSpec, FORMAOBUCH.FORMAOBUCH, plan_budg.IDformaobuch_budg FROM SPEC INNER JOIN plan_budg ON SPEC.ID = plan_budg.IDspec INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = plan_budg.IDformaobuch_budg WHERE plan_budg.IDspec = ".$id;
		$res_obr = mysql_query($obr);
		echo '<p><a href="index.php?pages=8&cl=9&nap=1">'; echo $title->getStringForm('back'); echo '</a></p>';
		$i=0;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($i != 1){
			echo '<p><strong>'.$row["NameSpec"].'</strong></p>';
			$i=1;
			}
			echo '<a href="index.php?pages=8&cl=9&nap=1&spec='.$id.'&otd='.$row["IDformaobuch_budg"].'">'.$row["FORMAOBUCH"].'</a><br>';
			
		}
		mysql_free_result($res_obr);
	}
	function otdForAbit($id, $otd){
		$title = new get_String_Form();
		//********************************************************************** ПРОВЕРКА НА IP АДРЕС


		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3221225472)){
		//********************************************************************** ПРОВЕРКА НА IP АДРЕС
			
		$title = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		echo '<p><a href="index.php?pages=8&cl=9&nap=1">'; echo $title->getStringForm('back'); echo '</a></p>';
		
		// название специальности
	
	
		$sql = "SELECT SPEC.NameSpec, SPEC.ID, SPEC.predmets, plan_budg.plan_budg, plan_budg.IDformaobuch_budg, plan_kont.IDformaobuch_kont, plan_kont.plan_kont FROM SPEC INNER JOIN plan_budg ON SPEC.ID = plan_budg.IDspec INNER JOIN plan_kont ON plan_kont.IDspec = SPEC.ID WHERE plan_budg.IDformaobuch_budg = ".$otd." AND plan_kont.IDformaobuch_kont = ".$otd." AND SPEC.ID = ".$id."";
		

		$res_sp = mysql_query($sql);
		$nam_sp = mysql_fetch_array($res_sp, MYSQL_ASSOC);
		// название формы обучения
		
		$sql_n = "SELECT FORMAOBUCH.FORMAOBUCH, FORMAOBUCH.ID FROM FORMAOBUCH WHERE FORMAOBUCH.ID = ".$otd;
		$res_n = mysql_query($sql_n);
		$nam_n = mysql_fetch_array($res_n, MYSQL_ASSOC);
		
		$name_sp = $nam_sp["NameSpec"];
		echo '<table width="100%"><tr><td width="50%" align="left"><h5>'.$name_sp.' - '. $nam_n["FORMAOBUCH"].'</h5></td><td align="right">';
		
		$prik = $obj->spec_bak($id);	
		
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3221225472)){
		
		echo '<a href="excel_spisok_all.php?id='.$id.'&otd='.$otd.'&prik='.$prik.'">'; echo $title->getStringForm('print_spis_all'); echo '</a><br>';	
		echo '<a href="excel_spisok.php?id='.$id.'&otd='.$otd.'&prik='.$prik.'">'; echo $title->getStringForm('print_spis'); echo '</a><br>';
		echo '<a href="excel_spisok_pdl.php?id='.$id.'&otd='.$otd.'&prik='.$prik.'">'; echo $title->getStringForm('print_spis_pdl'); echo '</a><br>';
		echo '<a href="excel_spisok_pdl_pred.php?id='.$id.'&otd='.$otd.'&prik='.$prik.'">Список оригиналов с предметами</a>';
		}	
		echo '<tr><td colspan="2" align="center"><h6>План приёма на места</h6></td></tr>';
		$pl=0;
		$pl_k = $nam_sp["plan_kont"];
		if($otd == 1){
		switch($id){
		case 1:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 1 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 2:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 2 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 3:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 3 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 4:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 4 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 5:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 5 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 6:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 6 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 7:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 7 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 8:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 8 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 9:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 9 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 10:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 10 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 11:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 11 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 12:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 12 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 13:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 13 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 14:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 14 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 15:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 15 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		case 16:
		$za_sql = "SELECT ZHURNAL.Special, ZHURNAL.Zachislen, COUNT(ZHURNAL.IDstud) AS zach FROM ZHURNAL WHERE ZHURNAL.Special = 16 AND ZHURNAL.Zachislen = 1";
		$res_za = mysql_query($za_sql);
		$za = mysql_fetch_array($res_za, MYSQL_ASSOC);
		
		$pl=$nam_sp["plan_budg"]-$za["zach"];
		break;
		
		
		}
		}
		else {
		$pl	=$nam_sp["plan_budg"];
			}

		echo '<tr><td colspan="2" align="center">Финансируемые за счет средств федерального бюджета - '.$pl.'</td></tr>';
		echo '<tr><td colspan="2" align="center">C оплатой стоимости обучения - '.$pl_k.'<br></td></tr>';
		echo '</td></tr><tr><td colspan="2" align="center"><h5>'.$nam_sp["predmets"].'</h5></td></tr>';  
		echo '</table>';  
		$sort = $obj->abit_sort();
		
	$obr_lgt = "SELECT ZHURNAL.ID_zh, ZHURNAL.Kontrakt, ZHURNAL.akad_bak, ZHURNAL.prik_bak, ZHURNAL.IDstud, ZHURNAL.priznak_vozvrata, ZHURNAL.Zachislen, ZHURNAL.Priznak_doc, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Otdelenie, INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, ZHURNAL.Special, FORMAOBUCH.leter, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafdiz, INFO.grafarh, INFO.risunok, INFO.sochin, INFO.individ, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok + INFO.sochin + INFO.individ AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 + INFO.sochin + INFO.individ AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok + INFO.sochin + INFO.individ AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 + INFO.sochin + INFO.individ AS obw, ZHURNAL.lgot_vne, LGOTAVNEKONK.LGOTAVNEKONK, PRIZNAKDOC.PRIZNAKDOC, KONTRAKT.KONTRAKT FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt WHERE ZHURNAL.Special = ".$id." AND ZHURNAL.Zachislen <> 1 AND ZHURNAL.Otdelenie = ".$otd." AND ZHURNAL.priznak_vozvrata is null AND ZHURNAL.lgot_vne > 1 AND ZHURNAL.volna is null";
		if ($sort == "alf"){
		$obr_lgt = $obr_lgt . " ORDER BY INFO.fam";
		}
		if ($sort == "ege"){
	
	switch($id){
		case 1:	
		$obr_lgt = $obr_lgt. " ORDER BY dis DESC, INFO.bal5 DESC, INFO.bal1 DESC";
		break;
		case 2:	
		$obr_lgt = $obr_lgt. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 3:	
		$obr_lgt = $obr_lgt. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 4:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 5:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 6:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 7:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 8:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 9:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 10:	
		$obr_lgt = $obr_lgt. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 11:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 12:	
		$obr_lgt = $obr_lgt. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 13:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 14:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 15:	
		$obr_lgt = $obr_lgt. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 16:	
		$obr_lgt = $obr_lgt. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		}
		}
		
		$obr = "SELECT ZHURNAL.ID_zh, ZHURNAL.Kontrakt, ZHURNAL.akad_bak, ZHURNAL.prik_bak, ZHURNAL.IDstud, ZHURNAL.priznak_vozvrata, ZHURNAL.Zachislen, ZHURNAL.Priznak_doc, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Otdelenie, INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, INFO.sochin, INFO.individ, ZHURNAL.Special, FORMAOBUCH.leter, INFO.bal1, INFO.bal2, INFO.bal3, INFO.bal4, INFO.bal5, INFO.kompdiz, INFO.komparh, INFO.grafdiz, INFO.grafarh, INFO.risunok, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok + INFO.sochin + INFO.individ AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 + INFO.sochin + INFO.individ AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok + INFO.sochin + INFO.individ AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 + INFO.sochin + INFO.individ AS obw, ZHURNAL.lgot_vne, LGOTAVNEKONK.LGOTAVNEKONK, PRIZNAKDOC.PRIZNAKDOC, KONTRAKT.KONTRAKT FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt WHERE ZHURNAL.Special = ".$id." AND ZHURNAL.Zachislen <> 1 AND ZHURNAL.Otdelenie = ".$otd." AND ZHURNAL.priznak_vozvrata is null AND ZHURNAL.lgot_vne = 1 AND ZHURNAL.volna is null";
		
		if ($sort == "alf"){
		$obr = $obr . " ORDER BY INFO.fam";
		}
		if ($sort == "ege"){
		switch($id){
		case 1:	
		$obr = $obr. " ORDER BY dis DESC, INFO.bal5 DESC, INFO.bal1 DESC";
		break;
		case 2:	
		$obr = $obr. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 3:	
		$obr = $obr. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		case 4:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 5:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 6:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 7:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 8:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 9:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 10:	
		$obr = $obr. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 11:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 12:	
		$obr = $obr. " ORDER BY arh DESC, INFO.bal2 DESC, INFO.bal1 DESC";
		break;
		case 13:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 14:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 15:	
		$obr = $obr. " ORDER BY fiz DESC, INFO.bal2 DESC, INFO.bal3 DESC, INFO.bal1 DESC";
		break;
		case 16:	
		$obr = $obr. " ORDER BY obw DESC, INFO.bal2 DESC, INFO.bal4 DESC, INFO.bal1 DESC";
		break;
		}
		}
		
			echo "<table class='table' cellpadding='3'><tbody><tr><th>"; 
			echo $title->getStringForm('nn');
			echo "</th><th>";
			echo $title->getStringForm('fio');
			echo "</th>";
			
// прикладной и академический (начало)
			//if ($prik == 1){
			//echo '<th>'; echo $title->getStringForm('akad_bak'); echo '</th>';
			//echo '<th>'; echo $title->getStringForm('prik_bak'); echo '</th>';
			//}
// прикладной и академический (конец)
			echo "<th>";
			echo $title->getStringForm('pr_doc');
			echo "</th>";
			echo "<th>";
			echo $title->getStringForm('lgt');
			echo "</th><th>";
			echo $title->getStringForm('kont');
			echo "</th><th>";
			echo $title->getStringForm('summ_ege');
			echo "</th>";
			
			if ($id == 1){
			echo "<th width='3%'>Русс.</th>";
			echo "<th width='3%'>Лит.</th>";	
			echo "<th width='3%'>Комп.Д</th>";
			echo "<th width='3%'>Граф.Д</th>";
			echo "<th width='3%'>Рис.</th>";	
				}
			elseif ($id == 10 or $id == 12){
			echo "<th>Русс.</th>";
			echo "<th>Мат.</th>";	
			echo "<th>Комп.А</th>";
			echo "<th>Граф.А</th>";
			echo "<th>Рис.</th>";
				}
			elseif ($id == 2 or $id == 3 or $id == 16){
			echo "<th>Русс.</th>";
			echo "<th>Мат.</th>";	
			echo "<th>Общ.</th>";
				}
			else{
			echo "<th>Русс.</th>";
			echo "<th>Мат.</th>";	
			echo "<th>Физ.</th>";
				}
				
			echo "<th>Сочин.</th>";	
			echo "<th>Индив.</th>";
			
			
			
			echo "</th></tr></tbody>";
$number=1;			
//+++++++++++++++++++++++++++++++++++ ЛЬГОТНИКИ	
			
		$res_obr_lgt = mysql_query($obr_lgt);
		
		while ($row_ball_lgt = mysql_fetch_array($res_obr_lgt, MYSQL_ASSOC)) 
		{
				$sql_lgt="SELECT ZHURNAL.IDstud, ZHURNAL.Priznak_doc, ZHURNAL.Special, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Special <> ".$row_ball_lgt["Special"]." AND ZHURNAL.priznak_vozvrata IS NULL AND ZHURNAL.IDstud = ".$row_ball_lgt["IDstud"]." ";
					
					$res_sql_lgt = mysql_query($sql_lgt);  
					$row_sql_lgt = mysql_fetch_array($res_sql_lgt, MYSQL_ASSOC);
					if ($row_sql_lgt) {
						
					echo "<tr style='color: #999; font-style: oblique;'><td>";
					printf ($number.". ");
					echo "</td>";	
					printf ("<td>".$row_ball_lgt["fam"]." ".$row_ball_lgt["name"]." ".$row_ball_lgt["otch"]."</td>");
					
					echo "<td>";
// прикладной и академический (начало)			
			//	if ($prik == 1){		
			//if ($row_ball_lgt["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			//printf("<td><input type='checkbox' ".$chek_akad." name='akad_b".$num."'></td>");
			//
			//if ($row_ball_lgt["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			//printf("<td><input type='checkbox' ".$chek_prik." name='prik_b".$num."'></td>");
			//}
// прикладной и академический (конец)
					printf ($row_ball_lgt["PRIZNAKDOC"]);
					echo "</td><td>";
					printf ($row_ball_lgt["LGOTAVNEKONK"]);
					echo "</td><td>";
					printf ($row_ball_lgt["KONTRAKT"]);
					echo "</td>";
			
			
					if ($id == 1){
					echo "<td>";
					printf ($row_ball_lgt["dis"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal5"]."</td>";	
					echo "<td>".$row_ball_lgt["kompdiz"]."</td>";
					echo "<td>".$row_ball_lgt["grafdiz"]."</td>";
					echo "<td>".$row_ball_lgt["risunok"]."</td>";	
						}
					elseif ($id == 10 or $id == 12){
					echo "<td>";
					printf ($row_ball_lgt["arh"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["komparh"]."</td>";
					echo "<td>".$row_ball_lgt["grafarh"]."</td>";
					echo "<td>".$row_ball_lgt["risunok"]."</td>";
						}
					elseif ($id == 2 or $id == 3 or $id == 16){
					echo "<td>";
					printf ($row_ball_lgt["obw"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["bal4"]."</td>";
						}
					else{
					echo "<td>";
					printf ($row_ball_lgt["fiz"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["bal3"]."</td>";
					}
			
			echo "<td>".$row_ball_lgt["sochin"]."</td>";	
			echo "<td>".$row_ball_lgt["individ"]."</td>";
			echo "</tr>";
			}
			
			else{
				
			if ($row_ball_lgt["PRIZNAKDOC"] == "Оригинал") {
			echo "<tr style='font-weight:bold;'><td>";
			printf ($number.". ");
			echo "</td>";
			printf ("<td>".$row_ball_lgt["fam"]." ".$row_ball_lgt["name"]." ".$row_ball_lgt["otch"]."</td>");	
			
// прикладной и академический (начало)			
			//	if ($prik == 1){ // только у некоторых направлениях
			//if ($row_ball_lgt["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			//printf("<td><input type='checkbox' ".$chek_akad." name='akad_b".$num."'></td>");
			//
			//if ($row_ball_lgt["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			//printf("<td><input type='checkbox' ".$chek_prik." name='prik_b".$num."'></td>");
			//}
// прикладной и академический (начало)
			echo "<td>";
			printf ($row_ball_lgt["PRIZNAKDOC"]);
			echo "</td><td>";
			printf ($row_ball_lgt["LGOTAVNEKONK"]);
			echo "</td><td>";
			printf ($row_ball_lgt["KONTRAKT"]);
			echo "</td>";
			
					if ($id == 1){
					echo "<td>";
					printf ($row_ball_lgt["dis"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal5"]."</td>";	
					echo "<td>".$row_ball_lgt["kompdiz"]."</td>";
					echo "<td>".$row_ball_lgt["grafdiz"]."</td>";
					echo "<td>".$row_ball_lgt["risunok"]."</td>";	
						}
					elseif ($id == 10 or $id == 12){
					echo "<td>";
					printf ($row_ball_lgt["arh"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["komparh"]."</td>";
					echo "<td>".$row_ball_lgt["grafarh"]."</td>";
					echo "<td>".$row_ball_lgt["risunok"]."</td>";
						}
					elseif ($id == 2 or $id == 3 or $id == 16){
					echo "<td>";
					printf ($row_ball_lgt["obw"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["bal4"]."</td>";
						}
					else{
					echo "<td>";
					printf ($row_ball_lgt["fiz"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["bal3"]."</td>";
					}
			
			echo "<td>".$row_ball_lgt["sochin"]."</td>";	
			echo "<td>".$row_ball_lgt["individ"]."</td>"; 
			echo "</tr>";
			}
			else {
			echo "<tr><td>";
			printf ($number.". ");
			echo "</td>";
			printf ("<td>".$row_ball_lgt["fam"]." ".$row_ball_lgt["name"]." ".$row_ball_lgt["otch"]."</td>");
			
// прикладной и академический (начало)
			//	if ($prik == 1){ // только у некоторых направлениях	
			//if ($row_ball_lgt["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			//printf("<td><input type='checkbox' ".$chek_akad." name='akad_b".$num."'></td>");
			//
			//if ($row_ball_lgt["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			//printf("<td><input type='checkbox' ".$chek_prik." name='prik_b".$num."'></td>");
			//}
// прикладной и академический (конец)
			echo "<td>";
			printf ($row_ball_lgt["PRIZNAKDOC"]);
			echo "</td><td>";
			printf ($row_ball_lgt["LGOTAVNEKONK"]);
			echo "</td><td>";
			printf ($row_ball_lgt["KONTRAKT"]);
			echo "</td>";
						
					if ($id == 1){
					echo "<td>";
					printf ($row_ball_lgt["dis"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal5"]."</td>";	
					echo "<td>".$row_ball_lgt["kompdiz"]."</td>";
					echo "<td>".$row_ball_lgt["grafdiz"]."</td>";
					echo "<td>".$row_ball_lgt["risunok"]."</td>";	
						}
					elseif ($id == 10 or $id == 12){
					echo "<td>";
					printf ($row_ball_lgt["arh"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["komparh"]."</td>";
					echo "<td>".$row_ball_lgt["grafarh"]."</td>";
					echo "<td>".$row_ball_lgt["risunok"]."</td>";
						}
					elseif ($id == 2 or $id == 3 or $id == 16){
					echo "<td>";
					printf ($row_ball_lgt["obw"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["bal4"]."</td>";
						}
					else{
					echo "<td>";
					printf ($row_ball_lgt["fiz"]);
					echo "</td>";	
					echo "<td>".$row_ball_lgt["bal1"]."</td>";
					echo "<td>".$row_ball_lgt["bal2"]."</td>";	
					echo "<td>".$row_ball_lgt["bal3"]."</td>";
					}
			echo "<td>".$row_ball_lgt["sochin"]."</td>";	
			echo "<td>".$row_ball_lgt["individ"]."</td>";
			echo "</tr>";
				
				}
			}
			$number ++;	
		}
		

//+++++++++++++++++++++++++++++++++++ БЕЗ ЛЬГОТ			
		
		$res_obr = mysql_query($obr);
		//$number=1;
		while ($row_ball = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
	//		$zac= "SELECT ZHURNAL.IDstud, ZHURNAL.Zachislen FROM ZHURNAL WHERE ZHURNAL.Zachislen = 1 AND ZHURNAL.IDstud = ".$row_ball['IDstud'];
	//$res_zac = mysql_query($zac);
	//$sql_zac = mysql_fetch_array($res_zac);
	//if (!$sql_zac) {
					$sql="SELECT ZHURNAL.IDstud, ZHURNAL.Priznak_doc, ZHURNAL.Special, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Special <> ".$row_ball["Special"]." AND ZHURNAL.priznak_vozvrata IS NULL AND ZHURNAL.IDstud = ".$row_ball["IDstud"]." ";
					
					$res_sql = mysql_query($sql);  
					$row_sql = mysql_fetch_array($res_sql, MYSQL_ASSOC);
					if ($row_sql) {
						
					echo "<tr style='color: #999; font-style: oblique;'><td>";
					printf ($number.". ");
					echo "</td>";	
					printf ("<td>".$row_ball["fam"]." ".$row_ball["name"]." ".$row_ball["otch"]."</td>");
// прикладной и академический (начало)		
			//	if ($prik == 1){ // только у некоторых направлениях		
			//if ($row_ball["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			//printf("<td><input type='checkbox' ".$chek_akad." name='akad_b".$num."'></td>");
			//
			//if ($row_ball["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			//printf("<td><input type='checkbox' ".$chek_prik." name='prik_b".$num."'></td>");
			//}
// прикладной и академический (начало)
					echo "<td>";
					printf ($row_ball["PRIZNAKDOC"]);
					echo "</td><td>";
					printf ($row_ball["LGOTAVNEKONK"]);
					echo "</td><td>";
					printf ($row_ball["KONTRAKT"]);
					echo "</td>";
			
			
					if ($id == 1){
					echo "<td>";
					printf ($row_ball["dis"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal5"]."</td>";	
					echo "<td>".$row_ball["kompdiz"]."</td>";
					echo "<td>".$row_ball["grafdiz"]."</td>";
					echo "<td>".$row_ball["risunok"]."</td>";	
						}
					elseif ($id == 10 or $id == 12){
					echo "<td>";
					printf ($row_ball["arh"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["komparh"]."</td>";
					echo "<td>".$row_ball["grafarh"]."</td>";
					echo "<td>".$row_ball["risunok"]."</td>";
						}
					elseif ($id == 2 or $id == 3 or $id == 16){
					echo "<td>";
					printf ($row_ball["obw"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["bal4"]."</td>";
						}
					else{
					echo "<td>";
					printf ($row_ball["fiz"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["bal3"]."</td>";
					}
			
			echo "<td>".$row_ball["sochin"]."</td>";	
			echo "<td>".$row_ball["individ"]."</td>";
			echo "</tr>";
			}
			
			else{
				
			if ($row_ball["PRIZNAKDOC"] == "Оригинал") {
			echo "<tr style='font-weight:bold;'><td>";
			printf ($number.". ");
			echo "</td>";
			printf ("<td>".$row_ball["fam"]." ".$row_ball["name"]." ".$row_ball["otch"]."</td>");	
			
// прикладной и академический (начало)
			//	if ($prik == 1){// только у некоторых направлениях
			//if ($row_ball["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			//printf("<td><input type='checkbox' ".$chek_akad." name='akad_b".$num."'></td>");
			//
			//if ($row_ball["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			//printf("<td><input type='checkbox' ".$chek_prik." name='prik_b".$num."'></td>");
			//}
// прикладной и академический (начало)
			echo "<td>";
			printf ($row_ball["PRIZNAKDOC"]);
			echo "</td><td>";
			printf ($row_ball["LGOTAVNEKONK"]);
			echo "</td><td>";
			printf ($row_ball["KONTRAKT"]);
			echo "</td>";
			
					if ($id == 1){
					echo "<td>";
					printf ($row_ball["dis"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal5"]."</td>";	
					echo "<td>".$row_ball["kompdiz"]."</td>";
					echo "<td>".$row_ball["grafdiz"]."</td>";
					echo "<td>".$row_ball["risunok"]."</td>";	
						}
					elseif ($id == 10 or $id == 12){
					echo "<td>";
					printf ($row_ball["arh"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["komparh"]."</td>";
					echo "<td>".$row_ball["grafarh"]."</td>";
					echo "<td>".$row_ball["risunok"]."</td>";
						}
					elseif ($id == 2 or $id == 3 or $id == 16){
					echo "<td>";
					printf ($row_ball["obw"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["bal4"]."</td>";
						}
					else{
					echo "<td>";
					printf ($row_ball["fiz"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["bal3"]."</td>";
					}
			
			echo "<td>".$row_ball["sochin"]."</td>";	
			echo "<td>".$row_ball["individ"]."</td>"; 
			echo "</tr>";
			}
			else {
			echo "<tr><td>";
			printf ($number.". ");
			echo "</td>";
			printf ("<td>".$row_ball["fam"]." ".$row_ball["name"]." ".$row_ball["otch"]."</td>");	
// прикладной и академический (начало)
			//	if ($prik == 1){ // только у некоторых направлениях
			//if ($row_ball["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			//printf("<td><input type='checkbox' ".$chek_akad." name='akad_b".$num."'></td>");
			//
			//if ($row_ball["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			//printf("<td><input type='checkbox' ".$chek_prik." name='prik_b".$num."'></td>");
			//}
// прикладной и академический (начало)
			echo "<td>";
			printf ($row_ball["PRIZNAKDOC"]);
			echo "</td><td>";
			printf ($row_ball["LGOTAVNEKONK"]);
			echo "</td><td>";
			printf ($row_ball["KONTRAKT"]);
			echo "</td>";
						
					if ($id == 1){
					echo "<td>";
					printf ($row_ball["dis"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal5"]."</td>";	
					echo "<td>".$row_ball["kompdiz"]."</td>";
					echo "<td>".$row_ball["grafdiz"]."</td>";
					echo "<td>".$row_ball["risunok"]."</td>";	
						}
					elseif ($id == 10 or $id == 12){
					echo "<td>";
					printf ($row_ball["arh"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["komparh"]."</td>";
					echo "<td>".$row_ball["grafarh"]."</td>";
					echo "<td>".$row_ball["risunok"]."</td>";
						}
					elseif ($id == 2 or $id == 3 or $id == 16){
					echo "<td>";
					printf ($row_ball["obw"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["bal4"]."</td>";
						}
					else{
					echo "<td>";
					printf ($row_ball["fiz"]);
					echo "</td>";	
					echo "<td>".$row_ball["bal1"]."</td>";
					echo "<td>".$row_ball["bal2"]."</td>";	
					echo "<td>".$row_ball["bal3"]."</td>";
					}
			echo "<td>".$row_ball["sochin"]."</td>";	
			echo "<td>".$row_ball["individ"]."</td>";
			echo "</tr>";
				
				}
			}
			$number ++;
	}
	//	}
		
		echo "</table>";
		echo '<br><hr color="#999999"><table><tr><td colspan="2" align="left" style="font-size: 12px;">
		Иванов Иван Иванович - Все копии <br>
		<font style="color: #999; font-style:oblique;">Иванов Иван Иванович</font> - Оригинал на другом направлении
		</td></tr></table>';
		mysql_free_result($res_obr);
		
//********************************************************************** ПРОВЕРКА НА IP АДРЕС
		}
	else {
			echo $title->getStringForm('close');
			}	
//********************************************************************** ПРОВЕРКА НА IP АДРЕС
		
	}

/*+++++++++++++++++++++++++++++++++++*/	
function d_d_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 1 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function d_d_count_copy()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 1 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function d_z_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 2 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function d_z_count_copy()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 2 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function d_e_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 3 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function d_e_count_copy()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 3 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function fb_d_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 1 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function fb_m_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 4 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function d_m_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 4 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function fb_d_count_copy()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 1 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function fb_z_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 2 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function fb_z_count_copy()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 2 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function fb_m_count_copy()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 4 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function d_m_count_copy()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 4 AND ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function zayavl_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.priznak_vozvrata is null and ZHURNAL.Special < 17";	
		$res_obr = mysql_query($obr);
		$number = 0;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}
function abit_count()
	{
		$obr = "SELECT distinct ZHURNAL.IDstud, ZHURNAL.priznak_vozvrata FROM ZHURNAL WHERE ZHURNAL.priznak_vozvrata is null";	

		$res_obr = mysql_query($obr);
		$number = 0;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
        	//printf ($row["IDstud"]);
			$number ++;
		}
		printf ($number);
		mysql_free_result($res_obr);
	}

}
	
?>