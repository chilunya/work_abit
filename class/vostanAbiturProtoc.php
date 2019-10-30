<?php
include_once("get_string.php");
include_once("get_function.php");

class vostanAbiturProtoc{
	function printAbiturForm(){
	$txt = new get_String_Form();	
$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
	echo '<div class="alert"><p>'; echo $txt->getStringForm("forma7"); echo '</p></div>';
	echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
	echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
	echo '" class="btn" action="index.php?pages=12&cl=13"></form>';
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
echo '<a href="index.php?pages=12&cl=13" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
/////////////////filtr end
		$obj = new get_function();
		$obj->config();
		$obr = "SELECT DISTINCT ZHURNAL_VOSTANOVLENIE.ID_vos, ZHURNAL_VOSTANOVLENIE.abit FROM ZHURNAL_VOSTANOVLENIE WHERE ZHURNAL_VOSTANOVLENIE.abit LIKE '". $id ."%' ORDER BY ZHURNAL_VOSTANOVLENIE.abit";	
		$res_obr = mysql_query($obr);
		$number = 1;
   // head of table
		echo '<table class="table table-hover"><thead>';
		echo '<tr><th>'; echo $txt->getStringForm('nn');
		echo '</th><th>'; echo  $txt->getStringForm('fio_abit');
		echo '</th><th>'; echo  $txt->getStringForm('action');
		echo '</th></tr></thead>';
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{
			printf("<tbody><tr>");
			printf("<td>");
        	printf ($number);
			printf("</td>");
			printf("<td align='left'>");
        	printf ($row["abit"]);
			printf("</td>");
			printf("<td align='left'><a href='index.php?pages=12&cl=13&id=$row[ID_vos]'>");
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
		echo '</th><th>'; echo  $txt->getStringForm('nomer_po_zhurn');
		echo '</th><th>'; echo  $txt->getStringForm('kr_spec');
		echo '</th><th>'; echo  $txt->getStringForm('for_ob');
		echo '</th><th>'; echo  $txt->getStringForm('fio');
		echo '</th><th>'; echo  $txt->getStringForm('kurs');
		echo '</th><th>'; echo  $txt->getStringForm('kont');
		echo '</th></tr></thead><tbody>';
		$this->zaprosZhurnalAbitur($idstud);
		echo '</tbody></table>';
		echo '<p align="left"><a href="excel_vostanovl.php?id='.$idstud.'" target="_blank">'; echo  $txt->getStringForm('print_protocol');
		echo '</a></p>';
	mysql_close($dbcnx);
	return($idstud);
		}

function zaprosZhurnalAbitur($idstud)
	{
		$obj = new get_function();
		$obj->config();
		$zhurn = "SELECT SPEC_VOSTAN.ID_spec, SPEC_VOSTAN.krat_spec, ZHURNAL_VOSTANOVLENIE.num_po_zhurn, ZHURNAL_VOSTANOVLENIE.kurs, ZHURNAL_VOSTANOVLENIE.ID_vos, KONTRAKT.KONTRAKT, ZHURNAL_VOSTANOVLENIE.abit, FORMAOBUCH.leter FROM ZHURNAL_VOSTANOVLENIE INNER JOIN SPEC_VOSTAN ON SPEC_VOSTAN.ID = ZHURNAL_VOSTANOVLENIE.spec INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL_VOSTANOVLENIE.otdelenie INNER JOIN KONTRAKT ON KONTRAKT.ID = ZHURNAL_VOSTANOVLENIE.kontrakt WHERE ZHURNAL_VOSTANOVLENIE.ID_vos = ".$idstud." ORDER BY ZHURNAL_VOSTANOVLENIE.ID_vos";
		
		$res_zhurn = mysql_query($zhurn);
    /* show result */
	  	while ($row = mysql_fetch_array($res_zhurn, MYSQL_ASSOC)) 
		{
			printf("<tr>");
			printf ("<td>".$row["num_po_zhurn"]."</td>");
			printf ("<td>".$row["krat_spec"]."</td>");
			printf ("<td>".$row["leter"]."</td>");
			printf ("<td>".$row["abit"]."</td>");
			printf ("<td>".$row["kurs"]."</td>");
			printf ("<td>".$row["KONTRAKT"]."</td>");
			printf ("<td><a href='index.php?pages=12&cl=13&id=".$idstud."&dell=dell&zh=".$row["ID_vos"]."'><img src='css/img/delete.png'></a></td>");
			printf("</tr>");
		}
		mysql_free_result($res_zhurn);
	return($idstud);
}
function printDellAbitur($id_zh)
	{
		$obj = new get_function();
		$obj->config();
		$zhurn = "DELETE FROM ZHURNAL_VOSTANOVLENIE WHERE ID_vos = ".$id_zh;
		
		$res_zhurn = mysql_query($zhurn);
    /* show result */
		mysql_free_result($res_zhurn);
		return($id_zh);
	}


}
?>