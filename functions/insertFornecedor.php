<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoiva			= $_SESSION["EMAIL"];
	$nomeFornecedor		= $_GET["nomeFornecedor"];
	$contatoFornecedor	= $_GET["contatoFornecedor"];
	$emailFornecedor	= $_GET["emailFornecedor"]; 
	$valorFornecedor	= str_replace(',','.',str_replace('.','',$_GET["valorFornecedor"]));
	$obsFornecedor		= $_GET["obsFornecedor"];
	$idSubItem			= $_GET["idSubItem"];
	//pegar o id do Item na qual o subitem pertence
	$sqlSubItem = "SELECT idSubItem, idItem  FROM cn_subitens WHERE idSubItem = :idSubItem";
	try{
		$querySubItem = $conecta->prepare($sqlSubItem);
		$querySubItem->bindValue(':idSubItem', $idSubItem, PDO::PARAM_STR);
		$querySubItem->execute();
		
		$resultSubItem = $querySubItem->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $errorSubItem){echo $errorSubItem->getMessage();}
	foreach($resultSubItem as $dadosSubItem){
		$idItem		=	$dadosSubItem["idItem"];
		}
		echo $idItem;
	//Verifica se existem CadFornecedor
	$sqlCadFornecedor	= "INSERT INTO cn_fornecedores (nomeFornecedor, contatoFornecedor, emailFornecedor, valorFornecedor, obsFornecedor, idItem, idSubItem, idNoiva)";
	$sqlCadFornecedor  .= "VALUE(:nomeFornecedor, :contatoFornecedor, :emailFornecedor, :valorFornecedor, :obsFornecedor, :idItem, :idSubItem, :idNoiva)";
	try{
		$queryCadFornecedor	=	$conecta->prepare($sqlCadFornecedor);
		$queryCadFornecedor->bindValue(':nomeFornecedor', $nomeFornecedor, PDO::PARAM_STR);
		$queryCadFornecedor->bindValue(':contatoFornecedor', $contatoFornecedor, PDO::PARAM_STR);
		$queryCadFornecedor->bindValue(':emailFornecedor', $emailFornecedor, PDO::PARAM_STR);
		$queryCadFornecedor->bindValue(':valorFornecedor', $valorFornecedor, PDO::PARAM_STR);
		$queryCadFornecedor->bindValue(':obsFornecedor', $obsFornecedor, PDO::PARAM_STR);
		$queryCadFornecedor->bindValue(':idItem', $idItem, PDO::PARAM_STR);
		$queryCadFornecedor->bindValue(':idSubItem', $idSubItem, PDO::PARAM_STR);
		$queryCadFornecedor->bindValue(':idNoiva', $idNoiva, PDO::PARAM_STR);
		$queryCadFornecedor->execute();
	}catch(PDOexception $errorCadFornecedor){echo $errorCadFornecedor->getMessage();}
	
	$result = array(
		"Sucesso" => true,
		"Mensagem"=> "Fornecedor Cadastrado com Sucesso"
	);
	echo json_encode($result);
?>