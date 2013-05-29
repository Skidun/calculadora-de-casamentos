<?php 
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	
	function geraItemCadSubitem(){
		$idNoiva			  = $_SESSION["ID"];
		$sqlGetItemCadSubItem = "SELECT * FROM cn_itens WHERE idNoiva = 0 OR idNoiva = :idNoiva";
		try{
		$queryGetItemCadSubItem = $conecta->prepare($sqlGetItemCadSubItem);
		$queryGetItemCadSubItem->bindValue(':idNoiva',$idNoiva,PDO::PARAM_STR);
		$queryGetItemCadSubItem->execute();
		//Resultado da Pesquisa
		$resultGetItemCadSubItem = $queryGetItemCadSubItem->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOexception $error_GetItemCadSubItem){echo "erro ao executar a consulta SQL".$error_GetItemCadSubItem->getMessage();}
		foreach($resultGetItemCadSubItem as $itens){
			$idItem		=	$itens["idItem"];
			$nomeItem	=	$itens["nomeItem"];
			}	
		}
?>