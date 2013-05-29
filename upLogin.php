<?php 
require 'class/app.facebook.php';
require 'class/MysqlConnPDO.php';

$user_profile = $facebook->api('/me/');
$email		  =	$user_profile['email'];
////////////////////////////////////
	$nome 		= $_POST["nomeUsuario"];
	$data 		= date('Y-m-d', strtotime($_POST["dataCasamento"]));
	$orcamento	= str_replace(',','.',str_replace('.','',$_POST["orcamentoCasamento"]));
	
	$sqlUpdate	=	"UPDATE users SET username = :nome, dataCasamento = :data, orcamentoCasamento = :orcamento WHERE email = :email";
	try{
		$queryUpdate = $conecta->prepare($sqlUpdate);
		$queryUpdate = bindValue(':nome',$nome, PDO::PARAM_STR);
		$queryUpdate = bindValue(':data', $data, PDO::PARAM_STR);
		$queryUpdate = bindValue(':orcamento', $orcamento, PDO::PARAM_STR);
		$queryUpdate = bindValue(':email', $email, PDO::PARAM_STR);
		$queryUpdate->execute();
		
		header("Location: class/LoginSistema.php?user=$email");
		
		}catch(PDOexception $error_Update){ echo "Erro ao atualizar dados ".$error_Update->getMessage();}
	
?>