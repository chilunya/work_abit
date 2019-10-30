<?php session_start();
include_once("get_string.php");
include_once("get_function.php");

class celevikDataAbitur{
	function enterAbiturForm(){
		$txt = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
			//$txt->getStringForm('chenge');
			echo '<div class="alert"><p>'; echo $txt->getStringForm("forma2"); echo '</p></div>';
			echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
			echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
			echo '" class="btn" action="index.php?pages=2&cl=3"></form>';
		}
			else {
				echo $txt->getStringForm('close');}
		}
	function enterLookAbitur($id, $sub){
		$txt = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		if (isset($id) and $id != ""){
		/////////////////filtr
			echo $txt->getStringForm('filtr').'<span class="text-info">'. $id . '</span> '; 
			//filtr dell filtr_del
			echo '<a href="index.php?pages=2&cl=3" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
			/////////////////filtr end
			$res_obr = $obj->choose_abitur_like_fam($id);
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
				printf("<td align='left'><a href='index.php?pages=2&cl=3&id=$row[ID]'>");
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
	
	function enterCelevikAbityr($id){
		$txt = new get_String_Form();
		$obj = new get_function();
		echo '<div class="alert"><p>'; echo $txt->getStringForm("forma3"); echo '</p></div>';
		$obj->config();
		// Формируем имя картинки	
		//$obr = "SELECT INFO.ID, INFO.fam, INFO.name, INFO.otch FROM INFO WHERE INFO.ID = ".$id;	
		//$res_obr = mysql_query($obr);
		//		while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		//	{
		//$nam=$row['fam']."_".$row['name']."_".$row['otch'];
		//	}
		// проверяем есть ли фото
		//$url = "photo/".$nam.".jpg";
		// пробуем открыть файл для чтения
		//if (@fopen($url, "r")) {
		//echo '<p><img src="photo/'; $obj->photoOfStud($id); echo '.jpg" class="img-polaroid"></p>';
		//} else {
			// если файл не найден показываем no name
		//echo '<p><img src="photo/no_name.jpg" class="img-polaroid"></p>'; 
		//}
		
		echo '<table width="100%"><tr><td><p>'; echo $txt->getStringForm('abit'); echo '<span class="text-info">'; $obj->nameOfStud($id); echo '</span></p></td>';
		echo '<td align="right"><p><a href="index.php?pages=2&cl=3">'; echo $txt->getStringForm('change_abit'); echo '</a></p></td></tr></table?';
	
		// form for apply info abiturient
		echo '<br><form method="POST" action="class/save_zhurnal.php?id='.$id.'">';
		echo '<table class="table table-striped"><tr>';
		echo '<td width="50%"><input type="text" disabled name="nomer_po_zhurn" placeholder="'; echo $txt->getStringForm('nomer_po_zhurn'); echo '"></td>';
		echo '<td><input type="text" required name="protokol" placeholder="'; echo $txt->getStringForm('protokol'); echo '" value="'; $obj->protokol(); echo '"></td></tr>';
		echo '<tr><td><input type="text" required id="datepicker_pod" name="date_podachi" value="'.date("Y.m.d").'" placeholder="'; echo $txt->getStringForm('date_podachi'); echo '"></td>';
		echo '<td><select required name="priznak_doc"><option value="">'; echo $txt->getStringForm('priznak'); echo '</option>'; $obj->priznak(); echo '</select></td></tr>';
		echo '<tr><td><select required name="spec"><option value="">'; echo $txt->getStringForm('namespec'); echo '</option>'; $obj->spec(); echo '</select></td>';
		echo '<td><select required name="otdelenie"><option value="">'; echo $txt->getStringForm('otdelenie'); echo '</option>'; $obj->otdelenie(); echo '</select></td></tr>';
		echo '<tr><td><select name="kontrakt"><option value="1">'; echo $txt->getStringForm('kontrakt'); echo '</option>'; $obj->kontrakt(); echo '</select>
		<input type="text" name="nom_dogovor" placeholder="'; echo $txt->getStringForm('nom_dogovor'); echo '"></td>';
		echo '<td><input type="text" id="datepicker_dog" name="date_dogovora" placeholder="'; echo $txt->getStringForm('date_dogovora'); echo '"></td></tr>';
		echo '<tr><td><select name="lgot_konk"><option value="1">'; echo $txt->getStringForm('lgot_konk'); echo '</option>'; $obj->lgot_konk(); echo '</select></td>';
		echo '<td><select name="lgot_vne"><option value="1">'; echo $txt->getStringForm('lgot_vne'); echo '</option>'; $obj->lgot_vne(); echo '</select></td></tr>';
		echo '<tr><td><select name="ekzam"><option value="1">'; echo $txt->getStringForm('ekzam'); echo '</option>'; $obj->ekzam(); echo '</select></td>';
		echo '<td><select name="dat_sob"><option value="">'; echo $txt->getStringForm('dat_sob'); echo '</option>'; $obj->dat_sob(); echo '</select>';
		echo '</td></tr>';
	
		echo '</table>';
		echo '<label class="checkbox"><input required type="checkbox" value="5" name="check_agry_zhurn">'; echo $txt->getStringForm('agry_zhurn'); echo '</label>';
		echo '<p align="left"><input class="btn btn-large btn-primary" action="class/save_zhurnal.php?id='.$id.'" type="submit" value="'; echo $txt->getStringForm('save'); echo '"></p>';
		echo '</form>';
		mysql_close($dbcnx);
		
	}
}
?>