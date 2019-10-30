<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class kontraktForVostan{	

	function kontForAbit(){
		$title = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		$obj = new get_function();
		$obj->config();
		echo '<table class="table" width="100%"><thead>';
		echo '<tr><th><p>'; echo $title->getStringForm('zachis_sql'); echo '</p>';
		echo '</th></tr></thead><tbody>';
		echo '<td>';
		echo '<form action="index.php?pages=13&cl=14" method="GET">';
		echo '<input type="hidden" name="pages" value="13">';
		echo '<input type="hidden" name="cl" value="14">';
		echo '<select name="sp" class="input-xxlarge">'; $this->spec(); echo '</select> ';
		echo '<br><input type="submit" class="btn" value="'; 
		echo $title->getStringForm('apply'); echo '"></form>';		
		echo '</td>';
		echo '</tr></tbody></table>';
		}
	else {
				echo $title->getStringForm('close');}

	}
	function editFormaAbit(){
		$title = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		
		echo '<h4>'; $this->spec_name($_GET['sp']); echo'</h4>';
		echo '<table class="table" width="100%"><thead><tr>';
		echo '<th>№</th>';
		echo '<th>'; echo $title->getStringForm('fio'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('kont'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('nom_dogovor'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('date_dogovora'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('zakazchik'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('date_oplati'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('zh'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('print'); echo '</th>';
		echo '</th></tr></thead><tbody>';


$tabl = "SELECT ZHURNAL_VOSTANOVLENIE.ID_vos, INFO.ID, INFO.fam, INFO.name, INFO.otch, ZHURNAL_VOSTANOVLENIE.nom_dogov, ZHURNAL_VOSTANOVLENIE.data_dogov, ZHURNAL_VOSTANOVLENIE.data_oplat, ZHURNAL_VOSTANOVLENIE.zakazchik, ZHURNAL_VOSTANOVLENIE.zachislen, SPEC_VOSTAN.spec, FORMAOBUCH.leter, FORMAOBUCH.FORMAOBUCH, ZHURNAL_VOSTANOVLENIE.spec, ZHURNAL_VOSTANOVLENIE.otdelenie, ZHURNAL_VOSTANOVLENIE.kurs, ZHURNAL_VOSTANOVLENIE.kontrakt FROM INFO INNER JOIN ZHURNAL_VOSTANOVLENIE ON INFO.ID = ZHURNAL_VOSTANOVLENIE.ID_abit INNER JOIN SPEC_VOSTAN ON SPEC_VOSTAN.ID = ZHURNAL_VOSTANOVLENIE.spec INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL_VOSTANOVLENIE.otdelenie WHERE ZHURNAL_VOSTANOVLENIE.spec =".$_GET['sp'];

		$res_tabl = mysql_query($tabl);
		
    /* show result */
	$num = 1;
	  	while ($row = mysql_fetch_array($res_tabl, MYSQL_ASSOC)) 
		{
			if ($row["zachislen"] == 1) {$checked="checked";} else {$checked="";}
			printf("<form action='class/save_kontr_vostan.php' method='POST'>");
			printf("<input type='hidden' name='sp' value='".$_GET['sp']."'>");
			printf("<tr><td>".$num ."</td>");
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			printf("<td><select name='kontr".$num."' class='input-small'>"); $this->kontrakt($row["kontrakt"]); printf("</select></td>");
			printf("<td><input type='text' class='input-small' name='nom_dog".$num."' value='".$row["nom_dogov"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_dog".$num."' value='".$row["data_dogov"]."' id='datepicker_dog_".$num."'></td>");
			printf("<td><input type='text' class='input-small' name='zakaz".$num."' value='".$row["zakazchik"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_opl".$num."' value='".$row["data_oplat"]."' id='datepicker_opl_".$num."'></td>");
			printf("<td><center><input type='checkbox' ".$checked." name='check".$num."' value='1'><input type='hidden' value='".$row["ID_vos"]."' name='id_zch".$num."'><input type='hidden' value='".$num."' name='num'></center></td>");
			printf("<td><center>");
			if ($row["nom_dogov"] != ""){
			printf("<a href='excel_dogovor.php?id=".$row["ID_vos"]."&fl=2'><img src='css/img/f_printer.png' wight='16' height='16'></a>");
			}
			printf("</center></td></tr>");

	$num++;
		}
		
		mysql_free_result($res_tabl);
		echo '<tr><td colspan="10"><input class="btn" type="submit" value="'; echo $title->getStringForm('save'); echo '"></form></td></tr>';
		echo '</tbody></table>';

	}
/*++++++++++++++++++++++++++++++++++

TABLE -  lgot_vne

+++++++++++++++++++++++++++++++++++*/	
	function lgot_vne()
	{
		$obr = "SELECT LGOTAVNEKONK FROM LGOTAVNEKONK";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='$number'>");
        	printf ($row["LGOTAVNEKONK"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  kontrakt

+++++++++++++++++++++++++++++++++++*/	
	function kontrakt($selected)
	{
	$obr = "SELECT ID, KONTRAKT FROM KONTRAKT ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $number){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='$number'>");
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
			printf("<option value='$number'>");
        	printf ($row["FORMAOBUCH"]);
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
		$obr = "SELECT spec, ID, ID_spec FROM SPEC_VOSTAN ORDER BY spec";	
		$res_obr = mysql_query($obr);
		/* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["ID_spec"].' - '.$row["spec"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}	
	
	function spec_name($id)
	{
		$obr = "SELECT spec, ID_spec FROM SPEC_VOSTAN WHERE ID=".$id;	
		$res_obr = mysql_query($obr);
    /* show result */
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
        	printf ($row["ID_spec"]." - ".$row["spec"]);
		mysql_free_result($res_obr);
	}
		function forma_name($id)
	{
		$obr = "SELECT FORMAOBUCH FROM FORMAOBUCH WHERE ID=".$id;	
		$res_obr = mysql_query($obr);
    /* show result */
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
        	printf ($row["FORMAOBUCH"]);
		mysql_free_result($res_obr);
	}
}
	
?>