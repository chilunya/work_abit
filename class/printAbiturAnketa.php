<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class printAbiturAnketa{
	function printAbiturForm(){
		$txt = new get_String_Form();	
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			//echo $ip;
			$a=explode(".",$ip);
			$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
			if (($intip < 3232301055 and $intip > 3232235520)){
		echo '<div class="alert"><p>'; echo $txt->getStringForm("forma4"); echo '</p></div>';
		echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
		echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
		echo '" class="btn" action="index.php?pages=3&cl=4"></form>';
		}
		else {
					echo $txt->getStringForm('close');}
		}
	function printInfoAbityr($id, $sub){
		//include_once("get_string.php");
		$txt = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		if (isset($id) and $id != ""){
		/////////////////filtr
		echo $txt->getStringForm('filtr').'<span class="text-info">'. $id . '</span> '; 
		//filtr dell filtr_del
		echo '<a href="index.php?pages=3&cl=4" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
		/////////////////filtr end
		$res_obr = $obj->choose_abitur_like_fam_with_zhur($id);
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
		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)){
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
			printf("<td align='left'><a href='index.php?pages=3&cl=4&id=".$row["IDstud"]."'>");
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
	
	function printLookAbitur($idstud){
		$txt = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		echo '<table class="table table-hover"><thead>';
		echo '<th>Приоритет</th><th>'; echo  $txt->getStringForm('num_zh');
		echo '</th><th>'; echo  $txt->getStringForm('kr_spec');
		echo '</th><th>'; echo  $txt->getStringForm('fio');
		echo '</th><th>'; echo  $txt->getStringForm('for_ob');
		echo '</th><th>'; echo  $txt->getStringForm('pr_doc');
		echo '</th><th>'; echo  $txt->getStringForm('prot');
		echo '</th><th>'; echo  $txt->getStringForm('date_podachi');
		echo '</th><th>'; echo  $txt->getStringForm('kont');
		echo '</th><th>'; echo  $txt->getStringForm('pasport');
		echo '</th><th>'; echo  $txt->getStringForm('lgt');
		echo '</th><th>'; echo  $txt->getStringForm('action');
		echo '</th></tr></thead><tbody>';
		$this->zaprosZhurnalAbitur($idstud); //своя функция
		echo '</tbody></table>';
		echo '<hr>';
		//echo '<p align="left" style="color:red;">Выбирать только если оформляете разные папки!!!</p>';
		echo '<p align="left"><form action="excel.php" method="GET">';
		echo '<input type="hidden" name="id" value="'.$idstud.'">';
		echo '<select name="kn"><option value="">'; echo $txt->getStringForm('kontrakt'); echo '</option>'; $this->kontrakt_print(); echo '</select> или ';
		echo '<select name="ot"><option value="">'; echo $txt->getStringForm('otdelenie'); echo '</option>'; $this->otdelenie_print(); echo '</select><br>';
		echo '<input type="submit" value="'; echo  $txt->getStringForm('print_zayavl').'" class="btn">';
		echo '</form>';
		
		//echo '<p align="left"><a href="excel.php?id='.$idstud.'" target="_blank">'; echo  $txt->getStringForm('print_zayavl');
		//echo '</a></p>';
		echo '<a href="excel_sobes.php?id='.$idstud.'" target="_blank">'; echo  $txt->getStringForm('print_indiv');
		echo '</a><br>';
		echo '<a href="excel_magistr.php?id='.$idstud.'" target="_blank">'; echo  $txt->getStringForm('print_market');
		echo '</a></p>';
		echo $todell;		
	mysql_close($dbcnx);
	return($idstud);
		}

	function zaprosZhurnalAbitur($idstud){
		//$txt = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		$res_zhurn = $obj->look_zaurnal_of_abitur($idstud);
	  	while ($row = mysql_fetch_array($res_zhurn, MYSQL_ASSOC)) 
		{
			printf("<tr>");
			printf ("<td>".$row["priority"]."</td>");
			printf ("<td>".$row["Nomer_po_zhurn"]."</td>");
// прикладной и академический (начало)
//			if ($row["akad_bak"] == 1 and $row["prik_bak"] == 1){$bak = '(АБ+ПБ)';}
//			elseif ($row["akad_bak"] <> 1 and $row["prik_bak"] == 1){$bak = '(ПБ)';}
//			elseif ($row["akad_bak"] == 1 and $row["prik_bak"] <> 1){$bak = '';}
//			else {
				$bak = '';
//			}
//
// прикладной и академический (начало)
			printf ("<td>".$row["KratkoeName"]." ".$bak."</td>");
			printf ("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			printf ("<td>".$row["leter"]."</td>");
			printf ("<td>".$row["PRIZNAKDOC"]."</td>");
			printf ("<td>".$row["Protokol"]."</td>");
			printf ("<td>".date("d.m.Y", strtotime($row['Date_podachi']))."</td>");
			printf ("<td>".$row["KONTRAKT"]."</td>");
			printf ("<td>".$row["pasport_ser"]." ".$row["pasport_nom"]."</td>");
			printf ("<td>".$row["LGOTAVNEKONK"]."</td><td>");
			if ($row["to_edit"] <> 1){
			printf ("<a href='index.php?pages=3&cl=4&id=".$idstud."&edit=edit&zh=".$row["ID_zh"]."'><img src='css/img/edit.png'></a> ");
			printf ("<a href='index.php?pages=3&cl=4&id=".$idstud."&dell=dell&zh=".$row["ID_zh"]."'><img src='css/img/delete.png'></a>");
			}
			if ($row["to_edit"] == 1){
				if ($_SESSION['levl'] < 3){
			printf ("<a href='index.php?pages=3&cl=4&id=".$idstud."&edit=edit&zh=".$row["ID_zh"]."'><img src='css/img/edit.png'></a> ");
			printf ("<a href='index.php?pages=3&cl=4&id=".$idstud."&dell=dell&zh=".$row["ID_zh"]."'><img src='css/img/delete.png'></a>");
				}
			}
			
			printf("</td></tr>");
		}
		//mysql_free_result($res_zhurn);
		//return($idstud);
		}
	function printDellAbitur($id_zh, $idstud){
		$obj = new get_function();
		$txt = new get_String_Form();
		echo '<form method="POST" action="class/save_dell_of_zh.php?idzh='.$id_zh.'&id='.$idstud.'"><table class="table table-hover"><thead>';
		echo '<th width="80%">'; echo  $txt->getStringForm('why_dell');
		echo '</th><th width="20%">'; echo  $txt->getStringForm('action');
		echo '</th></tr></thead><tbody><tr>';
		echo '<td><select required name="why_dell">'; $obj->why_dell_zh(); echo '</select></td>';
		echo '<td><input type="submit" class="btn" value="'; echo $txt->getStringForm('but_dell'); echo '"></td>';
		echo '</tr><tbody></table></form>';
		return($id_zh);
		return($idstud);
		}
	function printEditAbitur($id_zh, $idstud){
		$txt = new get_String_Form();
		$obj = new get_function();
		echo '<form method="POST" action="class/save/save_zh_of_abit.php?idzh='.$id_zh.'&id='.$idstud.'"><table class="table table-hover"><thead>';
		echo '<th>Приоритет</th><th>'; echo  $txt->getStringForm('num_zh');
		echo '</th><th>'; echo  $txt->getStringForm('kr_spec');
		echo '</th><th>'; echo  $txt->getStringForm('akad_bak');
		echo '</th><th>'; echo  $txt->getStringForm('prik_bak');
		echo '</th><th>'; echo  $txt->getStringForm('fio');
		echo '</th><th>'; echo  $txt->getStringForm('for_ob');
		echo '</th><th>'; echo  $txt->getStringForm('pr_doc');
		echo '</th><th>'; echo  $txt->getStringForm('prot');
		echo '</th><th>'; echo  $txt->getStringForm('date_podachi');
		echo '</th><th>'; echo  $txt->getStringForm('kont');
		echo '</th><th>'; echo  $txt->getStringForm('lgt');
		echo '</th><th>'; echo  $txt->getStringForm('action');
		echo '</th></tr></thead><tbody>';
		
		$obj->config();
		$zhurn = "SELECT ZHURNAL.ID_zh, ZHURNAL.Otdelenie, ZHURNAL.Protokol, ZHURNAL.akad_bak, ZHURNAL.prik_bak, ZHURNAL.Date_podachi, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Special, ZHURNAL.Priznak_doc, ZHURNAL.Kontrakt, ZHURNAL.priority, ZHURNAL.lgot_vne, INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, FORMAOBUCH.leter FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.ID_zh = ".$id_zh;
		$res_zhurn = mysql_query($zhurn);
    /* show result */
		$row = mysql_fetch_array($res_zhurn, MYSQL_ASSOC);

			printf("<tr>");
			printf ("<td><input type='text' name='prior' value='".$row["priority"]."' class='input-mini'></td>");
			printf ("<td><input type='text' name='number' value='".$row["Nomer_po_zhurn"]."' class='input-mini'></td>");
			printf ("<td>".$row["KratkoeName"]."</td>");
			
			if ($row["akad_bak"] == 1) {$chek_akad = 'checked';} else {$chek_akad = '';}
			printf("<td><input type='checkbox' ".$chek_akad." name='akad_b' value='1'></td>");
			if ($row["prik_bak"] == 1) {$chek_prik = 'checked';} else {$chek_prik = '';}
			printf("<td><input type='checkbox' ".$chek_prik." name='prik_b' value='1'></td>");
			//printf ("<td>".$row["akad_bak"]."</td>");
			//printf ("<td>".$row["prik_bak"]."</td>");
			printf ("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			printf ("<td>".$row["leter"]."</td>");
			printf ("<td><select class='input-small' name='pr_doc'>"); 
			printf ($this->document($row["Priznak_doc"]));
			printf ("</select><font color='red'>Если меняете на оригинал, меняйте приоритет!!!</font></td>");
			printf ("<td>".$row["Protokol"]."</td>");
			printf ("<td>".$row["Date_podachi"]."</td>");
			printf ("<td><select class='input-mini' name='kontr'>"); 
			printf ($this->kontrakt($row["Kontrakt"]));
			printf ("</select></td>");
			printf ("<td><select class='input-mini' name='lgt'>"); 
			printf ($this->lgota($row["lgot_vne"]));
			printf ("</select></td>");
			printf ("<td><input type='submit' class='btn' value='");
			printf ($txt->getStringForm("save"));
			printf ("'></td>");
			printf("</tr>");

		mysql_free_result($res_zhurn);
		echo '</form></tbody></table>';


	return($id_zh);
	return($idstud);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  kontrakt

+++++++++++++++++++++++++++++++++++*/	
	function kontrakt_print()
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
	function otdelenie_print()
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

TABLE -  LGOTAVNEKONK

+++++++++++++++++++++++++++++++++++*/	
function lgota($selected)
	{

		$obr = "SELECT ID, LGOTAVNEKONK FROM LGOTAVNEKONK";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["LGOTAVNEKONK"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  KONTRAKT

+++++++++++++++++++++++++++++++++++*/	
function kontrakt($selected)
	{

		$obr = "SELECT ID, KONTRAKT FROM KONTRAKT";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["KONTRAKT"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  DOCUMENT

+++++++++++++++++++++++++++++++++++*/	
function document($selected)
	{

		$obr = "SELECT ID, PRIZNAKDOC FROM PRIZNAKDOC";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["PRIZNAKDOC"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  SPECIALNOST

+++++++++++++++++++++++++++++++++++*/	
function spec($selected)
	{

		$obr = "SELECT ID, KratkoeName FROM SPEC";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["KratkoeName"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  FORMAOBUCH

+++++++++++++++++++++++++++++++++++*/	
function leter($selected)
	{

		$obr = "SELECT ID, leter FROM FORMAOBUCH";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			if ($selected == $row["ID"]){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='".$row["ID"]."'>");
        	printf ($row["leter"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}

}
?>