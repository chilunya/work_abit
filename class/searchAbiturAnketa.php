<?php
include_once("get_string.php");
include_once("get_function.php");
class searchAbiturAnketa{
	function printAbiturForm(){
	$txt = new get_String_Form();	
	echo '<div class="alert"><p>'; echo $txt->getStringForm("forma8"); echo '</p></div>';
	echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
	echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
	echo '" class="btn" action="index.php?pages=14&cl=15"></form>';
	}

	function printInfoAbityr($id, $sub){
//include_once("get_string.php");
$txt = new get_String_Form();

if (isset($id) and $id != ""){
/////////////////filtr
echo $txt->getStringForm('filtr').'<span class="text-info">'. $id . '</span> '; 
//filtr dell filtr_del
echo '<a href="index.php?pages=14&cl=15" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
/////////////////filtr end
		$obj = new get_function();
		$obj->config();
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
			printf("<td align='left'><a href='index.php?pages=14&cl=15&id=$row[IDstud]'>");
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
	

	
		echo '<table class="table table-hover"><thead>';
		echo '</th><th>'; echo  $txt->getStringForm('num_zh');
		echo '</th><th>'; echo  $txt->getStringForm('kr_spec');
		echo '</th><th>'; echo  $txt->getStringForm('fio');
		echo '</th><th>'; echo  $txt->getStringForm('for_ob');
		echo '</th><th>'; echo  $txt->getStringForm('pr_doc');
		echo '</th><th>'; echo  $txt->getStringForm('prot');
		echo '</th><th>'; echo  $txt->getStringForm('dat_pod');
		echo '</th><th>'; echo  $txt->getStringForm('kont');
		echo '</th><th>'; echo  $txt->getStringForm('lgt');
		echo '</th></tr></thead><tbody>';
		$this->zaprosZhurnalAbitur($idstud);
		echo '</tbody></table>';
		echo '<p align="left"><a href="index.php?pages=14&cl=15">'; echo  $txt->getStringForm('back_search');
		echo '</a></p>';
	mysql_close($dbcnx);
	return($idstud);
		}

function zaprosZhurnalAbitur($idstud)
	{
		$obj = new get_function();
		$obj->config();
		$zhurn = "SELECT ZHURNAL.IDstud, SPEC.KodSpec, ZHURNAL.Nomer_po_zhurn, INFO.fam, INFO.name, INFO.otch, FORMAOBUCH.leter, SPEC.KratkoeName, PRIZNAKDOC.PRIZNAKDOC, ZHURNAL.Protokol, ZHURNAL.Date_podachi, KONTRAKT.KONTRAKT, ZHURNAL.ID_zh, LGOTAVNEKONK.LGOTAVNEKONK FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL.Kontrakt INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne WHERE ZHURNAL.IDstud = ".$idstud." AND ZHURNAL.priznak_vozvrata is null ORDER BY ZHURNAL.ID_zh";
		
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
			printf ("<td>".$row["LGOTAVNEKONK"]."</td>");
			printf("</tr>");
		}
		mysql_free_result($res_zhurn);
	return($idstud);
}

function printEditAbitur($id_zh, $idstud) 
{
	$txt = new get_String_Form();
		echo '<form method="POST" action="class/save_zh_of_abit.php?idzh='.$id_zh.'&id='.$idstud.'"><table class="table table-hover"><thead>';
		echo '</th><th>'; echo  $txt->getStringForm('num_zh');
		echo '</th><th>'; echo  $txt->getStringForm('kr_spec');
		echo '</th><th>'; echo  $txt->getStringForm('fio');
		echo '</th><th>'; echo  $txt->getStringForm('for_ob');
		echo '</th><th>'; echo  $txt->getStringForm('pr_doc');
		echo '</th><th>'; echo  $txt->getStringForm('prot');
		echo '</th><th>'; echo  $txt->getStringForm('dat_pod');
		echo '</th><th>'; echo  $txt->getStringForm('kont');
		echo '</th><th>'; echo  $txt->getStringForm('lgt');
		echo '</th><th>'; echo  $txt->getStringForm('action');
		echo '</th></tr></thead><tbody>';
		
		$obj = new get_function();
		$obj->config();
		$zhurn = "SELECT ZHURNAL.ID_zh, ZHURNAL.Otdelenie, ZHURNAL.Protokol, ZHURNAL.Date_podachi, ZHURNAL.Nomer_po_zhurn, ZHURNAL.Special, ZHURNAL.Priznak_doc, ZHURNAL.Kontrakt, ZHURNAL.lgot_vne, INFO.fam, INFO.name, INFO.otch, SPEC.KratkoeName, FORMAOBUCH.leter FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.ID_zh = ".$id_zh;
		$res_zhurn = mysql_query($zhurn);
    /* show result */
		$row = mysql_fetch_array($res_zhurn, MYSQL_ASSOC);

			printf("<tr>");
			printf ("<td>".$row["Nomer_po_zhurn"]."</td>");
			printf ("<td>".$row["KratkoeName"]."</td>");
			printf ("<td>".$row["fam"]." ".$row["name"]." ".$row["otch"]."</td>");
			printf ("<td>".$row["leter"]."</td>");
			printf ("<td><select class='input-small' name='pr_doc'>"); 
			printf ($this->document($row["Priznak_doc"]));
			printf ("</select></td>");
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
			if ($selected == $number){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='$number'>");
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
			if ($selected == $number){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='$number'>");
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
			if ($selected == $number){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='$number'>");
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
			if ($selected == $number){
				$check  = "selected";
			}
			else {
				$check = "";
			}
			printf("<option $check value='$number'>");
        	printf ($row["leter"]);
			printf("</option>");
			$number ++;
		}
		mysql_free_result($res_obr);
	}

}
?>