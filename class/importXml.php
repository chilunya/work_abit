<?php session_start();
include_once("get_string.php");
include_once("get_function.php");
class importXml{
	function formaDataImport(){
		
		$txt = new get_String_Form();
		$obj = new get_function();
		$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//echo $ip;
		$a=explode(".",$ip);
		$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		if (($intip < 3232301055 and $intip > 3232235520)){
		echo '<div class="alert">'; echo $txt->getStringForm("forma9"); echo '</div>';
		
		echo '<table class="table" width="250"><thead>';
		echo '<tr><th><p>'; echo $txt->getStringForm('dat_pod'); echo '</p>';
		echo '</th></tr></thead><tbody><tr><td>';
			
		echo '<form action="xml/import.php" method="POST"><input type="text" id="datepicker_xml" name="imp_date" placeholder="Дата заявления">
		<select name="form"><option value="0">'; echo $txt->getStringForm('otdelenie'); echo '</option>'; $obj->otdelenie(); echo '</select>
		<select name="inostr"><option value="0">'; echo $txt->getStringForm('inostranec'); echo '</option>'; $obj->inostranec(); echo '</select>
		
		<label class="checkbox"><input type="checkbox" value="1" name="marks">Выгрузить с оценками</label>
		<br>
		';	
		echo '<input type="submit" class="btn" value="'; 
		echo $txt->getStringForm('create_xml'); echo '"></form>';	
		echo '</td>';
		echo '</tr></tbody></table>';	
		echo '<hr>';
		$obj->config();
		
		$sql = "SELECT DISTINCT n_prikaza, data_prikaza FROM ZHURNAL WHERE n_prikaza <> ''";
		$result = mysql_query($sql);
		echo '<p><strong>Включенные в приказ</strong></p>';
		echo '<form action="xml/import_zachis.php" method="post"><select name="prikaz"><option value=""> - Выбрать приказ - </option>';
		
		while ($row = mysql_fetch_array($result, MYSQL_ASSOC)){
			echo '<option value="'.$row['n_prikaza'].'">'.$row['n_prikaza'].' от '.date("d.m.Y", strtotime($row['data_prikaza'])).'</option>';
		}
		echo '</select><br><input type="submit" class="btn" value="Выгрузить XML"></form>';
		
		
		
		echo '<hr>';
		echo '<form action="index.php?pages=15&cl=16" method="post">';
		echo '<input type="hidden" name="flag" value="5">';
		echo '<input type="submit" name="btnOK" value="Зачисленные с копиями">';
		echo '</form>';
		if ($_POST['flag'] == 5){
			$this->config();
			$sql = "SELECT ZHURNAL.IDstud, ZHURNAL.Zachislen FROM ZHURNAL WHERE ZHURNAL.Zachislen = 1";
			$result = mysql_query($sql);
  		while($spis = mysql_fetch_array($result))
		{ 
		$sql2 = "SELECT ZHURNAL.ID_zh, INFO.fam, INFO.name, INFO.otch, ZHURNAL.priznak_vozvrata, SPEC.KratkoeName, ZHURNAL.IDstud, PRIZNAKDOC.PRIZNAKDOC, FORMAOBUCH.leter, ZHURNAL.Priznak_doc FROM INFO INNER JOIN ZHURNAL  ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN PRIZNAKDOC ON PRIZNAKDOC.ID = ZHURNAL.Priznak_doc INNER JOIN FORMAOBUCH ON FORMAOBUCH.ID = ZHURNAL.Otdelenie WHERE ZHURNAL.Priznak_doc = 2 AND ZHURNAL.IDstud = ".$spis['IDstud']." AND ZHURNAL.priznak_vozvrata is null";
			$result2 = mysql_query($sql2);
  		while($kop = mysql_fetch_array($result2))
		{
			echo '<table border="1" bordercolor="#CCCCCC" cellpadding="5">';
			echo '<tr><td>'.$kop['fam'].' '.$kop['name'].' '.$kop['otch'].'</td><td>'.$kop['KratkoeName'].'/'.$kop['leter'].'</td><td>'.$kop['PRIZNAKDOC'].'</td></tr>';
			echo '</table>';
			}
		}
		if (!$kop) {echo 'Нет';}
			}
		}
	else {
		echo $txt->getStringForm('close');}
	}
	function config()
	{
		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
	}
}
?>