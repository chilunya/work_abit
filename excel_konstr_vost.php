<?php 	
// адрес PEAR
	$path = realpath(dirname(__FILE__).'/pear/');
	// подключаем
	set_include_path(dirname(__FILE__). PATH_SEPARATOR . $path);
	require_once('PEAR.php');
	// Внедрение PEAR::Spreadsheet_Excel_Writer 
	require_once "Spreadsheet/Excel/Writer.php";
	
	// Создание случая 
	$xls =& new Spreadsheet_Excel_Writer(); 
	// Передаем номер версии Excel
	$xls->setVersion(8);
	$sheet = $xls->addWorksheet('konstruktor');        // имя листа должно быть уникальным
	$sheet->setInputEncoding('UTF-8');
	$sheet->hideGridLines();
	
	// Создание объекта форматирования 
	// заголовок
		$oneFormat =& $xls->addFormat();    // Определение размера текста 
		$oneFormat->setAlign('left');  	// выравнимание
		//$oneFormat->setVAlign('vcenter');
		$oneFormat->setColor('black'); 
		$oneFormat->SetSize(8);

	
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
//****************************************			 
// заголовок
$n=0;
		$sheet->write(0, $n++, 'ФИО Абитуриента', $oneFormat);    
		$sheet->write(0, $n++, 'Номер п/ж', $oneFormat);   
		$sheet->write(0, $n++, 'Направление', $oneFormat);   
		$sheet->write(0, $n++, 'Форма обучения', $oneFormat); 
if ($_POST['nprot'] == 1){
	$sheet->write(0, $n++, 'Номер протокола', $oneFormat);  
}	
if ($_POST['kontr'] == 1){
	$sheet->write(0, $n++, 'Контракт', $oneFormat);  
}
if ($_POST['kyrs'] == 1){
	$sheet->write(0, $n++, 'Курс', $oneFormat);  
}
if ($_POST['predm'] == 1){
	$sheet->write(0, $n++, 'Предмет 1', $oneFormat);  
	$sheet->write(0, $n++, 'Предмет 2', $oneFormat);  
}
if ($_POST['zach'] == 1){
	$sheet->write(0, $n++, 'Зачислен', $oneFormat);  
}	
// конец заголовка
	
$i=1;
$sql = "SELECT INFO.fam, INFO.name, INFO.otch, SPEC_VOSTAN.krat_spec, ZHURNAL_VOSTANOVLENIE.spec, FORMAOBUCH.leter, ZHURNAL_VOSTANOVLENIE.num_po_zhurn, ZHURNAL_VOSTANOVLENIE.otdelenie, ZHURNAL_VOSTANOVLENIE.kurs, ZHURNAL_VOSTANOVLENIE.kontrakt, ZHURNAL_VOSTANOVLENIE.pred1, ZHURNAL_VOSTANOVLENIE.pred2, ZHURNAL_VOSTANOVLENIE.zachislen, ZHURNAL_VOSTANOVLENIE.protokol
FROM SPEC_VOSTAN INNER JOIN ZHURNAL_VOSTANOVLENIE ON SPEC_VOSTAN.ID = ZHURNAL_VOSTANOVLENIE.spec INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL_VOSTANOVLENIE.otdelenie INNER JOIN INFO ON INFO.ID = ZHURNAL_VOSTANOVLENIE.ID_abit";

if ($_POST['otdel'] != "" and $_POST['naprav'] == ""){
$sql= $sql . " WHERE ZHURNAL_VOSTANOVLENIE.otdelenie = ".$_POST['otdel'];
}
if ($_POST['naprav'] != "" and $_POST['otdel'] == ""){
$sql= $sql . " WHERE ZHURNAL_VOSTANOVLENIE.spec = ".$_POST['naprav'];
}
if ($_POST['naprav'] != "" and $_POST['otdel'] != ""){
$sql= $sql . " WHERE ZHURNAL_VOSTANOVLENIE.spec = ".$_POST['naprav']." AND ZHURNAL_VOSTANOVLENIE.otdelenie = ".$_POST['otdel'];
}
$sql= $sql . " ORDER BY INFO.fam";

$sq_spec = mysql_query($sql);
while ($row = mysql_fetch_array($sq_spec)){
	
	$n=0;
	
		$sheet->write($i, $n++, $row['fam']." ".$row['name']." ".$row['otch'], $oneFormat);    
		$sheet->write($i, $n++, $row['num_po_zhurn'], $oneFormat);   
		$sheet->write($i, $n++, $row['krat_spec'], $oneFormat);   
		$sheet->write($i, $n++, $row['leter'], $oneFormat); 
		
if ($_POST['nprot'] == 1){
	$sheet->write($i, $n++, $row['protokol'], $oneFormat);  
}	
if ($_POST['kontr'] == 1){
	$sheet->write($i, $n++, $row['kontrakt'], $oneFormat);  
}
if ($_POST['kyrs'] == 1){
	$sheet->write($i, $n++, $row['kurs'], $oneFormat);  
}
if ($_POST['predm'] == 1){
	$sql1 = "SELECT PREDM_VOSTAN.Krat_pred FROM PREDM_VOSTAN WHERE PREDM_VOSTAN.ID = ".$row['pred1'];
	$sql2 = "SELECT PREDM_VOSTAN.Krat_pred FROM PREDM_VOSTAN WHERE PREDM_VOSTAN.ID = ".$row['pred2'];
	$res_obr1 = mysql_query($sql1);
	$res_obr2 = mysql_query($sql2);
	$row1 = mysql_fetch_array($res_obr1, MYSQL_ASSOC);
	$row2 = mysql_fetch_array($res_obr2, MYSQL_ASSOC);
	$sheet->write($i, $n++, $row1['Krat_pred'], $oneFormat);  
	$sheet->write($i, $n++, $row2['Krat_pred'], $oneFormat);  
}
if ($_POST['zach'] == 1){
	switch($row['zachislen']){
		case 0:
		break;
		case 1:
		$zachislen = "да";
		break;
		}
	$sheet->write($i, $n++, $zachislen, $oneFormat);  
}	
		$i=$i+1;	
	}
	$xls->send('konstruktor.xls');
	$xls->close();
	mysql_close($dbcnx);
	

?>