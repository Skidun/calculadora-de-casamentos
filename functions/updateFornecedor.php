<?php 
	session_start();
	if(!isset($_SESSION["LOGADO"])){
		@header("Location: login.php");
	}
	require '../class/MysqlConnPDO.php';
	//EDIÇÃO DE ITENS

		$idFornecedorEdit 		= $_GET['idFornecedor'];
		$idNoiva			= $_SESSION["EMAIL"];
		$sqlEditFornecedor = "SELECT * FROM cn_fornecedores WHERE idFornecedor = :idFornecedor";
		try{
			$queryEditFornecedor = $conecta->prepare($sqlEditFornecedor);
			$queryEditFornecedor->bindValue(':idFornecedor',$idFornecedorEdit,PDO::PARAM_STR);
			$queryEditFornecedor->execute();
			
			$resultEditFornecedor = $queryEditFornecedor->fetchAll(PDO::FETCH_ASSOC);
			
					
			}catch(PDOexception $errorEditFornecedor){
				echo "Erro ao executar comenado SQL ".$errorEditFornecedor->getMessage();
			}
			foreach($resultEditFornecedor as $editFornecedor){
				$idFornecedor		=	$editFornecedor["idFornecedor"];
				$nomeFornecedor		=	$editFornecedor["nomeFornecedor"];
				$contatoFornecedor	=	$editFornecedor["contatoFornecedor"];
				$emailFornecedor	=	$editFornecedor["emailFornecedor"];
				$valorFornecedor	=	number_format($editFornecedor["valorFornecedor"], 2, ',','.');
				$obsFornecedor		=	$editFornecedor["obsFornecedor"];
					
			}
			$result = array(
					"idFornecedor" 	=> "$idFornecedor",
					"nome" 			=> "$nomeFornecedor",
					"contato" 		=> "$contatoFornecedor",
					"email" 		=> "$emailFornecedor",
					"valor"			=> "$valorFornecedor",
					"obs"			=> "$obsFornecedor" 
				);
			echo json_encode($result);
?>