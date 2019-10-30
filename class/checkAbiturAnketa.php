<?php session_start();
include_once("get_string.php");
include_once("get_function.php");

class checkAbiturAnketa{

	function checkAbiturForm(){
		$txt = new get_String_Form();
		$obj = new get_function();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
			//echo $ip;
			$a=explode(".",$ip);
			$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
			if (($intip < 3232301055 and $intip > 3232235520)){
				echo '<div class="alert"><p>'; echo $txt->getStringForm("forma"); echo '</p></div>';
				echo '<form method="post" class="form-inline"><input type="text" name="search" placeholder="'; echo $txt->getStringForm('lastname'); 
				echo '"><input type="submit" name="sub" value="'; echo $txt->getStringForm('apply'); 
				echo '" class="btn" action="index.php?pages=1&cl=2"></form>';
			}
		else {
				echo $txt->getStringForm('close');}
		}
	
	function checkAbitur($id, $sub){
		$txt = new get_String_Form();
		$obj = new get_function();
		$obj->config();
		if (isset($id) and $id != ""){
		/////////////////filtr
		echo $txt->getStringForm('filtr').'<span class="text-info">'. $id . '</span> '; 
		//filtr dell filtr_del
		echo '<a href="index.php?pages=1&cl=2" txt="'; echo $txt->getStringForm('filtr_del'); echo '"><img src="css/img/delete.png"></a>';
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
				printf("<td align='left'><a href='index.php?pages=1&cl=2&id=$row[ID]'>");
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
		$row = $obj->look_selfdata_choosed_abitur($idstud);
		
		echo '<div class="alert"><p>'; echo $txt->getStringForm("forma1"); echo '</p></div>';
			 
		// Формируем имя картинки	
		//$nam=$row["fam"]."_".$row["name"]."_".$row["otch"];
		// проверяем есть ли фото
		//$url = "photo/".$nam.".jpg";
		// пробуем открыть файл для чтения
		//if (@fopen($url, "r")) {
		//	echo '<p><img src="photo/'.$nam.'.jpg" class="img-polaroid"></p>';
		//	} else {
		//		// если файл не найден показываем no name
		//	echo '<p><img src="photo/no_name.jpg" class="img-polaroid"></p>'; 
		//	}
		if ($row["to_edit"] == 1){
			if ($_SESSION['levl'] < 3){
				$block = "";
				}
			else {$block = "disabled";}
			}
		
		echo '<table border="0" width=100%  class="table table-striped">';
		echo '<form method="POST" action="class/save_change.php?id='.$idstud.'" enctype="multipart/form-data">';
		//============================= SELF DATA =========================
		echo '<tr valign="top"><td colspan="2"><h4>'; echo $txt->getStringForm('self_data'); echo '</h4></td>';
		echo '<tr>';
		echo '<td><input type="text" '.$block.' value="'; echo $row["fam"]; echo '" name="fam"></td>';
		echo '<td><nobr><input type="text" '.$block.' value="'; echo $row["pasport_ser"]; echo '" name="pasport_ser" title="'; echo $txt->getStringForm('pasport_ser'); echo '">&nbsp;<input type="text" '.$block.' value="'; echo $row["pasport_nom"]; echo '" name="pasport_nom" title="'; echo $txt->getStringForm('pasport_num'); echo '"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="text" '.$block.' value="'; echo $row["name"]; echo '" name="name"></td>';
		echo '<td><nobr><input type="text" '.$block.' title="'; echo $txt->getStringForm('who_pasport'); echo '" value="'; echo $row["pasport_kemvidan"]; echo '" name="pasport_kemvidan">&nbsp;<input type="text" '.$block.' title="'; echo $txt->getStringForm('date_pasport'); echo '" id="datepicker_pas" value="'; echo $row["pasport_data"]; echo '" name="pasport_data"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="text" '.$block.' value="'; echo $row["otch"]; echo '" name="otch"></td>';
		echo '<td><nobr><input type="text" '.$block.' id="datepicker_birth" title="'; echo $txt->getStringForm('date_birth'); echo '" value="'; echo $row["data_rozhd"]; echo '" name="data_rozhd">&nbsp;<input type="text" '.$block.' value="'; echo $row["birth_place"]; echo '" name="birth_place" title="'; echo $txt->getStringForm('place_birth'); echo '"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><select name="pol" '.$block.'>'; $obj->selected_pol($row["pol"]); echo '</select></td>';
		echo '<td><input type="number" '.$block.' value="'; echo $row["telefon"]; echo '" name="telefon">&nbsp;<input type="text" '.$block.' title="'; echo $txt->getStringForm('mail'); echo '" name="mail" value="'; echo $row["mail"]; echo '"></td>';
		echo '</tr>';

		//============================= ADRESS =========================

		echo '<tr valign="top"><td colspan="2"><h4>'; echo $txt->getStringForm('adress'); echo '</h4></td>';
		echo '</tr>';
		echo '<tr>';
		if ($row["inostran"] == 3){$check="checked";} else {$check="";}
		echo '<td><select name="gosudarstvo">'; $obj->selected_country($row["gosudarstvo"]); echo '</select>&nbsp;<input type="checkbox" value="3" '.$check.' name="inostran">&nbsp;<sub>'; echo $txt->getStringForm('inostran'); echo '</sub>';
		echo '<td><nobr><select name="type_str">'; $obj->selected_prospect($row["type_str"]); echo '</select>&nbsp;
		<input type="text" title="'; echo $txt->getStringForm('name_titl'); echo '" name="ulica" value="'; echo $row["ulica"]; echo '"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><input name="type_sity" list="sublist" value="'; echo $row["type_sity"]; echo '" type="text" title="'; echo $txt->getStringForm('subject'); echo '"><datalist id="sublist" >'; $obj->subject(); echo' </datalist>&nbsp;<input name="name_sity" value="'; echo $row["name_sity"]; echo '" list="arealist" type="text" title="'; echo $txt->getStringForm('name_area'); echo '"><datalist id="arealist" >'; $obj->rus_penz_area(); echo' </datalist></nobr></td>';
		
		echo '<td><nobr><input type="text" title="'; echo $txt->getStringForm('dom'); echo '" name="dom" value="'; echo $row["dom"]; echo '">
		<input type="text" title="'; echo $txt->getStringForm('kvartira'); echo '" name="kvart" value="'; echo $row["kvart"]; echo '"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><select name="selo">'; $obj->selected_poselok($row["selo"]); echo '</select>&nbsp;<input type="text" title="'; echo $txt->getStringForm('rayon_center'); echo '" name="rayon_centr" value="'; echo $row["rayon_centr"]; echo '" list="centrlist"><datalist id="centrlist">'; $obj->rus_penz_area_center(); echo' </datalist></nobr></td>';
		echo '<td>&nbsp;</td></tr>';
		
		//============================= EDUCATION DATA =========================
		echo '<tr valign="top">';
		echo '<td colspan="2"><h4>'; echo $txt->getStringForm('education_data'); echo '</h4></td></tr>';
		echo '<td><input type="number" step="1"  title="'; echo $txt->getStringForm('year_end'); echo '" name="god_okonch" value="'; echo $row["god_okonch"]; echo '">&nbsp;</td>';
		echo '<td><select name="document">'; $obj->selected_document($row["document"]); echo '</select></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><select name="uch_zavedenie">'; $obj->selected_uchzavedenie($row["uch_zavedenie"]); echo '</select>&nbsp;<input type="number" title="'; echo $txt->getStringForm('number_shool'); echo '" name="nom_uch_zaved" value="'; echo $row["nom_uch_zaved"]; echo '"></td>';
		echo '<td><input type="text" title="'; echo $txt->getStringForm('serial'); echo '" name="doc_ser" value="'; echo $row["doc_ser"]; echo '">
		<input type="text" title="'; echo $txt->getStringForm('number'); echo '" name="doc_nom" value="'; echo $row["doc_nom"]; echo '"></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="text" title="'; echo $txt->getStringForm('name_titl'); echo '" class="input-xlarge" name="nazvanie" value="'; echo $row["nazvanie"]; echo '"></td>';
		echo '<td><input type="text" id="datepicker_doc" title="'; echo $txt->getStringForm('date_dipl'); echo '" name="doc_data" value="'; echo $row["doc_data"]; echo '"></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><select name="doc_type_sity">'; $obj->selected_typeofobjects($row["doc_type_sity"]); echo '</select>
		<input type="text" title="'; echo $txt->getStringForm('name_titl'); echo '" name="doc_name_sity" value="'; echo $row["doc_name_sity"]; echo '"></nobr></td>';
		echo '<td><select name="medal">'; $obj->selected_medal($row["medal"]); echo '</select>
		<select name="inostr_yaz">'; $obj->selected_language($row["inostr_yaz"]); echo '</select></td>';
		echo '</tr>';
		//============================= EGE DATA =======================

		echo '<tr valign="top"><td colspan="2"><h4>'; echo $txt->getStringForm('ege_data'); echo '</h4></td></tr>';
		echo '<tr>';
		echo '<td><input type="text" title="'; echo $txt->getStringForm('serial_num'); echo '" name="ege_ser" value="'; echo $row["ege_ser"]; echo '"></td>';
		echo '<td><input type="text" title="'; echo $txt->getStringForm('registr_num'); echo '" name="ege_reg" value="'; echo $row["ege_reg"]; echo '"></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><input type="text" disabled value="'; echo $txt->getStringForm('rusyaz'); echo '">&nbsp;<input type="number" min="0" max="100" title="'; echo $txt->getStringForm('bal_ege'); echo '" class="input-small" disabled name="bal1" value="'; echo $row["bal1"]; echo '"></nobr></td>';
		echo '<td><nobr><input type="text" disabled value="'; echo $txt->getStringForm('math'); echo '">&nbsp;<input type="number" min="0" max="100" title="'; echo $txt->getStringForm('bal_ege'); echo '" class="input-small" disabled name="bal2" value="'; echo $row["bal2"]; echo '"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><input type="text" disabled value="'; echo $txt->getStringForm('fiz'); echo '">&nbsp;<input type="number" min="0" max="100" title="'; echo $txt->getStringForm('bal_ege'); echo '" class="input-small" disabled name="bal3" value="'; echo $row["bal3"]; echo '"></nobr></td>';
		echo '<td><nobr><input type="text" disabled value="'; echo $txt->getStringForm('litra'); echo '">&nbsp;<input type="number" min="0" max="100" title="'; echo $txt->getStringForm('bal_ege'); echo '" class="input-small" disabled name="bal5" value="'; echo $row["bal5"]; echo '"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><input type="text" disabled value="'; echo $txt->getStringForm('obw'); echo '">&nbsp;<input type="number" min="0" max="100" title="'; echo $txt->getStringForm('bal_ege'); echo '" class="input-small" disabled name="bal4" value="'; echo $row["bal4"]; echo '"></nobr></td>';
		echo '<td>&nbsp;</td></tr>';
		//============================= ANOTHER DATA =======================
		echo '<tr valign="top"><td colspan="2"><h4>'; echo $txt->getStringForm('dopoln'); echo '</h4></td></tr>';
		echo '<td><select name="obwezhit">'; $obj->selected_obwezhitie($row["obwezhit"]); echo '</select></td>';
		echo '<td><input type="text" name="vozvrat" value='; echo $row["vozvrat"]; echo '></td>';
		echo '</tr>';
		echo '</table>';
	
		//echo '<p align="left"><input type="hidden" name="MAX_FILE_SIZE" value="30000" />';
		//echo $txt->getStringForm('photo'); echo '<input name="userfile" type="file"/>'; echo $txt->getStringForm('size'); echo '</p>';
		
		echo '<label class="checkbox"><input required type="checkbox" value="5" name="check_agry_change">'; echo $txt->getStringForm('agry_change'); echo '</label>';
		echo '<p align="left"><input class="btn btn-large btn-primary" action="class/save_change.php?id='.$idstud.'" type="submit" value="'; echo $txt->getStringForm('save'); echo '"></p>';
		echo '</form>';	

		}
	
}
?>