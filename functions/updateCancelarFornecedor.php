<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoiva			= $_SESSION["EMAIL"];
	$idFornecedor		= $_GET["id"];
    $idSubItem          = $_GET["subitem"];
	$statusFornecedor	= "Aberto";
	//Verifica se existem EditFornecedor
	$sqlEditFornecedor	= "UPDATE cn_fornecedores SET statusNegocio = :statusFornecedor WHERE idFornecedor = :idFornecedor"; 
	try{
		$queryEditFornecedor	=	$conecta->prepare($sqlEditFornecedor);
		$queryEditFornecedor->bindValue(':statusFornecedor', $statusFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->bindValue(':idFornecedor', $idFornecedor, PDO::PARAM_STR);
		$queryEditFornecedor->execute();
	}catch(PDOexception $errorEditFornecedor){echo $errorEditFornecedor->getMessage();}
	
    $sqlEditSubItem = "UPDATE cn_subitens SET  statusSubItem = :statusSubItem WHERE idSubItem = :idSubItem";
		try{
			$queryEditSubItem = $conecta->prepare($sqlEditSubItem);
			$queryEditSubItem->bindValue(':statusSubItem', $statusFornecedor, PDO::PARAM_STR);
			$queryEditSubItem->bindValue(':idSubItem',$idSubItem,PDO::PARAM_STR);
			$queryEditSubItem->execute();			
					
			}catch(PDOexception $errorEditSubItem){
				echo "Erro ao executar comenado SQL ".$errorEditSubItem->getMessage();
			}
	$result	= array(
		"Sucesso" => true,
		"Mensagem"=> "Negócio Cancelado com Sucesso"
	);
	echo json_encode($result);
						
?>