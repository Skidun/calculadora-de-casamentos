<?php 
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//CADASTRO DE ITENS

		$nomeItem 		= $_GET['nomeItem'];
		$orcamentoItem	= str_replace(',','.',str_replace('.','',$_GET["orcamento"]));
		$idNoiva		= $_SESSION["EMAIL"];
		$sqlCadItem = "INSERT INTO cn_itens(nomeItem, orcamentoItem, idNoiva) VALUE (:nomeItem, :orcamentoItem, :idUser)";
		try{
			$queryCadItem = $conecta->prepare($sqlCadItem);
			$queryCadItem->bindValue(':nomeItem', $nomeItem,PDO::PARAM_STR);
			$queryCadItem->bindValue(':orcamentoItem', $orcamentoItem, PDO::PARAM_STR);
			$queryCadItem->bindvalue(':idUser', $idNoiva, PDO::PARAM_STR);
			$queryCadItem->execute();			
			}catch(PDOexception $errorCadItem){
				echo "Erro ao executar comenado SQL";
				}
		$result = array(
			'reuslt' => true,
			'mesage' => 'Item Cadastrado com sucesso'
		);
		echo json_encode($result);
?>