<?php
include_once("get_string.php");
class printAbiturDogovor{
	function printAbitur(){
	$txt = new get_String_Form();	
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
	echo '<div class="alert"><p>'; echo $txt->getStringForm("forma4"); echo '</p></div>';
	echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
	echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
	echo '" class="btn" action="index.php?pages=17&cl=18"></form>';
	}
	else {
				echo $txt->getStringForm('close');}
}
	function printInfoAbityr($id, $sub){
//include_once("get_string.php");
$txt = new get_String_Form();

if (isset($id) and $id != ""){
/////////////////filtr
echo $txt->getStringForm('filtr').'<span class="text-info">'. $id . '</span> '; 
//filtr dell filtr_del
echo '<a href="index.php?pages=17&cl=18" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
/////////////////filtr end
		$this->config();
		$obr = "SELECT DISTINCT ZHURNAL.IDstud, INFO.fam, INFO.name, INFO.otch, INFO.data_rozhd FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud WHERE INFO.fam LIKE '". $id ."%' ORDER BY INFO.fam";	
		$res_obr = mysql_query($obr);
		$number = 1;
   // head of table
		echo '<table class="table table-hover"><thead>';
		echo '<tr><th>'; echo $txt->getStringForm('nn');
		echo '</th><th>'; echo  $txt->getStringForm('lastname');
		echo '</th><th>'; echo  $txt->getStringForm('name');
		echo '</th><th>'; echo  $txt->getStringForm('parth');
		echo '</th><th>'; echo  $txt->getStringForm('date_birth');
		echo '</th><th>'; echo  $txt->getStringForm('action');
		echo '</th></tr></thead>';
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<tbody><tr>");
			printf("<td>");
        	printf ($number);
			printf("</td>");
			printf("<td align='left'>");
        	printf ($row["fam"]);
			printf("</td>");
			printf("<td align='left'>");
			printf ($row["name"]);
			printf("</td>");
			printf("<td align='left'>");
			printf ($row["otch"]);
			printf("</td>");
			printf("<td align='left'>");
			printf ($row["data_rozhd"]);
			printf("</td>");
			printf("<td align='left'><a href='index.php?pages=17&cl=18&id=$row[IDstud]'>");
			printf ($txt->getStringForm('open'));
			printf("</a></td>");
			printf("</tr></tbody>");
			$number ++;
		}
		echo "</table>";
		mysql_free_result($res_obr);
}	
if (isset($sub) and $id == ""){
	echo '<p class="text-error">'; echo $txt->getStringForm('req_sub'); echo '</p>';
		}
	return $id;
	return $sub;
	}
	
