<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoivaDel	= $_SESSION["EMAIL"];
	$idItemDel	= $_GET["id"];
    $sqlDelItem	= "SELECT * FROM cn_itens WHERE idItem = :idItemDel";
	try{
		$queryDelItem	=	$conecta->prepare($sqlDelItem);
		$queryDelItem->bindValue(':idItemDel', $idItemDel, PDO::PARAM_STR);
		$queryDelItem->execute();
					
		$resultDelItem = $queryDelItem->fetchAll(PDO::FETCH_ASSOC);
				
	}catch(PDOexception $errorDelItem){echo $errorDelItem->getMessage();}
	foreach($resultDelItem as $deleteItem){
		$idItemDelete	=	$deleteItem["idItem"];
		$nomeItemDelete	=	$deleteItem["nomeItem"];
		$idNoivaDelete	=	$deleteItem["idNoiva"];
	$result = array(
					"idItemResult" 		=> "$idItemDelete",
					"nomeItemResult" 	=> "$nomeItemDelete",
					"idNoivaResult" 	=> "$idNoivaDelete" 
				);
	}
	echo json_encode($result);	
						
?>