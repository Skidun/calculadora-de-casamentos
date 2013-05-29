<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */

$sqlGetDadosNoiva = "SELECT * FROM users WHERE email = :idNoiva";
	try{
		$queryGetDadosNoiva	=	$conecta->prepare($sqlGetDadosNoiva);
		$queryGetDadosNoiva->bindValue(':idNoiva', $idNoiva, PDO::PARAM_STR);
		$queryGetDadosNoiva->execute();
		
		$resultGetDadosNoiva = $queryGetDadosNoiva->fetchAll(PDO::FETCH_ASSOC);
		
		}catch(PDOexception $errorGetDadosNoiva){echo "Erro a resgatar informações da noiva ".$errorGetDadosNoiva->getMessage();}
	
	foreach($resultGetDadosNoiva as $getDadosNoiva){
		$dataCasamento	=	$getDadosNoiva["dataCasamento"];
		}

?>