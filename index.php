<?php session_start();
// we've writen this code where we need
function __autoload($classname) {
    $filename = "class/". $classname .".php";
    include_once($filename);
	}
//include("class.php");  
$cl_styl = "active";
$log = new logmein();     //инициализация класса
$log->dbconnect();        //подключаем базу
$log->encrypt = false;	      //true если пароль в md5.
//<? echo $tex->getStringForm('abitur');
$curr_year = date("Y");
?>
<!DOCTYPE html>
<html lang="en" xmlns:ice="http://ns.adobe.com/incontextediting">
<head>
<meta charset="utf-8">
<?
$txxt = new indexStringData();
?>
<title><? echo $txxt->indexStringData("abitur").$curr_year; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="css/css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="datepick/ui.datepicker.css" type="text/css" media="screen" />
<link href="dialog/css/docs.css" rel="stylesheet">
<link href="dialog/css/prettify.css" rel="stylesheet">
<!--dialog -->
<script type="text/javascript" src="dialog/js/jquery.1.6.2.min.js"></script>
<!--<script type="text/javascript" src="dialog/js/jquery.controls.js"></script>
<script type="text/javascript" src="dialog/js/jquery.form.js"></script>-->
<script type="text/javascript" src="dialog/js/jquery.dialog2.js"></script>
<script type="text/javascript" src="dialog/js/jquery.dialog2.helpers.js"></script>
<script type="text/javascript" src="dialog/js/prettify.js"></script>
<!-- datepicker jQuery -->
<script type="text/javascript" src="datepick/jquery-1.2.6.min.js"></script>
<!-- datepicker jQuery UI -->
<script type="text/javascript" src="datepick/jquery-ui-personalized-1.5.3.packed.js"></script>
<!-- RUS datepicker`a -->
<script type="text/javascript" src="datepick/ui.datepicker-ru.js"></script>
<script type="text/javascript">
/*<![CDATA[*/
	var $d = jQuery.noConflict();
	var i=1;
	var e=1;
		$d(document).ready(function() {
		// in RUS
		$d.datepicker.setDefaults($d.datepicker.regional['ru']);
		$d('#datepicker_birth').datepicker();
		$d('#datepicker_pas').datepicker();
		$d('#datepicker_doc').datepicker();
		$d('#datepicker_pod').datepicker();
		$d('#datepicker_dog').datepicker();
		$d('#datepicker_xml').datepicker();
		$d('#datepicker_orig').datepicker();
		//$d('#datepicker_2').datepicker();
		for (var i = 1; i <= 1000; i++) {
		$d('#datepicker_dog_'+i).datepicker();
		}
		for (var e = 1; e <= 1000; e++) {
		$d('#datepicker_opl_'+e).datepicker();
		}
		});
/* ]]> */
</script>
<script type="text/javascript">
$('#trigger').tooltip(string);
</script>
</head>
<!--
 style="-ms-user-select: none; -moz-user-select: none; -khtml-user-select: none; -webkit-user-select: none;"
-->
<body onLoad="$('#alert').dialog2('<? echo $_GET['open']; ?>'); return false" style="-ms-user-select: none; -moz-user-select: none; -khtml-user-select: none; -webkit-user-select: none;">
<div class="container-fluid">
  <div class="pguas"><img src="css/img/log.png" width="120" height="120" align="middle"><strong><? echo $txxt->indexStringData("pguas");?></strong>
    <div id="login">
      <?
// we've called a class login

if($_GET['type']=="ais"){
	$log->login_with_ais("pass", $_GET['login'], $_GET['pass']);  
}
	
if (empty($_SESSION['nnname'])) {
	
	$log->loginform("loginformname", "form-inline", "index.php?pages=0&cl=1");

if($_REQUEST['action'] == "login"){

if($log->login("logon", $_REQUEST['username'], $_REQUEST['password']) == true){
  
			
	
// Uzername
$_SESSION['nnname'] = $_REQUEST['username'];
// Uzer level
$_SESSION['levl'] = $_SESSION['userlevel'];
$_SESSION['iduser'] = $_SESSION['userid'];

header('Location: index.php');
}else{
// ne poluchilos	
echo $txxt->indexStringData("wrong");

}
}
}

if (!empty($_SESSION['nnname'])) {
	echo "<span class='label label-info'><h5>";
	//echo "уровень: ".$_SESSION['iduser']."<br>"; 
	echo $txxt->indexStringData("hello").$_SESSION['nnname'];
	echo "!&nbsp;</h5></span><br>";
	echo "<a href='login.php'>";
	echo $txxt->indexStringData("log_out");
	echo "</a>";
}
?>
    </div>
  </div>
  <div class="row-fluid">
    <div class="span3">
      <div class="well sidebar-nav">
        <? 
	 // if($_GET['type']=="ais"){
		  //echo "123";
		//  $log->login_with_ais("pass", $_GET['login'], $_GET['pass']);
			//}
	  
	  ?>
        <ul class="nav nav-list">
          <li class="nav-header"><? echo $txxt->indexStringData("priem");?></li>
          <li class="<? if ($_GET['cl']==1) {echo "active";} ?>"><a href="index.php?pages=0&cl=1"><? echo $txxt->indexStringData("fulltap");?></a></li>
          <? if (isset($_SESSION['nnname'])) {
            // секретари и админ ?>
          <? if ($_SESSION['levl'] < 4) {
		  ?>
          <li class="<? if ($_GET['cl']==2) {echo $cl_styl;} ?>"><a href="index.php?pages=1&cl=2"><? echo $txxt->indexStringData("check");?></a></li>
          <li class="<? if ($_GET['cl']==3) {echo $cl_styl;} ?>"><a href="index.php?pages=2&cl=3"><? echo $txxt->indexStringData("priem_doc");?></a></li>
          <li class="<? if ($_GET['cl']==4) {echo $cl_styl;} ?>"><a href="index.php?pages=3&cl=4"><? echo $txxt->indexStringData("napravl");?></a></li>
          <?
		  }
          if ($_SESSION['levl'] < 3) {	
		  //<li class="< ? if ($_GET['cl']==25) {echo $cl_styl;} ? >"><a href="index.php?pages=24&cl=25"><? echo $txxt->indexStringData("celevik");? ></a></li>
          ?>
          <li class="<? if ($_GET['cl']==5) {echo $cl_styl;} ?>"><a href="index.php?pages=4&cl=5"><? echo $txxt->indexStringData("marks");?></a></li> 
          <li class="<? if ($_GET['cl']==26) {echo $cl_styl;} ?>"><a href="index.php?pages=25&cl=26"><? echo $txxt->indexStringData("marks_prot");?></a></li> 
          <li class="<? if ($_GET['cl']==6) {echo $cl_styl;} ?>"><a href="index.php?pages=5&cl=6"><? echo $txxt->indexStringData("zachisl");?></a></li>
          <li class="<? if ($_GET['cl']==23) {echo $cl_styl;} ?>"><a href="index.php?pages=22&cl=23"><? echo $txxt->indexStringData("prikaz");?></a></li>
          <?
		  }
		   if ($_SESSION['levl'] < 3) {
		  ?>
          <li class="<? if ($_GET['cl']==12) {echo $cl_styl;} ?>"><a href="index.php?pages=11&cl=12"><? echo $txxt->indexStringData("vostanovl");?></a></li>
          <li class="<? if ($_GET['cl']==13) {echo $cl_styl;} ?>"><a href="index.php?pages=12&cl=13"><? echo $txxt->indexStringData("protok_vost");?></a></li>
          <? 
		  echo '<hr>';
		  }// админ 
		  if ($_SESSION['levl'] < 3){
		  ?>
          <li class="nav-header"><? echo $txxt->indexStringData("admin");?></li> 
          <? 
          if ($_SESSION['levl'] == 1){
          ?>
          <li class="<? if ($_GET['cl']==24) {echo $cl_styl;} ?>"><a href="index.php?pages=23&cl=24"><? echo $txxt->indexStringData("check_abit");?></a></li>
          <? 
          }
          ?>

          <li class="<? if ($_GET['cl']==16) {echo $cl_styl;} ?>"><a href="index.php?pages=15&cl=16" target="_blank"><? echo $txxt->indexStringData("import");?></a></li>
          <li class="<? if ($_GET['cl']==25) {echo $cl_styl;} ?>"><a href="index.php?pages=24&cl=25"><? echo $txxt->indexStringData("choice");?></a></li>
		  <?
		  echo '<hr>'; 
		  }// приемная 
		  if ($_SESSION['levl'] < 3) {	
		  ?>
          <li class="<? if ($_GET['cl']==19) {echo $cl_styl;} ?>"><a href="index.php?pages=18&cl=19"><? echo $txxt->indexStringData("orig");?></a></li>
          <li class="<? if ($_GET['cl']==21) {echo $cl_styl;} ?>"><a href="index.php?pages=20&cl=21"><? echo $txxt->indexStringData("change");?></a></li>
          <li class="<? if ($_GET['cl']==22) {echo $cl_styl;} ?>"><a href="index.php?pages=21&cl=22"><? echo $txxt->indexStringData("zh_dell");?></a></li>
          <li class="<? if ($_GET['cl']==7) {echo $cl_styl;} ?>"><a href="index.php?pages=6&cl=7"><? echo $txxt->indexStringData("reports");?></a></li>
          <li class="<? if ($_GET['cl']==20) {echo $cl_styl;} ?>"><a href="index.php?pages=19&cl=20"><? echo $txxt->indexStringData("sql");?></a></li>
          <li class="<? if ($_GET['cl']==8) {echo $cl_styl;} ?>"><a href="index.php?pages=7&cl=8"><? echo $txxt->indexStringData("statistic");?></a></li>
          <li class="<? if ($_GET['cl']==17) {echo $cl_styl;} ?>"><a href="index.php?pages=16&cl=17&nap=1"><? echo $txxt->indexStringData("zurn");?></a></li>
          <? 
		  echo '<hr>';  
		  }
		   // маркетинг 
		  if ($_SESSION['levl'] <3 or $_SESSION['levl'] == 4) {
			?>
          <li class="nav-header"><? echo $txxt->indexStringData("market");?></li> 
          <li class="<? if ($_GET['cl']==18) {echo $cl_styl;} ?>"><a href="index.php?pages=17&cl=18"><? echo $txxt->indexStringData("marketing");?></a></li>
          <li class="<? if ($_GET['cl']==14) {echo $cl_styl;} ?>"><a href="index.php?pages=13&cl=14"><? echo $txxt->indexStringData("market_posl");?></a></li>
          <li class="<? if ($_GET['cl']==11) {echo $cl_styl;} ?>"><a href="index.php?pages=10&cl=11"><? echo $txxt->indexStringData("market_report");?></a></li>
          <? 
		  echo '<hr>';}
          }
		  // статистика и поиск
//********************************************************************** ПРОВЕРКА НА IP АДРЕС
        //$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		//$a=explode(".",$ip);
		//$intip = $a[0]*256*256*256+$a[1]*256*256+$a[2]*256+$a[3];
		//if (($intip < 3232301055 and $intip > 3232235520)){
//********************************************************************** ПРОВЕРКА НА IP АДРЕС
        ?>
          <li class="<? if ($_GET['cl']==9) {echo $cl_styl;} ?>"><a href="index.php?pages=8&cl=9&nap=1"><? echo $txxt->indexStringData("spis");?></a></li>

		<?
//********************************************************************** ПРОВЕРКА НА IP АДРЕС		
		//}
//********************************************************************** ПРОВЕРКА НА IP АДРЕС		
		?>

        
        <li class="<? if ($_GET['cl']==15) {echo $cl_styl;} ?>"><a href="index.php?pages=14&cl=15"><? echo $txxt->indexStringData("search");?></a></li>
        </ul>
      </div>
        
      <!--/.well --> 
    </div>

    <!--/span--> 
    <!--/show dialog save information-->
    <div id="alert">
      <p>
        <? 
	  if ($_GET['open'] == "open" and !isset($_GET['err'])){
	  echo $txxt->indexStringData("save_inf");
	  }
	  elseif ($_GET['open'] == "open" and $_GET['err'] == "error"){
	  echo $txxt->indexStringData("error");
	  }?>
      </p>
    </div>
    <script type="text/javascript">
    $(function() {
        $("#alert").dialog2({
            title: "<? echo $txxt->indexStringData("save");?>", 
            autoOpen: false,
            buttons: {
                Close: { 
                    primary: true, 
                    click: function() {
                        $(this).dialog2("close");
						//var id = 0;
						//window.location.href = 'index.php?id='+id;
                    }
                }
            }, 
            removeOnClose: false
        }); 
    });
</script> 
    <!--/hide dialog save information-->
    
    <div class="span9">
      <div class="row-fluid">
        <?
		switch ($_GET['pages']) {
    case 0:   
	    $form = new formaAbiturAnketa();
		break;
    case 1:	
	if (isset($_SESSION['nnname'])) {	
		$check = new checkAbiturAnketa();
		if (isset($_GET['id'])){
			$check->lookInfoAbityr($_GET['id']);
		}
		else{       
			$check->checkAbiturForm();
			$check->checkAbitur($_POST['search'], $_POST['sub']);
		}
		}
	else { echo $txxt->indexStringData("zapret");
	}
        break;
    case 2:
	if (isset($_SESSION['nnname'])) {
	
        $apply = new applyDataAbitur();
		
		if (isset($_GET['id'])){
			$apply->applyInfoAbityr($_GET['id']);
		}
		else{       
			$apply->applyAbiturForm();
			$apply->applyLookAbitur($_POST['search'], $_POST['sub']);
		}
	}
	else { echo $txxt->indexStringData("zapret");
	}
        break;
	case 3:
	if (isset($_SESSION['nnname'])) {
		$printing = new printAbiturAnketa();
		if (isset($_GET['id'])){

			if (isset($_GET['edit']) and isset($_GET['zh']))
			{
				$printing->printEditAbitur($_GET['zh'], $_GET['id']);
				}			
			if (isset($_GET['dell']) and isset($_GET['zh']))
			{
				$printing->printDellAbitur($_GET['zh'], $_GET['id']);
				}
			$printing->printLookAbitur($_GET['id']);
		}
		else{ 
			$printing->printAbiturForm();
			$printing->printInfoAbityr($_POST['search'], $_POST['sub']);      
		}
		}
	else { echo $txxt->indexStringData("zapret");
	}
        break;
	case 4:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] == 1 or $_SESSION['levl'] == 2)) {
       	$mark = new marksForAbitur();
	
		if (isset($_GET['id'])){
			$mark->lookInfoAbityr($_GET['id']);
		}
		else{       
			$mark->marksForAnketa();
			$mark->checkAbitur($_POST['search'], $_POST['sub']);
		}
		}
	else { echo $txxt->indexStringData("zapret");
	}
        break;
		
	case 5:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 4)) {
	  	$zachislen = new zachisForAbitur();
	
		if (isset($_GET['sp']))
		{
			$zachislen->zachFormaAbit();
		}	
		$zachislen->zachForAbit();
       
			}
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 6:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
        $reprt = new reportForAbitur();
		$reprt->rprtForAbit();
			}
	else { echo $txxt->indexStringData("zapret");
	}
	break;
	case 7:
	$stat = new statisticaForAbitur();
		$stat->statForAbit();	
		break;
	case 8:
	$stat = new statisticaForAbitur();
	if (isset($_GET['nap']))
		{
			
			if (isset($_GET['spec']))
			{
			
				if (isset($_GET['spec']) and isset($_GET['otd']))
				{
					$stat->otdForAbit($_GET['spec'], $_GET['otd']);
				}
				else{
				$stat->specForAbit($_GET['spec']);
				}
			}
			else{
		$stat->spisForAbit();
			}
		}
	break;
	case 9:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3 or $_SESSION['levl'] == 4)) {
	$kontr = new kontraktForAbitur();
	
		if (isset($_GET['sp']))
		{
			$kontr->editFormaAbit();
		}	
		$kontr->kontForAbit();
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 10:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3 or $_SESSION['levl'] == 4)) {
	$svod_mark = new reportForMarket();
	$svod_mark->rprtForMarket();
	
	
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 11:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 4)) {

	        $vostan = new vostanDataAbitur();
			$vostan->applyInfoAbityr();
			/*
		if (isset($_GET['id'])){
			$vostan->applyInfoAbityr($_GET['id']);
		}
		else{       
			$vostan->vostanAbiturForm();
			$vostan->applyLookAbitur($_POST['search'], $_POST['sub']);
		}
		*/
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 12:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] <= 4)) {
	$prot_vos = new vostanAbiturProtoc();
		if (isset($_GET['id'])){
	
			if (isset($_GET['dell']) and isset($_GET['zh']))
			{
				$prot_vos->printDellAbitur($_GET['zh']);
				}
			$prot_vos->printLookAbitur($_GET['id']);
		}
		else{ 
			$prot_vos->printAbiturForm();
			$prot_vos->printInfoAbityr($_POST['search'], $_POST['sub']);      
		}
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 13:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] == 4 or $_SESSION['levl'] < 3)) {
	$kontr_vost = new kontraktForVostan();
	
		if (isset($_GET['sp']))
		{
			$kontr_vost->editFormaAbit();
		}	
		$kontr_vost->kontForAbit();
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 14:
		
		$printing = new searchAbiturAnketa();
		if (isset($_GET['id'])){

			if (isset($_GET['edit']) and isset($_GET['zh']))
			{
				$printing->printEditAbitur($_GET['zh'], $_GET['id']);
				}			
			if (isset($_GET['dell']) and isset($_GET['zh']))
			{
				$printing->printDellAbitur($_GET['zh']);
				}
			$printing->printLookAbitur($_GET['id']);
		}
		else{ 
			$printing->printAbiturForm();
			$printing->printInfoAbityr($_POST['search'], $_POST['sub']);      
		}
		
        break;
	case 15:
		
		$import = new importXml();
		$import->formaDataImport();
		
		if (isset($_GET['dat'])){
			
		}
		
        break;
	case 16:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] == 4 or $_SESSION['levl'] < 3)) {
	$stat_zur = new zurnalForAbitur();
	if (isset($_GET['nap']))
		{
			
			if (isset($_GET['spec']))
			{
			
				if (isset($_GET['spec']) and isset($_GET['otd']))
				{
					$stat_zur->otdForAbit($_GET['spec'], $_GET['otd']);
				}
				else{
				$stat_zur->specForAbit($_GET['spec']);
				}
			}
			else{
		$stat_zur->spisForAbit();
			}
		}
		}
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 17:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] == 4 or $_SESSION['levl'] < 3)) {
	$kontr_dog = new printAbiturDogovor();
	
		if (isset($_GET['id'])){
			$kontr_dog->editFormaDogovor($_GET['id']);
		}
		else{       
			$kontr_dog->printAbitur();
			$kontr_dog->printInfoAbityr($_POST['search'], $_POST['sub']);
		}
		
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	
	case 18:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
	$original = new vazvratAbiturOriginal();
	$original->formaDataAbitur();
	
	if ($_GET['vozv_date'] <> ""){
		$original->datAbiturVozvrat($_GET['vozv_date']);
		}
	if ($_GET['all'] <> ""){
		$original->allAbiturVozvrat($_GET['all']);
		}
	}
	
	else { echo $txxt->indexStringData("zapret");}
	break;
	
	case 19:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
	$konstr= new konstruktorForAbitur();
	$konstr->rprtForAbit();
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	
	case 20:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
	$original = new changeAbiturZhur();
	$original->formaDataAbitur();
	
	if ($_GET['change_date'] <> "" and !isset($_GET['all'])){
		$original->datAbiturChange($_GET['change_date'], $_GET['sort_type_change']);
		}
	if (isset($_GET['all'])){
		$original->allAbiturChange($_GET['sort_type_change']);
		}
	if (isset($_GET['sort_type_change']) and !isset($_GET['all']) and $_GET['change_date'] == ""){
		$original->allAbiturChange($_GET['sort_type_change']);
		}
	}
	
	else { echo $txxt->indexStringData("zapret");}
	break;
	
	case 21:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
	$original = new deletedAbiturZhur();
	$original->formaDataAbitur();
	
	if ($_GET['change_date'] <> "" and !isset($_GET['all'])){
		$original->datAbiturDel($_GET['change_date'], $_GET['sort_type_change']);
		}
	if (isset($_GET['all'])){
		$original->allAbiturDel($_GET['sort_type_change']);
		}
	if (isset($_GET['sort_type_change']) and !isset($_GET['all']) and $_GET['change_date'] == ""){
		$original->allAbiturDel($_GET['sort_type_change']);
		}
	}
	
	else { echo $txxt->indexStringData("zapret");}
	break;
	case 22:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
	$prikaz = new prikazAbiturZhur();
	if (!isset($_GET['prik'])){
		$prikaz->formaPrikazAbitur();
	}
	if (isset($_GET['prik'])){
		$prikaz->showPrikazAbitur($_GET['prik'], $_GET['dat']);
	
	}
	}
	else { echo $txxt->indexStringData("zapret");}
	break;
	/*
	case 22:
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] == 1 or $_SESSION['levl'] == 2)) {
	$prikaz = new prikazAbiturZhur();
	if (!isset($_GET['otdelenie']) and !isset($_GET['kontrakt'])){
	$prikaz->formaPrikazAbitur();
	}
	if (isset($_GET['otdelenie']) and isset($_GET['kontrakt'])){
		$prikaz->showPrikazAbitur($_GET['otdelenie'], $_GET['kontrakt'], $_GET['type_prik']);
	}
	}
	
	else { echo $txxt->indexStringData("zapret");}
	break;
	*/
	case 23: //проверка заявления
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
		$prover = new checkDataAbitur();
	
	if (!isset($_GET['fio'])){
		$prover->formaDataAbitur();
	}
	
	if (isset($_GET['fio']) and $_GET['fio'] <> ""){
		$prover->formaDataAbitur();
		$prover->proverZhurnAbit($_GET['fio']);	
		
		if (isset($_GET['id_zh']) and isset($_GET['id_st'])){
			$prover->saveZhurnalChangeID($_GET['id_zh'], $_GET['id_st'], $_GET['fio']);
		}
		}
	}
	
	else { echo $txxt->indexStringData("zapret");}
	break;
	

	case 24: //справочники
	if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
		$choice = new insertTableData();
	if (!isset($_GET['fl'])){
		$choice->choiceTableData();
	}
	if ($_GET['fl'] == 1){
		$choice->napravlTableData();
		}
	if ($_GET['fl'] == 2){
		if ($_GET['kon'] == 1){
			$choice->planTableData();
		}
		if ($_GET['kon'] == 2){
			$choice->planTableDataK();
		}
		if ($_GET['kon'] == 3){
			$choice->planTableDataCP();
		}
		}	
	if ($_GET['fl'] == 3){
		$choice->priceTableData();
		}
	if ($_GET['fl'] == 4){
		$choice->sobesTableData();
		}
	if ($_GET['fl'] == 5){
		$choice->protocolTableData();
		}
	if ($_GET['fl'] == 6){
		$choice->decanTableData();
		}
	if ($_GET['fl'] == 7){
		$choice->lgotaTableData();
		}
	if ($_GET['fl'] == 8){
		$choice->kyrsTableData();
		}
	if ($_GET['fl'] == 9){
		$choice->specvostTableData();
		}
	if ($_GET['fl'] == 10){
		$choice->predvostTableData();
		}
	if ($_GET['fl'] == 11){
		$choice->loginTableData();
		}
	}
	
	else { echo $txxt->indexStringData("zapret");}
	break;

	case 25:
		if ((isset($_SESSION['nnname'])) and ($_SESSION['levl'] < 3)) {
			$mark_prot = new dataProtokolMarks();
			//$mark_prot->dataProtokolMarks();
			//if (){
			//	$mark_prot->viewProtokolMarks();
			//}
		}
		else { echo $txxt->indexStringData("zapret");}
	break;

	
}
	  ?>
        <!--/span--> 
      </div>
      <!--/row--> 
    </div>
    <!--/span--> 
  </div>
  <!--/row-->
  <hr>
  <footer>
    <p>&copy;<? echo $txxt->indexStringData("since"); ?></p>
  </footer>
</div>

<!--/.fluid-container-->
</body>
</html>