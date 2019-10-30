<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class kontraktForAbitur{	

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
		echo '<form action="index.php?pages=9&cl=10" method="GET">';
		echo '<input type="hidden" name="pages" value="9">';
		echo '<input type="hidden" name="cl" value="10">';
		echo '<select name="sp">'; $this->spec(); echo '</select> ';
		echo '<select name="ot"><option value="">'; echo $title->getStringForm('otdelenie'); echo '</option>'; $this->otdelenie(); echo '</select><br>';
		echo '<input type="submit" class="btn" value="'; 
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
		
		echo '<h4>'; $this->spec_name($_GET['sp']); echo' - '; $this->forma_name($_GET['ot']); echo'</h4>';
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
		
		$tabl = "SELECT ZHURNAL.ID_zh, INFO.ID, INFO.fam, INFO.name, INFO.otch, ZHURNAL.Otdelenie, ZHURNAL.Nom_dogovor, ZHURNAL.Date_dogovora, ZHURNAL.Date_oplaty, ZHURNAL.zakazchik, ZHURNAL.Zachislen, ZHURNAL.Special, SPEC.NameSpec, ZHURNAL.Kontrakt, FORMAOBUCH.leter FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.Special = ".$_GET['sp'];
		if (isset($_GET['ot']) and  $_GET['ot']!= '') 
		{
			 $tabl = $tabl . " AND ZHURNAL.Otdelenie = ".$_GET['ot'];
		}
		 $tabl = $tabl . " ORDER BY INFO.fam";
		//echo $tabl;
		$res_tabl = mysql_query($tabl);
		
    /* show result */
	$num = 1;
	  	while ($row = mysql_fetch_array($res_tabl, MYSQL_ASSOC)) 
		{
			if ($row["Zachislen"] == 1) {$checked="checked";} else {$checked="";}
			printf("<form action='class/save_kontr.php' method='POST'>");
			printf("<input type='hidden' name='sp' value='".$_GET['sp']."'>");
			printf("<input type='hidden' name='ot' value='".$_GET['ot']."'>");
			printf("<tr><td>".$num ."</td>");
			printf("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			printf("<td><select name='kontr".$num."' class='input-small'>"); $this->kontrakt($row["Kontrakt"]); printf("</select></td>");
			printf("<td><input type='text' class='input-small' name='nom_dog".$num."' value='".$row["Nom_dogovor"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_dog".$num."' value='".$row["Date_dogovora"]."' id='datepicker_dog_".$num."'></td>");
			printf("<td><input type='text' class='input-small' name='zakaz".$num."' value='".$row["zakazchik"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_opl".$num."' value='".$row["Date_oplaty"]."' id='datepicker_opl_".$num."'></td>");
			printf("<td><center><input type='checkbox' ".$checked." name='check".$num."' value='1'><input type='hidden' value='".$row["ID_zh"]."' name='id_zch".$num."'><input type='hidden' value='".$num."' name='num'></center></td>");
			printf("<td><center>");
			if ($row["Nom_dogovor"] != ""){
			printf("<a href='excel_dogovor.php?id=".$row["ID_zh"]."&fl=1'><img src='css/img/f_printer.png' wight='16' height='16'></a>&nbsp;");
			printf("<a href='testNamesUTF.php?id=".$row["ID_zh"]."&fl=2'><img src='css/img/2.jpg' wight='16' height='16'></a>&nbsp;");
			//printf("<a href='excel_zayavl.php?id=".$row["ID_zh"]."&fl=2'><img src='css/img/2.jpg' wight='16' height='16'></a>&nbsp;");
			printf("<a href='testNamesUTF.php?id=".$row["ID_zh"]."&fl=4'><img src='css/img/4.jpg' wight='16' height='16'></a>");
			printf("<a href='NamesUTF.php?fam=".$row["fam"]."&name=".$row["name"]."&otch=".$row["otch"]."&id=".$row["ID_zh"]."'><img src='css/img/doc.jpg' wight='16' height='16'></a>");
			}
			printf("</center></td></tr>");
	$num++;
		}
		
		//mysql_free_result($res_tabl);
		echo '<tr><td colspan="9"><input class="btn" type="submit" value="'; echo $title->getStringForm('save');  echo '"></form></td></tr>';
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
	$obr = "SELECT KONTRAKT FROM KONTRAKT";	
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
		$obr = "SELECT FORMAOBUCH FROM FORMAOBUCH";	
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

TABLE -  priznak

+++++++++++++++++++++++++++++++++++*/	
	function priznak()
	{
		$obr = "SELECT PRIZNAKDOC FROM PRIZNAKDOC";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='$number'>");
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