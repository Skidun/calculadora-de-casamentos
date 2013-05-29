<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoivaDel	= $_SESSION["EMAIL"];
	$idSubItemDel	= $_GET["id"];
	//Verifica se existe fornecedores para os SubItens
	$sqlFornecedores	=	"SELECT * FROM cn_fornecedores WHERE idSubItem = :idSubItem";
	try{
		$queryFornecedores = $conecta->prepare($sqlFornecedores);
		$queryFornecedores->bindValue(':idSubItem', $idSubItemDel, PDO::PARAM_STR);
		$queryFornecedores->execute();
		
		$resultFornecedores = $queryFornecedores->fetchAll(PDO::FETCH_ASSOC);
		$countFornecedores	= $queryFornecedores->rowCount(PDO::FETCH_ASSOC);
			
		}catch(PDOexception $errorFornecedores){echo $errorFornecedores->getMessage();}
	foreach($resultFornecedores as $fornecedores){
		$idFornecedor	=	$fornecedores["idFornecedor"];
		$nomeFornecedor	=	$fornecedores["nomeFornecedor"];
		$subItemFornecedor=	$fornecedores["idSubItem"];
		$itemFornecedor	=	$fornecedores["idItem"];
		}
				
	//Faz as verificações para realizar a exclusão.
	$sqlDeleteSubItem = "DELETE FROM cn_subitens WHERE idSubItem = :idSubItemDel";
		try{
			$queryDeleteSubItem = $conecta->prepare($sqlDeleteSubItem);
			$queryDeleteSubItem->bindValue(':idSubItemDel', $idSubItemDel, PDO::PARAM_STR);
			$queryDeleteSubItem->execute();
			
			echo "SubItem deletado com sucesso";
			
			}catch(PDOexception $errorDeleteSubItem){echo $errorDeleteSubItem;}	
	
	if($countFornecedores > 0){
		do{
			$sqlDeleteFornecedor = "DELETE FROM cn_fornecedores WHERE idSubItem = :idSubItemDel";
			try{
				$queryDeleteFornecedor	= $conecta->prepare($sqlDeleteFornecedor);
				$queryDeleteFornecedor->bindValue(':idSubItemDel', $subItemFornecedor, PDO::PARAM_STR);
				$queryDeleteFornecedor->execute();
				
				echo "Fornecedores Deletado com sucesso";
			}catch(PDOexception $errorDeleteFornecedor){echo $errorDeleteFornecedor->getMessage();}
			}while($countFornecedores = $resultFornecedores);
	}
						
?>