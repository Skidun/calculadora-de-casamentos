<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoiva	          = $_SESSION["EMAIL"];
	$action               = mysql_real_escape_string($_POST["action"]);
	$updateRecordsArray   = $_POST["recordsArray"];
    
    $listingCounter       = 1;
	//Verifica se existem OrdemItem
    if($action == "updateRecordsListings"){
    foreach($updateRecordsArray as $recordIDValue){
	
    $sqlOrdemItem	= "UPDATE cn_intens SET ordemItem = :ordemItem WHERE idItem = :idItem"; 
	try{
		$queryOrdemItem	=	$conecta->prepare($sqlOrdemItem);
		$queryOrdemItem->bindValue(':ordemItem', $listingCounter, PDO::PARAM_STR);
		$queryOrdemItem->bindValue(':idItem', $recordIDValue, PDO::PARAM_STR);
		$queryOrdemItem->execute();
	}catch(PDOexception $errorOrdemItem){echo "Erro ao reodenar os itens ".$errorOrdemItem->getMessage();}
    
    echo '<pre>';
	print_r($updateRecordsArray);
	echo '</pre>';
	echo 'If you refresh the page, you will see that records will stay just as you modified.';
    
    }
 }



?>