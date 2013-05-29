<?php
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//Prepara Item para ser excluido
	$idNoivaDel	= $_SESSION["EMAIL"];
	$idItemDel	= $_GET["id"];
	//SQL que executa a exclusão dos fornecedores com o ID do ITEM  que foi solicitado a exclusão
	$sqlDeleteFornecedor = "DELETE FROM cn_fornecedores WHERE idItem = :idItemDel";
	try{
			$queryDeleteFornecedor	= $conecta->prepare($sqlDeleteFornecedor);
			$queryDeleteFornecedor->bindValue(':idItemDel', $idItemDel, PDO::PARAM_STR);
			$queryDeleteFornecedor->execute();
	}catch(PDOexception $errorDeleteFornecedor){echo $errorDeleteFornecedor->getMessage();}
    // SQL que executa a exclusão de todos os subitens com ID do Item
	$sqlDeleteSubItem = "DELETE FROM cn_subitens WHERE idItem = :idItemDel";
	try{
		$queryDeleteSubItem	= $conecta->prepare($sqlDeleteSubItem);
		$queryDeleteSubItem->bindValue(':idItemDel', $idItem, PDO::PARAM_STR);
		$queryDeleteSubItem->execute();
	}catch(PDOexception $errorDeleteSubItem){echo $errorDeleteSubItem->getMessage();}
    //Finalmente exclui o Item
    $sqlDeleteItem = "DELETE FROM cn_itens WHERE idItem = :idItemDel";
		try{
			$queryDeleteItem = $conecta->prepare($sqlDeleteItem);
			$queryDeleteItem->bindValue(':idItemDel', $idItemDel, PDO::PARAM_STR);
			$queryDeleteItem->execute();
			}catch(PDOexception $errorDeleteItem){echo $errorDeleteItem;}	    
    $result = array(
			"Sucesso" => true,
			"Mensagem" => "Excluido com sucesso."
		);
		
		echo json_encode($result);        				
?>