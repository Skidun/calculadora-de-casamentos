<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	$dbhost							= "localhost";
    $dbuser							= "calcnoiva_adm";
    $dbpass							= "c8*HlBn6*JF0";
    $dbname							= "calcnoiva_db";
    
    $conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to mysql");
    mysql_select_db($dbname);
	//Prepara Item para ser excluido
	$idNoiva	          = $_SESSION["EMAIL"];
	$action               = mysql_real_escape_string($_POST['action']);
	$updateRecordsArray   = $_POST["recordsArray"];
    
    
	//Verifica se existem OrdemItem
    if($action == "updateRecordsListings"){
        $listingCounter = 1;
        foreach($updateRecordsArray as $recordIDValue){
    	$listingCounter = $listingCounter + 1;
        $query	= "UPDATE cn_itens SET ordemItem = ".$listingCounter." WHERE idItem = ".$recordIDValue; 
    	
        mysql_query($query) or die('Erro ao executar Query '.mysql_error());
		
        $listingCounter = $listingCounter + 1;
        
        echo '<pre>';
    	print_r($updateRecordsArray);
    	echo '</pre>';
    	echo 'If you refresh the page, you will see that records will stay just as you modified.';
    
    }
 }



?>