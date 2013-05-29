<?php 
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//EDIÇÃO DE ITENS

		$idItemEdit 		= $_GET['idDoItem'];
		$nomeItemEdit		= $_GET['nomeDoItem'];
		$orcamentoItemEdit	= str_replace(',','.',str_replace('.','',$_GET['orcamentoDoItem']));
		$idNoiva			= $_SESSION["EMAIL"];
		$sqlEditItem = "UPDATE cn_itens SET nomeItem = :nomeItem, orcamentoItem = :orcamentoItem WHERE idItem = :idItem";
		try{
			$queryEditItem = $conecta->prepare($sqlEditItem);
			$queryEditItem->bindValue(':nomeItem', $nomeItemEdit, PDO::PARAM_STR);
			$queryEditItem->bindValue(':orcamentoItem', $orcamentoItemEdit, PDO::PARAM_STR);
			$queryEditItem->bindValue(':idItem',$idItemEdit,PDO::PARAM_STR);
			$queryEditItem->execute();			
					
			}catch(PDOexception $errorEditItem){
				echo "Erro ao executar comenado SQL ".$errorEditItem->getMessage();
			}
			$result = array(
					"Execução" 		=> "Sucesso"
				);		
			echo json_encode($result);
?>