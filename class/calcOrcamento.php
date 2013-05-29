<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */

$sqlGetOrcEstimado = "SELECT SUM(orcamentoItem) AS soma FROM cn_itens WHERE idNoiva = :idNoiva";
	try{
		$queryGetOrcamentoEstimado	=	$conecta->prepare($sqlGetOrcEstimado);
		$queryGetOrcamentoEstimado->bindValue(':idNoiva',$idNoiva,PDO::PARAM_STR);
		$queryGetOrcamentoEstimado->execute();
		$resultGetOrcamentoEstimado = $queryGetOrcamentoEstimado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcamentoEstimado	= $queryGetOrcamentoEstimado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de orçamento";}
    foreach($resultGetOrcamentoEstimado as $getOrcamentoEstimado){
		$valorEstimado	=	$getOrcamentoEstimado["soma"];
	}
	$sqlGetOrcRealizado = "SELECT SUM(valorFornecedor) AS soma FROM cn_fornecedores WHERE idNoiva = :idNoiva AND statusNegocio = :statusNegocio";
	try{
		$queryGetOrcamentoRealizado	=	$conecta->prepare($sqlGetOrcRealizado);
		$queryGetOrcamentoRealizado->bindValue(':idNoiva',$idNoiva,PDO::PARAM_STR);
		$queryGetOrcamentoRealizado->bindValue(':statusNegocio',"Fechado",PDO::PARAM_STR);
		$queryGetOrcamentoRealizado->execute();
		$resultGetOrcamentoRealizado = $queryGetOrcamentoRealizado->fetchAll(PDO::FETCH_ASSOC);
		$countGetOrcamentoRealizado	= $queryGetOrcamentoRealizado->rowCount(PDO::FETCH_ASSOC);
		}catch(PDOexception $errorGetOrcEstimado){echo "Erro na consulta dos valores de orçamento";}
    foreach($resultGetOrcamentoRealizado as $getOrcamentoRealizado){
		$valorRealizado	=	$getOrcamentoRealizado["soma"];
	}

?>