function editFormaDogovor($id_stud){
		$title = new get_String_Form();
		$this->config();
		$stu = "SELECT INFO.ID, INFO.fam, INFO.name, INFO.otch FROM INFO WHERE INFO.ID = ".$id_stud."";
		$res_stu = mysql_query($stu);
		$row_stu = mysql_fetch_array($res_stu, MYSQL_ASSOC);
		
		
		echo '<h4>'.$row_stu['fam'].' '.$row_stu['name'].' '.$row_stu['otch'].'</h4>';
		echo '<table class="table" width="100%"><thead><tr>';
		echo '<th>№</th>';
		echo '<th>'; echo $title->getStringForm('kr_spec'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('kont'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('nom_dogovor'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('date_dogovora'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('zakazchik'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('date_oplati'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('zh'); echo '</th>';
		echo '<th>'; echo $title->getStringForm('print'); echo '</th>';
		echo '</th></tr></thead><tbody>';
		
		$tabl = "SELECT
  ZHURNAL.ID_zh,
  INFO.ID,
  ZHURNAL.Otdelenie,
  ZHURNAL.Nom_dogovor,
  ZHURNAL.Date_dogovora,
  ZHURNAL.Date_oplaty,
  ZHURNAL.zakazchik,
  ZHURNAL.Zachislen, 
  ZHURNAL.Special, 
  ZHURNAL.pasp_zakazchik, 
  ZHURNAL.Kontrakt, 
  FORMAOBUCH.leter,
  SPEC.KratkoeName,
  ZHURNAL.Nomer_po_zhurn,
  ZHURNAL.priznak_vozvrata,
  INFO.fam,
  INFO.name,
  INFO.otch
FROM INFO
  INNER JOIN ZHURNAL
    ON INFO.ID = ZHURNAL.IDstud
  INNER JOIN SPEC
    ON SPEC.ID = ZHURNAL.Special
  INNER JOIN FORMAOBUCH
    ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE INFO.ID = ".$id_stud." AND ZHURNAL.priznak_vozvrata IS NULL ORDER BY ZHURNAL.ID_zh";
		//echo $tabl;
		$res_tabl = mysql_query($tabl);
		
    /* show result 
	$num=1;
	  	while ($row = mysql_fetch_array($res_tabl, MYSQL_ASSOC)) 
		{
			if ($row["Zachislen"] == 1) {$checked="checked";} else {$checked="";}
			printf("<form action='class/save_kontr_dog.php' method='POST'>");
			printf("<p>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</p>");
			printf("<input type='hidden' name='id_zh' value='".$row["ID_zh"]."'>");
			printf("<input type='hidden' name='id_st' value='".$row["ID"]."'>");
			printf("<tr><td>".$num."</td>");
			printf("<td>".$row["KratkoeName"]."-".$row["Nomer_po_zhurn"]."/".$row["leter"]."</td>");
			printf("<td><select name='kontr' class='input-small'>"); $this->kontrakt($row["Kontrakt"]); printf("</select></td>");
			printf("<td><input type='text' class='input-small' name='nom_dog' value='".$row["Nom_dogovor"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_dog' value='".$row["Date_dogovora"]."' id='datepicker_dog_'></td>");
			printf("<td><input type='text' class='input-small' name='zakaz' value='".$row["zakazchik"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_opl' value='".$row["Date_oplaty"]."' id='datepicker_opl_'></td>");
			printf("<td><center><input type='checkbox' ".$checked." name='check' value='1'><input type='hidden' value='' name='num'></center></td>");
			printf("<td><center>");
			if ($row["Nom_dogovor"] != ""){
			printf("<a href='excel_dogovor.php?id=".$row["ID_zh"]."&fl=1'><img src='css/img/f_printer.png' wight='16' height='16'></a>&nbsp;");
			printf("<a href='testNamesUTF.php?id=".$row["ID_zh"]."&fl=2'><img src='css/img/2.jpg' wight='16' height='16'></a>&nbsp;");
			//printf("<a href='excel_zayavl.php?id=".$row["ID_zh"]."&fl=2'><img src='css/img/2.jpg' wight='16' height='16'></a>&nbsp;");
			printf("<a href='testNamesUTF.php?id=".$row["ID_zh"]."&fl=4'><img src='css/img/4.jpg' wight='16' height='16'></a>");
			printf("<a href='NamesUTF.php?id=".$row["ID_zh"]."'><img src='css/img/doc.jpg' wight='16' height='16'></a>");
			}
			printf("</center></td></tr>");
			$num=$num+1;
	
		}
	 show result */
	$num = 1;
	
	  	while ($row = mysql_fetch_array($res_tabl, MYSQL_ASSOC)) 
		{
			if ($row["Zachislen"] == 1) {$checked="checked";} else {$checked="";}
			
			
			printf("<form action='class/save_kontr_dog.php' method='POST'>");
			printf("<input type='hidden' name='id_st' value='".$row["ID"]."'>");
			printf("<tr><td>".$num ."</td>");
			printf("<td>".$row["KratkoeName"]."-".$row["Nomer_po_zhurn"]."/".$row["leter"]."</td>");
			printf("<td><select name='kontr".$num."' class='input-small'>"); $this->kontrakt($row["Kontrakt"]); printf("</select></td>");
			printf("<td><input type='text' class='input-small' name='nom_dog".$num."' value='".$row["Nom_dogovor"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_dog".$num."' value='".$row["Date_dogovora"]."' id='datepicker_dog_".$num."'></td>");
			printf("<td><input type='text' class='input-small' name='zakaz".$num."' value='".$row["zakazchik"]."'></td>");
			printf("<td><input type='text' class='input-small' name='dat_opl".$num."' value='".$row["Date_oplaty"]."' id='datepicker_opl_".$num."'></td>");
			printf("<td><center><input type='checkbox' ".$checked." name='check".$num."' value='1'><input type='hidden' value='".$row["ID_zh"]."' name='id_zch".$num."'><input type='hidden' value='".$num."' name='num'></center></td>");
			printf("<td><center>");
			if ($row["Nom_dogovor"] != ""){
			printf("<a href='excel_dogovor.php?id=".$row["ID_zh"]."&fl=1'><img src='css/img/f_printer.png' wight='16' height='16'></a>&nbsp;");
			//printf("<a href='testNamesUTF.php?id=".$row["ID_zh"]."&fl=2'><img src='css/img/2.jpg' wight='16' height='16'></a>&nbsp;");
			//printf("<a href='excel_zayavl.php?id=".$row["ID_zh"]."&fl=2'><img src='css/img/2.jpg' wight='16' height='16'></a>&nbsp;");
			printf("<a href='excel_zayavl.php?id=".$row["ID_zh"]."&fl=4'><img src='css/img/4.jpg' wight='16' height='16'></a>");
			printf("<a href='excel_spravka.php?id=".$row["ID_zh"]."'><img src='css/img/doc.jpg' wight='16' height='16'></a>");
			}
			printf("</center></td></tr>");
	$num++;
		}
		$paszak = "SELECT ZHURNAL.IDstud, ZHURNAL.pasp_zakazchik, ZHURNAL.ID_zh FROM ZHURNAL WHERE ZHURNAL.IDstud = ".$id_stud." AND ZHURNAL.pasp_zakazchik <> ''";
		$pas_zak = mysql_query($paszak);
		$pass_row = mysql_fetch_array($pas_zak, MYSQL_ASSOC);
		echo '<tr><td colspan="4">Паспортные данные заказчика <br>(дата рождения, прописка, серия номер паспорта,<br> кем выдан, телефон):<br><font color="red" size="2">(заполняются в случае, если заказчик и обучающийся разные люди)</font></td><td colspan="5"><textarea cols="50" name="pasp_zakaz">'.$pass_row['pasp_zakazchik'].'</textarea></td></tr>';
		echo '<tr><td colspan="9"><input class="btn" type="submit" value="'; echo $title->getStringForm('save'); echo '"></form></td></tr>';
		echo '</tbody></table>';
		mysql_free_result($res_tabl);
	}

function zaprosZhurnalAbitur($idstud)
	{
		$this->config();
		$zhurn = "SELECT ZHURNAL.IDstud, SPEC.KodSpec, ZHURNAL.Nomer_po_zhurn, INFO.fam, INFO.pasport_ser, INFO.pasport_nom, INFO.name, INFO.otch, FORMAOBUCH.leter, SPEC.KratkoeName, PRIZNAKDOC.PRIZNAKDOC, ZHURNAL.Protokol, ZHURNAL.Date_podachi, KONTRAKT.KONTRAKT, ZHURNAL.ID_zh, LGOTAVNEKONK.LGOTAVNEKONK FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne WHERE ZHURNAL.IDstud = ".$idstud." ORDER BY ZHURNAL.ID_zh";
		//$zhurn = "SELECT ZHURNAL.IDstud, SPEC.KodSpec, ZHURNAL.Nomer_po_zhurn, INFO.fam, INFO.name, INFO.otch, FORMAOBUCH.leter, SPEC.KratkoeName, PRIZNAKDOC.PRIZNAKDOC, ZHURNAL.Protokol, ZHURNAL.Date_podachi, KONTRAKT.KONTRAKT, ZHURNAL.ID_zh, ZHURNAL.lgot_vne FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt WHERE ZHURNAL.IDstud = ".$idstud." ORDER BY ZHURNAL.ID_zh";
		
		$res_zhurn = mysql_query($zhurn);
    /* show result */
	  	while ($row = mysql_fetch_array($res_zhurn, MYSQL_ASSOC)) 
		{
			printf("<tr>");
			printf ("<td>".$row["Nomer_po_zhurn"]."</td>");
			printf ("<td>".$row["KratkoeName"]."</td>");
			printf ("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			printf ("<td>".$row["leter"]."</td>");
			printf ("<td>".$row["PRIZNAKDOC"]."</td>");
			printf ("<td>".$row["Protokol"]."</td>");
			printf ("<td>".$row["Date_podachi"]."</td>");
			printf ("<td>".$row["KONTRAKT"]."</td>");
			printf ("<td>".$row["pasport_ser"]." ".$row["pasport_nom"]."</td>");
			printf ("<td>".$row["LGOTAVNEKONK"]."</td>");
			printf ("<td><a href='index.php?pages=17&cl=18&id=".$idstud."&edit=edit&zh=".$row["ID_zh"]."'><img src='css/img/edit.png'></a> <a href='index.php?pages=17&cl=18&id=".$idstud."&dell=dell&zh=".$row["ID_zh"]."'><img src='css/img/delete.png'></a></td>");
			printf("</tr>");
		}
		mysql_free_result($res_zhurn);
	return($idstud);
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