<?php 
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//EDIÇÃO DE ITENS

		$idItemEdit 		= $_GET['idItem'];
		$idNoiva			= $_SESSION["EMAIL"];
		$sqlEditItem = "SELECT * FROM cn_itens WHERE idItem = :idItem";
		try{
			$queryEditItem = $conecta->prepare($sqlEditItem);
			$queryEditItem->bindValue(':idItem',$idItemEdit,PDO::PARAM_STR);
			$queryEditItem->execute();
			
			$resultEditItem = $queryEditItem->fetchAll(PDO::FETCH_ASSOC);
			
					
			}catch(PDOexception $errorEditItem){
				echo "Erro ao executar comenado SQL ".$errorEditItem->getMessage();
			}
			foreach($resultEditItem as $editItem){
				$idItem			=	$editItem["idItem"];
				$nomeItem		=	$editItem["nomeItem"];
				$orcamentoItem	=	number_format($editItem["orcamentoItem"], 2, ',','.');
				$idUser			=	$editItem["idNoiva"];
			$result = array(
					"idItemResult" 			=> "$idItem",
					"nomeItemResult" 		=> "$nomeItem",
					"orcamentoItemResult"	=>	"$orcamentoItem",
					"idNoivaResult" 	=> "$idUser" 
				);
			echo json_encode($result);		
			}
			
?>