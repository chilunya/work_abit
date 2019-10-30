<?php session_start();
class dataProtokolMarks{
	function dataProtokolMarks(){
		//include_once("get_string.php");
		include_once("get_function.php");

		//$title = new get_String_Form();
		$obj = new get_function();
		$obj->config();

		echo '<table class="table" width="50%"><thead>';
		echo '<tr><th colspan="2"><p>Выберите условия для экзаменационной ведомости</p>';
		echo '<form action="excel_vedomost.php" method="GET">';
		echo '</th></tr></thead><tbody>';
		echo '<tr><td>Форма обучения</td><td>';
		echo '<input type="hidden" name="pages" value="25"><input type="hidden" name="cl" value="26">';
		echo '<select name="otd"><option value="">- Отделение -</option>'; $obj->otdelenie();
		echo '</select>';
		echo '</td></tr><tr><td>Дата экзамена/собеседования</td><td>';
		echo '<select name="dat"><option value="">- Дата экзамена -</option>'; $obj->dat_ekzam();
		echo '</select>';	
		echo '</td></tr><tr><td>Вид экзамена</td><td>';
		echo '<select name="ekz"><option value="">- Тип экзамена -</option>'; $obj->ekzam();
		echo '</select>';	
		echo '</td></tr><tr><td>Предмет</td><td>';
		echo '<select name="predm"><option value="">- Предмет -</option>'; $obj->predmet();
		echo '</select>';
		echo '</td></tr><tr><td colspan="2">';
		echo '<input type="submit" class="btn" value="Сформировать ведомость">';
		echo '</form></td>';		
		echo '</td></tr>';
		echo '</tbody></table>';
		
		
	}
	
	//function viewProtokolMarks($otd, $dat, $ekz, $predm){
	//}
}
		
?>