<?php
include_once("get_string.php");
include_once("get_function.php");
class marksForAbitur{
	function marksForAnketa(){
		$txt = new get_String_Form();	

		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
	echo '<div class="alert"><p>'; echo $txt->getStringForm("forma5"); echo '</p></div>';

	echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
	echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
	echo '" class="btn" action="index.php?pages=4&cl=5"></form>';
		}
	else {
				echo $txt->getStringForm('close');}
}
	function checkAbitur($id, $sub){
//include_once("get_string.php");
$txt = new get_String_Form();
$obj = new get_function();

if (isset($id) and $id != ""){
/////////////////filtr
echo $txt->getStringForm('filtr').'<span class="text-info">'. $id . '</span> '; 
//filtr dell filtr_del
echo '<a href="index.php?pages=4&cl=5" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
/////////////////filtr end
		$obj->config();
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
			printf("<td align='left'><a href='index.php?pages=4&cl=5&id=$row[ID]'>");
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
	
function lookInfoAbityr($idstud){
	$txt = new get_String_Form();
	$obj = new get_function();
	
	$obj->config();
	$sql = "SELECT distinct INFO.fam, INFO.otch, INFO.name, ZHURNAL.IDstud, INFO.pred_mesto1, INFO.bal1, INFO.pred_mesto2, 
	INFO.bal2, INFO.pred_mesto3, INFO.bal3, INFO.pred_mesto4, INFO.bal4, INFO.pred_mesto5, INFO.bal5, INFO.kompdiz, INFO.komparh, 
	INFO.risunok, INFO.grafdiz, INFO.grafarh, INFO.sochin, INFO.individ, INFO.date_risunok, INFO.date_grafdiz, INFO.date_grafarh,
	INFO.date_kompdiz, INFO.date_komparh, INFO.date_bal5, INFO.date_bal4, INFO.date_bal3, INFO.date_bal2, INFO.date_bal1 
	FROM ZHURNAL INNER JOIN INFO ON ZHURNAL.IDstud = INFO.ID WHERE ZHURNAL.IDstud = '". $idstud ."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	if ($row=="") {
		echo '<span class="label label-important"><h5>';
		echo $txt->getStringForm('no_name');
		echo '</h5></span>';
	}
	else {
		
	echo '<div class="alert alert-info"><h5> '.$row['fam'].' '.$row['name'].' '.$row['otch'].' </h5></div>';
	echo '<form method="post" action="class/save/save_marks.php?id='.$idstud.'">';
	echo '<table class="table" align="center" width="50%"><thead><tr><th>';
	echo $txt->getStringForm('mark'); echo '</th><th>';	
	echo $txt->getStringForm('mesto'); echo '</th><th>';	
	echo $txt->getStringForm('date_sobes'); echo '</th><th>';
	echo $txt->getStringForm('ball'); echo '</th></tr></thead><tbody>';
	echo '<tr><td><p>Русский язык</p></td><td><select name="mesto1"><option value="0">-Тип экзамена-</option>';
	$obj->mesto($row['pred_mesto1']); echo '</select></td>';

	echo '<td><select name="dat_ekz1"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_bal1']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="mark1" value="';
	echo $row['bal1'].'"></td></tr>';
	echo '<tr><td><p>Математика</p></td><td><select name="mesto2"><option value="0">-Тип экзамена-</option>';
	$obj->mesto($row['pred_mesto2']); echo '</select></td>';

	echo '<td><select name="dat_ekz2"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_bal2']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="mark2" value="';
	echo $row['bal2'].'"></td></tr>';
	echo '<tr><td><p>Физика</p></td><td><select name="mesto3"><option value="0">-Тип экзамена-</option>';
	$obj->mesto($row['pred_mesto3']); echo '</select></td>';

	echo '<td><select name="dat_ekz3"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_bal3']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="mark3" value="';
	echo $row['bal3'].'"></td></tr>';
	echo '<tr><td><p>Обществознание</p></td><td><select name="mesto4"><option value="0">-Тип экзамена-</option>';
	$obj->mesto($row['pred_mesto4']); echo '</select></td>';

	echo '<td><select name="dat_ekz4"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_bal4']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="mark4" value="';
	echo $row['bal4'].'"></td></tr>';
	echo '<tr><td><p>Литература</p></td><td><select name="mesto5"><option value="0">-Тип экзамена-</option>';
	$obj->mesto($row['pred_mesto5']); echo '</select></td>';

	echo '<td><select name="dat_ekz5"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_bal5']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="mark5" value="';
	echo $row['bal5'].'"></td></tr>';
	
	echo '<tr><td><p>Композиция в дизайне</p></td></td><td>&nbsp;</td>';

	echo '<td><select name="dat_ekz6"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_kompdiz']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="kompdiz" value="';
	echo $row['kompdiz'].'"></td></tr>';
	echo '<tr><td><p>Композиция в архитектуре</p></td></td><td>&nbsp;</td>';

	echo '<td><select name="dat_ekz7"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_komparh']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="komparh" value="';
	echo $row['komparh'].'"></td></tr>';
	echo '<tr><td><p>Графика в дизайне</p></td></td><td>&nbsp;</td>';

	echo '<td><select name="dat_ekz8"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_grafdiz']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="grafdiz" value="';
	echo $row['grafdiz'].'"></td></tr>';
	echo '<tr><td><p>Графика в архитектуре</p></td></td><td>&nbsp;</td>';

	echo '<td><select name="dat_ekz9"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_grafarh']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="grafarh" value="';
	echo $row['grafarh'].'"></td></tr>';
	echo '<tr><td><p>Рисунок</p></td></td><td>&nbsp;</td>';

	echo '<td><select name="dat_ekz10"><option value="0">- Дата -</option>';
	$obj->dat_ekzam($row['date_risunok']); echo '</select></td>';

	echo '<td><input type="number" min="0" max="100" name="risunok" value="';
	echo $row['risunok'].'"></td></tr>';
	
	echo '<tr><td><p>За сочинение</p></td></td><td>&nbsp;</td><td>&nbsp;</td><td><input type="number" min="0" max="10" name="sochin" value="';
	echo $row['sochin'].'"></td></tr>';
	echo '<tr><td><p>Индивидуальные достижения</p></td></td><td>&nbsp;</td><td>&nbsp;</td><td><input type="number" min="0" max="30" name="individ" value="';
	echo $row['individ'].'"></td></tr>';
	echo '</tbody></table>';
	echo '<label class="checkbox"><input required type="checkbox" value="5" name="check_agry_change">'; echo $txt->getStringForm('agry_change'); echo '</label>';
	echo '<p align="left"><input class="btn btn-large btn-primary" action="class/save/save_marks.php?id='.$idstud.'" type="submit" value="'; echo $txt->getStringForm('save'); echo '"></p>';
	echo '</form>';	

	}
	mysql_free_result($result);
	
	return($idstud);
	}

}
?>