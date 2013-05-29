<?php 
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//CADASTRO DE SUBITENS
	if(isset($_GET['nomeSubItem'])){
		$nomeSubItem 		= $_GET['nomeSubItem'];
		$idItem				= $_GET['itemID'];
		$idNoiva			= $_SESSION["EMAIL"];
		$sqlCadSubItem = "INSERT INTO cn_subitens(nomeSubItem, idItem, idNoiva) VALUE (:nomeSubItem, :idItem, :idNoiva)";
		try{
			$queryCadSubItem = $conecta->prepare($sqlCadSubItem);
			$queryCadSubItem->bindValue(':nomeSubItem',$nomeSubItem,PDO::PARAM_STR);
			$queryCadSubItem->bindValue(':idItem',$idItem,PDO::PARAM_STR);
			$queryCadSubItem->bindvalue(':idNoiva', $idNoiva, PDO::PARAM_STR);
			$queryCadSubItem->execute();			
			}catch(PDOexception $errorCadSubItem){
				echo "Erro ao executar comenado SQL";
				}
		$insertId	=	$conecta->lastInsertId();
		$result = array(
			'idResult' => "$insertId",
			'mesage' => 'Subitem Cadastrado com sucesso'
		);
		
		echo json_encode($result);		
		}
?>