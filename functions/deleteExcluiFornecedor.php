<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser do
	$idNoiva			= $_SESSION["EMAIL"];
	$idFornecedor		= $_GET["id"];
	
	//Pega os dados do fornecedor para verificar se ele é aberto ou fechado.
	$sqlGetFornecedor = "SELECT idFornecedor, statusNegocio, idSubItem FROM cn_fornecedores WHERE idFornecedor = :idFornecedor";
	try{
		$queryGetFornecedor = $conecta->prepare($sqlGetFornecedor);
		$queryGetFornecedor->bindValue(':idFornecedor', $idFornecedor, PDO::PARAM_STR);
		$queryGetFornecedor->execute();
		
		}catch(PDOexception $errorGetFornecedor){echo "Erro ao selecionar o fornecedor";}
	$resultGetFornecedor = $queryGetFornecedor->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($resultGetFornecedor as $getFornecedor){
		$statusNegocio  =	$getFornecedor["statusNegocio"]; 
		$idSubItem		=	$getFornecedor["idSubItem"];
		}
	//Verificad se o status do SubItem está fechado se tiver ele tem que ir no subitem e alterar o statu para aberto	
	if($statusNegocio == "Fechado"){
		
		$sqlUpdateSubItem = "UPDATE cn_subitens SET statusSubItem = :aberto WHERE idSubItem = :idSubItem";
		try{
			$queryUpdateSubItem = $conecta->prepare($sqlUpdateSubItem);
			$queryUpdateSubItem->bindValue(':aberto', "Aberto",PDO::PARAM_STR);
			$queryUpdateSubItem->bindValue(':idSubItem', $idSubItem, PDO::PARAM_STR);
			$queryUpdateSubItem->execute();
			
			}catch(PDOexception $errorUpdateSubItem){echo "Erro Ao realizar update no subitem";}
			
			//Cria uma consulta para pegar o ID do Subitem para usalo depois da exlusão do fornecedor
	$sqlGetDadosSubItens = "SELECT idSubItem FROM cn_subitens WHERE idSubItem = :idSubItem";
	
	//Operação de consulta SQL usando PDO
	
	try{
		$queryGetDadosSubItens	=	$conecta->prepare($sqlGetDadosSubItens);
		$queryGetDadosSubItens->bindValue(':idSubItem', $idSubItem, PDO::PARAM_STR);
		$queryGetDadosSubItens->execute();
		
		$resultGetDadosSubItens = $queryGetDadosSubItens->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetDadosSubItens){echo "Erro na consulta dos valores de orçamento";}
    //Extrai todas os campos dentro do array $getDadosSubItens
	
	foreach($resultGetDadosSubItens as $getDadosSubItens){
		$getIdSubItem		=	$getDadosSubItens["idSubItem"];
	}	
	//Verifica se existem ExcluiFornecedor
	
	$sqlExcluiFornecedor	= "DELETE FROM cn_fornecedores WHERE idFornecedor = :idFornecedor"; 
	try{
		$queryExcluiFornecedor	=	$conecta->prepare($sqlExcluiFornecedor);
		$queryExcluiFornecedor->bindValue(':idFornecedor', $idFornecedor, PDO::PARAM_STR);
		$queryExcluiFornecedor->execute();
	}catch(PDOexception $errorExcluiFornecedor){echo $errorExcluiFornecedor->getMessage();}
	
	$result	= array(
		"subitem" => "$getIdSubItem"
	);
	echo json_encode($result);
		}
		else{
	//Cria uma consulta para pegar o ID do Subitem para usalo depois da exlusão do fornecedor
	$sqlGetDadosSubItens = "SELECT idSubItem FROM cn_subitens WHERE idSubItem = :idSubItem";
	//Operação de consulta SQL usando PDO
	try{
		$queryGetDadosSubItens	=	$conecta->prepare($sqlGetDadosSubItens);
		$queryGetDadosSubItens->bindValue(':idSubItem', $idSubItem, PDO::PARAM_STR);
		$queryGetDadosSubItens->execute();
		
		$resultGetDadosSubItens = $queryGetDadosSubItens->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetDadosSubItens){echo "Erro na consulta dos valores de orçamento";}
    //Extrai todas os campos dentro do array $getDadosSubItens
	foreach($resultGetDadosSubItens as $getDadosSubItens){
		$getIdSubItem		=	$getDadosSubItens["idSubItem"];
	}	
	//Verifica se existem ExcluiFornecedor
	$sqlExcluiFornecedor	= "DELETE FROM cn_fornecedores WHERE idFornecedor = :idFornecedor"; 
	try{
		$queryExcluiFornecedor	=	$conecta->prepare($sqlExcluiFornecedor);
		$queryExcluiFornecedor->bindValue(':idFornecedor', $idFornecedor, PDO::PARAM_STR);
		$queryExcluiFornecedor->execute();
	}catch(PDOexception $errorExcluiFornecedor){echo $errorExcluiFornecedor->getMessage();}
	
	$result	= array(
		"subitem" => "$getIdSubItem"
	);
	echo json_encode($result);
		}
?>