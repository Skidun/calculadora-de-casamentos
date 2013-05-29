<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoiva			= $_SESSION["EMAIL"];
	$idFornecedor		= $_GET["id"];
	$statusFornecedor	= "Fechado";
	$statusAberto		= "Aberto";
	$idSubItem			= $_GET["subitem"];
	
	//Verifica se existe algum fonecedor fechado
	$sqlCheckFornecedor	= "SELECT * FROM cn_fornecedores WHERE statusNegocio = :statusFornecedor AND idSubItem = :idSubItem"; 
	try{
		$queryCheckFornecedor	=	$conecta->prepare($sqlCheckFornecedor);
		$queryCheckFornecedor->bindValue(':statusFornecedor', $statusFornecedor, PDO::PARAM_STR);
		$queryCheckFornecedor->bindValue(':idSubItem', $idSubItem, PDO::PARAM_STR);
		$queryCheckFornecedor->execute();
		
		$resultCheckFornecedor = $queryCheckFornecedor->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $errorCheckForncedor){echo "Erro na verificação dos itens fechados".$errorCheckForncedor->getMessage();}
		foreach($resultCheckFornecedor as $chekFornecedor){
			$idCheckFornecedor		= $chekFornecedor["idFornecedor"];
			$statusCheckFornecedor	= $chekFornecedor["statusNegocio"];
			$idCheckSubItem			= $chekFornecedor["idSubItem"];
			
	if(isset($statusCheckFornecedor) && $statusCheckFornecedor == "Fechado"){
	$sqlCancelaFornecedor	= "UPDATE cn_fornecedores SET statusNegocio = :statusFornecedor WHERE idFornecedor = :idFornecedor AND idSubItem = :idSubItem"; 
	try{
		$queryCancelaFornecedor	=	$conecta->prepare($sqlCancelaFornecedor);
		$queryCancelaFornecedor->bindValue(':statusFornecedor', $statusAberto, PDO::PARAM_STR);
		$queryCancelaFornecedor->bindValue(':idFornecedor', $idCheckFornecedor, PDO::PARAM_STR);
		$queryCancelaFornecedor->bindValue(':idSubItem', $idSubItem, PDO::PARAM_STR);
		$queryCancelaFornecedor->execute();
	}catch(PDOexception $errorCancelaFornecedor){echo "Erro na alteração do item para aberto ". $errorCancelaFornecedor->getMessage();}
	

	//Verifica se existem EditFornecedor
	//$sqlEditFornecedor	= "UPDATE cn_fornecedores SET statusNegocio = :statusFornecedor WHERE idFornecedor = :idFornecedor"; 
	//try{
	//	$queryEditFornecedor	=	$conecta->prepare($sqlEditFornecedor);
	//	$queryEditFornecedor->bindValue(':statusFornecedor', $statusFornecedor, PDO::PARAM_STR);
	//	$queryEditFornecedor->bindValue(':idFornecedor', $idFornecedor, PDO::PARAM_STR);
		//$queryEditFornecedor->bindValue(':idNoiva', $idNoiva, PDO::PARAM_STR);
	//	$queryEdtFornecedor->execute();
	//}catch(PDOexception $errorEditFornecedor){echo $errorEditFornecedor->getMessage();}
	//	@header("Location: ../index.php?idSubItem=$idSubItem&fornecedor=true");
	}
	/*
	$result	= array(
		"Sucesso" => true,
		"Mensagem"=> "Fornecedor do Subitem $idSubItem",
		"Parte"	  => "Nesse caso existe o fornecedor"
	);
	echo json_encode($result);
	*/
	}
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
        @header("Location: ../index.php?idSubItem=$idSubItem&fornecedor=true");
        
						
?>