<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class konstruktorForAbitur{
	function rprtForAbit(){
		$obj = new get_function();
		$title = new get_String_Form();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		$obj->config();
		echo '<table class="table" width="100%"><thead>';
		echo '<tr><th><p>Выберите данные абитуриентов для формирования запроса </p></th></tr></thead>';
		echo '<tbody><tr><td width="50%">';
		echo '<form action="excel_konstruktor.php" method="POST">';	
		echo '<label class="checkbox"><input type="checkbox" checked value="1" name="fio">Ф.И.О. абитуриента</label>';
		echo '<label class="checkbox"><input type="checkbox" checked value="1" name="ndel">Номер дела</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="kontr">Контракт</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="doc">Признак документа, дата подачи оригинала</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="lgt">Льгота вне конкурса</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="kyrs">Курсы перед поступлением</label>';
		echo '<label class="checkbox"></label>';
		echo '<label class="checkbox"></label>';
		echo '</td><td>';
		
		echo '<label class="checkbox"><input type="checkbox" value="1" name="mark">Оценки</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="isp">Испытание перед поступлением</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="obr">Образование перед поступлением, иностранный язык</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="adr">Адресс, телефон, e-mail</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="pasp">Паспортные данные, пол</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="zach">Зачислен</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="sob">Дата собеседования</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="dell">Показать возвраты документов</label>';
		echo '</td>';
		echo '</tr>';
		echo '<tr><td colspan="2" align="left"><select name="otdel"><option value="">'; 
		echo $title->getStringForm('otdelenie'); echo '</option>'; $obj->otdelenie(); echo'</select>&nbsp;';
		echo '<select name="naprav"><option value="">'; 
		echo $title->getStringForm('namespec'); echo '</option>'; $obj->spec(); echo'</select>';
		echo '</td></tr>';
		echo '<tr><td colspan="2" align="left"><input type="submit" class="btn" value="'; 
		echo $title->getStringForm('create_rpt'); echo '"></form></td></tr>';
		echo '</tbody></table>';
		
		echo '<table class="table" width="100%"><thead>';
		echo '<tr><th><p>Выберите данные востанавливающихся для формирования запроса </p></th></tr></thead>';
		echo '<tbody><tr><td width="50%">';
		echo '<form action="excel_konstr_vost.php" method="POST">';	
		echo '<label class="checkbox"><input type="checkbox" checked value="1" name="fio">Ф.И.О. абитуриента</label>';
		echo '<label class="checkbox"><input type="checkbox" checked value="1" name="ndel">Номер дела</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="nprot">Номер протокола</label>';
		echo '</td><td>';
		
		echo '<label class="checkbox"><input type="checkbox" value="1" name="kontr">Контракт</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="kyrs">Курс</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="predm">Предметы аттестации</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="zach">Зачислен</label>';
		echo '</td>';
		echo '</tr>';
		echo '<tr><td colspan="2" align="left"><select name="otdel"><option value="">'; 
		echo $title->getStringForm('otdelenie'); echo '</option>'; $obj->otdelenie(); echo'</select>&nbsp;';
		echo '<select name="naprav"><option value="">'; 
		echo $title->getStringForm('namespec'); echo '</option>'; $obj->spec_vostan(); echo'</select>';
		echo '</td></tr>';
		echo '<tr><td colspan="2" align="left"><input type="submit" class="btn" value="'; 
		echo $title->getStringForm('create_rpt'); echo '"></form></td></tr>';
		echo '</tbody></table>';
}
	else {
				echo $title->getStringForm('close');}
	}
}
	
?>