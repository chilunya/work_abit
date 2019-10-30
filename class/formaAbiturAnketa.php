<?php session_start();
class formaAbiturAnketa{
	function formaAbiturAnketa(){
		include_once("get_string.php");
		include_once("get_function.php");
		$obj = new get_function();
		$title = new get_String_Form();
		$obj->config();
		//$title->getStringForm('self_data');		
		//echo '<select>'; $obj->typeofobjects(); echo'</select>';
		//echo '<div id="info" style="position:absolute;top:600px;"></div>';
		echo '<div class="alert"><strong>'; echo $title->getStringForm("anket"); echo '</strong>'; echo $title->getStringForm("obyaz_pol");
		echo '<br><small>'; echo $title->getStringForm("info"); echo '</small></div>';
		
		echo '<table border="0" width=100% class="table table-striped">';
		echo '<form method="POST" action="class/save/save.php" enctype="multipart/form-data">';
		//============================= SELF DATA =========================
		echo '<tr valign="top"><td colspan="2"><h4>'; echo $title->getStringForm('self_data'); echo '</h4></td>';
		echo '<tr>';
		echo '<td><input required type="text" placeholder="'; echo $title->getStringForm('lastname'); echo '" name="fam" pattern="^[а-яА-Я]+$"></td>';
		echo '<td><nobr><input required type="text" placeholder="'; echo $title->getStringForm('pasport_ser'); echo '" name="pasport_ser">
		<input required type="text" placeholder="'; echo $title->getStringForm('pasport_num'); echo '" name="pasport_nom"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input required type="text" placeholder="'; echo $title->getStringForm('name'); echo '" name="name" pattern="^[а-яА-Я]+$"></td>';
		echo '<td><nobr><input required type="text" placeholder="'; echo $title->getStringForm('who_pasport'); echo '" name="pasport_kemvidan">
		<input required type="text" id="datepicker_pas" placeholder="'; echo $title->getStringForm('date_pasport'); echo '" name="pasport_data"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input required type="text" placeholder="'; echo $title->getStringForm('parth'); echo '" name="otch" pattern="^[а-яА-Я]+$"></td>';
		echo '<td><nobr><input required type="text" id="datepicker_birth" placeholder="'; echo $title->getStringForm('date_birth'); echo '" name="data_rozhd">
		<input type="text" placeholder="'; echo $title->getStringForm('place_birth'); echo '" name="birth_place"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><select required name="pol"><option value="">'; echo $title->getStringForm('pol'); echo '</option>'; $obj->pol(); echo'</select></td>';
		echo '<td><input required type="number" pattern="^[ 0-9]+$" placeholder="'; echo $title->getStringForm('tel_self'); echo '" name="telefon" >&nbsp;<input type="email" placeholder="'; echo $title->getStringForm('mail'); echo '" name="mail"></td>';
		echo '</tr>';
		//============================= ADRESS =========================
		
		echo '<tr valign="top"><td colspan="2"><h4>'; echo $title->getStringForm('adress'); echo '</h4></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><select required name="gosudarstvo"><option value="">'; echo $title->getStringForm('gosud'); echo '</option>'; $obj->country(); echo'</select>&nbsp;<input type="checkbox" value="3" name="inostran">&nbsp;<sub>'; echo $title->getStringForm('inostran'); echo '</sub>';
		echo '<td><nobr><select required name="type_str"><option value="">'; echo $title->getStringForm('type_of_place'); echo '</option>'; $obj->prospect(); echo'</select>&nbsp;
		<input required type="text" placeholder="'; echo $title->getStringForm('name_titl'); echo '" name="ulica"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><input required name="type_sity" list="sublist" type="text" placeholder="'; echo $title->getStringForm('subject'); echo '"><datalist id="sublist" >'; $obj->subject(); echo' </datalist>&nbsp;<input required  name="name_sity" list="arealist" type="text" placeholder="'; echo $title->getStringForm('name_area'); echo '"><datalist id="arealist" >'; $obj->rus_penz_area(); echo' </datalist></nobr></td>';
		
		echo '<td><nobr><input required type="text" placeholder="'; echo $title->getStringForm('dom'); echo '" name="dom">
		<input type="text" placeholder="'; echo $title->getStringForm('kvartira'); echo '" name="kvart"></nobr></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><select required name="selo"><option value="">'; echo $title->getStringForm('poselok'); echo '</option>'; $obj->poselok(); echo'</select>&nbsp;<input required type="text" placeholder="'; echo $title->getStringForm('rayon_center'); echo '" name="rayon_centr" list="centrlist"><datalist id="centrlist" >'; $obj->rus_penz_area_center(); echo' </datalist></nobr></td>';
		echo '<td>&nbsp;</td></tr>';
		
		//============================= EDUCATION DATA =========================
		echo '<tr valign="top">';
		echo '<td colspan="2"><h4>'; echo $title->getStringForm('education_data'); echo '</h4></td></tr>';
		echo '<td><input required type="number" value="2016" placeholder="'; echo $title->getStringForm('year_end'); echo '" name="god_okonch">&nbsp;</td>';
		echo '<td><select required name="document"><option value="">'; echo $title->getStringForm('document'); echo '</option>'; $obj->document(); echo'</select></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><select required name="uch_zavedenie"><option value="">'; echo $title->getStringForm('shool_lbl'); echo '</option>'; $obj->uchzavedenie(); echo'</select>&nbsp;<input type="number" min="1" placeholder="'; echo $title->getStringForm('number_shool'); echo '" name="nom_uch_zaved"></td>';
		echo '<td><input type="text" placeholder="'; echo $title->getStringForm('serial'); echo '" name="doc_ser">
		<input required type="text" placeholder="'; echo $title->getStringForm('number'); echo '" name="doc_nom"></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><input type="text" placeholder="'; echo $title->getStringForm('name_titl'); echo '" class="input-xlarge" name="nazvanie"></td>';
		echo '<td><input required type="text" id="datepicker_doc" placeholder="'; echo $title->getStringForm('date_dipl'); echo '" name="doc_data"></td>';
		echo '</tr>';
		echo '<tr>';
		echo '<td><nobr><select required name="doc_type_sity"><option value="">'; echo $title->getStringForm('type_of_sity'); echo '</option>'; $obj->typeofobjects(); echo'</select>
		<input required type="text" placeholder="'; echo $title->getStringForm('name_titl'); echo '" name="doc_name_sity"></nobr></td>';
		echo '<td><select name="medal"><option value="1">'; echo $title->getStringForm('medal'); echo '</option>'; $obj->medal(); echo'</select>
		<select name="inostr_yaz"><option value="1">'; echo $title->getStringForm('language'); echo '</option>'; $obj->language(); echo'</select></td>';
		echo '</tr>';
		//============================= EGE DATA =======================
		
		//echo '<tr valign="top"><td colspan="2"><h4>'; echo $title->getStringForm('ege_data'); echo '</h4></td></tr>';
		//echo '<tr>';
		//echo '<td><input type="text" placeholder="'; echo $title->getStringForm('serial_num'); echo '" name="ege_ser"></td>';
		//echo '<td><input type="text" placeholder="'; echo $title->getStringForm('registr_num'); echo '" name="ege_reg"></td>';
		//echo '</tr>';
		//echo '<tr>';
		//echo '<td><nobr><input type="text" value="'; echo $title->getStringForm('rusyaz'); echo '">&nbsp;<input type="number" min="0" max="100" placeholder="'; echo $title->getStringForm('bal_ege'); echo '" class="input-small" name="bal1"></nobr></td>';
		//echo '<td><nobr><input type="text" value="'; echo $title->getStringForm('math'); echo '">&nbsp;<input type="number" min="0" max="100" placeholder="'; echo $title->getStringForm('bal_ege'); echo '" class="input-small" name="bal2"></nobr></td>';
		//echo '</tr>';
		//echo '<tr>';
		//echo '<td><nobr><input type="text" value="'; echo $title->getStringForm('fiz'); echo '">&nbsp;<input type="number" min="0" max="100" placeholder="'; echo $title->getStringForm('bal_ege'); echo '" class="input-small" name="bal3"></nobr></td>';
		//echo '<td><nobr><input type="text" value="'; echo $title->getStringForm('litra'); echo '">&nbsp;<input type="number" min="0" max="100" placeholder="'; echo $title->getStringForm('bal_ege'); echo '" class="input-small" name="bal5"></nobr></td>';
		//echo '</tr>';
		//echo '<tr>';
		//echo '<td><nobr><input type="text" value="'; echo $title->getStringForm('obw'); echo '">&nbsp;<input type="number" min="0" max="100" placeholder="'; echo $title->getStringForm('bal_ege'); echo '" class="input-small" name="bal4"></nobr></td>';
		//echo '<td>&nbsp;</td></tr>';
		//============================= ANOTHER DATA =======================
		echo '<tr valign="top"><td colspan="2"><h4>'; echo $title->getStringForm('dopoln'); echo '</h4></td></tr>';
		echo '<td><select name="obwezhit"><option value="1">'; echo $title->getStringForm('obwezhit'); echo '</option>'; $obj->obwezhitie(); echo'</select></td>';
		echo '<td><select name="vozvrat"><option value="">'; echo $title->getStringForm('vozvrat'); echo '</option><option value="Лично">Лично</option><option value="Почтой">Почтой</option></select></td>';
		echo '</tr>';
		echo '<tr><td colspan=2>';

		echo '<input type="checkbox" name="fl_indiv" value="1"> наличие статуса чемпиона и призера Олимпийских игр, Паралимпийских игр и Сурдлимпийских игр, чемпиона мира, чемпиона Европы, победителя первенства мира, первенства Европы по видам спорта, включенным в программы Олимпийских игр, Паралимпийских игр и Сурдлимпийских игр;<Br>';
		echo '<input type="checkbox" name="fl_indiv" value="1"> наличие серебряного и (или) золотого значка "Готов к труду и обороне";<Br>';
		echo '<input type="checkbox" name="fl_indiv" value="1"> наличие аттестата о среднем общем образовании с отличием;<Br>';
		echo '<input type="checkbox" name="fl_indiv" value="1"> наличие диплома победителя или призера заключительного этапа олимпиад школьников по предметам, указанным в перечне вступительных испытаний;<Br>';
		echo '<input type="checkbox" name="fl_indiv" value="1"> итоговое сочинение в выпускных классах организаций, реализующих образовательные программы среднего общего образования.<Br>';

		echo '</td></tr>';
		echo '</table>';
		//============================= PHOTO =======================
		//echo '<p align="left">';
		//echo '<input type="hidden" name="MAX_FILE_SIZE" value="30000" />';
		//echo $title->getStringForm('photo'); echo '<input name="userfile" type="file"/>'; echo $title->getStringForm('size');
		//echo '<input type="submit" value="'; echo $title->getStringForm('photo_send'); echo '" />';
		//echo '</p>';
		echo '<p align="left">';
		echo '<label class="checkbox"><input required type="checkbox" value="5" name="check_agry">'; echo $title->getStringForm('agry'); echo '</label>';
		echo '</p>';
		echo '<p align="left">';
				$y = rand(0,9);
				$x = rand(0,9);
				$z = rand(0,9);
				$summ = $y+$x+$z;
				echo '<img src="captcha/num_'.$y.'.png"><img src="captcha/pls.png"><img src="captcha/num_'.$x.'.png"><img src="captcha/pls.png"><img src="captcha/num_'.$z.'.png"><img src="captcha/sum.png">';
				echo '<input required type="text" name="result" class="input-small">';
				echo '<input type="hidden" name="summa" value="'.$summ.'">';
				
		echo '</p>';		
		echo '<p align="left"><input class="btn btn-large btn-primary" action="class/save/save.php" type="submit" value="'; echo $title->getStringForm('save'); echo '"></p>';
		echo '</form>';
		mysql_close($dbcnx);
	}
}

?>