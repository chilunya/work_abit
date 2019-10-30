<?php
include_once("get_string.php");
class zurnalForAbitur{
	
	function statForAbit(){
		$title = new get_String_Form();
		$this->config();
		
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		/*	
	
	echo "<br>";
	
		$ip1="192.168.4.0";
		echo $ip1;
		echo "<br>";
		$a1=explode(".",$ip1);
		$intip1 = $a1[0]*256*256*256+$a1[1]*256*256+$a1[2]*256+$a1[3];
		echo $intip1;
	echo "<br>";
		
		$ip2="192.168.4.255";
		echo $ip2;
		echo "<br>";
		$a2=explode(".",$ip2);
		$intip2 = $a2[0]*256*256*256+$a2[1]*256*256+$a2[2]*256+$a2[3];
		echo $intip2;	
	*/	
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
		<p>Экстернат: <strong>'; $this->d_e_count(); echo '</strong></p>
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
		<p>Экстернат: <strong>'; $this->d_e_count_copy(); echo '</strong>
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
}
	else {
				echo $title->getStringForm('close');}
		//echo '<a href="index.php?pages=7&cl=8&nap=1">'; echo $title->getStringForm('spis'); echo '</a>';


}
function podlinn_napravl(){
	$spec="SELECT SPEC.ID, SPEC.KodSpec, SPEC.NameSpec FROM SPEC WHERE SPEC.ID <> 15";
	$res_spec = mysql_query($spec);
    /* show result */
	  	while ($row = mysql_fetch_array($res_spec, MYSQL_ASSOC)) 
		{
			$sql="SELECT SPEC.NameSpec, count(ZHURNAL.Priznak_doc) AS expr1, ZHURNAL.Priznak_doc, SPEC.ID, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt FROM SPEC INNER JOIN ZHURNAL ON SPEC.ID = ZHURNAL.Special WHERE ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 1 AND ZHURNAL.Kontrakt = 1 AND SPEC.ID = ".$row["ID"]." GROUP BY ZHURNAL.Special, SPEC.NameSpec, ZHURNAL.Priznak_doc, SPEC.ID, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt";
			
			$sql_spec = mysql_query($sql);
			$row_sp = mysql_fetch_array($sql_spec, MYSQL_ASSOC);
			
			
			echo '<tr><td>'.$row["KodSpec"].'</td><td>'.$row["NameSpec"].'</td><td><strong>'.$row_sp["expr1"].'</strong></td></tr>';
		}
	

}
	function spisForAbit(){
		//$title = new get_String_Form();
		$this->config();
		$obr = "SELECT SPEC.NameSpec, SPEC.KodSpec, SPEC.ID FROM SPEC ORDER BY SPEC.ID ";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf ("<a href='index.php?pages=16&cl=17&nap=1&spec=".$row["ID"]."'>");
			printf ($row["ID"].". ".$row["NameSpec"]);
			printf ("</a><br>");
		}
		
		mysql_free_result($res_obr);		
	}
	function specForAbit($id){
		$title = new get_String_Form();
		$this->config();
		$obr = "SELECT spec_otd.id_spec, spec_otd.otd1, spec_otd.otd2, spec_otd.otd3, SPEC.NameSpec FROM SPEC INNER JOIN spec_otd ON SPEC.ID = spec_otd.id_spec WHERE spec_otd.id_spec = ".$id;	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			echo '<p><a href="index.php?pages=16&cl=17&nap=1">'; echo $title->getStringForm('back'); echo '</a></p>';
			echo '<p><strong>'.$row["NameSpec"].'</strong></p>';
			echo '<a href="index.php?pages=16&cl=17&nap=1&spec='.$id.'&otd=1">'.$row["otd1"].'</a><br>';
			echo '<a href="index.php?pages=16&cl=17&nap=1&spec='.$id.'&otd=2">'.$row["otd2"].'</a><br>';
			echo '<a href="index.php?pages=16&cl=17&nap=1&spec='.$id.'&otd=3">'.$row["otd3"].'</a><br>';
			echo '<a href="index.php?pages=16&cl=17&nap=1&spec='.$id.'&otd=4">'.$row["otd4"].'</a><br>';
		
			/*echo $row["otd1"]." ".$row["otd2"]." ".$row["otd3"];*/
		}
		echo "</table>";
		mysql_free_result($res_obr);
		
	}
	function otdForAbit($id, $otd){
		$title = new get_String_Form();
		$this->config();
		echo '<p><a href="index.php?pages=16&cl=17&nap=1">'; echo $title->getStringForm('back'); echo '</a></p>';
		$obr = "SELECT INFO.fam, INFO.name, INFO.otch, ZHURNAL.Nomer_po_zhurn, FORMAOBUCH.leter, PRIZNAKDOC.PRIZNAKDOC, ZHURNAL.Special, KONTRAKT.KONTRAKT FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt WHERE ZHURNAL.Special = ".$id." AND ZHURNAL.Otdelenie = ".$otd." AND ZHURNAL.priznak_vozvrata is null ORDER BY ZHURNAL.Nomer_po_zhurn";	
		$res_obr = mysql_query($obr);
		$number = 1;
		// название специальности
		$sql = "SELECT SPEC.NameSpec, SPEC.ID FROM SPEC WHERE SPEC.ID = ".$id;
		$res_sp = mysql_query($sql);
		$nam_sp = mysql_fetch_array($res_sp, MYSQL_ASSOC);
		// название формы обучения
		
		$sql_n = "SELECT FORMAOBUCH.FORMAOBUCH, FORMAOBUCH.ID FROM FORMAOBUCH WHERE FORMAOBUCH.ID = ".$otd;
		$res_n = mysql_query($sql_n);
		$nam_n = mysql_fetch_array($res_n, MYSQL_ASSOC);
		
		echo '<table width="100%"><tr><td width="50%" align="left"><h5>'.$nam_sp["NameSpec"].' - '. $nam_n["FORMAOBUCH"].'</h5></td><td align="right">';
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		echo '<a href="excel_spisok.php?id='.$id.'&otd='.$otd.'">'; echo $title->getStringForm('print_spis'); echo '</a>';
		}
		echo '</td></tr></table>';
    /* show result */
			echo "<table class='table' cellpadding='3'><tbody><tr><th>"; 
			echo $title->getStringForm('nn');
			echo "</th><th>";
			echo $title->getStringForm('fio');
			echo "</th><th>";
			echo $title->getStringForm('num_zh');
			echo "</th><th>";
			echo $title->getStringForm('pr_doc');
			echo "</th><th>";
			echo $title->getStringForm('kont');
			echo "</th></tr></tbody>";
			
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			
			echo "<tr><td>";
			printf ($number.". ");
			echo "</td><td>";
			printf ($row["fam"]." ".$row["name"]." ".$row["otch"]);
			echo "</td><td>";
			printf ($row["Nomer_po_zhurn"]);
			echo "</td><td>";
			printf ($row["PRIZNAKDOC"]);
			echo "</td><td>";
			printf ($row["KONTRAKT"]);
			echo "</td></tr>";
			$number ++;
		}
		echo "</table>";
		
		mysql_free_result($res_obr);
		
		
	}
/*++++++++++++++++++++++++++++++++++
+++++++++++++++++++++++++++++++++++*/	
function d_d_count()
	{
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 1";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 1";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 2";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 2";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 3";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 3";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 1";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 4";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 4";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 1";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 1 AND ZHURNAL.Otdelenie = 2";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 2";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 1 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 4";	
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
		$obr = "SELECT ZHURNAL.IDstud, ZHURNAL.Otdelenie, ZHURNAL.Kontrakt, ZHURNAL.Priznak_doc FROM ZHURNAL WHERE ZHURNAL.Kontrakt = 2 AND ZHURNAL.Priznak_doc = 2 AND ZHURNAL.Otdelenie = 4";	
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
		$obr = "SELECT ZHURNAL.IDstud FROM ZHURNAL";	
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
		$obr = "SELECT distinct ZHURNAL.IDstud FROM ZHURNAL";	
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
	function config()
	{
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
	}
}
	
?>