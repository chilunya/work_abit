<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class insertTableData{
	
	
	function choiceTableData(){
		
		$title = new get_String_Form();
		$obj = new get_function();
		
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3221225472)){
			
		echo '<div class="alert">'; echo $title->getStringForm("choice");
		echo '<br><small>'; echo $title->getStringForm("choice_tabl"); echo '</small></div>';
		echo '<table width="100%"><tr><td width="50%">';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=1">Справочник "Направления подготовки"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=2&kon=1">Справочник "План приёма"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=3">Справочник "Стоимость обучения"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=4">Справочник "Даты собеседования"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=5">Справочник "Протоколы"</a></p>';
		echo '</td><td valign="top">';
		echo '<div class="alert alert-error">
		<p align="left"><strong>Внимание! Очистка таблиц приведет к необратимым последствиям!</strong></p>
		<p align="left"><a href="class/save/trancatetables.php?tab=1">Очистить таблицу "Анкетные данные абитуриентов"</a></p>
		<p align="left"><a href="class/save/trancatetables.php?tab=2">Очистить таблицу "Принятые заявления вбитуриентов"</a></p>
		<p align="left"><a href="class/save/trancatetables.php?tab=3">Очистить таблицу "Принятые заявления на востанавление"</a></p>
		</div>';
		echo '</td></tr></table><hr>';
		echo '<table width="100%"><tr><td width="50%" valign="top">';
		echo '<p align="left">Вспомогательные справочники</p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=9">Справочник "Направления на востановление"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=10">Справочник "Предметы на востановление"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=6">Справочник "Деканы"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=7">Справочник "Льготы"</a></p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=8">Справочник "Курсы перед поступлением"</a></p>';

		if ($_SESSION['levl'] == 1) {	
		echo '<hr>';
		echo '<p align="left">Пользователи системы</p>';
		echo '<p align="left"><a class="btn" href="index.php?pages=24&cl=25&fl=11">Справочник "Логины и пароли"</a></p>';
		}
		
		
		echo '</td>';
		
		echo '<td valign="top" width="25%">';
		echo '<div class="alert alert-error"><p>Направления с прикладным бакалавриатом</p>';
		echo '<form action="class/save/addtotabledecan.php?point=6" method="post">';
		$obj->config();
		for ($id=1;$id<17;$id++){
			$prik = $obj->spec_bak($id);
			if ($prik == 1) {$checked="checked";} else {$checked="";}//
			echo '<label class="checkbox"><input type="checkbox" '.$checked.' value="1" name="chek_'.$id.'">'; 
			$obj->spec_kratkoe($id);
			echo '</label><input type="hidden" name="id_spec_'.$id.'" value="'.$id.'">';
			
		}
		echo '<input type="submit" value="Сохранить">';
		echo '</form>';
		echo '</div>';
		echo '</td>';
		
		$sort = $obj->abit_sort();
		if ($sort == "alf"){
			$sort_alf = "checked";
			$sort_ege = "";
			}
		elseif($sort == "ege"){
			$sort_alf = "";
			$sort_ege = "checked";
			}
		echo '<td width="25%" valign="top">';
		echo '<div class="alert alert-error"><p>Сортировка списка абитуриентов</p><br>';
		echo '<form action="class/save/addtotabledecan.php?point=5" method="post">';
		echo '<label class="radio">
			  <input type="radio" name="optionsRadios" '.$sort_alf.' id="optionsRadios1" value="alf">
			  По алфавиту
			</label>
			<label class="radio">
			  <input type="radio" name="optionsRadios" '.$sort_ege.' id="optionsRadios2" value="ege">
			  По балам ЕГЭ
			</label>';
		echo '<input type="submit" value="Сохранить" class="btn">';
		echo '</form>';
		echo '</div>';
		echo '</td></tr></table>';
		}
		else {
			echo $title->getStringForm('close');}
		
	}
	function napravlTableData(){ // направления
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Направления подготовки</h3></p>';
		
		$obj->config();
		
		$obr = "SELECT ID, KodSpec, NameSpec, NomFak, KratkoeName, predmets FROM SPEC ORDER BY ID ";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span1">Код</strong>
			<strong class="span4">Направление</strong>
			<strong class="span1">Краткое</strong>
			<strong class="span4">Предметы</strong>
			<strong class="span1">Факультет</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
		
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotablenaprav.php?point=1" method="post">
			<input type="hidden" name="id_spec" value="'.$row['ID'].'">
			<input type="text" name="kod_'.$row['ID'].'" value="'.$row['KodSpec'].'" class="span1">
			<input type="text" name="nam_'.$row['ID'].'" value="'.$row['NameSpec'].'" class="span4">
			<input type="text" name="short_'.$row['ID'].'" value="'.$row['KratkoeName'].'" class="span1">
			<input type="text" name="pred_'.$row['ID'].'" value="'.$row['predmets'].'" class="span4">
			<select class="span1" name="fac_'.$row['ID'].'">';
			$obj->selected_decanat($row['NomFak']);
			echo '</select>
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotablenaprav.php?point=2&id_sp='.$row['ID'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
		
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotablenaprav.php?point=3">';
		echo '<div class="controls controls-row">
			<input type="text" name="kod" placeholder="Код" class="span1">
			<input type="text" name="nam" placeholder="Направлние" class="span4">
			<input type="text" name="short" placeholder="Краткое" class="span1">
			<input type="text" name="pred" placeholder="Предметы" class="span4">
			<select class="span1" name="fac">';
			$obj->selected_decanat();
			echo '</select>
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotablenaprav.php?point=4">Очистить таблицу "Направления подготовки"</a></div>';
		
	}
	function planTableData(){ // федеральный бюджет - kon = 1
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>План приёма - <font color="#990000">Федеральный бюджет</font> - <a href="index.php?pages=24&cl=25&fl=2&kon=2">Договор</a> - <a href="index.php?pages=24&cl=25&fl=2&kon=3">Целевой приём</a></h3></p>';
		$obj->config();
		$obr = "SELECT ID, IDspec, IDformaobuch_budg, IDkontrakt_budg, plan_budg, svodka12 FROM plan_budg ORDER BY IDformaobuch_budg, IDspec";	
		$res_obr = mysql_query($obr);
		
		$lastyear = date("Y") - 1;
		echo '<div class="controls controls-row">
			<strong class="span2">Направление</strong>
			<strong class="span2">Форма обучения</strong>
			<strong class="span2">План приёма</strong>
			<strong class="span2">Статистика '. $lastyear .'</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotableplan.php?point=1&kon=1" method="post">
			<input type="hidden" name="id_pl" value="'.$row['ID'].'">
			<select class="span2" name="napr_'.$row['ID'].'">';
			$obj->selected_spec($row['IDspec']);
			echo '</select>
			
			<select class="span2" name="form_'.$row['ID'].'">';
			$obj->selected_otdelenie($row['IDformaobuch_budg']);
			echo '</select>
			<input type="text" name="plan_'.$row['ID'].'" value="'.$row['plan_budg'].'" class="span2">
			<input type="text" name="svod_'.$row['ID'].'" value="'.$row['svodka12'].'" class="span2">
			
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotableplan.php?point=2&id_pl='.$row['ID'].'&kon=1"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
		}
		
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotableplan.php?point=3&kon=1">';
		echo '<div class="controls controls-row">
			<select class="span2" name="napr">';
			$obj->selected_spec($row['IDspec']);
			echo '</select>
			<select class="span2" name="form">';
			$obj->selected_otdelenie($row['IDformaobuch_budg']);
			echo '</select>
			<input type="text" name="plan" placeholder="План приёма" class="span2">
			<input type="text" name="avod" placeholder="Стастистика '.$lastyear.'" class="span2">
			
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotableplan.php?point=4&kon=1">Очистить таблицу "План приёма: Федеральный бюджет"</a></div>';
		
	}
	function planTableDataK(){  // контракт - kon = 2
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>План приёма - <font color="#990000">Договор</font> - <a href="index.php?pages=24&cl=25&fl=2&kon=1">Федеральный бюджет</a> - <a href="index.php?pages=24&cl=25&fl=2&kon=3">Целевой приём</a></h3></p>';
		$obj->config();
		$obr = "SELECT ID, IDspec, IDformaobuch_kont, IDkontrakt_kont, plan_kont, svodka12 FROM plan_kont ORDER BY IDformaobuch_kont";	
		$res_obr = mysql_query($obr);
		
		$lastyear = date("Y") - 1;
		echo '<div class="controls controls-row">
			<strong class="span2">Направление</strong>
			<strong class="span2">Форма обучения</strong>
			<strong class="span2">План приёма</strong>
			<strong class="span2">Статистика '. $lastyear .'</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotableplan.php?point=1&kon=2" method="post">
			<input type="hidden" name="id_pl" value="'.$row['ID'].'">
			<select class="span2" name="napr_'.$row['ID'].'">';
			$obj->selected_spec($row['IDspec']);
			echo '</select>
			
			<select class="span2" name="form_'.$row['ID'].'">';
			$obj->selected_otdelenie($row['IDformaobuch_kont']);
			echo '</select>
			<input type="text" name="plan_'.$row['ID'].'" value="'.$row['plan_kont'].'" class="span2">
			<input type="text" name="svod_'.$row['ID'].'" value="'.$row['svodka12'].'" class="span2">
			
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotableplan.php?point=2&id_pl='.$row['ID'].'&kon=2"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
		}
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotableplan.php?point=3&kon=2">';
		echo '<div class="controls controls-row">
			<select class="span2" name="napr">';
			$obj->selected_spec();
			echo '</select>
			<select class="span2" name="form">';
			$obj->selected_otdelenie();
			echo '</select>
			<input type="text" name="plan" placeholder="План приёма" class="span2">
			<input type="text" name="svod" placeholder="Стастистика '.$lastyear.'" class="span2">
			
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotableplan.php?point=4&kon=2">Очистить таблицу "План приёма: Договор"</a></div>';
		}
	function planTableDataCP(){  // целевой прием - kon = 3
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>План приёма - <font color="#990000">Целевой приём</font> - <a href="index.php?pages=24&cl=25&fl=2&kon=1">Федеральный бюджет</a> - <a href="index.php?pages=24&cl=25&fl=2&kon=2">Договор</a></h3></p>';
		$obj->config();
		$obr = "SELECT ID, IDspec, IDkontrakt, cp_plan, IDformobuch FROM cp_plan ORDER BY ID";	
		$res_obr = mysql_query($obr);
		
		$lastyear = date("Y") - 1;
		echo '<div class="controls controls-row">
			<strong class="span2">Направление</strong>
			<strong class="span2">Форма обучения</strong>
			<strong class="span2">План приёма</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotableplan.php?point=1&kon=3" method="post">
			<input type="hidden" name="id_pl" value="'.$row['ID'].'">
			<select class="span2" name="napr_'.$row['ID'].'">';
			$obj->selected_spec($row['IDspec']);
			echo '</select>
			
			<select class="span2" name="form_'.$row['ID'].'">';
			$obj->selected_otdelenie($row['IDformobuch']);
			echo '</select>
			<input type="text" name="plan_'.$row['ID'].'" value="'.$row['cp_plan'].'" class="span2">			
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotableplan.php?point=2&id_pl='.$row['ID'].'&kon=3"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
		}
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotableplan.php?point=3&kon=3">';
		echo '<div class="controls controls-row">
			<select class="span2" name="napr">';
			$obj->selected_spec();
			echo '</select>
			<select class="span2" name="form">';
			$obj->selected_otdelenie();
			echo '</select>
			<input type="text" name="plan" placeholder="План приёма" class="span2">
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotableplan.php?point=4&kon=3">Очистить таблицу "План приёма: Целевой"</a></div>';
		}
	function priceTableData(){ // стоимость обучения
		$obj = new get_function();
		$title = new get_String_Form();
		$year = date("Y");
		echo '<p align="left"><h3>Стоимость обучения '.$year.'-'.($year+1).'г. </h3></p>';
		
		$obj->config();
		
 
		echo '<form name="vibor" action="../index.php" method="GET" class="form-inline">
		<input type="hidden" name="pages" value="24">
		<input type="hidden" name="cl" value="25">
		<input type="hidden" name="fl" value="3">
		<select class="span2" name="form">';
			$obj->otdelenie();
		echo '</select>&nbsp;<select class="span2" name="rezid"><option value="1">Российское</option><option value="3">Иностранное</option></select>
		<input type="submit" class="btn">


		</form>';



		$obr = "SELECT ID, spec, formaobuch, price, russ FROM price2013";
		if(isset($_GET['form'])){
			$obr = $obr . " WHERE formaobuch = ".$_GET['form'];
		}	
		if(isset($_GET['rezid'])){
			$obr = $obr . " AND russ = ".$_GET['rezid'];
		}

		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span2">Направление</strong>
			<strong class="span2">Форма обучения</strong>
			<strong class="span2">Стоимость год</strong>
			<strong class="span2">Гражданство</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotableprice.php?point=1" method="post">
			<input type="hidden" name="id_pr" value="'.$row['ID'].'">
			<select class="span2" name="napr_'.$row['ID'].'">';
			$obj->selected_spec($row['spec']);
			echo '</select>
			<select class="span2" name="form_'.$row['ID'].'">';
			$obj->selected_otdelenie($row['formaobuch']);
			
			echo '</select>
			<input type="text" name="price_'.$row['ID'].'" value="'.$row['price'].'" class="span2">
			<select class="span2" name="rezid_'.$row['ID'].'">';
			if ($row['russ'] == 1) {echo '<option selected="selected" value="1">Российское</option><option value="3">Иностранное</option>';}
			if ($row['russ'] == 3) {echo '<option value="1">Российское</option><option selected="selected" value="3">Иностранное</option>';}
			
			echo '</select>
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotableprice.php?point=2&id_pr='.$row['ID'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
		//<input type="text" name="rezid_'.$row['ID'].'" value="'.$row['russ'].'" class="span1">
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotableprice.php?point=3">';
		echo '<div class="controls controls-row">
			<select class="span2" name="napr">';
			$obj->selected_spec();
			echo '</select>
			<select class="span2" name="form">';
			$obj->selected_otdelenie();
			echo '</select>
			<input type="text" name="price" placeholder="Стоимость" class="span2">
			<select class="span2" name="rezid">
			<option value="1">Российское</option><option value="3">Иностранное</option></select>
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotableprice.php?point=4">Очистить таблицу "Стоимость обучения"</a></div>';
		
	}
	function sobesTableData(){ // даты собеседования
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Даты собеседований</h3></p>';
		
		$obj->config();
		
		$obr = "SELECT id, date_sob FROM date_sobes ORDER BY id";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span1">№ п/п</strong>
			<strong class="span2">Дата собеседования</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
			$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotabledatsob.php?point=1" method="post">
			<input type="hidden" name="id_sob" value="'.$row['id'].'">
			<input type="text" value="'.$ii.'" class="span1" disabled="disabled">
			<input type="text" name="dat_'.$row['id'].'" value="'.date("d.m.Y", strtotime($row['date_sob'])).'" class="span2" id="datepicker_dog_'.$ii.'">
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotabledatsob.php?point=2&id_s='.$row['id'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		//<input type="text" name="rezid_'.$row['ID'].'" value="'.$row['russ'].'" class="span1">
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotabledatsob.php?point=3">';
		echo '<div class="controls controls-row">
			<input type="text" name="dat" class="span2" placeholder="Дата собеседования" id="datepicker_birth">
			
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotabledatsob.php?point=4">Очистить таблицу "Даты собеседования"</a></div>';
		
	}	
	function protocolTableData(){ // протоколоы
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Протоколы приёмной комиссии</h3></p>';
		
		$obj->config();
		
		$obr = "SELECT id, Nom_prot, Data1, Data2 FROM PROTOKOL ORDER BY Nom_prot";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span2">Номер протокола</strong>
			<strong class="span2">Дата начала</strong>
			<strong class="span2">Дата окончания</strong>
			<strong class="span1">Действие</strong>
			</div>
			';
			$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotableprotocol.php?point=1" method="post">
			<input type="hidden" name="id_prot" value="'.$row['id'].'">
			<input type="text" name="nom_prot_'.$row['id'].'" value="'.$row['Nom_prot'].'" class="span2">
			<input type="text" name="dat1_'.$row['id'].'" value="'.date("d.m.Y", strtotime($row['Data1'])).'" class="span2" id="datepicker_dog_'.$ii.'">
			<input type="text" name="dat2_'.$row['id'].'" value="'.date("d.m.Y", strtotime($row['Data2'])).'" class="span2" id="datepicker_opl_'.$ii.'">
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotableprotocol.php?point=2&id_p='.$row['id'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		//<input type="text" name="rezid_'.$row['ID'].'" value="'.$row['russ'].'" class="span1">
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotableprotocol.php?point=3">';
		echo '<div class="controls controls-row">
			<input type="text" name="nom_prot" placeholder="Номер протокола" class="span2">
			<input type="text" name="dat1" class="span2" placeholder="Дата собеседования" id="datepicker_birth">
			<input type="text" name="dat2" class="span2" placeholder="Дата собеседования" id="datepicker_pas">
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotableprotocol.php?point=4">Очистить таблицу "Протоколы приёмной комиссии"</a></div>';
		
	}
	function decanTableData(){ // деканаты
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Деканаты/институты</h3></p>';
		
		$obj->config();
		
		$obr = "SELECT id_decan, FIO_Decan, decanat, id_dec FROM DECAN ORDER BY id_decan";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span2">Декан</strong>
			<strong class="span2">Деканат/институт</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
			$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotabledecan.php?point=1" method="post">
			<input type="hidden" name="id_dec" value="'.$row['id_decan'].'">
			<input type="text" name="name_dec_'.$row['id_decan'].'" value="'.$row['FIO_Decan'].'" class="span2">
			<input type="text" name="dec_'.$row['id_decan'].'" value="'.$row['decanat'].'" class="span2">
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotabledecan.php?point=2&id_d='.$row['id_decan'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		//<input type="text" name="rezid_'.$row['ID'].'" value="'.$row['russ'].'" class="span1">
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotabledecan.php?point=3">';
		echo '<div class="controls controls-row">
			<input type="text" name="name_dec" placeholder="ФИО Декана" class="span2">
			<input type="text" name="dec" placeholder="Деканат/институт" class="span2">
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotabledecan.php?point=4">Очистить таблицу "Деканаты/институты"</a></div>';
	}
	function lgotaTableData(){ // Льготы
		$obj = new get_function();
		$title = new get_String_Form();
		$obj->config();
		
		echo '<table width="100%"><tr><td width="50%" valign="top">';
		echo '<p align="left"><h3>Льготы вне конкурса</h3></p>';
		echo '<div class="controls controls-row">
			<strong class="span2">№ п/п</strong>
			<strong class="span4">Льгота</strong>
			<strong class="span2">Действия</strong>
			</div>
			';
		$obr = "SELECT ID, LGOTAVNEKONK FROM LGOTAVNEKONK ORDER BY ID";	
		$res_obr = mysql_query($obr);
		$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotablelgota.php?point=1&lg=1" method="post">
			<input type="hidden" name="id_lgt" value="'.$row['ID'].'">
			<input type="text" disabled="disabled" value="'.$ii.'" class="span2">
			<input type="text" name="lgota_'.$row['ID'].'" value="'.$row['LGOTAVNEKONK'].'" class="span4">
			<p class="span2"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotablelgota.php?point=2&lg=1&id_l='.$row['ID'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		}
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotablelgota.php?point=3&lg=1">';
		echo '<div class="controls controls-row">
			<input type="text" name="lgota" placeholder="Льгота вне конкурса" class="span4">
			<p class="span4"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		echo '</td><td valign="top">';
		echo '<p align="left"><h3>Льготы конкурса</h3></p>';
		echo '<div class="controls controls-row">
			<strong class="span2">№ п/п</strong>
			<strong class="span4">Льгота</strong>
			<strong class="span2">Действия</strong>
			</div>
			';
			$ii=1;
		$obr = "SELECT ID, LGOTAKONK FROM LGOTAKONK ORDER BY ID";	
		$res_obr = mysql_query($obr);
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotablelgota.php?point=1&lg=2" method="post">
			<input type="hidden" name="id_lgt" value="'.$row['ID'].'">
			<input type="text" disabled="disabled" value="'.$ii.'" class="span2">
			<input type="text" name="lgota_'.$row['ID'].'" value="'.$row['LGOTAKONK'].'" class="span4">
			<p class="span2"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotablelgota.php?point=2&lg=2&id_l='.$row['ID'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
			}
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotablelgota.php?point=3&lg=2">';
		echo '<div class="controls controls-row">
			<input type="text" name="lgota" placeholder="Льгота конкурса" class="span4">
			<p class="span2"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '</td></tr><tr><td>';

		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotablelgota.php?point=4&lg=1">Очистить таблицу "Льгота вне конкурса"</a></div></td><td>';
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotablelgota.php?point=4&lg=2">Очистить таблицу "Льгота конкурса"</a></div>';
		
		echo '</td></tr></table>';
	}
	function kyrsTableData(){ // Курсы
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Курсы перед поступлением</h3></p>';
		
		$obj->config();
		
		$obr = "SELECT ID, VIDKURSOV FROM VIDKURSOV ORDER BY ID";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span1">№п/п</strong>
			<strong class="span2">Вид курсов</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
			$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotablekyrs.php?point=1" method="post">
			<input type="hidden" name="id_kyr" value="'.$row['ID'].'">
			<input type="text" disabled="disabled" value="'.$ii.'" class="span1">
			<input type="text" name="kyrs_'.$row['ID'].'" value="'.$row['VIDKURSOV'].'" class="span2">
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotablekyrs.php?point=2&id_k='.$row['ID'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		//<input type="text" name="rezid_'.$row['ID'].'" value="'.$row['russ'].'" class="span1">
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotablekyrs.php?point=3">';
		echo '<div class="controls controls-row">
			<input type="text" name="kyrs" placeholder="Вид курсов" class="span2">
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotablekyrs.php?point=4">Очистить таблицу "Курсы перед поступлением"</a></div>';
	}
	function specvostTableData(){ // направления востановления
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Направления на востановление</h3></p>';
		
		$obj->config();
		
		$obr = "SELECT SPEC_VOSTAN.ID, SPEC_VOSTAN.ID_spec, SPEC_VOSTAN.spec, SPEC_VOSTAN.krat_spec, SPEC_VOSTAN.fac, SPEC_VOSTAN.formaobuch FROM SPEC_VOSTAN ORDER BY SPEC_VOSTAN.ID";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span1">Код напр.</strong>
			<strong class="span5">Направление</strong>
			<strong class="span1">Краткое</strong>
			<strong class="span2">Форма обуч.</strong>
			<strong class="span2">Деканат</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
			$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotablespecvost.php?point=1" method="post">
			<input type="hidden" name="id_kyr" value="'.$row['ID'].'">
			<input type="text" name="kodsp_'.$row['ID'].'" value="'.$row['ID_spec'].'" class="span1">
			<input type="text" name="name_'.$row['ID'].'" value="'.$row['spec'].'" class="span5">
			<input type="text" name="krname_'.$row['ID'].'" value="'.$row['krat_spec'].'" class="span1">
			<select class="span2" name="form_'.$row['ID'].'">';
			$obj->selected_otdelenie($row['formaobuch']);
			echo '</select>
			<select class="span2" name="fac_'.$row['ID'].'">';
			$obj->selected_decanat($row['fac']);
			echo '</select>
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotablespecvost.php?point=2&id_k='.$row['ID'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		//<input type="text" name="rezid_'.$row['ID'].'" value="'.$row['russ'].'" class="span1">
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotablespecvost.php?point=3">';
		
		echo '<div class="controls controls-row">
			<input type="text" name="kodsp"  placeholder="Код"  class="span1">
			<input type="text" name="name"  placeholder="Направление"  class="span5">
			<input type="text" name="krname"  placeholder="Краткое название"  class="span1">
			<select class="span2" name="form">';
			$obj->selected_otdelenie();
			echo '</select>
			<select class="span2" name="fac">';
			$obj->selected_decanat();
			echo '</select>
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotablespecvost.php?point=4">Очистить таблицу "Направления на востановление"</a></div>';
	}
	function predvostTableData(){ // предметы востановление
		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Предметы востановления</h3></p>';
		
		$obj->config();
		
		$obr = "SELECT PREDM_VOSTAN.ID, PREDM_VOSTAN.Predmet, PREDM_VOSTAN.Krat_pred FROM PREDM_VOSTAN";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span1">№ п/п</strong>
			<strong class="span5">Предмет</strong>
			<strong class="span2">Краткое название</strong>
			<strong class="span1">Действия</strong>
			</div>
			';
			$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotablepredvost.php?point=1" method="post">
			<input type="hidden" name="id_kyr" value="'.$row['ID'].'">
			<input type="text" value="'.$ii.'" class="span1" disabled="disabled">
			<input type="text" name="name_'.$row['ID'].'" value="'.$row['Predmet'].'" class="span5">
			<input type="text" name="krname_'.$row['ID'].'" value="'.$row['Krat_pred'].'" class="span2">
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotablepredvost.php?point=2&id_k='.$row['ID'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		//<input type="text" name="rezid_'.$row['ID'].'" value="'.$row['russ'].'" class="span1">
		}
		mysql_free_result($res_obr);
		
		//echo '</table>';
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotablepredvost.php?point=3">';
		
		echo '<div class="controls controls-row">
			<input type="text" name="name"  placeholder="Направление"  class="span5">
			<input type="text" name="krname"  placeholder="Краткое название"  class="span2">
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';
		
		echo '<p align="left">&nbsp;</p>';
		echo '<div class="alert alert-error"><strong>Внимание! Очистка таблицы приведет к необратимым последствиям!</strong> &nbsp; <a href="class/save/addtotablepredvost.php?point=4">Очистить таблицу "Предметы востановления"</a></div>';
	}
	function loginTableData(){

		$obj = new get_function();
		$title = new get_String_Form();
		echo '<p align="left"><h3>Пользователи системы</h3></p>';
		
		$obj->config();
		echo '<p>&nbsp;</p>';
		echo '<p align="left"><strong>Добавить новое значение</strong></p>';
		echo '<form name="new_record" method="post" action="class/save/addtotablelogin.php?point=3">';
		
		echo '<div class="controls controls-row">
			<input type="text" name="log"  placeholder="Логин"  class="span2">
			<input type="text" name="pas"  placeholder="Пароль"  class="span2">
			<select class="span2" name="lvl">
			<option value="1">Админ</option>
			<option value="2">Приёмная</option>
			<option value="3">Секретарь</option>
			<option value="4">Маркетинг</option>
			</select>
			<input type="text" name="fio"  placeholder="ФИО"  class="span2">
			<p class="span1"><input type="image" src="css/img/save.png"></p>
			</div>
			';
		echo '</form>';

		$obr = "SELECT pass.userid, pass.log, pass.pass, pass.level, pass.fio FROM pass";	
		$res_obr = mysql_query($obr);
		echo '<div class="controls controls-row">
			<strong class="span1">№ п/п</strong>
			<strong class="span2">Логин</strong>
			<strong class="span2">Пароль</strong>
			<strong class="span1">Уровень</strong>
			<strong class="span2">ФИО</strong>
			</div>
			';
			$ii=1;
	  	while ($row = mysql_fetch_array($res_obr, MYSQL_ASSOC)) 
		{	
			echo '<div class="controls controls-row">
			<form name="change_record" action="class/save/addtotablelogin.php?point=1" method="post">
			<input type="hidden" name="id_s" value="'.$row['userid'].'">
			<input type="text" value="'.$ii.'" class="span1" disabled="disabled">
			<input type="text" name="log_'.$row['userid'].'" value="'.$row['log'].'" class="span2">
			<input type="text" name="pas_'.$row['userid'].'" value="'.$row['pass'].'" class="span2">
			<input type="text" name="lvl_'.$row['userid'].'" value="'.$row['level'].'" class="span1">
			<input type="text" name="fio_'.$row['userid'].'" value="'.$row['fio'].'" class="span2">
			<p class="span1"><input type="image" src="css/img/edit.png">&nbsp;
			<a href="class/save/addtotablelogin.php?point=2&id_k='.$row['userid'].'"><img src="css/img/delete.png"></a></p>
			</form></div>
			';
			$ii++;
		}
		mysql_free_result($res_obr);
		
	}

	//predvostTableData
}
?>