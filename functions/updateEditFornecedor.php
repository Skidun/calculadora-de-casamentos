<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoiva			= $_SESSION["EMAIL"];
	$idFornecedor		= $_GET["id"];

	$nomeFornecedor		= $_GET["nomeFornecedor"];
	$contatoFornecedor	= $_GET["contatoFornecedor"];
	$emailFornecedor	= $_GET["emailFornecedor"]; 
	$valorFornecedor	= str_replace(',','.',str_replace('.','',$_GET["valorFornecedor"]));
	$obsFornecedor		= $_GET["obsFornecedor"];

	//Verifica se existem EditFornecedor
	$sqlEditFornecedor	= "UPDATE cn_fornecedores SET nomeFornecedor = :nomeFornecedor, contatoFornecedor = :contatoFornecedor, emailFornecedor = :emailFornecedor, valorFornecedor = :valorFornecedor,"; 
	$sqlEditFornecedor  .= "obsFornecedor = :obsFornecedor WHERE idFornecedor = :idFornecedor";
	try{
		$queryEditFornecedor	=	$conecta->prepare($sqlEditFornecedor);
		$queryEditFornecedor->bindValue(':nomeFornecedor', $nomeFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->bindValue(':contatoFornecedor', $contatoFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->bindValue(':emailFornecedor', $emailFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->bindValue(':valorFornecedor', $valorFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->bindValue(':obsFornecedor', $obsFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->bindValue(':idFornecedor', $idFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->execute();
	}catch(PDOexception $errorEditFornecedor){echo $errorEditFornecedor->getMessage();}
	
	$result = array(
		"Sucesso" => true,
		"Mensagem"=> "Fornecedor Editado com Sucesso"
	);
	
	echo json_encode($result);						
?>