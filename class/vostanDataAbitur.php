<?php session_start();
include_once("get_string.php");
class vostanDataAbitur{
	function vostanAbiturForm(){
		$txt = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
	//$txt->getStringForm('chenge');
	echo '<div class="alert"><p>'; echo $txt->getStringForm("forma6"); echo '</p></div>';
	echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
	echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
	echo '" class="btn" action="index.php?pages=11&cl=12"></form>';
}
			else {
				echo $txt->getStringForm('close');}
}
	function applyLookAbitur($id, $sub){
//include_once("get_string.php");
$txt = new get_String_Form();

if (isset($id) and $id != ""){
/////////////////filtr
echo $txt->getStringForm('filtr').'<span class="text-info">'. $id . '</span> '; 
//filtr dell filtr_del
echo '<a href="index.php?pages=11&cl=12" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
/////////////////filtr end
		$this->config();
		$obr = "SELECT INFO.ID, INFO.fam, INFO.name, INFO.otch, INFO.data_rozhd FROM INFO WHERE INFO.fam LIKE '". $id ."%' ORDER BY INFO.fam";	
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
			printf("<td align='left'><a href='index.php?pages=11&cl=12&id=$row[ID]'>");
			printf ($txt->getStringForm('add_info'));
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
	
function applyInfoAbityr(){
	$txt = new get_String_Form();
	
	$this->config();
	echo '<div class="alert"><p>'; echo $txt->getStringForm("forma3"); echo '</p></div>';
	//echo '<table width="100%"><tr><td><p>Абитуриент - <span class="text-info">'; $this->nameOfStud($id); echo '</span></p></td>';
	//echo '<td align="right"><p><a href="index.php?pages=11&cl=12">'; echo $txt->getStringForm('change_abit'); echo '</a></p></td></tr></table?';

	// form for apply info abiturient
	echo '<br><form method="POST" action="class/save/save_vostan.php?id='.$id.'">';
	echo '<table class="table table-striped"><tr>';
	echo '<td width="50%"><input type="text" name="fio_abit" placeholder="ФИО Абитуриента"></td>';
	echo '<td><textarea name="obrazov" placeholder="Предыдущее полное образование"></textarea><br><textarea name="obraz_nepoln" placeholder="Предыдущее неполное образование"></textarea></td></tr>';
	
	
	echo '<tr><td width="50%"><input type="text" class="input-small" disabled name="nomer_po_zhurn" placeholder="'; echo $txt->getStringForm('nomer_po_zhurn'); echo '">
	<input type="text" required name="protokol" class="input-small" placeholder="'; echo $txt->getStringForm('protokol'); echo '" value="'; $this->protokol(); echo '"></td>';
	echo '<td><input type="text" required id="datepicker_pod" name="date_podachi" value="'.date("Y.m.d").'" placeholder="'; echo $txt->getStringForm('date_podachi'); echo '"></td>';

	echo '<tr><td>';
	
	if ($_GET['error'] == 'error') {
		echo '<p align="left" style="color:red;">Выбранно неправильное направление или курс!</p>';
		}
	
	echo '<select required name="spec"><option value="">'; echo $txt->getStringForm('namespec'); echo '</option>'; $this->spec(); echo '</select></td>';
	echo '<td><select required name="otdelenie"><option value="">'; echo $txt->getStringForm('otdelenie'); echo '</option>'; $this->otdelenie(); echo '</select></td></tr>';
	
	echo '<tr><td><select required name="kontrakt"><option value="">'; echo $txt->getStringForm('kontrakt'); echo '</option>'; $this->kontrakt(); echo '</select></td>';
	echo '<td><input required type="text" name="kurs" placeholder="'; echo $txt->getStringForm('kurs'); echo '"></td>';
	
	echo '<tr><td><select required name="pred1"><option value="">'; echo $txt->getStringForm('pred1'); echo '</option>'; $this->pred1(); echo '</select></td>';
	echo '<td><select required name="pred2"><option value="">'; echo $txt->getStringForm('pred2'); echo '</option>'; $this->pred2(); echo '</select></td></tr>';
	
	
	echo '</table>';
	echo '<label class="checkbox"><input required type="checkbox" value="5" name="check_agry_zhurn">'; echo $txt->getStringForm('agry_zhurn'); echo '</label>';
	echo '<p align="left"><input class="btn btn-large btn-primary" type="submit" value="'; echo $txt->getStringForm('save'); echo '"></p>';
	echo '</form>';
	mysql_close($dbcnx);
	
	}
function nameOfStud($idstud)
	{
		
		$obr = "SELECT ID, fam, name, otch FROM INFO WHERE ID=".$idstud."";	
		$res_obr = mysql_query($obr);
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
        	printf ($row["fam"]." ".$row["name"]." ".$row["otch"]);
		mysql_free_result($res_obr);
		
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  protokol

+++++++++++++++++++++++++++++++++++*/	
	function protokol()
	{	
		$dat_tuday = date("Y-m-d");
		$obr = "SELECT PROTOKOL.Nom_prot, PROTOKOL.Data1, PROTOKOL.Data2 FROM PROTOKOL WHERE PROTOKOL.Data1 <= '".$dat_tuday."' AND PROTOKOL.Data2 >= '".$dat_tuday."'";	
		$res_obr = mysql_query($obr);
    /* show result */
		$row = mysql_fetch_array($res_obr, MYSQL_ASSOC); 
        	echo $row["Nom_prot"];
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  pred1

+++++++++++++++++++++++++++++++++++*/	
	function pred1()
	{
		$obr = "SELECT ID, Predmet FROM PREDM_VOSTAN ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["Predmet"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  Pred2

+++++++++++++++++++++++++++++++++++*/	
	function pred2()
	{
		$obr = "SELECT ID, Predmet FROM PREDM_VOSTAN ORDER BY ID";	
		$res_obr = mysql_query($obr);
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='".$row["ID"]."'>");
        	printf ($row["Predmet"]);
			printf("</option>");
		}
		mysql_free_result($res_obr);
	}
/*++++++++++++++++++++++++++++++++++

TABLE -  kontrakt

+++++++++++++++++++++++++++++++++++*/	
	function kontrakt()
	{
		$obr = "SELECT KONTRAKT FROM KONTRAKT";	
		$res_obr = mysql_query($obr);
		$number = 1;
    /* show result */
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<option value='$number'>");
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
		$obr = "SELECT ID, ID_spec, spec FROM SPEC_VOSTAN ORDER BY spec";	
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