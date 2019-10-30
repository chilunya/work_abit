<?php 	
	$path = realpath(dirname(__FILE__).'/pear/');
	// подключаем
	set_include_path(dirname(__FILE__). PATH_SEPARATOR . $path);
	require_once('PEAR.php');
	
	require_once "Spreadsheet/Excel/Writer.php";
	
	// Создание случая 
	//$xls =& new Spreadsheet_Excel_Writer(); 

	// Передаем номер версии Excel
	$xls = new Spreadsheet_Excel_Writer('table.xls');
	$sheet =& $xls->addWorksheet('1');
	$xls->setTempDir('/xls/');
	//$sheet->write(0, 0, "did this work?");

/*
	$xls->setVersion(8);
	$sheet = $xls->addWorksheet('1');        // имя листа должно быть уникальным
	$sheet->setInputEncoding('UTF-8');
	$sheet->setColumn(0,120,5);
	for ($m=0;$m<=120;$m++){
		$n=14.24;
		$sheet->setRow($m,$n,0);
	}
	$list = $xls->addWorksheet('2');        // имя листа должно быть уникальным
	$list->setInputEncoding('UTF-8');
	$list->setColumn(0,120,5);
	for ($m=0;$m<=120;$m++){
		$n=14.24;
		$list->setRow($m,$n,0);
	}
	//$sheet->hideGridLines();
	*/
//****************************************	

		$dblocation = "192.168.5.112";
		$dbname = "Abitur";
		$dbuser = "asu";
		$dbpassword = "5Y7jwSzL2DyEAApt";
		
		$dbcnx = @mysql_connect($dblocation, $dbuser, $dbpassword);
		mysql_select_db($dbname, $dbcnx);
		
		@mysql_query("SET NAMES 'utf8'");
		
		 
//****************************************
	// Отправка HTTP заголовков для сообщения обозревателю о типе вxодимыx данныx  
	
	
	
		
		// Создание объекта форматирования 
		
		// ТЕКСТ ИЗ БАЗЫ ЖИРНЫЙ ПО СЕРЕДИНЕ С ОБВОДКОЙ
		$oneFormat =& $xls->addFormat();    // Определение размера текста 
		//$oneFormat->setAlign('center');  	// выравнимание
		//$oneFormat->setBold(); 				// жирный
		$oneFormat->setColor('black'); 
		//$oneFormat->setBorder(1);
		
		// ТЕКСТ ИЗ БАЗЫ ЖИРНЫЙ ПО СЕРЕДИНЕ БЕЗ ЛЮВОДКИ
		$cenFormat =& $xls->addFormat();    // Определение размера текста 
		//$cenFormat->setAlign('center');  	// выравнимание
		//$cenFormat->setBold(); 				// жирный
		$cenFormat->setColor('black'); 
		//$cenFormat->setBgColor(63);
		//$cenFormat->setFgColor('yellow');
		//$cenFormat->setPattern(1);

		// ТЕКСТ ИЗ БАЗЫ ЖИРНЫЙ ПО СЕРЕДИНЕ БЕЗ ЛЮВОДКИ
		$zagFormat =& $xls->addFormat();    // Определение размера текста 
		//$zagFormat->setAlign('center');  	// выравнимание
		//$zagFormat->setBold(); 				// жирный
		$zagFormat->setColor('black'); 
		//$zagFormat->setBorder(1);
		
		// ТЕКСТ ОБЫЧНЫЙ ПО ПРАВОМУ КРАЮ
		$twoFormat =& $xls->addFormat();
		//$twoFormat->setAlign('left');  	// выравнимание
		//$twoFormat->setBold(); 				// жирный
		$twoFormat->setColor('black'); 
		//$twoFormat->setBorder(1);
		
		//$borderC =& $xls->addFormat();
		//$borderC->setColor('black');
		//$borderC->setTextWrap();
		//$borderC->setBorder (1);
		//$borderC->setBottom (1);
		
