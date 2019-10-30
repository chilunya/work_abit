<?php
include_once("get_string.php");
include_once("get_function.php");
class zachisForAbitur{	

	function zachForAbit(){
		$title = new get_String_Form();
		$obj = new get_function();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		$obj->config();
		echo '<table class="table" width="100%"><thead>';
		echo '<tr><th><p>'; echo $title->getStringForm('zachis_sql'); echo '</p>';
		echo '</th></tr></thead><tbody>';
		echo '<td>';
		echo '<form action="index.php?pages=5&cl=6" method="GET">';
		echo '<input type="hidden" name="pages" value="5">';
		echo '<input type="hidden" name="cl" value="6">';
		echo '<select name="sp">'; $this->spec(); echo '</select> ';
		echo '<select name="pr"><option value="">'; echo $title->getStringForm('priznak'); echo '</option>'; $this->priznak(); echo '</select> ';
		echo '<select name="kn"><option value="">'; echo $title->getStringForm('kontrakt'); echo '</option>'; $this->kontrakt(); echo '</select> ';
		echo '<select name="ot"><option value="">'; echo $title->getStringForm('otdelenie'); echo '</option>'; $this->otdelenie(); echo '</select> ';
		echo '<select name="lg"><option value="">'; echo $title->getStringForm('lgot_vne'); echo '</option>'; $this->lgot_vne(); echo '</select><br>';
		echo '<input type="submit" class="btn" value="'; 
		echo $title->getStringForm('apply'); echo '"></form>';		
		echo '</td>';
		echo '</tr></tbody></table>';
		}
		else {
			echo $title->getStringForm('close');}

	}
	function zachFormaAbit(){
		$title = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		echo '<h4>'; $this->spec_name($_GET['sp']); echo'</h4>';
		echo '<table class="table" width="100%"><thead><tr>';
		echo '<th>№</th>';
		echo '<th>'; echo $title->getStringForm('fio'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('akad_bak'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('prik_bak'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('for_ob'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('num_zh'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('pr_doc'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('kont'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('lgt'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('bal_ege'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('zh'); echo '</th>';
		echo '</th></tr></thead><tbody>';
		
		$tabl = "SELECT ZHURNAL.ID_zh, INFO.ID, INFO.fam, INFO.name, INFO.otch, ZHURNAL.akad_bak, ZHURNAL.prik_bak, ZHURNAL.Otdelenie, ZHURNAL.Zachislen, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Priznak_doc, ZHURNAL.lgot_vne, ZHURNAL.Special, SPEC.NameSpec, KONTRAKT.KONTRAKT, LGOTAVNEKONK.LGOTAVNEKONK, ZHURNAL.Kontrakt, ZHURNAL.priznak_vozvrata, PRIZNAKDOC.PRIZNAKDOC, FORMAOBUCH.FORMAOBUCH, INFO.sochin, INFO.individ, INFO.bal1 + INFO.bal5 + INFO.kompdiz + INFO.grafdiz + INFO.risunok + INFO.sochin + INFO.individ AS dis, INFO.bal1 + INFO.bal2 + INFO.bal3 + INFO.sochin + INFO.individ AS fiz, INFO.bal1 + INFO.bal2 + INFO.komparh + INFO.grafarh + INFO.risunok + INFO.sochin + INFO.individ AS arh, INFO.bal1 + INFO.bal2 + INFO.bal4 + INFO.sochin + INFO.individ AS obw FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.priznak_vozvrata is null AND ZHURNAL.Special = ".$_GET['sp']." AND ZHURNAL.Zachislen <> 1 ";
		if (isset($_GET['pr']) and  $_GET['pr']!= '') 
		{
			 $tabl = $tabl . " AND ZHURNAL.Priznak_doc = ".$_GET['pr'];
		}
		if (isset($_GET['kn']) and  $_GET['kn']!= '') 
		{
			 $tabl = $tabl . " AND ZHURNAL.Kontrakt = ".$_GET['kn'];
		}
		if (isset($_GET['ot']) and  $_GET['ot']!= '') 
		{
			 $tabl = $tabl . " AND ZHURNAL.Otdelenie = ".$_GET['ot'];
		}
		if (isset($_GET['lg']) and  $_GET['lg']!= '') 
		{
			 $tabl = $tabl . " AND ZHURNAL.lgot_vne = ".$_GET['lg'];
		}
		
		switch($_GET['sp']){
		case 1:	
		$tabl = $tabl. " ORDER BY dis DESC";
		break;
		case 2:	
		$tabl = $tabl. " ORDER BY obw DESC";
		break;
		case 3:	
		$tabl = $tabl. " ORDER BY obw DESC";
		break;
		case 4:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 5:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 6:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 7:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 8:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 9:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 10:	
		$tabl = $tabl. " ORDER BY arh DESC";
		break;
		case 11:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 12:	
		$tabl = $tabl. " ORDER BY arh DESC";
		break;
		case 13:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 14:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 15:	
		$tabl = $tabl. " ORDER BY fiz DESC";
		break;
		case 16:	
		$tabl = $tabl. " ORDER BY obw DESC";
		break;
		}
		
		
		$res_tabl = mysql_query($tabl);
		
    /* show result */
	$num = 1;
	  	while ($row = mysql_fetch_array($res_tabl, MYSQL_ASSOC)) 
		{
			if ($row["Zachislen"] == 1) {$checked="checked";} else {$checked="";}
			printf("<form action='class/save/save_zachisl.php' method='POST' name='form_z'>");
			printf("<tr><td>".$num ."</td>");
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
 
			if ($row["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			printf("<td><input type='checkbox' ".$chek_akad." name='akad_b".$num."'></td>");
			
			if ($row["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			printf("<td><input type='checkbox' ".$chek_prik." name='prik_b".$num."'></td>");
			
			printf("<td>".$row["FORMAOBUCH"]."</td>");
			printf("<td>".$row["Nomer_po_zhurn"]."</td>");
			printf("<td>".$row["PRIZNAKDOC"]."</td>");
			printf("<td>".$row["KONTRAKT"]."</td>");
			printf("<td>".$row["LGOTAVNEKONK"]."</td>");
			switch($_GET['sp']){
		case 1:	
		$ege = $row["dis"];
		break;
		case 2:	
		$ege = $row["obw"];
		break;
		case 3:	
		$ege = $row["obw"];
		break;
		case 4:	
		$ege = $row["fiz"];
		break;
		case 5:	
		$ege = $row["fiz"];
		break;
		case 6:	
		$ege = $row["fiz"];
		break;
		case 7:	
		$ege = $row["fiz"];
		break;
		case 8:	
		$ege = $row["fiz"];
		break;
		case 9:	
		$ege = $row["fiz"];
		break;
		case 10:
		$ege = $row["arh"];	
		break;
		case 11:	
		$ege = $row["fiz"];
		break;
		case 12:	
		$ege = $row["arh"];
		break;
		case 13:
		$ege = $row["fiz"];	
		break;
		case 14:	
		$ege = $row["fiz"];
		break;
		case 15:
		$ege = $row["fiz"];	
		break;
		case 16:
		$ege = $row["obw"];	
		break;
		}
			
			printf("<td>".$ege."</td>");
			printf("<td><input type='checkbox' ".$checked." name='check".$num."' value='1'><input type='hidden' value='".$row["ID_zh"]."' name='id_zch".$num."'><input type='hidden' value='".$num."' name='num'></td></tr>");
	$num++;
		}
		
		mysql_free_result($res_tabl);
		echo '<tr><td colspan="11">
		<div class="controls controls-row">
		<input type="text" name="n_prikaz" class="span2" placeholder="Номер приказа">
		<input type="text" name="dat_prikaz" id="datepicker_dog" class="span2" placeholder="Дата приказа"> &nbsp;
		<input class="btn" type="submit" value="'; echo $title->getStringForm('save'); echo '"></div></form></td></tr>';
		echo '</tbody></table>';

	}
/*++++++++++++++++++++++++++++++++++

TABLE -  lgot_vne

+++++++++++++++++++++++++++++++++++*/	
	function lgot_vne()
	{
		$obr = "SELECT ID, LGOTAVNEKONK FROM LGOTAVNEKONK ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["LGOTAVNEKONK"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  kontrakt

+++++++++++++++++++++++++++++++++++*/	
	function kontrakt()
	{
		$obr = "SELECT ID, KONTRAKT FROM KONTRAKT ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["KONTRAKT"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  otdelenie

+++++++++++++++++++++++++++++++++++*/	
	function otdelenie()
	{
		$obr = "SELECT ID, FORMAOBUCH FROM FORMAOBUCH ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["FORMAOBUCH"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  priznak

+++++++++++++++++++++++++++++++++++*/	
	function priznak()
	{
		$obr = "SELECT ID, PRIZNAKDOC FROM PRIZNAKDOC ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["PRIZNAKDOC"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  spec

+++++++++++++++++++++++++++++++++++*/	
	function spec()
	{
		$obr = "SELECT NameSpec, ID FROM SPEC ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["NameSpec"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}	
	function spec_name($id)
	{
		$obr = "SELECT NameSpec, KodSpec FROM SPEC WHERE ID=".$id;	
		$res_obr = mysql_query($obr);
    /* show result */
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
        	printf ($row["KodSpec"]." - ".$row["NameSpec"]);
		mysql_free_result($res_obr);
	}
	/*function config()
	{
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
	}
	*/
}
	
?>