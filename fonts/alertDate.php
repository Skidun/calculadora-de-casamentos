<?php

/**
 * @author Wesley S. Araújo
 * @copyright 2012
 */

include_once("../class/MysqlConnPDO.php");
include_once("../class/class.calcData.php");
require '../class/app.facebook.php';

//Pego os dados do usuário no casamento.
$sqlUser    =   "SELECT oauth_uid, username, email, dataCasamento FROM users ORDER BY dataCasamento DESC";
try{
    $queryUser = $conecta->prepare($sqlUser);
    $queryUser->execute();
    
    $resultUser = $queryUser->fetchAll(PDO::FETCH_ASSOC);
    
}catch(PDOexception $errorUser){echo "Não foi possível selecionar os usuários do sistema ".$errorUser->getMessage();}

//Calculo do intervalo entre a data e atual e o casamento
$dataAtual      = date('Y-m-d');
$intervaloCasamento = new calcData();

foreach($resultUser as $user){
    $uidUser    = $user["oauth_uid"];
    $nameUser   = $user["username"];
    $emailUser  = $user["email"];
    $userperfil = $user["userperfil"];
    $dataCasamento= $user["dataCasamento"]; 

   if($intervaloCasamento->dataDif($dataAtual, $dataCasamento, 'm') < 3){
    
    //Postando no Mural do usuário
    try{
			$post = $facebook->api("/$userperfil/feed", 'POST', 
				array(
					'name' => 'GNT - Calculadora de Casamentos',
					'message'=>'O seu casamento já está se aproximando e você ainda não conclui todo seu orçamento.',
					'picture' =>'https://gntapps.com.br/calculadora-de-casamentos/img/00_GNT-Share-Facebook.jpg'
				));			
			}catch(FacebookApiException $e){ echo "Erro ao postar no Mural do usuário! ".$e->getMessage();}
    
    echo "<p>".$nameUser." - Faltam ".$intervaloCasamento->dataDif($dataAtual, $dataCasamento, 'm')." meses para seu casamento</p>";
    
   }
  

}


?>