// номера личных дел	
	/*
	$sheet->write(0, 0, 'ФИО', $cenFormat);  
	$sheet->write(0, 1, 'Р', $cenFormat);  
	$sheet->write(0, 2, 'М', $cenFormat);  
	$sheet->write(0, 3, 'Ф', $cenFormat);  
	$sheet->write(0, 4, 'О', $cenFormat);  
	$sheet->write(0, 5, 'Л', $cenFormat);  
	$sheet->write(0, 6, 'Балл ЕГЭ', $cenFormat);  
	$sheet->write(0, 7, 'Диз', $cenFormat);  
	$sheet->write(0, 8, 'Экон', $cenFormat);  
	$sheet->write(0, 9, 'Мен', $cenFormat);  
	$sheet->write(0, 10, 'ЗиК', $cenFormat);  
	$sheet->write(0, 11, 'ЭТМК', $cenFormat);  
	$sheet->write(0, 12, 'ТТП', $cenFormat);  
	$sheet->write(0, 13, 'СиМ', $cenFormat);  
	$sheet->write(0, 14, 'ИСТ', $cenFormat);  
	$sheet->write(0, 15, 'ТЛДП', $cenFormat);  
	$sheet->write(0, 16, 'Арх', $cenFormat);  
	$sheet->write(0, 17, 'Стр', $cenFormat);  
	$sheet->write(0, 18, 'ГС', $cenFormat);  
	$sheet->write(0, 19, 'СУЗС', $cenFormat);  
	$sheet->write(0, 20, 'ТБ', $cenFormat);  
	$sheet->write(0, 21, 'Льгота', $cenFormat); 
	 
	
	$list->write(0, 0, 'Диз', $zagFormat);  
	$list->write(0, 1, 'Экон', $zagFormat);  
	$list->write(0, 2, 'Мен', $zagFormat);  
	$list->write(0, 3, 'ЗиК', $zagFormat);  
	$list->write(0, 4, 'ЭТМК', $zagFormat);  
	$list->write(0, 5, 'ТТП', $zagFormat);  
	$list->write(0, 6, 'СиМ', $zagFormat);  
	$list->write(0, 7, 'ИСТ', $zagFormat);  
	$list->write(0, 8, 'ТЛДП', $zagFormat);  
	$list->write(0, 9, 'Арх', $zagFormat);  
	$list->write(0, 10, 'Стр', $zagFormat);  
	$list->write(0, 11, 'ГС', $zagFormat);  
	$list->write(0, 12, 'СУЗС', $zagFormat);  
	$list->write(0, 13, 'ТБ', $zagFormat); 
	
	$list->write(0, 14, 'Диз', $cenFormat);  
	$list->write(0, 15, 'Экон', $cenFormat);  
	$list->write(0, 16, 'Мен', $cenFormat);  
	$list->write(0, 17, 'ЗиК', $cenFormat);  
	$list->write(0, 18, 'ЭТМК', $cenFormat);  
	$list->write(0, 19, 'ТТП', $cenFormat);  
	$list->write(0, 20, 'СиМ', $cenFormat);  
	$list->write(0, 21, 'ИСТ', $cenFormat);  
	$list->write(0, 22, 'ТЛДП', $cenFormat);  
	$list->write(0, 23, 'Арх', $cenFormat);  
	$list->write(0, 24, 'Стр', $cenFormat);  
	$list->write(0, 25, 'ГС', $cenFormat);  
	$list->write(0, 26, 'СУЗС', $cenFormat);  
	$list->write(0, 27, 'ТБ', $cenFormat); 
	*/
	$sql_f = "SELECT DISTINCT INFO.fam, INFO.name, INFO.pred1, INFO.bal1, INFO.pred2, INFO.bal2, INFO.pred3, INFO.bal3, INFO.pred4, INFO.bal4, INFO.pred5, INFO.bal5, INFO.otch, ZHURNAL.IDstud, ZHURNAL.Otdelenie FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud WHERE ZHURNAL.Otdelenie = 1 ORDER BY INFO.fam";
	$res_f = mysql_query($sql_f);
	$i=1;
	//$n=2;
  		while($row_f = mysql_fetch_array($res_f))
		{ 

	$sheet->write($i, 0, $row_f['fam'].' '.$row_f['name'].' '.$row_f['otch'], $twoFormat);  
	//$sheet->mergeCells ($i,0,$i,25); // обединение _| _|	
	$pred1='';
	$pred2='';
	$pred3='';
	$pred4='';
	$pred5='';
	
	if ($row_f['pred1'] == 1){$pred1 = $row_f['bal1'];}
		elseif ($row_f['pred1'] == 2){$pred2 = $row_f['bal1'];}
		elseif ($row_f['pred1'] == 10){$pred3 = $row_f['bal1'];}
		elseif ($row_f['pred1'] == 9){$pred4 = $row_f['bal1'];}
		elseif ($row_f['pred1'] == 11){$pred5 = $row_f['bal1'];}

	if ($row_f['pred2'] == 1){$pred1 = $row_f['bal2'];}
		elseif ($row_f['pred2'] == 2){$pred2 = $row_f['bal2'];}
		elseif ($row_f['pred2'] == 10){$pred3 = $row_f['bal2'];}
		elseif ($row_f['pred2'] == 9){$pred4 = $row_f['bal2'];}
		elseif ($row_f['pred2'] == 11){$pred5 = $row_f['bal2'];}
		
	if ($row_f['pred3'] == 1){$pred1 = $row_f['bal3'];}
		elseif ($row_f['pred3'] == 2){$pred2 = $row_f['bal3'];}
		elseif ($row_f['pred3'] == 10){$pred3 = $row_f['bal3'];}
		elseif ($row_f['pred3'] == 9){$pred4 = $row_f['bal3'];}
		elseif ($row_f['pred3'] == 11){$pred5 = $row_f['bal3'];}

	if ($row_f['pred4'] == 1){$pred1 = $row_f['bal4'];}
		elseif ($row_f['pred4'] == 2){$pred2 = $row_f['bal4'];}
		elseif ($row_f['pred4'] == 10){$pred3 = $row_f['bal4'];}
		elseif ($row_f['pred4'] == 9){$pred4 = $row_f['bal4'];}
		elseif ($row_f['pred4'] == 11){$pred5 = $row_f['bal4'];}
		
	if ($row_f['pred5'] == 1){$pred1 = $row_f['bal5'];}
		elseif ($row_f['pred5'] == 2){$pred2 = $row_f['bal5'];}
		elseif ($row_f['pred5'] == 10){$pred3 = $row_f['bal5'];}
		elseif ($row_f['pred5'] == 9){$pred4 = $row_f['bal5'];}
		elseif ($row_f['pred5'] == 11){$pred5 = $row_f['bal5'];}


	
	$sheet->write($i, 1, $pred1, $zagFormat);  
	$sheet->write($i, 2, $pred2, $zagFormat);  
	$sheet->write($i, 3, $pred3, $zagFormat);  
	$sheet->write($i, 4, $pred4, $zagFormat);  
	$sheet->write($i, 5, $pred5, $zagFormat);  
	$n=$i+1;		
	$sheet->write($i, 6, '=SUM(B'.$n.':F'.$n.')', $zagFormat);  
	
	$sql_n = "SELECT ZHURNAL.Nomer_po_zhurn, ZHURNAL.Special, ZHURNAL.Priznak_doc, ZHURNAL.IDstud, ZHURNAL.ID_zh, SPEC.KratkoeName, LGOTAVNEKONK.LGOTAVNEKONK FROM INFO INNER JOIN ZHURNAL ON INFO.ID = ZHURNAL.IDstud INNER JOIN SPEC ON SPEC.ID = ZHURNAL.Special INNER JOIN LGOTAVNEKONK ON LGOTAVNEKONK.ID = ZHURNAL.lgot_vne WHERE ZHURNAL.IDstud = ".$row_f['IDstud']." ORDER BY ZHURNAL.ID_zh";
	$res_n = mysql_query($sql_n);
	while($row_n = mysql_fetch_array($res_n))
		{ 

		if ($row_n['Special']==1){
		if ($row_n['Priznak_doc']==1){$doc1 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc1 = "K";}
		else {$doc1 = "";}
	$sheet->write($i, 7, $doc1, $zagFormat);  
		}
	
		if ($row_n['Special']==2){
		if ($row_n['Priznak_doc']==1){$doc2 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc2 = "K";}
		else {$doc2 = "";}
	$sheet->write($i, 8, $doc2, $zagFormat);  
		}
		
		if ($row_n['Special']==3){
		if ($row_n['Priznak_doc']==1){$doc3 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc3 = "K";}
		else {$doc3 = "";}	
	$sheet->write($i, 9, $doc3, $zagFormat);  
		}
	

	if ($row_n['Special']==4){
		if ($row_n['Priznak_doc']==1){$doc4 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc4 = "K";}
		else {$doc4 = "";}	
	$sheet->write($i, 10, $doc4, $zagFormat);  
	}
	
	if ($row_n['Special']==5){
		if ($row_n['Priznak_doc']==1){$doc5 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc5 = "K";}
		else {$doc5 = "";}	
	$sheet->write($i, 11, $doc5, $zagFormat);  
	}
	
	if ($row_n['Special']==6){
		if ($row_n['Priznak_doc']==1){$doc6 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc6 = "K";}
		else {$doc6 = "";}	
	$sheet->write($i, 12, $doc6, $zagFormat);  
	}
	
	if ($row_n['Special']==7){
		if ($row_n['Priznak_doc']==1){$doc7 = "O"; }
		elseif ($row_n['Priznak_doc']==2) {$doc7 = "K";}
		else {$doc7 = "";}	
	$sheet->write($i, 13, $doc7, $zagFormat);  
	}
	
	if ($row_n['Special']==8){
		if ($row_n['Priznak_doc']==1){$doc8 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc8 = "K";}
		else {$doc8 = "";}	
	$sheet->write($i, 14, $doc8, $zagFormat);  
	}
	
	if ($row_n['Special']==9){
		if ($row_n['Priznak_doc']==1){$doc9 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc9 = "K";}
		else {$doc9 = "";}	
	$sheet->write($i, 15, $doc9, $zagFormat);  
	}
	
	if ($row_n['Special']==10){
		if ($row_n['Priznak_doc']==1){$doc10 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc10 = "K";}
		else {$doc10 = "";}	
	$sheet->write($i, 16, $doc10, $zagFormat);  
	}

		if ($row_n['Special']==11){
		if ($row_n['Priznak_doc']==1){$doc11 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc11 = "K";}
		else {$doc11 = "";}	
	$sheet->write($i, 17, $doc11, $zagFormat);  
		}
	
		if ($row_n['Special']==12){
		if ($row_n['Priznak_doc']==1){$doc12 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc12 = "K";}
		else {$doc12 = "";}	
	$sheet->write($i, 18, $doc12, $zagFormat);  
		}
	
		if ($row_n['Special']==13){
		if ($row_n['Priznak_doc']==1){$doc13 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc13 = "K";}
		else {$doc13 = "";}	
	$sheet->write($i, 19, $doc13, $zagFormat);  
		}
	
		if ($row_n['Special']==14){
		if ($row_n['Priznak_doc']==1){$doc14 = "O";}
		elseif ($row_n['Priznak_doc']==2) {$doc14 = "K";}
		else {$doc14 = "";}	
	$sheet->write($i, 20, $doc14, $zagFormat);  
		}

	$sheet->write($i, 21, $row_n['LGOTAVNEKONK'], $zagFormat);  
		
		
		
	

	

			
		}
	$i=$i+1;
		}

	//for ($m=1; $m<$i; $m++){
	//	$n=$m+1;
	//$table="'table'";
	$list->write(1, 0, '=IF("1"!H2="O";1;"")', $zagFormat); //1
	/*
	$list->write($m, 1, '=IF("table"!I'.$m.'="O";1;"")', $zagFormat); //2
	$list->write($m, 2, '=IF("table"!J'.$m.'="O";1;"")', $zagFormat); //3
	$list->write($m, 3, '=IF("table"!K'.$n.'="O";1;"")', $zagFormat); //4
	$list->write($m, 4, '=IF("table"!L'.$n.'="O";1;"")', $zagFormat); //5
	$list->write($m, 5, '=IF("table"!M'.$n.'="O";1;"")', $zagFormat); //6
	$list->write($m, 6, '=IF("table"!N'.$n.'="O";1;"")', $zagFormat); //7
	$list->write($m, 7, '=IF("table"!O'.$n.'="O";1;"")', $zagFormat); //8
	$list->write($m, 8, '=IF("table"!P'.$n.'="O";1;"")', $zagFormat); //9
	$list->write($m, 9, '=IF("table"!Q'.$m.'="O";1;"")', $zagFormat); //10
	$list->write($m, 10, '=IF("table"!R'.$n.'="O";1;"")', $zagFormat); //11
	$list->write($m, 11, '=IF("table"!S'.$m.'="O";1;"")', $zagFormat); //12
	$list->write($m, 12, '=IF("table"!T'.$n.'="O";1;"")', $zagFormat); //13
	$list->write($m, 13, '=IF("table"!U'.$n.'="O";1;"")', $zagFormat); //14
	*/
	//}

	//for ($z=1; $z<$m; $z++){
	//	$n=$z+1;
	 	//1
	//$sheet->write($z, 36, '=IF(W'.$n.'=1;SUM(W2:W'.$n.');IF(H'.$n.'="K";"K";""))', $zagFormat);  		//1
	//$sheet->write($m, 37, '=IF(X'.$n.'=1;SUM(X$2:X'.$n.');IF(I'.$n.'="K";"K";""))', $zagFormat);  	//2
	//$sheet->write($m, 38, '=IF(Y'.$n.'=1;SUM(Y$2:Y'.$n.');IF(J'.$n.'="K";"K";""))', $zagFormat);  	//3
	
	//$sheet->write($m, 39, '=IF(Z'.$n.'=1;SUM(Z$2:Z'.$n.');IF(K'.$n.'="K";"K";""))', $zagFormat);  	//4
	//$sheet->write($m, 40, '=IF(AA'.$n.'=1;SUM(AA$2:AA'.$n.');IF(L'.$n.'="K";"K";""))', $zagFormat);  	//5
	//$sheet->write($m, 41, '=IF(AB'.$n.'=1;SUM(AB$2:AB'.$n.');IF(M'.$n.'="K";"K";""))', $zagFormat);  	//6
	//$sheet->write($m, 42, '=IF(AC'.$n.'=1;SUM(AC$2:AC'.$n.');IF(N'.$n.'="K";"K";""))', $zagFormat);  	//7
	//$sheet->write($m, 43, '=IF(AD'.$n.'=1;SUM(AD$2:AD'.$n.');IF(O'.$n.'="K";"K";""))', $zagFormat);  	//8
	//$sheet->write($m, 44, '=IF(AE'.$n.'=1;SUM(AE$2:AE'.$n.');IF(P'.$n.'="K";"K";""))', $zagFormat);  	//9
	
	//$sheet->write($m, 45, '=IF(AF'.$n.'=1;SUM(AF$2:AF'.$n.');IF(Q'.$n.'="K";"K";""))', $zagFormat);  	//10
	
	//$sheet->write($m, 46, '=IF(AG'.$n.'=1;SUM(AG$2:AG'.$n.');IF(R'.$n.'="K";"K";""))', $zagFormat);  	//11
	
	
	//$sheet->write($m, 47, '=IF(AH'.$n.'=1;SUM(AH$2:AH'.$n.');IF(S'.$n.'="K";"K";""))', $zagFormat);  	//12
	
	//$sheet->write($m, 48, '=IF(AI'.$n.'=1;SUM(AI$2:AI'.$n.');IF(T'.$n.'="K";"K";""))', $zagFormat);  	//13
	//$sheet->write($m, 49, '=IF(AJ'.$n.'=1;SUM(AJ$2:AJ'.$n.');IF(U'.$n.'="K";"K";""))', $zagFormat);	//14
	
	//}
	
	//for ($z=1; $z<$m; $z++){
	//	$n=$z+1;
	 	//1
	//$sheet->write($z, 36, '=IF(W'.$n.'=1;SUM(W2:W'.$n.');IF(H'.$n.'="K";"K";""))', $zagFormat);  	//1
	//$sheet->write($m, 37, '=IF(X'.$n.'=1;SUM(X$2:X'.$n.');IF(I'.$n.'="K";"K";""))', $zagFormat);  	//2
	//$sheet->write($m, 38, '=IF(Y'.$n.'=1;SUM(Y$2:Y'.$n.');IF(J'.$n.'="K";"K";""))', $zagFormat);  	//3
	/*
	$sheet->write(1, 39, '=IF(Z2=1;SUM(Z$2:Z2);"")', $zagFormat);  	//4
	$sheet->write(1, 40, '=IF(AA2=1;SUM(AA$2:AA2);"")', $zagFormat);  	//5
	$sheet->write(1, 41, '=IF(AB2=1;SUM(AB$2:AB2);"")', $zagFormat);  	//6
	$sheet->write(1, 42, '=IF(AC2=1;SUM(AC$2:AC2);"")', $zagFormat);  	//7
	$sheet->write(1, 43, '=IF(AD2=1;SUM(AD$2:AD2);"")', $zagFormat);  	//8
	$sheet->write(1, 44, '=IF(AE2=1;SUM(AE$2:AE2);"")', $zagFormat);  	//9
	
	//$sheet->write($m, 45, '=IF(AF2=1;SUM(AF$2:AF2);IF(Q2="K";"K";""))', $zagFormat);  	//10
	
	$sheet->write(1, 46, '=IF(AG2=1;SUM(AG$2:AG2);"")', $zagFormat);  	//11
	
	
	//$sheet->write($m, 47, '=IF(AH2=1;SUM(AH$2:AH2);IF(S2="K";"K";""))', $zagFormat);  	//12
	
	$sheet->write(1, 48, '=IF(AI2=1;SUM(AI$2:AI2);"")', $zagFormat);  	//13
	$sheet->write(1, 49, '=IF(AJ2=1;SUM(AJ$2:AJ2);"")', $zagFormat);	//14
	*/
	//}	
	//$xls->send('table.xls');  //название файла excel_17_16_18.xls
	$xls->close();
	mysql_close($dbcnx);
		

?>