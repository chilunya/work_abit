<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class reportForMarket{
	function rprtForMarket(){
		$title = new get_String_Form();
		$obj = new get_function();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		$obj->config();
		echo '<table class="table" width="100%"><thead>';
		echo '<tr><th><p>'; echo $title->getStringForm('sved_market'); echo date("d.m.Y").'г.</p>';
		echo '</th><th><p>'; echo $title->getStringForm('svod_market'); echo date("d.m.Y").'г.</p>';
		echo '</th></tr></thead><tbody>';
		echo '<td width="50%">';
		echo '<form action="excel_market_sved.php" method="GET"><input type="submit" class="btn" value="'; 
		echo $title->getStringForm('sformirovat'); echo '"></form>';		
		echo '</td>';
		echo '<td>';
		echo '<form action="excel_market_kurs.php" method="GET"><input type="submit" class="btn" value="'; 
		echo $title->getStringForm('sformirovat'); echo '"></form>';
		echo '</td>';
		
		echo '</tr></tbody></table>';
		echo '<table class="table" width="100%"><thead>';
		echo '<tr><th><p>Выберите данные для формирования отчёта</p></th></tr></thead>';
		echo '<tbody><tr><td width="50%">';
		echo '<form action="excel_konst_market.php" method="POST">';	
		echo '<label class="checkbox"><input type="checkbox" checked value="1" name="fio">Ф.И.О. абитуриента</label>';
		echo '<label class="checkbox"><input type="checkbox" checked value="1" name="ndel">Номер дела</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="zach">Зачислен</label>';
		echo '</td><td>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="ndog">Номер договора</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="ddog">Дата договора</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="dopl">Дата оплаты</label>';
		echo '<label class="checkbox"><input type="checkbox" value="1" name="zak">Заказчик</label>';
		echo '</td>';
		echo '</tr>';
		echo '<tr><td colspan="2" align="left"><input type="text" id="datepicker_birth" placeholder="'; echo $title->getStringForm('date_oplati'); echo '" name="date_oplaty">&nbsp;';
		echo '<select name="otdel"><option value="">'; 
		echo $title->getStringForm('otdelenie'); echo '</option>'; $obj->otdelenie(); echo'</select>&nbsp;';
		echo '<select name="naprav"><option value="">'; 
		echo $title->getStringForm('namespec'); echo '</option>'; $obj->spec(); echo'</select>';
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