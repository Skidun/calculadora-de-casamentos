<?php 
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//EDIÇÃO DE ITENS

		$idSubItem 		= $_GET['id'];
		$nomeSubItem	= $_GET['nome'];
		$orcSubItem		= str_replace(',','.',str_replace('.','',$_GET['orcamento']));
		$idNoiva			= $_SESSION["EMAIL"];
		$sqlEditSubItem = "UPDATE cn_subitens SET nomeSubItem = :nomeSubItem, orcamentoSubItem = :orcSubItem WHERE idSubItem = :idSubItem";
		try{
			$queryEditSubItem = $conecta->prepare($sqlEditSubItem);
			$queryEditSubItem->bindValue(':nomeSubItem', $nomeSubItem, PDO::PARAM_STR);
			$queryEditSubItem->bindValue(':orcSubItem', $orcSubItem, PDO::PARAM_STR);
			$queryEditSubItem->bindValue(':idSubItem',$idSubItem,PDO::PARAM_STR);
			$queryEditSubItem->execute();			
					
			}catch(PDOexception $errorEditSubItem){
				echo "Erro ao executar comenado SQL ".$errorEditSubItem->getMessage();
			}
			$result = array(
					"result" 		=> true
				);		
			echo json_encode($result);
?>